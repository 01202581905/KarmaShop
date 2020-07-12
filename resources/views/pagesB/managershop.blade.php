@extends('pagesB.master')
@section('title_admin')
Manager Shop | Admin | COZA
@endsection
@section('contentserver')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<div class="submitorder" style="width: 100vw;position: fixed;left: 0px;
    height: 100vh;
    background-color: rgba(137,137,137,0.5);
    display: none;
    z-index: 1120;top: 0px;justify-content: center;align-items: center;">
    <div style="width: 500px;height: 250px;background-color: #fff;border-radius: 5px;z-index: 9999;border: solid 1px #33333350;display: flex;justify-content: center;align-items: center;">
        <div>
        <h2 style="font-family: Poppins-Regular;font-size: 32px;text-align: center;line-height: 1.5;padding: 0px 24px;">Update Successful!</h2>
            <p style="margin: auto;
    font-size: 24px;
    font-family: Poppins-Regular;
    width: fit-content;
    padding: 8px 48px;
    border-radius: 5px;
    background-color: #333;
    color: #fff;
    margin-top: 12px;cursor: pointer;" id="submitorder"><a style="text-decoration: none;color: #fff;" class="submitok">Ok</a></p>
        </div>
    </div>
    </div>
<div class="content" style="overflow-x: scroll;">
            <div class="animated fadeIn">
                <div class="row">
                    
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="countnumbershop">{{ count($shops) }} </strong><strong class="card-title">{{ $name }}</strong>
                                <div style="display: inline-block;margin-left: 30px;">
                                <form action="{{ route('searchshop') }}" method="GET">
                                    @if( $name == 'Shop' )
                                        <input type="hidden" name="t" value="shop" style="display: none;">
                                    @elseif( $name == 'Shop Locked' )
                                        <input type="hidden" name="t" value="lock" style="display: none;">
                                    @endif
                                    <input type="text" style="border-radius: 3px;box-sizing: none;box-shadow: none;border: solid 0.5px #d9d9d9;padding: 5px 30px;font-size: 14px;" name="nameshop" placeholder="search shop name...">
                                    <button type="submit" style="transform: translateY(-2px);padding: 5px 20px;" class="btn btn-primary btn-sm"><i class="fa fa-search"></i>&nbsp; Search</button>
                                </form>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    @if( count($shops) > 0 )
                                    <thead>
                                        <tr>
                                            <th width="12%;" style="text-align: center;">Name Shop</th>
                                            <th width="8%;" style="text-align: center;">Phone</th>
                                            <th width="10%;" style="text-align: center;">Mail </th>
                                            <th width="30%;" style="text-align: center;">Address</th>
                                            <th width="10%;" style="text-align: center;">Bank Account</th>
                                            @if( isset( $suggest ) && $suggest == true )
                                            <th width="20%;" style="text-align: center;">Letter</th>
                                            @else
                                            <th width="15%;" style="text-align: center;">Quantity Product</th>
                                            @endif
                                            <th width="15%;" style="text-align: center;">Option</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach( $shops as $shop )
                                        <tr id="dataid{{ $shop->id }}" class="shop_suggest">
                                            <td> {{ $shop->name_shop }} </td>
                                            <td> {{ $shop->phone_shop }} </td>
                                            <td> {{ $shop->mail_shop }}</td>
                                            <td> {{ $shop->address_shop }}</td>
                                            <td> 4040402495402 </td>
                                            @if( isset( $suggest ) && $suggest == true )
                                            <td> {{ $shop->letter }} </td>
                                            <td><a href="javascipt:void(0)" dataid="{{ $shop->id }}" id="approve" style="color: #fff;background-color: #28a745;padding: 5px 10px;border-radius: 5px;margin-right: 20px;">Approve</a><a id="deactive" href="javascipt:void(0)" style="color: #fff;background-color: #dc3545;padding: 5px 10px;border-radius: 5px;">Deactive</a></td>
                                            @else
                                            <td> {{ $shop->name_shop }} </td>
                                            <td><a id="lock" href="javascipt:void(0)" style="color: #fff;background-color: red;padding: 5px 10px;border-radius: 5px;">Lock</a></td>
                                            @endif
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    @else
                                    <thead>
                                        <tr>
                                            <th width="100%;" style="text-align: center;">No Shop</th>
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

            jQuery('.submitok').click(function(){
                jQuery('.submitorder').fadeOut('500');
                var data = jQuery(this).attr('dataid');
                jQuery('#'+data).remove();
                var quan = jQuery('.shop_suggest').length;
                if( quan == 0)
                {
                    jQuery('.card-body').html('<p style="text-align: center;font-size: 24px;color: #333;font-weight: 600;"> No Shop Suggest !</p>');
                }
            });

            jQuery('#approve').click(function(){
                var id_suggest = jQuery(this).attr('dataid');
                    $.ajax({
                        url: '/Karma/serverkarma/updatesuggest',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            _token:         '<?php echo csrf_token() ?>',
                            "id_suggest":        id_suggest,
                        },
                        success: function(data){
                            jQuery('.submitorder').css('display','flex');
                            jQuery('.submitok').attr('dataid','dataid'+id_suggest);
                            jQuery('.countnumbershop').html(data['count']);
                        },
                    });    
            });
        });
    </script>
@endsection