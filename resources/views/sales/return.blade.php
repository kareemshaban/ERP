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
    <link href="..././../assets/css/jquery-ui.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../../../assets/css/nucleo-svg.css" rel="stylesheet" />
    <link id="pagestyle" href="../../../assets/css/soft-ui-dashboard.css?v=1.0.7" rel="stylesheet" />
</head>

<body @if(Config::get('app.locale') == 'en') class="g-sidenav-show  bg-gray-100" @else  class="g-sidenav-show rtl bg-gray-100" @endif>
@include('layouts.side' , ['slag' => 8 , 'subSlag' => 2])


<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    @include('flash-message')
    <!-- Navbar -->
    @include('layouts.nav' , ['page_title' => __('main.add_return_sale') ])
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4" style="padding: 20px">
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="col-6 text-start">
                                <h6>{{ __('main.add_return_sale')}}</h6>
                            </div>
                        </div>

                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <form   method="POST" action="{{ route('store_return',$id) }}"
                                enctype="multipart/form-data" >
                            @csrf

                            <div class="row">
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
                                <div class="col-4 " >
                                    <div class="form-group">
                                        <label>{{ __('main.warehouse') }} <span style="color:red; font-size:20px; font-weight:bold;">*</span> </label>
                                        <select class="form-select mr-sm-2" readonly="readonly"
                                                name="warehouse_id" id="warehouse_id">
                                            <option  value="0" selected>Choose...</option>
                                            @foreach ($warehouses as $item)
                                                <option @if($item->id == $sale->warehouse_id) selected @endif value="{{$item -> id}}"> {{ $item -> name}}</option>

                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-4 " >
                                    <div class="form-group">
                                        <label>{{ __('main.clients') }} <span style="color:red; font-size:20px; font-weight:bold;">*</span> </label>
                                        <select class="form-select mr-sm-2"  readonly="readonly"
                                                name="customer_id" id="customer_id">
                                            <option  value="0" selected>Choose...</option>
                                            @foreach ($customers as $item)
                                                <option @if($item->id == $sale->customer_id) selected @endif value="{{$item -> id}}"> {{ $item -> name}}</option>

                                            @endforeach
                                        </select>
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
                                                    <th class="col-md-2">{{__('main.price_without_tax')}}</th>
                                                    <th class="col-md-2">{{__('main.price_with_tax')}}</th>
                                                    <th class="col-md-1">{{__('main.quantity')}} </th>
                                                    <th class="col-md-1">{{__('main.returned_qnt')}} </th>
                                                    <th class="col-md-2">{{__('main.total_without_tax')}}</th>
                                                    <th class="col-md-2">{{__('main.tax')}}</th>
                                                    <th class="col-md-2">{{__('main.net')}}</th>

                                                </tr>
                                                </thead>
                                                <tbody id="tbody">

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
                                        <textarea name="notes" id="notes" rows="3" placeholder="{{ __('main.notes') }}" class="form-control-lg" style="width: 100%"></textarea>
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




<script type="text/javascript">

    var suggestionItems = {};
    var sItems = {};
    var count = 1;

    $(document).ready(function() {
        var string = "{{$saleItems}}";

        var allsItems = JSON.parse(string.replace(/&quot;/g,'"'));
        $.each(allsItems,function (i,item) {
            sItems[item.product_id] = item;
        });

        loadItems();

        var now = new Date();
        now.setMinutes(now.getMinutes() - now.getTimezoneOffset());

        /* remove second/millisecond if needed - credit ref. https://stackoverflow.com/questions/24468518/html5-input-datetime-local-default-value-of-today-and-current-time#comment112871765_60884408 */
        now.setMilliseconds(null);
        now.setSeconds(null);

        document.getElementById('bill_date').value = now.toISOString().slice(0, -1);

        getBillNo();
        //document.getElementById('bill_date').valueAsDate = new Date();
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
            console.log(row);
            var table = document.getElementById('tbody');
            table.deleteRow(row);
        });

        $(document).on('click', '.select_product', function () {
            var row = $(this).closest('li');
            var item_id = row.attr('data-item-id');
            addItemToTable(suggestionItems[item_id]);
            document.getElementById('products_suggestions').innerHTML = '';
            suggestionItems = {};
        });

    });


  function getBillNo(){

      let bill_number = document.getElementById('bill_number');
      $.ajax({
          type:'get',
          url:'{{route('get_sale_return_no')}}',
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
                      addItemToTable(response[0]);
                  }else if(response.length > 1){
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

        if(newQty > sItems[item_id].quantity){
            $(this).val(old_row_qty);
            alert('wrong value');
            return;
        }


        sItems[item_id].rqnt= newQty;
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

          if(item.quantity > 0) {

              if (!item.rqnt) {
                  item.rqnt = 0;
              }

              console.log(item);

              var newTr = $('<tr data-item-id="' + item.product_id + '">');
              var tr_html = '<td><input type="hidden" name="product_id[]" value="' + item.product_id + '"> <span>' + item.product_name + '---' + (item.product_code) + '</span> </td>';
              tr_html += '<td><input type="text" class="form-control" readonly name="price_without_tax[]" value="' + parseFloat(item.price_without_tax).toFixed(2) + '"></td>';
              tr_html += '<td><input type="text" class="form-control" readonly name="price_with_tax[]" value="' + parseFloat(item.price_with_tax).toFixed(2) + '"></td>';
              tr_html += '<td><input type="text" class="form-control" name="all_qnt[]" value="' + parseFloat(item.quantity).toFixed(2) + '"></td>';
              tr_html += '<td><input type="text" class="form-control iQuantity" name="qnt[]" value="' + item.rqnt.toFixed(2) + '"></td>';
              tr_html += '<td><input type="text" readonly="readonly" class="form-control" name="total[]" value="' + (parseFloat(item.price_without_tax) * parseFloat(item.rqnt)).toFixed(2) + '"></td>';
              tr_html += '<td><input type="text" readonly="readonly" class="form-control" name="tax[]" value="' + (parseFloat(item.tax) * parseFloat(item.rqnt)).toFixed(2) + '"></td>';
              tr_html += '<td><input type="text" readonly="readonly" class="form-control" name="net[]" value="' + (parseFloat(item.price_with_tax) * parseFloat(item.rqnt)).toFixed(2) + '"></td>';


              newTr.html(tr_html);
              newTr.appendTo('#sTable');
          }
      });

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
