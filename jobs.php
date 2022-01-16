<?php

//To Handle Session Variables on This Page
session_start();


//Including Database Connection From db.php file to avoid rewriting in all files
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

        <section class="content-header">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 latest-job margin-top-50 margin-bottom-20">
                        <h1 class="text-center">Latest Architect Jobs</h1>
                        <div class="input-group input-group-lg">
                            <input type="text" id="searchBar" class="form-control" placeholder="Search job">
                            <span class="input-group-btn">
                  <button id="searchBtn" type="button" class="btn btn-info btn-flat">Go!</button>
                </span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="candidates" class="content-header">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="box box-solid">
                            <div class="box-header with-border">
                                <h3 class="box-title">Search By</h3>
                            </div>
                            <div class="box-body no-padding">
                                <ul class="nav nav-pills nav-stacked tree" data-widget="tree">
                                    <li class="treeview menu-open">
                                        <a href="#"><i></i> City <span
                                                    class="pull-right"><i
                                                        class="fa fa-angle-down pull-right"></i></span></a>
                                        <ul class="treeview-menu">
                                            <li><a href="" class="citySearch" data-target="Dhaka"><i
                                                            class="fa fa-circle-o text-yellow"></i> Dhaka</a></li>
                                            <li><a href="" class="citySearch" data-target="Rajshahi"><i
                                                            class="fa fa-circle-o text-yellow"></i> Rajshahi</a></li>
                                        </ul>
                                    </li>
                                    <li class="treeview menu-open">
                                        <a href="#"><i></i> Experience <span
                                                    class="pull-right"><i
                                                        class="fa fa-angle-down pull-right"></i></span></a>
                                        <ul class="treeview-menu">
                                            <li><a href="" class="experienceSearch" data-target='1'><i
                                                            class="fa fa-circle-o text-yellow"></i> 1 Years</a></li>
                                            <li><a href="" class="experienceSearch" data-target='2'><i
                                                            class="fa fa-circle-o text-yellow"></i> 2 Years</a></li>
                                            <li><a href="" class="experienceSearch" data-target='3'><i
                                                            class="fa fa-circle-o text-yellow"></i> 3 Years</a></li>
                                            <li><a href="" class="experienceSearch" data-target='4'><i
                                                            class="fa fa-circle-o text-yellow"></i> 4 Years</a></li>
                                            <li><a href="" class="experienceSearch" data-target='5'><i
                                                            class="fa fa-circle-o text-yellow"></i> 5 Years</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">

                        <?php

                        $limit = 4;

                        $sql = "SELECT COUNT(id_jobpost) AS id FROM job_post";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $total_records = $row['id'];
                            // celi() Round numbers up to the nearest integer
                            $total_pages = ceil($total_records / $limit);
                        } else {
                            $total_pages = 1;
                        }
                        ?>
                        <div id="target-content">

                        </div>
                        <div class="text-center">
                            <ul class="pagination text-center" id="pagination"></ul>
                        </div>

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
<!-- AdminLTE App -->
<script src="js/adminlte.min.js"></script>
<script src="js/jquery.twbsPagination.min.js"></script>

<script>
    function Pagination() {
        $("#pagination").twbsPagination({
            totalPages: <?php echo $total_pages; ?>,
            visible: 5,
            onPageClick: function (e, page) {
                e.preventDefault();
                $("#target-content").html("loading....");
                $("#target-content").load("jobpagination.php?page=" + page);
            }
        });
    }
</script>

<script>
    $(function () {
        Pagination();
    });
</script>

<script>
    $("#searchBtn").on("click", function (e) {
        e.preventDefault();
        var searchResult = $("#searchBar").val();
        var filter = "searchBar";
        if (searchResult != "") {
            $("#pagination").twbsPagination('destroy');
            Search(searchResult, filter);
        } else {
            $("#pagination").twbsPagination('destroy');
            Pagination();
        }
    });
</script>

<script>
    $(".experienceSearch").on("click", function (e) {
        e.preventDefault();
        var searchResult = $(this).data("target");
        var filter = "experience";
        if (searchResult != "") {
            $("#pagination").twbsPagination('destroy');
            Search(searchResult, filter);
        } else {
            $("#pagination").twbsPagination('destroy');
            Pagination();
        }
    });
</script>

<script>
    $(".citySearch").on("click", function (e) {
        e.preventDefault();
        var searchResult = $(this).data("target");
        var filter = "city";
        if (searchResult != "") {
            $("#pagination").twbsPagination('destroy');
            Search(searchResult, filter);
        } else {
            $("#pagination").twbsPagination('destroy');
            Pagination();
        }
    });
</script>

<script>
    function Search(val, filter) {
        $("#pagination").twbsPagination({
            totalPages: <?php echo $total_pages; ?>,
            visible: 5,
            onPageClick: function (e, page) {
                e.preventDefault();
                val = encodeURIComponent(val);
                $("#target-content").html("loading....");
                $("#target-content").load("search.php?page=" + page + "&search=" + val + "&filter=" + filter);
            }
        });
    }
</script>


</body>
</html>
