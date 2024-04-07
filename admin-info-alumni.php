<?php include('condb.php'); ?>


<?php 
$sql = "SELECT u.userid, u.loginid, p.prefixaname, CONCAT(f.firstnamename,' ', l.lastnamename) AS full_name,
CONCAT(ca.campusname,' ', gr.groupname,' ', br.branchname,' ', co.coursename) AS full_campus, 
emailusername, phoneusername, typename
FROM tbuser AS u
LEFT JOIN (
SELECT MAX(historyuserid) AS max_historyuserid, userid
FROM tbhistoryuser
GROUP BY userid
) AS latest_history ON u.userid = latest_history.userid
LEFT JOIN tbhistoryuser AS htu ON latest_history.max_historyuserid = htu.historyuserid
LEFT JOIN tbprefix AS p ON htu.prefixid = p.prefixid
LEFT JOIN tbfirstname AS f ON htu.firstnameid = f.firstnameid
LEFT JOIN tblastname AS l ON htu.lastnameid = l.lastnameid
LEFT JOIN tbcourse AS co ON u.courseid = co.courseid
LEFT JOIN tbbranch AS br ON co.branchid = br.branchid
LEFT JOIN tbgroup AS gr ON br.groupid = gr.groupid
LEFT JOIN tbcampus AS ca ON gr.campusid = ca.campusid
LEFT JOIN tblogin AS lo ON u.loginid = lo.loginid
LEFT JOIN tbtype AS ty ON lo.typeid = ty.typeid
LEFT JOIN tbemailuser AS mu ON htu.historyuserid = mu.historyuserid
LEFT JOIN tbphoneuser AS pu ON htu.historyuserid = pu.historyuserid
ORDER BY u.userid, htu.historyuserid ;";
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
                <th>ผู้ใช้</th>
                <th>คำนำหน้า</th>
                <th>ชื่อ นามสกุล</th>
                <th>มหาวิทยาลัยจบการศึกษา</th>
                <th>อีเมล</th>
                <th>เบอร์ติดต่อ</th>
                <th>สถาณะ</th>
                <th>ลบ</th>
            </thead>
        <tbody>
    <?php
    while($row = mysqli_fetch_assoc($query_sql)) {
    ?>
            <tr>
                <td><?php echo $row['userid']; ?></td>
                <td><?php echo $row['loginid']; ?></td>
                <td><?php echo $row['prefixaname']; ?></td>
                <td class="name"><?php echo $row['full_name'];?></td>
                <td class="name"><?php echo $row['full_campus'];?></td> 
                <td><?php echo $row['emailusername']; ?></td>
                <td><?php echo $row['phoneusername']; ?></td>
                <td><?php echo $row['typename']; ?></td>
                <td><a href="delete-alumni.php?userid=<?php echo $row['userid']; ?>&loginid=<?php echo $row['loginid']; ?>" class="btn btn-danger btn-sm">ลบ</a></td> <!-- เพิ่มส่วนนี้ในการแสดงปุ่มแก้ไขในแต่ละแถว -->
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
        // let table = new DataTable('#user');
        $(document).ready(function() {
        let table = $('#user').DataTable({
            "columnDefs": [
                { "targets": [1], "visible": false } // ซ่อนคอลัมน์ที่สอง (ดัชนี 1)
            ]
        });
    });
    </script>
</body>
</html>