<nav class="navbar">
    <div class="navbar-left">
        <div class="navbar-title-group">
            <p class="navbar-kicker">Holiday Control</p>
            <h1 class="navbar-title">@yield('page-title', 'Dashboard')</h1>
        </div>
    </div>

    <div class="navbar-right">
        <div class="navbar-meta">
            <span class="navbar-meta-label">Today</span>
            <span class="navbar-meta-value">{{ now()->format('M d, Y') }}</span>
        </div>

        <div class="navbar-user">
            <div class="navbar-user-avatar">
                <span>🎄</span>
            </div>
            <div class="navbar-user-info">
                <span class="navbar-user-name">{{ auth()->user()->name ?? 'Admin' }}</span>
                <span class="navbar-user-role">Holiday Admin</span>
            </div>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">
                <span>Logout</span>
            </button>
        </form>
    </div>
</nav>