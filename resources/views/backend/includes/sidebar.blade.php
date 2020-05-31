<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">
                @lang('menus.backend.sidebar.general')
            </li>
            <li class="nav-item">
                <a class="nav-link {{
                    active_class(Route::is('admin/dashboard'))
                }}" href="{{ route('admin.dashboard') }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    @lang('menus.backend.sidebar.dashboard')
                </a>
            </li>
            {{--  <li class="nav-title">
                Transactions
            </li>  --}}

            <li class="nav-item nav-dropdown {{
                active_class(Route::is('admin/transaction*'), 'open')
            }}">
                    <a class="nav-link nav-dropdown-toggle {{
                        active_class(Route::is('admin/transaction*'))
                    }}" href="#">
                    <i class="nav-icon fas fa-exchange-alt"></i> Transactions
                </a>

                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link {{
                        active_class(Route::is('admin/transaction/send'))
                    }}" href="{{ route('admin.transaction.send') }}">
                            Send
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{
                        active_class(Route::is('admin/transaction/receive'))
                    }}" href="{{ route('admin.transaction.receive') }}">
                            Receive
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{
                        active_class(Route::is('admin/transaction/kyc-lookup'))
                    }}" href="{{ route('admin.transaction.kyc-lookup') }}">
                            KYC Lookup
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item nav-dropdown {{
                active_class(Route::is('admin/mywu*'), 'open')
            }}">
                    <a class="nav-link nav-dropdown-toggle {{
                        active_class(Route::is('admin/transaction*'))
                    }}" href="#">
                    <i class="nav-icon fas fa-hand-holding-usd"></i> My WU&#8480;
                </a>

                <ul class="nav-dropdown-items">
                    {{-- <li class="nav-item">
                        <a class="nav-link {{
                        active_class(Route::is('admin/mywu/customer'))
                    }}" href="{{ route('admin.mywu.customer') }}">
                            Customer
                        </a>
                    </li> --}}
                    <li class="nav-item">
                        <a class="nav-link {{
                        active_class(Route::is('admin/mywu/enrollment'))
                    }}" href="{{ route('admin.mywu.enrollment') }}">
                            Enrollment
                        </a>
                    </li>
                </ul>
            </li>

            @if ($logged_in_user->isAdmin())
                <li class="nav-title">
                    @lang('menus.backend.sidebar.system')
                </li>

                <li class="nav-item nav-dropdown {{
                    active_class(Route::is('admin/auth*'), 'open')
                }}">
                    <a class="nav-link nav-dropdown-toggle {{
                        active_class(Route::is('admin/auth*'))
                    }}" href="#">
                        <i class="nav-icon far fa-user"></i>
                        @lang('menus.backend.access.title')

                        @if ($pending_approval > 0)
                            <span class="badge badge-danger">{{ $pending_approval }}</span>
                        @endif
                    </a>

                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{
                                active_class(Route::is('admin/auth/user*'))
                            }}" href="{{ route('admin.auth.user.index') }}">
                                @lang('labels.backend.access.users.management')

                                @if ($pending_approval > 0)
                                    <span class="badge badge-danger">{{ $pending_approval }}</span>
                                @endif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{
                                active_class(Route::is('admin/auth/role*'))
                            }}" href="{{ route('admin.auth.role.index') }}">
                                @lang('labels.backend.access.roles.management')
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="divider"></li>

                <li class="nav-item nav-dropdown {{
                    active_class(Route::is('admin/log-viewer*'), 'open')
                }}">
                        <a class="nav-link nav-dropdown-toggle {{
                            active_class(Route::is('admin/log-viewer*'))
                        }}" href="#">
                        <i class="nav-icon fas fa-list"></i> @lang('menus.backend.log-viewer.main')
                    </a>

                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{
                            active_class(Route::is('admin/log-viewer'))
                        }}" href="{{ route('log-viewer::dashboard') }}">
                                @lang('menus.backend.log-viewer.dashboard')
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{
                            active_class(Route::is('admin/log-viewer/logs*'))
                        }}" href="{{ route('log-viewer::logs.list') }}">
                                @lang('menus.backend.log-viewer.logs')
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
    </nav>

    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div><!--sidebar-->
