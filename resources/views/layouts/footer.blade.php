<footer class="footer pt-3  ">
    <div class="container-fluid">
        <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
                <div class="copyright text-center text-sm text-muted text-lg-start">
                    © <script>
                        document.write(new Date().getFullYear())
                    </script>,
                    made with <i class="fa fa-heart"></i> by
                    <a href="#" class="font-weight-bold" >Dev Team</a>
                    for a better web.
                </div>
            </div>
            <div class="col-lg-6">
                <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                    <li class="nav-item">
                        <a href="#" class="nav-link text-muted" >Dev Team</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link text-muted" >About Us</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link pe-0 text-muted" >License</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="show_modal_init">

        </div>
    </div>

    <script>

        function showSubscribeData() {
            var route = '{{route('subscribe_data')}}';

            $.get( route, function( data ) {
                $( ".show_modal_init" ).html( data );
                $('#paymentsModal').modal('show');
            });
        }

        function showInitModal() {
            var route = '{{route('init')}}';

            $.get( route, function( data ) {
                $( ".show_modal_init" ).html( data );
                $('#paymentsModal').modal('show');
            });
        }
    </script>
</footer>
