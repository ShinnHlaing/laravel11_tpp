<div class="app-sidebar sidebar-shadow">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                <li class="app-sidebar__heading">Dashboards</li>
                <li>
                    @can('dashboard')
                        <a href="{{ route('dashboard') }}" class="mm-active">
                            <i class="metismenu-icon pe-7s-rocket"></i>
                            TPP Dashboard
                        </a>
                    @endcan
                </li>
                <li class="app-sidebar__heading">UI Components</li>
                <li>
                    <a href="{{ route('categories.index') }}">
                        <i class="metismenu-icon pe-7s-diamond"></i>
                        Category
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                </li>
                <li>
                    <a href="{{ route('products.index') }}">
                        <i class="metismenu-icon pe-7s-car"></i>
                        Product
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                </li>
                <li>
                    <a href="{{ route('users.index') }}">
                        <i class="metismenu-icon pe-7s-display2"></i>
                        User
                    </a>
                </li>
                <li>
                    <a href="{{ route('roles.index') }}">
                        <i class="metismenu-icon pe-7s-display2"></i>
                        Role
                    </a>
                </li>
                <li>
                    <a href="{{ route('permissions.index') }}">
                        <i class="metismenu-icon pe-7s-display2"></i>
                        Permission
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
