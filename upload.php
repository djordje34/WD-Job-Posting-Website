<?php
include('server.php');
$_SESSION['uploadstatus']='';
// Slika
if(isset($_POST["submit"]))
{
    $username=$_SESSION['username'];
    $target_dir = "slike/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false)
    {
        $uploadOk = 1;
    }
    else
    {
        $_SESSION['uploadstatus'] = "File is not an image.";
        $uploadOk = 0;
    }
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000)
{
    $_SESSION['uploadstatus'] = "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" )
{
    $_SESSION['uploadstatus'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0)
{
    $_SESSION['uploadstatus'] . "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
}
else
{
    $temp = explode(".", $_FILES["fileToUpload"]["name"]);
    $dbname=$_SESSION['username'] .'.' .end($temp);
    $newfilename =$target_dir . $dbname;
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"] ,$newfilename))
    {
        $_SESSION['uploadstatus'] = "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
        $id_firme=get_firma_ID($username);
        $db1=mysqli_stmt_init($db);
        mysqli_stmt_prepare($db1, "UPDATE firme SET slika=? WHERE id_f=?");
        mysqli_stmt_bind_param($db1, "ss", $dbname, $id_firme);
        mysqli_stmt_execute($db1);
        mysqli_stmt_close($db1);
    }
    else
    {
        $_SESSION['uploadstatus'] = "Sorry, there was an error uploading your file.";
    }
}
}
//CV
if(isset($_POST["submitCV"]))
{
    $username=$_SESSION['username'];
    $target_dir = "CV/";
    $target_file = $target_dir . basename($_FILES["fileToUploadCV"]["name"]);
    $uploadOk = 1;
    $file_type=$_FILES['fileToUploadCV']['type'];
    if ($file_type=="application/pdf")
    {
        $uploadOk = 1;
    }
    else
    {
        $_SESSION['uploadstatus'] = "File is not an PDF.";
        $uploadOk = 0;
    }
// Check file size
if ($_FILES["fileToUploadCV"]["size"] > 5000000)
{
    $_SESSION['uploadstatus'] = "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0)
{
    $_SESSION['uploadstatus'] . "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
}
else
{
    $temp = explode(".", $_FILES["fileToUploadCV"]["name"]);
    $dbname=$_SESSION['username'] .'.' .end($temp);
    $newfilename =$target_dir . $dbname;
    if (move_uploaded_file($_FILES["fileToUploadCV"]["tmp_name"] ,$newfilename))
    {
        $_SESSION['uploadstatus'] = "The file ". htmlspecialchars( basename( $_FILES["fileToUploadCV"]["name"])). " has been uploaded.";
        $id_user=get_user_ID($username);
        $db1=mysqli_stmt_init($db);
        mysqli_stmt_prepare($db1, "UPDATE radnik SET CV=? WHERE id_r=?");
        mysqli_stmt_bind_param($db1, "ss", $dbname, $id_user);
        mysqli_stmt_execute($db1);
        mysqli_stmt_close($db1);
    }
    else
    {
        $_SESSION['uploadstatus'] = "Sorry, there was an error uploading your file.";
    }
}
}
echo "<!DOCTYPE html>
<html lang='en'>
<head>
</head>
<body>
<script> alert('$_SESSION[uploadstatus]');
location.href='indexp.php'; </script>
</body>
</html>";
?>