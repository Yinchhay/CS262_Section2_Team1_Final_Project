<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="{{ route('user.dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>User Informations</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('user.profile') }}">
                        <i class="bi bi-person"></i><span>User Profile</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('certificate.index') }}">
                        <i class="bi bi-patch-check"></i><span>Certificate</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('scoreboard.index') }}">
                        <i class="bi bi-body-text"></i><span>Scoreboard</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Components Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Services</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('material.index') }}">
                        <i class="bi bi-book"></i><span>Material</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('test.index') }}">
                        <i class="bi bi-laptop"></i><span>Online Test</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('suggestion.index') }}">
                        <i class="bi bi-envelope"></i><span>Suggestion</span>
                    </a>
                </li>

            </ul>
        </li><!-- End Forms Nav -->

        <li class="nav-item">


        <li class="nav-heading">Pages</li>


        <li class="nav-item">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="nav-link collapsed" style="border: none; background: none;">
                    <i class="bi bi-box-arrow-in-right"></i>
                    <span>Logout</span>
                </button>
            </form>
        </li><!-- End Login Page Nav -->


    </ul>

</aside>

<!--////////////////////////// End Sidebar/////////////////////////////-->
