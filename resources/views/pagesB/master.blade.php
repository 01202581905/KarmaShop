<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title_admin')</title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="{{asset('assetB')}}">
    <link rel="apple-touch-icon" href="{{('public/assetF/images/icons/favicon.png')}}">
    <link rel="shortcut icon" href="{{('public/assetF/images/icons/favicon.png')}}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="{{('public/assetB/assets/css/cs-skin-elastic.css')}}">
    <link rel="stylesheet" href="{{('public/assetB/assets/css/style.css')}}">
    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
    <link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/weathericons@2.1.0/css/weather-icons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" rel="stylesheet" />

   <style>
    #weatherWidget .currentDesc {
        color: #ffffff!important;
    }
        .traffic-chart {
            min-height: 335px;
        }
        #flotPie1  {
            height: 150px;
        }
        #flotPie1 td {
            padding:3px;
        }
        #flotPie1 table {
            top: 20px!important;
            right: -10px!important;
        }
        .chart-container {
            display: table;
            min-width: 270px ;
            text-align: left;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        #flotLine5  {
             height: 105px;
        }

        #flotBarChart {
            height: 150px;
        }
        #cellPaiChart{
            height: 160px;
        }

    </style>
</head>

<body>
    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav" style="margin-top: 20px;">
                    <li class="menu-item">
                        <a href="{{ route('serverindex') }}" class="dropdown-toggle" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Overview</a>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Manager Order</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-table"></i><a href="{{route('managerorderwait')}}">Order Pending</a></li>
                            <li><i class="fa fa-table"></i><a href="{{route('managerordership')}}">Order Being Delivered</a></li>
                            <li><i class="fa fa-table"></i><a href="{{route('managerorderdelivered')}}">Order Delivered</a></li>
                            <li><i class="fa fa-table"></i><a href="{{route('managerordercancel')}}">Order Has   Canceled</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>Manager Shops</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-street-view"></i><a href="{{route('managershop')}}">All Shop</a></li>
                            <li><i class="menu-icon fa fa-street-view"></i><a href="{{route('managershoplock')}}">Shop Locked</a></li>
                            <li><i class="menu-icon fa fa-street-view"></i><a href="{{route('managershopsuggest')}}">Suggest Open Shop</a></li>
                        </ul>
                    </li>
                    <li class="menu-item">
                        <a href="{{route('managerrevenue')}}" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-bar-chart"></i>Chart Revenue</a>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>My Store</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-map-o"></i><a href="{{route('informyshop')}}">Info My Store</a></li>
                            <li><i class="menu-icon fa fa-street-view"></i><a href="{{route('myproductshop')}}">My Product</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-glass"></i>Statistical Product</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-sign-in"></i><a href="{{route('managerallproduct')}}">All Product</a></li>
                            <li><i class="menu-icon fa fa-sign-in"></i><a href="{{route('managerallproductlock')}}">Product Locked</a></li>
                            <li><i class="menu-icon fa fa-paper-plane"></i><a href="{{route('managerallproductreport')}}">Product Reported</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-glass"></i>Manager Category</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-sign-in"></i><a href="{{route('managercatproduct')}}">Category Product</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-glass"></i>Manager User</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-sign-in"></i><a href="{{route('manageralluser')}}">All User</a></li>
                            <li><i class="menu-icon fa fa-sign-in"></i><a href="{{route('manageralluserlock')}}">User Locked</a></li>
                        </ul>
                    </li>
                    <li class="menu-item">
                        <a href="{{route('managercontact')}}" class="dropdown-toggle" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-bar-chart"></i>Contact</a>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>
    <!-- /#left-panel -->
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                    <a class="navbar-brand" href="./"><img src="public/assetF/images/icons/logo-01.png" alt="Logo"></a>
                    <a class="navbar-brand hidden" href="./"><img src="public/assetB/images/logo2.png" alt="Logo"></a>
                    <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
                </div>
            </div>
            <div class="top-right">
                <div class="header-menu">
                    <div class="header-left">
                        <div class="dropdown for-notification">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bell"></i>
                                <span class="count bg-danger">3</span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="notification">
                                <p class="red">You have 3 Notification</p>
                                <a class="dropdown-item media" href="#">
                                    <i class="fa fa-check"></i>
                                    <p>Server #1 overloaded.</p>
                                </a>
                                <a class="dropdown-item media" href="#">
                                    <i class="fa fa-info"></i>
                                    <p>Server #2 overloaded.</p>
                                </a>
                                <a class="dropdown-item media" href="#">
                                    <i class="fa fa-warning"></i>
                                    <p>Server #3 overloaded.</p>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar"  src="public/assetF/images/avatar/{{ Auth::user()->avatar }}" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="{{ route('informyshop') }}"><i class="fa fa- user"></i>My Profile</a>

                            <a class="nav-link" href="#"><i class="fa fa- user"></i>Notifications <span class="count">13</span></a>
                            <a class="nav-link" href="{{ route('logoutadmin') }}"><i class="fa fa- user"></i>Logout</a>
                        </div>
                    </div>

                </div>
            </div>
        </header>
        <!-- /#header -->
        <!-- Content -->
        @yield('contentserver')
        <!-- /.content -->
        <!-- /.site-footer -->
    </div>
    <!-- /#right-panel -->

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="{{('public/assetB/assets/js/main.js')}}"></script>
    <script src="{{('public/assets/js/init/chartjs-init.js')}}"></script>

    <!--  Chart js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.bundle.min.js"></script>

    <!--Chartist Chart-->
    <script src="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartist-plugin-legend@0.6.2/chartist-plugin-legend.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery.flot@0.8.3/jquery.flot.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flot-pie@1.0.0/src/jquery.flot.pie.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flot-spline@0.0.1/js/jquery.flot.spline.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/simpleweather@3.1.0/jquery.simpleWeather.min.js"></script>
    <script src="{{('public/assetB/assets/js/init/weather-init.js')}}"></script>

    <script src="https://cdn.jsdelivr.net/npm/moment@2.22.2/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.js"></script>
    <script src="{{('public/assetB/assets/js/init/fullcalendar-init.js')}}"></script>

    <!--Local Stuff-->
    <script>
        jQuery(document).ready(function($) {
            
        jQuery('.classtoggle h6').click(function(){
            jQuery(this).parent().find('div').toggle('slow');
        });
            "use strict";

            // Pie chart flotPie1
            var piedata = [
                { label: "Desktop visits", data: [[1,32]], color: '#5c6bc0'},
                { label: "Tab visits", data: [[1,33]], color: '#ef5350'},
                { label: "Mobile visits", data: [[1,35]], color: '#66bb6a'}
            ];

            $.plot('#flotPie1', piedata, {
                series: {
                    pie: {
                        show: true,
                        radius: 1,
                        innerRadius: 0.65,
                        label: {
                            show: true,
                            radius: 2/3,
                            threshold: 1
                        },
                        stroke: {
                            width: 0
                        }
                    }
                },
                grid: {
                    hoverable: true,
                    clickable: true
                }
            });
            // Pie chart flotPie1  End
            // cellPaiChart
            var cellPaiChart = [
                { label: "Direct Sell", data: [[1,65]], color: '#5b83de'},
                { label: "Channel Sell", data: [[1,35]], color: '#00bfa5'}
            ];
            $.plot('#cellPaiChart', cellPaiChart, {
                series: {
                    pie: {
                        show: true,
                        stroke: {
                            width: 0
                        }
                    }
                },
                legend: {
                    show: false
                },grid: {
                    hoverable: true,
                    clickable: true
                }

            });
            // cellPaiChart End
            // Line Chart  #flotLine5
            var newCust = [[0, 3], [1, 5], [2,4], [3, 7], [4, 9], [5, 3], [6, 6], [7, 4], [8, 10]];

            var plot = $.plot($('#flotLine5'),[{
                data: newCust,
                label: 'New Data Flow',
                color: '#fff'
            }],
            {
                series: {
                    lines: {
                        show: true,
                        lineColor: '#fff',
                        lineWidth: 2
                    },
                    points: {
                        show: true,
                        fill: true,
                        fillColor: "#ffffff",
                        symbol: "circle",
                        radius: 3
                    },
                    shadowSize: 0
                },
                points: {
                    show: true,
                },
                legend: {
                    show: false
                },
                grid: {
                    show: false
                }
            });
            // Line Chart  #flotLine5 End
            //Traffic chart chart-js
            //Traffic chart chart-js  End
            // Bar Chart #flotBarChart
            $.plot("#flotBarChart", [{
                data: [[0, 18], [2, 8], [4, 5], [6, 13],[8,5], [10,7],[12,4], [14,6],[16,15], [18, 9],[20,17], [22,7],[24,4], [26,9],[28,11]],
                bars: {
                    show: true,
                    lineWidth: 0,
                    fillColor: '#ffffff8a'
                }
            }], {
                grid: {
                    show: false
                }
            });
            // Bar Chart #flotBarChart End
        });
    </script>
</body>
</html>
