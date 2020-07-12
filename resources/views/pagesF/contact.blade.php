@extends('pagesF.master')
@section('title')
Contact | COZA
@endsection
@section('content')
<style>
    #h22log{
        width: 60%;
        -webkit-animation-name: scrolldiv;
        -webkit-animation-duration: 2.5s;  /* Safari 4.0 - 8.0 */  
        -webkit-animation-fill-mode: forwards; /* Safari 4.0 - 8.0 */
        animation-fill-mode: forwards;
        animation-name: scrolldiv;
    }

    @-webkit-keyframes scrolldiv {
        from {top: 0px;}
        to {top: 40%;}
    }

    @keyframes scrolldiv {
        from {top: 0px;}
        to {top: 40%;;}
    }

</style>
    <section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('public/assetF/images/bg-01.jpg');margin-top: 70px;">
        <h2 class="ltext-105 cl0 txt-center">
            Contact
        </h2>
    </section>  

    @if( Session('thanks') )
    <div style="position: relative;z-index: 9999;left: 20%;" id="h22log">
        <h2 style="font-family: sans-serif;text-align: center;color: #4CAF50;padding: 20px 40px;background-color: #FFFFFF;border-radius: 5px;font-size: 36px;">{{session('thanks')}}</h2>
    </div>
    @endif
    <!-- Content page -->
    <section class="bg0 p-t-104 p-b-116">
        <div class="container">
            <div class="flex-w flex-tr">
                <div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
                    <form action="{{ route('submitcontactform') }}" method="POST">
                        @csrf
                        <h4 class="mtext-105 cl2 txt-center p-b-30">
                            Send Us A Message
                        </h4>

                        <div class="bor8 m-b-20 how-pos4-parent">
                            <input class="stext-111 cl2 plh3 size-116 p-l-28 p-r-30" type="text" required="" name="name" placeholder="Your Name">
                        </div>

                        <div class="bor8 m-b-20 how-pos4-parent">
                            <input class="stext-111 cl2 plh3 size-116 p-l-28 p-r-30" type="email" required="" name="email" placeholder="Your Email Address">
                        </div>

                        <div class="bor8 m-b-30">
                            <textarea class="stext-111 cl2 plh3 size-120 p-lr-28 p-tb-25" required="" name="msg" placeholder="How Can We Help?"></textarea>
                        </div>
                         @if( count($errors) > 0 )
                            @foreach( $errors->all() as $error )
                                {{ $error }}
                            @endforeach
                        @endif
                        <input type="submit" class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer" value="Submit">
                    </form>
                </div>

                <div class="size-210 bor10 flex-w flex-col-m p-lr-93 p-tb-30 p-lr-15-lg w-full-md">
                    <div class="flex-w w-full p-b-42">
                        <span class="fs-18 cl5 txt-center size-211">
                            <span class="lnr lnr-map-marker"></span>
                        </span>

                        <div class="size-212 p-t-2">
                            <span class="mtext-110 cl2">
                                Address
                            </span>

                            <p class="stext-115 cl6 size-213 p-t-18">
                                Coza Store Center 8th floor, 379 Hudson St, New York, NY 10018 US
                            </p>
                        </div>
                    </div>

                    <div class="flex-w w-full p-b-42">
                        <span class="fs-18 cl5 txt-center size-211">
                            <span class="lnr lnr-phone-handset"></span>
                        </span>

                        <div class="size-212 p-t-2">
                            <span class="mtext-110 cl2">
                                Lets Talk
                            </span>

                            <p class="stext-115 cl1 size-213 p-t-18">
                                +0 70 2581 905
                            </p>
                        </div>
                    </div>

                    <div class="flex-w w-full">
                        <span class="fs-18 cl5 txt-center size-211">
                            <span class="lnr lnr-envelope"></span>
                        </span>

                        <div class="size-212 p-t-2">
                            <span class="mtext-110 cl2">
                                Sale Support
                            </span>

                            <p class="stext-115 cl1 size-213 p-t-18">
                                trongphoenix@gmail.com
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection