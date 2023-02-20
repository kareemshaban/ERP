
<div class="modal fade" id="paymentsModal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document"  style="min-width: 700px">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close"  data-bs-dismiss="modal"  aria-label="Close" style="color: red; font-size: 20px; font-weight: bold;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="smallBody">
                <table  id="sTable" class="table items table-striped table-bordered table-condensed table-hover text-center">
                    <thead>
                        <tr>
                            <th>{{__('main.date')}}</th>
                            <th>{{__('main.paid_by')}}</th>
                            <th>{{__('main.amount')}}</th>
                            <th>{{__('main.user')}}</th>
                            <th>{{__('main.actions')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $payment)
                            <tr>
                                <td>{{$payment->date}}</td>
                                <td>{{$payment->paid_by}}</td>
                                <td>{{$payment->amount}} <span>{{$setting ->currency -> symbol}}</span></td>
                                <td>{{$payment->user -> name}}</td>
                                <td>
                                    <a href="{{route('delete_sales_payments',$payment->id)}}">
                                        <i class="fa fa-trash text-danger"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
