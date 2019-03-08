<?php
$count = count($_FILES["file"]["name"]);
print_r($_POST);
print_r($_FILES["file"]);
echo  count($_FILES["file"]["name"]);
for ($x = 0; $x < $count ; $x++){
print_r($_FILES['file']);

    if (isset($_FILES["file"]) && !empty($_FILES["file"])) {
        echo $_POST["label"];
        $upload_dir = "images";
        move_uploaded_file($_FILES["file"]["tmp_name"][$x], $upload_dir . "/" . $_FILES["file"]["name"][$x]);

    }



 }

?>