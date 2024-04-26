<!DOCTYPE html>
<html>
<?php
include("head.php");
include("connect.php");
?>

<body class="hold-transition skin-blue sidebar-mini">
    <?php
    include_once("auth.php");
    $r = $_SESSION['SESS_LAST_NAME'];
    $_SESSION['SESS_DEPARTMENT'] = 'logistic';
    $_SESSION['SESS_FORM'] = 'sms_add';

    if ($r == 'admin') {

        include_once("sidebar.php");
    }
    ?>

    <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Add New Message
                <small>Preview</small>
            </h1>
        </section>

        <section class="content">

            <?php if (isset($_POST['id'])) {

                $id = $_POST['id'];
                $result = $db->prepare("SELECT * FROM sms WHERE  id =:id  ");
                $result->bindParam(':id', $id);
                $result->execute();
                for ($i = 0; $row = $result->fetch(); $i++) {
                    $number = $row['number'];
                    $message = $row['message'];
                }
            ?>

                <div class="row">

                    <div class="col-md-10">
                        <div class="box box-info">
                            <div class="box-header">
                                <h3 class="box-title">Message </h3>
                            </div>

                            <div class="box-body">
                                <form method="POST" action="sms_save.php">

                                    <div class="row">

                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <label> message <i class="text-red">*</i></label>
                                                <textarea class="form-control" name="message" rows="5" style="resize: vertical;"><?php echo $message; ?></textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Number<i class="text-red">*</i></label>
                                                <input class="form-control" value="<?php echo $number; ?>" name="number" type="number">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                                <input type="submit" name="" class="btn btn-success" style="margin-top: 25px;width: 100%;" value="Update">
                                            </div>
                                        </div>

                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } else { ?>
                <div class="row">

                    <div class="col-md-10">
                        <div class="box box-info">
                            <div class="box-header">
                                <h3 class="box-title">Message </h3>
                            </div>
                            <!-- /.box-header -->

                            <div class="box-body">
                                <form method="POST" action="sms_save.php">

                                    <div class="row">

                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <label>Message <i class="text-red">*</i></label>
                                                <textarea class="form-control" name="message" rows="5" style="resize: vertical;"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Number <i class="text-red">*</i></label>
                                                <input class="form-control" value="" name="number" type="number">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="hidden" name="id" value="0">
                                                <input type="submit" name="" class="btn btn-danger" style="margin-top: 25px; width: 100%;" value="Save">
                                            </div>
                                        </div>

                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } ?>

            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Latest Message </h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>

                <div class="box-body">
                    <table id="example" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Message</th>
                                <th>Number</th>
                                <th>#</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            date_default_timezone_set("Asia/Colombo");
                            include("connect.php");
                            $date = date('Y-m-d');
                            $result = $db->prepare("SELECT * FROM sms WHERE date='$date'  ORDER by id DESC  ");
                            $result->bindParam(':userid', $date);
                            $result->execute();
                            for ($i = 0; $row = $result->fetch(); $i++) {
                            ?>
                                <tr class="record">
                                    <td><?php echo $i + 1; ?></td>
                                    <td> <?php echo $row['message']; ?></td>
                                    <td><?php echo $row['number']; ?></td>
                                    <td>
                                        <div style="display: flex;gap: 5px; margin-bottom:5px;">
                                            <a href="#" onclick="update_job(<?php echo $row['id']; ?>)" class="btn btn-success btn-sm">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <?php if ($_SESSION['SESS_MEMBER_ID'] == 1) { ?>
                                                <a href="#" id="<?php echo $row['id']; ?>" class="btn btn-danger btn-dll btn-sm">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            <?php } ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            } ?>
                        </tbody>

                    </table>
                </div>
                <form action="sms_add.php" method="POST" id="form">
                    <input type="hidden" name="id" id="job">
                </form>

            </div>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php
    include("dounbr.php");
    ?>
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->
    <!-- jQuery 2.2.3 -->
    <script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <!-- Select2 -->
    <script src="../../plugins/select2/select2.full.min.js"></script>
    <!-- DataTables -->
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- date-range-picker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="../../plugins/daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap datepicker -->
    <script src="../../plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- iCheck 1.0.1 -->
    <script src="../../plugins/iCheck/icheck.min.js"></script>
    <!-- FastClick -->
    <script src="../../plugins/fastclick/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
    <!-- Dark Theme Btn-->
    <!-- <script src="https://dev.colorbiz.org/ashen/cdn/main/dist/js/dark_theme_btn.js"></script> -->

    <script>
        $(function() {
            $("#example0").DataTable({
                "lengthMenu": [100, 50, 25, 10],
                scrollY: 800,
            });
            $("#example").DataTable();
            $('#example2').DataTable({
                "paging": false,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": false,
                "autoWidth": false
            });
        });
    </script>

    <script>
        function update_job(id) {
            $('#job').val(id);
            $('#form').submit();
        }

        $(function() {

            $(".btn-dll").click(function() {

                var info = 'id=' + $(this).attr("id");
                if (confirm("Sure you want to delete this Collection? There is NO undo!")) {

                    $.ajax({
                        type: "GET",
                        url: "sms_dll.php",
                        data: info,
                        success: function() {}
                    });
                    $(this).parents(".record").animate({
                            backgroundColor: "#fbc7c7"
                        }, "fast")
                        .animate({
                            opacity: "hide"
                        }, "slow");

                }

                return false;

            });

            //Initialize Select2 Elements
            $(".select2").select2();

            $('select.hidden-search').select2({
                minimumResultsForSearch: -1
            });

            //Date range picker
            $('#reservation').daterangepicker();

            //Date range picker with time picker
            $('#reservationtime').daterangepicker({
                timePicker: true,
                timePickerIncrement: 30,
                format: 'YYYY/MM/DD h:mm A'
            });
            //Date range as a button
            $('#daterange-btn').daterangepicker({
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    },
                    startDate: moment().subtract(29, 'days'),
                    endDate: moment()
                },
                function(start, end) {
                    $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                }
            );

            //Date picker
            $('#datepicker').datepicker({
                autoclose: true
            });

            //Flat red color scheme for iCheck
            $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });


        });
    </script>
</body>

</html>