<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="#">Dashboard</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="#">DB</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
                <a class="nav-link"
                    href="#"><i class="fas fa-fire"></i> <span>Dashboard</span></a>
            </li>
        </ul>
    </aside>
</div>
