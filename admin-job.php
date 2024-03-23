<?php include 'navbar-user.php'; ?>
<?php include('condb.php'); ?>


<?php 
$sql = "SELECT * FROM tbuser";
$query_sql = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Sidebar 1</title>
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
                    <a href="admin-job.php" class="active"> <!-- ลิ้งไปหน้า admin-alumni.php -->
                        <i class="fa-solid fa-list-check"></i>
                        อาชีพ
                        <i class="notification-badge"></i>
                    </a>
                </li>
                <li class="nav-item mb-1">
                    <a href="admin-address.php" class=""> <!-- ลิ้งไปหน้า admin-alumni.php -->
                        <i class="fa-solid fa-building-columns"></i>
                        สถานที่
                    </a>
                </li>
                <li class="nav-item mb-1">
                    <a href="admin-course.php" class=""> <!-- ลิ้งไปหน้า admin-alumni.php -->
                        <i class="fa-solid fa-book"></i>
                        หลักสูตร
                    </a>
                </li>
                <li class="nav-item mb-1">
                    <a href="admin-postwork.php" class=""> <!-- ลิ้งไปหน้า admin-alumni.php -->
                        <i class="fa-solid fa-briefcase"></i>
                        ประกาศสมัรคงาน
                    </a>
                </li>
                <li class="nav-item mb-1">
                    <a href="admin-news.php" class=""> 
                        <i class="fa-solid fa-star"></i>
                        ข่าวสาร
                    </a>
                </li>
            </ul>
            <hr>
            <div class="d-flex">
                <img src="img/profile_user.jpeg" class="img-fluid rounded me-2" width="50px" alt="">
                <span>
                    <h6 class="mt-1 mb-0">John Doe</h6>
                    <small>johndoe@remotedev</small>
                </span>
            </div>
        </div>

        <div class="bg-light flex-fill">
            <div class="p-2 d-md-none d-flex text-white bg-dark">
                <a href="#" class="text-white" data-bs-toggle="offcanvas" data-bs-target="#bdSidebar">
                    <i class="fa-solid fa-bars"></i>
                </a>
                <span class="ms-3">REMOTE DEV</span>
            </div>
                <div class="row">
                    <div class="col">
                        <p><?php include 'admin-info-job.php'; ?></p>
                    </div>
                </div>
            </div>
            
        </div>

        
    </div>
</body>
</html>