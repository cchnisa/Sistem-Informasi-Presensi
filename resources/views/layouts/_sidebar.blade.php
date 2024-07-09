<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="https://avatars.dicebear.com/api/bottts/example.svg?options%5Bcolors%5D%5B%5D=cyan" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="{{ url('/home') }}" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon far fa-calendar-alt"></i>
                    <p>
                        Data Master
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ url('/attendance') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Data Kehadiran</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('datasummary.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Data Summary</p>
                        </a>
                    </li>
                </ul>
            </li>
            @if (Auth::user()->is_admin == '1')
            <li class="nav-item">
                <a href="{{ url('/user') }}" class="nav-link">
                    <i class="nav-icon fas fa-user"></i>
                    <p>
                        Data Pegawai
                    </p>
                </a>
            </li>
            @endif
            @if (Auth::user()->is_admin == '1')
            <li class="nav-item">
                <a href="{{ url('/locations') }}" class="nav-link">
                    <i class="nav-icon fa fa-map-marker"></i>
                    <p>
                        Kelola Jarak
                    </p>
                </a>
            </li>
            @endif
            @if (Auth::user()->is_admin == '1')
            <li class="nav-item">
                <a href="{{ url('/activitiesout') }}" class="nav-link">
                    <i class="nav-icon fa fa-map-marker"></i>
                    <p>
                        Activity
                    </p>
                </a>
            </li>
            @endif
            <li class="nav-header">LABELS</li>
            <li class="nav-item">
                <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                    <i class="nav-icon far fa-circle text-danger"></i>
                    <p class="text">Logout</p>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>