<!--   Core JS Files   -->
  <script src="$ThemeDir/assets/js/core/jquery.3.2.1.min.js"></script>
  <script src="$ThemeDir/assets/js/core/popper.min.js"></script>
  <script src="$ThemeDir/assets/js/core/bootstrap.min.js"></script>
  <script src="$ThemeDir/assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="$ThemeDir/assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="$ThemeDir/assets/js/plugins/chartjs.min.js"></script>
  <script src="$ThemeDir/assets/js/argon-dashboard.min.js?v=2.0.2"></script>

<!-- Sweet Alert -->
<script src="$ThemeDir/assets/js/plugins/sweetalert/sweetalert.min.js"></script>
<!-- jQuery -->
<script src="$ThemeDir/assets/js/plugins/jquery/jquery.min.js"></script>
<script src="$ThemeDir/assets/js/jquery.mask.min.js"></script>

<!-- DataTables -->
<script src="$ThemeDir/assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="$ThemeDir/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>


<%-- Separator Rupiah --%>
<script type="text/javascript">
    $(document).ready(function(){
        // Format mata uang.
        $( '.uang' ).mask('000.000.000.000.000', {reverse: true});
    })
</script>
<script>
    <%-- Enable Disable Form Input Ketika Warna Product Dipilih --%>
    $( ".checkbox-harga" ).on( "click", function(e) {
        id = e.target.dataset.id;
        
        if($(this).is(':checked')){
            document.getElementById(`HargaProduct${id}`).disabled = false;
            document.getElementById(`JumlahProduct${id}`).disabled = false;
        } else {
            document.getElementById(`HargaProduct${id}`).disabled = true;
            document.getElementById(`HargaProduct${id}`).value = '';
            document.getElementById(`JumlahProduct${id}`).disabled = true;
            document.getElementById(`JumlahProduct${id}`).value = '';
        }
    });

    <%-- Sweet Alert --%>
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

    <%-- Timmer Notifikasi --%>
    window.setTimeout(function() {
        $(".alert-message").fadeTo(200, 0).slideUp(200, function(){
            $(this).remove(); 
        });
    }, 2000); 
    
</script>
