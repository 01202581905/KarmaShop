@section('title')
Cart | COZA
@endsection
@extends('pagesF.master')
@section('content')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <div class="container" id="container-append" style="margin-top: 40px;">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="index.html" class="stext-109 cl8 hov-cl1 trans-04">
                Home
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
                Shoping Cart
            </span>
        </div>
    </div>
    @if( Session('success') )
    <div class="submitorder" style="width: 100vw;
    height: 100vh;
    background-color: rgba(137,137,137,0.5);
    position: fixed;
    z-index: 1120;top: 0px;display: flex;justify-content: center;align-items: center;">
    <div style="width: 500px;height: 250px;background-color: #fff;border-radius: 5px;z-index: 9999;border: solid 1px #33333350;display: flex;justify-content: center;align-items: center;">
        <div>
        <h2 style="font-family: Poppins-Regular;font-size: 32px;text-align: center;line-height: 1.5;padding: 0px 24px;">Order successfully. Thanks for choosing COZA STORE !!</h2>
            <p style="margin: auto;
    font-size: 24px;
    font-family: Poppins-Regular;
    width: fit-content;
    padding: 8px 48px;
    border-radius: 5px;
    background-color: #333;
    color: #fff;
    margin-top: 12px;cursor: pointer;" id="submitorder"><a style="text-decoration: none;color: #fff;" href="{{ route('index') }}">Ok</a></p>
        </div>
    </div>
    </div>   
    @endif 
    <!-- Shoping Cart -->
    @if( Cart::count() > 0 )
    <form class="bg0 p-t-75 p-b-85" id="form" action="{{ route('order') }}" method="POST">
        @csrf
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                    <div class="m-l-25 m-r--38 m-lr-0-xl">
                        <div class="wrap-table-shopping-cart">
                            <table class="table-shopping-cart">
                                <tr class="table_head">
                                    <th class="column-1">Product</th>
                                    <th class="column-2"></th>
                                    <th class="column-3">Price</th>
                                    <th class="column-4" style="text-align: center;">Quantity</th>
                                    <th class="column-5">Total</th>
                                </tr>
                                @foreach( Cart::content() as $row )
                                    <tr class="table_row class-id-itemcart" id="{{ $row->rowId }}">
                                        <td class="column-1">
                                            <div class="how-itemcart1">
                                                <img src="public/assetF/images/{{ $row->options->image }}" alt="IMG">
                                            </div>
                                        </td>
                                        <td class="column-2" style="padding: 0px 12px;">{{ $row->name }}<br>size : {{ $row->options->size }}<br>Color : {{ $row->options->color }}</td>
                                        <td class="column-3">${{ $row->price }}</td>
                                        <td class="column-4">
                                            <div class="wrap-num-product flex-w m-l-auto m-r-0">
                                                <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m button-reduction">
                                                    <i class="fs-16 zmdi zmdi-minus"></i>
                                                </div>

                                                <input id="quantityproduct" class="mtext-104 cl3 txt-center num-product" min="1" max="3" type="number" name="num-product1" value="{{ $row->qty }}">

                                                <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m button-increment">
                                                    <i class="fs-16 zmdi zmdi-plus"></i>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="column-5">${{ $row->price * $row->qty }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>

                        <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
                            <div class="flex-w flex-m m-r-20 m-tb-5">
                                {{-- <input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" type="text" name="coupon" placeholder="Coupon Code"> --}}
                                    
                                <div class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
                                    <a href="{{ route('clearcart') }}" style="color: unset;padding: 11px 20px">Clear Cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                    <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm" style="padding: 12px;">
                        <h4 class="mtext-109 cl2 p-b-30">
                            Cart Totals
                        </h4>

                        <div class="flex-w flex-t bor12 p-b-13">
                            <div class="size-208">
                                <span class="stext-110 cl2">
                                    Subtotal:
                                </span>
                            </div>

                            <div class="size-209">
                                <span class="mtext-110 cl2" id="totalpriceorder">
                                    ${{ Cart::subtotal() }}
                                </span>
                            </div>
                        </div>

                        <div class="flex-w flex-t bor12 p-t-15 p-b-30">
                            <div class="size-208 w-full-ssm">
                                <span class="stext-110 cl2">
                                    Shipping :
                                </span>
                            </div>

                            <div class="size-209 p-r-18 p-r-0-sm w-full-ssm" style="width: 100%;padding-right: 0px;">
                                <p class="stext-111 cl6 p-t-2">
                                    Method shipping is comming soon.
                                </p>
                                
                                <div class="p-t-15">
                                    <span class="stext-112 cl8">
                                        Calculate Shipping
                                    </span>
                                    <div class="bor8 bg0 m-b-12">
                                        <input class="stext-111 cl8 plh3 size-111 p-lr-15" required type="text" name="name" placeholder="receiver name" @if( Auth::check() ) value=" {{ Auth::user()->name }} @endif ">
                                    </div>

                                    <div class="bor8 bg0 m-b-22">
                                        <input class="stext-111 cl8 plh3 size-111 p-lr-15" required type="email" name="mail" placeholder="mail"  @if( Auth::check() )value=" {{ Auth::user()->email }} @endif ">
                                    </div>

                                    <div class="bor8 bg0 m-b-22">
                                        <input class="stext-111 cl8 plh3 size-111 p-lr-15" required type="number" name="phone" placeholder="number phone" @if( Auth::check() ) value=" {{ Auth::user()->phone }} @endif">
                                    </div>

                                    <div class="bor8 bg0 m-b-12">
                                        <input class="stext-111 cl8 plh3 size-111 p-lr-15" required type="text" name="address" placeholder="Shipping order" @if( Auth::check() )value=" {{ Auth::user()->address}} @endif ">
                                    </div>

                                    <div class="bor8 bg0 m-b-12">
                                        <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="message" placeholder="Message">
                                    </div>                                       
                                </div>
                            </div>
                        </div>

                        <!-- <div class="flex-w flex-t p-t-27 p-b-33">
                            <div class="size-208">
                                <span class="mtext-101 cl2">
                                    Total:
                                </span>
                            </div>

                            <div class="size-209 p-t-1">
                                <span class="mtext-110 cl2" id="totalpriceorder">
                                    ${{ Cart::subtotal() }}
                                </span>
                            </div>
                        </div> -->

                        <input type="submit" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer" value="Proceed to Checkout">
                    </div>
                </div>


            </div>
        </div>
    </form>
    @else
        <div style="height: 400px;display: flex;justify-content: center;">
            <h2 style="font-family: Poppins-Regular;font-size: 48px;line-height: 1.4;width: 700px;text-align: center;padding-top: 80px;">No product order in cart <a style="color: unset;text-decoration: underline;" href="{{ route('product') }}">Shopping Now</a></h2>
        </div>
    @endif
    <script type="text/javascript">
        jQuery(document).ready(function(){

            jQuery('#submitorder').click(function(){
                jQuery('.submitorder').remove();
            });

            jQuery('.button-reduction').click(function(){
                var id = jQuery(this).parent('div').parent('td').parent('tr').attr('id');
                var quantityproduct = jQuery('#quantityproduct').val();
                if( quantityproduct == 0 )
                {
                    var result = confirm("Want to delete product from your cart ? ");
                    if( result )
                    {
                        $.ajax({
                            url: '/Karma/updatecart',
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                _token:         '<?php echo csrf_token() ?>',
                                "rowId":        id,
                                "quantityproduct":  quantityproduct,
                                "options"        : 'reduce'
                            },
                            success: function(data){
                                var count = data['count'];
                                if( data['priceproduct'] )
                                {
                                    var priceproduct = data['priceproduct'];
                                    jQuery('#'+id).find('td.column-5').html('$'+priceproduct);
                                }
                                
                                if( data['removeItem'] && data['removeItem'] == true )
                                {
                                    jQuery('#'+id).remove();
                                }
                                var totalprice = data['totalprice'];
                                jQuery('.icon-header-item.cl2.hov-cl1.trans-04.p-l-22.p-r-11.icon-header-noti').attr('data-notify',count);
                                jQuery('#totalpriceorder').html('$'+totalprice);
                                if( count == 0 )
                                {
                                    jQuery('form#form').remove();
                                    jQuery('#container-append').append('<div style="height: 400px;display: flex;justify-content: center;"><h2 style="font-family: Poppins-Regular;font-size: 48px;line-height: 1.4;width: 700px;text-align: center;padding-top: 80px;">No product order in cart <a style="color: unset;text-decoration: underline;" href="http://localhost/Karma/karmaproduct">Shopping Now</a></h2></div>');
                                }
                            },
                        }); 
                    }
                }
                else
                {
                    $.ajax({
                            url: '/Karma/updatecart',
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                _token:         '<?php echo csrf_token() ?>',
                                "rowId":        id,
                                "quantityproduct":  quantityproduct,
                                "options"        : 'reduce'
                            },
                            success: function(data){
                                var count = data['count'];
                                if( data['priceproduct'] )
                                {
                                    var priceproduct = data['priceproduct'];
                                    jQuery('#'+id).find('td.column-5').html('$'+priceproduct);
                                }
                                
                                if( data['removeItem'] && data['removeItem'] == true )
                                {
                                    jQuery('#'+id).remove();
                                }
                                var totalprice = data['totalprice'];
                                jQuery('.icon-header-item.cl2.hov-cl1.trans-04.p-l-22.p-r-11.icon-header-noti').attr('data-notify',count);
                                jQuery('#totalpriceorder').html('$'+totalprice);
                            },
                        });
                }   
            });

            jQuery('.button-increment').click(function(){
                var id = jQuery(this).parent('div').parent('td').parent('tr').attr('id');
                var quantityproduct = jQuery('#quantityproduct').val();

                $.ajax({
                    url: '/Karma/updatecart',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        _token:         '<?php echo csrf_token() ?>',
                        "rowId":        id,
                        "quantityproduct":  quantityproduct,
                        "options"        : 'increment'
                    },
                    success: function(data){
                        var count = data['count'];
                        if( data['priceproduct'] )
                        {
                            var priceproduct = data['priceproduct'];
                            jQuery('#'+id).find('td.column-5').html('$'+priceproduct);
                        }
                        
                        if( data['removeItem'] && data['removeItem'] == true )
                        {
                            jQuery('#'+id).remove();
                        }
                        var totalprice = data['totalprice'];
                        jQuery('.icon-header-item.cl2.hov-cl1.trans-04.p-l-22.p-r-11.icon-header-noti').attr('data-notify',count);
                        jQuery('#totalpriceorder').html('$'+totalprice);

                    },
                });
            });
        });
    </script>
@endsection
    <!-- Footer -->