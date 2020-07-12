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
        .border{
            border-bottom:1px solid #F1F1F1;
            margin-bottom:10px;
          }
          .main-secction{
            box-shadow: 10px 10px 10px;
          }
          .image-section{
            padding: 0px;
          }
          .image-section img{
            width: 100%;
            height:250px;
            position: relative;
          }
          .user-image{
            position: absolute;
            margin-top:-50px;
          }
          .user-left-part{
            margin: 0px;
          }
          .user-image img{
            width:100px;
            height:100px;
          }
          .user-profil-part{
            padding-bottom:30px;
            background-color:#FAFAFA;
          }
          .follow{    
            margin-top:70px;   
          }
          .user-detail-row{
            margin:0px; 
          }
          .user-detail-section2 p{
            font-size:12px;
            padding: 0px;
            margin: 0px;
          }
          .user-detail-section2{
            margin-top:10px;
          }
          .user-detail-section2 span{
            color:#7CBBC3;
            font-size: 20px;
          }
          .user-detail-section2 small{
            font-size:12px;
            color:#D3A86A;
          }
          .profile-right-section{
            padding: 20px 0px 10px 15px;
            background-color: #FFFFFF;  
          }
          .profile-right-section-row{
            margin: 0px;
          }
          .profile-header-section1 h1{
            font-size: 25px;
            margin: 0px;
          }
          .profile-header-section1 h5{
            color: #0062cc;
          }
          .req-btn{
            height:30px;
            font-size:12px;
          }
          .profile-tag{
            padding: 10px;
            border:1px solid #F6F6F6;
          }
          .profile-tag p{
            font-size: 12px;
            color:black;
          }
          .profile-tag i{
            color:#ADADAD;
            font-size: 20px;
          }
          .image-right-part{
            background-color: #FCFCFC;
            margin: 0px;
            padding: 5px;
          }
          .img-main-rightPart{
            background-color: #FCFCFC;
            margin-top: auto;
          }
          .image-right-detail{
            padding: 0px;
          }
          .image-right-detail p{
            font-size: 12px;
          }
          .image-right-detail a:hover{
            text-decoration: none;
          }
          .image-right img{
            width: 100%;
          }
          .image-right-detail-section2{
            margin: 0px;
          }
          .image-right-detail-section2 p{
            color:#38ACDF;
            margin:0px;
          }
          .image-right-detail-section2 span{
            color:#7F7F7F;
          }

          .nav-link{
            font-size: 1.2em;    
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
    
    <div class="container main-secction" style="margin-top: 100px;">
        <div class="row" style="box-shadow: 0px 0px 10px 20px rgba(255,255,255,1);">
            <div class="col-md-12 col-sm-12 col-xs-12 image-section">
                <img src="public/assetF/images/bgvendor/lorem-bg.jpg" style="object-fit: cover;transform: scale(0.9);">
            </div>
            <div class="row user-left-part">
                <div class="col-md-3 col-sm-3 col-xs-12 user-profil-part pull-left">
                    <div class="row ">
                        <div class="col-md-12 col-md-12-sm-12 col-xs-12 user-image text-center">
                            <img style="width: 130px;height: 130px;transform: translateY(-18px);" src="public/assetF/images/avatar/{{ $vendor->avatar_shop }}" class="rounded-circle">
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12 user-detail-section1 text-center">
                            <button id="btn-contact" (click)="clearModal()" data-toggle="modal" data-target="#contact" class="btn btn-success btn-block follow">Contact Shop</button> 
                            <button class="btn btn-warning btn-block" style="background-color: #e6e6e6;">Follow</button>                               
                        </div>
                        <div class="row user-detail-row">
                            <div class="col-md-12 col-sm-12 user-detail-section2 pull-left" style="width: 500px;">
                            </div>                           
                        </div>
                       
                    </div>
                </div>
                <div class="col-md-9 col-sm-9 col-xs-12 pull-right profile-right-section">
                    <div class="row profile-right-section-row">
                        <div class="col-md-12 profile-header">
                            <div class="row">
                                <div class="col-md-8 col-sm-6 col-xs-6 profile-header-section1 pull-left">
                                    <h1 style="font-family: Poppins-Regular;">{{ $vendor->name_shop }}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12" style="display: grid;grid-gap: 24px;grid-template-columns: repeat(3,1fr);padding-top: 20px;">
                                    <div style="font-family: Poppins-Regular;font-size: 16px;"> Phone: {{ $vendor->phone_shop }}</div>
                                    <div style="font-family: Poppins-Regular;font-size: 16px;"> Mail: {{ $vendor->mail_shop }}</div>
                                    <div style="font-family: Poppins-Regular;font-size: 16px;"> Address: {{ $vendor->address_shop }}</div>
                                    <div style="font-family: Poppins-Regular;font-size: 16px;"> @if ( $vendor->fanpage_facebook != null  )fanpageFacebook: {{ $vendor->fanpage_facebook }}@endif</div>
                                </div>
                                </div>
                                <div class="col-md-4 img-main-rightPart">
                                    <div class="row">
                                        <div class="col-md-12">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="contact" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="contact">Contactarme</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <p for="msj">Se enviará este mensaje a la persona que desea contactar, indicando que te quieres comunicar con el. Para esto debes de ingresar tu información personal.</p>
                    </div>
                    <div class="form-group">
                        <label for="txtFullname">Nombre completo</label>
                        <input type="text" id="txtFullname" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="txtEmail">Email</label>
                        <input type="text" id="txtEmail" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="txtPhone">Teléfono</label>
                        <input type="text" id="txtPhone" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" (click)="openModal()" data-dismiss="modal">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Product -->
    <section class="bg0 p-t-23 p-b-140">
        <div class="container">
            <div class="p-b-10">
                <h3 class="ltext-103 cl5" style="padding-bottom: 20px;">
                    OUR PRODUCTS
                </h3>
            </div>
            <div class="row isotope-grid" style="margin-bottom: 20px;">
                @foreach($ours as $product)
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
                @foreach( $ours_sale as $product )
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
                @foreach( $ours_new as $product )
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