# Kurumsal CMS Sistemi

Laravel tabanlı, modern ve kullanıcı dostu kurumsal web sitesi yönetim sistemi.

## Özellikler

- **Filament Admin Panel** - Modern ve kullanıcı dostu yönetim paneli
- **Çoklu E-posta Sistemi** - Admin bildirimler ve kullanıcı teşekkür mailleri
- **Email Log Sistemi** - Tüm e-posta gönderimlerinin detaylı takibi
- **Excel Export** - Email logları için tarih filtreleriyle Excel çıktısı
- **Rol ve İzin Yönetimi** - Spatie Permission ile güçlü yetkilendirme
- **Türkçe Yerelleştirme** - Tam Türkçe dil desteği
- **Gmail SMTP Entegrasyonu** - Profesyonel e-posta gönderimi

## Kurulum

### 1. Projeyi Klonlayın

```bash
git clone <repository-url>
cd cms
```

### 2. Bağımlılıkları Yükleyin

```bash
composer install
npm install && npm run build
```

### 3. Çevre Değişkenlerini Ayarlayın

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Veritabanını Ayarlayın

`.env` dosyasında veritabanı ayarlarınızı güncelleyin:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cms
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 5. Gmail SMTP Ayarları

Gmail üzerinden e-posta gönderimi için `.env` dosyasında:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@yourdomain.com
MAIL_FROM_NAME="Your Company Name"
```

**Önemli:** Gmail App Password kullanmanız gerekir:

1. Gmail hesabınızda 2FA aktif olmalı
2. Google Account > Security > 2-Step Verification > App passwords
3. Oluşturduğunuz App Password'u `MAIL_PASSWORD` olarak kullanın

**Test İçin:** Gerçek Gmail ayarları yoksa test amacıyla `.env` dosyasında `MAIL_MAILER=log` yapabilirsiniz. Bu durumda mailler `storage/logs/laravel.log` dosyasına yazılır.

### 6. Veritabanı Migrasyonları

```bash
php artisan migrate
php artisan db:seed
```

### 7. Sembolik Link Oluşturun

```bash
php artisan storage:link
```

## E-posta Sistemi

### Admin Bildirimleri

- **Contact Form:** Yeni iletişim mesajı alındığında admin'e bildirim
- **Brand Brief:** Yeni marka analizi talebi geldiğinde admin'e bildirim  
- **Subscription:** Yeni bülten aboneliği olduğunda admin'e bildirim

### Kullanıcı Teşekkür Mailleri

- **Contact Thank You:** İletişim formu gönderen kullanıcıya teşekkür maili
- **Brand Brief Thank You:** Marka brief gönderen şirkete teşekkür maili
- **Subscription Thank You:** Bülten aboneliğini onaylayan kullanıcıya hoş geldin maili

### E-posta Test Etme

```bash
# Contact teşekkür maili testi
php artisan test:mail contact test@example.com

# Brand Brief teşekkür maili testi  
php artisan test:mail brand-brief test@example.com

# Subscription teşekkür maili testi
php artisan test:mail subscription test@example.com
```

### Email Log Sistemi

- Tüm e-posta gönderimlerinin detaylı kaydı
- Başarılı/başarısız gönderim durumları
- Tarih aralığı filtreleme
- Excel export özelliği
- Admin panelinden görüntüleme ve yönetim

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
# ilay
# ilay
