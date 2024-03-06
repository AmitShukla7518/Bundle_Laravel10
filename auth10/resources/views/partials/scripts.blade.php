<script src="{{ asset('/public/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script src="{{ asset('/public/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('/public/plugins/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('/public/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
<script src="{{ asset('/public/dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('/public/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('/public/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('/public/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('/public/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('/public/dist/js/adminlte.js') }}"></script>
<script src="{{ asset('/public/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('/public/plugins/jquery-validation/additional-methods.min.js') }}"></script>
<script src="{{ asset('/public/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('/public/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('/public/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ asset('/public/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/public/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/public/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('/public/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/public/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('/public/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/public/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('/public/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('/public/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('/public/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('/public/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('/public/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<!-- <script src="{{ asset('/public/plugins/jquery/jquery.min.js') }}"></script> -->
<script src="{{ asset('/public/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('/public/dist/js/adminlte.min.js') }}"></script>

<script>
  $(function() {
    $('.select2').select2()
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
    $('.select2bs4Edit').select2({
      theme: 'bootstrap4'
    })
    $('.select2bs4Create').select2({
      theme: 'bootstrap4'
    })
  });
</script>

<script>
  $(function() {
    $('#summernote').summernote()
  });
</script>


<script>
  $(function() {

    //Date and time picker
    $('#datetime1').datetimepicker({
      icons: {
        time: 'far fa-clock'
      },
      format: 'YYYY-MM-DD ',
    });
    $('#datetime2').datetimepicker({
      icons: {
        time: 'far fa-clock'
      },
      format: 'YYYY-MM-DD',
    });
    $('#datetime3').datetimepicker({
      icons: {
        time: 'far fa-clock'
      },
      format: 'YYYY-MM-DD',
    });
    $('#datetime4').datetimepicker({
      icons: {
        time: 'far fa-clock'
      },
      format: 'YYYY-MM-DD HH:mm',
    });
    $('#datetime5').datetimepicker({
      icons: {
        time: 'far fa-clock'
      },
      format: 'YYYY-MM-DD H:mm',
    });
    $('#datetime7').datetimepicker({
      icons: {
        time: 'far fa-clock'
      },
      format: 'YYYY-MM-DD H:mm',
    });


    $(function() {
      //Initialize Select2 Elements
      $('.select2').select2()

      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
      $('.select2bs4Edit').select2({
        theme: 'bootstrap4'
      })
      $('.select2bs4Create').select2({
        theme: 'bootstrap4'
      })
    });

  });
</script>

<script>
  $(document).ready(function() {
    toastr.options.timeOut = 10000;
    @if(Session::has('error'))
    toastr.error("{{ Session::get('error') }}");
    @elseif(Session::has('success'))
    toastr.success("{{ Session::get('success') }}");
    @elseif(Session::has('info'))
    toastr.info("{{ Session::get('info') }}");
    @endif
  });
</script>