<?php
include('condb.php');

// ตรวจสอบว่ามีการส่งค่า userid และ loginid มาหรือไม่
if(isset($_GET['userid']) && isset($_GET['loginid'])) {
    // รับค่า userid และ loginid ที่ต้องการลบ
    $userid = $_GET['userid'];
    $loginid = $_GET['loginid'];

    echo $userid;
    echo $loginid;
    
    // ตรวจสอบว่ามีการกดปุ่มยืนยันการลบหรือไม่
    if(isset($_POST['confirm'])) {
        // สร้างคำสั่ง SQL สำหรับลบข้อมูลผู้ใช้
        $sql_delete_user = "DELETE FROM tbuser WHERE userid = $userid";

        // สร้างคำสั่ง SQL สำหรับลบข้อมูลในตาราง tbloginid
        $sql_delete_login = "DELETE FROM tblogin WHERE loginid = $loginid";

        // ทำการลบข้อมูลในฐานข้อมูล
        $result_delete_user = mysqli_query($conn, $sql_delete_user);
        $result_delete_login = mysqli_query($conn, $sql_delete_login);

        // ตรวจสอบการลบข้อมูล
        if($result_delete_user && $result_delete_login) {
            // หากลบสำเร็จให้ redirect กลับไปยังหน้าเว็บที่แสดงข้อมูล
            header("Location: admin-alumni.php");
            exit;
        } else {
            // หากเกิดข้อผิดพลาดในการลบข้อมูล
            echo "เกิดข้อผิดพลาดในการลบข้อมูล: " . mysqli_error($conn);
        }
    } else {
        // แสดงแบบฟอร์มยืนยันการลบ
        echo '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Confirm Delete</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f4f4; /* เปลี่ยนสีพื้นหลังของ body เป็นสีอ่อน */
                }
                .box {
                    border: 1px solid #ccc;
                    border-radius: 5px;
                    padding: 20px;
                    width: 400px;
                    margin: 50px auto;
                    text-align: center;
                    background-color: #fff;
                    box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
                }
                .confirm-message {
                    margin-bottom: 20px;
                }
                .confirm-buttons {
                    display: flex;
                    justify-content: center;
                    gap: 20px;
                }
                .confirm-buttons button {
                    padding: 10px 20px;
                    border: none;
                    cursor: pointer;
                    border-radius: 5px;
                }
                .confirm-buttons button.yes {
                    background-color: blue;
                    color: white;
                }
                .confirm-buttons button.no {
                    background-color: #f44336;
                    color: white;
                }
            </style>
        </head>
        <body>
            <div class="box">
                <h2>ยืนยันการลบข้อมูล</h2>
                <div class="confirm-message">คุณแน่ใจ หรือ ไม่ที่จะลบข้อมูลนี้?</div>
                <div class="confirm-buttons">
                    <form method="post">
                        <button type="submit" name="confirm" class="yes">ยืนยัน</button>
                        <a href="admin-job.php"><button type="button" class="no">ยกเลิก</button></a>
                    </form>
                </div>
            </div>
        </body>
        </html>';
    }
} else {
    // หากไม่มีการส่งค่า userid หรือ loginid มาให้แสดงข้อความแจ้งเตือน
    echo "ไม่พบข้อมูลผู้ใช้ที่ต้องการลบ";
}
?>
