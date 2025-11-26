<aside class="sidebar">
    <div class="sidebar-header">
        <div class="sidebar-logo">
            <span class="sidebar-logo-icon">❄️</span>
        </div>
        <div class="sidebar-title">
            <span class="sidebar-title-kicker">Holiday</span>
            <span class="sidebar-title-main">Admin Panel</span>
        </div>
    </div>

    <ul class="nav-menu">
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span class="nav-link-icon">🏠</span>
                <span class="nav-link-label">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <span class="nav-link-icon">🧩</span>
                <span class="nav-link-label">Gift Labels</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.gifts.index') }}" class="nav-link {{ request()->routeIs('admin.gifts.*') ? 'active' : '' }}">
                <span class="nav-link-icon">🎁</span>
                <span class="nav-link-label">Gifts</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.gift-requests.index') }}" class="nav-link {{ request()->routeIs('admin.gift-requests.*') ? 'active' : '' }}">
                <span class="nav-link-icon">📋</span>
                <span class="nav-link-label">Gift Requests</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <span class="nav-link-icon">👥</span>
                <span class="nav-link-label">Users</span>
            </a>
        </li>
    </ul>

    <div class="sidebar-footer">
        <p class="sidebar-footer-text">
            Enjoy the season <span>✨</span>
        </p>
    </div>
</aside>