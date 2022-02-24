<?php
include('server.php');
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
$db1=mysqli_stmt_init($db);
mysqli_stmt_prepare($db1, "DELETE FROM prijave WHERE prijave . id_pr=?");
mysqli_stmt_bind_param($db1, "s", $_GET["id"]);
mysqli_stmt_execute($db1);
mysqli_stmt_close($db1);
if($_SESSION['choice']==1)
{
    echo "<html><head><script>window.location.href='prikaziprijave.php?id='+$_GET[ogl];</script></head></html>";
}
if($_SESSION['choice']==2)
{
    header("location: prijave.php");
}
?>