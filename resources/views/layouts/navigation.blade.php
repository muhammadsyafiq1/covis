    <div class="nk-header nk-header-fluid is-theme">
        <div class="container-xl wide-xl">
            <div class="nk-header-wrap">
                <div class="nk-menu-trigger mr-sm-2 d-lg-none">
                    <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="headerNav"><em
                            class="icon ni ni-menu"></em></a>
                </div>
                <div class="nk-header-brand">
                    <a href="{{ route('dashboard') }}" class="logo-link">
                        <img class="logo-light logo-img" src="{{ asset('images/logo.png') }}"
                            srcset="images/logo2x.png 2x" alt="logo">
                        <img class="logo-dark logo-img" src="{{ asset('images/logo-dark.png') }}"
                            srcset="images/logo-dark2x.png 2x" alt="logo-dark">
                    </a>
                </div>
                <div class="nk-header-menu" data-content="headerNav">
                    <div class="nk-header-mobile">
                        <div class="nk-header-brand">
                            <a href="{{ route('dashboard') }}" class="logo-link">
                                <img class="logo-light logo-img" src="{{ asset('images/logo.png') }}"
                                    srcset="images/logo2x.png 2x" alt="logo">
                                <img class="logo-dark logo-img" src="{{ asset('images/logo-dark.png') }}"
                                    srcset="images/logo-dark2x.png 2x" alt="logo-dark">
                            </a>
                        </div>
                        <div class="nk-menu-trigger mr-n2">
                            <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="headerNav"><em
                                    class="icon ni ni-arrow-left"></em></a>
                        </div>
                    </div>
                    <ul class="nk-menu nk-menu-main ui-s2">
                        <li class="nk-menu-item has-sub">
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-text">Dashboards</span>
                            </a>
                            <ul class="nk-menu-sub">
                                <li class="nk-menu-item">
                                    <a href="{{ route('dashboard') }}" class="nk-menu-link">
                                        <span class="nk-menu-text">Analytics Dashboard</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nk-menu-item has-sub">
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-text">Collateral Visit</span>
                            </a>
                            <ul class="nk-menu-sub">
                                @hasanyrole('Supervisor|System Administrator|Administrator|Support|Admin')
                                <li class="nk-menu-item">
                                    <a href="{{ url('customer-new-table') }}" class="nk-menu-link"><span
                                            class="nk-menu-text">Customer</span></a>
                                </li>
                                <!-- <li class="nk-menu-item">
                                <a href="{{ url('customer-new-table') }}" class="nk-menu-link"><span
                                        class="nk-menu-text">Customer Search <span class="ml-1 badge rounded-pill bg-primary text-white">New</span> </span></a>
                                </li> -->
                                <li class="nk-menu-item">
                                    <a href="{{ url('transaction-request') }}" class="nk-menu-link"><span
                                            class="nk-menu-text">Order / Request</span></a>
                                </li>
                                @endhasanyrole
                                

                                {{-- @if (Auth::user()->user_role_id > 4)
                                @else
                                @endif --}}
                                @hasanyrole('Supervisor|System Administrator|Administrator|Leader')
                                    <li class="nk-menu-item">
                                        <a href="{{ url('transaction-confirmation') }}" class="nk-menu-link"><span
                                                class="nk-menu-text">Confirmation</span></a>
                                    </li>
                                @endhasanyrole

                                @if (Auth::user()->user_role_id == 8)
                                    <li class="nk-menu-item">
                                        <a href="{{ url('transaction-confirmation') }}" class="nk-menu-link"><span
                                                class="nk-menu-text">Confirmation</span></a>
                                    </li>
                                @endif

                                @hasanyrole('Head|System Administrator|Supervisor|Administrator')
                                    <li class="nk-menu-item">
                                        <a href="{{ url('transaction-approval') }}" class="nk-menu-link"><span
                                                class="nk-menu-text">Approval</span></a>
                                    </li>
                                @endhasanyrole

                            </ul>
                        </li>
                        @hasanyrole('Supervisor|System Administrator|Administrator|Support|Admin')
                        <li class="nk-menu-item has-sub">
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-text">Personnel</span>
                            </a>
                            <ul class="nk-menu-sub">
                                <li class="nk-menu-item">
                                    <a href="{{ url('personnel') }}" class="nk-menu-link">
                                        <span class="nk-menu-text">Personnel List</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nk-menu-item has-sub">
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-text">Report</span>
                            </a>
                            <ul class="nk-menu-sub">
                                <li class="nk-menu-item">
                                    <a href="{{ url('transaction-report') }}" class="nk-menu-link"><span
                                            class="nk-menu-text">Order / Request Report</span></a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="{{ url('visit-report') }}" class="nk-menu-link"><span
                                            class="nk-menu-text">Collateral Visit Report</span></a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="{{ url('achievement-report') }}" class="nk-menu-link"><span
                                            class="nk-menu-text">Achievement Report</span></a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="{{ url('outstanding-report') }}" class="nk-menu-link"><span
                                            class="nk-menu-text">Outstanding Report</span></a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="{{ url('download-report') }}" class="nk-menu-link"><span
                                            class="nk-menu-text">Download Report</span></a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="{{ url('download-customer') }}" class="nk-menu-link"><span
                                            class="nk-menu-text">Download Data Customer</span></a>
                                </li>
                            </ul>
                        </li>
                        <li class="nk-menu-item has-sub">
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-text">Settings</span>
                            </a>

                            <ul class="nk-menu-sub">

                                @if (Auth::user()->user_role_id > 4)
                                @else
                                    <li class="nk-menu-item has-sub">
                                        <a href="#" class="nk-menu-link nk-menu-toggle">
                                            <span class="nk-menu-text">Organization</span>
                                        </a>
                                        <ul class="nk-menu-sub">
                                            <li class="nk-menu-item">
                                                <a href="{{ url('setting-company') }}" class="nk-menu-link"><span
                                                        class="nk-menu-text">Company</span></a>
                                            </li>
                                            <li class="nk-menu-item">
                                                <a href="{{ url('setting-department') }}"
                                                    class="nk-menu-link"><span
                                                        class="nk-menu-text">Department</span></a>
                                            </li>
                                            <li class="nk-menu-item">
                                                <a href="{{ url('setting-job-position') }}"
                                                    class="nk-menu-link"><span class="nk-menu-text">Job
                                                        Position</span></a>
                                            </li>
                                        </ul>
                                    </li>
                                @endif

                                <li class="nk-menu-item has-sub">
                                    <a href="#" class="nk-menu-link nk-menu-toggle"><span
                                            class="nk-menu-text">Project</span></a>
                                    <ul class="nk-menu-sub">
                                        <li class="nk-menu-item"><a href="{{ url('setting-project-client') }}"
                                                class="nk-menu-link"><span class="nk-menu-text">Client</span></a>
                                        </li>
                                        <li class="nk-menu-item"><a href="{{ url('setting-branch') }}"
                                                class="nk-menu-link"><span class="nk-menu-text">Branch</span></a>
                                        </li>
                                        <li class="nk-menu-item"><a href="{{ route('setting-region') }}"
                                                class="nk-menu-link"><span class="nk-menu-text">Region /
                                                    Zone</span></a></li>
                                    </ul>
                                </li>
                                <li class="nk-menu-item has-sub">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-text">Collateral</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        <li class="nk-menu-item">
                                            <a href="{{ url('setting-covis-class') }}" class="nk-menu-link"><span
                                                    class="nk-menu-text">Classes</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{ url('setting-covis-type') }}" class="nk-menu-link"><span
                                                    class="nk-menu-text">Type</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{ url('setting-covis-priority') }}"
                                                class="nk-menu-link"><span
                                                    class="nk-menu-text">Priority</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{ url('setting-covis-condition') }}"
                                                class="nk-menu-link"><span
                                                    class="nk-menu-text">Condition</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{ url('setting-covis-used-for') }}"
                                                class="nk-menu-link"><span class="nk-menu-text">Used
                                                    For</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{ url('setting-covis-road-access') }}"
                                                class="nk-menu-link"><span class="nk-menu-text">Road
                                                    Access</span></a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nk-menu-item has-sub">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-text">Users</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        <li class="nk-menu-item">
                                            <a href="{{ url('setting-user') }}" class="nk-menu-link">
                                                <span class="nk-menu-text">List</span>
                                            </a>
                                        </li>

                                        @if (Auth::user()->user_role_id > 2)
                                        @else
                                            <li class="nk-menu-item">
                                                <a href="{{ route('setting-user-role') }}" class="nk-menu-link">
                                                    <span class="nk-menu-text">Role</span>
                                                </a>
                                            </li>
                                        @endif

                                    </ul>
                                </li>
                            </ul>
                        </li>
                        @endhasanyrole
                    </ul>
                </div>
                <div class="nk-header-tools">
                    <ul class="nk-quick-nav">
                        <li class="dropdown user-dropdown order-sm-first">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <div class="user-toggle">
                                    <div class="user-avatar sm">
                                        <img src="{{ asset('images/avatar/' . auth()->user()->userImage->name) }}">
                                    </div>
                                    <div class="user-info d-none d-xl-block">
                                        <div class="user-status">{{ Auth::user()->jobPosition->name }}
                                        </div>
                                        <div class="user-name dropdown-indicator">{{ Auth::user()->name }}
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-md dropdown-menu-right dropdown-menu-s1 is-light">
                                <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                    <div class="user-card">
                                        <div class="user-info">
                                            <span class="lead-text">{{ Auth::user()->name }}</span>
                                            <span class="sub-text">{{ Auth::user()->email }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="dropdown-inner">
                                    <ul class="link-list">
                                        <li><a href="{{ route('profile') }}"><em
                                                    class="icon ni ni-user-alt"></em><span>View
                                                    Profile</span></a></li>
                                        <li><a class="dark-mode-switch" href="{{ route('faq') }}"><em
                                                    class="icon ni ni-bulb"></em><span>FAQs</span></a></li>
                                        <li><a class="dark-mode-switch" href="{{ route('terms-policy') }}"><em
                                                    class="icon ni ni-policy"></em><span>Terms &
                                                    Policy</span></a></li>
                                    </ul>
                                </div>
                                <div class="dropdown-inner">
                                    <ul class="link-list">
                                        <li>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <a href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();this.closest('form').submit();"><em
                                                        class="icon ni ni-signout"></em><span>Logout</span></a>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
