@section('title')
My Order | COZA
@endsection
@extends('pagesF.master')
@section('content')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<style>
    .dis button{
        padding: 15px 30px;
        text-transform: uppercase;
    }

    .btn-active{
        box-shadow: 0px 0px 10px 5px rgba(173,173,173,1);
    }

</style>
<div style="margin-top: 80px;border-top: solid 1px #333;">
    <div style="margin: auto;width: 80%;display: grid;grid-template-columns: repeat(5,1fr);grid-gap: 24px;margin-top: 20px;justify-content: center;" class="dis">
        <button type="button" id="all-order" class="btn btn-primary btn-active" >All Order</button>
        <button type="button" id="order-waiting" class="btn btn-warning" >Wait For The Products</button>
        <button type="button" id="order-shipping" class="btn btn-secondary" >Shipping</button>
        <button type="button" id="order-delivered" class="btn btn-success" >Shipped</button>
        <button type="button" id="order-cancel" class="btn btn-danger" >Cancel</button>
        
    </div>
    <div class="selectdis" style="padding: 10px 0px;">
    </div>
</div>
<div class="content" style="width: 98%;">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">MY ORDER</strong>
                            </div>
                            <div class="card-body">
                                @if( count($orders) > 0 )
                                @foreach( $orders as $order)
                                @if( $order->status  == 0 && $order->status_order == 1 )
                                <table id="bootstrap-data-table" class="table table-striped table-bordered order-waiting">
                                @elseif( $order->status  == 1 && $order->status_order == 1 )
                                <table id="bootstrap-data-table" class="table table-striped table-bordered order-shipping">
                                @elseif( $order->status  == 2 && $order->status_order == 1 )
                                <table id="bootstrap-data-table" class="table table-striped table-bordered order-delivered">
                                @elseif( $order->status_order == 0 )
                                <table id="bootstrap-data-table" class="table table-striped table-bordered order-cancel">
                                @endif
                                    <tbody>
                                        <tr>
                                            <th colspan="4">INFOMATION ORDER</th>
                                        </tr>
                                        <tr>
                                            <td colspan="4">
                                                <div style="display: flex;flex-wrap: wrap;">
                                                <p style="padding-bottom: 5px;margin: 5px 15px;">Receiver : {{ $order->name_recipient }}</p>
                                                <p style="padding-bottom: 5px;margin: 5px 15px;">Phone :{{ $order->phone }}</p>
                                                <p style="padding-bottom: 5px;margin: 5px 15px;">Mail : {{ $order->email }}</p>
                                                <p style="padding-bottom: 5px;margin: 5px 15px;">Address : {{ $order->address }}</p>
                                                <p style="padding-bottom: 5px;margin: 5px 15px;">Message : {{ $order->letter }}</p>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="25%;">IMAGE</th>
                                            <th width="60%%;">INFO PRODUCT</th>
                                            <th width="15%;">PRICE</th>
                                        </tr>
                                        @if( $order->id_order == $order->id )
                                        <tr>
                                            <td><div style="background-size: cover;width: 160px;height: 150px;background-image: url(public/assetF/images/{{ $order->image  }});";></div></td>
                                            <td> 
                                                <div>
                                                    <p style="padding-bottom: 10px;">{{ $order->name }}</p>
                                                    <p style="padding-bottom: 10px;">Size : {{ $order->size }}</p>
                                                    <p style="padding-bottom: 10px;">Color : {{ $order->color }}</p>
                                                    <p style="padding-bottom: 10px;">Quantity : {{ $order->quantity }}</p>
                                                </div>
                                            </td>
                                            <td>
                                                <p style="padding-bottom: 90px;">{{ $order->money }}$</p>
                                                <p>Total Money : {{ $order->money*$order->quantity }}$</p>
                                            </td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <td colspan="3"><p style="text-align: right;padding-right: 20px;">Total Money Order : {{ $order->total_money }}$</p></td>
                                        </tr>
                                    </tbody>
                                </table>
                                @endforeach
                                @else
                                    <p style="text-align: center;font-size: 24px;margin: 80px 0px 120px;">No product in your order . Shopping <a href="{{ route('product') }}">now</a> !!</p>
                                @endif
                                <p id="text-message" style="display: none;text-align: center;font-size: 24px;margin: 80px 0px 120px;">No product in your order . Shopping <a href="{{ route('product') }}">now</a> !!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- .animated -->
        </div>
<script type="text/javascript">
        jQuery(document).ready(function(){
            jQuery('#all-order').click(function(){
                jQuery('button.btn').removeClass('btn-active');
                jQuery(this).addClass('btn-active');
                jQuery('table.table').css('display','table');
                if( jQuery('table.table.table-striped.table-bordered').length > 0 )
                {
                    jQuery('#text-message').css('display','none');
                }
            });
        });

            jQuery('#order-waiting').click(function(){
                if( jQuery('table.order-waiting').length > 0 )
                {
                    jQuery('button.btn').removeClass('btn-active');
                    jQuery(this).addClass('btn-active');
                    jQuery('table.table').css('display','none');
                    jQuery('table.order-waiting').css('display','table');
                    jQuery('#text-message').css('display','none');
                }
                else
                {
                    jQuery('table.table').css('display','none');
                    jQuery('#text-message').css('display','block');
                }
                
            });

            jQuery('#order-shipping').click(function(){
                if( jQuery('table.order-shipping').length > 0 )
                {
                    jQuery('button.btn').removeClass('btn-active');
                    jQuery(this).addClass('btn-active');
                    jQuery('table.table').css('display','none');
                    jQuery('table.order-shipping').css('display','table');
                    jQuery('#text-message').css('display','none');
                }
                else
                {
                    jQuery('table.table').css('display','none');
                    jQuery('#text-message').css('display','block');
                }
                
            });

            jQuery('#order-delivered').click(function(){
                if( jQuery('table.order-delivered').length > 0 )
                {
                    jQuery('button.btn').removeClass('btn-active');
                    jQuery(this).addClass('btn-active');
                    jQuery('table.table').css('display','none');
                    jQuery('table.order-delivered').css('display','table');
                    jQuery('#text-message').css('display','none');
                }
                else
                {
                    jQuery('table.table').css('display','none');
                    jQuery('#text-message').css('display','block');
                }
                
            });

            jQuery('#order-cancel').click(function(){
                if( jQuery('table.order-cancel').length > 0 )
                {
                    jQuery('button.btn').removeClass('btn-active');
                    jQuery(this).addClass('btn-active');
                    jQuery('table.table').css('display','none');
                    jQuery('table.order-cancel').css('display','block');
                    jQuery('#text-message').css('display','none');
                }
                else
                {
                    jQuery('table.table').css('display','none');
                    jQuery('#text-message').css('display','block');
                }
                
            });
    </script>
@endsection