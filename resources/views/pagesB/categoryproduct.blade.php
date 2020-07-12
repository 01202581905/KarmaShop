@extends('pagesB.master')
@section('title_admin')
Manager Category Product | Admin | COZA
@endsection
@section('contentserver')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
@if( Session('success') )
 <div class="submitorder" style="width: 100vw;left: 0px;
    height: 100vh;
    background-color: rgba(137,137,137,0.5);
    position: fixed;
    z-index: 1120;top: 0px;display: flex;justify-content: center;align-items: center;">
    <div style="width: 500px;height: 200px;background-color: #fff;border-radius: 5px;z-index: 9999;border: solid 1px #33333350;display: flex;justify-content: center;align-items: center;">
        <div>
        <h2 style="font-family: Poppins-Regular;font-size: 28px;text-align: center;line-height: 1.5;padding: 0px 24px;">{{ Session('success') }}</h2>
            <p style="margin: auto;
    font-size: 24px;
    font-family: Poppins-Regular;
    width: fit-content;
    padding: 8px 48px;
    border-radius: 5px;
    background-color: #333;
    color: #fff;
    margin-top: 12px;cursor: pointer;" id="submitorder"><a style="text-decoration: none;color: #fff;" href="javascript:void(0)">Ok</a></p>
        </div>
    </div>
    </div>
@endif
<div class="content" style="padding-top: 10px;">
    <h3>Category Product</h3>
    <div style="padding-top: 20px;">
        @foreach( $cats as $cat )
        <div class="classtoggle" style="padding-left: 50px;padding-top: 10px;border-top: solid 1px #d9d9d9;border-bottom: solid 1px #d9d9d9;">
            <h6 id="{{ $cat->id }}" style="cursor: pointer;padding-bottom: 10px;display: inline-block;width: calc(100% - 24px);">{{ $cat->name }}</h6>{{-- <i class="material-icons">arrow_downward</i> --}}
            <div class="container-p" style="padding-left: 50px;padding-top: 10px;display: none;">
                @foreach( $types as $type )
                    @if( $type->id_category == $cat->id )
                        <p style="cursor: pointer;" id="{{ $type->id }}" title="Click to edit / delete">+ {{ $type->name }}</p>
                    @endif
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
    <div style="padding-top: 40px;">
        <form action="{{ route('createnewcat') }}" method="POST">
            @csrf
            <h4 style="padding-bottom: 10px;">Create New Category</h4>
            <div>
                <label for="">Name Category</label>
                <label for="" style="padding-left: 80px;">Parent Category</label>
            </div>
            <div>
                <input type="text" name="namecat_type" required maxlength="30" minlength="8" style="height: 30px;margin-right: 10px;">
                <select name="parentcat" id="" style="height: 30px;margin-right: 10px;">
                    <option value="0">None Parent Category</option>
                    @foreach( $cats as $cat )
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
                <input type="submit" value="Create New Type / Category">
            </div>
        </form>
    </div> 
</div>
<script type="text/javascript">
    jQuery(document).ready(function(){

        $('#submitorder').click(function(){
                $('.submitorder').remove();
              });

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