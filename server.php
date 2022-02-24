<?php
session_start();


// initializing variables
$username = "";
$email    = "";
$errors = array(); 
$choice="";
date_default_timezone_set('Europe/Belgrade');
// connect to the database
$db = mysqli_connect('localhost', 'root','', 'dobra_baza');
mysqli_set_charset($db, 'utf8mb4');
function get_user_ID($korisnik)
{
  $id_user='';
  $db = mysqli_connect('localhost', 'root','', 'dobra_baza');
  $db1=mysqli_stmt_init($db);
  mysqli_stmt_prepare($db1, "SELECT id_u FROM users WHERE username=?");
  mysqli_stmt_bind_param($db1, "s", $korisnik);
  mysqli_stmt_execute($db1);
  mysqli_stmt_bind_result($db1, $id_user);
  mysqli_stmt_fetch($db1);
  return $id_user;
}
function get_firma_ID($poslodavac)
{
  $db = mysqli_connect('localhost', 'root','', 'dobra_baza');
  $id_user=get_user_ID($poslodavac);
  $id_firme='';
  $db = mysqli_connect('localhost', 'root','', 'dobra_baza');
  $db1=mysqli_stmt_init($db);
  mysqli_stmt_prepare($db1, "SELECT id_f FROM firme WHERE id_poslodavca=?");
  mysqli_stmt_bind_param($db1, "s", $id_user);
  mysqli_stmt_execute($db1);
  mysqli_stmt_bind_result($db1, $id_firme);
  mysqli_stmt_fetch($db1);
  mysqli_stmt_close($db1);
  return $id_firme;
}
function check_if_user_commented($korisnik,$imeKompanije)
{
  $db = mysqli_connect('localhost', 'root','', 'dobra_baza');
  $db1=mysqli_stmt_init($db);
  $id=get_user_ID($korisnik);
  mysqli_stmt_prepare($db1, "SELECT id_f FROM firme WHERE Naziv_firme=?");
  mysqli_stmt_bind_param($db1, "s", $imeKompanije);
  mysqli_stmt_execute($db1);
  mysqli_stmt_bind_result($db1, $id_firme);
  mysqli_stmt_fetch($db1);
  mysqli_stmt_prepare($db1, "SELECT id_k FROM komentari WHERE id_korisnika=? AND id_firme=?");
  mysqli_stmt_bind_param($db1, "ss", $id, $id_firme);
  mysqli_stmt_execute($db1);
  mysqli_stmt_bind_result($db1, $user);
  mysqli_stmt_fetch($db1);
  mysqli_stmt_close($db1);
  if($user)
  return true;
  else
  return false;
}
// REGISTER USER
if (isset($_POST['reg_user']))
{
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
  $choice=$_POST['choice'];

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password)) { array_push($errors, "Password is required"); }
  if (empty($choice)) { array_push($errors, "Morate da izaberete"); }
  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $db1=mysqli_stmt_init($db);
  mysqli_stmt_prepare($db1, "SELECT id_u FROM users WHERE username=? OR email=? LIMIT 1");
  mysqli_stmt_bind_param($db1, "ss", $username, $email);
  mysqli_stmt_execute($db1);
  mysqli_stmt_bind_result($db1, $user);
  mysqli_stmt_fetch($db1);
  if ($user) // if user exists
  {
    array_push($errors, "Username ili email vec postoji.");
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0)
  {
    $hashed_password = password_hash($password,PASSWORD_BCRYPT);//encrypt the password before saving in the database
    if($choice==1)
    {
      mysqli_stmt_prepare($db1, "INSERT INTO users (username, email, password,choice) VALUES(?,?,?,?)");
      mysqli_stmt_bind_param($db1, "sssi", $username, $email,$hashed_password,$choice);
      mysqli_stmt_execute($db1);

      $id=get_user_ID($username);
      mysqli_stmt_prepare($db1, "INSERT INTO poslodavac (id_p) VALUES(?)");
      mysqli_stmt_bind_param($db1, "s", $id);
      mysqli_stmt_execute($db1);

      mysqli_stmt_prepare($db1, "INSERT INTO firme (Naziv_firme,id_poslodavca) VALUES(?,?)");
      mysqli_stmt_bind_param($db1, "ss", $username, $id);
      mysqli_stmt_execute($db1);
    }
    else if($choice==2)
    {
      mysqli_stmt_prepare($db1, "INSERT INTO users (username, email, password,choice) VALUES(?,?,?,?)");
      mysqli_stmt_bind_param($db1, "sssi", $username, $email,$hashed_password,$choice);
      mysqli_stmt_execute($db1);

      $id=get_user_ID($username);
      mysqli_stmt_prepare($db1, "INSERT INTO radnik (id_r) VALUES(?)");
      mysqli_stmt_bind_param($db1, "s", $id);
      mysqli_stmt_execute($db1);
    }
    mysqli_stmt_close($db1);
  	header('location: login.php');
  }
}
// LOGIN USER
if (isset($_POST['login_user']))
{
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0)
  {
    $db1=mysqli_stmt_init($db);
    mysqli_stmt_prepare($db1, "SELECT password,choice,kontakt FROM users WHERE username=?");
    mysqli_stmt_bind_param($db1, "s", $username);
    mysqli_stmt_execute($db1);
    mysqli_stmt_bind_result($db1, $passworddb, $choice, $kontakt);
    mysqli_stmt_fetch($db1);
    if (password_verify($password, $passworddb))
    {
      echo "Password verified!";
  	  $_SESSION['username'] = $username;
      $_SESSION['choice'] = $choice;
  	  $_SESSION['success'] = "You are now logged in";
      $_SESSION['loggedin']= true;
      $checker=1;
      $id=get_user_ID($username);
      if($_SESSION['choice']=='1')
      {
        mysqli_stmt_prepare($db1, "SELECT struka,Naziv_firme FROM poslodavac JOIN firme f ON poslodavac.id_p=f.id_poslodavca  WHERE poslodavac.id_p=?");
        mysqli_stmt_bind_param($db1, "s", $id);
        mysqli_stmt_execute($db1);
        mysqli_stmt_bind_result($db1, $_SESSION['struka'], $_SESSION['naziv']);
        mysqli_stmt_fetch($db1);
        $_SESSION['kontakt']=  $kontakt;
        $_SESSION['kontakt2']=explode("-",$_SESSION['kontakt'],2)[1];
      }
      else if($_SESSION['choice']=='2')
      {
        mysqli_stmt_prepare($db1, "SELECT Ime,informacije,polozaj,iskustvo,obrazovanje FROM radnik WHERE id_r=?");
        mysqli_stmt_bind_param($db1, "s", $id);
        mysqli_stmt_execute($db1);
        mysqli_stmt_bind_result($db1, $_SESSION['ime'], $_SESSION['informacije'], $_SESSION['rstruka'], $_SESSION['iskustvo'], $_SESSION['obrazovanje']);
        mysqli_stmt_fetch($db1);
        $_SESSION['kontaktr']=  $kontakt;
        $_SESSION['kontakt2r']=explode("-",$_SESSION['kontaktr'],2)[1];
      }
      mysqli_stmt_close($db1);
      header('location: indexr.php');
    }
    else
    {
      array_push($errors, "Wrong username/password combination");
    }
  }
}
if (isset($_POST['change_radnik']))
{
  $username=$_SESSION['username'];
  if (empty($_POST['ime']))
  {
  	array_push($errors, "Unesite ime");
  }
  if (count($errors) == 0)
  {
    $id=get_user_ID($username);
    $db1=mysqli_stmt_init($db);
    $kontaktr='+'.$_POST['kontakt1r']."-".$_POST['kontakt2r'];
    mysqli_stmt_prepare($db1, "UPDATE radnik SET Ime = ?,obrazovanje=?,polozaj =?,informacije =?, iskustvo=? WHERE id_r = ?");
    mysqli_stmt_bind_param($db1, "ssssss", $_POST['ime'], $_POST['obrazovanje'], $_POST['rstruka'], $_POST['informacije'], $_POST['iskustvo'], $id);
    mysqli_stmt_execute($db1);

    mysqli_stmt_prepare($db1, "UPDATE users SET kontakt = ? WHERE id_u = ?");
    mysqli_stmt_bind_param($db1, "ss",$kontaktr,$id);
    mysqli_stmt_execute($db1);
    mysqli_stmt_close($db1);
    $_SESSION['ime'] = $_POST['ime'];
    $_SESSION['obrazovanje'] = $_POST['obrazovanje'];
    $_SESSION['rstruka'] = $_POST['rstruka'];
    $_SESSION['kontaktr'] = $kontaktr;
    $_SESSION['kontakt2r'] = $_POST['kontakt2r'];
    $_SESSION['informacije'] = $_POST['informacije'];
    $_SESSION['iskustvo'] = $_POST['iskustvo'];
  }
}

  if (isset($_POST['add_new']))
  {
    $username=$_SESSION['username'];
    $date=date('Y-m-d', strtotime($_POST['rok']));
    if (empty($_POST['lokacija']) || empty($_POST['sprema']) || empty($_POST['opis']) || empty($_SESSION['struka']) || empty($_SESSION['naziv']))
    {
      array_push($errors, "Unesite podatke");
    }
    if (count($errors) == 0)
    {
      $id=get_user_ID($username);
      $id_firme=get_firma_ID($username);
      $db1=mysqli_stmt_init($db);
      mysqli_stmt_prepare($db1, "INSERT INTO oglasi (id_firme, lokacija, opis,sprema,rok,struka,kontakt, id_korisnika)  VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
      mysqli_stmt_bind_param($db1, "ssssssss", $id_firme, $_POST['lokacija'], $_POST['opis'], $_POST['sprema'], $date, $_SESSION['struka'], $_SESSION['kontakt'], $id);
      mysqli_stmt_execute($db1);
      mysqli_stmt_close($db1);
    }
  }
  if (isset($_POST['obrisi']))
  {
      $db1=mysqli_stmt_init($db);
      mysqli_stmt_prepare($db1, "DELETE FROM oglasi WHERE id_o=?");
      mysqli_stmt_bind_param($db1, "s", $_POST['obrisi']);
      mysqli_stmt_execute($db1);
      mysqli_stmt_prepare($db1, "DELETE FROM prijave WHERE id_oglas=?");
      mysqli_stmt_bind_param($db1, "s", $_POST['obrisi']);
      mysqli_stmt_execute($db1);
      mysqli_stmt_close($db1);
  }
  if (isset($_POST['change_poslodavac']))
  {
    $kontakt='+'.$_POST['kontakt1']."-".$_POST['kontakt2'];
    if (empty($_POST['naziv']) || empty($kontakt) || empty($_POST['struka']))
    {
      array_push($errors, "Unesite podatke");
    }
    if(count($errors)==0)
    {
      $id=get_user_ID($_SESSION['username']);
      $db1=mysqli_stmt_init($db);
      mysqli_stmt_prepare($db1, "UPDATE users SET kontakt= ? WHERE id_u= ?");
      mysqli_stmt_bind_param($db1, "ss", $kontakt, $id);
      mysqli_stmt_execute($db1);

      mysqli_stmt_prepare($db1, "UPDATE poslodavac SET struka= ? WHERE id_p = ?");
      mysqli_stmt_bind_param($db1, "ss", $_POST['struka'], $id);
      mysqli_stmt_execute($db1);

      mysqli_stmt_prepare($db1, "UPDATE firme SET Naziv_firme = ? WHERE id_poslodavca = ?");
      mysqli_stmt_bind_param($db1, "ss", $_POST['naziv'], $id);
      mysqli_stmt_execute($db1);

      mysqli_stmt_prepare($db1, "UPDATE oglasi SET struka= ? WHERE id_korisnika=?");
      mysqli_stmt_bind_param($db1, "ss", $_POST['struka'], $id);
      mysqli_stmt_execute($db1);
      mysqli_stmt_close($db1);
      $_SESSION['naziv']=$_POST['naziv'];
      $_SESSION['struka']=$_POST['struka'];     
      $_SESSION['kontakt']=$kontakt;
      $_SESSION['kontakt2']=$_POST['kontakt2'];
    }
  }
    //dodajemo u ocene table
if(isset($_POST['prikazi'])){
  $query = "SELECT id_o,naziv,lokacija FROM oglasi";
  $result = mysqli_query($db,$query);
if ($result->num_rows > 0)
{
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["id_o"]. " - Name: " . $row["firma"]. " " . $row["lokacija"]. "<br>";
  }
} else
{
  echo "Nema rezultata";
}
$result->free();
}
if(isset($_POST['leaveacomment']))
{
  $id_user=get_user_ID($_SESSION['username']);
  $db1=mysqli_stmt_init($db);
  mysqli_stmt_prepare($db1, "SELECT id_f FROM firme WHERE Naziv_firme=?");
  mysqli_stmt_bind_param($db1, "s", $_GET['ime']);
  mysqli_stmt_execute($db1);
  mysqli_stmt_bind_result($db1, $id_firme);
  mysqli_stmt_fetch($db1);
  if(!check_if_user_commented($_SESSION['username'],$_GET['ime']))
  {
    mysqli_stmt_prepare($db1, "INSERT INTO komentari (komentar,id_korisnika,ocena,id_firme) VALUES (?,?,?,?)");
    mysqli_stmt_bind_param($db1, "ssss", $_POST['comment'], $id_user, $_POST['rating1'], $id_firme);
    mysqli_stmt_execute($db1);
  }
  else
  {
    mysqli_stmt_prepare($db1, "UPDATE komentari SET komentar=?, ocena=? WHERE id_korisnika=? AND id_firme=?");
    mysqli_stmt_bind_param($db1, "ssss", $_POST['comment'], $_POST['rating1'], $id_user, $id_firme);
    mysqli_stmt_execute($db1);
  }
  mysqli_stmt_close($db1);
}
if(isset($_POST['prijavime'])){
  $uid=get_user_ID($_SESSION['username']);
  $date = date('d,m,Y', time());
  $db1=mysqli_stmt_init($db);
  mysqli_stmt_prepare($db1, "SELECT id_pr FROM prijave WHERE id_prijavljenog=? AND id_oglas=?");
  mysqli_stmt_bind_param($db1, "ss", $uid, $_GET['id']);
  mysqli_stmt_execute($db1);
  mysqli_stmt_bind_result($db1, $cond);
  mysqli_stmt_fetch($db1);
  if(!$cond)
  {
    mysqli_stmt_prepare($db1, "INSERT INTO prijave (id_prijavljenog,id_oglas,Datum_prijave) VALUES (?,?,STR_TO_DATE(? , '%d,%m,%Y'))");
    mysqli_stmt_bind_param($db1, "sss", $uid, $_GET['id'], $date);
    mysqli_stmt_execute($db1);
    echo "<script> alert('Uspešna prijava!');window.location='indexr.php' </script>";
  }
  mysqli_stmt_close($db1);
}
?>