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
                <a class="nav-link active" aria-current="page" href="indexp.php">Podešavanje profila</a>
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
if(isset($_GET['id']))
{
  $db1=mysqli_stmt_init($db);
  mysqli_stmt_prepare($db1, "SELECT sprema, rok, opis, lokacija FROM oglasi WHERE id_o=?");
  mysqli_stmt_bind_param($db1, "s", $_GET['id']);
  mysqli_stmt_execute($db1);
  $result = mysqli_stmt_get_result($db1);
  $sndrow = $result->fetch_assoc();
  $_SESSION['sprema'] = $sndrow['sprema'];
  $_SESSION['rok'] = $sndrow['rok'];      
  $_SESSION['opis'] = $sndrow['opis'];
  $_SESSION['lokacija'] = $sndrow['lokacija'];
  if (isset($_POST['change_ad']))
  {
    $lokacija=mysqli_real_escape_string($db, $_POST['lokacija']);
    $sprema=mysqli_real_escape_string($db, $_POST['sprema']);
    $opis=mysqli_real_escape_string($db, $_POST['opis']);
    $date=date('Y-m-d', strtotime($_POST['rok']));
    $id2=mysqli_real_escape_string($db, $_GET['id']);
    if (empty($lokacija) || empty($sprema) || empty($opis))
    {
      array_push($errors, "Unesite podatke");
      echo "ERROR!";
    }
    if (count($errors) == 0)
    {
      mysqli_stmt_prepare($db1, "UPDATE oglasi SET opis=?,sprema=?,rok=?,lokacija=? WHERE id_o=?");
      mysqli_stmt_bind_param($db1, "sssss", $opis, $sprema, $date, $lokacija, $_GET['id']);
      mysqli_stmt_execute($db1);
      $_SESSION['sprema'] = $sprema;
      $_SESSION['rok'] = $date;     
      $_SESSION['opis'] = $opis;
      $_SESSION['lokacija'] = $lokacija;
    }
    mysqli_stmt_close($db1);
  }
}

?>
<section style='background-color:white;max-width:70%;margin:auto;height:auto;min-height:100%;position:relative;padding:50px'>
<div style="left:30px;margin:2% 25%;border:2px solid #ffC312;border-radius:15px;">
    <p style="font-size 15px;margin:10px;">Unesite podatke oglasa za kompaniju <?php echo $_SESSION['naziv']?></p>
    <form method="post" style="margin:10px;padding:20px ;border:1px solid #212529;border-radius:15px 15px 15px 15px;background-color:rgba(33,37,41,0.85);">
<div class="input-group form-group" style="background-color:#FFC312;margin:0 0 10px 0; border:1px solid black;">
                            <div class="input-group-prepend" >
                                <span class="input-group-text"><i class="fas fa-search-location" ></i></span>
                            </div>
                            <input type="text" name="lokacija" class="form-control" placeholder="Lokacija posla" value="<?php echo $_SESSION['lokacija'] ?>" required>
                        </div> 
                        <div class="input-group form-group" style="background-color:#FFC312;margin:0 0 10px 0; border:1px solid black;">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-school"></i></span>
                            </div>
                            <select class="form-select" aria-label="Izbor" name="sprema">
                            <option disabled value="<?php echo $_SESSION['sprema'] ?>">Trenutni izbor je <?php echo $_SESSION['sprema'] ?></option>
                             <option value="Osnovna škola">Osnovna škola</option>
                             <option value="Srednja škola">Srednja škola</option>
                             <option value="Viša škola">Viša škola</option>
                             <option value="Osnovne studije">Osnovne studije</option>
                             <option value="Master studije">Master studije</option>
                             <option value="Doktorske studije">Doktorske studije</option>   
                            </optgroup>
                        </select>
                            
                    </div>
                    <div class="input-group form-group" style="background-color:#FFC312;margin:0 0 10px 0; border:1px solid black;">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-briefcase"></i></span>
                            </div>
                            <textarea rows="4" cols="50" name="opis" class="form-control" placeholder="Opis posla" required><?php echo $_SESSION['opis'] ?></textarea>
                            </div>
                            <div class="input-group form-group" style="margin:0 0 10px 0;">
                            <div class="input-group-prepend"style="border:1px solid black;" >
                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                            </div>
                            <input style="border:1px solid black;"type="date" id="start" name="rok" value="<?php echo $_SESSION['rok'] ?>" min="2022-01-01">
                            </div>      

  <button type="submit" class="btn btn-danger" name="change_ad" value="change_ad" style="border:2px solid black;margin:30px 0 0 0;">Promeni oglas</button>
  </div>
</form>
</div>
</section>
</body>
</html>
</body>
</html>