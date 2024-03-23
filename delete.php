<?php
include('condb.php');

// ตรวจสอบว่ามีการส่งค่า userid มาหรือไม่
if(isset($_GET['userid'])) {
    // รับค่า userid ที่ต้องการลบ
    $userid = $_GET['userid'];

    // สร้างคำสั่ง SQL สำหรับลบข้อมูลผู้ใช้
    $sql = "DELETE FROM tbuser WHERE userid = $userid";

    // ทำการลบข้อมูลในฐานข้อมูล
    $result = mysqli_query($conn, $sql);

    // ตรวจสอบการลบข้อมูล
    if($result) {
        // หากลบสำเร็จให้ redirect กลับไปยังหน้าเว็บที่แสดงข้อมูล
        header("Location: admin-job.php");
        exit;
    } else {
        // หากเกิดข้อผิดพลาดในการลบข้อมูล
        echo "เกิดข้อผิดพลาดในการลบข้อมูล: " . mysqli_error($conn);
    }
} else {
    // หากไม่มีการส่งค่า userid มาให้แสดงข้อความแจ้งเตือน
    echo "ไม่พบข้อมูลผู้ใช้ที่ต้องการลบ";
}
?>
