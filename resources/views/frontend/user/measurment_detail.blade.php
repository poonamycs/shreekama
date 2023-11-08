@extends('frontend.layouts.user_panel')
<style>
    .error
    {
        
        color:red;
    }
</style>
@section('panel_content')
    <div class="aiz-titlebar mb-4">
      <div class="row align-items-center">
        <div class="col-md-12">
            <h1 class="fs-20 fw-700 text-dark" style="padding-right:310px">{{ translate('Stiching Detail') }}</h1>
        </div>
      </div>
    </div>

    <!-- Basic Info-->
    <div class="card rounded-0 shadow-none border">
        <div class="card-header pt-4 border-bottom-0">
            <h5 class="mb-0 fs-18 fw-700 text-dark">{{ translate('Measurment')}}</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('measurment.update') }}" method="POST" enctype="multipart/form-data" id="stiching" class="stiching">
                @csrf
                
                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                <input type="hidden" name="order_id" value="{{$id1}}">
                <input type="hidden" name="product_id" value="{{decrypt($id2)}}">
                <div class="form-group row">
                    <label class="col-md-2 col-form-label fs-14">{{ translate('Online Stiching Service') }}<span style="color:red">*</span></label>
                        <div class="col-md-4">
                        <select class="form-control rounded-0"  name="service" id="service">
                            <option value="">Select an option</option>
                            <option value="Normal Stiching" @isset($measurment->service){{$measurment->service == "Normal Stiching"}} Selected @endisset>Normal Stiching</option>
                            <option value="Semi Formal Collection" @isset($measurment->service){{$measurment->service == "Semi Formal Collection"}} Selected @endisset>Semi Formal Collection</option>
                            <option value="Formal Collection" @isset($measurment->service){{$measurment->service == "Formal Collection"}} Selected @endisset>Formal Collection</option>
                        </select>
    
                        </div>
                    <label class="col-md-2 col-form-label fs-14 fs-14">{{ translate('Your Name') }}</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control rounded-0" placeholder="{{ translate('Your Name') }}" name="name" value="{{Auth::user()->name}}">
                    </div> 
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label fs-14">{{ translate('Your Phone') }}</label>
                    <div class="col-md-4">
                        <input type="number" class="form-control rounded-0" placeholder="{{ translate('Your Phone')}}" name="phone" value="{{Auth::user()->phone}}">
                    </div>
                    <label class="col-md-2 col-form-label fs-14">{{ translate('What is your height in Feet and Inches?') }}<span style="color:red">*</span></label>
                    <div class="col-md-4">
                        <input type="text" class="form-control rounded-0" placeholder="{{ translate('Height')}}" name="height" value="@isset($measurment){{ $measurment->height }}@endisset">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label fs-14">{{ translate('Bust In Inches') }}<span style="color:red">*</span></label>
                    <div class="col-md-4">
                        <input type="text" class="form-control rounded-0" placeholder="{{ translate('Bust')}}" name="bust" value="@isset($measurment){{ $measurment->bust }}@endisset">
                    </div>
                    <label class="col-md-2 col-form-label fs-14">{{ translate('Top Length in Inches') }}<span style="color:red">*</span></label>
                    <div class="col-md-4">
                        <input type="text" class="form-control rounded-0" placeholder="{{ translate('Top Length')}}" name="length" value="@isset($measurment){{ $measurment->length }}@endisset">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label fs-14">{{ translate('Waist in Inches') }}<span style="color:red">*</span></label>
                    <div class="col-md-4">
                        <input type="text" class="form-control rounded-0" placeholder="{{ translate('Waist')}}" name="waist" value="@isset($measurment){{ $measurment->waist }}@endisset">
                    </div>
                    <label class="col-md-2 col-form-label fs-14">{{ translate('Hips in Inches') }}<span style="color:red">*</span></label>
                    <div class="col-md-4">
                        <input type="text" class="form-control rounded-0" placeholder="{{ translate('Hips')}}" name="hip" value="@isset($measurment){{ $measurment->hip }}@endisset">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label fs-14">{{ translate('Sleeves in Inches') }}<span style="color:red">*</span></label>
                    <div class="col-md-4">
                        <input type="text" class="form-control rounded-0" placeholder="{{ translate('Sleeves')}}" name="sleeves" value="@isset($measurment){{ $measurment->sleeves }}@endisset">
                    </div>
                    <label class="col-md-2 col-form-label fs-14">{{ translate('Neck Width in Inches for front and back') }}<span style="color:red">*</span></label>
                    <div class="col-md-4">
                        <input type="text" class="form-control rounded-0" placeholder="{{ translate('Neck Width in Inches')}}" name="neck" value="@isset($measurment){{ $measurment->neck }}@endisset">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label fs-14">{{ translate('Thigh Width (Circumference in Inches) ') }}<span style="color:red">*</span></label>
                    <div class="col-md-4">
                        <input type="text" class="form-control rounded-0" placeholder="{{ translate('Thigh Width')}}" name="thigh" value="@isset($measurment){{ $measurment->thigh }}@endisset">
                    </div>
                    <label class="col-md-2 col-form-label fs-14">{{ translate('Knee Width (Circumference in Inches)') }}<span style="color:red">*</span></label>
                    <div class="col-md-4">
                        <input type="text" class="form-control rounded-0" placeholder="{{ translate('Knee Width')}}" name="knee" value="@isset($measurment){{ $measurment->knee }}@endisset">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label fs-14">{{ translate('Bottom Length in Inches') }}<span style="color:red">*</span></label>
                    <div class="col-md-4">
                        <input type="text" class="form-control rounded-0" placeholder="{{ translate('Bottom Length')}}" name="bottom_length" value=" @isset($measurment){{ $measurment->bottom_length }}@endisset">
                    </div>
                    
                    <label class="col-md-2 col-form-label fs-14">{{ translate('Type of Bottom') }}<span style="color:red">*</span></label>
                    <div class="col-md-4">
                        <select name="bottom" class="form-control rounded-0">
                            <option value="">Select an option</option>
                            <option value="Trouser" @isset($measurment->bottom){{$measurment->bottom == "Trouser"}} Selected @endisset>Trouser</option>
                            <option value="Churidar" @isset($measurment->bottom){{$measurment->bottom == "Churidar"}} Selected @endisset>Churidar</option>
                            <option value="Shalwar" @isset($measurment->bottom){{$measurment->bottom == "Shalwar"}} Selected @endisset>Shalwar</option>
                            <option value="Parallel" @isset($measurment->bottom){{$measurment->bottom == "Parallel"}} Selected @endisset>Parallel</option>
                        </select>
                        
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label fs-14">{{ translate('Type of Sleeves') }}<span style="color:red">*</span></label>
                    <div class="col-md-4">
                        <select name="umberrla" class="form-control rounded-0">
                            <option value="">Select an option</option>
                            <option value="Umberrla" @isset($measurment->umberrla){{$measurment->umberrla == "Umberrla"}} Selected @endisset>Umberrla</option>
                            <option value="3/4" @isset($measurment->umberrla){{$measurment->umberrla == "3/4"}} Selected @endisset>3/4</option>
                        </select>
                        
                        </div>
                    
                    <label class="col-md-2 col-form-label fs-14">{{ translate('Have you taken the measurements using Body or Garment ?') }}<span style="color:red">*</span></label>
                    <div class="col-md-4">
                        <select name="garment" class="form-control rounded-0">
                            <option value="">Select an option</option>
                            <option value="Garment" @isset($measurment->garment){{$measurment->garment == "Garment"}} Selected @endisset>Garment</option>
                            <option value="Body" @isset($measurment->garment){{$measurment->garment == "Body"}} Selected @endisset>Body</option>
                        </select>
                        
                        </div>
                    
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label fs-14">{{ translate('Any other information you would like to give?') }}</label>
                    <div class="col-md-10">
                        <textarea class="form-control rounded-0" name="information" placeholder="{{ translate('Share your info here')}}" col="10" row="10"> @isset($measurment){{ $measurment->information }}@endisset
                        </textarea>
                    </div>
                </div>
                <input type="hidden" id="amount" name="amount" value="10000">
                <!-- Submit Button-->
                <div class="form-group mb-0 text-right">
                
                    <button type="submit" class="btn btn-primary rounded-0 mt-3">{{translate('Update')}}</button>
                    <!-- <button type="submit" class="btn btn-primary rounded-0 mt-3">{{translate('Update & Pay')}}</button> -->

                </div>
                
            </form>
        </div>
    </div>

@endsection

<script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.19.0/jquery.validate.min.js" defer></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
@section('script')
    <script type="text/javascript">
        $('.new-email-verification').on('click', function() {
            $(this).find('.loading').removeClass('d-none');
            $(this).find('.default').addClass('d-none');
            var email = $("input[name=email]").val();

            $.post('{{ route('user.new.verify') }}', {_token:'{{ csrf_token() }}', email: email}, function(data){
                data = JSON.parse(data);
                $('.default').removeClass('d-none');
                $('.loading').addClass('d-none');
                if(data.status == 2)
                    AIZ.plugins.notify('warning', data.message);
                else if(data.status == 1)
                    AIZ.plugins.notify('success', data.message);
                else
                    AIZ.plugins.notify('danger', data.message);
            });
        });
        $(document).ready(function () {

        // var form = document.getElementById('stiching');
        // form.addEventListener('submit', function(e) {
        //     e.preventDefault();
        //     fetch(form.action, {
        //         method: 'POST',
        //         headers: {
        //             'Content-Type': 'application/json',
        //             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        //         },
        //         body: JSON.stringify({
        //             amount: form.amount.value
        //         })
        //     })
        //     .then(function(response) {
        //         return response.json();
        //     })
        //     .then(function(data) {
                
        //         var options = {
        //             key: '{{config('app.razor_key')}}', // Replace with your actual Razorpay key
        //             amount: 10000,
        //             currency: 'INR',
        //             name: 'YCS',
        //             description: 'Payment for Order',
        //             order_id: data.orderId,
                    
        //             handler: function(response) {
        //                 // Handle the successful payment response
        //                 // You can redirect the user or perform any necessary actions
        //                 console.log(response);
        //             },
        //             prefill: {
        //                 name: 'John Doe',
        //                 email: 'john@example.com',
        //                 contact: '9876543210'
        //             },
        //             theme: {
        //                 color: '#F37254'
        //             }
                    
        //         };
        //         var razorpay = new Razorpay(options);
        //         razorpay.open();
        //     })
        //     .catch(function(error) {
        //         console.log(error);
        //     });
        // });

        $("#stiching").validate({
            rules:{
                service:{
                    required : true,
                },
                height:{
                    required:true,
                },
                bust:{
                    required:true,
                },
                length:{
                    required:true,
                },
                waist:{
                    required:true,
                },
                hips:{
                    required:true,
                },
                sleeves:{
                    required:true,
                },
                neck:{
                    required:true,
                },
                thigh:{
                    required:true,
                },
                knee:{
                    required:true,
                },
                bottom_length:{
                    required:true,
                },
                bottom:{
                    required:true,
                },
                umberrla:{
                    required:true,
                },
                garment:{
                    required:true,
                }
            },
            messages:{
                service:{
                    required: "Please select an option",
                },
                height:{
                    required: "Please enter height value",
                },
                bust:{
                    required: "Please enter bust value",
                },
                length:{
                    required: "Please enter length value",
                },
                waist:{
                    required: "Please enter waist value",
                },
                hips:{
                    required: "Please enter hips value",
                },
                sleeves:{
                    required: "Please enter sleeves value",
                },
                neck:{
                    required: "Please enter neck value",
                },
                thigh:{
                    required: "Please enter thigh value",
                },
                knee:{
                    required: "Please enter knee value",
                },
                bottom_length:{
                    required: "Please enter bottom_length value",
                },
                bottom:{
                    required: "Please Select an option",
                },
                umberrla:{
                    required: "Please Select an option",
                },
                garment:{
                    required: "Please Select an option",
                }
            },
            submitHandler: function(form) {
                $(".stiching").attr("disabled", true);
                form.submit();
            }
            });
        });
    </script>

    @if (get_setting('google_map') == 1)
        @include('frontend.partials.google_map')
    @endif
    
@endsection
