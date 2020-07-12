@extends('pagesF.master')
@section('title')
Home | COZA 
@endsection
@section('content')
    <style>
        #h2log, #h22log{
            width: 60%;
            -webkit-animation-name: scrolldiv;
            -webkit-animation-duration: 2.5s;  /* Safari 4.0 - 8.0 */  
            -webkit-animation-fill-mode: forwards; /* Safari 4.0 - 8.0 */
            animation-fill-mode: forwards;
            animation-name: scrolldiv;
        }

        @-webkit-keyframes scrolldiv {
            from {top: 0px;}
            to {top: 40%;}
        }

        @keyframes scrolldiv {
            from {top: 0px;}
            to {top: 40%;;}
        }

    </style>
    <!-- Slider -->
    @if( Session('exactly') )
    <div style="position: relative;z-index: 9999;left: 20%;" id="h2log">
        <h2 style="font-family: sans-serif;text-align: center;color: #4CAF50;padding: 20px 40px;background-color: #FFFFFF;border-radius: 5px;font-size: 36px;">{{session('exactly')}}</h2>
    </div>
    @endif
    @if( Session('goodbye') )
    <div style="position: relative;z-index: 9999;left: 20%;" id="h22log">
        <h2 style="font-family: sans-serif;text-align: center;color: #4CAF50;padding: 20px 40px;background-color: #FFFFFF;border-radius: 5px;font-size: 36px;">{{session('goodbye')}}</h2>
    </div>
    @endif
    
    <section class="section-slide">
        <div class="wrap-slick1">
            <div class="slick1">
                <div class="item-slick1" style="background-image: url(public/assetF/images/slide-01.jpg);">
                    <div class="container h-full">
                        <div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
                        </div>
                    </div>
                </div>

                <div class="item-slick1" style="background-image: url(public/assetF/images/slide-02.jpg);">
                    <div class="container h-full">
                        <div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
                        </div>
                    </div>
                </div>

                <div class="item-slick1" style="background-image: url(public/assetF/images/slide-03.jpg);">
                    <div class="container h-full">
                        <div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Product -->
    <section class="bg0 p-t-23 p-b-140">
        <div class="container">
            <div class="p-b-10">
                <h3 class="ltext-103 cl5" style="padding-bottom: 20px;">
                    Selling products
                </h3>
            </div>
            <div class="row isotope-grid" style="margin-bottom: 20px;">
                @foreach($selling as $product)
                <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
                    <!-- Block2 -->
                    <div class="block2">
                        <a href="{{route('detailproduct',$product->slug)}}">
                        <div class="block2-pic hov-img0">
                            <img src="public/assetF/images/{{$product->image}}" alt="IMG-PRODUCT">
                        </div>
                        </a>
                        <div class="block2-txt flex-w flex-t p-t-14">
                            <div class="block2-txt-child1 flex-col-l ">
                                <a href="{{route('detailproduct',$product->slug)}}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                    {{$product->name}}
                                
                                <div style="width: 100%;display: grid;grid-template-columns: repeat(2,1fr);">
                                    @if( $product->promotional != 0 )
                                        <span class="stext-105 cl3" style="color: #ff0000;text-decoration: line-through;">
                                            ${{$product->price}}
                                        </span>
                                        <span class="stext-105 cl3" >
                                            ${{$product->promotional}}
                                        </span>
                                    @else
                                        <span class="stext-105 cl3" >
                                            ${{$product->price}}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="block2-txt-child2 flex-r p-t-3">
                                <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                                    <img class="icon-heart1 dis-block trans-04" src="public/assetF/images/icons/icon-heart-01.png" alt="ICON">
                                    <img class="icon-heart2 dis-block trans-04 ab-t-l" src="public/assetF/images/icons/icon-heart-02.png" alt="ICON">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="p-b-10">
                <h3 class="ltext-103 cl5" style="padding-bottom: 20px;">
                   Sale Products
                </h3>
            </div>
            <div class="row isotope-grid" style="margin-bottom: 20px;">
                @foreach( $sale as $product )
                <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
                    <!-- Block2 -->
                    <div class="block2">
                        <a href="{{route('detailproduct',$product->slug)}}">
                        <div class="block2-pic hov-img0">
                            <img src="public/assetF/images/{{$product->image}}" alt="IMG-PRODUCT">
                        </div>
                        </a>
                        <div class="block2-txt flex-w flex-t p-t-14">
                            <div class="block2-txt-child1 flex-col-l ">
                                <a href="{{route('detailproduct',$product->slug)}}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                    {{$product->name}}
                                </a>
                                <div style="width: 100%;display: grid;grid-template-columns: repeat(2,1fr);">
                                    @if( $product->promotional != 0 )
                                        <span class="stext-105 cl3" style="color: #ff0000;text-decoration: line-through;">
                                            ${{$product->price}}
                                        </span>
                                        <span class="stext-105 cl3" >
                                            ${{$product->promotional}}
                                        </span>
                                    @else
                                        <span class="stext-105 cl3" >
                                            ${{$product->price}}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="block2-txt-child2 flex-r p-t-3">
                                <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                                    <img class="icon-heart1 dis-block trans-04" src="public/assetF/images/icons/icon-heart-01.png" alt="ICON">
                                    <img class="icon-heart2 dis-block trans-04 ab-t-l" src="public/assetF/images/icons/icon-heart-02.png" alt="ICON">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="p-b-10">
                <h3 class="ltext-103 cl5" style="padding-bottom: 20px;">
                   New Products
                </h3>
            </div>
            <div class="row isotope-grid" style="margin-bottom: 20px;">
                @foreach( $new as $product )
                <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
                    <!-- Block2 -->
                    <div class="block2">
                        <a href="{{route('detailproduct',$product->slug)}}">
                        <div class="block2-pic hov-img0">
                            <img src="public/assetF/images/{{$product->image}}" alt="IMG-PRODUCT">
                        </div>
                        </a>
                        <div class="block2-txt flex-w flex-t p-t-14">
                            <div class="block2-txt-child1 flex-col-l ">
                                <a href="{{route('detailproduct',$product->slug)}}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                    {{$product->name}}
                                </a>
                                <div style="width: 100%;display: grid;grid-template-columns: repeat(2,1fr);">
                                    @if( $product->promotional != 0 )
                                        <span class="stext-105 cl3" style="color: #ff0000;text-decoration: line-through;">
                                            ${{$product->price}}
                                        </span>
                                        <span class="stext-105 cl3" >
                                            ${{$product->promotional}}
                                        </span>
                                    @else
                                        <span class="stext-105 cl3" >
                                            ${{$product->price}}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="block2-txt-child2 flex-r p-t-3">
                                <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                                    <img class="icon-heart1 dis-block trans-04" src="public/assetF/images/icons/icon-heart-01.png" alt="ICON">
                                    <img class="icon-heart2 dis-block trans-04 ab-t-l" src="public/assetF/images/icons/icon-heart-02.png" alt="ICON">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <!-- Load more -->
            <div class="flex-c-m flex-w w-full p-t-45">
                <a href="{{route('product')}}" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
                    See More
                </a>
            </div>
        </div>
    </section>
@endsection