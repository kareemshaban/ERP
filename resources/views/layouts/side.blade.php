<style>
    .sidebar {
        background:#fff;
        box-shadow:0 2px 8px rgba(0,0,0,0.2);
        transition:all 0.3s ease-out;
    }

    .sidebar ul {
        list-style:none;
    }

    .sidebar ul li {
        display:block;
    }

    .sidebar ul li a {
        padding:8px 15px;
        font-size:16px;
        color:#222;
        font-family:arial;
        text-decoration:none;
        display:block;
        position:relative;
        z-index:1;
        transition:all 0.3s ease-out;
        font-weight:500;
    }

    .sidebar ul li a:before {
        content:'';
        position:absolute;
        bottom:0;
        left:50%;
        right:50%;
        transform:translate(-50%,-50%);
        width:0;
        height:1px;
        background:#0e748b;
        z-index:-1;
        transition:all 0.3s ease-out;
    }

    .sidebar ul li a:hover:before {
        width:100%;
    }

    .sidebar ul li a:hover {
        color:#0e748b;
    }

    .sidebarshow {
        left:0;
    }

    .Arrowbutton {
        background:transparent;
        border:none;
        width:50px;
        cursor:pointer;
        outline:0;

    }
    .btn_pos_en{
        position: absolute;
        right: 0;
    }
    .btn_pos_ar{
        position: absolute;
        left: 0;
    }
    .fa-chevron-down {
        transform: rotate(0deg);
        transition: all 0.6s;
    }
    .Tactive {
         transform: rotate(180deg);
     }

</style>
<aside   @if(Config::get('app.locale') == 'en') class="sidebar sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 "
        @else class="sidebar sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-end me-3 rotate-caret" @endif id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{route('home')}}" >
            <img src="../../assets/img/favicon.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold"> <label>  </label> ERP CPANEL</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a @if($slag == 1) class="nav-link  active" @else class="nav-link" @endif href="{{route('home')}}" @if(Config::get('app.locale') == 'ar') style="direction: rtl" @endif>
                    <div class="icon icon-shape icon-md shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center" >
                      <img src="../../assets/img/speedometer.png" style="width: 30px ">
                    </div>
                    <span class="nav-link-text ms-1">{{__('main.dashboard')}}</span>

                </a >
            </li>


            @if($init_data->enable_inventory == 1)
            <li class="nav-item">
                <a @if($slag == 2) class="nav-link  active" @else class="nav-link" @endif href="javascript:;"
                   class="nav-link dropdown-toggle  text-truncate"  @if(Config::get('app.locale') == 'ar') style="direction: rtl" @endif>
                    <div class="icon icon-shape icon-md shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <img src="../../assets/img/data-analytics.png" style="width: 30px ">
                    </div>
                    <span class="nav-link-text ms-1">{{__('main.basic_date')}}</span>
                    <button class="Arrowbutton @if(Config::get('app.locale') == 'en') btn_pos_en @else btn_pos_ar @endif" value="dropdown-menu-2" id="dropdown-button-2"><i class="fas fa-chevron-down" ></i></button>
                </a>
                <ul class="dropdown-menu text-small subM" aria-labelledby="dropdown" id="dropdown-menu-2">
                    <li><a @if($subSlag == 1) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('warehouses')}}">{{__('main.warehouses')}}</a></li>
                    <li><a @if($subSlag == 2) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('units' , 0)}}">{{__('main.units')}}</a></li>
                    <li><a @if($subSlag == 3) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('categories')}}">{{__('main.categories')}}</a></li>
                    <li><a @if($subSlag == 4) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('brands')}}">{{__('main.brands')}}</a></li>
                    <li><a @if($subSlag == 5) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('currency')}}">{{__('main.currencies')}}</a></li>
                    <li><a @if($subSlag == 6) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('expenses')}}">{{__('main.expenses_type')}}</a></li>
                    <li><a @if($subSlag == 7) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('taxRates')}}">{{__('main.tax')}}</a></li>
                    <li><a @if($subSlag == 8) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('clientGroups')}}">{{__('main.c_groups')}}</a></li>
                    <li hidden><a @if($subSlag == 20) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('units' , 1)}}">{{__('main.stamp')}}</a></li>

                </ul>
            </li>
            <li class="nav-item">

                <a @if($slag == 6) class="nav-link  active" @else class="nav-link" @endif href="javascript:;" class="nav-link dropdown-toggle  text-truncate"
                   @if(Config::get('app.locale') == 'ar') style="direction: rtl" @endif>
                    <div class="icon icon-shape icon-md shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <img src="../../assets/img/teamwork.png" style="width: 30px ">
                    </div>
                    <span class="nav-link-text ms-1">{{__('main.users_label')}}</span>
                    <button class="Arrowbutton @if(Config::get('app.locale') == 'en') btn_pos_en @else btn_pos_ar @endif"  value="dropdown-menu-6" id="dropdown-button-6"><i class="fas fa-chevron-down" ></i></button>
                </a>

                <ul class="dropdown-menu text-small subM" aria-labelledby="dropdown" id="dropdown-menu-6">
                    <li><a @if($subSlag == 11) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('users')}}">{{__('main.users')}}</a></li>
                    <li><a @if($subSlag == 12) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('cashiers')}}">{{__('main.cashiers')}}</a></li>
                    <li><a @if($subSlag == 13) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('user_groups')}}">{{__('main.user_groups')}}</a></li>
                    <li><a @if($subSlag == 130) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('representatives')}}">{{__('main.representatives')}}</a></li>



                </ul>
            </li>
            <li class="nav-item">
                <a @if($slag == 3) class="nav-link  active" @else class="nav-link" @endif href="{{route('clients' , 3)}}" @if(Config::get('app.locale') == 'ar') style="direction: rtl" @endif>
                    <div class="icon icon-shape icon-md shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <img src="../../assets/img/client.png" style="width: 30px ">
                    </div>
                    <span class="nav-link-text ms-1">{{__('main.clients')}}</span>
                </a >

            </li>
            <li class="nav-item">
                <a @if($slag == 4) class="nav-link  active" @else class="nav-link" @endif href="{{route('clients' , 4)}}" @if(Config::get('app.locale') == 'ar') style="direction: rtl" @endif>
                    <div class="icon icon-shape icon-md shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <img src="../../assets/img/supplier.png" style="width: 30px ">
                    </div>
                    <span class="nav-link-text ms-1">{{__('main.supplier')}}</span>
                </a >
            </li>
            <li class="nav-item">
                <a @if($slag == 7) class="nav-link  active" @else class="nav-link" @endif  href="javascript:;" class="nav-link dropdown-toggle  text-truncate"
                    @if(Config::get('app.locale') == 'ar') style="direction: rtl" @endif>
                    <div class="icon icon-shape icon-md shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <img src="../../assets/img/products.png" style="width: 30px ">
                    </div>
                    <span class="nav-link-text ms-1">{{__('main.products_list')}}</span>
                    <button class="Arrowbutton @if(Config::get('app.locale') == 'en') btn_pos_en @else btn_pos_ar @endif"  value="dropdown-menu-7" id="dropdown-button-7"><i class="fas fa-chevron-down" ></i></button>

                </a >

                <ul class="dropdown-menu text-small subM" aria-labelledby="dropdown" id="dropdown-menu-7">
                    <li><a @if($subSlag == 14) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('products')}}">{{__('main.products_list')}}</a></li>
                    <li><a @if($subSlag == 15) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('createProduct')}}">{{__('main.add_product')}}</a></li>
                    <li hidden><a @if($subSlag == 21) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('products')}}">{{__('main.gold')}}</a></li>
                    <li hidden><a @if($subSlag == 22) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('createProduct')}}">{{__('main.add_gold')}}</a></li>
                    <li><a @if($subSlag == 16) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('update_qnt')}}">{{__('main.update_qnt')}}</a></li>
                    <li><a @if($subSlag == 17) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('add_update_qnt')}}">{{__('main.add_update_qnt')}}</a></li>
                    <li><a @if($subSlag == 38) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('print_barcode')}}">{{__('main.print_barcode')}}</a></li>
                    <li><a @if($subSlag == 39) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('print_qr')}}">{{__('main.print_qr')}}</a></li>


                </ul>

            </li>
            <li class="nav-item">
                <a @if($slag == 8) class="nav-link  active" @else class="nav-link" @endif  href="javascript:;" class="nav-link dropdown-toggle  text-truncate"
                   @if(Config::get('app.locale') == 'ar') style="direction: rtl" @endif>
                    <div class="icon icon-shape icon-md shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">

                        <img src="../../assets/img/invoice.png" style="width: 30px ">
                    </div>
                    <span class="nav-link-text ms-1">{{__('main.sales_bill')}}</span>
                    <button class="Arrowbutton @if(Config::get('app.locale') == 'en') btn_pos_en @else btn_pos_ar @endif"  value="dropdown-menu-8" id="dropdown-button-8"><i class="fas fa-chevron-down" ></i></button>

                </a >

                <ul class="dropdown-menu text-small subM" aria-labelledby="dropdown" id="dropdown-menu-8">
                    <li><a @if($subSlag == 18) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('sales')}}">{{__('main.sales_bill')}}</a></li>
                    <li><a @if($subSlag == 19) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('add_sale')}}">{{__('main.add_sale')}}</a></li>
                    <li><a @if($subSlag == 34) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('pos')}}">{{__('main.pos')}}</a></li>


                </ul>

            </li>
            <li class="nav-item">
                <a @if($slag == 9) class="nav-link  active" @else class="nav-link" @endif  href="javascript:;" class="nav-link dropdown-toggle  text-truncate"
             @if(Config::get('app.locale') == 'ar') style="direction: rtl" @endif>
                    <div class="icon icon-shape icon-md shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <img src="../../assets/img/budget.png" style="width: 30px ">
                    </div>
                    <span class="nav-link-text ms-1">{{__('main.purchases')}}</span>
                    <button class="Arrowbutton @if(Config::get('app.locale') == 'en') btn_pos_en @else btn_pos_ar @endif"  value="dropdown-menu-9" id="dropdown-button-9"><i class="fas fa-chevron-down" ></i></button>

                </a >

                <ul class="dropdown-menu text-small subM" aria-labelledby="dropdown" id="dropdown-menu-9">
                    <li><a @if($subSlag == 23) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('purchases')}}">{{__('main.purchases')}}</a></li>
                    <li><a @if($subSlag == 24) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('add_purchase')}}">{{__('main.add_purchase')}}</a></li>

                </ul>

            </li>
            <li class="nav-item">
                <a @if($slag == 12) class="nav-link  active" @else class="nav-link" @endif  href="javascript:;" class="nav-link dropdown-toggle  text-truncate"
                    @if(Config::get('app.locale') == 'ar') style="direction: rtl" @endif>
                    <div class="icon icon-shape icon-md shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">

                        <img src="../../assets/img/expenses.png" style="width: 30px ">
                    </div>
                    <span class="nav-link-text ms-1">{{__('main.box_expenses')}}</span>
                    <button class="Arrowbutton @if(Config::get('app.locale') == 'en') btn_pos_en @else btn_pos_ar @endif"  value="dropdown-menu-12" id="dropdown-button-12"><i class="fas fa-chevron-down" ></i></button>

                </a >

                <ul class="dropdown-menu text-small subM" aria-labelledby="dropdown" id="dropdown-menu-12">
                    <li><a @if($subSlag == 39) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('box_expenses_list')}}">{{__('main.box_expenses_list')}}</a></li>

                </ul>

            </li>
            @endif

            @if($init_data->enable_accounting == 1)
{{--            Accounting--}}
            <li class="nav-item">
                <a @if($slag == 11) class="nav-link  active" @else class="nav-link" @endif  href="javascript:;" class="nav-link dropdown-toggle  text-truncate"
                   @if(Config::get('app.locale') == 'ar') style="direction: rtl" @endif>
                    <div class="icon icon-shape icon-md shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <img src="../../assets/img/accounting.png" style="width: 30px ">
                    </div>
                    <span class="nav-link-text ms-1">{{__('main.accounting')}}</span>
                    <button class="Arrowbutton @if(Config::get('app.locale') == 'en') btn_pos_en @else btn_pos_ar @endif"  value="dropdown-menu-11" id="dropdown-button-11"><i class="fas fa-chevron-down" ></i></button>

                </a >

                <ul class="dropdown-menu text-small subM" aria-labelledby="dropdown" id="dropdown-menu-11">
                    <li><a @if($subSlag == 35) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('accounts_list')}}">{{__('main.accounts_list')}}</a></li>
                    <li><a @if($subSlag == 36) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('account_settings_list')}}">{{__('main.account_settings')}}</a></li>
                    <li><a @if($subSlag == 37) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('journals')}}">{{__('main.journals')}}</a></li>
                    <li><a @if($subSlag == 38) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('manual_journal')}}">{{__('main.add_manual_journal')}}</a></li>


                </ul>

            </li>
            @endif

            <li class="nav-item">

                <a @if($slag == 5) class="nav-link  active" @else class="nav-link" @endif href="javascript:;" class="nav-link dropdown-toggle  text-truncate"
                   @if(Config::get('app.locale') == 'ar') style="direction: rtl" @endif>
                    <div class="icon icon-shape icon-md shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <img src="../../assets/img/settings.png" style="width: 30px;">
                    </div>
                    <span class="nav-link-text ms-1">{{__('main.setting')}}</span>
                    <button class="Arrowbutton @if(Config::get('app.locale') == 'en') btn_pos_en @else btn_pos_ar @endif"  value="dropdown-menu-5" id="dropdown-button-5"><i class="fas fa-chevron-down" ></i></button>

                </a>

                <ul class="dropdown-menu text-small subM" aria-labelledby="dropdown" id="dropdown-menu-5">
                    @if($init_data->enable_inventory == 1)
                    <li><a @if($subSlag == 9) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('system_settings')}}">{{__('main.system_settings')}}</a></li>
                    <li><a @if($subSlag == 10) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('pos_settings')}}">{{__('main.pos_settings')}}</a></li>
                    @endif


                        <li><a onclick="showInitModal()" @if($subSlag == 100) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="javascript:;">{{__('main.init_settings')}}</a></li>

                </ul>
            </li>


            <li class="nav-item">
                <a @if($slag == 10) class="nav-link  active" @else class="nav-link" @endif  href="javascript:;" class="nav-link dropdown-toggle  text-truncate"
                   @if(Config::get('app.locale') == 'ar') style="direction: rtl" @endif>
                    <div class="icon icon-shape icon-md shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                       <img src="../../assets/img/report.png" style="width: 30px;">
                    </div>
                    <span class="nav-link-text ms-1">{{__('main.reports')}}</span>
                    <button class="Arrowbutton @if(Config::get('app.locale') == 'en') btn_pos_en @else btn_pos_ar @endif"  value="dropdown-menu-10" id="dropdown-button-10"><i class="fas fa-chevron-down" ></i></button>

                </a >

                <ul class="dropdown-menu text-small subM" aria-labelledby="dropdown" id="dropdown-menu-10">
                    @if($init_data->enable_inventory == 1)
                    <li><a @if($subSlag == 25) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('daily_sales_report')}}">{{__('main.daily_sales_report')}}</a></li>
                    <li><a @if($subSlag == 26) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('sales_item_report')}}">{{__('main.sales_report_by_item')}}</a></li>
                    <li><a @if($subSlag == 27) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('purchase_report')}}">{{__('main.purchases_report')}}</a></li>
                    <li><a @if($subSlag == 32) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('purchases_return_report')}}">{{__('main.purchases_return_report')}}</a></li>
                    <li><a @if($subSlag == 33) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('items_report')}}">{{__('main.items_report')}}</a></li>
                    <li><a @if($subSlag == 28) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('items_limit_report')}}">{{__('main.under_limit_items_report')}}</a></li>
                    <li><a @if($subSlag == 29) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('items_no_balance_report')}}">{{__('main.no_balance_items_report')}}</a></li>
                    <li><a @if($subSlag == 30) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('items_stock_report')}}">{{__('main.users_transactions_report')}}</a></li>
                    <li><a @if($subSlag == 31) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('items_purchased_report')}}">{{__('main.imported_items_reports')}}</a></li>
                    @endif

                        @if($init_data->enable_accounting == 1)
                    <li><a @if($subSlag == 41) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('incoming_list')}}">{{__('main.incoming_list_report')}}</a></li>
                    <li><a @if($subSlag == 42) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('balance_sheet')}}">{{__('main.balance_sheet_report')}}</a></li>
                        @endif


                </ul>

            </li>



            <li class="nav-item">
                <a @if($slag == 13) class="nav-link  active" @else class="nav-link" @endif  href="javascript:;" class="nav-link dropdown-toggle  text-truncate"
                   @if(Config::get('app.locale') == 'ar') style="direction: rtl" @endif>
                    <div class="icon icon-shape icon-md shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <img src="../../assets/img/report.png" style="width: 30px;">
                    </div>
                    <span class="nav-link-text ms-1">{{__('main.hr_title')}}</span>
                    <button class="Arrowbutton @if(Config::get('app.locale') == 'en') btn_pos_en @else btn_pos_ar @endif"  value="dropdown-menu-13" id="dropdown-button-13"><i class="fas fa-chevron-down" ></i></button>

                </a >

                <ul class="dropdown-menu text-small subM" aria-labelledby="dropdown" id="dropdown-menu-13">
                    <li><a @if($subSlag == 43) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('employer.categories.index')}}">{{__('main.employer_categories')}}</a></li>
                    <li><a @if($subSlag == 44) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('employers.index')}}">{{__('main.employers')}}</a></li>
                    <li><a @if($subSlag == 45) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('deduction.index')}}">{{__('main.deductions')}}</a></li>
                    <li><a @if($subSlag == 46) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('reward.index')}}">{{__('main.rewards')}}</a></li>
                    <li><a @if($subSlag == 47) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('advance_payments.index')}}">{{__('main.advance_payments')}}</a></li>
                    <li><a @if($subSlag == 48) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('salary_docs')}}">{{__('main.Salary')}}</a></li>



                </ul>

            </li>


        </ul>
    </div>


</aside>
<script type="text/javascript">
    $(function () {
        $(".Arrowbutton").click(function (e) {

            $("#"+e.target.value ).slideToggle(500);
            $("#"+e.target.id + " .fa-chevron-down").toggleClass("Tactive");
        });


        $(".nav-link").click(function (e) {

            if(e.target.getElementsByTagName('button').length > 0){
                e.preventDefault();
                const value = (e.target.getElementsByTagName('button')[0].value);
                const id = (e.target.getElementsByTagName('button')[0].id);
                $("#"+value ).slideToggle(500);
                $("#"+id + " .fa-chevron-down").toggleClass("Tactive");
            }




        });
    });

    $(document).ready(function (){
       // $(".dropdown-menu").slideUp(0);
    })
</script>
