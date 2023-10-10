@extends('frontend.layouts.app')

@section('content')
    <section class="gry-bg py-6">
        <div class="profile">
            <div class="container">
                <div class="row">
                    <div class="col-xl-9 col-lg-10 mx-auto">
                        <div class="card shadow-none rounded-0 border">
                            <div class="row">
                                <!-- Left Side -->
                                <div class="col-lg-6 col-md-7 p-4 p-lg-5">
                                @if(Session::has('flash_message_error'))
                              <div class="alert alert-danger alert-dismissible fade show respo" role="alert">
                                 <strong>{!! session('flash_message_error') !!}</strong>
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                 </button>
                              </div>
                              @endif
                              @if(Session::has('flash_message_success'))         
                              <div class="alert alert-success alert-dismissible fade show respo" role="alert">
                                 <strong>{!! session('flash_message_success') !!}</strong>
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                 </button>
                              </div>
                              @endif
                              
                                    <!-- Titles -->
                                    <div class="text-center">
                                        <h1 class="fs-20 fs-md-24 fw-700 text-primary">Verify OTP</h1>
                                    </div>
                                    <h7>Secure Login:Enter the Received 6 digit OTP on Your Registered Number {{Session::get('otp')}}</h7>
                                    <!-- Register form -->
                                    <div class="pt-3 pt-lg-4">
                                        <div class="">
                                            <form id="reg-form" class="form-default" role="form" action="{{ url('users/user-otp') }}" method="POST">
                                                @csrf
                                                <!-- Name -->
                                                <div class="form-group">
                                                    <label for="name" class="fs-12 fw-700 text-soft-dark">{{  translate('OTP') }}</label>
                                                    <input type="text" class="form-control rounded-0{{ $errors->has('otp') ? ' is-invalid' : '' }}" value="{{ old('otp') }}" placeholder="{{  translate('OTP') }}" name="otp" id="otp" maxlength="6">
                                                    @if ($errors->has('otp'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('otp') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>

                                                
                                                <!-- Submit Button -->
                                                <div class="mb-4 mt-4">
                                                    <button type="submit" class="btn btn-primary btn-block fw-600 rounded-4">{{  translate('Sign In') }}</button>
                                                </div>
                                            </form>
                                            <form action="{{url('users/resend-otp')}}" method="POST">@csrf
                                                <input type="hidden" name="phone" value="{{Session::get('loginuser')}}">
                                                <input type="hidden" name="type" value="resend">
                                                <div class="text-center">
                                                    <p class="mb-0">Didn't receive OTP?</p>
                                                    <button type="submit" id="btnSubmit" class="btn btn-sm mx-auto btnSubmit fontcolor d-block btn-login text-capitalize font-weight-bold mb-2 userLoginForm border-bottom">Resend OTP</button>
                                            
                                                </div>
                                            </form>
                                            <!-- Social Login -->
                                            @if(get_setting('google_login') == 1 || get_setting('facebook_login') == 1 || get_setting('twitter_login') == 1 || get_setting('apple_login') == 1)
                                                <div class="text-center mb-3">
                                                    <span class="bg-white fs-12 text-gray">{{ translate('Or Join With')}}</span>
                                                </div>
                                                <ul class="list-inline social colored text-center mb-4">
                                                    @if (get_setting('facebook_login') == 1)
                                                        <li class="list-inline-item">
                                                            <a href="{{ route('social.login', ['provider' => 'facebook']) }}" class="facebook">
                                                                <i class="lab la-facebook-f"></i>
                                                            </a>
                                                        </li>
                                                    @endif
                                                    @if(get_setting('google_login') == 1)
                                                        <li class="list-inline-item">
                                                            <a href="{{ route('social.login', ['provider' => 'google']) }}" class="google">
                                                                <i class="lab la-google"></i>
                                                            </a>
                                                        </li>
                                                    @endif
                                                    @if (get_setting('twitter_login') == 1)
                                                        <li class="list-inline-item">
                                                            <a href="{{ route('social.login', ['provider' => 'twitter']) }}" class="twitter">
                                                                <i class="lab la-twitter"></i>
                                                            </a>
                                                        </li>
                                                    @endif
                                                    @if (get_setting('apple_login') == 1)
                                                        <li class="list-inline-item">
                                                            <a href="{{ route('social.login', ['provider' => 'apple']) }}" class="apple">
                                                                <i class="lab la-apple"></i>
                                                            </a>
                                                        </li>
                                                    @endif
                                                </ul>
                                            @endif
                                        </div>

                                        <!-- Log In -->
                                        
                                    </div>
                                </div>
                                
                                <!-- Right Side Image -->
                                <div class="col-lg-6 col-md-5 py-3 py-md-0">
                                    <img src="{{ uploaded_asset(get_setting('register_page_image')) }}" alt="" class="img-fit h-100">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection


@section('script')
    @if(get_setting('google_recaptcha') == 1)
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    @endif

    <script type="text/javascript">
         $(document).ready(function() {
                $('#otp').on('keypress', function (event) {
                setTimeout(function(){
                    $('.error').hide()
                }, 1000);
                var x = event.which || event.keycode;
                var mobile = $('#mobile').val();
                if(!(x>=48 && x<=57))
                event.preventDefault(); 
                if((mobile.length < 0) || (mobile.length > 9))
                {
                    event.preventDefault(); 
                }
            });
        });
    </script>
@endsection
