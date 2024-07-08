<div class="toggle-container">
    <i class='bx bx-chevron-right toggle'></i>
</div>

<div class="menu-bar saria-condensed fw-semibold fs-20 text-uppercase">
    <div class="menu">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="{{ route('dashboard') }}">
                    <i class='bx bxs-dashboard icon'></i>
                    <span class="text">DASHBOARD</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('users.index') }}">
                    <i class='bx bxs-user icon'></i>
                    <span class="text">USER MANAGEMENT</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" aria-expanded="false"
                    data-bs-target="#serviceManagement">
                    <i class='bx bx-cog icon'></i>
                    <span class="text">SERVICE MANAGEMENT</span>
                    <i class='bx bx-chevron-down icon'></i>
                </a>
                <div class="">
                    <ul class="nav fw-normal fs-18 text-capitalize collapse" id="serviceManagement">
                        <li class="nav-item ps-2 pe-3">
                            <a class="nav-link sub-item" href="{{ route('materials.posters.index') }}">
                                <i class='bx bx-book-open icon'></i>
                                <span class="text">Materials</span>
                            </a>
                        </li>
                        <li class="nav-item ps-2 pe-3">
                            <a class="nav-link sub-item" href="{{ route('online-tests.posters.index') }}">
                                <i class='bx bx-laptop icon'></i>
                                <span class="text">Online Tests</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('suggestions.index') }}">
                    <i class='bx bx-comment icon'></i>
                    <span class="text">SUGGESTIONS</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="bottom-content">
        <li class="nav-item logout" style="list-style: none;">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="nav-link text-decoration-none">
                    <i class='bx bx-log-out icon'></i>
                    <span class="text">LOG OUT</span>
                </button>
            </form>
        </li>
    </div>
</div>
