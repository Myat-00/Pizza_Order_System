<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>@yield("title")</title>

    <!-- shortcut icon -->
    <link rel="shortcut icon" href="{{asset("admin/images/icon/logo.png")}}">

    <!-- Fontfaces CSS-->
    <link href="{{asset("admin/css/font-face.css")}}" rel="stylesheet" media="all">
    <link href="{{asset("admin/vendor/font-awesome-4.7/css/font-awesome.min.css")}}" rel="stylesheet" media="all">
    <link href="{{asset("admin/vendor/font-awesome-5/css/fontawesome-all.min.css")}}" rel="stylesheet" media="all">
    <link href="{{asset("admin/vendor/mdi-font/css/material-design-iconic-font.min.css")}}" rel="stylesheet" media="all">

    <!-- Bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Bootstrap CSS-->
    <link href="{{asset("admin/vendor/bootstrap-4.1/bootstrap.min.css")}}" rel="stylesheet" media="all">

    

    <!-- Vendor CSS-->
    <link href="{{asset("admin/vendor/animsition/animsition.min.css")}}" rel="stylesheet" media="all">
    <link href="{{asset("admin/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css")}}" rel="stylesheet" media="all">
    <link href="{{asset("admin/vendor/wow/animate.css")}}" rel="stylesheet" media="all">
    <link href="{{asset("admin/vendor/css-hamburgers/hamburgers.min.css")}}" rel="stylesheet" media="all">
    <link href="{{asset("admin/vendor/slick/slick.css")}}" rel="stylesheet" media="all">
    <link href="{{asset("admin/vendor/select2/select2.min.css")}}" rel="stylesheet" media="all">
    <link href="{{asset("admin/vendor/perfect-scrollbar/perfect-scrollbar.css")}}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{asset("admin/css/theme.css")}}" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <img src="{{asset("admin/images/icon/logo.png")}}" alt="Cool Admin" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li>
                            <a href="{{route("category#list")}}">
                                <i class="fa-solid fa-list"></i>Category</a>
                        </li>
                        <li>
                            <a href="{{route("product#list")}}">
                                <i class="fa-solid fa-pizza-slice"></i>Products</a>
                        </li>
                        <li>
                            <a href="{{route("admin#orderList")}}">
                                <i class="fa-solid fa-list-check"></i>Order List</a>
                        </li>
                        <li>
                            <a href="{{route("admin#userList")}}">
                                <i class="fa-solid fa-users"></i>User List</a>
                        </li>
                        <li>
                            <a href="{{route("admin#contactList")}}">
                                <i class="fa-solid fa-blender-phone"></i>Contact List</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <span class="form-header">
                                <h4>Admin Dashboard Panel</h4>
                            </span>
                            <div class="header-button">
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        @if (Auth::user()->image==null)
                                            @if(Auth::user()->gender == "male")
                                            <div class="image">
                                                <a href="#">
                                                    <img src="{{asset("images/default_user.png")}}" class="img-thumbnail" />
                                                </a>
                                            </div>
                                            @else
                                            <div class="image">
                                                <a href="#">
                                                    <img src="{{asset("images/default_female_user.webp")}}" class="img-thumbnail" />
                                                </a>
                                            </div>
                                            @endif
                                        @else
                                            <div class="image">
                                                <img src="{{asset("storage/".Auth::user()->image)}}" class="img-thumbnail" />
                                            </div>
                                        @endif
                                        <div class="content">
                                            <a class="js-acc-btn" href="#">{{Auth::user()->name}}</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                @if (Auth::user()->image == null)
                                                    @if(Auth::user()->gender == "male")
                                                    <div class="image">
                                                        <a href="#">
                                                            <img src="{{asset("images/default_user.png")}}" class="img-thumbnail" />
                                                        </a>
                                                    </div>
                                                    @else
                                                    <div class="image">
                                                        <a href="#">
                                                            <img src="{{asset("images/default_female_user.webp")}}" class="img-thumbnail" />
                                                        </a>
                                                    </div>
                                                    @endif
                                                @else
                                                    <div class="image">
                                                        <a href="#">
                                                            <img src="{{asset("storage/".Auth::user()->image)}}" class="img-thumbnail" />
                                                        </a>
                                                    </div>
                                                @endif
                                                
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#">{{Auth::user()->name}}</a>
                                                    </h5>
                                                    <span class="email">{{Auth::user()->email}}</span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="{{route("admin#detail")}}">
                                                        <i class="fa-solid fa-user"></i>Account</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                <a href="{{route("admin#list")}}">
                                                        <i class="fa-solid fa-users"></i>Admin List</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                <a href="{{route("admin#changePasswordPage")}}">
                                                        <i class="fa-solid fa-key"></i>Change Password</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer mb-3">
                                                <form action="{{route("logout")}}" method="post">
                                                    @csrf
                                                    <button class="btn btn-dark col-12 py-2" type="submit">
                                                        <i class="fa-solid fa-right-from-bracket me-2"></i>Logout
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->

            @yield("content")
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    <!-- Fontawesom link -->
    <script src="https://kit.fontawesome.com/06eb7f290f.js" crossorigin="anonymous"></script>

    <!-- Bootstrap link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <!-- Jquery JS-->
    <script src="{{asset("admin/vendor/jquery-3.2.1.min.js")}}"></script>
    <!-- Bootstrap JS-->
    <script src="{{asset("admin/vendor/bootstrap-4.1/popper.min.js")}}"></script>
    <script src="{{asset("admin/vendor/bootstrap-4.1/bootstrap.min.js")}}"></script>
    <!-- Vendor JS       -->
    <script src="{{asset("admin/vendor/slick/slick.min.js")}}">
    </script>
    <script src="{{asset("admin/vendor/wow/wow.min.js")}}"></script>
    <script src="{{asset("admin/vendor/animsition/animsition.min.js")}}"></script>
    <script src="{{asset("admin/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js")}}">
    </script>
    <script src="{{asset("admin/vendor/counter-up/jquery.waypoints.min.js")}}"></script>
    <script src="{{asset("admin/vendor/counter-up/jquery.counterup.min.js")}}">
    </script>
    <script src="{{asset("admin/vendor/circle-progress/circle-progress.min.js")}}"></script>
    <script src="{{asset("admin/vendor/perfect-scrollbar/perfect-scrollbar.js")}}"></script>
    <script src="{{asset("admin/vendor/chartjs/Chart.bundle.min.js")}}"></script>
    <script src="{{asset("admin/vendor/select2/select2.min.js")}}">
    </script>

    <!-- Main JS-->
    <script src="{{asset("admin/js/main.js")}}"></script>

    <!-- jquery cdn -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>
@yield("scriptSection")
</html>
<!-- end document-->
