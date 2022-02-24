<?php 
include('server.php') ?>
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
    <link rel = "icon" href = "slike/colour.jpg" type = "image/x-icon">
    <title>Oglasi!</title>
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
              <li class="nav-item" style="position:absolute; right:20px;">
              <a style="color:#ffc312;" class="nav-link active aria-current="page" href="login.php" class="btn btn-danger ml-3"><b>Uloguj me</b></a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    <section>
    <form method="post" style="width:80%">
    <div class="input-group form-group" style="margin:0 0 10px 0;max-width:400px;">
                            <div class="input-group-prepend" style="background-color:#FFC312;border:1px solid black;border-right:0;border-radius:20px 0 0 20px;">
                                <span class="input-group-text"><i class="fas fa-search "style="margin:5px 5px 5px 5px;" ></i></span>
                            </div>
                            <input style="border-radius:0 0 0px 0; border:1px solid black;border-left:0;border-right:0;font-size:15px;text-align:center;max-width:350px;" type="text" name="pretraga" class="form-control" placeholder="Pretraga">
                            <button type="submit" name="pretrazi" class="btn btn-warning" style="border:1px solid black;border-radius:0 15px 15px 0">Pretraži</button>
                          </div> 
</div>
</form>
    </section>
    
    <?php
    if(sizeof($_SESSION)>0)
    {
      header("location: indexr.php");
      exit;
    }
    $check=5;
      $query="SELECT slika, id_o, Naziv_firme, lokacija, sprema, struka, rok, o.kontakt, opis FROM oglasi o JOIN firme f ON o.id_firme=f.id_f JOIN users u ON o.id_korisnika=u.id_u";
      if(isset($_POST['pretrazi'])){ 
        $kriterijum=mysqli_real_escape_string($db,$_POST['pretraga']);
        $kriterijum=strtolower($kriterijum);
        $kriterijum="%". $kriterijum . "%";
        if(!empty($kriterijum)){
          $query.=" WHERE (LOWER(Naziv_firme) LIKE ?) OR (LOWER(lokacija) LIKE ?) OR (LOWER(opis) LIKE ?) OR (LOWER(sprema) LIKE ?) OR (LOWER(struka) LIKE ?) OR (o.kontakt LIKE ?) OR (rok LIKE ?)";
          $check=2;
        }
      }
        else if(isset($_GET['naziv'])){
          $kriterijum=mysqli_real_escape_string($db,$_GET['naziv']);
          $query.=" WHERE (Naziv_firme LIKE ?)";
          $check=1;
        }
        $db1=mysqli_stmt_init($db);
        mysqli_stmt_prepare($db1, $query);
        if($check==2)
        {
          mysqli_stmt_bind_param($db1, "sssssss", $kriterijum, $kriterijum, $kriterijum, $kriterijum, $kriterijum, $kriterijum, $kriterijum);
        }
        if($check==1)
        {
          mysqli_stmt_bind_param($db1, "s", $_GET['naziv']);
        }
        mysqli_stmt_execute($db1);
        $result = mysqli_stmt_get_result($db1);
        if ($result->num_rows >= 0)
        {
          mysqli_stmt_fetch($db1);
          echo "<section style='background-color:white;min-width:70%;max-width:90%;margin:0 15% 0 15% ;height:auto;min-height:100%;position:absolute;'>";
          echo "<div id='vise' style='position:fixed;display:none;z-index:100;background: rgba(128,128,128, 0.7);margin:auto ;min-width:70%;min-height:80%;width:80%;right:10%;left:10%;top:auto;bottom:10px;border:3px solid #FFC312;border-radius:60px;' >";
          echo "<button class='btn btn-warning btn-sm' style='right:0;position:absolute;margin:2%; border-radius:50px; width:30px' onclick='return ugasi()' name='ugasi'>x</button>";
          echo "<div id='contents' style='font-size:17px ;border:3px solid #FFC312;margin:5% 20% 0 20%;background-color:grey;border-radius:20px;'></div>";
          echo "</div>";
          while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
          {
            if(strtotime($row['rok'])>time())
            {
              $slika=$row['slika'];
              $id1=$row['id_o'];
              if($slika=='')
              {
                echo "<div id='$id1' style='position:relative;background-color:#212529;display:inline-block;width:auto;max-width:300px;height:auto;border:1px solid #212529;margin:10px;border-radius:20px;padding:auto;'\><img style='border:1px solid #212529;border-radius:15px;' src='slike/default.jpg' alt='neka slika'\>" ."<p style='font-size:15px;margin:10%;padding:5px;background-color:#FFC312;opacity:0.85;border:1px solid #FFC312;border-radius:20px;'\>"."Ime kompanije:<b>" .$row["Naziv_firme"]. "  </b><br>Lokacija:<b>" . $row["lokacija"]. "  </b><br>Minimal nivo obrazovanja:<b>" .$row["sprema"]."  </b><br>Tip inženjerstva:<b>".$row["struka"]."  </b>"."</b><br>Prijava moguća do:<b>".date("d.m.Y.", strtotime($row["rok"]))."  </b><br>Kontakt:<b>".$row['kontakt'] ."</b>"."<br><p style='display:none'>".$row['opis']."</p>"."<p style='display:none'>".$username."<p style='display:none'>".$row['id_o']."</p>"."</p></p><br><form method='post'> <button onclick='return prikaziVisenp($id1)' class='btn btn-danger' name='prikaz' value='$id1' style='border:2px solid black;margin:-10px 0 10px 0;'>Pogledaj više </button></form></div>";
              }
			        else
			        {
				        echo "<div id='$id1' style='position:relative;background-color:#212529;display:inline-block;width:auto;max-width:300px;height:auto;border:1px solid #212529;margin:10px;border-radius:20px;padding:auto;'\><img style='border:1px solid #212529;border-radius:15px;' src=\"slike/$slika\" alt='neka slika'\>" ."<p style='font-size:15px;margin:10%;padding:5px;background-color:#FFC312;opacity:0.85;border:1px solid #FFC312;border-radius:20px;'\>"."Ime kompanije:<b>" .$row["Naziv_firme"]. "  </b><br>Lokacija:<b>" . $row["lokacija"]. "  </b><br>Minimal nivo obrazovanja:<b>" .$row["sprema"]."  </b><br>Tip inženjerstva:<b>".$row["struka"]."  </b>"."</b><br>Prijava moguća do:<b>".date("d.m.Y.", strtotime($row["rok"]))."  </b><br>Kontakt:<b>".$row['kontakt'] ."</b>"."<br><p style='display:none'>".$row['opis']."</p>"."<p style='display:none'>".$username."<p style='display:none'>".$row['id_o']."</p>"."</p></p><br><form method='post'> <button onclick='return prikaziVisenp($id1)' class='btn btn-danger' name='prikaz' value='$id1' style='border:2px solid black;margin:-10px 0 10px 0;'>Pogledaj više </button></form></div>";
			        }
            }
          }
          echo "</div>";
          echo "</section>";
        }
        else
        {
          echo "0 results";
        }
        $result->free();
        mysqli_stmt_close($db1);
?>
</body>
</html>