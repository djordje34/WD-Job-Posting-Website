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
   <script type="text/javascript" src="skripta.js">   </script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
       <style>
        body{ font: 14px sans-serif; text-align: center; overflow:auto;min-height:100%;}
    </style>
    <title>Document</title>
</head>
<body style="background-repeat:repeat;">
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
                <a class="nav-link active" aria-current="page" href="index.php">Početna</a>
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
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
if($_SESSION['choice']=='1'){
    header("location: indexp.php");
    exit;
}
?>
<section style='background-color:white;max-width:80%;margin:auto;height:auto;min-height:100%;background-repeat:repeat;'>
<div style="left:30px;margin:0px 25%;border:2px solid #ffC312;border-radius:15px;">
   <p id="firma" style="font-size:20px;margin:0px;">Ime firme:</p>
   <p id="lokacija"style="font-size:20px;margin:0px;">Lokacija:</p>
   <p id="sprema" style="font-size:20px;margin:0px;">Minimalan nivo obrazovanja:</p>
   <p id="struka" style="font-size:20px;margin:0px;">Tip inženjerstva:</p>
   <p id="opis" style="font-size:20px;margin:0px;">Opis posla: </p>
   <p id="kontakt" style="font-size:20px;margin:0px;">Broj telefona poslodavca: </p>
   <p id="rok" style="font-size:20px;margin:0px;">Prijava moguća do: </p>
</div>
</section>
</body>
</html>