<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>
        ERP System Dashboard
    </title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">


    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.0.7" rel="stylesheet" />
</head>

<body @if(Config::get('app.locale') == 'en') class="g-sidenav-show  bg-gray-100" @else  class="g-sidenav-show rtl bg-gray-100" @endif>
@include('layouts.side' , ['slag' => 11 , 'subSlag' => 35])


<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
@include('flash-message')
<!-- Navbar -->
@include('layouts.nav' , ['page_title' => __('main.advance_payments') ])
<!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="col-6 text-start">
                                <h6>{{ __('main.advance_payments')}}</h6>
                            </div>
                            <div class="col-6 text-end">
                                <a type="button" class="btn btn-labeled btn-primary" href="{{route('advance_payments.create')}}">
                                    <span class="btn-label" style="margin-right: 10px;"><i class="fa fa-plus"></i></span>{{__('main.add_new')}}
                                </a>
                            </div>
                        </div>

                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table  id="table" class="table align-items-center mb-0 border">
                                <thead>
                                <tr>
                                    <th width="20%">{{__('main.Date')}}</th>
                                    <th width="10%">{{__('main.Employer')}}</th>
                                    <th class="sum" width="20%">{{__('main.Amount')}}</th>
                                    <th class="sum" width="20%">{{__('main.Remain')}}</th>
                                    <th width="15%">{{__('main.Actions')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($payments as $category)

                                    <tr>
                                        <td>{!! $category->date !!}</td>
                                        <td>{!! $category->Employer->name !!}</td>
                                        <td>{!! $category->amount !!}</td>
                                        <td>{!! $category->remain !!}</td>
                                        <td>

                                        <td>

                                            <div class="btn-group btn-group-sm" style="float: none;">
                                                <button type="button" class="btn btn-labeled btn-secondary"
                                                        onclick="location.href='{{route('advance_payments.edit',$category->id)}}'"
                                                        style="float: none; margin: 5px;"><span class="btn-label" style="margin-right: 10px;"><i class="fa fa-pen"></i></span>{{__('main.edit')}}</button>


                                                    <button type="button" class="btn btn-labeled btn-danger deleteBtn "
                                                            onclick="remove('{{$category->id}}')"
                                                            style="float: none; margin: 5px;"><span class="btn-label" style="margin-right: 10px;"><i class="fa fa-trash"></i></span>{{__('main.delete')}}</button>

                                            </div>

                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footer')
    </div>
</main>
@include('layouts.fixed')
<!--   Core JS Files   -->

<script type="text/javascript">
    $(document).ready(function() {
        $('#table').DataTable();
    });

    let id = 0 ;
    $(document).ready(function()
    {
        id = 0 ;

        $(document).on('click', '.deleteBtn', function(event) {
            id = event.currentTarget.id ;
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
                url: href,
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#deleteModal').modal("show");
                },
                complete: function() {
                    $('#loader').hide();
                },
                error: function(jqXHR, testStatus, error) {
                    console.log(error);
                    alert("Page " + href + " cannot open. Error:" + error);
                    $('#loader').hide();
                },
                timeout: 8000
            })
        });

        $(document).on('click' , '.cancel-modal' , function (event) {
            $('#deleteModal').modal("hide");
            id = 0 ;
        });


    });
    function confirmDelete(){
        let url = "{{ route('delete_account', ':id') }}";
        url = url.replace(':id', id);
        document.location.href=url;
    }
    function remove(id){
        swal({
            title: '{{__('main.Are you sure?')}}',
            text: '{{__('main.You won\'t be able to revert this!')}}',
            type: 'warning',
            showCancelButton: true,
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger m-l-10',
            confirmButtonText: 'Yes, delete it!'
        }).then(function () {
            var url = '{{route('deduction.destroy',':id')}}';
            url = url.replace(':id',id);

            $.ajax({
                type : "GET",
                url: url,
                success: function () {
                    swal(
                        '{{__('main.Deleted?')}}',
                        '{{__('main.Your data has been deleted.')}}',
                        'success'
                    );

                    location.reload();
                },
                error: function (data) {
                    console.log(data);
                }
            });

        });
    }
</script>


<script src="../assets/js/core/popper.min.js"></script>
<script src="../assets/js/core/bootstrap.min.js"></script>
<script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.7"></script>
</body>

</html>
