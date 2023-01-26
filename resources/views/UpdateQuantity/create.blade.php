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
</head>

<body @if(Config::get('app.locale') == 'en') class="g-sidenav-show  bg-gray-100" @else  class="g-sidenav-show rtl bg-gray-100" @endif>
@include('layouts.side' , ['slag' => 7 , 'subSlag' => 17])


<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    @include('flash-message')
    <!-- Navbar -->
    @include('layouts.nav' , ['page_title' => __('main.add_update_qnt') ])
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4" style="padding: 20px">
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="col-6 text-start">
                                <h6>{{ __('main.add_update_qnt')}}</h6>
                            </div>
                        </div>

                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <form   method="POST" action="{{ route('store_update_qnt') }}"
                                enctype="multipart/form-data" >
                            @csrf

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('main.bill_date') }} <span style="color:red; font-size:20px; font-weight:bold;">*</span> </label>
                                        <input type="datetime-local"  id="bill_date" name="bill_date"
                                               class="form-control"
                                              />
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>{{ __('main.bill_number') }} <span style="color:red; font-size:20px; font-weight:bold;">*</span> </label>
                                        <input type="text"  id="bill_number" name="bill_number"
                                               class="form-control" placeholder="bill_number" readonly
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 " >
                                    <div class="form-group">
                                        <label>{{ __('main.warehouse') }} <span style="color:red; font-size:20px; font-weight:bold;">*</span> </label>
                                        <select class="form-select mr-sm-2"
                                                name="warehouse_id" id="warehouse_id">
                                            <option  value="0" selected>Choose...</option>
                                            @foreach ($warehouses as $item)
                                                <option value="{{$item -> id}}"> {{ $item -> name}}</option>

                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
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
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="control-group table-group">
                                        <label class="table-label">{{__('main.items')}} </label>

                                        <div class="controls table-controls">
                                            <table id="qaTable" class="table items table-striped table-bordered table-condensed table-hover">
                                                <thead>
                                                <tr>
                                                    <th class="col-md-1" style="display:none;">item_id</th>
                                                    <th>{{__('main.item_name_code')}}</th>
                                                    <th class="col-md-2" style="display:none;">متغير</th>
                                                    <th class="col-md-1">{{__('main.type')}} </th>
                                                    <th class="col-md-1">{{__('main.quantity')}} </th>
                                                    <th class="col-md-5">{{__('main.notes')}} </th>
                                                    <th style="max-width: 30px !important; text-align: center;">
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

    $(document).ready(function() {
        getBillNo();
        var now = new Date();
        now.setMinutes(now.getMinutes() - now.getTimezoneOffset());

        /* remove second/millisecond if needed - credit ref. https://stackoverflow.com/questions/24468518/html5-input-datetime-local-default-value-of-today-and-current-time#comment112871765_60884408 */
        now.setMilliseconds(null);
        now.setSeconds(null);

        document.getElementById('bill_date').value = now.toISOString().slice(0, -1);
        $('input[name=add_item]').change(function() {
            console.log($('#add_item').val());
        });
        $('#add_item').on('input',function(e){
            searchProduct($('#add_item').val());
        });
        // $('#add_item').keypress(function(event){
        //     var keycode = (event.keyCode ? event.keyCode : event.which);
        //     console.log($('#add_item').val());
        //     if(keycode == '13'){
        //         event.preventDefault();
        //         const code = event.target.value ;
        //         searchProduct(code);
        //     }
        // });
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
          url:'getUpdateQntBillNo',
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
      var table = document.getElementById("tbody");
      var repeate = document.getElementById( 'tbody-tr' + item.id);

      if(!repeate) {
          console.log(repeate);
          var row = table.insertRow(-1);
          row.id = 'tbody-tr' + item.id;
          row.className = "text-center";
          var cell0 = row.insertCell(0);
          var cell1 = row.insertCell(1);
          var cell2 = row.insertCell(2);
          var cell3 = row.insertCell(3);
          var cell4 = row.insertCell(4);
          var cell5 = row.insertCell(5);
          var cell6 = row.insertCell(6);
          cell0.hidden = true ;
          cell2.hidden = true ;
          cell0.innerHTML = item.id +'<input name="item_id[]" value="'+item.id+'" hidden>';
          cell1.innerHTML = item.name + '---' + (item.code);
          cell2.innerHTML = "";
          cell3.innerHTML = `<td><select class="form-select" name="type[]" >
                                <option id="1" value="1">{{__('main.add')}}</option>
                               <option id="2" value="2">{{__('main.sub')}}</option>
                           </select> </td>`;
          cell4.innerHTML = `<td><input class="form-control" type="number" name="qnt[]" value="1" /> </td>`;
          cell5.innerHTML = `<td><input class="form-control" type="text" name="notes[]" /> </td>`;
          cell6.innerHTML = `<td>      <button type="button" class="btn btn-labeled btn-danger deleteBtn " value=" '+item.id+' ">
                                            <span class="btn-label" style="margin-right: 10px;"><i class="fa fa-trash"></i></span>{{__('main.delete')}}</button> </td>`;
      }
      else {
          var tds = repeate.getElementsByTagName('td');
          var qntTd = tds[4];
          var qntInp = qntTd.getElementsByTagName("input")[0];
          var oldQnt = qntInp.value ;
          var qnt = Number(oldQnt) + 1 ;
          qntInp.value = qnt ;
          //increaseQnt
      }
      document.getElementById('add_item').value = '' ;
  }
  function increaseQnt(){

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
