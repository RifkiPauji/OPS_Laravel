<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">

    <div class="h-100" data-simplebar>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul id="side-menu">

                <li>
                    <a href="{{ route('dashboard') }}">
                        <i data-feather="home"></i>
                        <span> Home </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('product') }}">
                        <i data-feather="box"></i>
                        <span> Product </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('profile') }}">
                        <i data-feather="user"></i>
                        <span> Profile </span>
                    </a>
                </li>
                @auth
                <li>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout').submit();">
                        <i data-feather="log-out"></i>
                        <span> Logout </span>
                    </a>

                    <form id="logout" method="POST" action="{{ route('logout') }}" style="display: none;">
                        @csrf
                    </form>
                </li>
                @endauth

            </ul>

        </div>
        <!-- End Sidemenu -->

        <div class="clearfix"></div>

    </div>

</div>
<style>
    .left-side-menu {
        background-color: rgb(255, 51, 0) !important;
    }

    .left-side-menu a {
        color: white !important;
    }

    .left-side-menu a:hover {
        background-color: #ff9500 !important;
    }
</style>
