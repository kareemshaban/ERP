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
@include('layouts.side' , ['slag' => 11 , 'subSlag' => 35])


<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
@include('flash-message')
<!-- Navbar -->
@include('layouts.nav' , ['page_title' => __('main.salary_docs'). ' / '. __('main.add_salary')])
<!-- End Navbar -->
    <div class="modal-header">

    </div>
    <div class="modal-body" id="paymentBody">

        <form method="post" action="{{route('get_salary')}}">
            @csrf
            <div class="col-lg-12">
                <div class="card m-b-30">
                    <div class="card-header">
                        <h5 class="card-title">{{__('main.Month')}}</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-0">
                            <select name="month">
                                <option value="01" @if($month_only == '01') selected @endif >يناير</option>
                                <option value="02" @if($month_only == '02') selected @endif>فبراير</option>
                                <option value="03" @if($month_only == '03') selected @endif>مارس</option>
                                <option value="04" @if($month_only == '04') selected @endif>ابريل</option>
                                <option value="05" @if($month_only == '05') selected @endif>مايو</option>
                                <option value="06" @if($month_only == '06') selected @endif>يونيو</option>
                                <option value="07" @if($month_only == '07') selected @endif>يوليو</option>
                                <option value="08" @if($month_only == '08') selected @endif>اغسطس</option>
                                <option value="09" @if($month_only == '09') selected @endif>سبتمبر</option>
                                <option value="10" @if($month_only == '10') selected @endif>اكتوبر</option>
                                <option value="11" @if($month_only == '11') selected @endif>نوفمبر</option>
                                <option value="12" @if($month_only == '12') selected @endif>ديسمبر</option>
                            </select>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="col-6" style="display: block; margin: 20px auto; text-align: center;">
                            <button type="submit" class="btn btn-labeled btn-primary" >عرض الراتب</button>
                        </div>
                    </div>
                </div>
            </div>




        </form>

        <div class="modal-body">
            <form   method="POST" action="{{route('store_salary')}}">
                @csrf

                <input type="hidden" name="month" value="{{$month_only}}">
                <div class="contentbar">
                    <!-- Start row -->
                    <div class="row">
                        <!-- Start col -->
                        <div class="col-lg-12">
                            <h5 class="card-title font-18"></h5>
                        </div>
                        <!-- End col -->
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <td>الموظف</td>
                                <td>قيمة ساعة العمل</td>
                                <td>عدد ساعات العمل</td>
                                <td>المكافئات</td>
                                <td>السلف</td>
                                <td>الخصومات</td>
                                <td>صافي الراتب</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $item)
                                <tr>
                                    <td>
                                        <input type="hidden" name="employer_id[]" value="{{$item['employer_id']}}">
                                        <input type="hidden" name="hours[]" value="{{$item['hours']}}">
                                        <input type="hidden" name="hour_value[]" value="{{$item['hour_value']}}">
                                        <input type="hidden" name="reward[]" value="{{$item['reward']}}">
                                        <input type="hidden" name="advance_payment[]" value="{{$item['advance_payment']}}">
                                        <input type="hidden" name="deductions[]" value="{{$item['deductions']}}">

                                        {{$item['employer_name']}}
                                    </td>
                                    <td>{{$item['hour_value']}}</td>
                                    <td>{{$item['hours']}}</td>
                                    <td>{{$item['reward']}}</td>
                                    <td>{{$item['advance_payment']}}</td>
                                    <td>{{$item['deductions']}}</td>
                                    <td>{{($item['hours']*$item['hour_value'])+$item['reward']-$item['advance_payment']-$item['deductions']}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>

                </div>


                @if($state == 0)
                <div class="row">
                    <div class="col-6" style="display: block; margin: 20px auto; text-align: center;">
                        <button type="submit" class="btn btn-labeled btn-primary"  >
                            {{__('main.save_btn')}}</button>
                    </div>
                </div>
                    @endif
            </form>
        </div>

    </div>
</main>
@include('layouts.fixed')
<!--   Core JS Files   -->



<script type="text/javascript">

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
