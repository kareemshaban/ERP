
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
                            <th>{{__('main.code')}}</th>
                            <th>{{__('main.name')}}</th>
                            <th>{{__('main.Debit')}}</th>
                            <th>{{__('main.Credit')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $payment)
                            <tr>
                                <td>{{$payment->code}}</td>
                                <td>@if($payment->ledger_name <> '') {{ $payment->ledger_name }} @else {{$payment->name}}  @endif</td>
                                <td>{{$payment->debit}}</td>
                                <td>{{$payment->credit}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
