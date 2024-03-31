<?php include('condb.php'); ?>


<?php 
$sql = "SELECT userid , p.prefixaname, CONCAT(f.firstnamename,' ', l.lastnamename) AS full_name ,  
ca.campusname , gr.groupname , br.branchname , co.coursename , userbirthday , usercitizen , typename
FROM tbuser as u
join tbhistoryuser as htu on u.historyuserid = htu.historyuserid
join tbprefix as p on htu.prefixid = p.prefixid
join tbfirstname as f on htu.firstnameid = f.firstnameid
join tblastname as l on htu.lastnameid = l.lastnameid
join tbcourse as co on u.courseid = co.courseid
join tbbranch as br on co.branchid = br.branchid
join tbgroup as gr on br.groupid = gr.groupid
join tbcampus as ca on gr.campusid = ca.campusid
join tblogin as lo on u.loginid = lo.loginid
join tbtype as ty on lo.typeid = ty.typeid";
$query_sql = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Shop Homepage - Start Bootstrap Template</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@5.3.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <!-- Css datatable.net-->
        <link href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.min.css" rel="stylesheet" />
</head>
<body>
    <div class="container">
        <h3 class="mt-4">ตารางข้อมูลศิษย์เก่า</h3>
        <table id="user" class="table table-striped">
            <thead>
                <th>ลำดับ</th>
                <th>คำนำหน้า</th>
                <th>ชื่อ นามสกุล</th>
                <th>วิทยาเขต</th>
                <th>คณะ</th>
                <th>สาขา</th>
                <th>หลักสูตร</th>
                <th>เลขบัตรประชาชน</th>
                <th>ประเภทผู้ใช้</th>
                <th>แก้ไข</th>
                <th>ลบ</th>
            </thead>
        <tbody>
    <?php
    while($row = mysqli_fetch_assoc($query_sql)) {
    ?>
            <tr>
                <td><?php echo $row['userid']; ?></td>
                <td><?php echo $row['prefixaname']; ?></td>
                <td class="name"><?php echo $row['full_name'];?></td>
                <td><?php echo $row['campusname']; ?></td>
                <td><?php echo $row['groupname']; ?></td>
                <td><?php echo $row['branchname']; ?></td>
                <td><?php echo $row['coursename']; ?></td>
                <td><?php echo $row['usercitizen']; ?></td>
                <td><?php echo $row['typename']; ?></td>
                <td><a href="edit.php?userid=<?php echo $row['userid']; ?>" class="btn btn-primary btn-sm">แก้ไข</a></td> <!-- เพิ่มส่วนนี้ในการแสดงปุ่มแก้ไขในแต่ละแถว -->
                <td><a href="delete.php?userid=<?php echo $row['userid']; ?>" class="btn btn-danger btn-sm">ลบ</a></td> <!-- เพิ่มส่วนนี้ในการแสดงปุ่มแก้ไขในแต่ละแถว -->
            </tr>
    <?php
        }
    ?>
            </tbody>
        </table>
        </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.min.js"></script>
    <script>
        let table = new DataTable('#user');
    </script>
</body>
</html>