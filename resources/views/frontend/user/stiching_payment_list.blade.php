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
            <form action="{{ url('/measurment-payment/'.$id1.'/'.$id2) }}" method="POST" enctype="multipart/form-data" id="stiching" class="stiching">
                @csrf
                <script
                        src="https://checkout.razorpay.com/v1/checkout.js"
                        data-key="{{config('app.razor_key')}}"
                        data-amount="10000"
                        data-currency="INR"
                        data-buttontext="Update & Pay"
                        data-name="Shreekama creation"
                        data-description="Pay your amount securely"
                                    
                        data-theme.color="#2C681F"
                        data-theme.class="btn btn-main btn-fullwidth color-2"
                    ></script> 
                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                <input type="hidden" name="order_id" value="{{$id1}}">
                <input type="hidden" name="product_id" value="{{$id2}}">
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
                </div>
                
                
            </form>
        </div>
    </div>

@endsection

<script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.19.0/jquery.validate.min.js" defer></script>
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
       
    </script>

    @if (get_setting('google_map') == 1)
        @include('frontend.partials.google_map')
    @endif
    
@endsection
