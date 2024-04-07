<!DOCTYPE html>
<html>

<head>
    <title>ข่าวสาร</title>
    <link href="css/style-message2.css" rel="stylesheet" />
</head>

<body>
    <br><h2>ประชาสัมพันธ์</h2>

    <div class="category-select">
    <a href="index.php" class="category-button <?php echo $is_home ? 'active' : ''; ?>" id="homeButton" onclick="setActiveButton('homeButton')">หน้าแรก</a>
    <a href="index.php?category=1" class="category-button" id="category1" onclick="setActiveButton('category1')">เเนะนำศิษเก่า</a>
    <a href="index.php?category=2" class="category-button" id="category2" onclick="setActiveButton('category2')">การบริจาค</a>
    <a href="index.php?category=3" class="category-button" id="category3" onclick="setActiveButton('category3')">อาสาสมัคร</a>
    <a href="index.php?category=4" class="category-button" id="category4" onclick="setActiveButton('category4')">กิจกรรม</a><br>
    </div>
    <div class="news-container">

        <?php include('condb.php'); ?>
        <?php
        $category = isset($_GET['category']) ? $_GET['category'] : '';
        $sql = "SELECT * FROM news";
        if ($category) {
            $sql .= " WHERE category_id= $category";
        }
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="news-item">';
                if (!empty($row["image"])) {
                    echo '<img src="png-web/' . $row["image"] . '" alt="' . $row["title"] . '" class="news-image">';
                }
                echo '<div class="news-content">';
                echo '<h3>' . $row["title"] . '</h3>';
                echo '<p>' . $row["content"] . '</p>';
                echo '<div class="post-meta">โพสต์เมื่อ: ' . $row["created_at"] . '</div>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "0 results";
        }

        $conn->close();
        ?>
    </div>

    <script>
        function setActiveButton(id) {
            document.querySelectorAll('.category-button').forEach(function(button) {
                button.classList.remove('active');
            });

            document.getElementById(id).classList.add('active');
        }
    </script>
</body>

</html>