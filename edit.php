<?php include('condb.php'); ?>

<?php 

    session_start();
    // echo '<pre>';
    // print_r($_SESSION);
    // echo '</pre>';

    $loginid = $_SESSION['loginid'];

    $sql_user = "SELECT * FROM tbuser WHERE loginid = '$loginid'";
    $query3 = mysqli_query($conn, $sql_user) or die ("Error in query: $sql2" . mysqli_error());

    $row1 = mysqli_fetch_array($query3);
    extract($row1);

    $loginid = $row1['loginid'];

    // echo '<pre>';
    // print_r($row1);
    // echo '</pre>';

    $sql_provinces = "SELECT * FROM provinces";
    $query = mysqli_query($conn, $sql_provinces);

    $sql_campus = "SELECT * FROM tbcampus";
    $query2 = mysqli_query($conn, $sql_campus);

// ตรวจสอบว่าฟอร์มถูกส่งมาหรือไม่
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // เก็บข้อมูลจากฟอร์ม

    $prefixid = $_POST['prefixid'];

    if (!empty($prefixid)) {
        echo "ค่า prefixid ถูกส่งมา: $prefixid";
    } else {
        echo "โปรดเลือกคำนำหน้า";
    } 
     
    $firstnamename = $_POST['firstnamename']; 

    $lastnamename = $_POST['lastnamename'];
    
    $emailusername = $_POST['emailusername'];

    $phoneusername = $_POST['phoneusername'];

    $useraddress = $_POST['useraddress'];

    $provinces = $_POST['Ref_prov_id'];

    $amphures = $_POST['Ref_dist_id'];

    $districts = $_POST['Ref_subdist_id'];

    $provincesCom = $_POST['Cef_prov_id'];

    $amphuresCom = $_POST['Cef_dist_id'];

    $districtsCom = $_POST['Cef_subdist_id'];

    $campus = $_POST['campus_id'];

    $group = $_POST['group_id'];

    $branch = $_POST['branch_id'];

    $course = $_POST['course_id'];

    $usercitizen = $_POST['usercitizen'];

    $userbirthday = $_POST['userbirthday']; //(ปี-เดือน-วัน)

    $companyname = $_POST['companyname'];

    $companyjob = $_POST['companyjob'];

    $emailcomname = $_POST['emailcomname'];

    $phonecomname = $_POST['phonecomname'];

    //ดำเนินการ เป็นลำดับ บนลง-ล่าง

    $sql2 = "INSERT IGNORE INTO tbfirstname (firstnamename) VALUES ('$firstnamename')";                     //นำเข้าข้อมูลหน้าเว็บ โดยถ้าซ้ำ จะไป $get_sql2
    $result2 = mysqli_query($conn, $sql2) or die ("Error in query: $sql2" . mysqli_error());  
    $get_sql2 = "SELECT firstnameid FROM tbfirstname WHERE firstnamename = '$firstnamename' " ;             //เลือกข้อมูลใน DB แทน 
    $result_get2 = mysqli_query($conn, $get_sql2) or die ("Error in query: $get_sql2" . mysqli_error());
     
    $row = mysqli_fetch_assoc($result_get2);    //ดึงค่า id ออกมา
    $firstnamename_id = $row['firstnameid'];

    //echo $firstnamename_id;
    
    $sql3 = "INSERT IGNORE INTO tblastname (lastnamename) VALUES ('$lastnamename')";
    $result3 = mysqli_query($conn, $sql3) or die ("Error in query: $sql3" . mysqli_error());
    $get_sql3 = "SELECT lastnameid FROM tblastname WHERE lastnamename = '$lastnamename' " ;
    $result_get3 = mysqli_query($conn, $get_sql3) or die ("Error in query: $get_sql3" . mysqli_error());
     
    $row = mysqli_fetch_assoc($result_get3);
    $lastnamename_id = $row['lastnameid'];

    //echo $lastnamename_id;

    $sql4 = "INSERT INTO tbhistoryuser (prefixid, firstnameid, lastnameid, userid) VALUES ('$prefixid', '$firstnamename_id', '$lastnamename_id', '$loginid')"; //นำข้อมูลจำเป็นใน tbhistoryuser เข้าก่อน
    $result4 = mysqli_query($conn, $sql4) or die ("Error in query: $sql4" . mysqli_error());

    $historyuser_id = mysqli_insert_id($conn);  //คำสั่งดึง id ตัวล่าสุด mysqli_insert_id

    echo $historyuser_id;
    
    $sql5 = "INSERT IGNORE INTO tbemailuser (emailusername, historyuserid) VALUES ('$emailusername', '$historyuser_id') on duplicate key update historyuserid = values(historyuserid)";  //นำเข้าข้อมูลโดยใช้ historyuser_id ล่าสุด
    $result5 = mysqli_query($conn, $sql5) or die ("Error in query: $sql5" . mysqli_error());
    

    echo $emailusername;

    $sql6 = "INSERT IGNORE INTO tbphoneuser (phoneusername, historyuserid) VALUES ('$phoneusername', '$historyuser_id') on duplicate key update historyuserid = values(historyuserid)";
    $result6 = mysqli_query($conn, $sql6) or die ("Error in query: $sql6" . mysqli_error());
    

    //
    $sql7 = "UPDATE tbuser SET useraddress = '$useraddress', courseid = '$course', districts = '$districts', usercitizen = '$usercitizen', userbirthday = '$userbirthday', userimg = '".basename($_FILES["userimg"]["name"])."' WHERE loginid ='$loginid'";
    $result7 = mysqli_query($conn, $sql7) or die ("Error in query: $sql7" . mysqli_error($conn));
    //

    $sql8 = "INSERT INTO tbcompany (companyname, companyjob ,districts) VALUES ('$companyname', '$companyjob', '$districtsCom')";
    $result8 = mysqli_query($conn, $sql8) or die ("Error in query: $sql8" . mysqli_error());

    $company_id = mysqli_insert_id($conn);

    $sql9 = "INSERT INTO tbemailcom (emailcomname, companyid) VALUES ('$emailcomname', '$company_id') on duplicate key update companyid = values(companyid)";  //นำเข้าข้อมูลโดยใช้ historyuser_id ล่าสุด
    $result9 = mysqli_query($conn, $sql9) or die ("Error in query: $sql9" . mysqli_error());

    $sql10 = "INSERT INTO tbphonecom (phonecomname, companyid) VALUES ('$phonecomname', '$company_id') on duplicate key update companyid = values(companyid)";
    $result10 = mysqli_query($conn, $sql10) or die ("Error in query: $sql10" . mysqli_error());

    $sql11 = "INSERT INTO tbhistorycom (userid, companyid) VALUES ('$loginid', '$company_id')";
    $result11 = mysqli_query($conn, $sql11) or die ("Error in query: $sql11" . mysqli_error());
    
    mysqli_close($conn);

    // ตรวจสอบว่าการแทรกสำเร็จหรือไม่
    if ( $result2 || $result3 || $result4 || $result5 || $result6 || $result7 || $result8 || $result9 || $result10 || $result11){
        echo "<script type='text/javascript'>";
        echo "alert('successfully');";
        echo"window.location = 'edit.php';";
        echo "</script>";
        }
        else {
        //กำหนดเงื่อนไขว่าถ้าไม่สำเร็จให้ขึ้นข้อความและกลับไปหน้าเพิ่ม
        echo "<script type='text/javascript'>";
        echo "alert('error!');";
        echo"window.location = 'edit.php'; ";
        echo"</script>";
        }

        // ตรวจสอบว่าไฟล์ถูกอัปโหลดโดยไม่มีข้อผิดพลาด
    if(isset($_FILES["userimg"]) && $_FILES["userimg"]["error"] == 0) {
        $target_directory = "../alumni_db/Uploads/"; // ไดเรกทอรีเป้าหมายที่คุณต้องการเก็บไฟล์ที่อัปโหลด
        $target_file = $target_directory . basename($_FILES["userimg"]["name"]);

        // ตรวจสอบว่าไฟล์มีอยู่แล้วหรือไม่
        if (file_exists($target_file)) {
            echo "ขอโทษ ไฟล์นี้มีอยู่แล้ว";
        } else {
            // ย้ายไฟล์ที่อัปโหลดไปยังไดเรกทอรีเป้าหมาย
            if (move_uploaded_file($_FILES["userimg"]["tmp_name"], $target_file)) {
                echo "ไฟล์ ". htmlspecialchars( basename( $_FILES["userimg"]["name"])). " ถูกอัปโหลดเรียบร้อยแล้ว";
                // ตอนนี้คุณสามารถเก็บที่อยู่หรือชื่อไฟล์ในฐานข้อมูลของคุณ
                $userimg_path = $target_file; // นี่เป็นตัวอย่างเท่านั้น ปรับเปลี่ยนตามความต้องการ
            } else {
                echo "ขอโทษ เกิดข้อผิดพลาดในการอัปโหลดไฟล์ของคุณ";
            }
        }
    }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- แท็กเมตา, ลิงก์ CSS, และอื่น ๆ -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Sidebar 1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style-add.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <!-- เนื้อหา HTML รวมถึงฟอร์มสำหรับเพิ่มรายการผู้ใช้ใหม่ -->
    
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
            <span style="color: red; font-size: smaller;">*</span> <span style="color: red; font-size: smaller;">จำเป็นต้องมีข้อมูล</span>
            <br>
            <select name="prefixid" id="prefixDropdown" class="custom-dropdown" required>
            <option value="" selected disabled>-คำนำหน้า-</option>
            <?php
            // วนลูปเพื่อแสดงตัวเลือกใน dropdown
            $prefixaname = mysqli_query($conn, "SELECT * FROM tbprefix");
            while ($row = mysqli_fetch_assoc($prefixaname)) {
            ?>
                <option value="<?php echo $row['prefixid'] ?>"><?php echo $row['prefixname'] ?></option>
            <?php } ?>
        </select>
        <br><br>

        <!-- <script>
            // สร้างฟังก์ชันเมื่อมีการเปลี่ยนแปลงใน dropdown
            document.getElementById("prefixDropdown").onchange = function() {
                // ดึงค่า ID ของตัวเลือกที่ถูกเลือก
                var selectedPrefixId = this.value;
                // แสดงค่า ID ใน console เพื่อตรวจสอบ
                console.log("Selected prefix ID: " + selectedPrefixId);

                // กำหนดค่าของ prefixid ใน input hidden
                document.getElementById("prefixid").value = selectedPrefixId;
            };
        </script> -->


        <!-- <input type="text" name="firstnamename" placeholder="ชื่อ" required><br>
        <input type="text" name="lastnamename" placeholder="นามสกุล" required><br> -->
        <span style="color: red; font-size: smaller;">*</span> <span style="color: red; font-size: smaller;">จำเป็นต้องมีข้อมูล</span>
        <input type="text" name="firstnamename" placeholder="ชื่อ" required><br>
        <span style="color: red; font-size: smaller;">*</span> <span style="color: red; font-size: smaller;">จำเป็นต้องมีข้อมูล</span> 
        <input type="text" name="lastnamename" placeholder="นามสกุล" required><br>  
        <input type="email" name="emailusername" placeholder="อีเมล"><br>
        <input type="text" name="phoneusername" placeholder="เบอร์ติดต่อ"><br>
        <input type="text" name="useraddress" placeholder="บ้านเลขที่/ถนน"><br>
         
        
            <label for="sel1">จังหวัด:</label>
            <select class="form-control" name="Ref_prov_id" id="provinces">
                <option value="" selected disabled>-กรุณาเลือกจังหวัด-</option>
                <?php foreach ($query as $value) { ?>
                <option value="<?=$value['id']?>"><?=$value['name_th']?></option>
                <?php } ?>
            </select>
            <br>
    
        <label for="sel1">อำเภอ:</label>
        <select class="form-control" name="Ref_dist_id" id="amphures">
        </select>
        <br>
    
        <label for="sel1">ตำบล:</label>
        <select class="form-control" name="Ref_subdist_id" id="districts">
        </select>
        <br>
    
        <label for="sel1">รหัสไปรษณีย์:</label>
        <input type="text" name="zip_code" id="zip_code" class="form-control">
            <br>

            <!-- โรงเรียน วิทยาเขต คณะ สาขา หลักสูตร -->

            <label for="sel1">วิทยาเขต:</label>
            <select class="form-control" name="campus_id" id="tbcampus">
                <option value="" selected disabled>-กรุณาเลือกวิทยาเขต-</option>
                <?php foreach ($query2 as $value) { ?>
                <option value="<?=$value['campusid']?>"><?=$value['campusname']?></option>
                <?php } ?>
            </select>
            <br>
    
        <label for="sel1">คณะ:</label>
        <select class="form-control" name="group_id" id="tbgroup">
        </select>
        <br>
    
        <label for="sel1">สาขา:</label>
        <select class="form-control" name="branch_id" id="tbbranch">
        </select>
        <br>
    
        <label for="sel1">หลักสูตร:</label>
        <select class="form-control" name="course_id" id="tbcourse">
        </select>
        <br>
        
        <input type="text" name="usercitizen" placeholder="เลขบัตรประชาชน" maxlength="13"><br><br>
        <label for="sel1">วันเกิด:&nbsp;&nbsp;</label>
        <input type="date" name="userbirthday" placeholder="วัน/เดือน/ปีเกิด"><br><br>
        <input type="text" name="companyname" placeholder="ชื่อสถานที่ทำงาน"><br>
        <input type="text" name="companyjob" placeholder="ตำแหน่ง"><br>
        <input type="text" name="emailcomname" placeholder="อีเมลที่ทำงาน"><br>
        <input type="text" name="phonecomname" placeholder="เบอร์ที่ทำงาน"><br>
        
            <label for="sel1">จังหวัด:</label>
            <select class="form-control" name="Cef_prov_id" id="province">
                <option value="" selected disabled>-กรุณาเลือกจังหวัด-</option>
                <?php foreach ($query as $value) { ?>
                <option value="<?=$value['id']?>"><?=$value['name_th']?></option>

                <?php } ?>
            </select>
            <br>
    
        <label for="sel1">อำเภอ:</label>
        <select class="form-control" name="Cef_dist_id" id="amphure">
        </select>
        <br>
    
        <label for="sel1">ตำบล:</label>
        <select class="form-control" name="Cef_subdist_id" id="district">
        </select>
        <br>
    
        <label for="sel1">รหัสไปรษณีย์:</label>
        <input type="text" name="zip_code" id="zip_code1" class="form-control">
            <br>

        <label for="sel1">อัพโหลดรูปภาพ:</label>
        <input type="file" name="userimg" class="form-control streched-link" accept="image/gif, image/jpeg, image/png">
        <p class="small mb-0 mt-2"><b>Note :</b> เฉพาะไฟล์ประเภท JPG, JPEG, PNG และ GIF</p>
        <br>

        <button type="submit">ยืนยัน</button>
    </form>
</body>
</html>
<?php include('script.php');?>
