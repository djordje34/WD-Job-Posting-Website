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
    <script type="text/javascript" src="skripta.js">   </script>
   <style>
        body{ font: 14px sans-serif; text-align: center;}
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
      <section>
    <div id='shadowed' style='display:none;'>
    </div>
    <form method="post" style="width:80%">
    <div class="input-group form-group formedGroupAddon" style="min-width:40%;margin:0">

                            <div class="input-group-prepend groupAddon" style="margin-top:0;">
                                <span class="input-group-text"><i class="fas fa-search "style="margin:5px 5px 5px 5px;" ></i></span>
                            </div>
                            <input type="text" name="pretraga" class="form-control searchbarStyle" placeholder="Pretraži po imenu, lokaciji...">
                            <button type="submit" name="pretrazi" class="btn btn-warning" style="border:1px solid black;font-weight:500">Pretraži</button>

                              </div>
    </form>
      <?php
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
{
  header("location: index.php");
  exit;
}
if($_SESSION['choice']=='2')
{
  header("location: indexr.php");
  exit;
}
$check=15;
$query='SELECT id_o, slika, Naziv_firme, lokacija, sprema, struka, o.kontakt, rok, opis FROM oglasi o JOIN users u ON o.id_korisnika=u.id_u JOIN firme f ON o.id_firme=f.id_f WHERE u.username=?';
if(isset($_POST['pretrazi'])){ 
  $kriterijum=mysqli_real_escape_string($db,$_POST['pretraga']);
  $kriterijum=strtolower($kriterijum);
  $kriterijum="%". $kriterijum . "%";
  if(!empty($kriterijum)){
    $query.=" AND ((LOWER(Naziv_firme) LIKE ?) OR (LOWER(lokacija) LIKE ?) OR (LOWER(opis) LIKE ?) OR (LOWER(sprema) LIKE ?) OR (o.kontakt LIKE ?))";
    $check=2;
  }
}
$db1=mysqli_stmt_init($db);
mysqli_stmt_prepare($db1, $query);
if($check==2)
{
  mysqli_stmt_bind_param($db1, "ssssss", $_SESSION['username'], $kriterijum, $kriterijum, $kriterijum, $kriterijum, $kriterijum);
}
else
{
  mysqli_stmt_bind_param($db1, "s", $_SESSION['username']);
}
mysqli_stmt_execute($db1);
$result = mysqli_stmt_get_result($db1);
if ($result->num_rows >= 0)
{
  echo "<section class='sectionContainer'>";
  while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
  {
    $id1=$row['id_o'];
    $slika=$row['slika'];
    $kek="kompanijanp.php?ime=" . $row['Naziv_firme'] . "&lokacija=" . $row['lokacija'] . "&inz=" . $row['struka'] . "&kont=" . $row['kontakt'];
    if($slika=='')
    {
      echo "<div id='$id1' style='position:relative;background-color:#212529;display:inline-block;width:auto;max-width:300px;height:auto;border:1px solid #212529;margin:10px;border-radius:20px;'\><img style='border:1px solid #212529;border-radius:15px;' src='slike/default.jpg' alt='neka slika'\>" ."<p style='font-size:15px;margin:10px;padding:5px;background-color:#FFC312;opacity:0.85;border:1px solid #FFC312;border-radius:20px;'\>"."Ime kompanije:<b> <a style='text-decoration: none;color:red;' href='$kek'>" .str_replace("'","`",$row["Naziv_firme"]). "</a>  </b><br>Lokacija:<b>" . $row["lokacija"]. "  </b><br>Minimal nivo obrazovanja:<b>" .$row["sprema"]."  </b><br>Tip inženjerstva:<b>".$row["struka"]."  </b>"."</b><br>Prijava moguća do:<b>".date("d.m.Y.", strtotime($row["rok"]))."  </b><br>Kontakt:<b>".$row['kontakt'] ."</b>"."<br><p style='display:none'>".$row['opis']."</p>"."<p style='display:none'>".$username."</p></p><br>;<button onclick='window.location.href=\"promenioglas.php?id=\"+$id1;' class='btn btn-danger' name='promeni' value='$id1'style='border:2px solid black;margin:-10px 0 10px 0;'>Izmeni</button>";
    }
    else
    {
      echo "<div id='$id1' style='position:relative;background-color:#212529;display:inline-block;width:auto;max-width:300px;height:auto;border:1px solid #212529;margin:10px;border-radius:20px;'\><img style='border:1px solid #212529;border-radius:15px;' src=\"slike/$slika\" alt='neka slika'\>" ."<p style='font-size:15px;margin:10px;padding:5px;background-color:#FFC312;opacity:0.85;border:1px solid #FFC312;border-radius:20px;'\>"."Ime kompanije:<b> <a style='text-decoration: none;color:red;' href='$kek'>" .str_replace("'","`",$row["Naziv_firme"]). "</a>  </b><br>Lokacija:<b>" . $row["lokacija"]. "  </b><br>Minimal nivo obrazovanja:<b>" .$row["sprema"]."  </b><br>Tip inženjerstva:<b>".$row["struka"]."  </b>"."</b><br>Prijava moguća do:<b>".date("d.m.Y.", strtotime($row["rok"]))."  </b><br>Kontakt:<b>".$row['kontakt'] ."</b>"."<br><p style='display:none'>".$row['opis']."</p>"."<p style='display:none'>".$username."</p></p><br>;<button onclick='window.location.href=\"promenioglas.php?id=\"+$id1;' class='btn btn-danger' name='promeni' value='$id1'style='border:2px solid black;margin:-10px 0 10px 0;'>Izmeni</button>";
    }
    echo "<button class='btn btn-warning' name='prijave' value='$id1' onclick='return kaPrijavama($id1)' style='border:2px solid black;margin:-10px 0 10px 0;'>Prikaži prijave</button>";
    echo "<form method='post'><button class='btn btn-dark' name='obrisi' value='$id1' style='border:2px solid black;margin:-5px 0 10px 0px;'>Obriši oglas</button></form></div>";
  }
  echo "</div>";
  echo "</section>";
}
else
{
  echo "0 results";
}
mysqli_stmt_close($db1);
$result->free();
  ?>
</body>
</html>