<!-- JavaScript -->
<script src="{{ asset('') }}assets/js/bundle.js?ver=2.9.1"></script>
<script src="{{ asset('') }}assets/js/scripts.js?ver=2.9.1"></script>
<script src="{{ asset('') }}assets/js/charts/gd-invest.js?ver=2.9.1"></script>
<script src="{{ asset('') }}assets/js/libs/datatable-btns.js?ver=2.9.1"></script>
<script src="{{ asset('js/select2.js') }}"></script>
{{-- <script src="{{ asset('assets/datepicker/dist/datepicker.js') }}"></script> --}}
<script src="{{ asset('assets/js/libs/hideShowPassword.js') }}"></script>
<script src="{{ asset('assets/js/jquery-ui.js') }}"></script>
<script src="{{ asset('js/moment.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.datepicker').datepicker({
            dateFormat: 'd M yy',
            changeMonth: true,
            changeYear: true
        });

        $('.alert-info').fadeTo(2000, 500).slideUp(500, function() {
            $('.alert-info').slideUp(500);
        })
        $('.alert-success').fadeTo(2000, 500).slideUp(500, function() {
            $('.alert-success').slideUp(500);
        })

        $('.alert-danger').fadeTo(2000, 500).slideUp(500, function() {
            $('.alert-danger').slideUp(500);
        })

        $('.kode-upper').keyup(function() {
            $('.kode-upper').val(function(i, val) {
                return val.toUpperCase();
            });
        });
    })
</script>
{{-- <script src="{{ asset('assets/js/jquery-ui.js') }}"></script> --}}
