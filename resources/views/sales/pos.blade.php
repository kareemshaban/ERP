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
    <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.0.7" rel="stylesheet" />
    <style>
        .sim{
            background-color: #f5f5f5;
            border: 1px solid #e3e3e3;
            width: 48%;
            margin: auto !important;
            display: block;
            box-shadow: inset 0 1px 1px rgba(0,0,0,.05);
            overflow-x: hidden;
        }
        #sTable th{
            white-space: pre-line !important;
        }
        #sTable td{
            white-space: pre-line !important;
        }
        .footer{
            height: 30%;
        }
        .body{
            height: 45%;
            min-height: 300px;
        }
        .header{
            height: 25%;
        }
        .hedaer_table {
            margin: 10px auto;

        }

        .tabletitle {
            font-size: 15px;
            font-weight: bold;
            text-align: center;
            background: #EEE;
            padding: 5px;
        }
        .btn-group, .btn-group-vertical {
            position: relative;
            display: inline-block;
            vertical-align: middle;
        }

    </style>
</head>

<body @if(Config::get('app.locale') == 'en') class="g-sidenav-show  bg-gray-100" @else  class="g-sidenav-show rtl bg-gray-100" @endif>
@include('layouts.side' , ['slag' => 8 , 'subSlag' => 34])


<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    @include('flash-message')
    <!-- Navbar -->
    @include('layouts.nav' , ['page_title' => __('main.pos') ])
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">

                <div class="card-body px-0 pt-0 pb-2">
                    <form   method="POST" action="{{ route('store_sale') }}"
                            enctype="multipart/form-data" id="form">
                        @csrf
                        <div class="row" style="padding: 10px; border-radius: 30px">
                            <div class="col-6 ">

                                <div class="row header" style="min-height: 200px">
                                    <table class="hedaer_table table-bordered " style="width: 98%; direction: rtl">
                                        <tr style="background: black !important; color: white; padding: 5px">
                                            <td class="text-center ">{{__('main.total')}}</td>
                                            <td class="text-center" id="totalBig">0.00</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="row body" style="min-height: 400px">

                                </div>
                                <div class="row footer" style="min-height: 200px">
                                </div>
                            </div>
                            <div class="col-5 sim" >
                                <div class="row header" >
                                    <input type="datetime-local"  id="bill_date" name="bill_date" hidden
                                           class="form-control"
                                    />
                                    <input type="text"  id="bill_number" name="bill_number" hidden
                                           class="form-control" placeholder="bill_number" readonly
                                    />
                                    <input type="text"  id="POS" name="POS" hidden value="1"
                                           class="form-control" placeholder="bill_number" readonly
                                    />


                                    <div class="col-12">
                                        <div class="col-md-12" id="sticker">
                                            <div class="well well-sm">
                                                <div class="form-group" style="margin-bottom:0;">
                                                    <label for="customer_id">{{__('main.clients')}}</label>
                                                    <select id="customer_id" name="customer_id" class="form-select" style="direction: ltr">
                                                        @foreach($vendors as $vendor)
                                                            <option value="{{$vendor -> id}}">{{$vendor -> name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group" style="margin-bottom:0;">
                                                    <label for="warehouse_id">{{__('main.warehouse')}}</label>
                                                    <select class="form-select mr-sm-2"
                                                            name="warehouse_id" id="warehouse_id">
                                                        <option  value="0" selected>Choose...</option>
                                                        @foreach ($warehouses as $item)
                                                            <option value="{{$item -> id}}"  @if($item -> id == $settings -> branch_id) selected @endif> {{ $item -> name}}</option>

                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group" style="margin-bottom:0; margin-top: 20px">
                                                    <div class="input-group wide-tip" @if(Config::get('app.locale') == 'ar')style="direction: rtl;" @endif>
                                                        <div class="input-group-addon" style="padding-left: 10px; padding-right: 10px;">
                                                            <i class="fa fa-2x fa-barcode addIcon"></i></div>
                                                        <input style="border-radius: 0 !important;padding-left: 10px;padding-right: 10px;"
                                                               type="text" name="add_item" value="" class="form-control input-lg ui-autocomplete-input" id="add_item" placeholder="{{__('main.add_item_hint')}}" autocomplete="off">

                                                    </div>
                                                    <ul class="suggestions" id="products_suggestions" style="display: block">

                                                    </ul>
                                                    <div class="clearfix"></div>

                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>

                                <div class="row body">

                                    <div class="col-md-12">


                                        <div class="card mb-4">
                                            <div class="card-header pb-0">
                                                <h4 class="table-label text-center">{{__('main.items')}} </h4>
                                            </div>

                                            <div class="card-body px-0 pt-0 pb-2">
                                                <div class="table-responsive p-0">

                                                    <table id="sTable" style="width:100%; direction: rtl;" class="table align-items-center mb-0"
                                                           style="direction: rtl">
                                                        <thead style="background-image: linear-gradient(310deg, #428BCA 0%, #428BCA 100%); color: white">
                                                        <tr>
                                                            <th class="text-center col-md-3">{{__('main.item_name_code')}}</th>
                                                            <th class="text-center col-md-1">{{__('main.price_with_tax')}}</th>
                                                            <th class="text-center col-md-1">{{__('main.quantity')}} </th>
                                                            <th class="text-center col-md-1">{{__('main.net')}}</th>
                                                            <th class="text-center col-md-1" style="max-width: 30px !important; text-align: center;">
                                                                <i class="fa fa-trash-o" style="opacity:0.5; filter:alpha(opacity=50);"></i>
                                                            </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="tbody"></tbody>
                                                        <tfoot></tfoot>
                                                    </table>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <div class="row">
                                        <table class="hedaer_table table-bordered " style="width: 98%; direction: rtl">
                                            <tr >
                                                <td class="text-center tabletitle">{{__('main.total')}}</td>
                                                <td class="text-center" id="total">0.00</td>
                                                <td class="text-center tabletitle">{{__('main.total_without_tax')}}</td>
                                                <td class="text-center" id="total_with_tax">0.00</td>
                                            </tr>
                                            <tr >
                                                <td class="text-center tabletitle">{{__('main.items')}}</td>
                                                <td class="text-center" id="items">0</td>
                                                <td class="text-center tabletitle">{{__('main.item_count')}}</td>
                                                <td class="text-center" id="items_count">0</td>
                                            </tr>
                                            <tr style="background: black !important; color: white; padding: 5px">
                                                <td colspan="2" class="text-center " style="padding: 8px">{{__('main.req_money')}}</td>
                                                <td colspan="2" class="text-center ">0</td>
                                            </tr>

                                        </table>
                                    </div>

                                    <table style="width: 100%;">
                                        <thead></thead>
                                        <tbody>
                                        <tr>
                                            <td class="text-center" style="padding-right: 5px">
                                                <button type="button" class="btn btn-danger btn-block" id="cancel_entry" style="height:73px;font-size:16px;
                                                    font-weight:bold; width: 100%;" tabindex="-1">
                                                    <i class="fa fa-close" style="margin-right: 5px;"></i> إلغاء (F3)
                                                </button>

                                            </td>
                                            <td class="text-center"style="padding-left: 5px">
                                                <button type="button" class="btn btn-success btn-block" id="payment" style="height:73px;font-size:16px;font-weight:bold;
                                                    width:100%;" tabindex="-1">
                                                    <i class="fa fa-money" style="margin-right: 5px;"></i> دفع (F9)
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="text-center">
                                                <button type="button" class="btn btn-warning btn-block btn-flat" style="font-size:16px;font-weight:bold; width: 100%;" id="print" tabindex="-1" >
                                                    {{__('main.print_last')}} (F2)
                                                </button>
                                            </td>
                                        </tr>


                                        </tbody>
                                    </table>


                                </div>


                            </div>
                        </div>
                    </form>

                </div>


            </div>
        </div>

        @include('layouts.footer')
    </div>
</main>

<div class="show_modal">

</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                Alert!
                <button type="button" class="close"  data-bs-dismiss="modal"  aria-label="Close" style="color: red; font-size: 20px; font-weight: bold; background: white;
                height: 35px; width: 35px;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="smallBody">
                <img src="../assets/img/warning.png" class="alertImage">
                <label class="alertTitle">{{__('main.notfound')}}</label>
                <br> <label  class="alertSubTitle" id="modal_table_bill"></label>
                <div class="row text-center">
                    <div class="col-6 text-center" style="display: block;margin: auto">
                        <button type="button" class="btn btn-labeled btn-primary cancel-modal"  >
                            <span class="btn-label" style="margin-right: 10px;"><i class="fa fa-check"></i></span>{{__('main.ok_btn')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var suggestionItems = {};
    var sItems = {};
    var count = 1;
    var Bill = null ;

    $('#payment').click(function (){
        submit();
    });
    $('#print').click(function (){
        printBill();
    });
    $('#cancel_entry').click(function (){
        cancelEntry();
    });
    $(document).keydown(function(event) {
        console.log(event.keyCode);
        if (event.keyCode == 120) {
            submit();
        }
        if (event.keyCode == 113) {
            printBill();
        }
        if (event.keyCode == 114) {
            cancelEntry();
        }
    });

    function submit() {
        let form = document.getElementById("form");
        form.submit();
    }
    function printBill(){
        var route = '{{route('print_last_pos')}}';

        $.get( route, function( data ) {
            $( ".show_modal" ).html( data );
            $('#paymentsModal').modal('show');
        });
    }
    function cancelEntry(){
        $('#sTable tbody').empty();
        document.getElementById('items').innerHTML = 0 ;
        document.getElementById('items_count').innerHTML = 0 ;

        document.getElementById('total').innerHTML = 0 ;
        document.getElementById('total_with_tax').innerHTML = 0 ;
        document.getElementById('totalBig').innerHTML = 0 ;

        sItems = {};
        count = 1;
        Bill = null ;
        suggestionItems = {};
    }


    $(document).ready(function() {

        $.ajax({
            type: 'get',
            url: 'getLastSalesBill',
            dataType: 'json',

            success: function (response) {
                console.log(response);

                if (response) {

                    if (response.pos == 1 ) {
                        if (response.paid == 0) {
                            Bill = response;
                            addPayments(Bill.id);
                        } else {
                            Bill = null ;
                        }

                    } else {
                        Bill = null;
                    }


                } else {
                    Bill = null;
                }
            }
        });

        var now = new Date();
        now.setMinutes(now.getMinutes() - now.getTimezoneOffset());

        /* remove second/millisecond if needed - credit ref. https://stackoverflow.com/questions/24468518/html5-input-datetime-local-default-value-of-today-and-current-time#comment112871765_60884408 */
        now.setMilliseconds(null);
        now.setSeconds(null);

        document.getElementById('bill_date').value = now.toISOString().slice(0, -1);

        getBillNo();


        $('input[name=add_item]').change(function() {
            console.log($('#add_item').val());
        });
        $('#add_item').on('input',function(e){
            searchProduct($('#add_item').val());
        });

        $(document).on('click' , '.cancel-modal' , function (event) {
            $('#deleteModal').modal("hide");
            id = 0 ;
        });

        $(document).on('click' , '.deleteBtn' , function (event) {
            var row = $(this).parent().parent().index();

            var row1 = $(this).closest('tr');
            var item_id = row1.attr('data-item-id');
            delete sItems[item_id];
            loadItems();
            // var table = document.getElementById('tbody');
            // table.deleteRow(row);
        });

        $(document).on('click', '.select_product', function () {
            var row = $(this).closest('li');
            var item_id = row.attr('data-item-id');
            addItemToTable(suggestionItems[item_id]);
            document.getElementById('products_suggestions').innerHTML = '';
            suggestionItems = {};
        });

    });

    function addPayments(id) {
        var route = '{{route('add_sales_payments',":id")}}';
        route = route.replace(":id",id);

        $.get( route, function( data ) {
            $( ".show_modal" ).html( data );
            $('#paymentsModal').modal('show');
        });
    }
    function view_purchase(id) {
        var route = '{{route('preview_sales',":id")}}';
        route = route.replace(":id",id);

        $.get( route, function( data ) {
            $( ".show_modal" ).html( data );
            $('#paymentsModal').modal('show');
        });
    }

    function getBillNo(){
        const id = document.getElementById('warehouse_id').value ;
        let bill_number = document.getElementById('bill_number');
        $.ajax({
            type:'get',
            url:'/get_sales_number/' + id ,
            dataType: 'json',

            success:function(response){
                console.log(response);

                if(response){
                    bill_number.value = response ;
                } else {
                    bill_number.value = '' ;
                }
            }
        });
    }
    function searchProduct(code){
        var url = '{{route('getProduct',":id")}}';
        url = url.replace(":id",code);
        $.ajax({
            type:'get',
            url:url,
            dataType: 'json',

            success:function(response){

                document.getElementById('products_suggestions').innerHTML = '';
                if(response){
                    if(response.length == 1){
                        //addItemToTable
                        addItemToTable(response[0]);
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

    function openDialog(){
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
    }

    function addItemToTable(item){
        if(count == 1){
            sItems = {};
        }

        if(sItems[item.id]){
            sItems[item.id].qnt = sItems[item.id].qnt +1;
        }
        else{
            var price = item.price;
            var taxType = item.tax_method;
            var taxRate = item.tax_rate == 1 ? 0 : 15;
            var itemTax = 0;
            var priceWithoutTax = 0;
            var priceWithTax = 0;
            var itemQnt = 1;

            if(taxType == 1){
                //included
                priceWithTax = price;
                priceWithoutTax = (price / (1+(taxRate/100)));
                itemTax = priceWithTax - priceWithoutTax;
            }else{
                //excluded
                itemTax = price * (taxRate/100);
                priceWithoutTax = price;
                priceWithTax = price + itemTax;
            }

            sItems[item.id] = item;
            sItems[item.id].price_with_tax = priceWithTax;
            sItems[item.id].price_withoute_tax = priceWithoutTax;
            sItems[item.id].item_tax = itemTax;
            sItems[item.id].qnt = 1;

        }
        count++;
        loadItems();

        document.getElementById('add_item').value = '' ;
    }

    var old_row_qty=0;
    var old_row_price = 0;
    var old_row_w_price = 0;

    $(document)
        .on('focus','.iQuantity',function () {
            old_row_qty = $(this).val();
        })
        .on('change','.iQuantity',function () {
            var row = $(this).closest('tr');
            if(!is_numeric($(this).val()) || parseFloat($(this).val()) < 0){
                $(this).val(old_row_qty);
                alert('wrong value');
                return;
            }

            var newQty = parseFloat($(this).val()),
                item_id = row.attr('data-item-id');

            console.log(newQty);
            console.log(item_id);
            sItems[item_id].qnt= newQty;
            loadItems();

        });


    $(document)
        .on('focus','.iPrice',function () {
            old_row_price = $(this).val();
        })
        .on('change','.iPrice',function () {
            var row = $(this).closest('tr');
            if(!is_numeric($(this).val()) || parseFloat($(this).val()) < 0){
                $(this).val(old_row_price);
                alert('wrong value');
                return;
            }

            var newQty = parseFloat($(this).val()),
                item_id = row.attr('data-item-id');


            var item_tax =sItems[item_id].item_tax;
            var priceWithTax = newQty;
            if(item_tax > 0){
                priceWithTax = newQty * 1.15;
                item_tax = newQty * 0.15;
            }
            sItems[item_id].price_withoute_tax= newQty;
            sItems[item_id].price_with_tax= priceWithTax;
            sItems[item_id].item_tax= item_tax;
            loadItems();

        });

    $(document)
        .on('focus','.iPriceWTax',function () {
            old_row_w_price = $(this).val();
        })
        .on('change','.iPriceWTax',function () {
            var row = $(this).closest('tr');
            if(!is_numeric($(this).val()) || parseFloat($(this).val()) < 0){
                $(this).val(old_row_w_price);
                alert('wrong value');
                return;
            }

            var newQty = parseFloat($(this).val()),
                item_id = row.attr('data-item-id');

            var item_tax =sItems[item_id].item_tax;
            var priceWithoutTax = newQty;
            if(item_tax > 0){
                priceWithoutTax = newQty / 1.15;
                item_tax = priceWithoutTax * 0.15;
            }
            sItems[item_id].price_withoute_tax= priceWithoutTax;
            sItems[item_id].price_with_tax= newQty;
            sItems[item_id].item_tax= item_tax;
            loadItems();

        });


    function is_numeric(mixed_var) {
        var whitespace = ' \n\r\t\f\x0b\xa0\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200a\u200b\u2028\u2029\u3000';
        return (
            (typeof mixed_var === 'number' || (typeof mixed_var === 'string' && whitespace.indexOf(mixed_var.slice(-1)) === -1)) &&
            mixed_var !== '' &&
            !isNaN(mixed_var)
        );
    }
    function loadItems(){

        var items = 0 ;
        var qnts = 0 ;
        var total = 0 ;
        var net = 0 ;

        $('#sTable tbody').empty();
        $.each(sItems,function (i,item) {

            items += 1 ;
            qnts += item.qnt ;
            total += item.price_withoute_tax*item.qnt ;
            net += item.price_with_tax*item.qnt ;

            var newTr = $('<tr data-item-id="'+item.id+'">');
            var tr_html ='<td><input type="hidden" name="product_id[]" value="'+item.id+'"> <span>'+item.name + '---' + (item.code)+'</span> </td>';
            tr_html +=   '<td hidden><input type="text" class="form-control iPrice" name="price_without_tax[]" value="'+item.price_withoute_tax.toFixed(2)+'"></td>';
            tr_html +=   '<td><input type="text" class="form-control iPriceWTax" name="price_with_tax[]" value="'+item.price_with_tax.toFixed(2)+'"></td>';
            tr_html +=   '<td><input type="text" class="form-control iQuantity" name="qnt[]" value="'+item.qnt.toFixed(2)+'"></td>';
            tr_html +=   '<td hidden><input type="text" readonly="readonly" class="form-control" name="total[]" value="'+(item.price_withoute_tax*item.qnt).toFixed(2)+'"></td>';
            tr_html +=   '<td hidden><input type="text" readonly="readonly" class="form-control" name="tax[]" value="'+(item.item_tax*item.qnt).toFixed(2)+'"></td>';
            tr_html +=   '<td><input type="text" readonly="readonly" class="form-control" name="net[]" value="'+(item.price_with_tax*item.qnt).toFixed(2)+'"></td>';
            tr_html += `<td class="text-center"  style="display: flex;
justify-content: center;">
<button style="display: flex;justify-content: center;flex-direction: column;"  type="button" class="btn  btn-danger deleteBtn " value=" '+item.id+' ">
                                            <span class="btn-label" ><i class="fa fa-trash"></i></span></button> </td>`;

            newTr.html(tr_html);
            newTr.appendTo('#sTable');
        });

        document.getElementById('items').innerHTML = items ;
        document.getElementById('items_count').innerHTML = qnts ;

        document.getElementById('total').innerHTML = total ;
        document.getElementById('total_with_tax').innerHTML = net ;
        document.getElementById('totalBig').innerHTML = net ;



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
