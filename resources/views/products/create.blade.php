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

    <style>
        .itemCaRD{
            background: white;
            width: 90%;
            display: block;
            margin: 50px auto;
            border-radius: 25px;
        }
    </style>

</head>

<body @if(Config::get('app.locale') == 'en') class="g-sidenav-show  bg-gray-100" @else  class="g-sidenav-show rtl bg-gray-100" @endif>
@include('layouts.side' , ['slag' => 7 , 'subSlag' => 15])


<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    @include('flash-message')
    <!-- Navbar -->
    @include('layouts.nav' , ['page_title' => __('main.products_list'). ' / '. __('main.add_product')])
    <!-- End Navbar -->
        <div class="modal-body itemCaRD" id="paymentBody">
            <form   method="POST" action="{{ route('storeProduct') }}">
                @csrf

                <div class="row" style="padding: 20px">
                    <div class="col-md-6 col-sm-6">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>{{ __('main.Product_Type') }} <span style="color:red; font-size:20px; font-weight:bold;">*</span> </label>
                                    <select class="form-control @error('type') is-invalid @enderror" id="type" name="type">
                                        <option value="1">{{__('main.General')}}</option>
                                        <option value="2">{{__('main.Collection')}}</option>
                                        <option value="3">{{__('main.Service')}}</option>
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
                            <div class="col-12">
                                <div class="form-group">
                                    <label>{{ __('main.Slug') }}   <span style="color:red; font-size:20px; font-weight:bold;">*</span> </label>
                                    <input type="text"  id="slug" name="slug"
                                           class="form-control @error('slug') is-invalid @enderror"
                                           placeholder="{{ __('main.Slug') }}"  />
                                    @error('slug')
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
                                    <label>{{ __('main.brand') }} <span style="color:red; font-size:20px; font-weight:bold;">*</span> </label>
                                    <select class="form-control @error('brand') is-invalid @enderror" name="brand">
                                        @foreach($brands as $brand)
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
                            <div class="col-12">
                                <div class="form-group">
                                    <label>{{ __('main.Cost') }}  <span style="color:red; font-size:20px; font-weight:bold;">*</span>  </label>
                                    <input type="number"  id="cost" name="cost"
                                           class="form-control @error('cost') is-invalid @enderror" step="0.01"
                                           placeholder="{{ __('main.Cost') }}"  />
                                    @error('cost')
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
                                    <label>{{ __('main.Sale_Price') }}  <span style="color:red; font-size:20px; font-weight:bold;">*</span>  </label>
                                    <input type="number"  id="price" name="price"
                                           class="form-control @error('price') is-invalid @enderror" step="0.01"
                                           placeholder="{{ __('main.Sale_Price') }}"  />
                                    @error('price')
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
                                    <label>{{ __('main.Max_Order') }}  </label>
                                    <input type="number"  id="max_order" name="max_order"
                                           class="form-control" step="0.01"
                                           placeholder="{{ __('main.Max_Order') }}"  />
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-6 col-sm-6">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>{{ __('main.Product_Tax') }}   <span style="color:red; font-size:20px; font-weight:bold;">*</span></label>
                                    <select  class="form-control @error('tax_rate') is-invalid @enderror" name="tax_rate">
                                        @foreach($taxRages as $brand)
                                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('tax_rate')
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
                                    <label>{{ __('main.Product_Tax_Type') }} <span style="color:red; font-size:20px; font-weight:bold;">*</span>  </label>
                                    <select class="form-control @error('tax_method') is-invalid @enderror" name="tax_method">
                                        @foreach($taxTypes as $brand)
                                            <option value="{{$brand['id']}}">{{$brand['name']}}</option>
                                        @endforeach
                                    </select>
                                    @error('tax_method')
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
                                    <label>{{ __('main.categories') }}   <span style="color:red; font-size:20px; font-weight:bold;">*</span> </label>
                                    <select class="form-control @error('category_id') is-invalid @enderror" name="category_id">
                                        @foreach($categories as $cat)
                                            @if($cat -> isGold == 0)
                                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('category_id')
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
                                    <label>{{ __('main.units') }} <span style="color:red; font-size:20px; font-weight:bold;">*</span>  </label>
                                    <select class="form-control @error('unit') is-invalid @enderror"     name="unit">
                                        @foreach($units as $unit)
                                            @if($unit -> isGold == 0)
                                            <option value="{{$unit->id}}">{{$unit->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('unit')
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
                                    <label>{{ __('main.Lista') }}  </label>
                                    <input type="number"  id="lista" name="lista"
                                           class="form-control" step="0.01"
                                           placeholder="{{ __('main.Lista') }}"  />
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>{{ __('main.Track_Quantity') }}  </label>
                                    <select id="track_quantity" name="track_quantity"
                                           class="form-control" >
                                        <option value="1">{{__('main.status1')}}</option>
                                        <option value="0">{{__('main.status2')}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>{{ __('main.Alert_Quantity') }}  </label>
                                    <input type="number"  id="alert_quantity" name="alert_quantity"
                                           class="form-control" step="0.01"
                                           placeholder="{{ __('main.Alert_Quantity') }}"  />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="hidden" value="0" name="featured">
                                    <input type="hidden" value="0" name="city_tax">
                                    <input type="hidden" value="0" name="quantity">
                                    <label>{{ __('main.status') }}  </label>
                                    <select id="active" name="active"
                                            class="form-control" >
                                        <option value="1">{{__('main.status1')}}</option>
                                        <option value="0">{{__('main.status2')}}</option>
                                    </select>
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
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="../../assets/js/soft-ui-dashboard.min.js?v=1.0.7"></script>
</body>

</html>
