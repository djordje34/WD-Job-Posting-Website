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
   <script type="text/javascript" src="js/bootstrap-filestyle.min.js"> </script>
   <script type="text/javascript" src="skripta.js"> </script>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        body{ font: 14px sans-serif; text-align: center;background-attachment:fixed;background-position: center;background-repeat: no-repeat; }
    </style>
        <link rel = "icon" href = "slike/colour.jpg" type = "image/x-icon">
    <title>Oglasi!</title>
</head>
<body onload="var ocena=document.getElementById('ocenaFirme');

var gde=document.getElementById('prosecnaOcena');
if(ocena==null){
  gde.innerHTML+=' Ova kompanija nema trenutno ni jednu ocenu.'
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
<nav class="navbar navbar-expand navbar-dark bg-dark" aria-label="Second navbar example" >
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Oglasi!
              <img src="slike/colour.jpg" alt="logo" style="width:30px">
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample02" aria-controls="navbarsExample02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
    
          <div class="collapse navbar-collapse" id="navbarsExample02">
            <ul class="navbar-nav me-auto">

              <?php
              if(isset($_SESSION['choice'])){ 
             echo "<li class='nav-item'>
                <a class='nav-link active' aria-current='page' href='indexp.php'>Podešavanja profila</a>
              </li>
              <li class='nav-item'>
                <a class='nav-link active' aria-current='page' href='dodajoglas.php'>Dodajte oglas</a>
              </li>
              <li class='nav-item'>
              <a class='nav-link active' aria-current='page' href='mojioglasi.php'>Pogledajte vaše oglase</a>
            </li>
              ";
              }
              else{
              echo"  <li class='nav-item'>
                <a class='nav-link active' aria-current='page' href='index.php'>Početna</a>
              </li> ";
              }
              ?>
              <li class="nav-item" style="position:absolute; right:20px;">
              <?php
              if(sizeof($_SESSION)==0)
                echo "<a style='color:#ffc312;' class='nav-link active aria-current='page' href='login.php' class='btn btn-danger ml-3'><b>Uloguj me</b></a>";
              else
                echo "<a style='color:#DC3545;' class='nav-link active aria-current='page' href='logout.php' class='btn btn-danger ml-3'><b>Izloguj me</b></a>";
              ?>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <?php
if(isset($_GET['ime'])){
  echo "<p style='display:none' id='redirekcija'>".$_GET['ime']."</p>";
}
?>
<section class='sectionContainer'>
<p id='prosek' style='display:none'></p>

<section style='background-color:white;width:100%;margin:auto;height:auto;min-height:100%;position:relative;padding:50px'>
<div>



<?php 
  $naziv=mysqli_real_escape_string($db,$_GET['ime']);
  $query9="SELECT * FROM firme WHERE Naziv_firme='$naziv'";
  $result=mysqli_query($db,$query9);

  $row=$result->fetch_assoc();

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
                            <input type="text" name="ime" class="form-control" placeholder="IME FIRME" value="<?php echo $_GET['ime'] ?>"  disabled>
                        </div> 
</div>
<div style="margin:2% 10%;border:2px solid #ffC312;border-radius:0 0 15px 15px;padding:5% 5% 0;width:80%;border-top:0">
<div class="input-group form-group formedGroupAddon">
                            <div class="input-group-prepend groupAddon" >
                                <span class="input-group-text"><i class="fas fa-search-location normalIconContainer" ></i></span>
                            </div>
                            <input type="text" name="lokacija" class="form-control" placeholder="Lokacija posla" value="<?php echo $_GET['lokacija'] ?>" disabled>
                        </div> 
                        <div class="input-group form-group formedGroupAddon" >
                            <div class="input-group-prepend groupAddon ">
                                <span class="input-group-text"><i class="fas fa-briefcase normalIconContainer"></i></span>
                            </div>
                          <input type="text" name="sprema" class="form-control" placeholder="sprema" value="<?php echo $_GET['inz'] ?>" disabled>
                        </div> 
                        <div class="input-group form-group formedGroupAddon" >
                        <div class="input-group-prepend groupAddon">
                                <span class="input-group-text"><i class="fas fa-phone normalIconContainer" style='margin: 5px 3px'></i></span>
                            </div>
                            <input type="text" name="obrazovanje" class="form-control" placeholder="telefon" value="<?php echo str_replace(' ', '','+'.$_GET['kont']);?>" disabled>
                        </div> 
                        <div class="input-group form-group formedGroupAddon" >
                          <?php
                          if(sizeof($_SESSION)==0)
                            echo "<button type='submit' class='btn btn-danger submitBtnStyle' name='prikazivise'onclick=\"return redirektujnp('naziv')\" style='margin:30px 30% 0 30% !important;'>Pogledajte ostale oglase ove kompanije</button>";
                          ?>
                        </div> 
                        
<div style='margin:5% 25% 5%;'>  
 
  
  <div class='zvezde' id='' style='color:#313233 !important;margin:0% 5% 2% 5%'> 
        <i class='fa fa-star fa-2x' id='k1' name='1'></i><i class='fa fa-star fa-2x' id='k2' name='2'></i><i class='fa fa-star fa-2x' id='k3' name='3'></i><i class='fa fa-star fa-2x' id='k4' name='4'></i><i class='fa fa-star fa-2x' id='k5' name='5'></i>
      </div>
      <p id='prosecnaOcena' style='color:#454a46'></p>
      </div>
     
      </section>
 <?php 
  $db1=mysqli_stmt_init($db);
  mysqli_stmt_prepare($db1, "SELECT username,id_k,ocena,komentar FROM komentari k JOIN firme f ON k.id_firme=f.id_f JOIN users u ON k.id_korisnika=u.id_u WHERE f.Naziv_firme=?");
  mysqli_stmt_bind_param($db1, "s", $_GET["ime"]);
  mysqli_stmt_execute($db1);
  $result = mysqli_stmt_get_result($db1);
  if ($result->num_rows > 0) {
    $sum=0;
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      $sum+=$row['ocena'];
    echo  "<div class='input-group form-group' style='margin:auto;padding:6% 20%;border-top:1px solid black'><div class='input-group-prepend' style='width:30%;background-color:#FFC312;border:1px solid #FFC312;border-radius:15px 0 0 15px;'><span class='input-group-text' style='border-radius:10px 0 0px 0px;background-color:#FFC312;text-align:center;width:100%;'><p style='color:black;font-size:14px;font-weight:600;text-align:center;margin:auto;'>".$row['username']."</p></span>";
    echo "<div class='rating-css'>
    <div class='zvezdice star-icon ' id=zvezde".$row['id_k']." style='background-color:white !important;border:1px solid black;border-radius:15px;margin:0 15% 10% 15%;color:#313233 !important'> 
      <i class='fa fa-star fa-s' id='zv1' name='1'></i><i class='fa fa-star fa-s' id='zv2' name='2'></i><i class='fa fa-star fa-s' id='zv3' name='3'></i><i class='fa fa-star fa-s' id='zv4' name='4'></i><i class='fa fa-star fa-s' id='zv5' name='5'></i>
    </div>
  </div>";
  
    echo "</div><textarea rows='4' cols='50' style='min-height:130px;max-height:300px;max-width:70%;border:4px solid #FFC312;border-radius:0 12px 12px 0;' class='form-control' disabled required>".$row['komentar']."</textarea>"."</div>";
   echo "<p id='ocenaKorisnika".$row['id_k']."' style='display:none'>".$row['ocena']."</p>";
  }
   $socena=$sum/$result->num_rows;
   echo "<p id='ocenaFirme' style='display:none;'>".$socena."</p>";
  }
  $result->free();
  mysqli_stmt_close($db1);
    ?>
        <div class="rating-css" style='border-top:1px solid black'>
    <div class="star-icon">
    </div>
  </div>
</body>
</html>