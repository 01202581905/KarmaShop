  @extends('pagesF.master')
@section('title')
My Account | COZA
@endsection
@section('content')
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<style type="text/css">
#huhuform form {
  background: #fff;
  padding: 2em 2em 1em;
  max-width: 600px;
  width: 600px;
  margin: 100px auto 0;
  box-shadow: 0 0 1em #222;
  border-radius: 5px;
}
#huhuform p {
  margin: 0 0 1em 0;
  position: relative;
}
#huhuform label {
  display: block;
  font-size: 1.6em;
  margin: 0 0 .5em;
  color: #333;
}
#huhuform input {
  display: block;
  box-sizing: border-box;
  width: 100%;
  outline: none
}
#huhuform input[type="text"],
#huhuform input[type="password"] {
  background: #f5f5f5;
  border: 1px solid #e5e5e5;
  font-size: 1.6em;
  padding: .1em .5em;
  border-radius: 5px;
}
#huhuform input[type="text"]:focus,
#huhuform input[type="password"]:focus {
  background: #fff
}
#huhuform span {
  border-radius: 5px;
  display: block;
  font-size: 1.3em;
  text-align: center;
  position: absolute;
  background: #299842;
  left: 105%;
  top: 25px;
  font-size: 16px;
  width: 250px;
  padding: 7px 10px;
  color: #fff;
}
#huhuform span:after {
  right: 100%;
  top: 50%;
  border: solid transparent;
  content: " ";
  height: 0;
  width: 0;
  position: absolute;
  pointer-events: none;
  border-color: rgba(136, 183, 213, 0);
  border-right-color: #299842;
  border-width: 8px;
  margin-top: -8px;
}
#huhuform input[type="submit"] {
  background: #299842;
  border-radius: 5px;
  border: none;
  color: #fff;
  cursor: pointer;
  display: block;
  font-size: 22px;
  line-height: 1.6em;
  margin: 0.4em 0 0;
  outline: none;
  padding: .4em 0;
  text-shadow: 0 1px #68B25B;

}
</style>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<hr>
@if( Session('success') )
 <div class="submitorder" style="width: 100vw;
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
<div id="formchangepw" style="width: 100vw;height: 100vh;position: fixed;top: 0px;background-color: #33333320;z-index: 99999;display: flex;justify-content: center;align-items: center;@if( Session('error') ) display:block;@elseif( Session('error2') )  @else display: none; @endif">
    
    <div id="huhuform">

      <form action="{{ route('changepassword') }}" method="POST" style="position: relative;">
        @csrf
        <div id="closeform" style="position: absolute;
    top: -37px;
    right: -15px;
    font-size: 44px;
    color: red;cursor: pointer;">&times;</div>
      <p>
        <label for="username">Current PassWord</label>
        <input id="username" name="password" type="text">
      </p>
      <p>
        <label for="password">New Password</label>
        <input id="password" name="newpassword" type="password">
        <span>Enter a password longer than 12 characters</span>
      </p>
      <p>
        <label for="confirm_password">Confirm Password</label>
        <input id="confirm_password" name="confirm_password" type="password">
        <span>Please confirm your password</span>
      </p>
      @if( Session('error') )
        <p style="color: red;text-align: center;"> Current Password Must Different New Password !!! </p>
      @endif

      @if( Session('error2') )
        <p style="color: red;text-align: center;"> Current Password Not Correct !!! </p>
      @endif
      <p>
       
        <input id="submit" type="submit" value="Change PassWord" >
      </p>
</form>
    </div>
  </div>
</div>
<div class="container bootstrap snippet" style="margin-top: 100px;">
    <div class="row">
        <div class="col-sm-3"><!--left col-->
      
     
      
     @if( Auth::check() )
     <form action="{{ route('updateprofiled') }}" method="POST" id="registrationForm" enctype="multipart/form-data">
      <div class="text-center">
        <img style="    min-height: 170px;
    max-height: 180px;margin-bottom: 10px;" src="
        @if( Auth::user()->avatar != '' )
            public/assetF/images/avatar/{{Auth::user()->avatar}}
        @else
            http://ssl.gstatic.com/accounts/ui/avatar_2x.png
        @endif
        " class="avatar img-circle img-thumbnail" alt="avatar" style="margin-bottom: 10px;">
        <input type="file" name="imgavatar" class="text-center center-block file-upload">
      </div></hr><br>

       
        <div class="panel panel-default" style="margin-bottom: 10px;">
            <div class="panel-heading">Link to Shop <i class="fa fa-link fa-1x"></i></div>
            <div class="panel-body"><a href="http://bootnipets.com">bootnipets.com</a></div>
            <div style="margin-top: 40px;">
            <div class="panel-heading"><p id="submitchangepass" style="    margin-bottom: 0px;
    text-align: center;
    padding: 12px 24px;
    width: fit-content;
    margin: auto;
    border-radius: 3px;
    border-color: #fff;
    background-color: #28a745;
    color: #fff;
    font-size: 18px;
    cursor: pointer;">Change Password</p></div>
            </div>
          </div>
        </div>
        <div class="col-sm-9">
          <div class="tab-content">
            <div class="tab-pane active" id="home">
                <hr>
                    @csrf
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="first_name"><h4>Name</h4></label>
                              <input type="text" maxlength="20" minlength="8" class="form-control" name="name" id="first_name" placeholder="name" title="enter your first name if any." value="{{Auth::user()->name}}">
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="phone"><h4>Number Phone</h4></label>
                              <input type="number" class="form-control" name="phone" id="phone" placeholder="phone" title="enter your phone number if any." value="{{Auth::user()->phone}}">
                          </div>
                      </div>
          
                      <div class="form-group">
                          <div class="col-xs-6">
                             <label for="mobile"><h4>Mail</h4></label>
                              <input type="mail" maxlength="30" disabled minlength="15" class="form-control" name="email" id="mobile" placeholder="mail" title="enter your mobile number if any." value="{{Auth::user()->email}}">
                          </div>
                      </div>
                      <div class="form-group">
                          <div class="col-xs-6">
                              <label for="email"><h4>Address</h4></label>
                              <input type="text" maxlength="120" minlength="30" class="form-control" name="address" id="email" placeholder="somewhere" title="enter your email." value="{{Auth::user()->address}}">
                          </div>
                      </div>
                      <div class="form-group">
                           <div class="col-xs-12">
                                <br>
                                <button class="btn btn-lg btn-success" type="submit">UPDATE</button>
                            </div>
                      </div>
                </form>
              
              <hr>
              
             </div><!--/tab-pane-->
              </div>
               
              </div><!--/tab-pane-->
          </div><!--/tab-content-->
        @endif
        </div><!--/col-9-->
    </div><!--/row-->
                                                      
        <script>
            $(document).ready(function() {

              $('#closeform').click(function(){
                $('#formchangepw').fadeOut(1000);
              });

              $('#submitchangepass').click(function(){
                $('#formchangepw').fadeIn(400);
              });

              var $password = $("#password");
              var $confirmPass = $("#confirm_password");

              //Check the length of the Password
              function checkLength(){
                return $password.val().length > 12;
              }

              //Check to see if the value for pass and confirmPass are the same
              function samePass(){
                return $password.val()===$confirmPass.val();
              }

              //If checkLength() is > 8 then we'll hide the hint
              function PassLength(){
                if(checkLength()){
                  $password.next().hide();
                }else{
                  $password.next().show();
                }
              }

              //If samePass returns true, we'll hide the hint
              function PassMatch(){
                if(samePass()){
                  $confirmPass.next().hide();
                }else{
                  $confirmPass.next().show();
                }
              }
              function canSubmit(){
                return samePass() && checkLength();
              }
              function enableSubmitButton(){
                $("#submit").prop("disabled",!canSubmit());
              }
              //Calls the enableSubmitButton() function to disable the button
              enableSubmitButton();

              $password.keyup(PassLength).keyup(PassMatch).keyup(enableSubmitButton);
              $confirmPass.focus(PassMatch).keyup(PassMatch).keyup(enableSubmitButton);

                $('#submitorder').click(function(){
                  $('.submitorder').remove();
                });

                $('#submitchangepass').click(function(){

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