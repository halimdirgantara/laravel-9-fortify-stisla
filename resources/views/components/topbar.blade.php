<div class="navbar-bg" style="height:5em"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <a href="{{ route('homepage')}}" class="navbar-brand">Stisla</a>
    <div class="nav-collapse">
        <a class="sidebar-gone-show nav-collapse-toggle nav-link" href="#">
            <i class="fas fa-ellipsis-v"></i>
        </a>
        <ul class="navbar-nav">
            <li class="nav-item active"><a href="{{ route('blog') }}" class="nav-link">Blog</a></li>
            <li class="nav-item"><a href="{{ route('blog.category.index') }}" class="nav-link">Category</a></li>
        </ul>
    </div>
    <form action="#" method="POST" class="form-inline ml-auto">
        <div class="search-element">
            @csrf
            <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="250" style="width: 250px;">
            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
        </div>
    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown"><a href="#" data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="{{ asset('img/avatar/avatar-1.png') }}" class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::check() ? Auth::user()->name : 'Guest' }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                @if (Auth::check())
                    <a href="{{ route('profile.edit') }}" class="dropdown-item has-icon">
                        <i class="far fa-user"></i> Profile
                    </a>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item has-icon text-danger">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @else
                    <a href="{{ route('login') }}" class="dropdown-item has-icon text-danger">
                        <i class="fas fa-sign-in"></i> Login
                    </a>
                @endif
            </div>
        </li>
    </ul>
</nav>
