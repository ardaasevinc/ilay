<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'name',
        'value',
        'type',
        'group',
        'options',
        'is_public',
        'order',
    ];

    protected $casts = [
        'is_public' => 'boolean',
        'order' => 'integer',
    ];

    protected static function booted()
    {
        static::saved(function ($setting) {
            // Clear view cache when settings are updated
            if (in_array($setting->key, ['admin_logo_light', 'admin_logo_dark', 'admin_logo_height', 'site_name'])) {
                try {
                    Artisan::call('view:clear');
                    Cache::forget('settings_cache');
                } catch (\Exception $e) {
                    // Silently handle cache clear errors
                }
            }

            // Update .env file for specific settings
            $setting->updateEnvFile();
        });

        static::deleted(function ($setting) {
            // Clear view cache when settings are deleted
            if (in_array($setting->key, ['admin_logo_light', 'admin_logo_dark', 'admin_logo_height', 'site_name'])) {
                try {
                    Artisan::call('view:clear');
                    Cache::forget('settings_cache');
                } catch (\Exception $e) {
                    // Silently handle cache clear errors
                }
            }
        });
    }

    public static function getValue(string $key, $default = null)
    {
        try {
            $setting = static::where('key', $key)->first();
            return $setting ? $setting->value : $default;
        } catch (\Exception $e) {
            // Tablo henüz oluşturulmamışsa default değeri döndür
            return $default;
        }
    }

    public static function setValue(string $key, $value): bool
    {
        try {
            return static::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            )->wasRecentlyCreated;
        } catch (\Exception $e) {
            // Tablo henüz oluşturulmamışsa false döndür
            return false;
        }
    }

    public static function getByGroup(string $group): \Illuminate\Database\Eloquent\Collection
    {
        try {
            return static::where('group', $group)->orderBy('order')->get();
        } catch (\Exception $e) {
            return new \Illuminate\Database\Eloquent\Collection(); // Boş Eloquent collection döndür
        }
    }

    public static function getPublicSettings(): \Illuminate\Database\Eloquent\Collection
    {
        try {
            return static::where('is_public', true)->orderBy('group')->orderBy('order')->get();
        } catch (\Exception $e) {
            return new \Illuminate\Database\Eloquent\Collection(); // Boş Eloquent collection döndür
        }
    }

    public function getOptionsArrayAttribute(): array
    {
        if (empty($this->options)) {
            return [];
        }

        $options = [];
        $lines = explode("\n", $this->options);

        foreach ($lines as $line) {
            $line = trim($line);
            if (strpos($line, ':') !== false) {
                [$key, $value] = explode(':', $line, 2);
                $options[trim($key)] = trim($value);
            }
        }

        return $options;
    }

    /**
     * Update .env file when specific settings are changed
     */
    public function updateEnvFile(): void
    {
        // Define which settings should update .env file
        $envMappings = [
            'app_name' => 'APP_NAME',
            'app_url' => 'APP_URL',
            'app_debug' => 'APP_DEBUG',
            'mail_from_address' => 'MAIL_FROM_ADDRESS',
            'mail_from_name' => 'MAIL_FROM_NAME',
            'mail_driver' => 'MAIL_MAILER',
            'mail_host' => 'MAIL_HOST',
            'mail_port' => 'MAIL_PORT',
            'mail_username' => 'MAIL_USERNAME',
            'mail_password' => 'MAIL_PASSWORD',
            'mail_encryption' => 'MAIL_ENCRYPTION',
        ];        // Check if this setting should update .env
        if (!isset($envMappings[$this->key])) {
            return;
        }

        $envKey = $envMappings[$this->key];
        $envValue = $this->value;

        // Special formatting for specific values
        if ($this->key === 'app_debug') {
            $envValue = $this->value === '1' ? 'true' : 'false';
        }

        // Quote values that might contain spaces
        if (in_array($this->key, ['app_name', 'mail_from_name']) && str_contains($envValue, ' ')) {
            $envValue = '"' . $envValue . '"';
        }

        try {
            $this->setEnvironmentValue($envKey, $envValue);
        } catch (\Exception $e) {
            // Log error but don't break the application
            \Log::error('Failed to update .env file: ' . $e->getMessage());
        }
    }

    /**
     * Set environment variable in .env file
     */
    private function setEnvironmentValue(string $key, string $value): void
    {
        $envFile = base_path('.env');

        if (!file_exists($envFile)) {
            return;
        }

        $content = file_get_contents($envFile);
        $pattern = "/^{$key}=.*$/m";
        $replacement = "{$key}={$value}";

        if (preg_match($pattern, $content)) {
            // Update existing key
            $content = preg_replace($pattern, $replacement, $content);
        } else {
            // Add new key at the end
            $content = rtrim($content, "\n") . "\n{$replacement}\n";
        }

        file_put_contents($envFile, $content);

        // Clear config cache to reload new values
        try {
            Artisan::call('config:clear');
        } catch (\Exception $e) {
            // Ignore cache clear errors in production
        }
    }
}
