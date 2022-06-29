<!--   Core JS Files   -->
  <script src="$ThemeDir/assets/js/core/jquery.3.2.1.min.js"></script>
  <script src="$ThemeDir/assets/js/core/popper.min.js"></script>
  <script src="$ThemeDir/assets/js/core/bootstrap.min.js"></script>
  <script src="$ThemeDir/assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="$ThemeDir/assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="$ThemeDir/assets/js/plugins/chartjs.min.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="$ThemeDir/assets/js/argon-dashboard.min.js?v=2.0.2"></script>

  <!-- Sweet Alert -->
<script src="$ThemeDir/assets/js/plugins/sweetalert/sweetalert.min.js"></script>
<!-- jQuery -->
<script src="$ThemeDir/assets/plugins/jquery/jquery.min.js"></script>

<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()
        // Summernote
        $('.summernote').summernote()
    })
    //== Class definition
    var SweetAlert2Demo = function() {
        //== Demos
        var initDemos = function() {
            $('.btn-delete').click(function(e) {
                    id = e.target.dataset.id;
                    swal({
                        title: 'Apakah anda yakin ?',
                        text: "Hapus data secara permanen !",
                        type: 'warning',
                        buttons: {
                            confirm: {
                                text: 'Hapus',
                                className: 'btn bg-gradient-primary'
                            },
                            cancel: {
                                visible: true,
                                text: 'Batal',
                                className: 'btn btn-outline-danger'
                            }
                        }
                    }).then((Delete) => {
                        if (Delete) {
                            $(`#delete${id}`).submit();
                        } else {
                            swal.close();
                        }
                    });
                });
            $('.btn-save').click(function(e) {
                id = e.target.dataset.id;
                swal({
                    title: 'Apakah anda yakin ?',
                    text: "Simpan perubahan data !",
                    type: 'warning',
                    buttons: {
                        confirm: {
                            text: 'Simpan',
                            className: 'btn bg-gradient-primary'
                        },
                        cancel: {
                            visible: true,
                            text: 'Batal',
                            className: 'btn btn-outline-danger'
                        }
                    }
                }).then((Delete) => {
                    if (Delete) {
                        $('.form-edit').submit();
                    } else {
                        swal.close();
                    }
                });
            });
        };
        return {
            //== Init
            init: function() {
                initDemos();
            },
        };
    }();
    //== Class Initialization
    jQuery(document).ready(function() {
        SweetAlert2Demo.init();
    });
</script>