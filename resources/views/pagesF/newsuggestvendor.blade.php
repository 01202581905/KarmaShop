@section('title')
Suggest New Vendor | COZA
@endsection
@extends('pagesF.master')
@section('content')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<style>
    @import "font-awesome.min.css";
@import "font-awesome-ie7.min.css";
/* Space out content a bit */
body {
  padding-top: 20px;
  padding-bottom: 20px;
}

/* Everything but the jumbotron gets side spacing for mobile first views */
.header,
.marketing,
.footer {
  padding-right: 15px;
  padding-left: 15px;
}

/* Custom page header */
.header {
  border-bottom: 1px solid #e5e5e5;
}
/* Make the masthead heading the same height as the navigation */
.header h3 {
  padding-bottom: 19px;
  margin-top: 0;
  margin-bottom: 0;
  line-height: 40px;
}

/* Custom page footer */
.footer {
  padding-top: 19px;
  color: #777;
  border-top: 1px solid #e5e5e5;
}

/* Customize container */
@media (min-width: 768px) {
  .container {
    max-width: 85%;
  }
}
.container-narrow > hr {
  margin: 30px 0;
}

/* Main marketing message and sign up button */
.jumbotron {
  text-align: center;
  border-bottom: 1px solid #e5e5e5;
}
.jumbotron .btn {
  padding: 14px 24px;
  font-size: 21px;
}

/* Supporting marketing content */
.marketing {
  margin: 40px 0;
}
.marketing p + h4 {
  margin-top: 28px;
}

/* Responsive: Portrait tablets and up */
@media screen and (min-width: 768px) {
  /* Remove the padding we set earlier */
  .header,
  .marketing,
  .footer {
    padding-right: 0;
    padding-left: 0;
  }
  /* Space out the masthead */
  .header {
    margin-bottom: 30px;
  }
  /* Remove the bottom border on the jumbotron for visual effect */
  .jumbotron {
    border-bottom: 0;
  }
}
</style>
@if( Session('success') )
 <div class="submitorder" style="width: 100vw;
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
    margin-top: 12px;cursor: pointer;" id="submitorder"><a style="text-decoration: none;color: #fff;" href="{{ route('index') }}">Ok</a></p>
        </div>
    </div>
    </div>
@endif
<div class="container" style="margin-top: 100px;">
    <h1 class="well" style="text-align: center;padding-bottom: 20px;"> Form Suggest Open Shop On COZA</h1>
    <div class="col-lg-12 well" style="padding: 12px 20px;border: solid 1px #d9d9d9;margin-bottom: 40px;">
    <div class="row">
                <form style="width: 100%;" method="POST" action="{{ route('submitopenshop') }}" enctype="multipart/form-data">
                    @csrf
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-12 form-group">
                            <label>Shop Name</label>
                            <input type="text" required name="shopname" minlength="8" maxlength="20" placeholder="Enter Shop Name Here.." class="form-control">
                        </div>
                    </div>
                    <div class="row" style="display: grid;">
                        <div class="col-sm-12 form-group">
                            <label>Avatar Shop</label>
                        <img style="max-width: 250px;max-height: 250px;margin-bottom: 10px;" src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-circle img-thumbnail" alt="avatar">
                        <input type="file" required name="imgavatar" class="text-center center-block file-upload">
                        @if( Session('error_img') )
                            <p style="padding-top: 10px;color: red;font-size: 18px;">
                                {{ Session('error_img') }}
                            </p>
                        @endif
                        @if( Session('error') )
                            <p style="padding-top: 10px;color: red;font-size: 18px;">
                                {{ Session('error') }}
                            </p>
                        @endif
                        </div>  
                    </div>                  
                    <div class="form-group">
                        <label>Address Shop</label>
                        <textarea name="addressshop" minlength="20" maxlength="70" required placeholder="Enter Address Here.." rows="3" class="form-control"></textarea>
                    </div>                    
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="number" name="phoneshop" maxlength="15" minlength="10" required placeholder="Enter Phone Number Here.." class="form-control">
                    </div>      
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" name="emailshop" maxlength="40" minlength="12" required placeholder="Enter Email Address Here.." class="form-control">
                    </div>  
                    <div class="form-group">
                        <label>Fanpage FaceBook</label>
                        <input type="text" name="fanpge" placeholder="Enter Link Fanpage FaceBook Here.." class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Account Banking</label>
                        <input type="number" name="account" maxlength="20" minlength="12" required placeholder="Enter Account Banking Here.." class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Letter</label>
                        <textarea name="letter" minlength="20" maxlength="70" required placeholder="Enter Address Here.." rows="3" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                      <label style="font-size: 22px;">Rules of Vendor</label>
                      <label> #1. Your store's products must ensure clear origin</label>
                      <label> #2. When an order is available, you need to update the order as quickly as possible, no later than within 2 days</label>
                      <label> #3. Absolutely not sell products that violate the law, if you sell products that violate the law, we can sue you to compensate for the loss if accused of trading prohibited goods.</label>
                      <label> #4. We will check the product when you come to your store to get the product, so please include the product's information on the packaging</label>
                      <label> #5. At the starting level for each store, we will take 10% commission, the shipping cost we will take care of that, if your store achieves good sales or becomes a potential store, then get a hundred percent of the amount. Commission will be reduced</label>
                      <label> #6. To ensure the environment, minimize the harmful effects. We recommend that the store's packaging be wrapped in paper</label>
                      <input type="checkbox" id="toggle-check" required style="width: fit-content;display: inline-flex;" class="form-control"><font style="padding-left: 12px;font-size: 18px;">These are the mandatory terms of a shop owner. Are you sure you agree with all of the above?</font>
                    </div>
                    <button type="submit" id="btn-submit-send" class="btn btn-lg btn-info">SEND SUGGEST</button>                   
                </div>
                </form> 
                </div>
    </div>
    </div>
    <script>
        $(document).ready(function() {

          $('#toggle-check').click(function () {
              //check if checkbox is checked
              if ($(this).is(':checked')) {
                  
                  $('#btn-submit-send').removeAttr('disabled'); //enable input
                  
              } else {
                  $('#btn-submit-send').attr('disabled', true); //disable input
              }
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