<?php
include('server.php');
$db1=mysqli_stmt_init($db);
$id=$_GET['cvid'];
mysqli_stmt_prepare($db1, "SELECT id_korisnika FROM prijave JOIN oglasi ON id_o=id_oglas WHERE id_prijavljenog=?");
mysqli_stmt_bind_param($db1, "s", $id);
mysqli_stmt_execute($db1);
mysqli_stmt_bind_result($db1, $id_korisnika);
mysqli_stmt_fetch($db1);
$id_user=get_user_ID($_SESSION['username']);
if($id_user==$id_korisnika)
{
    $db1=mysqli_stmt_init($db);
    $id=$_GET['cvid'];
    mysqli_stmt_prepare($db1, "SELECT CV FROM radnik WHERE id_r=?");
    mysqli_stmt_bind_param($db1, "s", $id);
    mysqli_stmt_execute($db1);
    mysqli_stmt_bind_result($db1, $filename);
    mysqli_stmt_fetch($db1);
    $filename1= "CV/" . $filename;
    header("Content-Length: " . filesize ( $filename1 ) ); 
    header("Content-type: application/octet-stream"); 
    header("Content-disposition: attachment; filename=".basename($filename1));
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    ob_clean();
    flush();
    readfile($filename1);
}
else
{
    header("location: index.php");
    exit;
}