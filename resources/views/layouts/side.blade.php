<aside  @if(Config::get('app.locale') == 'en') class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 "
        @else class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-end me-3 rotate-caret" @endif id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{route('home')}}" >
            <img src="../../assets/img/logo-ct-dark.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold">ERP CPANEL</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a @if($slag == 1) class="nav-link  active" @else class="nav-link" @endif href="{{route('home')}}" @if(Config::get('app.locale') == 'ar') style="direction: rtl" @endif>
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>shop </title>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                    <g transform="translate(1716.000000, 291.000000)">
                                        <g transform="translate(0.000000, 148.000000)">
                                            <path class="color-background opacity-6" d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z"></path>
                                            <path class="color-background" d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z"></path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">{{__('main.dashboard')}}</span>
                </a >
            </li>

            <li class="nav-item">
                <a @if($slag == 2) class="nav-link  active" @else class="nav-link" @endif href="javascript:;" class="nav-link dropdown-toggle  text-truncate" id="dropdown" data-bs-toggle="dropdown" aria-expanded="false" @if(Config::get('app.locale') == 'ar') style="direction: rtl" @endif>
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg width="12px" height="12px" viewBox="0 0 42 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>office</title>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g transform="translate(-1869.000000, -293.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                    <g transform="translate(1716.000000, 291.000000)">
                                        <g id="office" transform="translate(153.000000, 2.000000)">
                                            <path class="color-background opacity-6" d="M12.25,17.5 L8.75,17.5 L8.75,1.75 C8.75,0.78225 9.53225,0 10.5,0 L31.5,0 C32.46775,0 33.25,0.78225 33.25,1.75 L33.25,12.25 L29.75,12.25 L29.75,3.5 L12.25,3.5 L12.25,17.5 Z"></path>
                                            <path class="color-background" d="M40.25,14 L24.5,14 C23.53225,14 22.75,14.78225 22.75,15.75 L22.75,38.5 L19.25,38.5 L19.25,22.75 C19.25,21.78225 18.46775,21 17.5,21 L1.75,21 C0.78225,21 0,21.78225 0,22.75 L0,40.25 C0,41.21775 0.78225,42 1.75,42 L40.25,42 C41.21775,42 42,41.21775 42,40.25 L42,15.75 C42,14.78225 41.21775,14 40.25,14 Z M12.25,36.75 L7,36.75 L7,33.25 L12.25,33.25 L12.25,36.75 Z M12.25,29.75 L7,29.75 L7,26.25 L12.25,26.25 L12.25,29.75 Z M35,36.75 L29.75,36.75 L29.75,33.25 L35,33.25 L35,36.75 Z M35,29.75 L29.75,29.75 L29.75,26.25 L35,26.25 L35,29.75 Z M35,22.75 L29.75,22.75 L29.75,19.25 L35,19.25 L35,22.75 Z"></path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">{{__('main.basic_date')}}</span>
                </a>
                <ul class="dropdown-menu text-small subM" aria-labelledby="dropdown">
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

                <a @if($slag == 6) class="nav-link  active" @else class="nav-link" @endif href="javascript:;" class="nav-link dropdown-toggle  text-truncate" id="dropdown" data-bs-toggle="dropdown" aria-expanded="false" @if(Config::get('app.locale') == 'ar') style="direction: rtl" @endif>
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg width="12px" height="12px" viewBox="0 0 46 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>customer-support</title>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g transform="translate(-1717.000000, -291.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                    <g transform="translate(1716.000000, 291.000000)">
                                        <g transform="translate(1.000000, 0.000000)">
                                            <path class="color-background opacity-6" d="M45,0 L26,0 C25.447,0 25,0.447 25,1 L25,20 C25,20.379 25.214,20.725 25.553,20.895 C25.694,20.965 25.848,21 26,21 C26.212,21 26.424,20.933 26.6,20.8 L34.333,15 L45,15 C45.553,15 46,14.553 46,14 L46,1 C46,0.447 45.553,0 45,0 Z"></path>
                                            <path class="color-background" d="M22.883,32.86 C20.761,32.012 17.324,31 13,31 C8.676,31 5.239,32.012 3.116,32.86 C1.224,33.619 0,35.438 0,37.494 L0,41 C0,41.553 0.447,42 1,42 L25,42 C25.553,42 26,41.553 26,41 L26,37.494 C26,35.438 24.776,33.619 22.883,32.86 Z"></path>
                                            <path class="color-background" d="M13,28 C17.432,28 21,22.529 21,18 C21,13.589 17.411,10 13,10 C8.589,10 5,13.589 5,18 C5,22.529 8.568,28 13,28 Z"></path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>

                    </div>
                    <span class="nav-link-text ms-1">{{__('main.users_label')}}</span>
                </a>

                <ul class="dropdown-menu text-small subM" aria-labelledby="dropdown">
                    <li><a @if($subSlag == 11) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('users')}}">{{__('main.users')}}</a></li>
                    <li><a @if($subSlag == 12) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('cashiers')}}">{{__('main.cashiers')}}</a></li>
                    <li><a @if($subSlag == 13) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('user_groups')}}">{{__('main.user_groups')}}</a></li>


                </ul>
            </li>

            <li class="nav-item">
                <a @if($slag == 3) class="nav-link  active" @else class="nav-link" @endif href="{{route('clients' , 3)}}" @if(Config::get('app.locale') == 'ar') style="direction: rtl" @endif>
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg width="12px" height="12px" viewBox="0 0 46 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>customer-support</title>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g transform="translate(-1717.000000, -291.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                    <g transform="translate(1716.000000, 291.000000)">
                                        <g transform="translate(1.000000, 0.000000)">
                                            <path class="color-background opacity-6" d="M45,0 L26,0 C25.447,0 25,0.447 25,1 L25,20 C25,20.379 25.214,20.725 25.553,20.895 C25.694,20.965 25.848,21 26,21 C26.212,21 26.424,20.933 26.6,20.8 L34.333,15 L45,15 C45.553,15 46,14.553 46,14 L46,1 C46,0.447 45.553,0 45,0 Z"></path>
                                            <path class="color-background" d="M22.883,32.86 C20.761,32.012 17.324,31 13,31 C8.676,31 5.239,32.012 3.116,32.86 C1.224,33.619 0,35.438 0,37.494 L0,41 C0,41.553 0.447,42 1,42 L25,42 C25.553,42 26,41.553 26,41 L26,37.494 C26,35.438 24.776,33.619 22.883,32.86 Z"></path>
                                            <path class="color-background" d="M13,28 C17.432,28 21,22.529 21,18 C21,13.589 17.411,10 13,10 C8.589,10 5,13.589 5,18 C5,22.529 8.568,28 13,28 Z"></path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">{{__('main.clients')}}</span>
                </a >

            </li>
            <li class="nav-item">
                <a @if($slag == 4) class="nav-link  active" @else class="nav-link" @endif href="{{route('clients' , 4)}}" @if(Config::get('app.locale') == 'ar') style="direction: rtl" @endif>
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg width="12px" height="12px" viewBox="0 0 46 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>customer-support</title>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g transform="translate(-1717.000000, -291.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                    <g transform="translate(1716.000000, 291.000000)">
                                        <g transform="translate(1.000000, 0.000000)">
                                            <path class="color-background opacity-6" d="M45,0 L26,0 C25.447,0 25,0.447 25,1 L25,20 C25,20.379 25.214,20.725 25.553,20.895 C25.694,20.965 25.848,21 26,21 C26.212,21 26.424,20.933 26.6,20.8 L34.333,15 L45,15 C45.553,15 46,14.553 46,14 L46,1 C46,0.447 45.553,0 45,0 Z"></path>
                                            <path class="color-background" d="M22.883,32.86 C20.761,32.012 17.324,31 13,31 C8.676,31 5.239,32.012 3.116,32.86 C1.224,33.619 0,35.438 0,37.494 L0,41 C0,41.553 0.447,42 1,42 L25,42 C25.553,42 26,41.553 26,41 L26,37.494 C26,35.438 24.776,33.619 22.883,32.86 Z"></path>
                                            <path class="color-background" d="M13,28 C17.432,28 21,22.529 21,18 C21,13.589 17.411,10 13,10 C8.589,10 5,13.589 5,18 C5,22.529 8.568,28 13,28 Z"></path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">{{__('main.supplier')}}</span>
                </a >
            </li>

            <li class="nav-item">

                <a @if($slag == 5) class="nav-link  active" @else class="nav-link" @endif href="javascript:;" class="nav-link dropdown-toggle  text-truncate" id="dropdown" data-bs-toggle="dropdown" aria-expanded="false" @if(Config::get('app.locale') == 'ar') style="direction: rtl" @endif>
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg width="12px" height="12px" viewBox="0 0 40 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>settings</title>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g transform="translate(-2020.000000, -442.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                    <g transform="translate(1716.000000, 291.000000)">
                                        <g transform="translate(304.000000, 151.000000)">
                                            <polygon class="color-background opacity-6" points="18.0883333 15.7316667 11.1783333 8.82166667 13.3333333 6.66666667 6.66666667 0 0 6.66666667 6.66666667 13.3333333 8.82166667 11.1783333 15.315 17.6716667"></polygon>
                                            <path class="color-background opacity-6" d="M31.5666667,23.2333333 C31.0516667,23.2933333 30.53,23.3333333 30,23.3333333 C29.4916667,23.3333333 28.9866667,23.3033333 28.48,23.245 L22.4116667,30.7433333 L29.9416667,38.2733333 C32.2433333,40.575 35.9733333,40.575 38.275,38.2733333 L38.275,38.2733333 C40.5766667,35.9716667 40.5766667,32.2416667 38.275,29.94 L31.5666667,23.2333333 Z"></path>
                                            <path class="color-background" d="M33.785,11.285 L28.715,6.215 L34.0616667,0.868333333 C32.82,0.315 31.4483333,0 30,0 C24.4766667,0 20,4.47666667 20,10 C20,10.99 20.1483333,11.9433333 20.4166667,12.8466667 L2.435,27.3966667 C0.95,28.7083333 0.0633333333,30.595 0.00333333333,32.5733333 C-0.0583333333,34.5533333 0.71,36.4916667 2.11,37.89 C3.47,39.2516667 5.27833333,40 7.20166667,40 C9.26666667,40 11.2366667,39.1133333 12.6033333,37.565 L27.1533333,19.5833333 C28.0566667,19.8516667 29.01,20 30,20 C35.5233333,20 40,15.5233333 40,10 C40,8.55166667 39.685,7.18 39.1316667,5.93666667 L33.785,11.285 Z"></path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">{{__('main.setting')}}</span>
                </a>

                <ul class="dropdown-menu text-small subM" aria-labelledby="dropdown">
                    <li><a @if($subSlag == 9) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('system_settings')}}">{{__('main.system_settings')}}</a></li>
                    <li><a @if($subSlag == 10) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('pos_settings')}}">{{__('main.pos_settings')}}</a></li>

                </ul>
            </li>
            <li class="nav-item">
                <a @if($slag == 7) class="nav-link  active" @else class="nav-link" @endif  href="javascript:;" class="nav-link dropdown-toggle  text-truncate" id="dropdown" data-bs-toggle="dropdown" aria-expanded="false" @if(Config::get('app.locale') == 'ar') style="direction: rtl" @endif>
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg width="12px" height="12px" viewBox="0 0 46 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>customer-support</title>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g transform="translate(-1717.000000, -291.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                    <g transform="translate(1716.000000, 291.000000)">
                                        <g transform="translate(1.000000, 0.000000)">
                                            <path class="color-background opacity-6" d="M45,0 L26,0 C25.447,0 25,0.447 25,1 L25,20 C25,20.379 25.214,20.725 25.553,20.895 C25.694,20.965 25.848,21 26,21 C26.212,21 26.424,20.933 26.6,20.8 L34.333,15 L45,15 C45.553,15 46,14.553 46,14 L46,1 C46,0.447 45.553,0 45,0 Z"></path>
                                            <path class="color-background" d="M22.883,32.86 C20.761,32.012 17.324,31 13,31 C8.676,31 5.239,32.012 3.116,32.86 C1.224,33.619 0,35.438 0,37.494 L0,41 C0,41.553 0.447,42 1,42 L25,42 C25.553,42 26,41.553 26,41 L26,37.494 C26,35.438 24.776,33.619 22.883,32.86 Z"></path>
                                            <path class="color-background" d="M13,28 C17.432,28 21,22.529 21,18 C21,13.589 17.411,10 13,10 C8.589,10 5,13.589 5,18 C5,22.529 8.568,28 13,28 Z"></path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">{{__('main.products_list')}}</span>
                </a >

                <ul class="dropdown-menu text-small subM" aria-labelledby="dropdown">
                    <li><a @if($subSlag == 14) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('products')}}">{{__('main.products_list')}}</a></li>
                    <li><a @if($subSlag == 15) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('createProduct')}}">{{__('main.add_product')}}</a></li>
                    <li hidden><a @if($subSlag == 21) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('products')}}">{{__('main.gold')}}</a></li>
                    <li hidden><a @if($subSlag == 22) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('createProduct')}}">{{__('main.add_gold')}}</a></li>
                    <li><a @if($subSlag == 16) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('update_qnt')}}">{{__('main.update_qnt')}}</a></li>
                    <li><a @if($subSlag == 17) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('add_update_qnt')}}">{{__('main.add_update_qnt')}}</a></li>
                </ul>

            </li>

            <li class="nav-item">
                <a @if($slag == 8) class="nav-link  active" @else class="nav-link" @endif  href="javascript:;" class="nav-link dropdown-toggle  text-truncate" id="dropdown" data-bs-toggle="dropdown" aria-expanded="false" @if(Config::get('app.locale') == 'ar') style="direction: rtl" @endif>
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg width="12px" height="12px" viewBox="0 0 46 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>customer-support</title>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g transform="translate(-1717.000000, -291.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                    <g transform="translate(1716.000000, 291.000000)">
                                        <g transform="translate(1.000000, 0.000000)">
                                            <path class="color-background opacity-6" d="M45,0 L26,0 C25.447,0 25,0.447 25,1 L25,20 C25,20.379 25.214,20.725 25.553,20.895 C25.694,20.965 25.848,21 26,21 C26.212,21 26.424,20.933 26.6,20.8 L34.333,15 L45,15 C45.553,15 46,14.553 46,14 L46,1 C46,0.447 45.553,0 45,0 Z"></path>
                                            <path class="color-background" d="M22.883,32.86 C20.761,32.012 17.324,31 13,31 C8.676,31 5.239,32.012 3.116,32.86 C1.224,33.619 0,35.438 0,37.494 L0,41 C0,41.553 0.447,42 1,42 L25,42 C25.553,42 26,41.553 26,41 L26,37.494 C26,35.438 24.776,33.619 22.883,32.86 Z"></path>
                                            <path class="color-background" d="M13,28 C17.432,28 21,22.529 21,18 C21,13.589 17.411,10 13,10 C8.589,10 5,13.589 5,18 C5,22.529 8.568,28 13,28 Z"></path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">{{__('main.sales_bill')}}</span>
                </a >

                <ul class="dropdown-menu text-small subM" aria-labelledby="dropdown">
                    <li><a @if($subSlag == 18) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('sales')}}">{{__('main.sales_bill')}}</a></li>
                    <li><a @if($subSlag == 19) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('add_sale')}}">{{__('main.add_sale')}}</a></li>
                    <li><a @if($subSlag == 34) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('pos')}}">{{__('main.pos')}}</a></li>


                </ul>

            </li>

            <li class="nav-item">
                <a @if($slag == 11) class="nav-link  active" @else class="nav-link" @endif  href="javascript:;" class="nav-link dropdown-toggle  text-truncate" id="dropdown" data-bs-toggle="dropdown" aria-expanded="false" @if(Config::get('app.locale') == 'ar') style="direction: rtl" @endif>
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg width="12px" height="12px" viewBox="0 0 46 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>customer-support</title>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g transform="translate(-1717.000000, -291.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                    <g transform="translate(1716.000000, 291.000000)">
                                        <g transform="translate(1.000000, 0.000000)">
                                            <path class="color-background opacity-6" d="M45,0 L26,0 C25.447,0 25,0.447 25,1 L25,20 C25,20.379 25.214,20.725 25.553,20.895 C25.694,20.965 25.848,21 26,21 C26.212,21 26.424,20.933 26.6,20.8 L34.333,15 L45,15 C45.553,15 46,14.553 46,14 L46,1 C46,0.447 45.553,0 45,0 Z"></path>
                                            <path class="color-background" d="M22.883,32.86 C20.761,32.012 17.324,31 13,31 C8.676,31 5.239,32.012 3.116,32.86 C1.224,33.619 0,35.438 0,37.494 L0,41 C0,41.553 0.447,42 1,42 L25,42 C25.553,42 26,41.553 26,41 L26,37.494 C26,35.438 24.776,33.619 22.883,32.86 Z"></path>
                                            <path class="color-background" d="M13,28 C17.432,28 21,22.529 21,18 C21,13.589 17.411,10 13,10 C8.589,10 5,13.589 5,18 C5,22.529 8.568,28 13,28 Z"></path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">{{__('main.accounting')}}</span>
                </a >

                <ul class="dropdown-menu text-small subM" aria-labelledby="dropdown">
                    <li><a @if($subSlag == 35) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('accounts_list')}}">{{__('main.accounts_list')}}</a></li>
                    <li><a @if($subSlag == 36) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('account_settings_list')}}">{{__('main.account_settings')}}</a></li>
                    <li><a @if($subSlag == 37) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('journals')}}">{{__('main.journals')}}</a></li>


                </ul>

            </li>



            <li class="nav-item">
                <a @if($slag == 9) class="nav-link  active" @else class="nav-link" @endif  href="javascript:;" class="nav-link dropdown-toggle  text-truncate" id="dropdown" data-bs-toggle="dropdown" aria-expanded="false" @if(Config::get('app.locale') == 'ar') style="direction: rtl" @endif>
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg width="12px" height="12px" viewBox="0 0 46 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>customer-support</title>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g transform="translate(-1717.000000, -291.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                    <g transform="translate(1716.000000, 291.000000)">
                                        <g transform="translate(1.000000, 0.000000)">
                                            <path class="color-background opacity-6" d="M45,0 L26,0 C25.447,0 25,0.447 25,1 L25,20 C25,20.379 25.214,20.725 25.553,20.895 C25.694,20.965 25.848,21 26,21 C26.212,21 26.424,20.933 26.6,20.8 L34.333,15 L45,15 C45.553,15 46,14.553 46,14 L46,1 C46,0.447 45.553,0 45,0 Z"></path>
                                            <path class="color-background" d="M22.883,32.86 C20.761,32.012 17.324,31 13,31 C8.676,31 5.239,32.012 3.116,32.86 C1.224,33.619 0,35.438 0,37.494 L0,41 C0,41.553 0.447,42 1,42 L25,42 C25.553,42 26,41.553 26,41 L26,37.494 C26,35.438 24.776,33.619 22.883,32.86 Z"></path>
                                            <path class="color-background" d="M13,28 C17.432,28 21,22.529 21,18 C21,13.589 17.411,10 13,10 C8.589,10 5,13.589 5,18 C5,22.529 8.568,28 13,28 Z"></path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">{{__('main.purchases')}}</span>
                </a >

                <ul class="dropdown-menu text-small subM" aria-labelledby="dropdown">
                    <li><a @if($subSlag == 23) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('purchases')}}">{{__('main.purchases')}}</a></li>
                    <li><a @if($subSlag == 24) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('add_purchase')}}">{{__('main.add_purchase')}}</a></li>

                </ul>

            </li>

            <li class="nav-item">
                <a @if($slag == 10) class="nav-link  active" @else class="nav-link" @endif  href="javascript:;" class="nav-link dropdown-toggle  text-truncate" id="dropdown" data-bs-toggle="dropdown" aria-expanded="false" @if(Config::get('app.locale') == 'ar') style="direction: rtl" @endif>
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg width="12px" height="12px" viewBox="0 0 46 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>customer-support</title>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g transform="translate(-1717.000000, -291.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                    <g transform="translate(1716.000000, 291.000000)">
                                        <g transform="translate(1.000000, 0.000000)">
                                            <path class="color-background opacity-6" d="M45,0 L26,0 C25.447,0 25,0.447 25,1 L25,20 C25,20.379 25.214,20.725 25.553,20.895 C25.694,20.965 25.848,21 26,21 C26.212,21 26.424,20.933 26.6,20.8 L34.333,15 L45,15 C45.553,15 46,14.553 46,14 L46,1 C46,0.447 45.553,0 45,0 Z"></path>
                                            <path class="color-background" d="M22.883,32.86 C20.761,32.012 17.324,31 13,31 C8.676,31 5.239,32.012 3.116,32.86 C1.224,33.619 0,35.438 0,37.494 L0,41 C0,41.553 0.447,42 1,42 L25,42 C25.553,42 26,41.553 26,41 L26,37.494 C26,35.438 24.776,33.619 22.883,32.86 Z"></path>
                                            <path class="color-background" d="M13,28 C17.432,28 21,22.529 21,18 C21,13.589 17.411,10 13,10 C8.589,10 5,13.589 5,18 C5,22.529 8.568,28 13,28 Z"></path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">{{__('main.reports')}}</span>
                </a >

                <ul class="dropdown-menu text-small subM" aria-labelledby="dropdown">
                    <li><a @if($subSlag == 25) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('daily_sales_report')}}">{{__('main.daily_sales_report')}}</a></li>
                    <li><a @if($subSlag == 26) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('sales_item_report')}}">{{__('main.sales_report_by_item')}}</a></li>
                    <li><a @if($subSlag == 27) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('purchase_report')}}">{{__('main.purchases_report')}}</a></li>
                    <li><a @if($subSlag == 32) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('purchases_return_report')}}">{{__('main.purchases_return_report')}}</a></li>
                    <li><a @if($subSlag == 33) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('items_report')}}">{{__('main.items_report')}}</a></li>
                    <li><a @if($subSlag == 28) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('items_limit_report')}}">{{__('main.under_limit_items_report')}}</a></li>
                    <li><a @if($subSlag == 29) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('items_no_balance_report')}}">{{__('main.no_balance_items_report')}}</a></li>
                    <li><a @if($subSlag == 30) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('items_stock_report')}}">{{__('main.users_transactions_report')}}</a></li>
                    <li><a @if($subSlag == 31) class="dropdown-item active-drop" @else class="dropdown-item" @endif href="{{route('items_purchased_report')}}">{{__('main.imported_items_reports')}}</a></li>


                </ul>

            </li>


        </ul>
    </div>


</aside>
