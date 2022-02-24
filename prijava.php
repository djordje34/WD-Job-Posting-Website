<?php include('server.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<!--Bootsrap 4 CDN-->
         <!--Fontawesome CDN-->
         <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
   <link rel="stylesheet" href="pocetna.css">
   <link rel="stylesheet" href="style.css">
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
   <script type="text/javascript" src="skripta.js">   </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
       <style>
        body{ font: 14px sans-serif; text-align: center; overflow:auto;min-height:100%;}
    </style>
    <title>Document</title>


    
</head>
<body style="background-repeat:repeat;" onload="var ocena=document.getElementById('ocenaFirme');

var gde=document.getElementById('prosecnaOcena');
if(ocena==null){
  gde.innerHTML+=' Ova kompanija nema trenutno ni jednu ocenu. Budite prvi koji će je oceniti!'
}
else{
  ocena=ocena.textContent
ocena=Math.round(ocena * 100) / 100;

  gde.innerHTML+='<b>'+ocena+'/5</b>';
prosecna=document.getElementById('prosek')
prosecna.textContent+=ocena;
  }
    showBolje();
    konacnaOcena();">
<nav class="navbar navbar-expand navbar-dark bg-dark" aria-label="Second navbar example">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Oglasi!
              <img src="slike/colour.jpg" alt="logo" style="width:30px">
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample02" aria-controls="navbarsExample02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
    
          <div class="collapse navbar-collapse" id="navbarsExample02">
            <ul class="navbar-nav me-auto">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="indexr.php">Početna</a>
              </li>
              <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="profil.php">Podešavanja profila</a>
              </li>
              <li class="nav-item" style="position:absolute; right:20px;">
              <a style="color:#DC3545;" class="nav-link active aria-current="page" href="logout.php" class="btn btn-danger ml-3"><b>Izloguj me</b></a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <?php
// Initialize the session
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
if($_SESSION['choice']=='1'){
    header("location: indexp.php");
    exit;
}
?>


<section class='sectionContainer'>
<p id='prosek' style='display:none'></p>

<section style='background-color:white;width:100%;margin:auto;height:auto;min-height:100%;position:relative;padding:50px'>
<div>

<?php 
  $db1=mysqli_stmt_init($db);
  mysqli_stmt_prepare($db1, "SELECT slika FROM firme WHERE Naziv_firme=?");
  mysqli_stmt_bind_param($db1, "s", $_GET["ime"]);
  mysqli_stmt_execute($db1);
  $result = mysqli_stmt_get_result($db1);
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

  $slika=$row['slika'];

  if($slika){
    echo "<img src=\"slike/$slika\" alt='slika' style='border:2px solid #ffC312;border-radius:0 0 25px 25px;max-height:100% !important'>";
  }
  else{
    echo "<img src='slike/default.jpg' alt='slika' style='border:2px solid #ffC312;border-radius:0 0 25px 25px;max-height:100% !important'>";
  }

?>





  <div class="input-group form-group formedGroupAddon" style='margin:auto;width:40%;margin-top:5%'>
  <div class="input-group-prepend groupAddon" >
                                <span class="input-group-text"><i class="fas fa-building normalIconContainer" ></i></span>
                            </div>
                            <input type="text" name="ime" class="form-control" placeholder="IME FIRME" value="<?php echo $_GET['ime']  ?>"  disabled>
                        </div> 
</div>
<div style="margin:2% 10%;border:2px solid #ffC312;border-radius:0 0 15px 15px;padding:5% 5% 0;width:80%;border-top:0">
<div class="input-group form-group formedGroupAddon">
                            <div class="input-group-prepend groupAddon" >
                                <span class="input-group-text"><i class="fas fa-search-location normalIconContainer" ></i></span>
                            </div>
                            <input type="text" name="lokacija" class="form-control" placeholder="Lokacija posla" value="<?php echo $_GET['lokacija']  ?>" disabled>
                        </div> 
                        <div class="input-group form-group formedGroupAddon" >
                            <div class="input-group-prepend groupAddon ">
                                <span class="input-group-text"><i class="fas fa-briefcase normalIconContainer"></i></span>
                            </div>
                            <input type="text" name="sprema" class="form-control" placeholder="sprema" value="<?php echo $_GET['inz']  ?>" disabled>
                        </div> 
                        <div class="input-group form-group formedGroupAddon" >
                        <div class="input-group-prepend groupAddon">
                                <span class="input-group-text"><i class="fas fa-phone normalIconContainer" style='margin: 5px 3px'></i></span>
                            </div>
                            <input type="text" name="obrazovanje" class="form-control" placeholder="telefon" value="<?php echo str_replace(' ', '','+'.$_GET['kont']);  ?>" disabled>
                        </div> 
                        <div class='input-group form-group formedGroupAddon' style='border-radius:0 10px 10px 0;'>
               <div class='input-group-prepend groupAddon'>
               <span class='input-group-text'><i class='fas fa-briefcase normalIconContainer'></i></span>
           </div>
           <?php
              $db1=mysqli_stmt_init($db);
              mysqli_stmt_prepare($db1, "SELECT opis FROM oglasi o WHERE o.id_o=?");
              mysqli_stmt_bind_param($db1, "s", $_GET["id"]);
              mysqli_stmt_execute($db1);
              $result = mysqli_stmt_get_result($db1);
              $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
              echo "<textarea rows='4' cols='50' name='informacije' style='min-height:130px;max-height:300px;max-width:90%;' class='form-control' placeholder='Informacije o radniku' disabled>".$row['opis']."</textarea>";     
            ?>
          </div> 
                        
<div style='margin:5% 25% 5%;'>  
  <div class='zvezde' id='' style='color:#313233 !important;margin:0% 5% 2% 5%'> 
        <i class='fa fa-star fa-2x' id='k1' name='1'></i><i class='fa fa-star fa-2x' id='k2' name='2'></i><i class='fa fa-star fa-2x' id='k3' name='3'></i><i class='fa fa-star fa-2x' id='k4' name='4'></i><i class='fa fa-star fa-2x' id='k5' name='5'></i>
      </div>
      <p id='prosecnaOcena' style='color:#454a46'></p>
      </div>
      <?php
      $db1=mysqli_stmt_init($db);
      $uid=get_user_ID($_SESSION['username']);
      mysqli_stmt_prepare($db1, "SELECT id_pr FROM prijave WHERE id_prijavljenog=? AND id_oglas=?");
      mysqli_stmt_bind_param($db1, "ss", $uid, $_GET['id']);
      mysqli_stmt_execute($db1);
      $result = mysqli_stmt_get_result($db1);
      if($result->num_rows>0)
      {
        echo "
        <form method='post'>
        <div class='input-group form-group formedGroupAddon' >
        <button type='submit' class='btn btn-success submitBtnStyle' name='apsolutnonista' style='margin:auto !important;' disabled>Već ste se prijavili!</button>
        </div> 
        </form>";
      }
      else
      {
        echo "
        <form method='post'>
        <div class='input-group form-group formedGroupAddon' >
        <button type='submit' class='btn btn-danger submitBtnStyle' name='prijavime' style='margin:auto !important;'>Prijavite se</button>
        </div> 
        </form>";
      }
      $result->free();
      ?>

      </section>
      <?php
      mysqli_stmt_prepare($db1, "SELECT ocena FROM komentari k JOIN firme f ON k.id_firme=f.id_f JOIN users u ON k.id_korisnika=u.id_u WHERE f.Naziv_firme=?");
      mysqli_stmt_bind_param($db1, "s",$_GET['ime']);
      mysqli_stmt_execute($db1);
      $result = mysqli_stmt_get_result($db1);
      if ($result->num_rows > 0)
      {
        $sum=0;
        while($row = $result->fetch_assoc())
        {
          $sum+=$row['ocena'];
        }
        $socena=$sum/$result->num_rows;
        echo "<p id='ocenaFirme' style='display:none;'>".$socena."</p>";
      }
      mysqli_stmt_close($db1);
      $result->free();
    ?>


</body>
</html>