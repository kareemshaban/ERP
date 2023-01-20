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
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.0.7" rel="stylesheet" />
</head>

<body @if(Config::get('app.locale') == 'en') class="g-sidenav-show  bg-gray-100" @else  class="g-sidenav-show rtl bg-gray-100" @endif>
@include('layouts.side' , ['slag' => 9 , 'subSlag' => 23])


<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    @include('flash-message')
    <!-- Navbar -->
    @include('layouts.nav' , ['page_title' => __('main.purchases') ])
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="col-6 text-start">
                                <h6>{{ __('main.purchases')}}</h6>
                            </div>
                            <div class="col-6 text-end">
                                <a type="button" class="btn btn-labeled btn-primary" href="{{route('add_purchase')}}">
                                    <span class="btn-label" style="margin-right: 10px;"><i class="fa fa-plus"></i></span>{{__('main.add_new')}}
                                </a>
                            </div>
                        </div>

                    </div>
                    <div class="card-body px-0 pt-0 pb-2" style="min-height: 400px;">
                        <div class="table-responsive" >
                            <table class="table " >
                                <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-md-center font-weight-bolder opacity-7">#</th>
                                    <th class="text-uppercase text-secondary text-md-center font-weight-bolder opacity-7 ps-2">{{__('main.bill_date')}}</th>
                                    <th class="text-center text-uppercase text-secondary text-md-center font-weight-bolder opacity-7">{{__('main.bill_number')}}</th>
                                    <th class="text-center text-uppercase text-secondary text-md-center font-weight-bolder opacity-7">{{__('main.warehouse')}}</th>
                                    <th class="text-center text-uppercase text-secondary text-md-center font-weight-bolder opacity-7">{{__('main.customer')}}</th>
                                    <th class="text-center text-uppercase text-secondary text-md-center font-weight-bolder opacity-7">{{__('main.total')}}</th>
                                    <th class="text-center text-uppercase text-secondary text-md-center font-weight-bolder opacity-7">{{__('main.tax')}}</th>
                                    <th class="text-center text-uppercase text-secondary text-md-center font-weight-bolder opacity-7">{{__('main.discount')}}</th>
                                    <th class="text-center text-uppercase text-secondary text-md-center font-weight-bolder opacity-7">{{__('main.net')}}</th>
                                    <th class="text-center text-uppercase text-secondary text-md-center font-weight-bolder opacity-7">{{__('main.paid')}}</th>
                                    <th class="text-center text-uppercase text-secondary text-md-center font-weight-bolder opacity-7">{{__('main.remain')}}</th>
                                    <th class="text-center text-uppercase text-secondary text-md-center font-weight-bolder opacity-7">{{__('main.InvoiceType')}}</th>

                                    <th class="text-end text-uppercase text-secondary text-md-center font-weight-bolder opacity-7">{{__('main.actions')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $process)
                                    <tr>
                                        <td class="text-center">{{$process->id}}</td>
                                        <td class="text-center">{{$process->date}}</td>
                                        <td class="text-center">{{$process->invoice_no}}</td>
                                        <td class="text-center">{{$process->warehouse_name}}</td>
                                        <td class="text-center">{{$process->customer_name}}</td>
                                        <td class="text-center">{{$process->total}}</td>
                                        <td class="text-center">{{$process->tax}}</td>
                                        <td class="text-center">{{$process->discount}}</td>
                                        <td class="text-center">{{$process->net}}</td>
                                        <td class="text-center">{{$process->paid}}</td>
                                        <td class="text-center">{{$process->net - $process->paid}}</td>
                                        <td class="text-center">
                                            @if($process->net > 0)
                                                <span class="badge bg-success">{{__('main.purchase')}}</span>
                                            @else
                                                <span class="badge bg-danger">{{__('main.return_purchase')}}</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton"
                                               data-bs-toggle="dropdown" aria-expanded="false">
                                                <span class="badge bg-primary cursor-pointer">
                                                    <i class="fa fa-caret-down" style="padding-left: 10px;padding-right: 10px"></i>{{__('main.actions')}}</span>
                                            </a>
                                            <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton" style="overflow-y: hidden !important;">
                                                <li class="mb-2">
                                                    <a class="dropdown-item border-radius-md"
                                                       href="javascript:;" onclick="showPayments({{$process->id}})">
                                                        <div class="d-flex py-1">
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="text-sm font-weight-normal mb-1">
                                                                    <span class="font-weight-bold">{{__('main.view_payments')}}</span>
                                                                </h6>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>

                                                <li class="mb-2">
                                                    @if(abs($process->net) - abs($process->paid) > 0)
                                                        <a class="dropdown-item border-radius-md"
                                                           href="javascript:;" onclick="addPayments({{$process->id}})">
                                                            <div class="d-flex py-1">
                                                                <div class="d-flex flex-column justify-content-center">
                                                                    <h6 class="text-sm font-weight-normal mb-1">
                                                                        <span class="font-weight-bold">{{__('main.add_payment')}}</span>
                                                                    </h6>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    @else

                                                    @endif
                                                </li>
                                               @if($process -> net > 0)
                                                <li class="mb-2">
                                                    <a class="dropdown-item border-radius-md"
                                                       href="{{route('return_purchase',$process->id)}}">
                                                        <div class="d-flex py-1">
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="text-sm font-weight-normal mb-1">
                                                                    <span class="font-weight-bold">{{__('main.return_purchase')}}</span>
                                                                </h6>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                                @endif

                                                <li class="mb-2">
                                                    <a class="dropdown-item border-radius-md"
                                                       href="javascript:;" onclick="view_purchase({{$process->id}})">
                                                        <div class="d-flex py-1">
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="text-sm font-weight-normal mb-1">
                                                                    <span class="font-weight-bold">{{__('main.preview')}}</span>
                                                                </h6>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li class="mb-2">
                                                    <a class="dropdown-item border-radius-md deleteBtn"  id="{{$process->id}}">
                                                        <div class="d-flex py-1">
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="text-sm font-weight-normal mb-1">
                                                                    <span class="font-weight-bold">{{__('main.delete')}}</span>
                                                                </h6>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>

                                            </ul>
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footer')
    </div>
</main>
@include('layouts.fixed')
<!--   Core JS Files   -->



<div class="show_modal">

</div>
<!--   Delte Modal   -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close"  data-bs-dismiss="modal"  aria-label="Close" style="color: red; font-size: 20px; font-weight: bold;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="smallBody">
                <img src="../assets/img/warning.png" class="alertImage">
                <label class="alertTitle">{{__('main.delete_alert')}}</label>
                <br> <label  class="alertSubTitle" id="modal_table_bill"></label>
                <div class="row">
                    <div class="col-6 text-center">
                        <button type="button" class="btn btn-labeled btn-primary" onclick="confirmDelete()">
                            <span class="btn-label" style="margin-right: 10px;"><i class="fa fa-check"></i></span>{{__('main.confirm_btn')}}</button>
                    </div>
                    <div class="col-6 text-center">
                        <button type="button" class="btn btn-labeled btn-secondary cancel-modal"  >
                            <span class="btn-label" style="margin-right: 10px;"><i class="fa fa-close"></i></span>{{__('main.cancel_btn')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    let id = 0 ;
    $(document).ready(function() {
        id = 0;
        $(document).on('click', '.deleteBtn', function(event) {
            id = event.currentTarget.id ;
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
                url: href,
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#deleteModal').modal("show");
                },
                complete: function() {
                    $('#loader').hide();
                },
                error: function(jqXHR, testStatus, error) {
                    console.log(error);
                    alert("Page " + href + " cannot open. Error:" + error);
                    $('#loader').hide();
                },
                timeout: 8000
            })
        });
        $(document).on('click' , '.cancel-modal' , function (event) {
            $('#deleteModal').modal("hide");
            id = 0 ;
        });
    });

    function confirmDelete(){
        let url = "{{ route('delete_purchase', ':id') }}";
        url = url.replace(':id', id);
        document.location.href=url;
    }

    function showPayments(id) {
        var route = '{{route('purchases_payments',":id")}}';
        route = route.replace(":id",id);

        $.get( route, function( data ) {
            $( ".show_modal" ).html( data );
            $('#paymentsModal').modal('show');
        });
    }

    function addPayments(id) {
        var route = '{{route('add_purchases_payments',":id")}}';
        route = route.replace(":id",id);

        $.get( route, function( data ) {
            $( ".show_modal" ).html( data );
            $('#paymentsModal').modal('show');
        });
    }

    function view_purchase(id) {
        var route = '{{route('preview_purchase',":id")}}';
        route = route.replace(":id",id);

        $.get( route, function( data ) {
            $( ".show_modal" ).html( data );
            $('#paymentsModal').modal('show');
        });
    }

</script>


<script src="../assets/js/core/popper.min.js"></script>
<script src="../assets/js/core/bootstrap.min.js"></script>
<script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
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
