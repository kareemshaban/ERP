
<div class="modal fade" id="paymentsModal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true"
     style="width: 100%;">
    <div class="modal-dialog modal-sm" role="document" style="min-width: 1000px">
        <div class="modal-content">
            <div class="modal-header">

                        <button type="button" class="close not-print"  data-bs-dismiss="modal"  aria-label="Close" style="color: red; font-size: 20px; font-weight: bold;">
                            <span aria-hidden="true">&times;</span>
                        </button>
            </div>
            <div class="modal-body" id="smallBody">

                <div class="row col-md-12">
                    <div class="col-3" style="display: flex; justify-content: center">
                        <button class="btn btn-info not-print" style="width: 150px" onclick="print_modal()"> <i class="fa fa-print " ></i> Print</button>

                    </div>
                    <div class="col-6" style="display: flex; justify-content: center">
                        <h2 class="text-center">
                            @if($data -> pos == 1 )    {{__('main.sales_bill_title1')}}
                            @else
                                @if($vendor->vat_no)  {{__('main.sales_bill_title2')}}
                                @else {{__('main.sales_bill_title3')}}
                                @endif
                            @endif

                        </h2>
                    </div>
                    <div class="col-3" style="display: flex; justify-content: center">
                        <img id='barcode'
                             src="https://api.qrserver.com/v1/create-qr-code/?data=https://seasonsge.com/showBooking/{{$data -> invoice_no}}&amp;size=80x80"
                             alt=""
                             title="HELLO"
                             width="80"
                             height="80"
                             style="width: 80px; height: 80px;"
                        />
                    </div>


                </div>

                <div class="row col-md-12">
                    <table class="table items table-striped table-bordered table-condensed table-hover">
                        <tbody>
                        <tr>
                            <td>{{__('main.bill_date')}}</td>
                            <td>{{$data->date}}</td>
                        </tr>

                        <tr>
                            <td>{{__('main.invoice_no')}}</td>
                            <td>{{$data->invoice_no}}</td>
                        </tr>

                        <tr>
                            <td>{{__('main.client')}}</td>
                            <td>{{$vendor->name}}</td>
                        </tr>

                        <tr>
                            <td>{{__('main.client_vat_no')}}</td>
                            <td>{{$vendor->vat_no}}</td>
                        </tr>

                        </tbody>
                    </table>



                </div>

                <div class="col-md-12">
                    <h2 class="text-center"> {{__('main.items')}} </h2>
                    <table class="table items table-striped table-bordered table-condensed table-hover">
                        <thead>
                        <tr>
                            <th>{{__('main.item_name_code')}}</th>
                            <th class="col-md-2 text-center">{{__('main.price_without_tax')}}</th>
                            <th class="col-md-2 text-center">{{__('main.price_with_tax')}}</th>
                            <th class="col-md-1 text-center">{{__('main.quantity')}} </th>
                            <th class="col-md-2 text-center">{{__('main.total_without_tax')}}</th>
                            <th class="col-md-2 text-center">{{__('main.tax')}}</th>
                            <th class="col-md-2 text-center">{{__('main.net')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($details as $detail)
                                <tr>
                                    <td class="text-center">{{$detail ->name }} -- {{$detail ->code }}</td>
                                    <td class="text-center">{{$detail ->price_without_tax }}</td>
                                    <td class="text-center">{{$detail ->price_with_tax }}</td>
                                    <td class="text-center">{{$detail ->quantity }}</td>
                                    <td class="text-center">{{$detail ->total }}</td>
                                    <td class="text-center">{{$detail ->tax }}</td>
                                    <td class="text-center">{{$detail ->total + $detail->tax }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <br>
                <h2 class="text-center"> {{__('main.payments')}} </h2>

                <table class="table items table-striped table-bordered table-condensed table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">{{__('main.date')}}</th>
                            <th class="text-center">{{__('main.paid_by')}}</th>
                            <th class="text-center"> {{__('main.amount')}}</th>
                            <th class="text-center">{{__('main.user')}}</th>

                        </tr>
                    </thead>
                    <tbody>
                    @foreach($payments as $payment)
                        <tr>
                            <td class="text-center">{{$payment->date}}</td>
                            <td class="text-center">{{$payment->paid_by}}</td>
                            <td class="text-center">{{$payment->amount}}</td>
                            <td class="text-center">{{$payment->user ?  $payment->user -> name : ''}}</td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <br>
                <table class="table items table-striped table-bordered table-condensed table-hover">
                    <tbody>
                        <tr>
                            <td>{{__('main.total_without_tax')}}</td>
                            <td>{{$data->total}}</td>
                        </tr>

                        <tr>
                            <td>{{__('main.tax')}}</td>
                            <td>{{$data->tax}}</td>
                        </tr>
                        <tr>
                            <td>{{__('main.additional_service')}}</td>
                            <td>{{$data->additional_service}}</td>
                        </tr>

                        <tr>
                            <td>{{__('main.net')}}</td>
                            <td>{{$data->net}}</td>
                        </tr>

                        <tr>
                            <td>{{__('main.paid')}}</td>
                            <td>{{$data->paid}}</td>
                        </tr>

                        <tr>
                            <td>{{__('main.remain')}}</td>
                            <td>{{$data->net - $data->paid}}</td>
                        </tr>
                    </tbody>
                </table>


            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

    });
    function print_modal(){
        const originalHTML = document.body.innerHTML;
        document.body.innerHTML = document.getElementById('paymentsModal').innerHTML;
        document.querySelectorAll('.not-print')
            .forEach(img => img.remove())
        window.print();
        document.body.innerHTML = originalHtml;
    }
</script>
