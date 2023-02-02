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
    @include('layouts.nav' , ['page_title' => __('main.account_list'). ' / '. __('main.add_account')])
    <!-- End Navbar -->
        <div class="modal-body" id="paymentBody">
            <form   method="POST" action="{{ route('store_account') }}">
                @csrf

                <div class="row" style="padding: 20px">
                    <div class="col-md-6 col-sm-6">

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>{{ __('main.code') }} <span style="color:red; font-size:20px; font-weight:bold;">*</span> </label>
                                    <input type="text"  id="code" name="code"
                                           class="form-control @error('code') is-invalid @enderror"
                                           placeholder="{{ __('main.code') }}"  />
                                    @error('code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 " >
                                <div class="form-group">
                                    <label>{{ __('main.name') }} <span style="color:red; font-size:20px; font-weight:bold;">*</span>  </label>
                                    <input type="text"  id="name" name="name"
                                           class="form-control @error('name') is-invalid @enderror"
                                           placeholder="{{ __('main.name') }}"  />
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>{{ __('main.account_type') }} <span style="color:red; font-size:20px; font-weight:bold;">*</span> </label>
                                    <select class="form-control @error('type') is-invalid @enderror" id="account_type" name="type">
                                        <option value="1">{{__('main.Root')}}</option>
                                        <option value="2">{{__('main.General')}}</option>
                                        <option value="3">{{__('main.Branch')}}</option>
                                        <option value="4">{{__('main.Branch_Ledger')}}</option>
                                    </select>
                                    @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>





                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>{{ __('main.parent_id') }} <span style="color:red; font-size:20px; font-weight:bold;">*</span> </label>
                                    <select class="form-control @error('brand') is-invalid @enderror" id="parent_id" name="parent_id" disabled>
                                        <option value="0"></option>
                                        @foreach($accounts as $brand)
                                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('brand')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 " >
                                <div class="form-group">
                                    <label>{{ __('main.account_level') }} <span style="color:red; font-size:20px; font-weight:bold;">*</span>  </label>
                                    <input type="text"  id="level" name="level" readonly  value="1"
                                           class="form-control @error('name') is-invalid @enderror"
                                           placeholder="{{ __('main.account_level') }}"  />
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>{{ __('main.account_list') }} <span style="color:red; font-size:20px; font-weight:bold;">*</span> </label>
                                    <select class="form-control @error('type') is-invalid @enderror" id="list" name="list">
                                        <option value="1">{{__('main.Assets')}}</option>
                                        <option value="2">{{__('main.Discounts')}}</option>
                                        <option value="3">{{__('main.Income')}}</option>
                                        <option value="4">{{__('main.Expenses')}}</option>
                                    </select>
                                    @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>{{ __('main.account_department') }} <span style="color:red; font-size:20px; font-weight:bold;">*</span> </label>
                                    <select class="form-control @error('type') is-invalid @enderror" id="department" name="department">
                                        <option value="1">{{__('main.Balance_Sheet')}}</option>
                                        <option value="2">{{__('main.Incoming_List')}}</option>
                                    </select>
                                    @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>{{ __('main.account_side') }} <span style="color:red; font-size:20px; font-weight:bold;">*</span> </label>
                                    <select class="form-control @error('type') is-invalid @enderror" id="side" name="side">
                                        <option value="1">{{__('main.Credit')}}</option>
                                        <option value="2">{{__('main.Debit')}}</option>
                                    </select>
                                    @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
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
