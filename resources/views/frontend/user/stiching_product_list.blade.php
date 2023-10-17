@extends('frontend.layouts.user_panel')

@section('panel_content')
    <div class="card shadow-none rounded-0 border">
        <div class="card-header border-bottom-0">
            <h5 class="mb-0 fs-20 fw-700 text-dark">{{ translate('Purchase History') }}</h5>
        </div>
        <div class="card-body">
            <table class="table aiz-table mb-0">
                <thead class="text-gray fs-12">
                    <tr>
                        <th class="pl-0">{{ translate('Name')}}</th>
                        <th>{{ translate('Image')}}</th>
                        <!-- <th data-breakpoints="md">{{ translate('Brand')}}</th> -->
                        <th>{{ translate('Amount')}}</th>
                        <th data-breakpoints="md">{{ translate('discount')}}</th>
                        
                        <th data-breakpoints="md">{{ translate('Stiching')}}</th>
                        
                    </tr>
                </thead>
                <tbody class="fs-14">
                    @foreach ($order_details as $key => $order)
                    <?php $image = App\Models\Upload::where('id',$order->product->thumbnail_img)->first();
                            ?>
                            <tr>
                                <!-- Code -->
                                
                                <td class="pl-0">
                                    {{ $order->product->name }}
                                </td>
                                
                               
                                <td class="pl-0">
                                    <img src="{{asset($image['file_name'])}}" style="height:40px;width:40px"/>
                                </td>
                                <td class="pl-0">
                                    {{ $order->product->unit_price }}
                                </td>
                                
                                <td class="pl-0">
                                    {{ $order->product->discount }}
                                </td>
                                
                                <!-- Payment Status -->
                                
                                <td>
                                    <!-- <span class="badge badge-inline badge-success p-3 fs-12" style="border-radius: 25px; min-width: 80px !important;"> -->
                                        <a class="btn btn-primary" href="{{url('/measurment-details/'.$order->order_id.'/'.encrypt($order->product->id))}}" role="button">
                                            {{translate('Stiching')}}
                                        </a>
                                    <!-- </span> -->
                                </td>
                                
                            </tr>
                        
                    @endforeach
                    
                </tbody>
            </table>
            <!-- Pagination -->
            <div class="aiz-pagination mt-2">
               
            </div>
        </div>
    </div>
    
@endsection

@section('modal')
    <!-- Delete modal -->
    @include('modals.delete_modal')

@endsection

