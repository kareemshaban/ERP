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
    <link href="../assets/css/jquery-ui.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="/path/to/bootstrap/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">



    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js" defer></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js" defer></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js" defer></script>

    <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.0.7" rel="stylesheet" />
</head>

<body @if(Config::get('app.locale') == 'en') class="g-sidenav-show  bg-gray-100" @else  class="g-sidenav-show rtl bg-gray-100" @endif>
    @include('layouts.side' , ['slag' => 10 ,   'subSlag' => 42])

<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    @include('flash-message')
        @include('layouts.nav' , ['page_title' => __('main.incoming_list_report') ])


    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4" style="padding: 20px">
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="col-6 text-start">
                                <h6>{{ __('main.incoming_list_report')}}</h6>
                            </div>
                        </div>

                    </div>

                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table  id="table" class="table align-items-center mb-0 border">
                                <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-md-center font-weight-bolder opacity-7">#</th>
                                    <th class="text-uppercase text-secondary text-md-center font-weight-bolder opacity-7 ps-2">{{__('main.code')}}</th>
                                    <th class="text-uppercase text-secondary text-md-center font-weight-bolder opacity-7 ps-2">{{__('main.name')}}</th>
                                    <th class="text-center text-uppercase text-secondary text-md-center font-weight-bolder opacity-7">{{__('main.Credit')}}</th>
                                    <th class="text-center text-uppercase text-secondary text-md-center font-weight-bolder opacity-7">{{__('main.Debit')}}</th>
                                    <th class="text-center text-uppercase text-secondary text-md-center font-weight-bolder opacity-7">{{__('main.balance')}}</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($accounts as $index=>$unit)
                                    <tr>
                                        <td class="text-center">{{$index++}}</td>
                                        <td class="text-center">{{$unit->code}}</td>
                                        <td class="text-center">{{$unit->name}}</td>
                                        <td class="text-center">{{$unit->credit}}</td>
                                        <td class="text-center">{{$unit->debit}}</td>
                                        <td class="text-center">{{$unit->credit - $unit->debit}}</td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
{{--                    <div class="card-body px-0 pt-0 pb-2">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-6">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label>{{ __('main.from_date') }} <span style="color:red; font-size:20px; font-weight:bold;">*</span> </label>--}}
{{--                                    <input type="checkbox" name="is_from_date" id="is_from_date"/>--}}
{{--                                    <input type="date"  id="from_date" name="from_date"--}}
{{--                                           class="form-control"--}}
{{--                                    />--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-6">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label>{{ __('main.to_date') }} <span style="color:red; font-size:20px; font-weight:bold;">*</span> </label>--}}
{{--                                    <input type="checkbox" name="is_to_date" id="is_to_date"/>--}}
{{--                                    <input type="date"  id="to_date" name="to_date"--}}
{{--                                           class="form-control"--}}
{{--                                    />--}}
{{--                                </div>--}}
{{--                            </div>--}}


{{--                        </div>--}}


{{--                        <div class="row">--}}
{{--                            <div class="col-md-12 text-center">--}}
{{--                                <input type="submit" class="btn btn-primary" id="excute" tabindex="-1"--}}
{{--                                       style="width: 150px;--}}
{{--margin: 30px auto;" value="{{__('main.excute_btn')}}"></input>--}}

{{--                            </div>--}}
{{--                        </div>--}}

{{--                    </div>--}}
                </div>
            </div>
        </div>




        @include('layouts.footer')
    </div>
</main>

<div class="show_modal">

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">



    $(document).ready(function() {
           $('table').dataTable();

    });






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
