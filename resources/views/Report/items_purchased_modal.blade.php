<style>
    .icon {
        font-size: 30px;
        color: black;
        width: fit-content;
        margin: 10px;
    }

    td, th {
        text-align: center;
    }
</style>
<div class="modal fade" id="purchase_modal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel"
     aria-hidden="true"
     style="width: 100%;">
    <div class="modal-dialog modal-sm" role="document" style="min-width: 1000px">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="text-center">{{__('main.imported_items_reports')}} <br>
                    <div class="row">
                        <button class="btn btn-info" style="width: 150px" onclick="print_modal()"><i
                                class="fa fa-print "></i> Print
                        </button>
                    </div>
                </h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"
                        style="color: red; font-size: 20px; font-weight: bold;">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body" id="smallBody">

                <div class="row col-md-12">

                </div>

                <div class="col-md-12">
                    <table id="table" class="table items table-striped table-bordered table-condensed table-hover"
                           style="direction: rtl ; width: 100%">
                        <thead>
                        <tr>
                            <th class="text-center"
                                style="text-align: center !important; border: solid 1px gray">{{__('main.bill_date')}}</th>
                            <th class="text-center"
                                style="text-align: center !important; border: solid 1px gray">{{__('main.bill_number')}}</th>
                            <th class="text-center"
                                style="text-align: center !important; border: solid 1px gray">{{__('main.supplier_name')}}</th>
                            <th class="text-center"
                                style="text-align: center !important; border: solid 1px gray">{{__('main.product_code')}}</th>
                            <th class="text-center"
                                style="text-align: center !important; border: solid 1px gray">{{__('main.product_name')}}</th>
                            <th class="text-center"
                                style="text-align: center !important; border: solid 1px gray">{{__('main.quantity')}}</th>
                            <th class="text-center"
                                style="text-align: center !important; border: solid 1px gray">{{__('main.Cost')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $detail)
                            @if(\Carbon\Carbon::parse($detail -> date) -> gte ( \Carbon\Carbon::parse($fdate)) &&
                                  \Carbon\Carbon::parse($detail -> date) -> lte ( \Carbon\Carbon::parse($tdate))
                           )
                                @if($detail -> warehouse_id == $warehouse || $warehouse == 0)
                                    @if($detail -> product_id == $item_id || $item_id == 0)
                                        @if($detail -> customer_id == $supplier || $supplier == 0)
                                            <tr>
                                                <td class="text-center"
                                                    style="text-align: center !important; border: solid 1px gray">{{$detail ->date }}</td>
                                                <td class="text-center"
                                                    style="text-align: center !important; border: solid 1px gray">{{$detail ->invoice_no }}</td>
                                                <td class="text-center"
                                                    style="text-align: center !important; border: solid 1px gray">{{$detail ->supplier_name }}</td>
                                                <td class="text-center"
                                                    style="text-align: center !important; border: solid 1px gray">{{$detail ->product_code }}</td>
                                                <td class="text-center"
                                                    style="text-align: center !important; border: solid 1px gray">{{$detail ->product_name }}</td>
                                                <td class="text-center"
                                                    style="text-align: center !important; border: solid 1px gray">{{$detail ->quantity }}</td>
                                                <td class="text-center"
                                                    style="text-align: center !important; border: solid 1px gray">{{$detail ->cost_with_tax }}</td>
                                            </tr>
                                        @endif
                                    @endif
                                @endif
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <br>


            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#table').DataTable();
    });

    function print_modal() {
        var mywindow = window.open('', 'PRINT', 'height=400,width=600');

        mywindow.document.write('<html><head><title>' + document.title + '</title>');
        mywindow.document.write('</head><body >');
        mywindow.document.write('<h1>' + document.title + '</h1>');
        mywindow.document.write(document.getElementById('purchase_modal').innerHTML);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10*/

        mywindow.print();
        mywindow.close();

        return true;
    }
</script>
