@extends('pagesB.master')
@section('title_admin')
My Shop | Admin | COZA
@endsection
@section('contentserver')
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<hr>
@if( Session('success') )
 <div class="submitorder" style="width: 100vw;left: 0px;
    height: 100vh;
    background-color: rgba(137,137,137,0.5);
    position: fixed;
    z-index: 1120;top: 0px;display: flex;justify-content: center;align-items: center;">
    <div style="width: 500px;height: 200px;background-color: #fff;border-radius: 5px;z-index: 9999;border: solid 1px #33333350;display: flex;justify-content: center;align-items: center;">
        <div>
        <h2 style="font-family: Poppins-Regular;font-size: 28px;text-align: center;line-height: 1.5;padding: 0px 24px;">Updated Information Success !!</h2>
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
<div class="container bootstrap snippet">
    <div class="row">
  		<div class="col-sm-3"><!--left col-->
              
      <form class="form" action="{{ route('updatedinfoshop') }}" method="POST" id="registrationForm" enctype="multipart/form-data">
        @csrf
      <div class="text-center">
        <img src="@if( Auth::user()->avatar_shop != '' ) public/assetF/images/avatar/{{Auth::user()->avatar_shop}} @else http://ssl.gstatic.com/accounts/ui/avatar_2x.png @endif
                  " class="avatar img-circle img-thumbnail" alt="avatar" style="margin-bottom: 10px;">
        <input type="file" name="imgavatar" class="text-center center-block file-upload">
        @if( Session('error') )
        <p style="font-family: Poppins-Regular;color: red;">Update Image Fail . Please Check Type File !!</p>
        @endif
      </div></hr><br>

               
          <div class="panel panel-default" style="margin-bottom: 20px;">
            <div class="panel-heading">Link My Shop <i class="fa fa-link fa-1x"></i></div>
            <div class="panel-body"><a href="http://bootnipets.com">bootnipets.com</a></div>
          </div>
          
          
          <ul class="list-group">
            <li class="list-group-item text-muted">Activity <i class="fa fa-dashboard fa-1x"></i></li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Product</strong></span> 25</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Comment</strong></span> 13</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Order</strong></span> 37</li>
          </ul> 
          
        </div><!--/col-3-->
    	<div class="col-sm-9">
          <div class="tab-content">
            <div class="tab-pane active" id="home">
                <hr>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="first_name"><h4>Name Shop</h4></label>
                              <input type="text" class="form-control" name="name" required minlength="8" maxlength="30" id="first_name" placeholder="name" title="enter your first name if any." value="{{ Auth::user()->name_shop }}">
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="phone"><h4>Phone</h4></label>
                              <input type="number" class="form-control" required minlength="8" maxlength="15" name="phone" id="phone" placeholder="phone" title="enter your phone number if any." value="{{ Auth::user()->phone_shop }}">
                          </div>
                      </div>
          
                      <div class="form-group">
                          <div class="col-xs-6">
                             <label for="mobile"><h4>Mail</h4></label>
                              <input type="email" class="form-control" required minlength="12" maxlength="30" name="mail" id="mobile" placeholder="mail" title="enter your mobile number if any." value="{{ Auth::user()->mail_shop }}">
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="email"><h4>Address</h4></label>
                              <input type="text" required minlength="30" maxlength="80" class="form-control" name="address" id="email" placeholder="address" title="enter your email." value="{{ Auth::user()->address_shop }}">
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="email"><h4>Fanpage Facebook</h4></label>
                              <input type="text" class="form-control" required minlength="25" maxlength="80" name="fanpage" id="email" placeholder="address" title="enter your email." value="{{ Auth::user()->fanpage_facebook }}">
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="email"><h4>Status Shop</h4></label>
                              <input type="text" class="form-control" id="location" placeholder="account" disabled title="enter a location" value="@if( Auth::user()->status_shop == 1 ) Active @else Deactive @endif">
                          </div>
                      </div>

                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="email"><h4>Bank Account</h4></label>
                              <input type="number" class="form-control" id="location" placeholder="account" title="enter a location" value="4242205932950">
                          </div>
                      </div>

                      <div class="form-group">
                           <div class="col-xs-12">
                                <br>
                              	<button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i>Save Change</button>
                            </div>
                      </div>
              	</form>
              
              <hr>
              
             </div><!--/tab-pane-->
              </div>
               
              </div><!--/tab-pane-->
          </div><!--/tab-content-->
      </div><!--/col-9-->
    </div><!--/row-->
                                                      
        <script>
        	$(document).ready(function() {

          $('#submitorder').click(function(){
                $('.submitorder').remove();
              });

			    var readURL = function(input) {
			        if (input.files && input.files[0]) {
			            var reader = new FileReader();

			            reader.onload = function (e) {
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