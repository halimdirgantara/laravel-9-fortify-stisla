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
                    href="{{ route('dashboard') }}"><i class="fas fa-fire"></i> <span>Dashboard</span></a>
            </li>
            <li class="{{ Request::is('post.index') ? 'active' : '' }}">
                <a class="nav-link"
                    href="{{ route('post.index') }}"><i class="fas fa-file"></i><span>Post</span></a>
            </li>
            <li class="{{ Request::is('category.index') ? 'active' : '' }}">
                <a class="nav-link"
                    href="{{ route('category.index') }}"><i class="fas fa-grip-horizontal"></i><span>Category</span></a>
            </li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-wrench"></i>
                    <span>Master Data</span></a>
                <ul class="dropdown-menu" style="display: block;">
                    <li class="{{ Request::is('user') ? 'active' : '' }}"><a
                        class="nav-link " href="{{ route('user.index') }}"><i class="fas fa-users"></i>
                        <span>User</span></a></li>
                    <li class="{{ Request::is('permission') ? 'active' : '' }}"><a
                        class="nav-link " href="{{ route('permission.index') }}"><i class="fas fa-key"></i>
                        <span>Permission</span></a></li>
                    <li class="{{ Request::is('role') ? 'active' : '' }}"><a
                        class="nav-link " href="{{ route('role.index') }}"><i class="fas fa-file-signature"></i>
                        <span>Role</span></a></li>
                </ul>
            </li>


        </ul>
    </aside>
</div>
