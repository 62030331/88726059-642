<?php
require_once("dbconfig.php");

// ตรวจสอบว่ามีการ post มาจากฟอร์ม ถึงจะเพิ่ม
if ($_POST){
    //$dcid = $_POST['dcid'];
    $dcnum = $_POST['dcnum'];
    $dctitle = $_POST['dctitle'];
    $dcstart = $_POST['dcstart'];
    $dcto = $_POST['dcto'];
    $dcstatus = $_POST['dcstatus'];
    $dcname = $_POST['dcname'];
    
    if ($_POST){
        echo "<pre>";
        print_r($_FILES);
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
          echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"]))." has been uploaded.";
         } else {
          echo "Sorry, there was an error uploading your file.";
                                                 
        }
      }                     
    // insert a record by prepare and bind
    // The argument may be one of four types:
    //  i - integer
    //  d - double
    //  s - string
    //  b - BLOB

    // ในส่วนของ INTO ให้กำหนดให้ตรงกับชื่อคอลัมน์ในตาราง actor
    // ต้องแน่ใจว่าคำสั่ง INSERT ทำงานใด้ถูกต้อง - ให้ทดสอบก่อน
    $sql = "INSERT 
            INTO documents (id , doc_num , doc_title, doc_start_date , doc_to_date , doc_status, doc_file_name) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("issssss", $dcid , $dcnum , $dctitle, $dcstart, $dcto, $dcstatus, $dcname);
    $stmt->execute();

    // redirect ไปยัง actor.php
    //header("location: document.php");
    header("location: addstafftodocument.php?id=".$mysqli->insert_id);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>php doc demo</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <h1>Add a document</h1>
        <form action="document_new.php" method="post">
            <div class="form-group">
                <label for="dcnum">รหัส</label>
                <input type="text" class="form-control" name="dcnum" id="dcnum">
            </div>
            <div class="form-group">
                <label for="dctitle">หัวข้อเอกสาร</label>
                <input type="text" class="form-control" name="dctitle" id="dctitle">
            </div>
            <div class="form-group">
                <label for="dcstart">วันที่เอกสาร</label>
                <input type="date" class="form-control" name="dcstart" id="dcstart">
            </div>
            <div class="form-group">
                <label for="dcto">ถึงวันที่</label>
                <input type="date" class="form-control" name="dcto" id="dcto">
            </div>
            <div class=" form-group">
                <label for="dcstatus">สถานะ</label>
                <input type="radio" name="dcstatus" id="dcstatus" value="Active">Active
                
                <input type="radio" name="dcstatus" id="dcstatus" value="Expire">Expire
                
            </div>
            <!-- <div class="form-group">
                <label for="dcname">ชื่อเอกสาร</label>
                <input type="text" class="form-control" name="dcname" id="dcname">
            </div> -->
            <div class="form-group">
                <label for="dcname">อัพไฟล์เอกสาร</label>
                <input type="file" class="form-control" name="dcname" id="dcname">
            </div>
            
            <button type="submit" class="btn btn-success">Save</button>
        </form>
</body>

</html>