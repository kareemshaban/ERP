<style>
    #toggle {
        background:transparent;
        border:none;
        width:30px;
        height:30px;
        cursor:pointer;
        outline:0;
    }

    .toggle span {
        width:100%;
        height:3px;
        background:#555;
        display:block;
        position:relative;
        coursor:pointer;
    }

    .toggle span:before,
    .toggle span:after {
        content:'';
        position:absolute;
        left:0;
        width:100%;
        height:100%;
        background:#555;
        transition: all 0.3s ease-out;
    }

    .toggle span:before {
        top:-8px;
    }

    .toggle span:after {
        top:8px;
    }

    .toggle span.toggle {
        background:transparent;
    }

    .toggle span.toggle:before {
        top:0;
        transform:rotate(-45deg);
        background:#0e748b;

    }

    .toggle span.toggle:after {
        top:0;
        transform:rotate(45deg);
        background:#0e748b;
    }
</style>

<nav  class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl no-print position-sticky blur shadow-blur mt-4 left-auto top-1 z-index-sticky no-print" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3" >
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </a>
                </li>
            </ol>

        </nav>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">{{$page_title}}</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <div class="input-group" hidden>
                    <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" placeholder="Type here...">
                </div>
            </div>
            <ul class="navbar-nav  justify-content-end">
                <li class="nav-item px-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0">
                        <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                    </a>
                </li>
                <li class="nav-item dropdown pe-2 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-globe cursor-pointer"></i>
                    </a>
                    <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                        <li class="mb-2">
                            <a class="dropdown-item border-radius-md" el="alternate" hreflang="ar" href="{{ LaravelLocalization::getLocalizedURL('ar', null, [], true) }}">
                                <div class="d-flex py-1">
                                    <div class="my-auto">
                                        <img src= "{{asset('assets/img/arabic.png')}}"  class="avatar avatar-sm  me-3 ">
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="text-sm font-weight-normal mb-1">
                                            <span class="font-weight-bold">Arabic | اللغة العربية</span>
                                        </h6>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="mb-2">
                            <a class="dropdown-item border-radius-md" el="alternate" hreflang="ثلا" href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}">
                                <div class="d-flex py-1">
                                    <div class="my-auto">
                                        <img src="{{asset('assets/img/english.png')}}"  class="avatar avatar-sm  me-3 ">
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="text-sm font-weight-normal mb-1">
                                            <span class="font-weight-bold">English | اللغة الإنجليزية</span>
                                        </h6>
                                    </div>
                                </div>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-item px-3 d-flex align-items-center">
                    <a href="{{route('index')}}" class="nav-link text-body p-0">
                        <i class="fa fa-home fixed-plugin-button-nav cursor-pointer"></i>
                    </a>
                </li>

                <li class="nav-item px-3 d-flex align-items-center">
                    <a href="{{route('logout')}}"  class="nav-link text-body p-0"
                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" data-toggle="tooltip" title="" data-original-title="Logout">
                        <i class="fa fa-power-off fixed-plugin-button-nav cursor-pointer"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>

<script type="text/javascript">
    var btn = document.querySelector('.toggle');
    var btnst = true;
    btn.onclick = function() {
        if(btnst == true) {
            document.querySelector('.toggle span').classList.add('toggle');
            document.getElementById('sidenav-main').classList.add('sidebarshow');
            btnst = false;
        }else if(btnst == false) {
            document.querySelector('.toggle span').classList.remove('toggle');
            document.getElementById('sidenav-main').classList.remove('sidebarshow');
            btnst = true;
        }
    }
</script>
