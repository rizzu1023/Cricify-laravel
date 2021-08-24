<!-- Page Sidebar Start-->
<div class="sidebar-wrapper">
    <div class="logo-wrapper" style="box-shadow: none"><a href="/admin/"><img class="b-r-10"
                                                                              src="{{asset('assets/Admin/images/dashboard/cricify_logo_dark.png')}}" alt="" width="38px"></a></div>
    <div class="logo-icon-wrapper"><a href="/admin/dashboard"><img class="b-r-10"
                                                                   src="{{asset('assets/Admin/images/dashboard/cricify_logo_dark.png')}}" alt="" width="38px"></a></div>
    <nav>
        <div class="sidebar-main">
            <div id="sidebar-menu">
                <ul class="sidebar-links custom-scrollbar">
                    <li class="back-btn">
                        <div class="mobile-back text-right"><span>Back</span><i
                                class="fa fa-angle-right pl-2" aria-hidden="true"></i></div>
                    </li>
                    <li class="sidebar-list"><a class="nav-link " href="/admin/dashboard">
                            <i data-feather="home"></i><span>Dashboard</span></a></li>
                    <li class="sidebar-list">
                        <a class="nav-link  " href="/admin/Tournament"><i
                                data-feather="truck"></i><span>Tournaments</span></a>
                    </li>
                    <li class="sidebar-list">
                        <a class="nav-link  " href="/admin/player"><i data-feather="users"></i><span>Players</span></a>
                    </li>
                    {{--                    <li class="sidebar-list">--}}
                    {{--                        <a class="nav-link  " href="/admin/teams"><i data-feather="users"></i><span>Teams</span></a>--}}
                    {{--                    </li>--}}
                    @auth
                        @if(auth()->user()->is_super_admin)
                            <li class="sidebar-list">
                                <a class="nav-link  " href="/super-admin/feedbacks"><i data-feather="message-circle"></i><span>Feedbacks</span></a>
                            </li>
                            <li class="sidebar-list"><a class="nav-link  " href="/super-admin/advertise"><i data-feather="paperclip"></i><span>Advertise</span></a>
                            </li>
                            <li class="sidebar-list"><a class="nav-link  " href="/super-admin/users"><i data-feather="users"></i><span>Users</span></a>
                            </li>
                            <li class="sidebar-list"><a class="nav-link  " href="/super-admin/app-users"><i data-feather="users"></i><span>App Users</span></a>
                            </li>
                        @endif
                    @endauth


                    <li class="sidebar-list">
                        <a class="nav-link"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                           href="{{ route('logout' ) }}"><i data-feather="log-out"></i><span>Log out</span></a>
                        <form method="POST" id="logout-form" action="{{ Route('logout') }}">
                            @csrf
                        </form>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
</div>
<!-- Page Sidebar Ends-->



