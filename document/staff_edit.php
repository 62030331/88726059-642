<?php
require_once("dbconfig.php");

// ตรวจสอบว่ามีการ post มาจากฟอร์ม ถึงจะลบ
if ($_POST){
    $sid = $_POST['sid'];
    $stc = $_POST['stc'];
    $stn = $_POST['stn'];
    
    $sql = "UPDATE staff 
            SET  stf_code = ?,
                 stf_name = ?
            WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ssi", $stc, $stn, $sid);
    $stmt->execute();

    header("location: staff.php");
} else {
    $id = $_GET['id'];
    $sql = "SELECT *
            FROM staff
            WHERE id = ?";

    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_object();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>php edit stf demo</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <h1><a href='staff.php'><span class='glyphicon glyphicon-arrow-left'></span></a>Edit a staff</h1>
        <form action="staff_edit.php" method="post">
            <div class="form-group">
                <label for="sid">id</label>
                <input type="int" class="form-control" name="sid" id="sid" value="<?php echo $row->id;?>">
            </div>
            <div class="form-group">
                <label for="stc">staffcode</label>
                <input type="text" class="form-control" name="stc" id="stc" value="<?php echo $row->stf_code;?>">
            </div>
            <div class="form-group">
                <label for="stn">staffname</label>
                <input type="text" class="form-control" name="stn" id="stn" value="<?php echo $row->stf_name;?>">
            </div>
            <input type="hidden" name="sid" value="<?php echo $row->id;?>">
            <button type="submit" class="btn btn-success">Update</button>
        </form>
</body>

</html>