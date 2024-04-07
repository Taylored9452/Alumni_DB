<!DOCTYPE html>
<html>

<head>
    <title>ข่าวสาร</title>
    <!-- CSS styles -->
</head>

<body>
    <h2>ข่าวสาร</h2>
    <div class="category-list">

        <?php include('condb.php'); ?>
        <?php
        // Check if category ID is set in URL
        if (isset($_GET['category'])) {
            $category_id = $_GET['category'];

            // Fetch news articles based on selected category
            $sql = "SELECT * FROM news WHERE category_id = $category_id";
        } else {
            // Fetch all news articles if no category is selected
            $sql = "SELECT * FROM news";
        }

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="news-item">';
                echo '<img src="png-web/' . $row["image"] . '" alt="' . $row["title"] . '" class="news-image">';
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
</body>

</html>