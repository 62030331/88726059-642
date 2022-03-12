<?php
require_once("dbconfig.php");

// ตรวจสอบว่ามีการ post มาจากฟอร์ม ถึงจะลบ
if ($_POST){
    $dcid = $_POST['dcid'];
    $dcnum = $_POST['dcnum'];
    $dctitle = $_POST['dctitle'];
    $dcstart = $_POST['dcstart'];
    $dcto = $_POST['dcto'];
    $dcstatus = $_POST['dcstatus'];
    $dcname = $_POST['dcname'];
    

    $sql = "UPDATE documents 
            SET doc_num  = ?,
            doc_title = ?,
            doc_start_date = ?,
            doc_to_date = ?,
            doc_status = ?,
            doc_file_name = ?
            WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ssssssi", $dcnum , $dctitle, $dcstart, $dcto, $dcstatus, $dcname ,$dcid );
    $stmt->execute();

    header("location: document.php");
} else {
    $id = $_GET['id'];
    $sql = "SELECT *
            FROM documents
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
    <title>php db demo</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <h1>Edit a document</h1>
        <form action="document_edit.php" method="post">
            
            <div class="form-group">
                <label for="dcnum">เลขที่คำสั่ง</label>
                <input type="text" class="form-control" name="dcnum" id="dcnum"value="<?php echo $row->doc_num ;?>">
            </div>
            <div class="form-group">
                <label for="dctitle">ชื่อคำสั่ง</label>
                <input type="text" class="form-control" name="dctitle" id="dctitle"value="<?php echo $row->doc_title;?>">
            </div>
            <div class="form-group">
                <label for="dcstart">วันที่เริ่มต้น</label>
                <input type="date" class="form-control" name="dcstart" id="dcstart"value="<?php echo $row->doc_start_date;?>">
            </div>
            <div class="form-group">
                <label for="dcto">วันที่สิ้นสุด</label>
                <input type="date" class="form-control" name="dcto" id="dcto"value="<?php echo $row->doc_to_date;?>">
            </div>
            <!-- <div class="form-group">
                <label for="dcstatus">สถานะ</label>
                <input type="text" class="form-control" name="dcstatus" id="dcstatus"value="<?php echo $row->doc_status;?>">
            </div> -->
            <div class=" form-group">
                <label for="dcstatus">สถานะ</label>
                <input type="radio" name="dcstatus" id="dcstatus" value="Active"
                <?php if($row->doc_status == "Active"){echo "checked";}?>> Active
                <input type="radio" name="dcstatus" id="dcstatus" value="Expire"
                <?php if($row->doc_status == "Expire"){echo "checked";}?>> Expire
            </div>
            <div class="form-group">
                <label for="dcname">อัพไฟล์เอกสาร</label>
                <input type="file" class="form-control" name="dcname" id="dcname"value="<?php echo $row->doc_file_name;?>">
            </div>
            <input type="hidden" name="dcid" value="<?php echo $row->id;?>">
            <button type="submit" class="btn btn-success">Update</button>
        </form>
</body>

</html>