<?php include('condb.php'); ?>


<?php 
$sql = "SELECT u.userid, p.prefixaname, CONCAT(f.firstnamename, ' ', l.lastnamename) AS full_name, co.companyname, co.companyjob, mc.emailcomname, pc.phonecomname
FROM tbuser AS u
LEFT JOIN (
    SELECT MAX(historycomid) AS max_historycomid, userid
    FROM tbhistorycom
    GROUP BY userid
) AS latest_history_com ON u.userid = latest_history_com.userid
LEFT JOIN tbhistorycom AS htc ON latest_history_com.max_historycomid = htc.historycomid
LEFT JOIN (
    SELECT MAX(historyuserid) AS max_historyuserid, userid
    FROM tbhistoryuser
    GROUP BY userid
) AS latest_history_user ON u.userid = latest_history_user.userid
LEFT JOIN tbhistoryuser AS htu ON latest_history_user.max_historyuserid = htu.historyuserid
LEFT JOIN tbprefix AS p ON htu.prefixid = p.prefixid
LEFT JOIN tbfirstname AS f ON htu.firstnameid = f.firstnameid
LEFT JOIN tblastname AS l ON htu.lastnameid = l.lastnameid
LEFT JOIN tbcompany AS co ON htc.companyid = co.companyid
LEFT JOIN tbemailcom AS mc ON co.companyid = mc.companyid
LEFT JOIN tbphonecom AS pc ON co.companyid = pc.companyid
GROUP BY u.userid, htu.historyuserid, htc.historycomid;";
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
                <th>ชื่อสถานที่ทำงาน</th>
                <th>ตำแหน่ง</th>
                <th>อีเมลที่ทำงาน</th>
                <th>เบอร์ที่ทำงาน</th>
                
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
                <td><?php echo $row['companyname']; ?></td>
                <td><?php echo $row['companyjob']; ?></td>
                <td><?php echo $row['emailcomname']; ?></td>
                <td><?php echo $row['phonecomname']; ?></td>
                
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