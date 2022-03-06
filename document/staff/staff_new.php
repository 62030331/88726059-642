<?php
require_once("dbconfig.php");

// ตรวจสอบว่ามีการ post มาจากฟอร์ม ถึงจะเพิ่ม
if ($_POST){
    $stfid = $_POST['stfid'];
    $stfcode = $_POST['stfcode'];
    $stfname = $_POST['stfname'];

    // insert a record by prepare and bind
    // The argument may be one of four types:
    //  i - integer
    //  d - double
    //  s - string
    //  b - BLOB

    // ในส่วนของ INTO ให้กำหนดให้ตรงกับชื่อคอลัมน์ในตาราง actor
    // ต้องแน่ใจว่าคำสั่ง INSERT ทำงานใด้ถูกต้อง - ให้ทดสอบก่อน
    $sql = "INSERT 
            INTO staff (stf_code , stf_name) 
            VALUES (?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ss", $stfcode, $stfname);
    $stmt->execute();

    // redirect ไปยัง actor.php
    header("location: staff.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>php stf demo</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <h1>Add a staff</h1>
        <form action="staff_new.php" method="post">
            <!-- <div class="form-group">
                <label for="stfid">id</label>
                <input type="text" class="form-control" name="stfid" id="stfid">
            </div> -->
            <div class="form-group">
                <label for="stfcode">Staff Code</label>
                <input type="text" class="form-control" name="stfcode" id="stfcode">
            </div>
            <div class="form-group">
                <label for="stfname">Staff Name</label>
                <input type="text" class="form-control" name="stfname" id="stfname">
            </div>
            
            <button type="submit" class="btn btn-success">Save</button>
        </form>
</body>

</html>