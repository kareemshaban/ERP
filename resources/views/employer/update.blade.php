<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../../assets/img/favicon.png">
    <title>
        ERP System Dashboard
    </title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="../../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../../assets/css/nucleo-svg.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../../assets/css/nucleo-svg.css" rel="stylesheet" />
    <link id="pagestyle" href="../../assets/css/soft-ui-dashboard.css?v=1.0.7" rel="stylesheet" />
</head>

<body @if(Config::get('app.locale') == 'en') class="g-sidenav-show  bg-gray-100" @else  class="g-sidenav-show rtl bg-gray-100" @endif>
@include('layouts.side' , ['slag' => 11 , 'subSlag' => 35])


<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
@include('flash-message')
<!-- Navbar -->
@include('layouts.nav' , ['page_title' => __('main.employers'). ' / '. __('main.update_employer')])
<!-- End Navbar -->
    <div class="modal-body" id="paymentBody">
        <form method="POST" action="{{route('employers.update',$employer->id)}}">
            @csrf

            <div class="contentbar">
                <!-- Start row -->
                <div class="row">
                    <!-- Start col -->
                    <div class="col-lg-12">
                        <h5 class="card-title font-18"></h5>
                    </div>
                    <!-- End col -->

                    <div class="col-lg-4">
                        <div class="card m-b-30">
                            <div class="card-header">
                                <h5 class="card-title">{{__('main.Name')}}</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group mb-0">
                                    <input type="text" class="form-control" required name="name" id="inputText" placeholder="{{__('main.Name')}}" value="{!! $employer->name !!}" >
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card m-b-30">
                            <div class="card-header">
                                <h5 class="card-title">{{__('main.Phone')}}</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group mb-0">
                                    <input type="tel" class="form-control" required name="phone" id="inputmask-decimal" placeholder="{{__('main.Phone')}}" value="{!! $employer->phone !!}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card m-b-30">
                            <div class="card-header">
                                <h5 class="card-title">{{__('main.Address')}}</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group mb-0">
                                    <input type="text" class="form-control" required name="address" id="inputText" placeholder="{{__('main.Address')}}" value="{!! $employer->address !!}">
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-4">
                        <div class="card m-b-30">
                            <div class="card-header">
                                <h5 class="card-title">{{__('main.Hours Count')}}</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group mb-0">
                                    <input type="number" step="0.01" min="0"  class="form-control" required name="salary" id="inputText" placeholder="{{__('main.Salary')}}" value="{!! $employer->salary !!}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card m-b-30">
                            <div class="card-header">
                                <h5 class="card-title">{{__('main.Hour Amount')}}</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group mb-0">
                                    <input type="number" step="0.0001" min="0"  class="form-control" required name="additional_salary" id="inputText" placeholder="{{__('main.Additional Service Amount')}}" value="{!! $employer->additional_salary !!}">
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="col-lg-4">
                        <div class="card m-b-30">
                            <div class="card-header">
                                <h5 class="card-title">{{__('main.Job')}}</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group mb-0">
                                    <div class="card-body">
                                        <select class="select2-single form-control" name="employer_category_id">
                                            @foreach($categories as $category)
                                                <option value="{!! $category->id !!}"
                                                        @if($employer->employer_category_id == $category->id) selected @endif>{!! $category->name !!} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



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


<script src="../../assets/js/core/popper.min.js"></script>
<script src="../../assets/js/core/bootstrap.min.js"></script>
<script src="../../assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="../../assets/js/plugins/smooth-scrollbar.min.js"></script>
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
<script src="../../assets/js/soft-ui-dashboard.min.js?v=1.0.7"></script>
</body>

</html>
