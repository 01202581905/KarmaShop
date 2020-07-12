@extends('pagesF.vendor.master')
@section('title_vendor')
Manager Order | Vendor | COZA
@endsection
@section('vendor')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<div class="content" style="overflow-x: scroll;width: 150%;">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                @if( isset($search) && $search == true )
                                @else
                                <strong class="countnumberorder">{{ count($orders) }} </strong><strong class="card-title"> {{ $name }}</strong>
                                @endif
                                <div style="display: inline-block;margin-left: 30px;">
                                <form action="{{ route('vendorsearchorder') }}" method="GET">
                                        <input type="hidden" name="t" value="shop" style="display: none;">
                                    <input type="text" style="border-radius: 3px;box-sizing: none;box-shadow: none;border: solid 0.5px #d9d9d9;padding: 5px 30px;font-size: 14px;" name="codeorder" placeholder="search code order...">
                                    <button type="submit" style="transform: translateY(-2px);padding: 5px 20px;" class="btn btn-primary btn-sm"><i class="fa fa-search"></i>&nbsp; Search</button>
                                </form>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th width="8%;">Code Order</th>
                                            <th width="18%;">Infomation Order</th>
                                            <th width="8%;">Time order</th>
                                            <th width="12%;">Product</th>
                                            <th width="10%;">Image Product</th>
                                            <th width="9%;">Price Product</th>
                                            <th width="5%;">Quantity</th>
                                            <th width="5%;">Size</th>
                                            <th width="2%;">Color</th>
                                            <th width="2%;">Method</th>
                                            <th width="15%;">Message</th>
                                            <th width="10%;">Option</th>
                                        </tr>
                                    </thead>
                                    <tbody class="content-order">
                                        @foreach( $orders as $order )
                                        <tr class=" tr-order order-{{$order->id}}">
                                            <td class="code_order">{{ $order->id }}</td>
                                            <td>Name Recipient: {{ $order->name_recipient }} <br> Địa Chỉ: {{ $order->address }} <br> Phone: {{ $order->phone }} <br> Mail: {{ $order->email }}</td>
                                            <td> {{ $order->created_at }} </td>
                                            <td>{{ $order->name }}</td>
                                            <td><div><img src="public/assetF/images/{{ $order->image }}"></div></td>
                                            <td>{{ $order->money }} $</td>
                                            <td>{{ $order->quantity }}</td>
                                            <td>{{ $order->size }}</td>
                                            <td>{{ $order->color }}</td>
                                            <td>COD</td>
                                            <td>{{ $order->letter }}</td>
                                            <td>
                                                @if( $order->status == 0 && $order->cancel == 0 )
                                                    <button id="{{ $order->code_order }}" dataorder="{{ $order->id }}" class="btn btn btn-success button-move">Move to Confirm</button>
                                                @elseif( $order->status == 1 && $order->cancel == 0 && $name == 'Order Confirm' )
                                                    <button id="{{ $order->code_order }}" dataorder="{{ $order->id }}" class="btn btn btn-danger button-cancel">Move to Cancel</button>
                                                @endif
                                                
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<script type="text/javascript">
        jQuery(document).ready(function(){

            jQuery('.button-move').click(function(){
                var data_codeorder = jQuery(this).attr('id');
                var data_id_dt_order = jQuery(this).attr('dataorder');
                var result = confirm("Want to confirm order : "+ jQuery(this).parent('td').parent('tr').find('.code_order').html());
                if( result )
                {
                    jQuery.ajax({
                        url: '/Karma/vendor/confirmorder',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            _token: '<?php echo csrf_token() ?>',
                            'id_order': data_codeorder,
                            'id_dt_order': data_id_dt_order
                        },
                        success: function(data){
                            alert('Confirm order :'+data_id_dt_order+' Success !!');
                            jQuery('.order-'+data_id_dt_order).remove();
                            var count = data['count'];
                            jQuery('.countnumberorder').html(count);
                            var quan = jQuery('.tr-order').length;
                            if( quan == 0 )
                            {
                                jQuery('#bootstrap-data-table').html('<p style="text-align: center;font-size: 24px;color: #333;font-weight: 600;"> No Order !</p>');
                            }
                        }
                    });
                }
            });

            jQuery('.button-cancel').click(function(){
                var data_codeorder = jQuery(this).attr('id');
                var data_id_dt_order = jQuery(this).attr('dataorder');
                var result = confirm("Want to cancel order : "+ jQuery(this).parent('td').parent('tr').find('.code_order').html());
                if( result )
                {
                    jQuery.ajax({
                        url: '/Karma/vendor/cancelorder',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            _token: '<?php echo csrf_token() ?>',
                            'id_order': data_codeorder,
                            'id_dt_order': data_id_dt_order
                        },
                        success: function(data){
                            alert('Cancel order :'+data_id_dt_order+' Success !!');
                            jQuery('.order-'+data_id_dt_order).remove();
                            var count = data['count'];
                            jQuery('.countnumberorder').html(count);
                            var quan = jQuery('.tr-order').length;
                            if( quan == 0 )
                            {
                                jQuery('#bootstrap-data-table').html('<p style="text-align: center;font-size: 24px;color: #333;font-weight: 600;"> No Order !</p>');
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection