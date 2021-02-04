<aside class="main-sidebar {{ config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4') }}">

    {{-- Sidebar brand logo --}}
    @if(config('adminlte.logo_img_xl'))
        @include('adminlte::partials.common.brand-logo-xl')
    @else
        @include('adminlte::partials.common.brand-logo-xs')
    @endif

    {{-- Sidebar menu --}}
    
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        @php
            $user = \Auth::user();
        @endphp
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview @yield('nav-dashboard-menu')">
                    <a href="#" class="nav-link @yield('nav-dashboard')">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Panel de control
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/home" class="nav-link @yield('nav-overview')">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Visión general</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/my-account" class="nav-link @yield('nav-account')">
                                <i class="far fa-id-card nav-icon"></i>
                                <p>Mi cuenta</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                <li class="nav-item">
                    <a href="/areas" class="nav-link  @yield('nav-areas')">
                        <i class="fa fa-store-alt nav-icon "></i>
                        <p>Áreas</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                <li class="nav-item">
                    <a href="/positions" class="nav-link  @yield('nav-positions')">
                        <i class="fa fa-shopping-cart nav-icon "></i>
                        <p>Posiciones</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                <li class="nav-item">
                    <a href="/nominees" class="nav-link  @yield('nav-nominees')">
                        <i class="fa fa-clipboard-check nav-icon "></i>
                        <p>Nominados</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                <li class="nav-item">
                    <a href="/elections" class="nav-link  @yield('nav-elections')">
                        <i class="fa fa-file-invoice nav-icon "></i>
                        <p>Votaciones</p>
                    </a>
                </li>
            </ul>
            <!-- <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                <li class="nav-item">
                    <a href="/contact-support" class="nav-link  @yield('nav-contact-support')">
                        <i class="fa fa-headset nav-icon "></i>
                        <p>Soporte técnico</p>
                    </a>
                </li>
            </ul> -->
        </nav>
        <!-- /.sidebar-menu -->
        <nav class="mt-2" style=" bottom: 0;">
            <ul class="nav nav-pills nav-sidebar flex-column">
                <li class="nav-item">
                    <p  style="color: #ffffff;">© 2020 {{ env('APP_NAME') }}</p>
                </li>
            </ul>
        </nav>
    </div>
</aside>
