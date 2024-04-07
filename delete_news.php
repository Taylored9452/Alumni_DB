<!DOCTYPE html>
<html>

<head>
    <title>รายการข่าวสาร</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        th {
            background-color: #333333;
            color: white;
        }

        .confirm-delete {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 5px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            cursor: pointer;
            border-radius: 4px;
        }

        .add-news-btn {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-bottom: 10px;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s; /* เพิ่มการเปลี่ยนสีเมื่อโฮเวอร์ */
        }

        .add-news-btn:hover {
            background-color: #0056b3; /* สีเมื่อโฮเวอร์ */
        }
    </style>
    <script>
        function confirmDelete() {
            return confirm("คุณต้องการลบข่าวสารนี้?");
        }
    </script>
</head>

<body>
    <h1 style="text-align: center;">รายการข่าวสาร <a href="message.php" class="add-news-btn">เพิ่มข่าวสาร</a></h1>
    <table>
        <tr>
            <th>ID</th>
            <th>หัวเรื่อง</th>
            <th>เนื้อหา</th>
            <th>ประเภทข่าวสาร</th>
            <th>ไฟล์ภาพ</th>
            <th>ลบข่าวสาร</th>
        </tr>

        <?php include('condb.php');?>
    <?php
// เรียกใช้งานตัวแปร POST ที่ส่งมาจากฟอร์ม
        if (isset($_POST['delete_news'])) {
            $news_id = $_POST['news_id'];

            // สร้างคำสั่ง SQL สำหรับลบข่าวสาร
            $sql = "DELETE FROM news WHERE id = $news_id";

            // ทำการ execute คำสั่ง SQL
            if ($conn->query($sql) === TRUE) {
                // ไม่แสดงข้อความ "ลบข่าวสารเรียบร้อยแล้ว"
            } else {
                echo "เกิดข้อผิดพลาดในการลบข่าวสาร: " . $conn->error;
            }
        }

        // สร้างคำสั่ง SQL สำหรับดึงข้อมูลข่าวสาร
        $sql = "SELECT * FROM news";
        $result = $conn->query($sql);

        // ตรวจสอบว่ามีข้อมูลในตารางหรือไม่
        if ($result->num_rows > 0) {
            // แสดงข้อมูลข่าวสารทั้งหมดในรูปแบบตาราง
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . (strlen($row["title"]) > 100 ? substr($row["title"], 0, 200) : $row["title"]) . "</td>";
                echo "<td>" . (strlen($row["content"]) > 100 ? substr($row["content"], 0, 600) : $row["content"]) . "</td>";
                echo "<td>";
                    if ($row["category_id"] == 1) {
                        echo "ข้อมูลศิษย์เก่า";
                    } elseif ($row["category_id"] == 2) {
                        echo "การบริจาค";
                    } elseif ($row["category_id"] == 3) {
                        echo "อาสาสมัคร";
                    } elseif ($row["category_id"] == 4) {
                        echo "กิจกรรม";
                    } else {
                        echo $row["category_id"];
                    }
                    echo "</td>";
                echo "<td>" . $row["image"] . "</td>";
                echo "<td><form method='post' action='admin-news.php' onsubmit='return confirmDelete();'><input type='hidden' name='news_id' value='" . $row["id"] . "'><input class='confirm-delete' type='submit' name='delete_news' value='ลบ'></form></td>";
                echo "</tr>";
            }
        }

        // ปิดการเชื่อมต่อกับฐานข้อมูล
        $conn->close();
?>