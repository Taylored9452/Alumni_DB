<?php include('condb.php'); ?>

<?php
  
  if (isset($_POST['function']) && $_POST['function'] == 'provinces') {
  	$id = $_POST['id'];
  	$sql = "SELECT * FROM amphures WHERE province_id='$id'";
  	$query = mysqli_query($conn, $sql);
  	echo '<option value="" selected disabled>-กรุณาเลือกอำเภอ-</option>';
  	foreach ($query as $value) {
  		echo '<option value="'.$value['id'].'">'.$value['name_th'].'</option>';
  		
  	}
  }
 
 
if (isset($_POST['function']) && $_POST['function'] == 'amphures') {
    $id = $_POST['id'];
    $sql = "SELECT * FROM districts WHERE amphure_id='$id'";
    $query = mysqli_query($conn, $sql);
    echo '<option value="" selected disabled>-กรุณาเลือกตำบล-</option>';
    foreach ($query as $value2) {
      echo '<option value="'.$value2['id'].'">'.$value2['name_th'].'</option>';
      
    }
  }
 
  if (isset($_POST['function']) && $_POST['function'] == 'districts') {
    $id = $_POST['id'];
    $sql = "SELECT * FROM districts WHERE id='$id'";
    $query3 = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($query3);
    echo $result['zip_code'];
    exit();
  }
?>

<?php
  
  if (isset($_POST['function']) && $_POST['function'] == 'tbcampus') {
  	$id = $_POST['groupid'];
  	$sql = "SELECT * FROM tbgroup WHERE campusid='$id'";
  	$query2 = mysqli_query($conn, $sql);
  	echo '<option value="" selected disabled>-กรุณาเลือกคณะ-</option>';
  	foreach ($query2 as $value4) {
  		echo '<option value="'.$value4['groupid'].'">'.$value4['groupname'].'</option>';
  		
  	}
  }
 
 
  if (isset($_POST['function']) && $_POST['function'] == 'tbgroup') {
    $id = $_POST['branchid'];
    $sql = "SELECT * FROM tbbranch WHERE groupid='$id'";
    $query2 = mysqli_query($conn, $sql);
    echo '<option value="" selected disabled>-กรุณาเลือกสาขา-</option>';
    foreach ($query2 as $value5) {
      echo '<option value="'.$value5['branchid'].'">'.$value5['branchname'].'</option>';
      
    }
  }
 
  if (isset($_POST['function']) && $_POST['function'] == 'tbbranch') {
    $id = $_POST['courseid'];
    $sql = "SELECT * FROM tbcourse WHERE branchid='$id'";
    $query2 = mysqli_query($conn, $sql);
    echo '<option value="" selected disabled>-กรุณาเลือกหลักสูตร-</option>';
    foreach ($query2 as $value6) {
      echo '<option value="'.$value6['courseid'].'">'.$value6['coursename'].'</option>';
      
    }
  }
?>

<?php
  
  if (isset($_POST['function']) && $_POST['function'] == 'province') {
  	$id = $_POST['id'];
  	$sql = "SELECT * FROM amphures WHERE province_id='$id'";
  	$query = mysqli_query($conn, $sql);
  	echo '<option value="" selected disabled>-กรุณาเลือกอำเภอ-</option>';
  	foreach ($query as $value) {
  		echo '<option value="'.$value['id'].'">'.$value['name_th'].'</option>';
  		
  	}
  }
 
 
if (isset($_POST['function']) && $_POST['function'] == 'amphure') {
    $id = $_POST['id'];
    $sql = "SELECT * FROM districts WHERE amphure_id='$id'";
    $query = mysqli_query($conn, $sql);
    echo '<option value="" selected disabled>-กรุณาเลือกตำบล-</option>';
    foreach ($query as $value2) {
      echo '<option value="'.$value2['id'].'">'.$value2['name_th'].'</option>';
      
    }
  }
 
  if (isset($_POST['function']) && $_POST['function'] == 'district') {
    $id = $_POST['id'];
    $sql = "SELECT * FROM districts WHERE id='$id'";
    $query3 = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($query3);
    echo $result['zip_code'];
    exit();
  }
?>