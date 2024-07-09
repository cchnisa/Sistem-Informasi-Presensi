<nav class="main-header navbar navbar-expand navbar-dark navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/home" class="nav-link">Home</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <!-- <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li>
    </ul> -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell"></i>
                <span class="badge badge-danger" id="notificationBadge">{{ count($activitiesOuts) }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notificationDropdown" id="notificationDropdownMenu">
                <!-- Loop through the $activitiesOuts and display notifications -->
                @foreach ($activitiesOuts as $activityOut)
                <a class="dropdown-item" href="#">
                    {{ $activityOut->user->name }}: {{ $activityOut->status ? 'Keluar Dari Area Kantor' : 'Masuk Kantor' }}: {{ $activityOut->created_at }}
                </a>
                @endforeach
            </div>
        </li>
    </ul>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var badge = document.getElementById('notificationBadge');
        var dropdownMenu = document.getElementById('notificationDropdownMenu');

        dropdownMenu.addEventListener('click', function(event) {
            // Periksa apakah yang diklik adalah elemen anchor
            if (event.target.tagName === 'A') {
                // Kurangi nilai badge sebanyak 1 jika nilainya lebih besar dari 0
                var currentValue = parseInt(badge.innerText);
                if (currentValue > 0) {
                    badge.innerText = currentValue - 1;
                }

                // Sembunyikan item yang diklik dari daftar
                event.target.style.display = 'none';
            }
        });
    });
</script>

