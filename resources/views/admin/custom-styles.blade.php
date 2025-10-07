<style>
    /* Sidebar scrollbar gizleme */
    .fi-sidebar-nav {
        scrollbar-width: none !important;
        /* Firefox */
        -ms-overflow-style: none !important;
        /* Internet Explorer 10+ */
    }

    .fi-sidebar-nav::-webkit-scrollbar {
        display: none !important;
        /* WebKit */
    }

    /* Sidebar daha minimalist */
    .fi-sidebar {
        border-right: 1px solid rgb(229, 231, 235) !important;
    }

    /* Dark mode için */
    .dark .fi-sidebar {
        border-right: 1px solid rgb(55, 65, 81) !important;
    }

    /* Navigation itemları daha kompakt */
    .fi-sidebar-nav-item {
        margin-bottom: 2px !important;
    }

    .fi-sidebar-nav-item>.fi-sidebar-nav-item-button {
        padding: 0.5rem 1rem !important;
        border-radius: 0.5rem !important;
    }

    /* Alt navigation grup başlıkları daha küçük */
    .fi-sidebar-nav-group-label {
        font-size: 0.75rem !important;
        font-weight: 600 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.05em !important;
        padding: 0.5rem 1rem !important;
        margin-top: 1rem !important;
        margin-bottom: 0.25rem !important;
    }

    /* İkonlar daha küçük */
    .fi-sidebar-nav-item-icon {
        width: 1.25rem !important;
        height: 1.25rem !important;
    }

    /* Collapsed state'te tooltip'ler */
    .fi-sidebar-collapsed .fi-sidebar-nav-item-button {
        justify-content: center !important;
    }

    /* Main content scrollbar styling */
    .fi-main {
        scrollbar-width: thin;
        scrollbar-color: rgba(156, 163, 175, 0.3) transparent;
    }

    .fi-main::-webkit-scrollbar {
        width: 6px;
    }

    .fi-main::-webkit-scrollbar-track {
        background: transparent;
    }

    .fi-main::-webkit-scrollbar-thumb {
        background-color: rgba(156, 163, 175, 0.3);
        border-radius: 3px;
    }

    .fi-main::-webkit-scrollbar-thumb:hover {
        background-color: rgba(156, 163, 175, 0.5);
    }

    /* Genel scrollbar gizleme */
    .fi-body {
        scrollbar-width: none;
        -ms-overflow-style: none;
    }

    .fi-body::-webkit-scrollbar {
        display: none;
    }

    /* Web Sitesi navigation item yeşil background */
    .fi-sidebar-nav-item:has([href="/"]) .fi-sidebar-nav-item-button {
        background-color: #22c55e !important;
        color: white !important;
    }

    .fi-sidebar-nav-item:has([href="/"]) .fi-sidebar-nav-item-button:hover {
        background-color: #16a34a !important;
    }

    .fi-sidebar-nav-item:has([href="/"]) .fi-sidebar-nav-item-icon {
        color: white !important;
    }

    /* Dark mode için */
    .dark .fi-sidebar-nav-item:has([href="/"]) .fi-sidebar-nav-item-button {
        background-color: #22c55e !important;
        color: white !important;
    }

    .dark .fi-sidebar-nav-item:has([href="/"]) .fi-sidebar-nav-item-button:hover {
        background-color: #16a34a !important;
    }
</style>
