<nav class="layout-navbarnavbar navbar-expand-xl navbar-detached sticky-top align-items-center bg-navbar-theme"
    id="layout-navbar">


    <div class="navbar-nav-right items-center flex container" id="navbar-collapse">
        <h1 class="text-2xl opacity-100 text-second m-3">@yield('title')</h1>

        @auth
            <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                    <a class="nav-link dropdown-toggle d-flex items-center gap-3 hide-arrow" href="javascript:void(0);"
                        data-bs-toggle="dropdown">
                        <div class="avatar avatar-online">
                            <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle" />
                        </div>
                        <span class="d-xl-flex d-none">
                            <span class="font-medium text-second block">{{ auth()->user()->username }}</span>
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="#">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar avatar-online">
                                            <img src="{{ asset('assets/img/avatars/1.png') }}" alt
                                                class="w-px-40 h-auto rounded-[50%] aspect-square object-cover object-center" />
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <span class="font-medium text-second block">{{ auth()->user()->username }}</span>
                                        <small class="text-sm text-desc">
                                            admin
                                        </small>
                                    </div>
                                </div>
                            </a>
                        </li>
                        {{-- <li>
                        <a class="dropdown-item" href="#">
                            @csrf
                            <i class="bx bx-user-circle me-2"></i>
                            <button type="submit">
                                Profile
                            </button>
                        </a>
                    </li> --}}
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            <a href="{{ route('profile.index') }}" class="dropdown-item">
                                <i class="bx bx-user me-2"></i>
                                {{-- <span class="align-middle">Log Out</span> --}}
                                <span>Profile</span>
                            </a>
                        </li>
                        <li>
                            <form class="dropdown-item" href="javascript:void(0);" action="{{ route('logout') }}"
                                method="POST">
                                @csrf
                                <i class="bx bx-power-off me-2"></i>
                                {{-- <span class="align-middle">Log Out</span> --}}
                                <button type="submit">
                                    Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
                <!--/ User -->
            </ul>
        @endauth

        <div class="layout-menu-toggle navbar-nav align-items-xl-center ml-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
            </a>
        </div>

    </div>
</nav>
