<!DOCTYPE html>
<html>

<head>
    <title>เพิ่มข่าวสาร</title>
</head>

<body>

    <h2>เพิ่มข่าวสาร</h2>
    <link href="css/style-message.css" rel="stylesheet" />

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
        <label for="title">หัวข้อโพส :</label>
        <input type="text" id="title" name="title">

        <label for="content">เนื้อหาโพส :</label>
        <textarea id="content" name="content" rows="5"></textarea>

        <label for="image_file">หรือเลือกไฟล์รูปภาพ :</label>
        <input type="file" id="image_file" name="image_file">

        <label for="category_id">ประเภทโพส :</label>
        <select id="category_id" name="category_id">
            <option value="1">เเนะนำศิษเก่า</option>
            <option value="2">การบริจาค</option>
            <option value="3">อาสาสมัคร</option>
            <option value="4">กิจกรรม</option>
        </select>

        <input type="submit" name="submit" value="ยืนยัน">
        <a href="admin-news.php" class="btn btn-alert">กลับ</a>
    </form>

        <?php include('condb.php'); ?>
    <?php
    // ตรวจสอบว่ามีการส่งข้อมูลผ่าน POST หรือไม่
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // ดึงข้อมูลจากฟอร์ม
        $title = $_POST['title'];
        $content = $_POST['content'];
        $category_id = $_POST['category_id'];

        // ตรวจสอบว่ามีการอัพโหลดไฟล์รูปภาพหรือไม่
        if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] === UPLOAD_ERR_OK) {
            $image = $_FILES['image_file']['name']; // ชื่อไฟล์รูปภาพที่อัปโหลด
            $target_dir = "png-web/"; // เปลี่ยนโฟลเดอร์เป็น "png-web/"
            $target_file = $target_dir . basename($_FILES["image_file"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Allow certain file formats
            if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png") {
                echo "Sorry, only JPG, JPEG, PNG files are allowed.";
                exit();
            }
            // Check file size (not exceeding 1MB)
            if ($_FILES["image_file"]["size"] > 8000000) {
                echo "Sorry, your file is too large. Max file size is 8MB.";
                exit();
            }
            move_uploaded_file($_FILES["image_file"]["tmp_name"], $target_file);
        } else {
            $image = ''; // ไม่มีรูปภาพ
        }

        // เพิ่มข้อมูลลงในฐานข้อมูล
        $sql = "INSERT INTO news (title, content, image, category_id) VALUES ('$title', '$content', '$image', $category_id)";

        if ($conn->query($sql) === TRUE) {
            echo "เพิ่มข่าวสารเรียบร้อยแล้ว";
            echo '<script>window.location.replace("admin-news.php");</script>';
            exit(); // Ensure script stops here to prevent further execution
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
    ?>

</body>

</html>
