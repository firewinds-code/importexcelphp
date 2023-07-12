<?php include("connection.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UPLOAD</title>
    <?php include("header.php"); ?>
</head>

<body class="hold-transition sidebar-mini">

    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <?php include('sidebar.php'); ?>

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="card card-primary" style="margin:10px ; ">
                    <div class="card-header">
                        <h3 class="card-title">Upload File</h3>
                    </div>
                    <!-- form start -->
                    <form action="import.php" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="col-md-4">
                                <input type="file" class="form-control" id="file" accept=".csv" name="file" required
                                    value="">
                            </div>
                            <br>
                            <div class="card-footer">
                                <button type="submit" name="import" id="import"
                                    class="btn btn-primary">Upload/Import</button>
                            </div>
                        </div>
                    </form>
                </div>

            </section>
        </div>
        <br>
        <?php include("footer.php"); ?>


</body>

</html>