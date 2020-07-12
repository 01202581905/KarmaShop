@extends('pagesB.master')
@section('title_admin')
My Product | Admin | COZA
@endsection
@section('contentserver')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<div class="content">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong id="quantityproduct">{{ count($products) }}</strong><strong class="card-title"> Product</strong><div style="display: inline-block;margin-left: 76%;cursor: pointer;font-weight: 600;    padding: 6px 24px;background-color: #66bb6a;border-radius: 5px;"><a style="color: #fff" href="{{ route('addnewproduct') }}">New Product</a></div>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    @if( count($products) > 0 )
                                    <thead>
                                        <tr>
                                            <th width="20%;" style="text-align: center;">Image Product</th>
                                            <th width="25%;" style="text-align: center;">Name Product</th>
                                            <th width="10%;" style="text-align: center;">Quantity</th>
                                            <th width="10%;" style="text-align: center;">Price</th>
                                            <th width="12%;" style="text-align: center;">promotional</th>
                                            <th width="20%;" style="text-align: center;">Option</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach( $products as $product )
                                        <tr class="tr-procduct product-{{ $product->id }}">
                                            <td><div style="margin: auto;background-size: cover;width: 100px;height: 120px;background-image: url(public/assetF/images/{{ $product->image }});";></div></td>
                                            <td class="nameproduct"> {{ $product->name }} </td>
                                            <td> {{ $product->quantity }}</td>
                                            <td> {{ $product->price }}</td>
                                            <td> {{ $product->promotional }}</td>
                                            <td><a  class="buttondelete" dataproduct="{{ $product->id }}" href="javascript:void(0)" style="color: #fff;background-color: #dc3545;padding: 5px 10px;border-radius: 5px;margin-right: 10px;">Delete</a>
                                                <a href="{{ route('updatemyproduct',$product->slug ) }}" style="color: #fff;background-color: #03a9f3;padding: 5px 10px;border-radius: 5px;">Update</a>
                                            </td>
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

            jQuery('.buttondelete').click(function(){
                var dataproduct = jQuery(this).attr('dataproduct');
                var result = confirm("Want to delete "+ jQuery(this).parent('td').parent('tr').find('.nameproduct').html());
                if( result )
                {
                    console.log(dataproduct);
                    jQuery.ajax({
                        url: '/Karma/serverkarma/deleteproduct',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            _token: '<?php echo csrf_token() ?>',
                            'idpro': dataproduct
                        },
                        success: function(data){
                            alert('Lock Product'+jQuery(this).parent('td').parent('tr').find('.nameproduct').html()+'Success !!');
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