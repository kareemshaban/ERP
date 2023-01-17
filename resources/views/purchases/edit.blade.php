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
    <link href="../../assets/css/jquery-ui.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../../assets/css/nucleo-svg.css" rel="stylesheet" />
    <link id="pagestyle" href="../../assets/css/soft-ui-dashboard.css?v=1.0.7" rel="stylesheet" />
</head>

<body @if(Config::get('app.locale') == 'en') class="g-sidenav-show  bg-gray-100" @else  class="g-sidenav-show rtl bg-gray-100" @endif>
@include('layouts.side' , ['slag' => 9 , 'subSlag' => 0])


<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    @include('flash-message')
    <!-- Navbar -->
    @include('layouts.nav' , ['page_title' => __('main.return_purchase') ])
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4" style="padding: 20px">
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="col-6 text-end">
                                <h6>{{ __('main.original_bill')}}</h6>
                            </div>
                            <div class="col-6 text-end">
                                <h6>{{ __('main.return_purchase')}}</h6>
                            </div>
                        </div>

                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <form   method="POST" action="{{ route('return_purchase_store') }}"
                                enctype="multipart/form-data" >
                            @csrf
                           <div class="row">
                               <div class="col-6 "  style="border-right: solid 2px gray">
                                   <div class="row">
                                       <div class="col-4">
                                           <div class="form-group">
                                               <label>{{ __('main.bill_date') }} <span style="color:red; font-size:20px; font-weight:bold;">*</span> </label>
                                               <input type="datetime-local"  id="bill_datee" name="bill_datee"
                                                      class="form-control" value="{{$data -> date}}" disabled
                                               />
                                           </div>
                                       </div>
                                       <div class="col-4">
                                           <div class="form-group">
                                               <label>{{ __('main.bill_number') }} <span style="color:red; font-size:20px; font-weight:bold;">*</span> </label>
                                               <input type="text"  id="bill_numberr" name="bill_numberr"
                                                      class="form-control" placeholder="bill_number" value="{{$data -> invoice_no}}" disabled
                                               />
                                           </div>
                                       </div>
                                   </div>
                                   <div class="row">
                                       <div class="col-4 " >
                                           <div class="form-group">
                                               <label>{{ __('main.warehouse') }} <span style="color:red; font-size:20px; font-weight:bold;">*</span> </label>
                                               <input type="text"  id="warehouse_id" name="warehouse_id"
                                                      class="form-control" placeholder="bill_number" value="{{$data -> warehouse_name}}" readonly
                                               />

                                           </div>
                                       </div>

                                       <div class="col-4 " >
                                           <div class="form-group">
                                               <label>{{ __('main.supplier') }} <span style="color:red; font-size:20px; font-weight:bold;">*</span> </label>
                                               <input type="text"  id="customer_id" name="customer_id"
                                                      class="form-control" placeholder="bill_number" value="{{$data -> customer_name}}" readonly
                                               />

                                           </div>
                                       </div>
                                   </div>


                                   <div class="row" hidden>
                                       <div class="col-12">
                                           <div class="col-md-12" id="sticker">
                                               <div class="well well-sm">
                                                   <div class="form-group" style="margin-bottom:0;">
                                                       <div class="input-group wide-tip">
                                                           <div class="input-group-addon" style="padding-left: 10px; padding-right: 10px;">
                                                               <i class="fa fa-2x fa-barcode addIcon"></i></div>
                                                           <input style="border-radius: 0 !important;padding-left: 10px;padding-right: 10px;"
                                                                  type="text" name="add_item" value="" class="form-control input-lg ui-autocomplete-input" id="add_item" placeholder="{{__('main.add_item_hint')}}" autocomplete="off">

                                                       </div>

                                                   </div>
                                                   <ul class="suggestions" id="products_suggestions" style="display: block">

                                                   </ul>
                                                   <div class="clearfix"></div>
                                               </div>
                                           </div>


                                       </div>
                                   </div>

                               </div>
                               <div class="col-6">
                                   <div class="row" style="display: flex; justify-content: right; text-align: right">
                                       <div class="col-4">
                                           <div class="form-group">
                                               <label>{{ __('main.bill_date') }} <span style="color:red; font-size:20px; font-weight:bold;">*</span> </label>
                                               <input type="datetime-local"  id="bill_date" name="bill_date"
                                                      class="form-control"
                                               />
                                           </div>
                                       </div>
                                       <div class="col-4">
                                           <div class="form-group">
                                               <label>{{ __('main.bill_number') }} <span style="color:red; font-size:20px; font-weight:bold;">*</span> </label>
                                               <input type="text"  id="bill_number" name="bill_number"
                                                      class="form-control" placeholder="bill_number" readonly
                                               />
                                           </div>
                                       </div>
                                   </div>
                                   <div class="row">
                                       <div class="col-12">
                                           <div class="form-group">
                                               <label>{{ __('main.notes') }} <span style="color:red; font-size:20px; font-weight:bold;">*</span> </label>
                                               <textarea name="notes" id="notes" rows="3" placeholder="{{ __('main.notes') }}" class="form-control-lg" style="width: 100%" ></textarea>
                                               <input type="hidden" value="{{$data -> id}}" name="returned_bill_id" id="returned_bill_id">
                                           </div>
                                       </div>
                                   </div>
                               </div>
                           </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="control-group table-group">
                                        <label class="table-label">{{__('main.items')}} </label>

                                        <div class="controls table-controls">
                                            <table id="sTable" class="table items table-striped table-bordered table-condensed table-hover">
                                                <thead>
                                                <tr>
                                                    <th>{{__('main.item_name_code')}}</th>
                                                    <th class="col-md-2 text-center">{{__('main.price_without_tax')}}</th>
                                                    <th class="col-md-2 text-center">{{__('main.price_with_tax')}}</th>
                                                    <th class="col-md-1 text-center">{{__('main.quantity')}} </th>
                                                    <th class="col-md-2 text-center">{{__('main.total_without_tax')}}</th>
                                                    <th class="col-md-2 text-center">{{__('main.tax')}}</th>
                                                    <th class="col-md-2 text-center">{{__('main.net')}}</th>
                                                    <th class="col-md-2 text-center">{{__('main.returned_qnt')}}</th>
                                                </tr>
                                                </thead>
                                                <tbody id="tbody">
                                                @foreach($details as $detail)
                                                    <tr disabled="true">
                                                        <td><input type="hidden"  name="product_id[]" value="{{$detail -> product_id}}"> <span>{{$detail ->name }} -- {{$detail ->code }}</span> </td>
                                                        <td><input type="number" class="form-control" name="price_without_tax[]"  value="{{$detail ->cost_without_tax }}" readonly> </td>
                                                        <td><input type="number" class="form-control" name="price_with_tax[]" value="{{$detail ->cost_with_tax }}" readonly> </td>
                                                        <td><input type="number" class="form-control" name="qnt[]" value="{{$detail ->quantity }}" readonly> </td>
                                                        <td><input type="number" class="form-control" name="total[]" value="{{$detail ->total }}" readonly>  </td>
                                                        <td><input type="number" class="form-control" name="tax[]" value="{{$detail ->tax }}" readonly> </td>
                                                        <td><input type="number" class="form-control" name="net[]" value="{{$detail ->net }}" readonly>  </td>
                                                        <td><input class="form-control" type="number" name="returned_qnt[]" min="0" max="{{$detail ->quantity}}" value="0"></td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                                <tfoot></tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>{{ __('main.notes') }} <span style="color:red; font-size:20px; font-weight:bold;">*</span> </label>
                                        <textarea name="notess" id="notess" rows="2" placeholder="{{ __('main.notes') }}" class="form-control-lg" style="width: 100%" disabled>{{$data -> note}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <input type="submit" class="btn btn-primary" id="primary" tabindex="-1"
                                           style="width: 150px;
margin: 30px auto;" value="{{__('main.save_btn')}}"></input>

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
                <img src="../../assets/img/warning.png" class="alertImage">
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

    $(document).ready(function() {
        document.getElementById('bill_date').valueAsDate = new Date();
        getBillNo();

    });


    function getBillNo(){

        let bill_number = document.getElementById('bill_number');
        $.ajax({
            type:'get',
            url:'/get_purchaseR_number',
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
        $.ajax({
            type:'get',
            url:'getProduct' + '/' + code,
            dataType: 'json',

            success:function(response){

                document.getElementById('products_suggestions').innerHTML = '';
                if(response){
                    if(response.length == 1){
                        //addItemToTable
                        showSuggestions(response[0]);
                    }else if(response.length > 1){
                        showSuggestions(response);
                    } else if(response.id){
                        //showSuggestions(response);
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
            var price = item.cost;
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


    function is_numeric(mixed_var) {
        var whitespace = ' \n\r\t\f\x0b\xa0\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200a\u200b\u2028\u2029\u3000';
        return (
            (typeof mixed_var === 'number' || (typeof mixed_var === 'string' && whitespace.indexOf(mixed_var.slice(-1)) === -1)) &&
            mixed_var !== '' &&
            !isNaN(mixed_var)
        );
    }
    function loadItems(){

        $('#sTable tbody').empty();
        $.each(sItems,function (i,item) {
            console.log(item);

            var newTr = $('<tr data-item-id="'+item.id+'">');
            var tr_html ='<td><input type="hidden" name="product_id[]" value="'+item.id+'"> <span>'+item.name + '---' + (item.code)+'</span> </td>';
            tr_html +=   '<td><input type="text" class="form-control iPrice" name="price_without_tax[]" value="'+item.price_withoute_tax.toFixed(2)+'"></td>';
            tr_html +=   '<td><input type="text" class="form-control iPriceWTax" name="price_with_tax[]" value="'+item.price_with_tax.toFixed(2)+'"></td>';
            tr_html +=   '<td><input type="text" class="form-control iQuantity" name="qnt[]" value="'+item.qnt.toFixed(2)+'"></td>';
            tr_html +=   '<td><input type="text" readonly="readonly" class="form-control" name="total[]" value="'+(item.price_withoute_tax*item.qnt).toFixed(2)+'"></td>';
            tr_html +=   '<td><input type="text" readonly="readonly" class="form-control" name="tax[]" value="'+(item.item_tax*item.qnt).toFixed(2)+'"></td>';
            tr_html +=   '<td><input type="text" readonly="readonly" class="form-control" name="net[]" value="'+(item.price_with_tax*item.qnt).toFixed(2)+'"></td>';
            tr_html += `<td>      <button type="button" class="btn btn-labeled btn-danger deleteBtn " value=" '+item.id+' ">
                                            <span class="btn-label" style="margin-right: 10px;"><i class="fa fa-trash"></i></span></button> </td>`;

            newTr.html(tr_html);
            newTr.appendTo('#sTable');
        });

    }
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
