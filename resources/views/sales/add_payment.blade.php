
<div class="modal fade" id="paymentsModal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true"
style="width: 100%;">
    <div class="modal-dialog modal-sm" role="document" style="min-width: 500px">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close"  data-bs-dismiss="modal"  aria-label="Close" style="color: red; font-size: 20px; font-weight: bold;">
                    <span aria-hidden="true">&times;</span>
                </button>
                <label>{{__('main.add_payment')}}</label>
            </div>
            <div class="modal-body" id="smallBody">
                <form   method="POST" action="{{ route('store_sales_payments',$id) }}"
                        enctype="multipart/form-data" >
                    @csrf

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>{{ __('main.bill_date') }} <span style="color:red; font-size:20px; font-weight:bold;">*</span> </label>
                                <input type="date"  id="date" name="date" readonly
                                       class="form-control" required
                                       placeholder="{{ __('main.bill_date') }}"  />

                            </div>
                        </div>
                        <div class="col-6 " >
                            <div class="form-group">
                                <label>{{ __('main.amount') }} <span style="color:red; font-size:20px; font-weight:bold;">*</span> </label>
                                <input required type="number" step="0.01"  id="amount" name="amount"
                                       class="form-control" value="{{$remain}}" max="{{$remain}}"
                                       placeholder="{{ __('main.amount') }}"  />

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6 " >
                            <div class="form-group">
                                <label>{{ __('main.paid_by') }} <span style="color:red; font-size:20px; font-weight:bold;">*</span> </label>
                                <select name="paid_by" class="form-control" id="paid_by">
                                    <option value="cc">{{__('main.CC')}}</option>
                                    <option value="cash">{{__('main.Cash')}}</option>
                                    <option value="transfer_net">{{__('main.Transfer_Net')}}</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-12" style="display: block; margin: 20px auto; text-align: center;">
                            <button type="submit" class="btn btn-labeled btn-primary"  >
                                {{__('main.save_btn')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        document.getElementById('date').valueAsDate = new Date();
    })
</script>
