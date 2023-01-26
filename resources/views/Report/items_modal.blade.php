
<style>
    .icon{
        font-size: 30px;
        color: black;
        width: fit-content;
        margin: 10px;
    }
    td , th {
        text-align: center;
    }
</style>
<div class="modal fade" id="items_modal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true"
     style="width: 100%;">
    <div class="modal-dialog modal-sm" role="document" style="min-width: 1000px">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="text-center">
                    @if($type == 0)
                    {{__('main.items_report')}}
                    @elseif($type == 1)
                        {{__('main.under_limit_items_report')}}
                    @elseif($type == 2)
                        {{__('main.no_balance_items_report')}}
                    @endif
                    <br>
                 <div class="row">
                     <button class="btn btn-info" style="width: 150px" onclick="print_modal()"> <i class="fa fa-print " ></i> Print</button>
                 </div>
                </h4>
                <button type="button" class="close"  data-bs-dismiss="modal"  aria-label="Close" style="color: red; font-size: 20px; font-weight: bold;">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body" id="smallBody">

                <div class="row col-md-12">

                </div>

                <div class="col-md-12">
                    <table id="table" class="table items table-striped table-bordered table-condensed table-hover" style="direction: rtl ; width: 100%">
                        <thead>
                        <tr>
                            <th class="text-center" style="text-align: center !important; border: solid 1px gray">{{__('main.product_code')}} </th>
                            <th class="text-center" style="text-align: center !important; border: solid 1px gray">{{__('main.product_name')}}</th>
                            <th class="text-center" style="text-align: center !important; border: solid 1px gray">{{__('main.unit')}}</th>
                            <th class="text-center" style="text-align: center !important; border: solid 1px gray">{{__('main.quantity')}}</th>
                            @if($type == 1)
                            <th class="text-center" style="text-align: center !important; border: solid 1px gray">{{__('main.alert_quantity')}}</th>
                            @endif
                            <th class="text-center" style="text-align: center !important; border: solid 1px gray">{{__('main.Cost')}}</th>
                            <th class="text-center" style="text-align: center !important; border: solid 1px gray">{{__('main.price')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $total = 0 ;

                              $cost = 0 ;

                        ?>
                            @foreach($data as $item)
                                        @if($item -> category_id == $category || $category == 0)
                                            @if($item -> brand == $brand || $brand == 0)
                                <tr>
                                    <td class="text-center"  style="text-align: center !important; border: solid 1px gray">{{$item -> code }}</td>
                                    <td class="text-center"  style="text-align: center !important; border: solid 1px gray">{{$item -> name }}</td>
                                    <td class="text-center"  style="text-align: center !important; border: solid 1px gray">{{$item ->unit_name }}</td>
                                    <td class="text-center"  style="text-align: center !important; border: solid 1px gray">{{$item ->quantity }}</td>
                                    @if($type == 1)
                                    <td class="text-center"  style="text-align: center !important; border: solid 1px gray">{{$item ->alert_quantity }}</td>
                                    @endif
                                    <td class="text-center"  style="text-align: center !important; border: solid 1px gray">{{$item ->cost }}</td>
                                    <td class="text-center"  style="text-align: center !important; border: solid 1px gray">{{$item ->price }}</td>
                                </tr>
                                <?php $total += $item -> price ;
                                $cost += $item -> cost ;
                                ?>
                                        @endif
                                    @endif
                            @endforeach
                        <tr style="background: aliceblue">
                            <td  class="text-center tabletitle"  style="text-align: center !important; border: solid 1px gray"> الإجمالي</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            @if($type == 1)
                            <td></td>
                            @endif
                            <td  style="text-align: center !important; border: solid 1px gray">{{$cost}}</td>
                            <td  style="text-align: center !important; border: solid 1px gray">{{$total}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <br>



            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#table').DataTable();
    });
    function print_modal(){
        var mywindow = window.open('', 'PRINT', 'height=400,width=600');

        mywindow.document.write('<html><head><title>' + document.title  + '</title>');
        mywindow.document.write('</head><body >');
        mywindow.document.write('<h1>' + document.title  + '</h1>');
        mywindow.document.write(document.getElementById('items_modal').innerHTML);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10*/

        mywindow.print();
        mywindow.close();

        return true;
    }
</script>
