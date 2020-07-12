@section('title')
Detail Product  | COZA
@endsection
@extends('pagesF.master')
@section('content')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <div class="container mycontainer" style="margin-top: 60px;">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="{{ route('index') }}" class="stext-109 cl8 hov-cl1 trans-04">
                Home
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <a href="{{ route('categoryproduct',$detail_product->slugcat) }}" class="stext-109 cl8 hov-cl1 trans-04">
                {{ $detail_product->namecat }}
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
                {{$detail_product->name}}
            </span>
        </div>
    </div>
        

    <!-- Product Detail -->
    <section class="sec-product-detail bg0 p-t-65 p-b-60">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-7 p-b-30">
                    <div class="p-l-25 p-r-30 p-lr-0-lg">
                        <div class="wrap-slick3 flex-sb flex-w">
                            <div class="wrap-slick3-dots"></div>
                            <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>
                            
                            <div class="slick3 gallery-lb">
                                <div class="item-slick3" data-thumb="public/assetF/images/{{$detail_product->image}}">
                                    <div class="wrap-pic-w pos-relative">
                                        <img id="imgproduct" src="public/assetF/images/{{$detail_product->image}}" alt="IMG-PRODUCT">

                                        <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="public/assetF/images/{{$detail_product->image}}">
                                            <i class="fa fa-expand"></i>
                                        </a>
                                    </div>
                                </div>
                                @if( $listimg[0] != null )
                                @foreach( $listimg as $imgurl )
                                <div class="item-slick3" data-thumb="public/assetF/images/{{$imgurl}}">
                                    <div class="wrap-pic-w pos-relative">
                                        <img id="imgproduct" src="public/assetF/images/{{$imgurl}}" alt="IMG-PRODUCT">

                                        <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="public/assetF/images/{{$imgurl}}">
                                            <i class="fa fa-expand"></i>
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                                @endif
                            </div>
                            
                        </div>
                    </div>
                </div>
                    
                <div class="col-md-6 col-lg-5 p-b-30">
                    <div class="p-r-50 p-t-5 p-lr-0-lg">
                        <p id="js-id-product" style="display: none;">{{ $detail_product->id }}</p>
                        <p id="js-id-vendor" style="display: none;">{{ $detail_product->id_vendor }}</p>
                        <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                            {{$detail_product->name}}
                        </h4>
                        <div style="padding-bottom: 10px;">
                        <span class="fs-18 cl11">
                            @for( $i = 1;$i <= 5; $i++ )
                                @if( $i <= $avg_rate )
                                <i class="zmdi zmdi-star"></i>
                                @else
                                <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                @endif
                            @endfor
                        </span>
                        ({{ count($countcmt) }})
                        </div>
                        @if( $detail_product->promotional != 0 )
                            <span class="stext-105 cl2" style="color: #ff0000;text-decoration: line-through;margin-right: 30px;">
                                ${{$detail_product->price}}
                            </span>
                            <span id="priceproduct" data="{{$detail_product->promotional}}" class="stext-105 cl2">
                                ${{$detail_product->promotional}}
                            </span>
                        @else
                            <span id="priceproduct" data="{{$detail_product->price}}" class="stext-105 cl2">
                                ${{$detail_product->price}}
                            </span>
                        @endif

                        <p class="stext-102 cl3 p-t-23">
                            {{$detail_product->content}}
                        </p>
                        <!--  -->
                        <div class="p-t-33">
                            <div class="flex-w flex-r-m p-b-10">
                                <div class="size-203 flex-c-m respon6">
                                    Size
                                </div>

                                <div class="size-204 respon6-next">
                                    <p class="messerror" style="padding-bottom: 8px;color: #ff0000;display: none;">Please Choose size !</p>
                                    <div class="rs1-select2 bor8 bg0">                                       
                                        <select id="selectsize" class="js-select2" name="time">
                                            <option value="default">Choose an size</option>
                                            @foreach( $listsize as $size )
                                            <option value="{{$size}}"> {{$size}} </option>
                                            @endforeach
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex-w flex-r-m p-b-10">
                                <div class="size-203 flex-c-m respon6">
                                    Color
                                </div>

                                <div class="size-204 respon6-next">
                                    <p class="messerror" style="padding-bottom: 8px;color: #ff0000;display: none;">Please Choose color !</p>

                                    <div class="rs1-select2 bor8 bg0">
                                        <select id="selectcolor" class="js-select2" name="time">
                                            <option value="default">Choose an color</option>
                                            @foreach( $listcolor as $color )
                                            <option value="{{$color}}">{{$color}}</option>
                                            @endforeach
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex-w flex-r-m p-b-10">
                                <div class="size-203 flex-c-m respon6">
                                    Quantity:
                                </div>

                                <div class="size-204 respon6-next">
                                    <p class="messerror" style="padding-bottom: 8px;color: #ff0000;display: none;">Please Choose color !</p>

                                    <div class="rs1-select2 bg0">
                                        {{ $detail_product->quantity }}
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex-w flex-r-m p-b-10">
                                <p class="messerror" style="padding-bottom: 8px;color: #ff0000;display: none;width: 100%;padding-left: 105px;transform: translateY(10px);">Quantity must be less than 5 !</p>
                                <div class="size-204 flex-w flex-m respon6-next">
                                    <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                        <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                            <i class="fs-16 zmdi zmdi-minus"></i>
                                        </div>

                                        <input id="quantityproduct" class="mtext-104 cl3 txt-center num-product" type="number" name="num-product" value="1" min="1" max="3">

                                        <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                            <i class="fs-16 zmdi zmdi-plus"></i>
                                        </div>
                                    </div>

                                    <button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
                                        Add to cart
                                    </button>
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>

            <div class="bor10 m-t-50 p-t-43 p-b-40" style="padding: 10px 0px;margin-top: 30px;">
                <div class="row">
                    <div class="col-md-12">
                        <div class="well well-sm">
                            <div class="media">
                                <a class="thumbnail pull-left" href="{{ route('detailvendor',$infoshop[0]->id ) }}">
                                    <img class="media-object" src="public/assetF/images/avatar/{{ $infoshop[0]->avatar_shop }}" style="max-width: 175px;">
                                </a>
                                <div class="media-body">
                                    <a href="{{ route('detailvendor',$infoshop[0]->id) }}">
                                    <h4 class="media-heading" style="padding: 10px 0px 10px 30px;">{{ $infoshop[0]->name_shop }}</h4>
                                    </a>
                                    <p>
                                        <span style="padding: 0px 30px;" class="label label-info">Address : {{ $infoshop[0]->address_shop }}</span>
                                        <span style="padding: 0px 30px;" class="label label-warning">Phone: {{ $infoshop[0]->phone_shop }}</span>
                                        <span style="padding: 0px 30px;" class="label label-warning">Mail: {{ $infoshop[0]->mail_shop }}</span>
                                    </p>
                                    <p style="padding: 10px 30px;">
                                        <input class="btn btn-outline-success" style="cursor: pointer;padding: 8px 25px;margin-right: 10px;" type="submit" value="Contact Shop">
                                        <input class="btn btn-outline-warning" style="cursor: pointer;padding: 8px 25px;" type="submit" value="Follow">
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bor10 m-t-50 p-t-43 p-b-40">
                <!-- Tab01 -->
                <div class="tab01">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item p-b-10">
                            <a class="nav-link active" data-toggle="tab" href="#description" role="tab">Description</a>
                        </li>
                        <li class="nav-item p-b-10">
                            <a class="nav-link" id="countcmt" data-toggle="tab" href="#reviews" role="tab">Reviews({{ count($countcmt) }})</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content p-t-43">
                        <!-- - -->
                        <div class="tab-pane fade show active" id="description" role="tabpanel">
                            <div class="how-pos2 p-lr-15-md">
                                <p class="stext-102 cl6">
                                    {!! $detail_product->description !!}
                                </p>
                            </div>
                        </div>
                        <!-- - -->
                        <div class="tab-pane fade" id="reviews" role="tabpanel">
                            <div class="row">
                                <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                                    <div class="p-b-30 m-lr-15-sm" id="list-comment">
                                        <!-- Review -->
                                        @foreach( $countcmt as $cmt )
                                        <div class="flex-w flex-t p-b-68">
                                            <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
                                                <img src="public/assetF/images/avatar/{{ $cmt->avatar }}" alt="AVATAR">
                                            </div>

                                            <div class="size-207">
                                                <div class="flex-w flex-sb-m p-b-17">
                                                    <span class="mtext-107 cl2 p-r-20">
                                                        {{ $cmt->name }}&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;{{ ($cmt->created_at)->format('d-m-Y') }}
                                                    </span>
                                                    <span class="fs-18 cl11">
                                                        @for( $i = 1;$i <= 5; $i++ )
                                                            @if( $i <= $cmt->rate )
                                                            <i class="zmdi zmdi-star"></i>
                                                            @else
                                                            <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                            @endif
                                                        @endfor
                                                    </span>
                                                </div>
                                                <p class="stext-102 cl6">
                                                    {{ $cmt->content }}
                                                </p>
                                            </div>
                                        </div>
                                        @endforeach

                                        @if(isset($check_comment) && count($check_cmt_user) != 0 &&  $check_cmt_user[0]->check_cmt == 0 )
                                        <!-- Add review -->
                                        <div id="form-review">
                                            <h5 class="mtext-108 cl2 p-b-7">
                                                Add your review about product
                                            </h5>
                                            <div class="flex-w flex-m p-t-50 p-b-23" style="padding: 0px;">
                                                <span class="stext-102 cl3 m-r-16">
                                                    Your Rating
                                                </span>

                                                <span class="wrap-rating fs-18 cl11 pointer">
                                                    <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                    <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                    <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                    <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                    <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                    <input id="rating" value="0" class="dis-none" type="number" name="rating" required>
                                                </span>

                                            </div>
                                            <div>
                                                <span id="error" class="stext-102 cl3 m-r-16" style="color: RED;display: 
                                                none">
                                                    Please rating about product !!
                                                </span>
                                            </div>
                                            <div class="row p-b-25">
                                                <div class="col-12 p-b-5">
                                                    <label class="stext-102 cl3" for="review" style="padding-top: 10px;">Your review</label>
                                                    <textarea required class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10" id="review" name="review"></textarea>
                                                </div>
                                                <div style="width: 100%;padding-left: 15px;"></div>
                                                <span id="errorreview" class="stext-102 cl3 m-r-16" style="color: RED;display: 
                                                none;">
                                                    Please review about product !!
                                                </span>

                                            <button style="margin-left: 15px;margin-top: 10px;" id="submit-review" class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10">
                                                Submit Review
                                            </button>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg6 flex-c-m flex-w size-302 m-t-73 p-tb-15">
            <!-- <span class="stext-107 cl6 p-lr-25">
                SKU: JAK-01
            </span> -->

            <span class="stext-107 cl6 p-lr-25">
                Categories: {{ $detail_product->namecat }}
            </span>
        </div>
    </section>

    @if( count($relateproduct) > 0 )
    <!-- Related Products -->
    <section class="sec-relate-product bg0 p-t-45 p-b-105">
        <div class="container">
            <div class="p-b-45">
                <h3 class="ltext-106 cl5 txt-center">
                    Related Products
                </h3>
            </div>

            <!-- Slide2 -->
            <div class="wrap-slick2">
                <div class="slick2">
                    
                    @foreach( $relateproduct as $product )
                    <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
                        <!-- Block2 -->
                        <div class="block2">
                            <a href="{{route('detailproduct',$product->slug)}}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                            <div class="block2-pic hov-img0">
                                <img src="public/assetF/images/{{$product->image}}" alt="IMG-PRODUCT">
                            </div>
                            </a>
                            <div class="block2-txt flex-w flex-t p-t-14">
                                <div class="block2-txt-child1 flex-col-l ">
                                    <a href="{{route('detailproduct',$product->slug)}}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                        {{$product->name}}
                                    </a>
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
            </div>
        </div>
    </section>
    @endif
    <script type="text/javascript">
    jQuery(document).ready(function($){


        jQuery('#submit-review').click(function(){
            var rate = jQuery('#rating').val();
            var review = jQuery('#review').val();
            if( rate == 0 || review == '' )
            {
                jQuery('#error').css('display','unset');
                jQuery('#errorreview').css('display','unset');
            }
            else
            {
                jQuery('#error').css('display','none');
                jQuery('#errorreview').css('display','none');

                jQuery.ajax({
                            url: '/Karma/postcomment',
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                _token:         '<?php echo csrf_token() ?>',
                                "rate":         rate,
                                "content":      review,
                                "id_product":   {{ $detail_product->id }},
                            },
                            success: function(data){
                                jQuery('#form-review').remove();
                                jQuery('#list-comment').append('<div class="flex-w flex-t p-b-68"><div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6"><img src="public/assetF/images/avatar/" alt="AVATAR"></div><div class="size-207"><div class="flex-w flex-sb-m p-b-17"><span class="mtext-107 cl2 p-r-20"></span><span class="fs-18 cl11"><i class="zmdi zmdi-star"></i><i class="zmdi zmdi-star"></i><i class="zmdi zmdi-star"></i><i class="zmdi zmdi-star"></i><i class="zmdi zmdi-star-half"></i></span></div><p class="stext-102 cl6">'+review+'</p></div></div>');

                                jQuery('.mycontainer').append('<div style="position: fixed;width: auto;left: calc(50vw - 260px );top: 200px;font-size: 20px;z-index: 999;" class=" myalert alert alert-success" role="alert">Thanks you for review my product. Forever Love you !!</div>');
                                jQuery('.myalert').fadeOut(3000);
                                jQuery('#countcmt').html('Reviews ('+data['count']+')');
                            },
                        });
            }
        });

        jQuery('.js-addcart-detail').each(function(){
            var nameProduct = jQuery(this).parent().parent().parent().parent().find('.js-name-detail').html();
            jQuery(document).on('click','.js-addcart-detail', function(){
                var sizep = jQuery('#selectsize').val();
                var colorp = jQuery('#selectcolor').val();
                var quantityproduct = jQuery('#quantityproduct').val();
                if( sizep    == 'default' || colorp == 'default' || quantityproduct <= 0 || quantityproduct > 5 )
                {
                    jQuery('.messerror').css('display','unset');
                }
                else{
                    jQuery('.messerror').css('display','none');

                    if( quantityproduct >= {{ $detail_product->quantity }} )
                    {

                    }
                    else
                    {
                        $.ajax({
                            url: '/Karma/addcart',
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                _token:         '<?php echo csrf_token() ?>',
                                "idproduct":    {{ $detail_product->id }},
                                "nameproduct":  '{{ $detail_product->name }}',
                                "idvendor":     {{ $detail_product->id_vendor }},
                                "size":         sizep,
                                "color":        colorp,
                                "price":        @if( $detail_product->promotional != 0 )
                                                    {{$detail_product->promotional}}
                                                @else
                                                    {{$detail_product->price}}
                                                @endif,
                                "quantity":     quantityproduct,
                                "image":          '{{ $detail_product->image }}'
                            },
                            success: function(data){
                                var count = data['count'];
                                jQuery('.icon-header-item.cl2.hov-cl1.trans-04.p-l-22.p-r-11.icon-header-noti').attr('data-notify',count);
                            },
                        });
                    }

                    swal(nameProduct, "is added to cart !", "success");
                }
            });
        });

        var readURL = function(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.avatar').attr('src', e.target.result);
                }
        
                reader.readAsDataURL(input.files[0]);
            }
        }
        $(".file-upload").on('change', function(){
            readURL(this);
        });
    });
    </script>
@endsection
