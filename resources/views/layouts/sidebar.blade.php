<div class="sidebar" id="app">
    <div class="containerLogo logo shadow-sm" id="logo">
        <a href="{{ url('/home') }}">
            <img src="{{ asset('img/pc.png') }}" alt="logo" loading="lazy">
        </a>
    </div>
    <nav class="navbar" id="side">
        <ul class="navbar-nav">
            <li id="nav-item-bordered" class="nav-item {{ Request::is('home') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <!-- pc page -->
            @if(Auth::check())
                @if (Auth::user()->role != '1')
                    <li id="nav-item" class="nav-item {{ Request::is('pc') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('pc') }}">
                            <i class="bi bi-pc"></i>
                            <span>My PC</span>
                        </a>
                    </li>

                    <!-- history page -->
                    <li id="nav-item-bordered" class="nav-item {{ Request::is('history') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('history') }}">
                            <i class="bi bi-clock"></i>
                            <span>History</span>
                        </a>
                    </li>
                    <!-- add link to go to the shipping details page -->
                    <li id="nav-item" class="nav-item {{ Request::is('shippingDetails') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('shippingDetails') }}">
                            <i class="bi bi-person-badge"></i>
                            <span>Profile</span>
                        </a>
                    </li>
                @endif
            @endif
        </ul>

    </nav>
</div>