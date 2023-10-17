@extends('frontend.layouts.user_panel')

@section('panel_content')
    <div class="aiz-titlebar mb-4">
      <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="fs-20 fw-700 text-dark">{{ translate('Stiching Detail') }}</h1>
        </div>
      </div>
    </div>

    <!-- Basic Info-->
    <div class="card rounded-0 shadow-none border">
        <div class="card-header pt-4 border-bottom-0">
            <h5 class="mb-0 fs-18 fw-700 text-dark">{{ translate('Measurment')}}</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('measurment.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                <input type="hidden" name="order_id" value="{{$id1}}">
                <input type="hidden" name="product_id" value="{{decrypt($id2)}}">
                
                <div class="form-group row">
                    <label class="col-md-2 col-form-label fs-14 fs-14">{{ translate('Your Name') }}</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control rounded-0" placeholder="{{ translate('Your Name') }}" name="name" value="@isset($measurment){{ $measurment->name }}@endisset">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label fs-14">{{ translate('Your Phone') }}</label>
                    <div class="col-md-10">
                        <input type="number" class="form-control rounded-0" placeholder="{{ translate('Your Phone')}}" name="phone" value="@isset($measurment){{ $measurment->phone }}@endisset">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label fs-14">{{ translate('Your Email') }}</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control rounded-0" placeholder="{{ translate('Your Email')}}" name="email" value="@isset($measurment){{ $measurment->email }}@endisset">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label fs-14">{{ translate('What is your height in Feet and Inches? *') }}</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control rounded-0" placeholder="{{ translate('Height')}}" name="height" value="@isset($measurment){{ $measurment->height }}@endisset">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label fs-14">{{ translate('Bust In Inches *') }}</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control rounded-0" placeholder="{{ translate('Bust')}}" name="bust" value="@isset($measurment){{ $measurment->bust }}@endisset">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label fs-14">{{ translate('Top Length in Inches *') }}</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control rounded-0" placeholder="{{ translate('Top Length')}}" name="length" value="@isset($measurment){{ $measurment->length }}@endisset">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label fs-14">{{ translate('Waist in Inches *') }}</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control rounded-0" placeholder="{{ translate('Waist')}}" name="waist" value="@isset($measurment){{ $measurment->waist }}@endisset">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label fs-14">{{ translate('Hips in Inches *') }}</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control rounded-0" placeholder="{{ translate('Hips')}}" name="hip" value="@isset($measurment){{ $measurment->hip }}@endisset">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label fs-14">{{ translate('Sleeves in Inches *') }}</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control rounded-0" placeholder="{{ translate('Sleeves')}}" name="sleeves" value="@isset($measurment){{ $measurment->sleeves }}@endisset">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label fs-14">{{ translate('Neck Width in Inches for front and back *') }}</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control rounded-0" placeholder="{{ translate('Neck Width in Inches')}}" name="neck" value="@isset($measurment){{ $measurment->neck }}@endisset">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label fs-14">{{ translate('Thigh Width (Circumference in Inches) *') }}</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control rounded-0" placeholder="{{ translate('Thigh Width')}}" name="thigh" value="@isset($measurment){{ $measurment->thigh }}@endisset">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label fs-14">{{ translate('Knee Width (Circumference in Inches) *') }}</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control rounded-0" placeholder="{{ translate('Knee Width')}}" name="knee" value="@isset($measurment){{ $measurment->knee }}@endisset">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label fs-14">{{ translate('Bottom Length in Inches *') }}</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control rounded-0" placeholder="{{ translate('Bottom Length')}}" name="bottom_length" value=" @isset($measurment){{ $measurment->bottom_length }}@endisset">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label fs-14">{{ translate('Type of Bottom *') }}</label>
                    <div class="form-check">
                    <!-- <div class="aiz-radio-inline"> -->
                        <input type="radio" class="aiz-radio-inline" name="bottom" value="Trouser" @isset($measurment){{ $measurment->bottom == "Trouser" ? 'checked' : ''}} @endisset><label class="aiz-megabox pl-0 mr-2 mb-0" for="Trouser">Trouser</label>
                        <input type="radio" class="aiz-radio-inline" name="bottom" value="Churidar" @isset($measurment){{ $measurment->bottom == "Churidar" ? 'checked' : ''}}@endisset><label class="aiz-megabox pl-0 mr-2 mb-0" for="Churidar">Churidar</label>
                        <input type="radio" class="aiz-radio-inline" name="bottom" value="Shalwar" @isset($measurment){{ $measurment->bottom == "Shalwar" ? 'checked' : ''}}@endisset><label class="aiz-megabox pl-0 mr-2 mb-0" for="Shalwar">Shalwar</label>
                        <input type="radio" class="aiz-radio-inline" name="bottom" value="Parallel" @isset($measurment){{ $measurment->bottom == "Parallel" ? 'checked' : ''}}@endisset><label class="aiz-megabox pl-0 mr-2 mb-0" for="Parallel">Parallel</label>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label fs-14">{{ translate('Type of Sleeves *') }}</label>
                    <div class="col-md-2">
                        <input type="radio" class="aiz-radio-inline" name="umberrla" value="Umberrla" @isset($measurment){{ $measurment->umberrla == "Umberrla" ? 'checked' : ''}}@endisset><label class="aiz-megabox pl-0 mr-2 mb-0" for="Umberrla">Umberrla</label>
                        <input type="radio" class="aiz-radio-inline" name="umberrla" value="3/4" @isset($measurment){{ $measurment->umberrla == "3/4" ? 'checked' : ''}}@endisset><label class="aiz-megabox pl-0 mr-2 mb-0" for="3/4">3/4</label>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label fs-14">{{ translate('Have you taken the measurements using Body or Garment ? *') }}</label>
                    <div class="col-md-2">
                        <input type="radio" class="aiz-radio-inline" name="garment" value="Garment" @isset($measurment){{ $measurment->garment == "Garment" ? 'checked' : ''}}@endisset><label class="aiz-megabox pl-0 mr-2 mb-0" for="Garment">Garment</label>
                        <input type="radio" class="aiz-radio-inline" name="garment" value="Body" @isset($measurment){{ $measurment->garment == "Body" ? 'checked' : ''}}@endisset><label class="aiz-megabox pl-0 mr-2 mb-0" for="Body">Body</label>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label fs-14">{{ translate('Any other information you would like to give?') }}</label>
                    <div class="col-md-10">
                        <textarea class="form-control rounded-0" name="information" placeholder="{{ translate('Share your info here')}}" col="10" row="10"> @isset($measurment){{ $measurment->information }}@endisset
                        </textarea>
                    </div>
                </div>
                
                <!-- Submit Button-->
                <div class="form-group mb-0 text-right">
                    <button type="submit" class="btn btn-primary rounded-0 w-150px mt-3">{{translate('Update Profile')}}</button>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('modal')
    <!-- Address modal -->
    @include('frontend.partials.address_modal')
@endsection

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
