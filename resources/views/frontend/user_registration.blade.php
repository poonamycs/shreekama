@extends('frontend.layouts.app')
<style>
    label[for="name"] {
        color:red;
        margin-left:-260px;
    }
    label[for="phone"] {
        color:red;
        margin-left:-210px;
    }
    label[for="checkbox_example_1"] {
        color:red;
        margin-left:-9px;
    }
</style>
@section('content')
    <section class="gry-bg py-6"  style="background-image:url('{{asset('assets/img/registerbg.png')}}');background-size: contain;background-repeat: no-repeat;">
        <div class="profile">
            <div class="container">
                <div class="row">
                    <div class="col-xl-9 col-lg-10 mx-auto">
                        <div class=" shadow-none rounded-0 ">
                            <div class="row justify-content-end">
                                <!-- Left Side -->
                                <div class="col-lg-6 col-md-7 p-4 p-lg-5 card border">
                                    <!-- Titles -->
                                    <div class="text-center">
                                        <h1 class="fs-20 fs-md-24 fw-700 text-primary">{{ translate('Create an account')}}</h1>
                                    </div>
                                    <!-- Register form -->
                                    <div class="pt-3 pt-lg-4">
                                        <div class="">
                                            <form class="form-default" role="form" action="{{ route('register') }}" id="reg-form" method="POST">
                                                @csrf
                                                <!-- Name -->
                                                <div class="form-group">
                                                    <input type="text" class="form-control" value="{{ old('name') }}" placeholder="Full Name *" name="name" id="name">
                                                </div>
                                                <input type="hidden" name="country_code" value="91">
                                                <!-- Email or Phone -->
                                                
                                                    <div class="form-group">
                                                        {{-- <label for="email" class="fs-12 fw-700 text-soft-dark">{{  translate('Email') }}</label> --}}
                                                        <input type="email" class="form-control rounded-0{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{  translate('Email') }}" name="email">
                                                        
                                                    </div>
                                                
                                                <!-- Mobile -->
                                                <div class="form-group">
                                                    {{-- <label for="mobile" class="fs-12 fw-700 text-soft-dark">Mobile</label> --}}
                                                    <input type="text" class="form-control rounded-0{{ $errors->has('mobile') ? ' is-invalid' : '' }}" value="{{ old('mobile') }}" placeholder="Mobile *" name="phone" id="phone" minlength="10" maxlength="10">
                                                    
                                                </div>

                                                <!-- Terms and Conditions -->
                                                <div class="mb-3">
                                                    <label class="aiz-checkbox">
                                                        <input type="checkbox" name="checkbox_example_1" required>
                                                        <span class="">{{ translate('By signing up you agree to our ')}} <a href="{{ route('terms') }}" class="fw-500">{{ translate('terms and conditions.') }}</a></span>
                                                        <span class="aiz-square-check"></span>
                                                    </label>
                                                </div>

                                                <!-- Submit Button -->
                                                <div class="mb-4 mt-4">
                                                    <button type="submit" class="btn btn-primary btn-block fw-600 rounded-4">{{  translate('Create Account') }}</button>
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
                                        <div class="text-center">
                                            <p class="fs-12 text-gray mb-0">{{ translate('Already have an account?')}}</p>
                                            <a href="{{ route('user.login') }}" class="fs-14 fw-700 animate-underline-primary">{{ translate('Log In')}}</a>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Right Side Image -->
                                {{-- <div class="col-lg-6 col-md-5 py-3 py-md-0">
                                    <img src="{{ uploaded_asset(get_setting('register_page_image')) }}" alt="" class="img-fit h-100">
                                </div> --}}
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

        @if(get_setting('google_recaptcha') == 1)
        // making the CAPTCHA  a required field for form submission
        $(document).ready(function(){
            $("#reg-form").on("submit", function(evt)
            {
                var response = grecaptcha.getResponse();
                if(response.length == 0)
                {
                //reCaptcha not verified
                    alert("please verify you are humann!");
                    evt.preventDefault();
                    return false;
                }
                //captcha verified
                //do the rest of your validations here
                $("#reg-form").submit();
            });
        });
        @endif
    </script>
<script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.js'></script>
<script>
    $(document).ready(function ($) {
        $('#phone').on('keypress', function (event) {
                var x = event.which || event.keycode;
                var mobile = $('#mobile').val();
                if(!(x>=48 && x<=57))
                event.preventDefault(); 
                if((mobile.length < 0) || (mobile.length > 9))
                {
                    event.preventDefault(); 
                }
            });
            $('#name').on('keypress', function (event) {
                var inputValue = event.which;
                if(!(inputValue >= 65 && inputValue <= 90) && !(inputValue >= 97 && inputValue <= 122) && (inputValue != 32 && inputValue != 0)) { 
                    event.preventDefault(); 
                }
            });
    // jQuery.validator.addMethod("lettersonly", function(value, element) {
    //     return this.optional(element) || /^[a-zA-Z]+$/i.test(value);
    // }, "Letters only please *");
    $.validator.addMethod("Strongpassword",function(value){
        return /(?=.*[!@#$%^&*Z()<>,./?])((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/.test(value);
    },"Please use at least one capital letter, special character and number.");

    $("#reg-form").validate({
     
        rules:{
            phone:{
                required:true,
                number: true,
                maxlength:10,
                minlength:10,
            },
            password:{
                required:true,
            },
            name:{
                required:true,
            },
            
            password:{
                required:true,
                Strongpassword: true,
                minlength:6,
            },
            
            password_confirmation:{
                required:true,
            },
            checkbox_example_1:{
                required:true,
            },
           
        },
        messages:{
            phone:{
                required: "Please enter mobile number",
                number: "Please enter valid mobile number",
                maxlength: "Please enter {0} digit mobile number",
                minlength: "Please enter {0} digit mobile number",
            },
            password: {
                required:"This field is required *",
                minlength: "Your password must be atleast 6 characters long"
            },
            password_confirmation: {
                required:"This field is required *",
            },
            name:{ 
                required: "This field is required",
            },
            checkbox_example_1:{ 
                required: "Please mark this field",
            },
            
        },
        submitHandler: function(form) {
            $("#userregister").attr("disabled", true);
            form.submit();
        }
        });
    });
</script>

@endsection