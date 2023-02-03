
<div class="modal fade" id="paymentsModal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document"  style="min-width: 700px">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close"  data-bs-dismiss="modal"  aria-label="Close" style="color: red; font-size: 20px; font-weight: bold;">
                    <span aria-hidden="true">&times;</span>
                </button>
                <p>{{__('main.subscribe_data')}}</p>
            </div>
            <div class="modal-body" id="smallBody">
                <table  id="sTable" class="table items table-striped table-bordered table-condensed table-hover text-center">
                    <tbody>

                            <tr>
                                <td>{{__('main.company_name')}}</td>
                                <td>{{$settings->company_name}}</td>
                            </tr>
                            <tr>
                                <td>{{__('main.max_users')}}</td>
                                <td>{{$settings->max_users}}</td>
                            </tr>
                            <tr>
                                <td>{{__('main.max_branches')}}</td>
                                <td>{{$settings->max_branches}}</td>
                            </tr>
                            <tr>
                                <td>{{__('main.valid_to')}}</td>
                                <td>{{$settings->valid_to}}({{__('main.remaining_days')}} : {{$remaining_days}})</td>
                            </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
