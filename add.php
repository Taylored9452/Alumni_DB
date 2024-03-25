<?php include('condb.php'); ?>

<?php 

    $sql_provinces = "SELECT * FROM provinces";
    $query = mysqli_query($conn, $sql_provinces);
// ตรวจสอบว่าฟอร์มถูกส่งมาหรือไม่
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // เก็บข้อมูลจากฟอร์ม
    
    //$prefixname = $_POST['prefixname']; 
    //$prefixaname = $_POST['prefixaname']; 

    $firstnamename = $_POST['firstnamename']; 

    $lastnamename = $_POST['lastnamename']; 

    // ดำเนินการ SQL insert
    //$sql1 = "INSERT INTO tbprefix (prefixid, prefixname, prefixaname) VALUES ('', '$prefixname', '$prefixaname')";
    //$result1 = mysqli_query($conn, $sql1) or die ("Error in query: $sql1" . mysqli_error());

    $sql1 = "SELECT p.prefixaname
    FROM tbuser as u
    join tbhistoryuser as htu on u.historyuserid = htu.historyuserid
    join tbprefix as p on htu.prefixid = p.prefixid";
    $result1 = mysqli_query($conn, $sql1) or die ("Error in query: $sql1" . mysqli_error());
    
    $sql2 = "INSERT INTO tbfirstname (firstnameid, firstnamename) VALUES ('', '$firstnamename')";
    $result2 = mysqli_query($conn, $sql2) or die ("Error in query: $sql2" . mysqli_error());

    $sql3 = "INSERT INTO tblastname (lastnameid, lastnamename) VALUES ('', '$lastnamename')";
    $result3 = mysqli_query($conn, $sql3) or die ("Error in query: $sql3" . mysqli_error());

    
    
    mysqli_close($conn);

    // ตรวจสอบว่าการแทรกสำเร็จหรือไม่
    // if ($result1 && $result2 && $result3 ){
    if ($result4){
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
        <select name="tbprefix" class="custom-dropdown">
            <?php
            // วนลูปเพื่อแสดงตัวเลือกใน dropdown
            $prefixaname = mysqli_query($conn, "Select * from tbprefix");
            while($row = mysqli_fetch_assoc($prefixaname)) {
            ?>
            <option value="<?php echo $row['prefixid'] ?>"><?php echo $row['prefixname'] ?></option>
            <?php } ?>
        </select><br><br>

        <input type="text" name="firstnamename" placeholder="ชื่อ"><br>
        <input type="text" name="lastnamename" placeholder="นามสกุล"><br>
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

        <input type="email" name="emailusername" placeholder="อีเมล"><br>
        <input type="text" name="phoneusername" placeholder="เบอร์ติดต่อ"><br>
        <input type="text" name="campusname" placeholder="วิทยาเขต"><br>
        <input type="text" name="groupname" placeholder="คณะ"><br>
        <input type="text" name="branchname" placeholder="สาขา"><br>
        <input type="text" name="coursename" placeholder="หลักสูตร"><br>
        <input type="text" name="usercitizen" placeholder="เลขบัตรประชาชน"><br>
        <input type="text" name="companyname" placeholder="ชื่อสถานที่ทำงาน"><br>
        <input type="text" name="companyjob" placeholder="ตำแหน่ง"><br>
        <input type="text" name="emailcomname" placeholder="อีเมลที่ทำงาน"><br>
        <input type="text" name="phonecomname" placeholder="เบอร์ที่ทำงาน"><br>
        
        
        <button type="submit">ยืนยัน</button>
    </form>
</body>
</html>
<?php include('script.php');?>
