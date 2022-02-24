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
                <a class="nav-link active" aria-current="page" href="indexr.php">Početna</a>
              </li>
              <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="profil.php">Podešavanja profila</a>
              </li>
              <li class="nav-item" style="position:absolute; right:20px;">
              <a style="color:#DC3545;" class="nav-link active aria-current="page" href="logout.php" class="btn btn-danger ml-3"><b>Izloguj me</b></a>
              </li>
              <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="prijave.php">Vaše prijave</a>
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
?>
<section class='sectionContainer'>
<div style="left:30px;margin:10% 25%;border:2px solid #ffC312;border-radius:15px;">
   <p style="font-size:15px;margin:0px;">Dobrodošli <?php echo $_SESSION["username"]?>! </p>
   <p style="font-size:15px;margin:0px;">Ovde možete uneti Vaše podatke. </p>
 <form method="post" class='formContainer' style="margin-bottom:0 !important; border-radius:15px 15px 0 0 !important">
<div class="input-group form-group formedGroupAddon" style="border-radius:0 10px 10px 0;">
                            <div class="input-group-prepend groupAddon" >
                                <span class="input-group-text"><i class="fas fa-user normalIconContainer"></i></span>
                            </div>
                            <input class='textContainer' type="text" name="ime" class="form-control" placeholder="Vaše ime" value="<?php echo $_SESSION['ime']?>"required>
                        </div> 
<div class="input-group form-group formedGroupAddon">
                            <div class="input-group-prepend groupAddon">
                                <span class="input-group-text"><i class="fas fa-phone normalIconContainer" ></i></span>
                            </div> 
                            <input class='telContainerSmall' type="tel" id="phone" name="kontakt1r" pattern="[0-9]{3}" value="381"required>
                             <input class='telContainerBig'type="tel" id="phone" name="kontakt2r" pattern="[0-9]{2}-[0-9]{3}-[0-9]{4}" placeholder="Kontakt telefon" value="<?php echo $_SESSION['kontakt2r']?>" required>
                          

                          <div class="input-group-prepend" style="background-color:#FFC312;border:1px solid black;margin:0 40% 0 0;max-height:20px;">
                                <small class='telContainerLabel'>Format:XXX 6X-XXX-XXXX </small>
                            </div>
                            </div>
<div class="input-group form-group formedGroupAddon">
                            <div class="input-group-prepend groupAddon">
                                <span class="input-group-text"><i class="fas fa-industry normalIconContainer"></i></span>
                            </div> 
                            <select class="form-select selectContainer" aria-label="Izbor" name="rstruka">
                            <option value="" disabled>Trenutni izbor:<?php echo $_SESSION['rstruka']?></option>
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
                        <div class="input-group form-group formedGroupAddon" >
                            <div class="input-group-prepend groupAddon">
                                <span class="input-group-text"><i class="fas fa-school normalIconContainer" ></i></span>
                            </div> 
                            <select class="form-select selectContainer" aria-label="Izbor" name="obrazovanje">
                            <option value="" disabled>Trenutni izbor:<?php echo $_SESSION['obrazovanje']?></option>
                             <option value="Osnovna škola">Osnovna škola</option>
                             <option value="Srednja škola">Srednja škola</option>
                             <option value="Više strukovne studije">Više strukovne studije</option>
                             <option value="Osnovne akademske studije">Osnovne akademske studije</option>
                             <option value="Master akademske studije">Master akademske studije</option>
                             <option value="Doktorske studije">Doktorske studije</option>  
                            </optgroup>
                        </select> </div>  

                        <div class="input-group form-group formedGroupAddon" style="max-width:30%;">
                         <div class="input-group-prepend groupAddon">
                                <span class="input-group-text"><i class="fas fa-wrench normalIconContainer"></i></span>
                            </div>
                            <input type="number" min="0" max="60" name="iskustvo" class="form-control numberContainer" placeholder="Radno iskustvo" required value="<?php echo $_SESSION['iskustvo']?>">
                            </div>

                        <div class="input-group form-group formedGroupAddon">
                         <div class="input-group-prepend groupAddon">
                                <span class="input-group-text"><i class="fas fa-briefcase" style="margin:30px 5px"></i></span>
                            </div>
                            <textarea rows="4" cols="50" name="informacije" class="form-control textboxContainer" placeholder="Nešto više o Vama"  required><?php echo $_SESSION['informacije']?></textarea>
                            </div>
                          <button type="submit" class="btn btn-danger submitBtnStyle" name="change_radnik">Sačuvaj promene</button>
                        </form>
                        <form action="upload.php" method="post" enctype="multipart/form-data" class="formContainer" style="border-top:0 !important; border-radius:0 0 15px 15px !important; margin-top:0px !important;">
                        <div class="input-group form-group formedGroupAddon" >
                            <div class="input-group-prepend groupAddon">
                                <span class="input-group-text"><i class="fas fa-images normalIconContainer"></i></span>
                                  </div>
                          <input class="form-control" type="file" id="fileToUploadCV" name="fileToUploadCV" style='border:1px solid black;max-width:40%;border-left:0'>
                          <input class="btn btn-warning" type="submit" value="Upload CV" name="submitCV" style='border:1px solid black;'>
                        </div>
                       
                        </form>
</div>
                        
</section>
<body>
</html>