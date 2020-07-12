@extends('pagesB.master')
@section('title_admin')
Manager Product | Admin | COZA
@endsection
@section('contentserver')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<div class="content">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong id="quantityproduct">{{ count($products) }}</strong><strong class="card-title">  {{ $name }}</strong>
                                <div style="display: inline-block;margin-left: 30px;">
                                <form action="{{ route('searchproduct') }}" method="GET">
                                    @if( $name == 'Product' )
                                        <input type="hidden" name="t" value="product" style="display: none;">
                                    @elseif( $name == 'Product Locked' )
                                        <input type="hidden" name="t" value="lock" style="display: none;">
                                    @endif
                                    <input type="text" style="border-radius: 3px;box-sizing: none;box-shadow: none;border: solid 0.5px #d9d9d9;padding: 5px 30px;font-size: 14px;" name="nameproduct" placeholder="search product name...">
                                    <button type="submit" style="transform: translateY(-2px);padding: 5px 20px;" class="btn btn-primary btn-sm"><i class="fa fa-search"></i>&nbsp; Search</button>
                                </form>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    @if( count($products) > 0 )
                                    <thead>
                                        <tr>
                                            <th width="20%;" style="text-align: center;">Image Product</th>
                                            <th width="20%;" style="text-align: center;">Name Product</th>
                                            <th width="12%;" style="text-align: center;">Vendor</th>
                                            <th width="15%;" style="text-align: center;">Option</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach( $products as $product )
                                        <tr class="tr-procduct product-{{ $product->id }}">
                                            <td><div style="background-size: cover;width: 180px;height: 180px;background-image: url(public/assetF/images/{{ $product->image }});";></div></td>
                                            <td class="nameproduct"> {{ $product->name }} </td>
                                            <td> {{ $product->id_vendor }}</td>
                                            @if ( $name == 'Product Locked' )
                                            <td style="text-align: center;"><a dataproduct="{{ $product->id }}" class="buttonunlock" href="javascript:void(0)" style="color: #fff;background-color: red;padding: 5px 10px;border-radius: 5px;">UnLock</a></td>
                                            @else
                                                <td style="text-align: center;"><a dataproduct="{{ $product->id }}" class="buttonlock" href="javascript:void(0)" style="color: #fff;background-color: red;padding: 5px 10px;border-radius: 5px;">Lock</a></td>
                                            @endif
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    @else
                                        <tr>
                                            <th width="100%;" style="text-align: center;">No Product</th>
                                        </tr>
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

            jQuery('.buttonlock').click(function(){
                var dataproduct = jQuery(this).attr('dataproduct');
                var result = confirm("Want to lock "+ jQuery(this).parent('td').parent('tr').find('.nameproduct').html());
                if( result )
                {
                    console.log(dataproduct);
                    jQuery.ajax({
                        url: '/Karma/serverkarma/lockproduct',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            _token: '<?php echo csrf_token() ?>',
                            'idpro': dataproduct
                        },
                        success: function(data){
                            alert('Delete Product'+jQuery(this).parent('td').parent('tr').find('.nameproduct').html()+'Success !!');
                            jQuery('.product-'+dataproduct).remove();
                            var count = data['count'];
                            jQuery('#quantityproduct').html(count);
                            var quan = jQuery('.tr-procduct').length;
                            if( quan == 0 )
                            {
                                jQuery('.card-body').html('<p style="text-align: center;font-size: 24px;color: #333;font-weight: 600;"> No Product !</p>');
                            }
                        }
                    });
                }
            });

            jQuery('.buttonunlock').click(function(){
                var dataproduct = jQuery(this).attr('dataproduct');
                var result = confirm("Want to unlock "+ jQuery(this).parent('td').parent('tr').find('.nameproduct').html());
                if( result )
                {
                    console.log(dataproduct);
                    jQuery.ajax({
                        url: '/Karma/serverkarma/unlockproduct',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            _token: '<?php echo csrf_token() ?>',
                            'idpro': dataproduct
                        },
                        success: function(data){
                            alert('Delete Product'+jQuery(this).parent('td').parent('tr').find('.nameproduct').html()+'Success !!');
                            jQuery('.product-'+dataproduct).remove();
                            var count = data['count'];
                            jQuery('#quantityproduct').html(count);
                            var quan = jQuery('.tr-procduct').length;
                            if( quan == 0 )
                            {
                                jQuery('.card-body').html('<p style="text-align: center;font-size: 24px;color: #333;font-weight: 600;"> No Product !</p>');
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection