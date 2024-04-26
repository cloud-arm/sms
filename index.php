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
    $_SESSION['SESS_FORM'] = 'index';
    if ($r == 'tech') {
        header("location: app/");
    }
    if ($r == 'admin') {
        include_once("sidebar.php");
    }
    //header("location: 404.php");

    ?>

    </aside>

    <!-- Content Wrapper. Contains page content -->

    <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

            <h1>
                Home
                <small>Preview</small>
            </h1>


        </section>
        <!-- Main content -->
        <section class="content">
            <?php
            include('connect.php');
            date_default_timezone_set("Asia/Colombo");
            $cash = $_SESSION['SESS_FIRST_NAME']; ?>


            <div class="row">

                <div class="col-md-12">
                    <div class="box box-info">

                        <div class="box-body">
                            <table id="example" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width="10px">ID</th>
                                        <th>Number</th>
                                        <th>Action</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $qr = '';

                                    $result = $db->prepare("SELECT * FROM sms  ");
                                    $result->bindParam(':userid', $date);
                                    $result->execute();
                                    for ($i = 0; $row = $result->fetch(); $i++) {

                                    ?>
                                        <tr>
                                            <td><?php echo $row['id']  ?></td>
                                            <td><?php echo $row['number']  ?></td>
                                            <td><?php echo $row['action']  ?></td>
                                            <td></td>
                                        </tr>

                                    <?php } ?>


                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>

            </div>
        </section>

    </div>

    <!-- /.content-wrapper -->

    <?php

    include("dounbr.php");

    ?>


    <div class="control-sidebar-bg"></div>
    </div>

    <!-- jQuery 2.2.3 -->
    <script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="../../plugins/morris/morris.min.js"></script>
    <!-- FastClick -->
    <script src="../../plugins/fastclick/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
    <!-- page script -->

    <!-- DataTables -->
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="../../plugins/chartjs/Chart.min.js"></script>

    <!-- Dark Theme Btn-->
    <!-- <script src="https://dev.colorbiz.org/ashen/cdn/main/dist/js/dark_theme_btn.js"></script> -->


    <!-- page script -->

    <script>
        $(function() {
            $("#example").DataTable();

            $("#example1").DataTable({
                "lengthMenu": [100, 50, 25, 10],
                scrollY: 800,
            });
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });

            var a;
            var answer = document.getElementById("result");

            if (navigator.userAgent.match(/Android/i) ||
                navigator.userAgent.match(/webOS/i) ||
                navigator.userAgent.match(/iPhone/i) ||
                navigator.userAgent.match(/iPad/i) ||
                navigator.userAgent.match(/iPod/i) ||
                navigator.userAgent.match(/BlackBerry/i) ||
                navigator.userAgent.match(/Windows Phone/i)) {
                window.location.href = 'app/';
            }


        });
    </script>

</body>

</html>