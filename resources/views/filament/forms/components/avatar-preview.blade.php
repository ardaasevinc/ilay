@php
    $record = $getRecord();
    $avatarUrl =
        $record && $record->avatar
            ? secure_url('uploads/' . $record->avatar)
            : 'https://ui-avatars.com/api/?name=' . urlencode($record->name ?? 'User') . '&background=6366f1&color=fff';
@endphp

<div class="flex flex-col items-center space-y-2">
    <div class="relative">
        <img src="{{ $avatarUrl }}" alt="Mevcut Avatar"
            class="w-24 h-24 rounded-full object-cover border-2 border-gray-200 dark:border-gray-700"
            onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($record->name ?? 'User') }}&background=6366f1&color=fff'">
        @if ($record && $record->avatar)
            <div class="absolute -top-1 -right-1 w-6 h-6 bg-green-500 rounded-full flex items-center justify-center">
                <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                        clip-rule="evenodd"></path>
                </svg>
            </div>
        @endif
    </div>
    <p class="text-xs text-gray-500 dark:text-gray-400 text-center">
        {{ $record && $record->avatar ? 'Yüklü Avatar' : 'Dinamik Avatar' }}
    </p>
</div>
