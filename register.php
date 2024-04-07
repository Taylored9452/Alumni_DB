<?php 
include('condb.php'); 

$insert_user_query = null; // ประกาศตัวแปรนอกเพื่อให้สามารถปิดได้ทุกกรณี
$errors = []; // เก็บข้อผิดพลาดที่เกิดขึ้น

// เรียกใช้งาน session_start() ก่อนการใช้งาน session
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["loginname"];
    $password = $_POST["loginpassword"];
    $confirmPassword = $_POST["confirmPassword"];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password

    // Check if confirmPassword matches password
    if ($password !== $confirmPassword) {
        $errors[] = "รหัสผ่านไม่ตรงกัน.";
    }

    // Check if username or email already exists in user_information table
    $check_user_query = $conn->prepare("SELECT * FROM tblogin WHERE loginname=?");
    $check_user_query->bind_param("s", $username);
    $check_user_query->execute();
    $check_user_result = $check_user_query->get_result();

    if ($check_user_result->num_rows > 0) {
        $row = $check_user_result->fetch_assoc();
        if ($row["loginname"] == $username) {
            $errors[] = "ชื่อผู้ใช้นี้มีอยู่แล้ว.";
        }
    }

    // If there are no errors, proceed with user creation
    if (empty($errors)) {
        // SQL to insert data into the database for user_information table
        $insert_user_query = $conn->prepare("INSERT INTO tblogin (loginname,loginpassword) VALUES (?, ?)");
        $insert_user_query->bind_param("ss", $username, $hashed_password);
        echo $username;
    
        // Execute the SQL query to insert user data
        if ($insert_user_query->execute()) {
            // Get the ID of the inserted user
            $user_id = mysqli_insert_id($conn);
            echo $user_id;
            // Insert additional data into tbuser table
            $sql = "INSERT INTO tbuser (loginid) VALUES ('$user_id')";
            $result = mysqli_query($conn, $sql) or die ("Error in query: $sql" . mysqli_error($conn));

            // Redirect to login page if everything is successful
            header("Location: login.php");
            exit();
        } else {
            // If execution fails, handle error
            $errors[] = "An error occurred while adding data.";
        }

        // Close prepared statements
        $check_user_query->close();
        if ($insert_user_query != null) {
            $insert_user_query->close();
        }
    }
}
$conn->close();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 50px;
        }
        .form-container {
            max-width: 400px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="form-container">
                <h2 class="mb-4">สมัรคสมาชิก</h2>

                <!-- แสดงข้อผิดพลาด -->
                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger mt-3" role="alert">
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li><?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form id="registerForm" method="post" action="register.php">
                    <div class="mb-3">
                        <label for="loginname" class="form-label">ชื่อผู้ใช้</label>
                        <input type="text" class="form-control" id="loginname" name="loginname" required>
                        <div id="usernameError" class="text-danger"></div>
                    </div>
                    <div class="mb-3">
                        <label for="loginpassword" class="form-label">รหัสผ่าน</label>
                        <input type="password" class="form-control" id="loginpassword" name="loginpassword" required>
                        <div id="passwordError" class="text-danger"></div>
                    </div>
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">ยืนยันรหัสผ่าน</label>
                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                        <div id="confirmPasswordError" class="text-danger"></div>
                    </div>
                    <button type="submit" class="btn btn-primary" id="registerButton">ยืนยัน</button>
                    <a class="btn btn-outline-dark me-2" href="login.php">ลงชื่อเข้าใช้</a>
                    <a href="index.php" class="btn btn-outline-danger me-2">กลับหน้าหลัก</a>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // JavaScript function to handle errors
    function showError(fieldId, errorMessage) {
        document.getElementById(fieldId + "Error").innerText = errorMessage;
        document.getElementById(fieldId).classList.add("is-invalid");
    }


    // Clear error messages when inputs are changed
    document.getElementById("loginname").addEventListener("input", function() {
        document.getElementById("usernameError").innerText = "";
        document.getElementById("loginname").classList.remove("is-invalid");
    });

    // Check if confirmPassword matches password ยังไม่แสดงผลออกมา***
    document.getElementById("confirmPassword").addEventListener("input", function() {
    var password = document.getElementById("loginpassword").value;
    var confirmPassword = document.getElementById("confirmPassword").value;

    if (password !== confirmPassword) {
        showError("loginpassword", "กรุณากรอกรหัสให้ตรงกัน");
        showError("confirmPassword", "กรุณากรอกรหัสให้ตรงกัน");
    } else {
        document.getElementById("loginpasswordError").innerText = ""; // เปลี่ยนจาก document.getElementById("passwordError").innerText = "";
        document.getElementById("loginpassword").classList.remove("is-invalid");
        document.getElementById("confirmPasswordError").innerText = ""; // เปลี่ยนจาก document.getElementById("confirmPasswordError").innerText = "";
        document.getElementById("confirmPassword").classList.remove("is-invalid");
        }
    });

    // Prevent form submission if there are errors
    document.getElementById("registerButton").addEventListener("click", function(event) {
    var errorsExist = false;

    var password = document.getElementById("loginpassword").value;
    var confirmPassword = document.getElementById("confirmPassword").value;

    if (password !== confirmPassword) {
        showError("loginpassword", "กรุณากรอกรหัสให้ตรงกัน");
        showError("confirmPassword", "กรุณากรอกรหัสให้ตรงกัน");
        errorsExist = true;
    }

    if (errorsExist) {
        event.preventDefault();
    }
});
    
</script>

</body>
</html>