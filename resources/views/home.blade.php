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
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.0.7" rel="stylesheet" />
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
                <div class="box" style="padding-bottom: 30px; width: 90%; margin: auto">
                    <div class="box-header">
                        <h2 class="blue"><i class="fa fa-th"></i><span class="break"></span>{{__('main.total_movements')}}
                       <label>  </label> ({{\Carbon\Carbon::now() -> format('d - m - Y')}})</h2>
                    </div>
                    <div class="box-content">

                        <div class="row" style=" margin: 30px auto; width: 80% ;" >
                            <div class="col-xl-6 col-sm-6 " >
                                <div class="card" style="height: 150px; ">
                                    <div class="card-body p-3" style="display: flex; flex-direction: column; justify-content: center">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="numbers">
                                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">{{__('main.total_sales_without_tax')}}</p>
                                                    <h5 class="font-weight-bolder mb-0">
                                                        $53,000
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
                                                        2,300
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="col-4 text-end">
                                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                                    <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
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
                                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">{{__('main.total_tax')}}</p>
                                                    <h5 class="font-weight-bolder mb-0">
                                                        +3,462
                                                        <span class="text-danger text-sm font-weight-bolder">-2%</span>
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="col-4 text-end">
                                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                                    <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
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
                                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">{{__('main.total_sales_without_tax')}}</p>
                                                    <h5 class="font-weight-bolder mb-0">
                                                        $103,430
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
                    <div class="box-content" style="display: flex;flex-flow: wrap; padding: 20px;">
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

                                <p> {{__('main.purchase')}}</p>
                            </a>
                        </div>

                        <div class="col-md-2 col-xs-4 padding1010">
                            <a class="bpink white quick-button small" href="{{route('account_settings_list')}}">
                                <i class="fa fa-star-o"></i>

                                <p>{{__('main.account_settings')}}</p>
                            </a>
                        </div>

                        <div class="col-md-2 col-xs-4 padding1010">
                            <a class="bgrey white quick-button small" href="{{route('clients' , 0)}}">
                                <i class="fa fa-users"></i>

                                <p>{{__('main.clients')}}</p>
                            </a>
                        </div>

                        <div class="col-md-2 col-xs-4 padding1010">
                            <a class="bgrey white quick-button small" href="{{route('clients' , 1)}}">
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
                            <a class="bred white quick-button small" href="{{__('main.items_stock_report')}}">
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
<script src="../assets/js/core/popper.min.js"></script>
<script src="../assets/js/core/bootstrap.min.js"></script>
<script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
<script src="../assets/js/plugins/chartjs.min.js"></script>
<script>
    var ctx = document.getElementById("chart-bars").getContext("2d");

    new Chart(ctx, {
        type: "bar",
        data: {
            labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                label: "Sales",
                tension: 0.4,
                borderWidth: 0,
                borderRadius: 4,
                borderSkipped: false,
                backgroundColor: "#fff",
                data: [450, 200, 100, 220, 500, 100, 400, 230, 500],
                maxBarThickness: 6
            }, ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                }
            },
            interaction: {
                intersect: false,
                mode: 'index',
            },
            scales: {
                y: {
                    grid: {
                        drawBorder: false,
                        display: false,
                        drawOnChartArea: false,
                        drawTicks: false,
                    },
                    ticks: {
                        suggestedMin: 0,
                        suggestedMax: 500,
                        beginAtZero: true,
                        padding: 15,
                        font: {
                            size: 14,
                            family: "Open Sans",
                            style: 'normal',
                            lineHeight: 2
                        },
                        color: "#fff"
                    },
                },
                x: {
                    grid: {
                        drawBorder: false,
                        display: false,
                        drawOnChartArea: false,
                        drawTicks: false
                    },
                    ticks: {
                        display: false
                    },
                },
            },
        },
    });


    var ctx2 = document.getElementById("chart-line").getContext("2d");

    var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(52, 71, 103, 0.7)');
    gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

    var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

    gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
    gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors

    new Chart(ctx2, {
        type: "line",
        data: {
            labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                label: "Mobile apps",
                tension: 0.4,
                borderWidth: 0,
                pointRadius: 0,
                borderColor: "#428BCA",
                borderWidth: 3,
                backgroundColor: gradientStroke1,
                fill: true,
                data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                maxBarThickness: 6

            },
                {
                    label: "Websites",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#3A416F",
                    borderWidth: 3,
                    backgroundColor: gradientStroke2,
                    fill: true,
                    data: [30, 90, 40, 140, 290, 290, 340, 230, 400],
                    maxBarThickness: 6
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                }
            },
            interaction: {
                intersect: false,
                mode: 'index',
            },
            scales: {
                y: {
                    grid: {
                        drawBorder: false,
                        display: true,
                        drawOnChartArea: true,
                        drawTicks: false,
                        borderDash: [5, 5]
                    },
                    ticks: {
                        display: true,
                        padding: 10,
                        color: '#428BCA',
                        font: {
                            size: 11,
                            family: "Open Sans",
                            style: 'normal',
                            lineHeight: 2
                        },
                    }
                },
                x: {
                    grid: {
                        drawBorder: false,
                        display: false,
                        drawOnChartArea: false,
                        drawTicks: false,
                        borderDash: [5, 5]
                    },
                    ticks: {
                        display: true,
                        color: '#428BCA',
                        padding: 20,
                        font: {
                            size: 11,
                            family: "Open Sans",
                            style: 'normal',
                            lineHeight: 2
                        },
                    }
                },
            },
        },
    });
</script>
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
<script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.7"></script>
</body>

</html>
