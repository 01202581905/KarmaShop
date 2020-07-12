@extends('pagesF.vendor.master')
@section('title_vendor')
Detail Product | Vendor | COZA
@endsection
@section('vendor')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
@if( Session('success') )
 <div class="submitorder" style="width: 100vw;left: 0px;
    height: 100vh;
    background-color: rgba(137,137,137,0.5);
    position: fixed;
    z-index: 1120;top: 0px;display: flex;justify-content: center;align-items: center;">
    <div style="width: 500px;height: 200px;background-color: #fff;border-radius: 5px;z-index: 9999;border: solid 1px #33333350;display: flex;justify-content: center;align-items: center;">
        <div>
        <h2 style="font-family: Poppins-Regular;font-size: 28px;text-align: center;line-height: 1.5;padding: 0px 24px;">Updated Product Success !!</h2>
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
<div class="container" style="width: 100%;">
<section class="panel panel-default">
<div class="panel-heading"> 
<h3 class="panel-title">Update Detail Product</h3> 
</div> 
<div class="panel-body">
  
<form action="{{ route('updatedetailproductvendor') }}" method="POST" class="form-horizontal" enctype="multipart/form-data" role="form">
    @csrf
   <div class="form-group">
    <input type="hidden" name="id_product" value="{{ $detail_product->id }}">
    <label for="name" class="col-sm-3 control-label">Name Product</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" required name="name" id="name" value="{{ $detail_product->name }}" placeholder="product name">
    </div>
  </div> <!-- form-group // -->
  <div class="form-group">
    <label for="name" class="col-sm-3 control-label">Content</label>
    <div class="col-sm-9">
      <textarea style="height: 80px;" name="content" required class="form-control">{{ $detail_product->content }}</textarea>
    </div>
  </div> <!-- form-group // -->
  <div class="form-group">
    <label for="about" class="col-sm-3 control-label">Description</label>
    <div class="col-sm-9">
      <textarea class="form-control" name="description" required style="height: 150px;">{{ $detail_product->description }}</textarea>
    </div>
  </div> <!-- form-group // -->
  <div class="form-group">
    <label for="qty" class="col-sm-3 control-label">Quantity</label>
    <div class="col-sm-3">
   <input type="number" name="quantity" required class="form-control" value="{{ $detail_product->quantity }}" name="qty" id="qty" placeholder="quantity">
    </div>
  </div> <!-- form-group // -->
  <div class="form-group">
    <label for="name" class="col-sm-3 control-label">Option Price</label>
    <div class="col-sm-9">
        <label class="radio-inline">
      <input type="radio" name="checkpromotional" @if( $detail_product->promotional == 0  ) checked @endif class="no_promotional" id="inlineRadio1" value="false"> No Promotional
    </label>
    <label class="radio-inline">
      <input type="radio" name="checkpromotional" class="has_promotional" id="inlineRadio2" value="true"> Promotional
    </label>
    </div>
</div> <!-- form-group // -->
  <div class="form-group">
    <label class="col-sm-3 control-label">Price</label>
    <div class="col-sm-3"> 
      <label class="control-label small" for="date_start">Cost : </label>
      <input style="margin-top: 8px;" required value="{{ $detail_product->price }}" type="number" class="form-control" name="price_cost" id="inp_cost" placeholder="cost">
    </div>
    <div class="col-sm-3">   
      <label class="control-label small" for="date_finish">Promotional :</label>
      <input style="margin-top: 8px;" @if( $detail_product->promotional == 0  ) disabled @endif value="{{ $detail_product->promotional }}" type="number" class="form-control" name="price_promotional" id="inp_promotional" placeholder="promotional">
    </div>
  </div> <!-- form-group // -->

  <div class="form-group">
    <label class="col-sm-3 control-label">Image Product</label>
    <div class="col-sm-3"> 
      <img src="public/assetF/images/{{ $detail_product->image }}" class="avatar img-thumbnail" alt="avatar" style="margin-bottom: 10px;">
    </div>
  </div> <!-- form-group // -->


  <div class="form-group">
    <label for="name" class="col-sm-3 control-label">Image Product</label>
    <div class="col-sm-3">
      <label class="control-label small" for="file_img">Primary (jpg/png) :</label> <input name="imgavatar" class="text-center center-block file-upload" type="file" style="margin-top: 8px;">
    </div>
    {{-- <div class="col-sm-3">
      <label class="control-label small" for="file_img">Orther (jpg/png) :</label>  <input style="margin-top: 8px;" type="file" name="file_archive">
    </div> --}}
  </div> 
  <!-- form-group // -->
  <div class="form-group">
    <label for="tech" class="col-sm-3 control-label">Category Product</label>
    <div class="col-sm-3">
   <select id="categoryproduct" name="categoryproduct" class="form-control">
    @foreach( $cats as $cat )
        @if( $cat->id == $detail_product->id_category )
        <option selected value="{{ $cat->id }}">{{ $cat->name }}</option>
        @else
        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
        @endif
    @endforeach
   </select>
    </div>
  </div>
  <!-- form-group // -->
  <div class="form-group">
    <label for="tech" class="col-sm-3 control-label">Тype Product</label>
    <div class="col-sm-3">
   <select id="typeproduct" name="typeproduct" class="form-control">
    @foreach( $types as $type )
         @if( $type->id == $detail_product->id_type )
        <option selected value="{{ $type->id }}">{{ $type->name }}</option>
        @else
        <option value="{{ $type->id }}">{{ $type->name }}</option>
        @endif
    @endforeach
   </select>
    </div>
  </div>
  <!-- form-group // -->
  <hr>
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
      <button type="submit" class="btn btn-primary">Update Product</button>
    </div>
  </div> <!-- form-group // -->
</form>
  
</div><!-- panel-body // -->
</section><!-- panel// -->

  
</div> <!-- container// -->
    <script type="text/javascript">
        jQuery(document).ready(function(){

            jQuery('#submitorder').click(function(){
                jQuery('.submitorder').fadeOut(500);
            });

            jQuery('.no_promotional').change(function(){
                    jQuery('#inp_promotional').prop('disabled', true);
                    jQuery('#inp_promotional').val('0');
            });

            jQuery('.has_promotional').change(function(){
                    jQuery('#inp_promotional').prop('disabled', false);
            });

            jQuery('#categoryproduct').change(function(){
                var value = jQuery(this).val();
                jQuery.ajax({
                    url: '/Karma/vendor/selecttypes',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        _token: '<?php echo csrf_token() ?>',
                        'idcat': value
                    },
                    success: function(data){
                        var datatype = data['types'];
                        jQuery('#typeproduct option').remove();
                        for( type of datatype )
                        {
                            jQuery('#typeproduct').append("<option valu='"+type['id']+"'>"+type['name']+"</option>");
                        }
                    }
                });
            });

            var readURL = function(input) 
            {
                if (input.files && input.files[0]) 
                {
                    var reader = new FileReader();
                    reader.onload = function (e) 
                    {
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