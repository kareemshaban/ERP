
<div class="modal fade" id="expensesModal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true"
     style="width: 100%;">
    <div class="modal-dialog modal-md" role="document" style="min-width: 500px">
        <div class="modal-content">
            <div class="modal-header">
                <label>{{__('main.box_expenses_preview')}}</label>
                <button type="button" class="close"  data-bs-dismiss="modal"  aria-label="Close" style="color: red; font-size: 20px; font-weight: bold;">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body" id="smallBody">


                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>{{ __('main.bill_date') }} <span style="color:red; font-size:20px; font-weight:bold;">*</span> </label>
                                <input type="date"  id="date" name="date" readonly
                                       class="form-control" required
                                       placeholder="{{ __('main.bill_date') }}"  value="{{$bill -> date}}" />

                            </div>
                        </div>
                        <div class="col-6 " >
                            <div class="form-group">
                                <label>{{ __('main.bill_number') }} <span style="color:red; font-size:20px; font-weight:bold;">*</span> </label>
                                <input required type="text"   id="bill_number" name="bill_number"
                                       class="form-control" value="{{$bill -> bill_number}}"
                                       placeholder="{{ __('main.bill_number') }}"  readonly />


                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>{{ __('main.expenses_category') }} <span style="color:red; font-size:20px; font-weight:bold;">*</span> </label>
                                <select class="form-select" name="expenses_category" id="expenses_category" disabled>
                                    @foreach($expenses as $type)
                                        <option value="{{$type -> id}}"  @if($type -> id == $bill -> expenses_category)  selected @endif >{{$type -> name}}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>{{ __('main.warehouse') }} <span style="color:red; font-size:20px; font-weight:bold;">*</span> </label>
                                <select class="form-select" name="warehouse_id" id="warehouse_id" disabled>
                                    @foreach($warehouses as $warehouse)
                                        <option value="{{$warehouse -> id}}" @if($warehouse -> id == $bill -> warehouse_id)  selected @endif>{{$warehouse -> name}}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-6 " >
                            <div class="form-group">
                                <label>{{ __('main.paid') }} <span style="color:red; font-size:20px; font-weight:bold;">*</span> </label>
                                <input required type="number" step="any"  id="amount" name="amount"
                                       class="form-control"
                                       placeholder="0"  readonly value="{{$bill -> amount}}"/>

                            </div>
                        </div>

                        <div class="col-6 " >
                            <div class="form-group">
                                <label>{{ __('main.payment_type') }} <span style="color:red; font-size:20px; font-weight:bold;">*</span> </label>
                                <select name="payment_type" class="form-select" id="payment_type" disabled>
                                    <option value="0" @if($bill -> payment_type == 0 ) selected @endif>{{__('main.CC')}}</option>
                                    <option value="1" @if($bill -> payment_type == 1 ) selected @endif>{{__('main.Cash')}}</option>
                                    <option value="2" @if($bill -> payment_type == 2 ) selected @endif>{{__('main.Transfer_Net')}}</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>{{ __('main.notes') }} <span style="color:red; font-size:20px; font-weight:bold;">*</span> </label>
                                <textarea name="notes" id="notes" rows="3" placeholder="{{ __('main.notes') }}" class="form-control-lg" style="width: 100%" readonly>{{$bill -> notes}}</textarea>
                            </div>
                        </div>
                    </div>



            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

    })
</script>
