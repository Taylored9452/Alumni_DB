<?php include('condb.php'); ?>

<?php
// เชื่อมต่อกับฐานข้อมูล

// ตรวจสอบว่ามีการส่งค่า userid มาหรือไม่
if(isset($_GET['userid'])) {
    // ดึงข้อมูลของผู้ใช้ที่ต้องการแก้ไขออกมาจากฐานข้อมูล
    $userid = $_GET['userid'];
    $sql = "SELECT * FROM tbuser WHERE userid = $userid";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);

    // ตรวจสอบว่าพบข้อมูลหรือไม่
    if(!$user) {
        echo "ไม่พบข้อมูลผู้ใช้";
        exit;
    }
}

// ตรวจสอบว่ามีการส่งค่าแบบ POST มาหรือไม่ (หลังจากกดปุ่มยืนยันการแก้ไข)
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับค่าที่ส่งมาจากฟอร์มแก้ไข
    $updatedData = [
        'userbirthday' => $_POST['userbirthday'],
        'usercitizen' => $_POST['usercitizen']
        // เพิ่มข้อมูลอื่นๆ ตามต้องการ
    ];

    // อัปเดตข้อมูลในฐานข้อมูล
    $sql = "UPDATE tbuser SET userbirthday = '{$updatedData['userbirthday']}', usercitizen = '{$updatedData['usercitizen']}' WHERE userid = $userid";
    $result = mysqli_query($conn, $sql);

    if($result) {
        // หากอัปเดตข้อมูลสำเร็จ ให้ redirect กลับไปยังหน้าเว็บที่แสดงข้อมูล
        header("Location: admin-job.php");
        exit;
    } else {
        // หากเกิดข้อผิดพลาดในการอัปเดตข้อมูล
        echo "เกิดข้อผิดพลาดในการอัปเดตข้อมูล: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>แก้ไขข้อมูลผู้ใช้</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container mt-5">
            <h3 class="mb-4">แก้ไขข้อมูลผู้ใช้</h3>
            <form method="POST">
                <div class="mb-3">
                    <label for="userbirthday" class="form-label">วัน/เดือน/ปี เกิด</label>
                    <input type="text" class="form-control" id="userbirthday" name="userbirthday" value="<?php echo $user['userbirthday']; ?>">
                </div>
                <div class="mb-3">
                    <label for="usercitizen" class="form-label">เลขบัตรประชาชน</label>
                    <input type="text" class="form-control" id="usercitizen" name="usercitizen" value="<?php echo $user['usercitizen']; ?>">
                </div>
                <!-- เพิ่มฟิลด์อื่นๆ ตามต้องการ -->
                <button type="submit" class="btn btn-primary">ยืนยันการแก้ไข</button>
            </form>
        </div>
</body>
</html>
