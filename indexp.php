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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
    <link rel = "icon" href = "slike/colour.jpg" type = "image/x-icon">
    <title>Oglasi!</title>
</head>
<body>
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
                <a class="nav-link active" aria-current="page" href="indexp.php">Podešavanja profila</a>
              </li>
              <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="dodajoglas.php">Dodajte oglas</a>
              </li>
              <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="mojioglasi.php">Pogledajte Vaše oglase</a>
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
if($_SESSION['choice']=='2'){
    header("location: indexr.php");
    exit;
}
if($_SESSION['choice']=='3'){
  header("location: indexa.php");
  exit;
}
?>
<section class='sectionContainer'>
 <div style="margin:10% 25%;border:2px solid #ffC312;border-radius:15px;">
   <p style="font-size:15px;margin:0px;">Dobrodošli<b> <?php echo $_SESSION["username"]?></b>! </p>
   <p style="font-size:15px;margin:0px;">Ovde možete uneti podatke o kompaniji koju predstavljate. </p>
 <form method="post" class="formContainer" style="margin-bottom:0 !important; border-radius:15px 15px 0 0 !important">
<div class="input-group form-group formedGroupAddon" style="border-radius:0 10px 10px 0;">
                            <div class="input-group-prepend groupAddon" >
                                <span class="input-group-text"><i class="fas fa-building normalIconContainer"></i></span>
                            </div>
                            <input class='textContainer' type="text" name="naziv" class="form-control" placeholder="Ime kompanije koju predstavljate" value="<?php echo $_SESSION['naziv']?>"required>
                        </div> 
<div class="input-group form-group formedGroupAddon">
                            <div class="input-group-prepend groupAddon">
                                <span class="input-group-text"><i class="fas fa-phone normalIconContainer"></i></span>
                            </div> 
                            <input class='telContainerSmall' type="tel" id="phone" name="kontakt1" pattern="[0-9]{3}" value="381"required>
                             <input class='telContainerBig' type="tel" id="phone" name="kontakt2" pattern="[0-9]{2}-[0-9]{3}-[0-9]{4}" placeholder="Kontakt telefon" value="<?php echo $_SESSION['kontakt2']?>" required>
 
                            
                            <div class="input-group-prepend" style="background-color:#FFC312;border:1px solid black;margin:0 40% 0 0;max-height:20px;">
                            <small class='telContainerLabel'>Format:XXX 6X-XXX-XXXX </small>
                            </div>
                            </div> 

<div class="input-group form-group formedGroupAddon" style='margin-bottom:3% !important'>
                            <div class="input-group-prepend groupAddon">
                                <span class="input-group-text"><i class="fas fa-industry normalIconContainer"></i></span>
                            </div> 
                            <select class="form-select selectContainer" aria-label="Izbor" name="struka" required>
                            <option value="" disabled>Trenutni izbor:<?php echo $_SESSION['struka']?></option>
                            <option value="Mašinski inženjering">Mašinski inženjering</option>
                             <option value="Softverski inženjering">Softverski inženjering</option>
                             <option value="Elektrotehnički inženjering">Elektrotehnički inženjering</option>
                             <option value="Računarski inženjering">Računarski inženjering</option>
                             <option value="Urbani inženjering">Urbani inženjering</option>
                             <option value="Hemijski inženjering">Hemijski inženjering</option>   
                             <option value="Aeronautički inženjering">Aeronautički inženjering</option>  
                             <option value="Telekomunikacioni inženjering">Telekomunikacioni inženjering</option>  
                            </optgroup>
                        </select> </div>
                        <button type="submit" class="btn btn-danger submitBtnStyle" name="change_poslodavac">Sačuvaj promene</button>
                        </form>
                        <form action="upload.php" method="post" enctype="multipart/form-data" class="formContainer" style="border-top:0 !important; border-radius:0 0 15px 15px !important; margin-top:0px !important;">
                        <?php
                        $id=get_user_ID($_SESSION['username']);
                        $query="SELECT slika FROM firme WHERE id_poslodavca=?";
                        $db1=mysqli_stmt_init($db);
                        mysqli_stmt_prepare($db1, $query);
                        mysqli_stmt_bind_param($db1, "s", $id);
                        mysqli_stmt_execute($db1);
                        $result = mysqli_stmt_get_result($db1);
                        mysqli_stmt_fetch($db1);
                        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                        $slika=$row['slika'];
                        if($slika=='')
                        {
                          echo "<img src='slike/default.jpg' alt='profilna slika' style='border:2px solid black;max-width:15%;max-height:15%'>";
                        }
                        else{
                          echo "<img src=slike/".$slika." alt='profilna slika' style='border:2px solid black;max-width:40%;max-height:40%'>";
                        }
                        mysqli_stmt_close($db1);
                          ?>
                        <div class="input-group form-group formedGroupAddon" style='margin:5% 15%'id='dodajsliku'>
                            <div class="input-group-prepend groupAddon">
                                <span class="input-group-text"><i class="fas fa-images normalIconContainer"></i></span>
                                  </div>
                          <input class="form-control" type="file" id="fileToUpload" name="fileToUpload" style='border:1px solid black;max-width:40%;border-left:0'>
                          <input class="btn btn-warning" type="submit" value="Upload Image" name="submit" style='border:1px solid black;' onclick="return dodajSliku()">
                        </div>
                        
</form>
</div>
</section>
   
    
</body>
</html>
</body>
</html>