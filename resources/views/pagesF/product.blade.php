@section('title')
Product | COZA
@endsection
@extends('pagesF.master')
@section('content')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<style type="text/css">
    #button-search:hover{
        border: solid 0.1px #007bff50;
    }
</style>
<div id="loadproduct" style="display: none;width: 100vw;height: 100vh;position: fixed;background-color: #5d695f85;z-index: 9999999;top: 0px;justify-content: center;align-items: center;">
    <div>
        <img src="public/assetF/images/icons/loading.gif">
    </div>
</div>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<div class="bg0 m-t-23 p-b-140" style="margin-top: 100px;">
        <div class="container">
            <div class="flex-w flex-sb-m p-b-52" style="display: grid;grid-template-columns: repeat(1,1fr);">
                <div class="flex-w flex-l-m filter-tope-group m-tb-10">
                    <a href="{{ route('product') }}">
                    <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" >
                        All Type
                    </button>
                    </a>
                    @foreach( $types as $type )  
                    <a href="{{ route('typeproduct',$type->slug) }}">    
                    <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5">
                        {{$type->name}}
                    </button>
                    </a>
                    @endforeach
                </div>

                <div class="flex-w  m-tb-10">
                    <div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search" id="search-toggle">
                        <i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
                        <i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                        Search
                    </div>
                </div>
                
                <!-- Search product -->
                <form method="GET" action="{{ route('searchallproduct') }}">
                <div class="dis-none panel-search w-full p-t-10 p-b-15">
                    <div class="bor8 dis-flex p-l-15">
                        <select id="selectcategory" name="selectcategory" style="height: 40px;
    margin: 10px 10px 0px 0px;
    border-radius: 3px;
    border: solid 0.5px #d9d9d9;
    color: #333333;font-family: Poppins-Regular;font-size: 16px;
    padding: 0px 5px;">
                            <option selected disabled>Category</option>
                            <option value="0">Default</option>
                            @foreach( $cats as $cat )
                            <option value="{{$cat->id}}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        <select id="selecttype" name="selecttype" style="height: 40px;
    margin: 10px 10px 0px 0px;
    border-radius: 3px;
    border: solid 0.5px #d9d9d9;
    color: #333333;font-family: Poppins-Regular;font-size: 16px;
    padding: 0px 5px;">
                            <option selected disabled>Type</option>
                            <option value="0">Default</option>
                            @foreach( array_slice( $types->toArray(), 0, 5 ) as $type )
                            <option value="{{$type['id']}}">{{ $type['name'] }}</option>
                            @endforeach
                        </select>
                        <select name="selectsortby" style="height: 40px;
    margin: 10px 10px 0px 0px;
    border-radius: 3px;
    border: solid 0.5px #d9d9d9;
    color: #333333;font-family: Poppins-Regular;font-size: 16px;
    padding: 0px 5px;">
                            <option selected disabled>Sort By</option>
                            <option value="0">Default</option>
                            <option value="1" >Price: Low to High</option>
                            <option value="2" >Price: High to Low</option>
                            <option value="3" >Name: A to Z</option>
                            <option value="4" >Name: Z to A</option>
                        </select>
                        <select name="selectprice" style="height: 40px;
    margin: 10px 10px 0px 0px;
    border-radius: 3px;
    border: solid 0.5px #d9d9d9;
    color: #333333;font-family: Poppins-Regular;font-size: 16px;
    padding: 0px 5px;">
                            <option selected disabled>Price</option>
                            <option value="0">Default</option>
                            <option value="1" >$0 - $49</option>
                            <option value="2" >$50 - $99</option>
                            <option value="3" >$100 - $150</option>
                            <option value="4" >$150 -></option>
                        </select> 
                        <input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="key" placeholder="Search name product...">
                        <button type="submit" id="button-search" class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04" style="margin-right: 10px;
        height: 40px;
        margin-top: 10px;
        padding: 0px 30px;;">
                            <i class="zmdi zmdi-search"></i>
                        </button>
                    </div>  
                </div>

                <!-- Filter -->
            </div>
            </form>
            <div class="row isotope-grid">
            @if( count($products) > 0 )
            @foreach( $products as $product )
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
            @else
                <div class="alert alert-primary" role="alert" style="margin: auto;font-size: 24px;">
                    There are currently no products in this !
                </div>
            @endif
            </div>
            <div class="pagination" style="justify-content: center;">
                {{$products->links()}}
            </div>
            <!-- Load more -->
        </div>
    </div>
<script type="text/javascript">
        jQuery(document).ready(function(){

            jQuery('#search-toggle').click(function(){
                jQuery('.flex-w.flex-l-m.filter-tope-group.m-tb-10').toggle(1000);
            });

            jQuery('#selectcategory').change(function(){
                var value = jQuery(this).val();
                jQuery.ajax({
                    url: '/Karma/selecttypes',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        _token: '<?php echo csrf_token() ?>',
                        'idcat': value
                    },
                    success: function(data){
                        var datatype = data['types'];
                        jQuery('#selecttype option').remove();
                        jQuery('#selecttype').append("<option valu='0'> Default </option>");
                        for( type of datatype )
                        {
                            jQuery('#selecttype').append("<option valu='"+type['id']+"'>"+type['name']+"</option>");
                        }
                    }
                });
            });
        });
    </script>
@endsection