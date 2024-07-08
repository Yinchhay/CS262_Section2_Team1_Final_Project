<nav class="navbar header">
    <div class="container-xxl d-flex justify-content-between align-items-center saria-condensed">
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <div class="logo-container">
                <img src="{{ asset('images/proficientia_logo.png') }}" alt="PROFICIENTIA" width="49" height="49"
                    class="d-inline-block align-text-top">
                <span class="fw-semibold">
                    <span class="logo-top orange">PROFI</span>
                    <span class="logo-bottom purple">CIENTIA</span>
                </span>
            </div>
        </a>
        <div class="username fw-semibold fs-20 d-flex flex-row align-items-center gap-2">
            <span class="text-uppercase">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</span>
            <span class="nametag d-flex justify-content-center align-items-center overflow-hidden">{{ Auth::user()->first_name[0] . Auth::user()->last_name[0] }}</span>
        </div>
    </div>
</nav>
