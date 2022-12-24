<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>
        ERP System Dashboard
    </title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet"/>
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet"/>
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet"/>
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet"/>
    <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.0.7" rel="stylesheet"/>
</head>

<body @if(Config::get('app.locale') == 'en') class="g-sidenav-show  bg-gray-100"
      @else  class="g-sidenav-show rtl bg-gray-100" @endif>
@include('layouts.side' , ['slag' => 5 , 'subSlag' => 9])


<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    @include('flash-message')
    <!-- Navbar -->
    @include('layouts.nav' , ['page_title' =>  __('main.pos_settings') ])
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header sticky-top pb-0">
                        <div class="row">
                            <div class="col-6 text-start">
                                <h6>{{ __('main.pos_settings')}}</h6>
                            </div>
                            <div class="col-6 text-end">
                                <button type="submit" class="btn btn-labeled btn-primary " id="createButton" form="myform">
                                    <span class="btn-label" style="margin-right: 10px;"><i
                                            class="fa fa-check"></i></span>{{__('main.save_btn')}}</button>
                            </div>
                        </div>

                    </div>
                    <div class="card-body ">
                        <form method="POST" action="{{ route('storePosSettings') }}"
                              enctype="multipart/form-data" id="myform">
                            @csrf
                            <div class="box">
                                <div class="box-header">

                                    <h2 class="blue"><i class="fa-fw fa fa-cog"></i>{{__('main.pos_settings')}}</h2>

                                </div>
                                <div class="box-content">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>{{ __('main.show_items') }} <span
                                                        style="color:red; font-size:20px; font-weight:bold;">*</span>
                                                </label>
                                                <input type="text" id="show_items" name="show_items"
                                                       class="form-control"
                                                       placeholder="{{ __('main.show_items') }}" value="{{$setting?  $setting-> show_items : ''}}"/>
                                                <input type="text" id="id" name="id"
                                                       class="form-control" value="{{$setting?  $setting-> id : 0}}"
                                                       placeholder="{{ __('main.code') }}" hidden=""/>
                                            </div>
                                        </div>
                                        <div class="col-4 ">
                                            <div class="form-group">
                                                <label>{{ __('main.default_category') }} <span
                                                        style="color:red; font-size:20px; font-weight:bold;">*</span>
                                                </label>
                                                <select class="form-select mr-sm-2"
                                                        name="default_category" id="default_category">
                                                    <option @if(!$setting) selected @endif value="0">Choose...</option>
                                                    @foreach ($categories as $item)
                                                        @if($item -> parent_id == 0)
                                                        <option @if($setting?  $setting-> default_category == $item -> id : false) selected @endif
                                                        value="{{$item -> id}}"> {{ $item -> name}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-4 ">
                                            <div class="form-group">
                                                <label>{{ __('main.client_id') }} <span
                                                        style="color:red; font-size:20px; font-weight:bold;">*</span>
                                                </label>
                                                <select class="form-select mr-sm-2"
                                                        name="client_id" id="client_id">
                                                    <option @if(!$setting) selected @endif value="0">Choose...</option>
                                                    @foreach ($companies as $item)
                                                        @if($item -> group_id == 3)
                                                        <option @if($setting?  $setting-> client_id == $item -> id : false) selected @endif
                                                        value="{{$item -> id}}"> {{ $item -> name}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>{{ __('main.default_cashier') }} <span
                                                        style="color:red; font-size:20px; font-weight:bold;">*</span>
                                                </label>
                                                <select class="form-select mr-sm-2"
                                                        name="cashier_id" id="cashier_id">
                                                    <option @if(!$setting) selected @endif value="0">Choose...</option>
                                                    @foreach ($cashiers as $item)
                                                        <option @if($setting?  $setting-> cashier_id == $item -> id : false) selected @endif
                                                        value="{{$item -> id}}"> {{ $item -> name}}</option>

                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>{{ __('main.show_time') }} <span
                                                        style="color:red; font-size:20px; font-weight:bold;">*</span>
                                                </label>
                                                <select class="form-select mr-sm-2"
                                                        name="show_time" id="show_time">
                                                    <option @if(!$setting) selected @endif value="0">Choose...</option>
                                                    <option @if($setting?  $setting-> show_time == 1 : false) selected @endif value="1">{{__('main.true_val')}}</option>
                                                    <option @if($setting?  $setting-> show_time == 2 : false) selected @endif value="2">{{__('main.false_val')}}</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>


                                </div>

                            </div>
                            <div class="box">
                                <div class="box-header">

                                    <h2 class="blue"><i class="fa-fw fa fa-cog"></i>{{__('main.shortcut_setting')}}</h2>

                                </div>
                                <div class="box-content">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>{{ __('main.item_search') }} <span
                                                        style="color:red; font-size:20px; font-weight:bold;">*</span>
                                                </label>
                                                <input type="text" id="item_search" name="item_search"
                                                       class="form-control" value="{{$setting? $setting -> item_search : ''}}"
                                                       placeholder="{{ __('main.item_search') }}" />
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>{{ __('main.add_new_item') }} <span
                                                        style="color:red; font-size:20px; font-weight:bold;">*</span>
                                                </label>
                                                <input type="text" id="add_new_item" name="add_new_item"
                                                       class="form-control" value="{{$setting? $setting -> add_new_item : ''}}"
                                                       placeholder="{{ __('main.add_new_item') }}" />
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>{{ __('main.insert_client') }} <span
                                                        style="color:red; font-size:20px; font-weight:bold;">*</span>
                                                </label>
                                                <input type="text" id="insert_client" name="insert_client"
                                                       class="form-control" value="{{$setting? $setting -> insert_client : ''}}"
                                                       placeholder="{{ __('main.insert_client') }}"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>{{ __('main.add_client') }} <span
                                                        style="color:red; font-size:20px; font-weight:bold;">*</span>
                                                </label>
                                                <input type="text" id="add_client" name="add_client"
                                                       class="form-control" value="{{$setting? $setting -> add_client : ''}}"
                                                       placeholder="{{ __('main.add_client') }}"/>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>{{ __('main.category_toggle') }} <span
                                                        style="color:red; font-size:20px; font-weight:bold;">*</span>
                                                </label>
                                                <input type="text" id="category_toggle" name="category_toggle"
                                                       class="form-control" value="{{$setting? $setting -> category_toggle : ''}}"
                                                       placeholder="{{ __('main.category_toggle') }}"/>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>{{ __('main.subCategory_toggle') }} <span
                                                        style="color:red; font-size:20px; font-weight:bold;">*</span>
                                                </label>
                                                <input type="text" id="subCategory_toggle" name="subCategory_toggle"
                                                       class="form-control" value="{{$setting? $setting -> subCategory_toggle : ''}}"
                                                       placeholder="{{ __('main.subCategory_toggle') }}"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>{{ __('main.brand_toggle') }} <span
                                                        style="color:red; font-size:20px; font-weight:bold;">*</span>
                                                </label>
                                                <input type="text" id="brand_toggle" name="brand_toggle"
                                                       class="form-control" value="{{$setting? $setting -> brand_toggle : ''}}"
                                                       placeholder="{{ __('main.brand_toggle') }}"/>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>{{ __('main.transaction_prefix') }} <span
                                                        style="color:red; font-size:20px; font-weight:bold;">*</span>
                                                </label>
                                                <input type="text" id="cancel_sell" name="cancel_sell"
                                                       class="form-control" value="{{$setting? $setting -> cancel_sell : ''}}"
                                                       placeholder="{{ __('main.cancel_sell') }}"/>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>{{ __('main.pend_sell') }} <span
                                                        style="color:red; font-size:20px; font-weight:bold;">*</span>
                                                </label>
                                                <input type="text" id="pend_sell" name="pend_sell"
                                                       class="form-control" value="{{$setting? $setting -> pend_sell : ''}}"
                                                       placeholder="{{ __('main.pend_sell') }}"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>{{ __('main.printed_material') }} <span
                                                        style="color:red; font-size:20px; font-weight:bold;">*</span>
                                                </label>
                                                <input type="text" id="printed_material" name="printed_material"
                                                       class="form-control" value="{{$setting? $setting -> printed_material : ''}}"
                                                       placeholder="{{ __('main.printed_material') }}"/>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>{{ __('main.finish_bill') }} <span
                                                        style="color:red; font-size:20px; font-weight:bold;">*</span>
                                                </label>
                                                <input type="text" id="finish_bill" name="finish_bill"
                                                       class="form-control" value="{{$setting? $setting -> finish_bill : ''}}"
                                                       placeholder="{{ __('main.finish_bill') }}"/>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>{{ __('main.daily_sales') }} <span
                                                        style="color:red; font-size:20px; font-weight:bold;">*</span>
                                                </label>
                                                <input type="text" id="daily_sales" name="daily_sales"
                                                       class="form-control" value="{{$setting? $setting -> daily_sales : ''}}"
                                                       placeholder="{{ __('main.daily_sales') }}"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>{{ __('main.opening_pending_sales') }} <span
                                                        style="color:red; font-size:20px; font-weight:bold;">*</span>
                                                </label>
                                                <input type="text" id="opening_pending_sales" name="opening_pending_sales"
                                                       class="form-control" value="{{$setting? $setting -> opening_pending_sales : ''}}"
                                                       placeholder="{{ __('main.opening_pending_sales') }}"/>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>{{ __('main.close_shift') }} <span
                                                        style="color:red; font-size:20px; font-weight:bold;">*</span>
                                                </label>
                                                <input type="text" id="close_shift" name="close_shift"
                                                       class="form-control" value="{{$setting? $setting -> close_shift : ''}}"
                                                       placeholder="{{ __('main.close_shift') }}"/>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>{{ __('main.qr_print') }} <span
                                                        style="color:red; font-size:20px; font-weight:bold;">*</span>
                                                </label>
                                                <select class="form-select mr-sm-2"
                                                        name="qr_print" id="qr_print">
                                                    <option @if(!$setting) selected @endif value="0">Choose...</option>
                                                    <option @if($setting?  $setting-> qr_print == 1 : false) selected @endif value="1">{{__('main.true_val')}}</option>
                                                    <option @if($setting?  $setting-> qr_print == 2 : false) selected @endif value="2">{{__('main.false_val')}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>{{ __('main.header_print') }} <span
                                                        style="color:red; font-size:20px; font-weight:bold;">*</span>
                                                </label>
                                                <select class="form-select mr-sm-2"
                                                        name="header_print" id="header_print">
                                                    <option @if(!$setting) selected @endif value="0">Choose...</option>
                                                    <option @if($setting?  $setting-> qr_print == 1 : false) selected @endif value="1">{{__('main.true_val')}}</option>
                                                    <option @if($setting?  $setting-> qr_print == 2 : false) selected @endif value="2">{{__('main.false_val')}}</option>
                                                    <option @if($setting?  $setting-> qr_print == 3 : false) selected @endif value="3">{{__('main.header_print1')}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>{{ __('main.header_img') }} <span
                                                        style="color:red; font-size:20px; font-weight:bold;">*</span>
                                                </label>
                                                <input type="file" class="form-control custom-file-input" id="header_img"   name="header_img"
                                                       accept="image/png, image/jpeg"  value="{{$setting? $setting -> header_img : ''}}">


                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>{{ __('main.seller_buyer') }} <span
                                                        style="color:red; font-size:20px; font-weight:bold;">*</span>
                                                </label>
                                                <select class="form-select mr-sm-2"
                                                        name="seller_buyer" id="seller_buyer">
                                                    <option @if(!$setting) selected @endif value="0">Choose...</option>
                                                    <option @if($setting?  $setting-> qr_print == 1 : false) selected @endif value="1">{{__('main.true_val')}}</option>
                                                    <option @if($setting?  $setting-> qr_print == 2 : false) selected @endif value="2">{{__('main.false_val')}}</option>
                                                    <option @if($setting?  $setting-> qr_print == 3 : false) selected @endif value="3">{{__('main.header_print1')}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footer')
    </div>
</main>
@include('layouts.fixed')
<!--   Core JS Files   -->


<!--   Create Modal   -->

<!--   Delte Modal   -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"
                        style="color: red; font-size: 20px; font-weight: bold;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="smallBody">
                <img src="../assets/img/warning.png" class="alertImage">
                <label class="alertTitle">{{__('main.delete_alert')}}</label>
                <br> <label class="alertSubTitle" id="modal_table_bill"></label>
                <div class="row">
                    <div class="col-6 text-center">
                        <button type="button" class="btn btn-labeled btn-primary" onclick="confirmDelete()">
                            <span class="btn-label" style="margin-right: 10px;"><i
                                    class="fa fa-check"></i></span>{{__('main.confirm_btn')}}</button>
                    </div>
                    <div class="col-6 text-center">
                        <button type="button" class="btn btn-labeled btn-secondary cancel-modal">
                            <span class="btn-label" style="margin-right: 10px;"><i
                                    class="fa fa-close"></i></span>{{__('main.cancel_btn')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#profile-img-tag').attr('src', e.target.result);

            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#image_url").change(function () {
        readURL(this);
    });
</script>

<script type="text/javascript">

    $(document).ready(function () {



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
