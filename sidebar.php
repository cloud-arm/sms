<div class="wrapper">
  <header class="main-header">
    <!-- Logo -->
    <a href="index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>arm</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><i class="fa fa-cloud"></i><b>CLOUD ARM</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <?php
      include('connect.php');
      date_default_timezone_set("Asia/Colombo");

      $date =  date("Y-m-d");
      $dep = $_SESSION['SESS_DEPARTMENT'];
      $f = $_SESSION['SESS_FORM'];
      ?>
      <div class="navbar-menu">
        <ul class="nav navbar-nav">
          <!-- <li class="<?php if ($dep == 'logistic') {
                            echo 'open';
                          } ?>">
            <a href="index.php">Logistic</a>
          </li> -->

        </ul>
      </div>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <?php
          $uname = $_SESSION['SESS_MEMBER_ID'];
          $result1 = $db->prepare("SELECT * FROM user WHERE id='$uname' ");
          $result1->bindParam(':userid', $res);
          $result1->execute();
          for ($i = 0; $row1 = $result1->fetch(); $i++) {
            $upic = $row1['user_img'];
          }

          ?>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="../../dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $_SESSION['SESS_FIRST_NAME']; ?></span>
            </a>
            <ul class="dropdown-menu user">
              <!-- User image -->
              <li class="user-header">
                <div>
                  <span class="badge"><i class="glyphicon glyphicon-user"></i><?php echo $_SESSION['SESS_LAST_NAME']; ?></span>
                </div>
                <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <p> <?php echo $_SESSION['SESS_FIRST_NAME']; ?></p>
                <small>Member since Nov. 2023</small>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a href=" ../../../index.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>

      <div class="navbar-search">
        <!-- search form -->

      </div>
    </nav>
  </header>



  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>


        <!-- -------------------- Logistic Section ----------------------- -->
        <?php //if ($dep == 'logistic') { 
        ?>

        <li class="<?php if ($f == 'index') {
                      echo 'active';
                    } ?>">
          <a href="index.php">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>

        <li class="<?php if ($f == 'message_add') {
                      echo 'active';
                    } ?>">
          <a href="message_add.php">
            <i class="fa fa-envelope"></i> <span>New Message</span>
          </a>
        </li>

        <li class="<?php if ($f == 'message') {
                      echo 'active';
                    } ?>">
          <a href="#message_manager.php">
            <i class="fa fa-database"></i> <span>Message Manager</span>
            <span class="pull-right-container">
              <i class="fa fa-spinner fa-spin pull-right"></i>
            </span>
          </a>
        </li>

        <?php //} 
        ?>




        <!-- -------------------- HR Section ----------------------- -->

        <?php if ($dep == 'hr') { ?>

          <li>
            <a href="hr_index.php">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
          </li>

          <li class="treeview">
            <a href="#">
              <i class="fa fa-line-chart"></i>
              <span>Report</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="sales_rp.php?d1=<?php echo date("Y-m-d"); ?>&d2=<?php echo date("Y-m-d"); ?>&cus=all"><i class="fa fa-circle-o text-aqua "></i> Sales Report</a></li>

            </ul>
          </li>


        <?php } ?>





        <?php if ($dep == 'accounting') { ?>

          <li>
            <a href="acc_index.php">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
          </li>

          <li class="treeview">
            <a href="#">
              <i class="fa fa-suitcase"></i>
              <span>Expenses</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="expenses.php"><i class="fa fa-circle-o text-aqua "></i>Expenses</a></li>
              <li><a href="petty.php"><i class="fa fa-circle-o text-red "></i>Cash BOX</a></li>
            </ul>
          </li>

          <?php $co = '';
          $co0 = '';
          $dis = 'none';
          if ($f == 'acc_transfer' || $f == 'acc_bank_transfer' || $f == 'acc_bank_loan' || $f == 'acc_chq_realizing' || $f == 'acc_regeneration' || $f == 'acc_bank_regeneration') {
            $co = 'active';
            $co0 = 'menu-open';
            $dis = 'block';
          } ?>

          <li class="treeview <?php echo $co; ?>">
            <a href="#"><i class="fa fa-pie-chart"></i><span>Accounting</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu  <?php echo $co0; ?>" style="display:  <?php echo $dis; ?>;">
              <li class="<?php if ($f == 'acc_transfer') {
                            echo 'active';
                          } ?>"><a href="acc_transfer.php"><i class="fa fa-circle-o text-aqua"></i> Account Transfer</a></li>
              <li class="<?php if ($f == 'acc_bank_transfer') {
                            echo 'active';
                          } ?>"><a href="acc_bank_transfer.php"><i class="fa fa-circle-o text-aqua"></i> Bank Transfer</a>
              </li>
              <li class="<?php if ($f == 'acc_bank_loan') {
                            echo 'active';
                          } ?>"><a href="acc_bank_loan.php"><i class="fa fa-circle-o text-aqua"></i> Bank Loan</a>
              </li>
              <li class="<?php if ($f == 'acc_chq_realizing') {
                            echo 'active';
                          } ?>"><a href="acc_chq_realizing.php"><i class="fa fa-circle-o text-aqua"></i> Chq Realizing</a>
              </li>

              <?php $co = '';
              if ($f == 'acc_regeneration' || $f == 'acc_bank_regeneration') {
                $co = 'active';
              } ?>
              <li class="treeview <?php echo $co; ?>">
                <a href="#">
                  <i class="fa fa-line-chart"></i>
                  <span>Report</span>
                  <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                  <li class="<?php if ($f == 'acc_regeneration') {
                                echo 'active';
                              } ?>"><a href="acc_regeneration.php?dates=<?php echo date("Y") . '/' . date("m") . '/' . date("d"); ?>-<?php echo date("Y") . '/' . date("m") . '/' . date("d"); ?>&account=1"><i class="fa fa-circle-o text-red"></i> Transfer Recode</a></li>
                  <li class="<?php if ($f == 'acc_bank_regeneration') {
                                echo 'active';
                              } ?>"><a href="acc_bank_regeneration.php?dates=<?php echo date("Y") . '/' . date("m") . '/' . date("d"); ?>-<?php echo date("Y") . '/' . date("m") . '/' . date("d"); ?>&bank=1"><i class="fa fa-circle-o text-red"></i> Bank Reconciliation</a></li>
                </ul>
              </li>
            </ul>
          </li>

          <li class="treeview">
            <a href="#">
              <i class="fa fa-line-chart"></i>
              <span>Report</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="sales_rp.php?d1=<?php echo date("Y-m-d"); ?>&d2=<?php echo date("Y-m-d"); ?>&cus=all"><i class="fa fa-circle-o text-aqua "></i> Sales Report</a></li>

            </ul>
          </li>

        <?php } ?>





        <?php if ($dep == 'management') { ?>
          <li>
            <a href="manage_index.php">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
          </li>

          <li class="treeview">
            <a href="#">
              <i class="fa fa-suitcase"></i>
              <span>Expenses</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="expenses.php"><i class="fa fa-circle-o text-aqua "></i>Expenses</a></li>
              <li><a href="petty.php"><i class="fa fa-circle-o text-red "></i>Cash BOX</a></li>
            </ul>
          </li>


          <?php $co = '';
          $co0 = '';
          $dis = 'none';
          if ($f == 'grn' || $f == 'grn_supply' || $f == 'grn_payment' || $f == 'grn_return' || $f == 'grn_order' || $f == 'grn_rp' || $f == 'grn_payment_rp' || $f == 'grn_return_rp' || $f == 'grn_order_rp') {
            $co = 'active';
            $co0 = 'menu-open';
            $dis = 'block';
          } ?>

          <li class="treeview <?php echo $co; ?>">
            <a href="#"><i class="fa fa-cubes"></i><span>Purchases</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu  <?php echo $co0; ?>" style="display:  <?php echo $dis; ?>;">
              <li class="<?php if ($f == 'grn') {
                            echo 'active';
                          } ?>"><a href="grn.php?id=<?php echo date("ymdhis"); ?>"><i class="fa fa-circle-o text-aqua"></i> GRN</a></li>
              <li class="<?php if ($f == 'grn_supply') {
                            echo 'active';
                          } ?>"><a href="grn_supply.php?id=0"><i class="fa fa-circle-o text-aqua"></i> Suppliers</a></li>
              <li class="<?php if ($f == 'grn_payment') {
                            echo 'active';
                          } ?>"><a href="grn_payment.php"><i class="fa fa-circle-o text-aqua"></i> Payment</a></li>
              <li class="<?php if ($f == 'grn_return') {
                            echo 'active';
                          } ?>"><a href="grn_return.php?id=<?php echo date("ymdhis"); ?>"><i class="fa fa-circle-o text-aqua"></i> GRN Return</a></li>
              <li class="<?php if ($f == 'grn_order') {
                            echo 'active';
                          } ?>"><a href="grn_order.php?id=<?php echo date("ymdhis"); ?>"><i class="fa fa-circle-o text-aqua"></i> Purchase Order</a></li>

              <?php $co = '';
              if ($f == 'grn_rp' || $f == 'grn_payment_rp' || $f == 'grn_return_rp' || $f == 'grn_order_rp') {
                $co = 'active';
              } ?>
              <li class="treeview <?php echo $co; ?>">
                <a href="#">
                  <i class="fa fa-line-chart"></i>
                  <span>Report</span>
                  <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                  <li class="<?php if ($f == 'grn_rp') {
                                echo 'active';
                              } ?>"><a href="grn_rp.php?year=<?php echo date("Y"); ?>&month=<?php echo date("m"); ?>"><i class="fa fa-circle-o text-red"></i> GRN Record</a></li>
                  <li class="<?php if ($f == 'grn_payment_rp') {
                                echo 'active';
                              } ?>"><a href="grn_payment_rp.php?dates=<?php echo date("Y") . '/' . date("m") . '/' . date("d"); ?>-<?php echo date("Y") . '/' . date("m") . '/' . date("d"); ?>"><i class="fa fa-circle-o text-red"></i> Payment Record</a></li>
                  <li class="<?php if ($f == 'grn_return_rp') {
                                echo 'active';
                              } ?>"><a href="grn_return_rp.php?year=<?php echo date("Y"); ?>&month=<?php echo date("m"); ?>"><i class="fa fa-circle-o text-red"></i> Return Record</a></li>
                  <li class="<?php if ($f == 'grn_order_rp') {
                                echo 'active';
                              } ?>"><a href="grn_order_rp.php?year=<?php echo date("Y"); ?>&month=<?php echo date("m"); ?>"><i class="fa fa-circle-o text-red"></i> Order Record</a></li>
                </ul>
              </li>
            </ul>
          </li>

          <li class="treeview">
            <a href="#">
              <i class="fa fa-bank"></i>
              <span>Bank</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="deposit.php"><i class="fa fa-circle-o text-aqua "></i>Deposit</a></li>
              <li><a href="withdraw.php"><i class="fa fa-circle-o text-red "></i>Withdraw </a></li>
              <li><a href="chq_return.php"><i class="fa fa-circle-o text-red "></i>CHQ Return </a></li>
              <li><a href="chq_action.php"><i class="fa fa-circle-o text-red "></i>CHQ Realiz </a></li>
            </ul>
          </li>

          <?php $co = '';
          $co0 = '';
          $dis = 'none';
          if ($f == 'customer' || $f == 'product' || $f == 'rep' || $f == 'lorry' || $f == 'root') {
            $co = 'active';
            $co0 = 'menu-open';
            $dis = 'block';
          } ?>

          <li class="treeview <?php echo $co; ?>">
            <a href="#">
              <i class="fa fa-group"></i>
              <span>Profile</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>

            <ul class="treeview-menu  <?php echo $co0; ?>" style="display:  <?php echo $dis; ?>;">
              <li><a href="customer.php"><i class="fa fa-circle-o text-aqua "></i> Customer</a></li>
              <li><a href="product.php"><i class="fa fa-circle-o text-aqua "></i> Product</a></li>
              <li><a href="rep.php"><i class="fa fa-circle-o text-aqua "></i> Rep</a></li>
              <li><a href="lorry.php"><i class="fa fa-circle-o text-aqua "></i>Lorry </a></li>
              <li class="<?php if ($f == 'root') {
                            echo 'active';
                          } ?>"><a href="root.php"><i class="fa fa-circle-o text-aqua "></i>Root</a></li>
              </a>
            </ul>
          </li>

          <li class="treeview">
            <a href="#">
              <i class="fa fa-line-chart"></i>
              <span>Report</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="sales_rp.php?d1=<?php echo date("Y-m-d"); ?>&d2=<?php echo date("Y-m-d"); ?>&cus=all"><i class="fa fa-circle-o text-aqua "></i> Sales Report</a></li>

            </ul>
          </li>

        <?php } ?>

      </ul>
    </section>