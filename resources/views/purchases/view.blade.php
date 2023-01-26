
<div class="modal fade" id="paymentsModal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true"
     style="width: 100%;">
    <div class="modal-dialog modal-sm" role="document" style="min-width: 1000px">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close"  data-bs-dismiss="modal"  aria-label="Close" style="color: red; font-size: 20px; font-weight: bold;">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body" id="smallBody">

                <div class="row col-md-12">
                    <div class="col-md-4"></div>
                    <div class="col-md-4"><h2>{{__('main.purchase')}}</h2></div>
                    <div class="col-md-4"></div>
                </div>

                <div class="row col-md-12">
                    <div class="col-md-6">
                        <h4>{{__('main.from')}}</h4>
                        <p>{{$vendor->name}}</p>
                        <p>{{$vendor->company}}</p>
                        <p>{{$vendor->vat_no}}</p>
                        <p>{{$vendor->address}}</p>
                        <p>{{$vendor->phone}}</p>
                        <p>{{$vendor->email}}</p>
                    </div>

                    <div class="col-md-6">
                        <h4>{{__('main.to')}}</h4>
                        <p>{{ $cashier ? $cashier->name : '' }}</p>
                        <p>{{$cashier? $cashier->company : ''}}</p>
                        <p>{{$cashier?  $cashier->vat_no : ''}}</p>
                        <p>{{$cashier? $cashier->address : ''}}</p>
                        <p>{{$cashier? $cashier->phone : ''}}</p>
                        <p>{{$cashier? $cashier->email: ''}}</p>
                    </div>
                </div>

                <div class="col-md-12">
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
                                    <td class="text-center">{{$detail ->cost_without_tax }}</td>
                                    <td class="text-center">{{$detail ->cost_with_tax }}</td>
                                    <td class="text-center">{{$detail ->quantity }}</td>
                                    <td class="text-center">{{$detail ->total }}</td>
                                    <td class="text-center">{{$detail ->tax }}</td>
                                    <td class="text-center">{{$detail ->net }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

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

    })
</script>
