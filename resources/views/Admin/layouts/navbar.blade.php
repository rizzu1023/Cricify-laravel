<!-- Page Header Start-->
<div class="page-header">
            <div class="header-wrapper row m-0">
                <form class="form-inline search-full" action="#" method="get">
                    <div class="form-group w-100">
                        <div class="Typeahead Typeahead--twitterUsers">
                            <div class="u-posRelative">
                                <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text"
                                    placeholder="Search Cuba .." name="q" title="" autofocus>
                                <div class="spinner-border Typeahead-spinner" role="status"><span
                                        class="sr-only">Loading...</span></div><i class="close-search"
                                    data-feather="x"></i>
                            </div>
                            <div class="Typeahead-menu"></div>
                        </div>
                    </div>
                </form>
                <div class="header-logo-wrapper">
                    <div class="logo-wrapper"><a href="index.html"><img class="img-fluid"
                                src="{{asset('Assets/Admin//images/logo/logo.png')}}" alt=""></a></div>
                    <div class="toggle-sidebar"><i class="status_toggle middle" data-feather="grid" id="sidebar-toggle">
                        </i></div>
                </div>
                <div class="left-header col horizontal-wrapper pl-0">
                    <ul class="horizontal-menu">
                        <li class="mega-menu">
                            <div class="mega-menu-container nav-submenu">
                                <div class="container-fluid">
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="nav-right col-8 text-right pull-right right-header p-0">
                    <ul class="nav-menus">
                        {{-- <li class="onhover-dropdown">
                            <div class="notification-box"><i data-feather="bell"></i><span
                                    class="badge badge-pill badge-secondary">4</span></div>
                            <ul class="notification-dropdown onhover-show-div">
                                <li class="bg-primary text-center">
                                    <h6 class="f-18 mb-0">Notitication</h6>
                                    <p class="mb-0">You have 4 new notification</p>
                                </li>
                                <li>
                                    <p><i class="fa fa-circle-o mr-3 font-primary"> </i>Delivery processing <span
                                            class="pull-right">10 min.</span></p>
                                </li>
                                <li>
                                    <p><i class="fa fa-circle-o mr-3 font-success"></i>Order Complete<span
                                            class="pull-right">1 hr</span></p>
                                </li>
                                <li>
                                    <p><i class="fa fa-circle-o mr-3 font-info"></i>Tickets Generated<span
                                            class="pull-right">3 hr</span></p>
                                </li>
                                <li>
                                    <p><i class="fa fa-circle-o mr-3 font-danger"></i>Delivery Complete<span
                                            class="pull-right">6 hr</span></p>
                                </li>
                                <li><a class="btn btn-primary" href="#">Check all notification</a></li>
                            </ul>
                        </li> --}}
                        <li>
                            <div class="mode"><i class="fa fa-moon-o"></i></div>
                        </li>
                        <li>
                            <div class="refresh"><i data-feather="refresh-ccw"></i></div>
                        </li>

                        {{-- <li class="onhover-dropdown"><i data-feather="message-square"></i>
                            <ul class="chat-dropdown onhover-show-div">
                                <li class="bg-primary text-center">
                                    <h6 class="f-18 mb-0">Message Box</h6>
                                    <p class="mb-0">You have 3 new messages </p>
                                </li>
                                <li>
                                    <div class="media"><img class="img-fluid rounded-circle mr-3"
                                            src="{{asset('Assets/Admin//images/user/1.jpg')}}" alt="">
                                        <div class="status-circle online"></div>
                                        <div class="media-body"><span>Erica Hughes</span>
                                            <p>Lorem Ipsum is simply dummy...</p>
                                        </div>
                                        <p class="f-12 font-success">58 mins ago</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="media"><img class="img-fluid rounded-circle mr-3"
                                            src="{{asset('Assets/Admin//images/user/2.jpg')}}" alt="">
                                        <div class="status-circle online"></div>
                                        <div class="media-body"><span>Kori Thomas</span>
                                            <p>Lorem Ipsum is simply dummy...</p>
                                        </div>
                                        <p class="f-12 font-success">1 hr ago</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="media"><img class="img-fluid rounded-circle mr-3"
                                            src="{{asset('Assets/Admin//images/user/4.jpg')}}" alt="">
                                        <div class="status-circle offline"></div>
                                        <div class="media-body"><span>Ain Chavez</span>
                                            <p>Lorem Ipsum is simply dummy...</p>
                                        </div>
                                        <p class="f-12 font-danger">32 mins ago</p>
                                    </div>
                                </li>
                                <li class="text-center"> <a class="btn btn-primary" href="#">View All </a></li>
                            </ul>
                        </li> --}}
{{--                        <li class="maximize"><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i--}}
{{--                                    data-feather="maximize"></i></a></li>--}}
                        <li class="profile-nav onhover-dropdown p-0 mr-0">
                            <div class="media profile-media"><img class="b-r-10"
                                    src="{{asset('Assets/Admin//images/dashboard/wanc_logo.jpeg')}}" alt="" width="38px">
                                <div class="media-body"><span>CRICIFY</span>
                                    <p class="mb-0 font-roboto">Admin <i class="middle fa fa-angle-down"></i></p>
                                </div>
                            </div>
                            <ul class="profile-dropdown onhover-show-div">
                                <li><i data-feather="user"></i><span>Account </span></li>
                                <li><i data-feather="mail"></i><span>Inbox</span></li>
                                <li><i data-feather="file-text"></i><span>Taskboard</span></li>
                                <li><i data-feather="settings"></i><span>Settings</span></li>
                                <li><i data-feather="log-in"> </i><span>Log in</span></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <script id="result-template" type="text/x-handlebars-template">
                    <div class="ProfileCard u-cf">
            <div class="ProfileCard-avatar">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>
            <div class="ProfileCard-details">
            <div class="ProfileCard-realName"></div>
            </div>
            </div>
          </script>
                <script id="empty-template" type="text/x-handlebars-template">
                    <div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div>
                </script>
            </div>
        </div>
        <!-- Page Header Ends                              -->
