<?php include('condb.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/style-admin.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</head>
<body>
    
    <div class="container-fluid p-0 d-flex h-100">
        <div id="bdSidebar" class="d-flex flex-column flex-shrink-0 p-3 bg-dark text-white offcanvas-md offcanvas-start" style="width: 280px;">
            <a href="admin.php" class="navbar-brand">
                <h5><i class="fa-solid fa-user-graduate" style="font-size: 28px;"></i> ระบบจัดการศิษย์เก่า</h5>
            </a>
            <hr>
            <ul class="mynav nav nav-pills flex-column mb-auto">
                <li class="nav-item mb-1">
                    <a href="admin-alumni.php" class=""> <!-- ลิ้งไปหน้า admin-alumni.php -->
                        <i class="fa-solid fa-user"></i>
                        รายชื่อศษย์เก่า
                    </a>
                </li>
                <li class="nav-item mb-1">
                    <a href="admin-job.php" class=""> <!-- ลิ้งไปหน้า admin-job.php -->
                        <i class="fa-solid fa-list-check"></i>
                        อาชีพ
                        <i class="notification-badge"></i>
                    </a>
                </li>
                <li class="nav-item mb-1">
                    <a href="admin-news.php" class=""> <!-- ลิ้งไปหน้า admin-news.php -->
                        <i class="fa-solid fa-star"></i>
                        ข่าวสาร
                    </a>
                </li>
            </ul>
            <hr>
            
        </div>

        <div class="bg-light flex-fill">
            <div class="p-2 d-md-none d-flex text-white bg-dark">
                <a href="#" class="text-white" data-bs-toggle="offcanvas" data-bs-target="#bdSidebar">
                    <i class="fa-solid fa-bars"></i>
                </a>
                <span class="ms-3">REMOTE DEV</span>
            </div>
            <div class="p-4">
                <nav style="--bs-breadcrumb-divider:'>';font-size:14px">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><i class="fa-solid fa-house"></i></li>
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item">Orders</li>
                    </ol>
                </nav>
                <div class="d-flex justify-content-between">
                    <h5>Orders</h5>
                    <button class="btn btn-sm btn-light"><i class="fa-solid fa-download"></i> Download</button>
                </div>
                <hr>
                <div class="row">
                    <div class="col">
                        <p>Page content goes here</p>
                    </div>
                </div>
            </div>
            
        </div>

        
    </div>
</body>
</html>