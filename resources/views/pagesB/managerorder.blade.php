@extends('pagesB.master')
@section('title_admin')
Manager Order | Admin | COZA
@endsection
@section('contentserver')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<div id="detailorder" style="position: fixed;left: 0px;height: 100vh;width: 100vw;background-color: #33333380;z-index: 9999;top: 0px;display: none;">
    <div class="card-body" style="width: 80%;margin: auto;margin-top: 30px;background-color: #fff;border-radius: 5px;box-shadow: 0px 0px 10px 5px rgba(255,247,255,1)">
        <div style="position: relative;"><i class="fa-times-circle" style="font-family: FontAwesome;font-style: normal;font-size: 32px;position: absolute;right: -26px;top: -40px;cursor: pointer;" id="close"></i></div>
        <table id="bootstrap-data-table" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th width="10%;">Code Order</th>
                    <th width="30%;">Info Product</th>
                    <th width="15%;">Image Product</th>
                    <th width="10%;">Quantity</th>
                    <th width="10%;">Price</th>
                    <th width="15%;">Status</th>
                </tr>
            </thead>
            <tbody id="body-order-detail">
            </tbody>
        </table>
    </div>
</div>

<div class="content" style="overflow-x: scroll;width: 130%;">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong id="number-order">{{ count($orders) }} </strong><strong class="card-title"> {{ $nameorder }}</strong>
                                <div style="display: inline-block;margin-left: 30px;">
                                <form action="{{ route('searchorderwait') }}" method="GET">
                                    @if( $nameorder == 'Order Pending' )
                                        <input type="hidden" name="nameorder" value="wait" style="display: none;">
                                    @elseif( $nameorder == 'Order Being Delivered' )
                                        <input type="hidden" name="nameorder" value="shipping" style="display: none;">
                                    @elseif( $nameorder == 'Order Delivered' )
                                        <input type="hidden" name="nameorder" value="delivered" style="display: none;">
                                    @elseif( $nameorder == 'Order Cancel' )
                                        <input type="hidden" name="nameorder" value="cancel" style="display: none;">
                                    @endif
                                    <input type="text" style="border-radius: 3px;box-sizing: none;box-shadow: none;border: solid 0.5px #d9d9d9;padding: 5px 30px;font-size: 14px;" name="codeorder" placeholder="search code order...">
                                    <button type="submit" style="transform: translateY(-2px);padding: 5px 20px;" class="btn btn-primary btn-sm"><i class="fa fa-search"></i>&nbsp; Search</button>
                                </form>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    @if( count($orders) > 0 )
                                    <thead>
                                        <tr>
                                            <th width="32;">Info Order</th>
                                            <th width="10%;">Time Order</th>
                                            <th width="8%;">Quantity </th>
                                            <th width="5%;">Money</th>
                                            <th width="14%;">Shipping Method</th>
                                            <th width="15%;">Message</th>
                                            <th width="25%;">Option</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach( $orders as $order )
                                        <tr class="tr-order" id="order-{{$order->id}}">
                                            <td>Recipient : {{ $order->name_recipient }} <br> Address : {{ $order->address }}</td>
                                            <td> {{ $order->created_at }} </td>
                                            <td> {{ $order->total_quantity }}</td>
                                            <td> ${{ $order->total_money }} </td>
                                            <td>{{ $order->payment_method }}</td>
                                            <td> {{ $order->letter }} </td>
                                            @if( $type == 'wait' )
                                            <td style="text-align: center;
    justify-content: center;
    display: flex;
    flex-wrap: wrap;padding: 0px;padding-top: 10px;"><p class="detailorder" data="{{ $order->id }}"  style="color: #fff;
    background-color: #2bc1e3;
    padding: 6px 15px;
    width: fit-content;margin-right: 20px;
    border-radius: 3px;
    text-transform: uppercase;cursor: pointer;">Detail</p><p class="movetoinprocess"  data="{{ $order->id }}" style="color: #fff;
    background-color: #28c62d;
    padding: 8px 5px;
    width: fit-content;
    border-radius: 3px;
    text-transform: uppercase;
    text-align: center;
    line-height: 1.2;cursor: pointer;">Move to Process</p></td>
                                            @elseif( $type == 'shipping' )
                                            <td style="text-align: center;
    justify-content: center;
    display: flex;
    flex-wrap: wrap;padding: 0px;padding-top: 10px;"><p class="detailorder" data="{{ $order->id }}"  style="color: #fff;
    background-color: #2bc1e3;
    padding: 6px 15px;
    width: fit-content;margin-right: 20px;
    border-radius: 3px;
    text-transform: uppercase;cursor: pointer;">Detail</p><p class="movetocomplete"  data="{{ $order->id }}" style="color: #fff;
    background-color: #28c62d;
    padding: 8px 5px;
    width: fit-content;
    border-radius: 3px;
    text-transform: uppercase;
    text-align: center;
    line-height: 1.2;cursor: pointer;">Move to Complete</p><p class="movetocancel"  data="{{ $order->id }}" style="color: #fff;
    background-color: #dc3545;
    padding: 8px 5px;
    width: fit-content;
    border-radius: 3px;
    text-transform: uppercase;
    text-align: center;
    line-height: 1.2;cursor: pointer;">Move to Cancel</p></td>
                                            @elseif( $type == 'complete' || $type == 'cancel' )
                                            <td style="text-align: center;
    justify-content: center;
    display: flex;
    flex-wrap: wrap;padding: 0px;padding-top: 10px;"><p class="detailorder" data="{{ $order->id }}"  style="color: #fff;
    background-color: #2bc1e3;
    padding: 6px 15px;
    width: fit-content;margin-right: 20px;
    border-radius: 3px;
    text-transform: uppercase;cursor: pointer;">Detail</p></td>
                                            @endif
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    @else
                                        <thead>
                                            <tr>
                                                <th width="100%" style="text-align: center;">No {{ $nameorder }}</th>
                                            </tr>
                                        </thead>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
            </div><!-- .animated -->
        </div>
<script type="text/javascript">
    jQuery(document).ready(function(){

        jQuery('#close').click(function() 
        {
            jQuery('#detailorder').fadeOut(800);
            jQuery('#body-order-detail tr').remove();
        });

        jQuery('.detailorder').click(function(){

            var id_order = jQuery(this).attr('data');
            $.ajax({
                url: '/Karma/serverkarma/ajaxdetailorder',
                type: 'POST',
                dataType: 'json',
                data: {
                    _token:         '<?php echo csrf_token() ?>',
                    "id_order":        id_order,
                },
                success: function(data){
                    var datas = data['order_details'];
                    for( dataorder of datas )
                    {
                        if( dataorder['status'] == 0 )
                        {
                            var status = '<button type="button" disabled class="btn btn-warning">Wait</button>';
                        }
                        else if( dataorder['status'] == 1 )
                        {
                            var status = '<button type="button" class="btn btn-success" disabled="">Ready</button>';
                        }
                        jQuery('#body-order-detail').append("<tr><td>"+dataorder['id']+"</td><td> Name Product: "+dataorder['name']+"<br> Size :"+dataorder['size']+"<br> Color: "+dataorder['color']+"</td><td><img src='public/assetF/images/"+dataorder['image']+"'></td><td>"+dataorder['quantity']+"</td><td> $"+dataorder['money']+"</td><td>"+status+"</td></tr>");
                    }
                    jQuery('#detailorder').fadeIn(500);
                },
            });    
        });

        jQuery('.movetoinprocess').click(function(){

            var id_order = jQuery(this).attr('data');
            $.ajax({
                url: '/Karma/serverkarma/updatestatusorder',
                type: 'POST',
                dataType: 'json',
                data: {
                    _token:         '<?php echo csrf_token() ?>',
                    "id_order":        id_order,
                },
                success: function(data){
                    jQuery('#number-order').html(data['order_wait']);
                    jQuery('#order-'+id_order).remove();
                    var quan = jQuery('.tr-order').length;
                    if( quan == 0)
                    {
                        jQuery('.card-body').html('<p style="text-align: center;font-size: 24px;color: #333;font-weight: 600;"> No Order Here !</p>');
                    }
                },
            });    
        });

        jQuery('.movetocomplete').click(function(){

            var id_order = jQuery(this).attr('data');
            $.ajax({
                url: '/Karma/serverkarma/updatestatusordercomplete',
                type: 'POST',
                dataType: 'json',
                data: {
                    _token:         '<?php echo csrf_token() ?>',
                    "id_order":        id_order,
                },
                success: function(data){
                    jQuery('#number-order').html(data['order_wait']);
                    jQuery('#order-'+id_order).remove();
                    var quan = jQuery('.tr-order').length;
                    if( quan == 0)
                    {
                        jQuery('.card-body').html('<p style="text-align: center;font-size: 24px;color: #333;font-weight: 600;"> No Order Here !</p>');
                    }
                },
            });    
        });

        jQuery('.movetocancel').click(function(){
            var id_order = jQuery(this).attr('data');
            var result = confirm("Want to cancel order : "+id_order);
            if( result )
            {
                $.ajax({
                    url: '/Karma/serverkarma/updatestatusordercancel',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        _token:         '<?php echo csrf_token() ?>',
                        "id_order":        id_order,
                    },
                    success: function(data){
                        jQuery('#number-order').html(data['order_wait']);
                        jQuery('#order-'+id_order).remove();
                        var quan = jQuery('.tr-order').length;
                        if( quan == 0)
                        {
                            jQuery('.card-body').html('<p style="text-align: center;font-size: 24px;color: #333;font-weight: 600;"> No Order Here !</p>');
                        }
                    },
                });
            }
                
        });
    });
</script>
@endsection