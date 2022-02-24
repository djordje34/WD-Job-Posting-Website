<?php
include('server.php');
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
if($_SESSION['choice']=='1'){
    header("location: indexp.php");
    exit;
}
if($_SESSION['choice']=='2'){
  header("location: indexr.php");
  exit;
}
$db = mysqli_connect('localhost', 'root','', 'dobra_baza');
$db1=mysqli_stmt_init($db);
mysqli_stmt_prepare($db1, "SELECT choice,username FROM users WHERE id_u=?");
mysqli_stmt_bind_param($db1, "s", $_GET["id"]);
mysqli_stmt_execute($db1);
mysqli_stmt_bind_result($db1, $choice,$username);
mysqli_stmt_fetch($db1);
if($choice==2) //radnik
{
    mysqli_stmt_prepare($db1, "DELETE FROM users WHERE users . id_u=?");
    mysqli_stmt_bind_param($db1, "s", $_GET["id"]);
    mysqli_stmt_execute($db1);

    mysqli_stmt_prepare($db1, "DELETE FROM radnik WHERE radnik . id_r=?");
    mysqli_stmt_bind_param($db1, "s", $_GET["id"]);
    mysqli_stmt_execute($db1);

    mysqli_stmt_prepare($db1, "DELETE FROM prijave WHERE prijave . id_prijavljenog=?");
    mysqli_stmt_bind_param($db1, "s", $_GET["id"]);
    mysqli_stmt_execute($db1);

    mysqli_stmt_prepare($db1, "UPDATE `komentari` SET `id_korisnika` = NULL WHERE `komentari`.`id_korisnika` = ?");
    mysqli_stmt_bind_param($db1, "s", $_GET["id"]);
    mysqli_stmt_execute($db1);
}
if($choice==1) //poslodavac
{
    mysqli_stmt_prepare($db1, "DELETE FROM users WHERE users . id_u=?");
    mysqli_stmt_bind_param($db1, "s", $_GET["id"]);
    mysqli_stmt_execute($db1);

    mysqli_stmt_prepare($db1, "DELETE FROM poslodavac WHERE poslodavac . id_p=?");
    mysqli_stmt_bind_param($db1, "s", $_GET["id"]);
    mysqli_stmt_execute($db1);

    mysqli_stmt_prepare($db1, "DELETE FROM oglasi WHERE oglasi . id_korisnika=?");
    mysqli_stmt_bind_param($db1, "s", $_GET["id"]);
    mysqli_stmt_execute($db1);

    mysqli_stmt_prepare($db1, "DELETE FROM firme WHERE firme . id_poslodavca=?");
    mysqli_stmt_bind_param($db1, "s", $_GET["id"]);
    mysqli_stmt_execute($db1);

    $id_firme=get_firma_ID($username);
    mysqli_stmt_prepare($db1, "DELETE FROM komentari WHERE komentari . id_firme=?");
    mysqli_stmt_bind_param($db1, "s", $id_firme);
    mysqli_stmt_execute($db1);
}
mysqli_stmt_close($db1);
header("location: indexa.php");
exit;