<?php include('condb.php'); ?>
<?php include 'navbar-user.php'; ?>

<?php 
$sql = "SELECT u.userid, u.loginid, p.prefixaname, CONCAT(f.firstnamename,' ', l.lastnamename) AS full_name,
ca.campusname, gr.groupname, br.branchname, co.coursename, emailusername, phoneusername ,userimg
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
    <!-- Custom CSS for detail box -->
    <style>
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .detail-box {
            flex: 0 0 calc(33.33% - 10px);
            border: 1px solid #ccc;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 10px;
        }

        .detail-box h5 {
            margin-top: 0;
            margin-bottom: 10px;
        }

        .detail-box p {
            margin-bottom: 5px;
        }

        .detail-box img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }
        #search-input {
            width: 400px; /* ปรับความกว้างตามที่ต้องการ */
        }
</style>

    </style>
</head>
<body>
    <br>
<div class="container justify-content-center">
    <form id="search-form" class="mb-3">
        <div class="input-group">
            <input type="text" class="form-control" id="search-input" placeholder="ค้นหาจากชื่อหรือข้อมูลอื่น ๆ">
            <button type="submit" class="btn btn-primary">ค้นหา</button>
        </div>
    </form>
</div>

    <div class="container">
        <?php while($row = mysqli_fetch_assoc($query_sql)) { ?>
            <div class="detail-box">
                <h5>ชื่อ : <?php echo $row['prefixaname']; ?> <?php echo $row['full_name']; ?></h5>
                <img src="Uploads/<?php echo $row['userimg']; ?>" alt="&nbsp;&nbsp;ยังไม่มีภาพ">
                <p>วิทยาเขต : <?php echo $row['campusname']; ?></p>
                <p>คณะ : <?php echo $row['groupname']; ?></p>
                <p>สาขา : <?php echo $row['branchname']; ?></p>
                <p>หลักสูตร : <?php echo $row['coursename']; ?></p>
                <p>อีเมล : <?php echo $row['emailusername']; ?></p>
                <p>เบอร์ติดต่อ : <?php echo $row['phoneusername']; ?></p>
            </div>
        <?php } ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#search-form').on('submit', function(e) {
                e.preventDefault();
                var searchValue = $('#search-input').val().trim().toLowerCase();
                $('.detail-box').each(function() {
                    var fullName = $(this).find('h5').text().trim().toLowerCase();
                    var campusName = $(this).find('p:eq(0)').text().trim().toLowerCase();
                    var groupName = $(this).find('p:eq(1)').text().trim().toLowerCase();
                    var branchName = $(this).find('p:eq(2)').text().trim().toLowerCase();
                    var courseName = $(this).find('p:eq(3)').text().trim().toLowerCase();
                    var email = $(this).find('p:eq(4)').text().trim().toLowerCase();
                    var phoneNumber = $(this).find('p:eq(5)').text().trim().toLowerCase();

                    if (fullName.includes(searchValue) || campusName.includes(searchValue) || groupName.includes(searchValue) || branchName.includes(searchValue) || courseName.includes(searchValue) || email.includes(searchValue) || phoneNumber.includes(searchValue)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
        });
    </script>
</body>
</html>
