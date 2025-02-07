<!-- Topbar Start -->
<div class="navbar-custom">
    <div class="container-fluid">

        <!-- LOGO -->
        <div class="logo-box">
            <a href="index.html" class="logo logo-dark">
                <span class="logo-sm">
                    <img src="{{ asset('img/handbag-80.png') }}" alt="" height="40">
                    <span class="logo-lg-text-dark">SIMS Web App</span>
                </span>
                <span class="logo-lg">
                    <img src="{{ asset('img/handbag-80.png') }}" alt="" height="40">
                    <span class="logo-lg-text-dark">SIMS Web App</span>
                </span>
            </a>

            <a href="index.html" class="logo logo-light">
                <span class="logo-sm">
                    <img src="{{ asset('img/handbag-80.png') }}" alt="" height="40">
                    <span class="logo-lg-text-light">SIMS Web App</span>
                </span>
                <span class="logo-lg">
                    <img src="{{ asset('img/handbag-80.png') }}" alt="" height="40">
                    <span class="logo-lg-text-light">SIMS Web App</span>
                </span>
            </a>
        </div>

        <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
            <li>
                <button class="button-menu-mobile">
                    <i data-feather="menu"></i>
                </button>
            </li>

            <li>
                <!-- Mobile menu toggle (Horizontal Layout)-->
                <a class="navbar-toggle nav-link" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
                <!-- End mobile menu toggle-->
            </li>

        </ul>
    </div>
</div>
<!-- End Topbar -->
<style>
    /* Untuk memastikan background topbar menjadi orange */
    .navbar-custom {
        background-color: rgb(255, 51, 0) !important; /* Ganti dengan orange yang diinginkan */
    }

    /* Untuk sidebar */
    .left-side-menu {
        background-color: rgb(255, 51, 0) !important; /* Ganti dengan orange yang diinginkan */
    }

    /* Warna teks */
    .navbar-custom a, .navbar-custom span, .left-side-menu a {
        color: rgb(15, 14, 14) !important; /* Teks warna gelap */
    }

    /* Hover effect */
    .navbar-custom a:hover, .left-side-menu a:hover {
        background-color: #ff9500 !important; /* Warna hover lebih gelap */
    }
</style>
