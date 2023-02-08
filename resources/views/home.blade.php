<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>
        ERP System Dashboard
    </title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="{{asset('assets/css/nucleo-icons.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/nucleo-svg.css')}}" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{asset('assets/css/nucleo-svg.css')}}" rel="stylesheet" />



    <link id="pagestyle" href= "{{asset('assets/css/soft-ui-dashboard.css')}}" rel="stylesheet" />

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <style>
        .quick-button.small {
            padding: 15px 0px 1px 0px;
            font-size: 13px;
            border-radius: 15px;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        }
        .quick-button.small:hover{
            transform: scale(1.1);
        }
        .quick-button {
            margin-bottom: -1px;
            padding: 30px 0px 10px 0px;
            font-size: 15px;
            display: block;
            text-align: center;
            cursor: pointer;
            position: relative;
            transition: all 0.3s ease;
            opacity: 0.9;
        }
        .bblue {
            background: #428BCA !important;
        }.white {
             color: white !important;
         }
        .bdarkGreen {
            background: #78cd51 !important;
        }
        .blightOrange {
            background: #fabb3d !important;
        }.bred {
             background: #ff5454 !important;
         }
        .bpink {
            background: #e84c8a !important;
        }
        .bgrey {
            background: #b2b8bd !important;
        }
        .blightBlue {
            background: #5BC0DE !important;
        }
        .padding1010 {
            padding: 10px;
        }


    </style>
</head>

<body @if(Config::get('app.locale') == 'en') class="g-sidenav-show  bg-gray-100" @else  class="g-sidenav-show rtl bg-gray-100" @endif>
@include('layouts.side' , ['slag' => 1 , 'subSlag' => 0])




<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
     @include('layouts.nav' , ['page_title' => __('main.dashboard')])
    <!-- End Navbar -->
    <div class="container-fluid py-4" @if(Config::get('app.locale') == 'ar') style="direction: rtl ; min-height: 500px" @else style="min-height: 500px"  @endif>


        <div class="row" style="margin-bottom: 15px;">
            <div class="col-lg-12">
                <div class="box" style="padding-bottom: 30px; width: 100%; margin: auto">
                    <div class="box-header col-md-12">
                        <h2 class="col-md-4 blue"><i class="fa fa-th"></i><span class="break"></span>{{__('main.total_movements')}}
                       <label>  </label> ({{\Carbon\Carbon::now() -> format('d - m - Y')}})</h2>

                        <h2 class="col-md-4" style="text-align: center; color: #ea0606">{{__('main.remaining_days')}} : {{$remaining_days}}</h2>

                        <h2 class="col-md-4" style="text-align: left; padding-left: 10px;">
                            <a href="javascript:;" onclick="showSubscribeData()" class="blue">{{__('main.subscribe_data')}}</a>
                        </h2>



                    </div>
                    <div class="box-content" style=" background: whitesmoke;">

                        <div class="row" style=" margin: 30px auto; width: 80% ;" >
                            <div class="col-xl-6 col-sm-6 " >
                                <div class="card" style="height: 150px; ">
                                    <div class="card-body p-3" style="display: flex; flex-direction: column; justify-content: center">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="numbers">
                                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">{{__('main.total_sales_without_tax')}}</p>
                                                    <h5 class="font-weight-bolder mb-0">
                                                        {{$sales_total - $sales_tax}}
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="col-4 text-end">
                                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                                    <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-sm-6">
                                <div class="card" style="height: 150px; ">
                                    <div class="card-body p-3" style="display: flex; flex-direction: column; justify-content: center">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="numbers">
                                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">{{__('main.total_tax')}}</p>
                                                    <h5 class="font-weight-bolder mb-0">
                                                        {{$sales_tax}}
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="col-4 text-end">
                                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                                    <i class="ni ni-badge text-lg opacity-10" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row"  style=" margin: 30px auto; width: 80% ;">
                            <div class="col-xl-6 col-sm-6 ">
                                <div class="card" style="height: 150px; ">
                                    <div class="card-body p-3" style="display: flex; flex-direction: column; justify-content: center">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="numbers">
                                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">{{__('main.total_purchase')}}</p>
                                                    <h5 class="font-weight-bolder mb-0">
                                                        {{$purchase_total}}

                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="col-4 text-end">
                                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                                    <i class="ni ni-building text-lg opacity-10" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-sm-6">
                                <div class="card" style="height: 150px; ">
                                    <div class="card-body p-3" style="display: flex; flex-direction: column; justify-content: center">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="numbers">
                                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">{{__('main.total_expenses')}}</p>
                                                    <h5 class="font-weight-bolder mb-0">
                                                      {{$total_expenses}}
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="col-4 text-end">
                                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                                    <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div >



                    </div>
                </div>
            </div>

        </div>

        <div class="row" style="margin-bottom: 15px;">
            <div class="col-lg-12">
                <div class="box" style="padding-bottom: 30px; width: 90%; margin: auto">
                    <div class="box-header">
                        <h2 class="blue"><i class="fa fa-th"></i><span class="break"></span>روابط سريعة</h2>
                    </div>
                    <div class="box-content" style="display: flex;flex-flow: wrap; padding: 20px; background: whitesmoke;">
                        <div class="col-md-2 col-xs-4 padding1010">
                            <a class="bblue white quick-button small" href="{{route('products')}}">
                                <i class="fa fa-barcode"></i>

                                <p>{{__('main.items')}}</p>
                            </a>
                        </div>
                        <div class="col-md-2 col-xs-4 padding1010">
                            <a class="bdarkGreen white quick-button small" href="{{route('sales')}}">
                                <i class="fa fa-heart"></i>

                                <p>{{__('main.sales_bill')}}</p>
                            </a>
                        </div>

                        <div class="col-md-2 col-xs-4 padding1010">
                            <a class="blightOrange white quick-button small" href="{{route('pos')}}">
                                <i class="fa fa-heart-o"></i>

                                <p> {{__('main.pos')}}</p>
                            </a>
                        </div>

                        <div class="col-md-2 col-xs-4 padding1010">
                            <a class="bred white quick-button small" href="{{route('purchases')}}">
                                <i class="fa fa-star"></i>

                                <p> {{__('main.purchases')}}</p>
                            </a>
                        </div>

                        <div class="col-md-2 col-xs-4 padding1010">
                            <a class="bpink white quick-button small" href="{{route('account_settings_list')}}">
                                <i class="fa fa-star-o"></i>

                                <p>{{__('main.account_settings')}}</p>
                            </a>
                        </div>

                        <div class="col-md-2 col-xs-4 padding1010">
                            <a class="bgrey white quick-button small" href="{{route('clients' , 3)}}">
                                <i class="fa fa-users"></i>

                                <p>{{__('main.clients')}}</p>
                            </a>
                        </div>

                        <div class="col-md-2 col-xs-4 padding1010">
                            <a class="bgrey white quick-button small" href="{{route('clients' , 4)}}">
                                <i class="fa fa-users"></i>

                                <p>{{__('main.supplier')}}</p>
                            </a>
                        </div>

                        <div class="col-md-2 col-xs-4 padding1010">
                            <a class="blightBlue white quick-button small" href="{{route('purchase_report')}}">
                                <i class="fa fa-comments"></i>

                                <p>{{__('main.purchases_report')}}</p>

                            </a>
                        </div>

                        <div class="col-md-2 col-xs-4 padding1010">
                            <a class="bblue white quick-button small" href="{{route('users')}}">
                                <i class="fa fa-group"></i>
                                <p>{{__('main.users_label')}}</p>
                            </a>
                        </div>
                        <div class="col-md-2 col-xs-4 padding1010">
                            <a class="bpink white white quick-button small" href="{{route('system_settings')}}">
                                <i class="fa fa-cogs"></i>

                                <p>{{__('main.system_settings')}}</p>
                            </a>
                        </div>

                        <div class="col-md-2 col-xs-4 padding1010">
                            <a class="bdarkGreen white quick-button small" href="{{route('daily_sales_report')}}">
                                <i class="fa fa-money"></i>

                                <p>{{__('main.daily_sales_report')}}</p>
                            </a>
                        </div>

                        <div class="col-md-2 col-xs-4 padding1010">
                            <a class="bred white quick-button small" href="{{route('items_stock_report')}}">
                                <i class="fa fa-flask"></i>

                                <p>{{__('main.users_transactions_report')}}</p>
                            </a>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @include('layouts.footer')
</main>
@include('layouts.fixed')
<!--   Core JS Files   -->
<script src=" {{asset('assets/js/core/popper.min.js')}}"></script>

<script src="{{asset('assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/smooth-scrollbar.min.js')}}"></script>


<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{asset('assets/js/soft-ui-dashboard.min.js')}}"></script>
</body>

</html>
