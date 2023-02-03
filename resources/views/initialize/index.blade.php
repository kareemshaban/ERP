<div class="modal fade" id="paymentsModal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document"  style="min-width: 700px">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close"  data-bs-dismiss="modal"  aria-label="Close" style="color: red; font-size: 20px; font-weight: bold;">
                    <span aria-hidden="true">&times;</span>
                </button>
                <label>{{__('main.init_settings')}}</label>
            </div>
            <div class="modal-body" id="smallBody">
                <form method="post" action="{{route('store_init')}}">
                    @csrf

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>{{ __('main.valid_to') }} <span style="color:red; font-size:20px; font-weight:bold;">*</span> </label>
                                <input type="date"  id="valid_to" name="valid_to"
                                       class="form-control" required @if($settings) value="{{$settings->valid_to}}" @endif
                                       placeholder="{{ __('main.valid_to') }}"  />

                            </div>
                        </div>
                        <div class="col-6 " >
                            <div class="form-group">
                                <label>{{ __('main.contact_phone') }} <span style="color:red; font-size:20px; font-weight:bold;">*</span> </label>
                                <input required type="tel"  id="contact_phone" name="contact_phone"
                                       class="form-control" @if($settings) value="{{$settings->contact_phone}}" @endif
                                       placeholder="{{ __('main.contact_phone') }}"  />

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6 " >
                            <div class="form-group">
                                <label>{{ __('main.max_users') }} <span style="color:red; font-size:20px; font-weight:bold;">*</span> </label>
                                <input required type="number"  id="max_users" name="max_users"
                                       class="form-control" @if($settings) value="{{$settings->max_users}}" @endif
                                       placeholder="{{ __('main.max_users') }}"  />

                            </div>
                        </div>
                        <div class="col-6 " >
                            <div class="form-group">
                                <label>{{ __('main.max_branches') }} <span style="color:red; font-size:20px; font-weight:bold;">*</span> </label>
                                <input required type="number"  id="max_branches" name="max_branches"
                                       class="form-control" @if($settings) value="{{$settings->max_branches}}" @endif
                                       placeholder="{{ __('main.max_branches') }}"  />

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
