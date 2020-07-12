<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="{{asset('assetF')}}">
<!--===============================================================================================-->  
    <link rel="icon" type="image/png" href="{{('public/assetF/images/icons/favicon.png')}}"/>
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{('public/assetF/vendor/bootstrap/css/bootstrap.min.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{('public/assetF/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{('public/assetF/fonts/iconic/css/material-design-iconic-font.min.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{('public/assetF/fonts/linearicons-v1.0.0/icon-font.min.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{('public/assetF/vendor/animate/animate.css')}}">
<!--===============================================================================================-->  
    <link rel="stylesheet" type="text/css" href="{{('public/assetF/vendor/css-hamburgers/hamburgers.min.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{('public/assetF/vendor/animsition/css/animsition.min.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{('public/assetF/vendor/select2/select2.min.css')}}">
<!--===============================================================================================-->  
    <link rel="stylesheet" type="text/css" href="{{('public/assetF/vendor/daterangepicker/daterangepicker.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{('public/assetF/vendor/slick/slick.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{('public/assetF/vendor/MagnificPopup/magnific-popup.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{('public/assetF/vendor/perfect-scrollbar/perfect-scrollbar.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{('public/assetF/css/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{('public/assetF/css/main.css')}}">
<!--===============================================================================================-->
    <style type="text/css">
        ul.footer-type-products{
            display: grid;
            grid-template-columns: repeat(4,1fr);
            grid-gap: 8px;
        }
         ul.footer-cat-products{
                display: grid;
                grid-gap: 4px;
                grid-template-columns: repeat(1,1fr);
            }
        @media (max-width: 768px)
        {
            ul.footer-type-products{
                grid-template-columns: repeat(3,1fr);
                grid-gap: 4px;
            }
        }
        @media (max-width: 480px)
        {
            ul.footer-type-products{
                grid-template-columns: repeat(2,1fr);
            }

            ul.footer-cat-products{
                display: grid;
                grid-gap: 4px;
                grid-template-columns: repeat(2,1fr);
            }
        }
    </style>
</head>
<body class="animsition">
    
    <!-- Header -->
    <header>
        <!-- Header desktop -->
        <div class="container-menu-desktop">
            <!-- Topbar -->
            <div class="top-bar">
                <div class="content-topbar flex-sb-m h-full container">
                    <div class="left-top-bar">
                        
                    </div>

                    <div class="right-top-bar flex-w h-full">
                        
                            @if( Auth::check() )
                                <a href="javascript:void(0)" class="flex-c-m trans-04 p-lr-25" id="ida">
                                    {{Auth::user()->name}}
                                </a>
                            @else
                                <a href="{{route('login')}}" class="flex-c-m trans-04 p-lr-25">
                                Login / Signin
                                </a>
                            @endif

                        @if( Auth::check() )
                        <ul id="idul" style="position: absolute;top: 40px;background-color: #222;z-index: 9999;width: 128px;display: none;">
                            <li style="padding: 10px 0px 5px 25px;color: #b2b2b2;cursor: pointer;font-size: 14px;"><a href="{{route('infocustomer')}}">Info Account</a></li>
                            @if( Auth::user()->status_shop == 1  && Auth::user()->pending == 0 )
                            <li style="padding: 10px 0px 5px 25px;color: #b2b2b2;cursor: pointer;font-size: 14px;"><a href="{{route('vendor')}}">My Shop</a></li>
                            @elseif( Auth::user()->status_shop == 0 && Auth::user()->pending == 0 )
                            <li style="padding: 10px 0px 5px 25px;color: #b2b2b2;cursor: pointer;font-size: 14px;"><a href="{{route('newvendor')}}">New Shop</a></li>
                            @elseif( Auth::user()->status_shop == 0 && Auth::user()->pending == 1 )
                            <li style="padding: 10px 0px 5px 25px;color: #b2b2b2;cursor: pointer;font-size: 14px;"><a href="{{route('waitreply')}}">Wait For Reply</a></li>
                            @endif
                            <li style="padding: 10px 0px 5px 25px;color: #b2b2b2;cursor: pointer;font-size: 14px;"><a href="{{route('ordercustomer')}}">My Order</a></li>
                            <li style="padding: 5px 0px 10px 25px;color: #b2b2b2;cursor: pointer;font-size: 14px;"><a href="{{route('logout')}}">Log out</a></li>
                        </ul>
                        @endif
                    </div>
                </div>
            </div>

            <div class="wrap-menu-desktop">
                <nav class="limiter-menu-desktop container">
                    
                    <!-- Logo desktop -->       
                    <a href="{{route('index')}}" class="logo">
                        <img src="public/assetF/images/icons/logo-01.png" alt="IMG-LOGO">
                    </a>

                    <!-- Menu desktop -->
                    <div class="menu-desktop">
                        <ul class="main-menu">
                            <li class="active-menu">
                                <a href="{{route('index')}}">Home</a>
                            </li>
                            <li>
                                <a href="{{route('product')}}">Shop</a>
                            </li>
                            <li>
                                <a href="{{route('about')}}">About</a>
                            </li>
                            <li>
                                <a href="{{route('contact')}}">Contact</a>
                            </li>
                        </ul>
                    </div>  

                    <!-- Icon header -->
                    <div class="wrap-icon-header flex-w flex-r-m">
                        <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
                            <i class="zmdi zmdi-search"></i>
                        </div>

                        <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti" data-notify="{{ Cart::count() }}">
                            <a href="{{route('cart')}}"><i class="zmdi zmdi-shopping-cart"></i></a>
                        </div>

                        {{-- <a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti" data-notify="0">
                            <i class="zmdi zmdi-favorite-outline"></i>
                        </a> --}}
                    </div>
                </nav>
            </div>  
        </div>

        <!-- Header Mobile -->
        <div class="wrap-header-mobile">
            <!-- Logo moblie -->        
            <div class="logo-mobile">
                <a href="index.html"><img src="public/assetF/images/icons/logo-01.png" alt="IMG-LOGO"></a>
            </div>

            <!-- Icon header -->
            <div class="wrap-icon-header flex-w flex-r-m m-r-15">
                <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
                    <i class="zmdi zmdi-search"></i>
                </div>

                <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" data-notify="2">
                    <i class="zmdi zmdi-shopping-cart"></i>
                </div>

                <a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti" data-notify="0">
                    <i class="zmdi zmdi-favorite-outline"></i>
                </a>
            </div>

            <!-- Button show menu -->
            <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </div>
        </div>


        <!-- Menu Mobile -->
        <div class="menu-mobile">
            <ul class="topbar-mobile">
                <li style="padding:10px 0px;">
                    <div class="right-top-bar flex-w h-full">
                        @if( Auth::check() )
                            <a style="padding-left: 8px;padding-right: 16px;" href="javascript:void(0)" class="flex-c-m trans-04 p-lr-25" id="ida">
                                {{Auth::user()->name}}
                            </a>
                        @else
                            <a href="{{route('login')}}" class="flex-c-m trans-04 p-lr-25">
                            Login / Signin
                            </a>
                        @endif
                        @if( Auth::check() )
                        <ul style="position: absolute;top: 40px;background-color: #222;z-index: 9999;width: fit-content;display: flex;left: 20%;top: 72px;overflow-x: hidden;">
                            <li style="padding:8px 4px;color: #b2b2b2;cursor: pointer;font-size: 14px;text-align: center;"><a href="{{route('infocustomer')}}">Info Account</a></li>
                            @if( Auth::user()->status_shop == 1  && Auth::user()->pending == 0 )
                            <li style="padding:8px 4px;color: #b2b2b2;cursor: pointer;font-size: 14px;"><a href="{{route('vendor')}}">My Shop</a></li>
                            @elseif( Auth::user()->status_shop == 0 && Auth::user()->pending == 0 )
                            <li style="padding:8px 4px;color: #b2b2b2;cursor: pointer;font-size: 14px;"><a href="{{route('newvendor')}}">New Shop</a></li>
                            @elseif( Auth::user()->status_shop == 0 && Auth::user()->pending == 1 )
                            <li style="padding:8px 4px;color: #b2b2b2;cursor: pointer;font-size: 14px;"><a href="{{route('waitreply')}}">Wait For Reply</a></li>
                            @endif
                            <li style="padding:8px 4px;color: #b2b2b2;cursor: pointer;font-size: 14px;"><a href="{{route('ordercustomer')}}">My Order</a></li>
                            <li style="padding:8px 4px;color: #b2b2b2;cursor: pointer;font-size: 14px;"><a href="{{route('logout')}}">Log out</a></li>
                        </ul>
                        @endif
                    </div>
                </li>
            </ul>

            <ul class="main-menu-m">
                <li >
                    <a href="{{route('index')}}">Home</a>
                </li>
                <li>
                    <a href="{{route('product')}}">Shop</a>
                </li>
                <li>
                    <a href="{{route('about')}}">About</a>
                </li>
                <li>
                    <a href="{{route('contact')}}">Contact</a>
                </li>
            </ul>
        </div>

        <!-- Modal Search -->
        <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
            <div class="container-search-header">
                <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                    <img src="public/assetF/images/icons/icon-close2.png" alt="CLOSE">
                </button>

                <form class="wrap-search-header flex-w p-l-15">
                    <button class="flex-c-m trans-04">
                        <i class="zmdi zmdi-search"></i>
                    </button>
                    <input class="plh3" type="text" name="search" placeholder="Search...">
                </form>
            </div>
        </div>
    </header>

    <!-- Cart -->
    <div class="wrap-header-cart js-panel-cart">
        <div class="s-full js-hide-cart"></div>
    </div>
    @yield('content')
    <!-- Footer -->
    <footer class="bg3 p-t-75 p-b-32">
        <div class="container">
            <div class="row">
                <div class="col-sm-3 col-lg-3 p-b-50">
                    <h4 class="stext-301 cl0 p-b-30">
                        Categories Product
                    </h4>

                    <ul class="footer-cat-products">
                        @foreach( $cats as $cat )
                        <li class="p-b-10">
                            <a href="{{ route('categoryproduct',$cat->slug) }}" class="stext-107 cl7 hov-cl1 trans-04">
                                {{ $cat->name }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <div class="col-sm-9 col-lg-9 p-b-50">
                    <h4 class="stext-301 cl0 p-b-30">
                        Type
                    </h4>

                    <ul class="footer-type-products">
                        @foreach( $types as $type )
                        <li class="p-b-10">
                            <a href="{{ route('typeproduct',$type->slug) }}" class="stext-107 cl7 hov-cl1 trans-04">
                                {{ $type->name }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <div class="col-sm-6 col-lg-6 p-b-50">
                    <h4 class="stext-301 cl0 p-b-30">
                        GET IN TOUCH
                    </h4>

                    <p class="stext-107 cl7 size-201">
                        Any questions? Let us know in store at 8th floor, 379 Hudson St, New York, NY 10018 or call us on (+0) 070 2581 905
                    </p>

                    <div class="p-t-27">
                        <a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                            <i class="fa fa-facebook"></i>
                        </a>

                        <a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                            <i class="fa fa-instagram"></i>
                        </a>

                        <a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                            <i class="fa fa-pinterest-p"></i>
                        </a>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-6 p-b-50" style="display: none;">
                    <h4 class="stext-301 cl0 p-b-30">
                        Newsletter
                    </h4>

                    <form>
                        <div class="wrap-input1 w-full p-b-4">
                            <input class="input1 bg-none plh1 stext-107 cl7" type="text" name="email" placeholder="email@example.com">
                            <div class="focus-input1 trans-04"></div>
                        </div>

                        <div class="p-t-18">
                            <button class="flex-c-m stext-101 cl0 size-103 bg1 bor1 hov-btn2 p-lr-15 trans-04">
                                Subscribe
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="p-t-40">
                <div class="flex-c-m flex-w p-b-18" style="display: none;">
                    <a href="#" class="m-all-1">
                        <img src="public/assetF/images/icons/icon-pay-01.png" alt="ICON-PAY">
                    </a>

                    <a href="#" class="m-all-1">
                        <img src="public/assetF/images/icons/icon-pay-02.png" alt="ICON-PAY">
                    </a>

                    <a href="#" class="m-all-1">
                        <img src="public/assetF/images/icons/icon-pay-03.png" alt="ICON-PAY">
                    </a>

                    <a href="#" class="m-all-1">
                        <img src="public/assetF/images/icons/icon-pay-04.png" alt="ICON-PAY">
                    </a>

                    <a href="#" class="m-all-1">
                        <img src="public/assetF/images/icons/icon-pay-05.png" alt="ICON-PAY">
                    </a>
                </div>

                <p class="stext-107 cl6 txt-center">
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> Build <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://www.facebook.com/nguyentran.thienphuc.7" target="_blank">Phung Nguyenx</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->

                </p>
            </div>
        </div>
    </footer>


    <!-- Back to top -->
    <div class="btn-back-to-top" id="myBtn">
        <span class="symbol-btn-back-to-top">
            <i class="zmdi zmdi-chevron-up"></i>
        </span>
    </div>

<!--===============================================================================================-->  
    <script src="{{('public/assetF/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
    <script src="{{('public/assetF/vendor/animsition/js/animsition.min.js')}}"></script>
<!--===============================================================================================-->
    <script src="{{('public/assetF/vendor/bootstrap/js/popper.js')}}"></script>
    <script src="{{('public/assetF/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
    <script src="{{('public/assetF/vendor/select2/select2.min.js')}}"></script>
    <script>
        $(".js-select2").each(function(){
            $(this).select2({
                minimumResultsForSearch: 20,
                dropdownParent: $(this).next('.dropDownSelect2')
            });
        })
        $('#h2log').fadeOut(6000, "linear");
        $('#h22log').fadeOut(6000, "linear");
    </script>
<!--===============================================================================================-->
    <script src="{{('public/assetF/vendor/daterangepicker/moment.min.js')}}"></script>
    <script src="{{('public/assetF/vendor/daterangepicker/daterangepicker.js')}}"></script>
<!--===============================================================================================-->
    <script src="{{('public/assetF/vendor/slick/slick.min.js')}}"></script>
    <script src="{{('public/assetF/js/slick-custom.js')}}"></script>
<!--===============================================================================================-->
    <script src="{{('public/assetF/vendor/parallax100/parallax100.js')}}"></script>
    <script>
        $('.parallax100').parallax100();
    </script>
<!--===============================================================================================-->
    <script src="{{('public/assetF/vendor/MagnificPopup/jquery.magnific-popup.min.js')}}"></script>
    <script>
        $('.gallery-lb').each(function() { // the containers for all your galleries
            $(this).magnificPopup({
                delegate: 'a', // the selector for gallery item
                type: 'image',
                gallery: {
                    enabled:true
                },
                mainClass: 'mfp-fade'
            });
        });
    </script>
<!--===============================================================================================-->
    <script src="{{('public/assetF/vendor/isotope/isotope.pkgd.min.js')}}"></script>
<!--===============================================================================================-->
    <script src="{{('public/assetF/vendor/sweetalert/sweetalert.min.js')}}"></script>
    <script>
        $('.js-addwish-b2').on('click', function(e){
            e.preventDefault();
        });

        $('.js-addwish-b2').each(function(){
            var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
            $(this).on('click', function(){
                swal(nameProduct, "is added to wishlist !", "success");

                $(this).addClass('js-addedwish-b2');
                $(this).off('click');
            });
        });

        $('.js-addwish-detail').each(function(){
            var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

            $(this).on('click', function(){
                swal(nameProduct, "is added to wishlist !", "success");

                $(this).addClass('js-addedwish-detail');
                $(this).off('click');
            });
        });

        $('#ida').click(function(){
            $('#idul').toggle('slow');
        });
        /*---------------------------------------------*/

    
    </script>
<!--===============================================================================================-->
    <script src="{{('public/assetF/vendor/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script>
        $('.js-pscroll').each(function(){
            $(this).css('position','relative');
            $(this).css('overflow','hidden');
            var ps = new PerfectScrollbar(this, {
                wheelSpeed: 1,
                scrollingThreshold: 1000,
                wheelPropagation: false,
            });

            $(window).on('resize', function(){
                ps.update();
            })
        });
    </script>
<!--===============================================================================================-->
    <script src="{{('public/assetF/js/main.js')}}"></script>

</body>
</html>