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
<div class="modal fade" id="purchase_return_modal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel"
     aria-hidden="true"
     style="width: 100%;">
    <div class="modal-dialog modal-sm" role="document" style="min-width: 1000px">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="text-center">{{__('main.purchases_return_report')}} <br>
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
                                style="text-align: center !important; border: solid 1px gray">{{__('main.warehouse')}} </th>
                            <th class="text-center"
                                style="text-align: center !important; border: solid 1px gray">{{__('main.supplier_name')}}</th>
                            <th class="text-center"
                                style="text-align: center !important; border: solid 1px gray">{{__('main.total')}}</th>
                            <th class="text-center"
                                style="text-align: center !important; border: solid 1px gray">{{__('main.paid')}}</th>
                            <th class="text-center"
                                style="text-align: center !important; border: solid 1px gray">{{__('main.remain')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $total = 0;
                        $paid = 0;
                        $remain = 0;

                        ?>
                        @foreach($data as $detail)
                            @if(\Carbon\Carbon::parse($detail -> date) -> gte ( \Carbon\Carbon::parse($fdate)) &&
                                  \Carbon\Carbon::parse($detail -> date) -> lte ( \Carbon\Carbon::parse($tdate))
                           )
                                @if($detail -> warehouse_id == $warehouse || $warehouse == 0)
                                    @if($detail -> customer_id == $vendor || $vendor == 0)
                                        @if($detail -> invoice_no == $bill_no || $bill_no == 'empty')
                                            <tr>
                                                <td class="text-center"
                                                    style="text-align: center !important; border: solid 1px gray">{{$detail ->date }}</td>
                                                <td class="text-center"
                                                    style="text-align: center !important; border: solid 1px gray">{{$detail ->invoice_no }}</td>
                                                <td class="text-center"
                                                    style="text-align: center !important; border: solid 1px gray">{{$detail ->warehouse_name }}</td>
                                                <td class="text-center"
                                                    style="text-align: center !important; border: solid 1px gray">{{$detail ->supplier_name }}</td>
                                                <td class="text-center"
                                                    style="text-align: center !important; border: solid 1px gray">{{$detail ->net }}</td>
                                                <td class="text-center"
                                                    style="text-align: center !important; border: solid 1px gray">{{$detail ->paid }}</td>
                                                <td class="text-center"
                                                    style="text-align: center !important; border: solid 1px gray">{{$detail ->net - $detail ->paid }}</td>
                                            </tr>
                                            <?php $total += $detail->net;
                                            $paid += $detail->paid;
                                            $remain += ($detail->net - $detail->paid);
                                            ?>
                                        @endif
                                    @endif
                                @endif
                            @endif
                        @endforeach
                        <tr style="background: aliceblue">
                            <td class="text-center tabletitle"
                                style="text-align: center !important; border: solid 1px gray"> الإجمالي
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="text-align: center !important; border: solid 1px gray">{{$total}}</td>
                            <td style="text-align: center !important; border: solid 1px gray">{{$paid}}</td>
                            <td style="text-align: center !important; border: solid 1px gray">{{$remain}}</td>
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
    $(document).ready(function () {
        $('#table').DataTable();
    });

    function print_modal() {
        var mywindow = window.open('', 'PRINT', 'height=400,width=600');

        mywindow.document.write('<html><head><title>' + document.title + '</title>');
        mywindow.document.write('</head><body >');
        mywindow.document.write('<h1>' + document.title + '</h1>');
        mywindow.document.write(document.getElementById('purchase_return_modal').innerHTML);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10*/

        mywindow.print();
        mywindow.close();

        return true;
    }
</script>
