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
    @include('layouts.side' , ['slag' => 10 ,   'subSlag' => 30])

<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    @include('flash-message')
        @include('layouts.nav' , ['page_title' => __('main.users_transactions_report') ])


    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4" style="padding: 20px">
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="col-6 text-start">
                                <h6>{{ __('main.users_transactions_report')}}</h6>
                            </div>
                        </div>

                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ __('main.from_date') }} <span style="color:red; font-size:20px; font-weight:bold;">*</span> </label>
                                    <input type="checkbox" name="is_from_date" id="is_from_date"/>
                                    <input type="date"  id="from_date" name="from_date"
                                           class="form-control"
                                    />
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ __('main.to_date') }} <span style="color:red; font-size:20px; font-weight:bold;">*</span> </label>
                                    <input type="checkbox" name="is_to_date" id="is_to_date"/>
                                    <input type="date"  id="to_date" name="to_date"
                                           class="form-control"
                                    />
                                </div>
                            </div>


                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{ __('main.warehouses') }} <span style="color:red; font-size:20px; font-weight:bold;">*</span> </label>
                                    <select class="form-select mr-sm-2"
                                            name="warehouse_id" id="warehouse_id">
                                        <option  value="0" selected>{{__('main.all')}}</option>
                                        @foreach ($warehouses as $item)
                                            <option value="{{$item -> id}}"> {{ $item -> name}}</option>

                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="col-md-12" id="sticker">
                                    <div class="well well-sm" @if(Config::get('app.locale') == 'ar')style="direction: rtl;" @endif>
                                        <div class="form-group" style="margin-bottom:0;">
                                            <div class="input-group wide-tip">
                                                <div class="input-group-addon" style="padding-left: 10px; padding-right: 10px;">
                                                    <i class="fa fa-2x fa-barcode addIcon"></i></div>
                                                <input style="border-radius: 0 !important;padding-left: 10px;padding-right: 10px;"
                                                       type="text" name="add_item" value="" class="form-control input-lg ui-autocomplete-input" id="add_item" placeholder="{{__('main.add_item_hint')}}" autocomplete="off">
                                                  <input type="hidden" id="item_id" name="item_id" value="0">
                                            </div>

                                        </div>
                                        <ul class="suggestions" id="products_suggestions" style="display: block">

                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>


                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 text-center">
                                <input type="submit" class="btn btn-primary" id="excute" tabindex="-1"
                                       style="width: 150px;
margin: 30px auto;" value="{{__('main.excute_btn')}}"></input>

                            </div>
                        </div>

                    </div>
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

    var suggestionItems = {};
    var sItems = {};
    var count = 1;

    $(document).ready(function() {
        $('#is_from_date').prop('checked' , false);
        $('#from_date').attr('disabled' , true);
        $('#is_to_date').prop('checked' , false);
        $('#to_date').attr('disabled' , true);

        $('#is_from_date').change(function (){
            $('#from_date').attr('disabled' , !this.checked);
        });
        $('#is_to_date').change(function (){
            $('#to_date').attr('disabled' , !this.checked);
        });

        document.getElementById('from_date').valueAsDate = new Date();
        document.getElementById('to_date').valueAsDate = new Date();

        $('#excute').click(function (){
            var fromDate = '' ;
            var toDate = '' ;
            if (!$('#is_from_date').is(":checked"))
            {
                fromDate = '01-01-2000';

            } else {
                fromDate =  document.getElementById('from_date').value.toString() ;
            }
            if (!$('#is_to_date').is(":checked"))
            {
                toDate = '01-01-2050';

            } else {
                toDate =  document.getElementById('to_date').value.toString() ;
            }

            const warehouse = document.getElementById('warehouse_id').value;
            var item ;
            var item_id ;
            if(document.getElementById('add_item').value ){
                item = document.getElementById('item_id').value ;
                item_id = item ?? 0 ;
            } else {
                item_id = 0 ;
            }

           showReport( fromDate , toDate , warehouse ,item_id );






        });

        $('#add_item').on('input',function(e){
            searchProduct($('#add_item').val());
        });

        $('input[name=add_item]').change(function() {
            console.log($('#add_item').val());
        });

        $(document).on('click', '.select_product', function () {
            var row = $(this).closest('li');
            var item_id = row.attr('data-item-id');
            document.getElementById('item_id').value = item_id ;
             var item = suggestionItems[item_id] ;
            document.getElementById('add_item').value = item.name + '--' + item.code ;
            document.getElementById('products_suggestions').innerHTML = '';
            suggestionItems = {};
        });

    });

    function showReport(fdate , tdate , warehouse , item ) {
        var route = '{{route('items_stock_report_search',[ ":fdate",  ":tdate",  ":warehouse" , ":item" ] )}}';
        route = route.replace(":fdate",fdate );
        route = route.replace(":tdate",tdate );
        route = route.replace(":warehouse",warehouse );
        route = route.replace(":item",item );
        console.log(route);
        $.get( route, function( data ) {
            $( ".show_modal" ).innerHTML = "" ;
              $( ".show_modal" ).html( data );
              $('#items_modal').modal('show');

        });
    }

    function searchProduct(code){
        console.log(code);
        var url = '{{route('getProduct',":id")}}';
        url = url.replace(":id",code);
        $.ajax({
            type:'get',
            url:url,
            dataType: 'json',

            success:function(response){
                console.log(response);
                document.getElementById('products_suggestions').innerHTML = '';
                suggestionItems = {};
                document.getElementById('item_id').value = 0 ;
                if(response){
                    if(response.length == 1){
                        //addItemToTable
                        //addItemToTable(response[0]);
                        showSuggestions(response);
                    }else if(response.length > 1){

                        showSuggestions(response);
                    } else if(response.id){
                        showSuggestions(response);
                    } else {
                        //showNotFoundAlert
                        openDialog();
                        document.getElementById('add_item').value = '' ;
                    }
                } else {
                    //showNotFoundAlert
                    openDialog();
                    document.getElementById('add_item').value = '' ;
                }
            }
        });
    }

    function showSuggestions(response) {

        $data = '';
        $.each(response,function (i,item) {
            suggestionItems[item.id] = item;
            $data +='<li class="select_product" data-item-id="'+item.id+'">'+item.name+'</li>';
        });
        document.getElementById('products_suggestions').innerHTML = $data;
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
