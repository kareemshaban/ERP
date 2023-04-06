<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../../../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../../../assets/img/favicon.png">
    <title>
        ERP System Dashboard
    </title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="../../../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../../../assets/css/nucleo-svg.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../../../assets/css/nucleo-svg.css" rel="stylesheet" />
    <link id="pagestyle" href="../../../assets/css/soft-ui-dashboard.css?v=1.0.7" rel="stylesheet" />
</head>

<body @if(Config::get('app.locale') == 'en') class="g-sidenav-show  bg-gray-100" @else  class="g-sidenav-show rtl bg-gray-100" @endif>
@include('layouts.side' , ['slag' => 11 , 'subSlag' => 35])


<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
@include('flash-message')
<!-- Navbar -->
@include('layouts.nav' , ['page_title' => __('main.advance_payments'). ' / '. __('main.update_advance_payment')])
<!-- End Navbar -->
    <div class="modal-body" id="paymentBody">
        <form method="POST"  action="{{route('advance_payments.update',$advancePayment->id)}}">
            @csrf
            {{ method_field('PUT') }}

            <div class="contentbar">
                <!-- Start row -->
                <div class="row">
                    <!-- Start col -->
                    <div class="col-lg-12">
                        <h5 class="card-title font-18"></h5>
                    </div>
                    <!-- End col -->
                    <!-- Start col -->
                    <div class="col-lg-12">
                        <div class="row">

                            <div class="card m-b-30 col-md-6">
                                <div class="card-header">
                                    <h5 class="card-title">{{__('forms.Date')}}</h5>
                                </div>
                                <div class="card-body">
                                    <div class="input-group">
                                        <input type="date" id="default-date" required name="date" class="datepicker-here form-control" placeholder="dd/mm/yyyy" aria-describedby="basic-addon2"
                                        value="{{$advancePayment->date}}"
                                        />
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2"><i class="ri-calendar-line"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card m-b-30 col-md-6">
                                <div class="card-header">
                                    <h5 class="card-title">{{__('forms.Employer')}}</h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group mb-0">
                                        <select class="select2-single form-control" id="employer_id" name="employer_id">
                                            @foreach($employers as $employer)
                                                <option value="{{$employer->id}}" @if($employer->id == $advancePayment->employer_id) selected @endif>{{$employer->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="col-lg-12">
                        <div class="row">
                            <div class="card m-b-30 col-md-6">
                                <div class="card-header">
                                    <h5 class="card-title">{{__('forms.Amount')}}</h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group mb-0">
                                        <input type="number" step="0.01"
                                               class="form-control" required name="amount" id="amount" placeholder="{{__('forms.Amount')}}" value="{{$advancePayment->amount}}">
                                    </div>
                                </div>
                            </div>

                            <div class="card m-b-30 col-md-6">
                                <div class="card-header">
                                    <h5 class="card-title">{{__('forms.Advance Amount')}}</h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group mb-0">
                                        <input type="number" value="{{$advancePayment->advance_amount}}" class="form-control" name="advance_amount" step="0.01">
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>




                    <!-- End col -->



                </div>


            </div>



            <div class="row">
                <div class="col-6" style="display: block; margin: 20px auto; text-align: center;">
                    <button type="submit" class="btn btn-labeled btn-primary"  >
                        {{__('main.save_btn')}}</button>
                </div>
            </div>
        </form>
    </div>
</main>
@include('layouts.fixed')
<!--   Core JS Files   -->



<script type="text/javascript">

</script>


<script src="../../../assets/js/core/popper.min.js"></script>
<script src="../../../assets/js/core/bootstrap.min.js"></script>
<script src="../../../assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="../../../assets/js/plugins/smooth-scrollbar.min.js"></script>
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }


    $('#account_type').change(function () {
        var t = $(this).val();
        $('#parent_id').val(0).trigger('change');
        $('#account_level').val(1);
        if (t == 0) {
            $('#parent_id').attr('disabled', true);
        }
        else if (t == 1) {
            $('#parent_id').attr('disabled', false);
        }
        else if (t == 2) {
            $('#parent_id').attr('disabled', false);
        }
        else if (t == 3) {
            $('#parent_id').attr('disabled', false);
        }
    });


    $('#parent_id').change(function () {
        var parent = $(this).val();
        if(parent == 0)
            return;
        var url = '{{route('get_account_level',":id")}}';
        url = url.replace(":id",parent);
        $.ajax({
            type: "get", async: false,
            url: url,
            dataType: "json",
            success: function (data) {
                $('#level').val(+data['account']['level']+1);
                $('#list').val(+data['account']['list']).trigger('change');
                $('#department').val(+data['account']['department']).trigger('change');

            }
        });


    });

</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="../../../assets/js/soft-ui-dashboard.min.js?v=1.0.7"></script>
</body>

</html>
