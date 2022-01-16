<?php
session_start();

require_once("db.php");
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
    <!-- Theme style -->
    <link rel="stylesheet" href="css/AdminLTE.min.css">
    <link rel="stylesheet" href="css/_all-skins.min.css">
    <!-- Custom -->
    <link rel="stylesheet" href="css/custom.css">

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">

    <header class="main-header">

        <!-- Logo -->
        <a href="index.php" class="logo logo-bg">
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Architecture Job Portal</b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="jobs.php"><b>Jobs</b></a>
                    </li>
                    <li>
                        <a href="#candidates"><b>Candidates</b></a>
                    </li>
                    <li>
                        <a href="#company"><b>Company</b></a>
                    </li>
                    <li>
                        <a href="#about"><b>About Us</b></a>
                    </li>
                    <?php if (empty($_SESSION['id_user']) && empty($_SESSION['id_company'])) { ?>
                        <li>
                            <a href="login.php"><b>Login</b></a>
                        </li>
                        <li>
                            <a href="sign-up.php"><b>Sign Up</b></a>
                        </li>
                    <?php } else {

                        if (isset($_SESSION['id_user'])) {
                            ?>
                            <li>
                                <a href="user/index.php"><b>Dashboard</b></a>
                            </li>
                            <?php
                        } else if (isset($_SESSION['id_company'])) {
                            ?>
                            <li>
                                <a href="company/index.php"><b>Dashboard</b></a>
                            </li>
                        <?php } ?>
                        <li>
                            <a href="logout.php"><b>Logout</b></a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="margin-left: 0px;">

        <section class="content-header bg-main">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center index-head">
                        <h1> <strong>Architecture JOBS</strong> In Bangladesh</h1>
                        <p>One Search</p>
                        <p><a class="btn btn-success btn-lg" href="jobs.php" role="button"><big>SEARCH</big></a></p>
                    </div>
                </div>
            </div>
        </section>

        <section class="content-header">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 latest-job margin-bottom-20">
                        <h1 class="text-center">Available  Jobs</h1>
                        <?php
                        $sql = "SELECT * FROM job_post Order By Rand() Limit 4";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $sql1 = "SELECT * FROM company WHERE id_company='$row[id_company]'";
                                $result1 = $conn->query($sql1);
                                if ($result1->num_rows > 0) {
                                    while ($row1 = $result1->fetch_assoc()) {
                                        ?>
                                        <div class="attachment-block clearfix">
                                            <img class="attachment-img" src="img/photo1.png" alt="Attachment Image">
                                            <div class="attachment-pushed">
                                                <h4 class="attachment-heading"><a
                                                            href="view-job-post.php?id=<?php echo $row['id_jobpost']; ?>"><?php echo $row['jobtitle']; ?></a>
                                                    <span class="attachment-heading pull-right">$<?php echo $row['maximumsalary']; ?>
                                                        /Month</span></h4>
                                                <div class="attachment-text">
                                                    <div><strong><?php echo $row1['companyname']; ?>
                                                            | <?php echo $row1['city']; ?> |
                                                            Experience <?php echo $row['experience']; ?> Years</strong>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                            }
                        }
                        ?>

                    </div>
                </div>
            </div>
        </section>

        <section id="about" class="content-header">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center latest-job margin-bottom-20">
                        <h1>About US</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <img src="img/browse.jpg" class="img-responsive">
                    </div>
                    <div class="col-md-6 about-text margin-bottom-20">
                        <h3>Biggest Job Platform for Architect</h3>
                        <p align="justify">The online architecture job portal application allows job seekers and recruiters to connect. The
                            application provides the ability for job seekers to create their accounts, upload their
                            profile and resume or cv, search for jobs, apply for jobs, view different job openings. The
                            application provides the ability for architecture companies to create their accounts, search candidates,
                            create job postings, and view candidates applications.
                        </p>
                        <p align="justify">
                            This website is used to provide a platform for potential candidates to get their dream job
                            and excel in their career.
                            This site can be used as a paving path for both companies and job-seekers for a better life.
                        </p>
                    </div>
                </div>
            </div>
        </section>

    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer" style="margin-left: 0px;">
        <div class="text-center">
            <strong>Copyright &copy; 2020 Saila Nasrin,</strong> All rights
            reserved.
        </div>
    </footer>

    <div class="control-sidebar-bg"></div>

</div>

<!-- jQuery 3 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="js/adminlte.min.js"></script>
</body>
</html>
