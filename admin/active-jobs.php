<?php

session_start();

if (empty($_SESSION['id_admin'])) {
    header("Location: index.php");
    exit();
}

require_once("../db.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Architecture Job</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../css/AdminLTE.min.css">
    <link rel="stylesheet" href="../css/_all-skins.min.css">
    <!-- Custom -->
    <link rel="stylesheet" href="../css/custom.css">

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">

    <header class="main-header">

        <!-- Logo -->
        <a href="index.php" class="logo logo-bg">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>A</b>P</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Architecture Job Portal</b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                </ul>
            </div>
        </nav>
    </header>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="margin-left: 0px;">

        <section id="candidates" class="content-header">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="box box-solid">
                            <div class="box-header with-border">
                                <h3 class="box-title">Welcome <b>Admin</b></h3>
                            </div>
                            <div class="box-body no-padding">
                                <ul class="nav nav-pills nav-stacked">
                                    <li><a href="dashboard.php"><i class="fa fa-dashboard"></i><b> Dashboard</b></a></li>
                                    <li class="active"><a href="active-jobs.php"><i class="fa fa-briefcase"></i><b> Active
                                            Jobs</b></a></li>
                                    <li><a href="applications.php"><i class="fa fa-address-card-o"></i><b> Applications</b></a>
                                    </li>
                                    <li><a href="companies.php"><i class="fa fa-building"></i><b> Companies</b></a></li>
                                    <li><a href="../logout.php"><i class="fa fa-arrow-circle-o-right"></i><b> Logout</b></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 b  g-white padding-2">
                        <center><h3><b>Active Job Posts</b></h3></center>
                        <div class="row margin-top-20">
                            <div class="col-md-12">
                                <div class="box-body table-responsive no-padding">
                                    <table id="example2" class="table table-hover">
                                        <thead style="background:#ABEBC6">
                                        <th>Job Name</th>
                                        <th>Company Name</th>
                                        <th>Date Created</th>
                                        <th>View</th>
                                        <th>Delete</th>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $sql = "SELECT job_post.*, company.companyname FROM job_post INNER JOIN company ON job_post.id_company=company.id_company";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                            $i = 0;
                                            while ($row = $result->fetch_assoc()) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $row['jobtitle']; ?></td>
                                                    <td><?php echo $row['companyname']; ?></td>
                                                    <td><?php echo date("d-M-Y", strtotime($row['createdat'])); ?></td>
                                                    <td>
                                                        <a href="view-job-post.php?id=<?php echo $row['id_jobpost']; ?>"><i
                                                                    class="fa fa-address-card-o"></i></a></td>
                                                    <td>
                                                        <a href="delete-job-post.php?id=<?php echo $row['id_jobpost']; ?>"><i
                                                                    class="fa fa-trash"></i></a></td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


</div>
<!-- /.content-wrapper -->

<footer class="main-footer" style="margin-left: 0px;">
    <div class="text-center">
        <strong>Copyright &copy; 2020 Saila Nasrin,</strong> All rights
        reserved.
    </div>
</footer>

<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<!-- AdminLTE App -->
<script src="../js/adminlte.min.js"></script>

<script>
    $(function () {
        $('#example2').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': false
        });
    });
</script>
</body>
</html>
