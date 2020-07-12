@section('title')
Signin | COZA
@endsection
@extends('pagesF.master')
@section('content')
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<style type="text/css">
    body{
  width: 100%;
  height: auto;
  font-family: "Robato",sans-serif;
  font-size: 17px;
}

#logreg-forms{
    width:412px;
    margin:10vh auto;
    background-color:#ffffff4d;
    box-shadow: 0 7px 7px rgba(0, 0, 0, 0.12), 0 12px 40px rgba(0,0,0,0.24);
  transition: all 0.3s cubic-bezier(.25,.8,.25,1);
}

#logreg-forms form {
    width: 100%;
    max-width: 410px;
    padding: 15px;
    margin: auto;
}
#logreg-forms .form-control {
    position: relative;
    box-sizing: border-box;
    height: auto;
    padding: 10px;
    font-size: 16px;
}
#logreg-forms .form-control:focus { z-index: 2; }
#logreg-forms .form-signin input[type="email"] {
    margin-bottom: -1px;
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 0;
}
#logreg-forms .form-signin input[type="password"] {
    border-top-left-radius: 0;
    border-top-right-radius: 0;
}

#logreg-forms .social-login{
    width:390px;
    margin:0 auto;
    margin-bottom: 14px;
}
#logreg-forms .social-btn{
    font-weight: 100;
    color:white;
    width:190px;
    font-size: 0.9rem;
}

#logreg-forms a{
    display: block;
    padding-top:10px;
    color:#333333;
}

#logreg-form .lines{
    width:200px;
    border:1px solid red;
}


#logreg-forms button[type="submit"]{ margin-top:10px; }

#logreg-forms .facebook-btn{  background-color:#3C589C; }

#logreg-forms .google-btn{ background-color: #DF4B3B; }

#logreg-forms .form-reset { display: none; }

#logreg-forms .form-signup .social-btn{ width:210px; }

#logreg-forms .form-signup input { margin-bottom: 2px;}

.form-signup .social-login{
    width:210px !important;
    margin: 0 auto;
}

.submit{
  background: -webkit-linear-gradient(0deg,  #2dfbff 0%, #3c96ff 100%);
  border-radius: 5px;
  color: #fff;
}

/* Mobile */

@media screen and (max-width:500px){
    #logreg-forms{
        width:300px;
    }

    #logreg-forms  .social-login{
        width:200px;
        margin:0 auto;
        margin-bottom: 10px;
    }
    #logreg-forms  .social-btn{
        font-size: 1.3rem;
        font-weight: 100;
        color:white;
        width:200px;
        height: 56px;

    }
    #logreg-forms .social-btn:nth-child(1){
        margin-bottom: 5px;
    }
    #logreg-forms .social-btn span{
        display: none;
    }
    #logreg-forms  .facebook-btn:after{
        content:'Facebook';
    }

    #logreg-forms  .google-btn:after{
        content:'Google+';
    }

}
</style>
<body>
    <div id="logreg-forms">
            @if( Session('success') )
            <div>
                <h2 style="font-family: sans-serif;text-align: center;color: #4CAF50;padding: 20px 40px;background-color: #FFFFFF;border-radius: 5px;font-size: 36px;">{{session('success')}}</h2>
            </div>
            @endif
            <form action="{{ route('signin') }}" class="form-signup" method="POST">
                @csrf
                <div class="social-login">
                    <button class="btn facebook-btn social-btn" type="button"><span>Sign up with Facebook</span> </button>
                  </div>
                  <div class="social-login">
                    <button class="btn google-btn social-btn" type="button"><span> Sign up with Google+</span> </button>
                </div>

                <p style="text-align:center">OR</p>
                <input name="email" type="email" id="user-email" class="form-control" placeholder="Email address" required autofocus="" style="margin-bottom: 15px;">
                <input name="password" type="password" id="user-pass" class="form-control" placeholder="Password" required autofocus="" style="margin-bottom: 15px;">
                <input name="confirmpassword" type="password" id="user-repeatpass" class="form-control" placeholder="Confirm Password" required autofocus="" style="margin-bottom: 15px;">
                <input name="name" type="text" id="user-name" class="form-control" placeholder="Name" required="" autofocus="" style="margin-bottom: 15px;">
                <input name="phone" type="number" id="phone-name" class="form-control" placeholder="Phone" required="" autofocus="" style="margin-bottom: 15px;">
                <input name="address" type="text" id="phone-name" class="form-control" placeholder="Address" required="" autofocus="" style="margin-bottom: 15px;">
                

<div class="input-group">
    <div style="text-align: center;margin-top: 20px;margin-bottom: 10px;color: #ff0000;">
            @if( count($errors) > 0 )
                @foreach( $errors->all() as $error )
                    {{ $error }}
                @endforeach
            @endif
    </div>
  <button class="btn btn-md btn-block submit" type="submit"> Sign Up</button>
</div>
<a href="{{ route('login') }}" id="cancel_reset"> Have an account?</a>
            </form>
    </div>


<script type="text/javascript">
    function toggleResetPswd(e){
    e.preventDefault();
    $('#logreg-forms .form-signin').toggle() // display:block or none
    $('#logreg-forms .form-reset').toggle() // display:block or none
}

function toggleSignUp(e){
    e.preventDefault();
    $('#logreg-forms .form-signin').toggle(); // display:block or none
    $('#logreg-forms .form-signup').toggle(); // display:block or none
}

$(()=>{
    // Login Register Form
    $('#logreg-forms #forgot_pswd').click(toggleResetPswd);
    $('#logreg-forms #btn-signup').click(toggleSignUp);
    $('#logreg-forms #cancel_signup').click(toggleSignUp);
})
</script>
@endsection