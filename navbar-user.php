<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container px-4 px-lg-5">
        <!-- Logo -->
        <a class="navbar-brand" href="index.php">RMUTSV ALUMNI</a>
        <!-- Toggler button for small screens -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <!-- Navigation links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="nav-link" aria-current="page" href="index.php">หน้าหลัก</a></li>
                <li class="nav-item"><a class="nav-link" href="Introducing.php" >เเนะนำศิษย์เก่า</a></li>
            </ul>
            
            <?php 
                session_start(); // เริ่มต้น Session
                include('condb.php'); // เชื่อมต่อฐานข้อมูล
                if(isset($_SESSION['loginname'])) { // ตรวจสอบว่ามีการเข้าสู่ระบบหรือไม่
                    $query = "SELECT * FROM tblogin WHERE loginname = '".$_SESSION['loginname']."'";
                    $result = $conn->query($query);
                    
                    if($result && $result->num_rows > 0) {
                        $user_row = $result->fetch_assoc();                    
                        echo '<span class="navbar-text me-2">ยินดีต้อนรับ ' . $_SESSION['loginname'] . '</span>';                       
                        if($user_row['typeid'] == 1) {
                            echo '<a class="btn btn-outline-light me-2" href="admin.php">admin</a>';
                        }
                        
                        echo '<a class="btn btn-outline-light me-2" href="logout.php">Logout</a>';
                        
                        // แสดงปุ่ม "แก้ไข"
                        echo '<a class="btn btn-outline-light me-2" href="edit.php">แก้ไข</a>';
                    }
                } else {
                    // ถ้าไม่ได้เข้าสู่ระบบ ให้แสดงปุ่ม "Login" เท่านั้น
                    echo '<a class="btn btn-outline-light me-2" href="login.php">Login</a>';
                }
                //$conn->close();
                ?>
        </div>
    </div>
</nav>
