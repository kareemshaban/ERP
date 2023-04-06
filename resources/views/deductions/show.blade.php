@section('title')
    {{__('forms.Show Receipt')}}
@endsection
@extends('layouts.main')
@section('style')

@endsection
@section('rightbar-content')
    <!-- Start Contentbar -->
    <div class="contentbar">
        <!-- End row -->
        <div class="row justify-content-center">
            <!-- Start col -->
            <div class="col-md-12 col-lg-10 col-xl-10">
                <div class="card m-b-30">
                    <div class="card-body">
                        <div class="invoice">
                            <div class="invoice-head">
                                <div class="row">
                                    <div class="col-12 col-md-7 col-lg-7">
                                        <div class="invoice-logo">
                                            <img src="{{url('/assets/images/logo.png')}}" class="img-fluid" alt="invoice-logo">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-5 col-lg-5">
                                        <div class="invoice-name">
                                            <h5 class="text-uppercase mb-3">{{__('forms.print invoice')}}</h5>
                                            <p class="mb-1">{{__('forms.Code')}} : {{$catchReceipt->no}}</p>
                                            <p class="mb-0">{{$catchReceipt->date}}</p>
                                            <h4 class="text-success mb-0 mt-3">{{$catchReceipt->amount}}</h4>
                                            @if($catchReceipt->type == 2)
                                                <h4 class="text-success mb-0 mt-3">{{$catchReceipt->bankName}}</h4>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="invoice-billing">
                                <div class="row">
                                    <div class="col-sm-6 col-md-4 col-lg-4">
                                        <div class="invoice-address">
                                            <h6 class="mb-3">{{__('forms.patient')}}</h6>
                                            <h6 class="text-muted">{{$catchReceipt->Patient->name}}</h6>
                                            <ul class="list-unstyled">

                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4 col-lg-4">
                                        <div class="invoice-address">
                                            <div class="card">
                                                <div class="card-body bg-secondary-rgba text-center">
                                                    <h6>{{__('forms.Catch Type')}}</h6>
                                                    <p>@if($catchReceipt->type == 1 ) {{__('forms.Safe')}} @elseif($catchReceipt->type == 2) {{__('forms.Bank')}}@endif</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="invoice-summary-total">
                                <div class="row">
                                    <div class="col-md-12 order-2 order-lg-1 col-lg-5 col-xl-6">
                                        <div class="order-note">
                                            <p class="mb-3"><span class="badge badge-info-inverse font-14"></span></p>
                                            <h6>{{__('forms.Notes')}}</h6>
                                            <p>{{$catchReceipt->notes}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="invoice-footer">
                                <div class="row align-items-center">
                                    <div class="col-md-6">

                                    </div>
                                    <div class="col-md-6">
                                        <div class="invoice-footer-btn">
                                            <a href="javascript:window.print()" class="btn btn-primary py-1 font-16"><i class="ri-printer-line mr-2"></i>Print</a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End col -->
        </div>
        <!-- End row -->
    </div>
    <!-- End Contentbar -->
@endsection
@section('script')

@endsection
