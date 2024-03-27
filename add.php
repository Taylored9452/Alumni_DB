<?php include('condb.php'); ?>

<?php 

    $sql_provinces = "SELECT * FROM provinces";
    $query = mysqli_query($conn, $sql_provinces);
// ตรวจสอบว่าฟอร์มถูกส่งมาหรือไม่
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // เก็บข้อมูลจากฟอร์ม

     echo '<pre>';
     print_r($_POST);
     echo '</pre>';

    $prefixid = $_POST['prefixid']; 
     
    $firstnamename = $_POST['firstnamename']; 

    $lastnamename = $_POST['lastnamename'];
    
    $emailusername = $_POST['emailusername'];

    $provinces = $_POST['Ref_prov_id'];

    $amphures = $_POST['Ref_dist_id'];

    $districts = $_POST['Ref_subdist_id'];

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

    $sql4 = "INSERT INTO tbhistoryuser (prefixid, firstnameid, lastnameid) VALUES ('$prefixid', '$firstnamename_id', '$lastnamename_id')"; //นำข้อมูลจำเป็นใน tbhistoryuser เข้าก่อน
    $result4 = mysqli_query($conn, $sql4) or die ("Error in query: $sql4" . mysqli_error());

    $historyuser_id = mysqli_insert_id($conn);  //คำสั่งดึง id ตัวล่าสุด mysqli_insert_id

    echo $historyuser_id;

    $sql5 = "INSERT INTO tbemailuser (emailusername, historyuserid) VALUES ('$emailusername', '$historyuser_id')";  //นำเข้าข้อมูลโดยใช้ historyuser_id ล่าสุด
    $result5 = mysqli_query($conn, $sql5) or die ("Error in query: $sql5" . mysqli_error());

    $sql6 = "INSERT INTO tbphoneuser (phoneusername, historyuserid) VALUES ('$phoneusername', '$historyuser_id')";
    $result6 = mysqli_query($conn, $sql6) or die ("Error in query: $sql6" . mysqli_error());
    
    mysqli_close($conn);

    // ตรวจสอบว่าการแทรกสำเร็จหรือไม่
    if ( $result2 && $result3 && $result4 && $result5 && $result6 ){
        echo "<script type='text/javascript'>";
        echo "alert('successfully');";
        echo"window.location = 'add.php';";
        echo "</script>";
        }
        else {
        //กำหนดเงื่อนไขว่าถ้าไม่สำเร็จให้ขึ้นข้อความและกลับไปหน้าเพิ่ม
        echo "<script type='text/javascript'>";
        echo "alert('error!');";
        echo"window.location = 'add.php'; ";
        echo"</script>";
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
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <select name="prefixid" id="prefixDropdown" class="custom-dropdown">
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


        <input type="text" name="firstnamename" placeholder="ชื่อ"><br>
        <input type="text" name="lastnamename" placeholder="นามสกุล"><br>
        <input type="email" name="emailusername" placeholder="อีเมล"><br>
        <input type="text" name="phoneusername" placeholder="เบอร์ติดต่อ"><br>
        <input type="text" name="useraddress" placeholder="ที่อยู่"><br>
         
        
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
                <?php foreach ($query as $value) { ?>
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
        
        <input type="text" name="campusname" placeholder="วิทยาเขต"><br>
        <input type="text" name="groupname" placeholder="คณะ"><br>
        <input type="text" name="branchname" placeholder="สาขา"><br>
        <input type="text" name="coursename" placeholder="หลักสูตร"><br>
        <input type="text" name="usercitizen" placeholder="เลขบัตรประชาชน"><br>
        <input type="text" name="companyname" placeholder="ชื่อสถานที่ทำงาน"><br>
        <input type="text" name="companyjob" placeholder="ตำแหน่ง"><br>
        <input type="text" name="emailcomname" placeholder="อีเมลที่ทำงาน"><br>
        <input type="text" name="phonecomname" placeholder="เบอร์ที่ทำงาน"><br>
        
        <!-- <input type="hidden" name="prefixid" id="prefixid"> -->

        <button type="submit">ยืนยัน</button>
    </form>
</body>
</html>
<?php include('script.php');?>
