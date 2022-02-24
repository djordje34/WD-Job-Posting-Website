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
                <a class="nav-link active" aria-current="page" href="indexr.php">Početna</a>
              </li>
              <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="profil.php">Podešavanja profila</a>
              </li>
              <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="prijave.php">Vaše prijave</a>
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
if($_SESSION['choice']=='3'){
  header("location: indexa.php");
  exit;
}
?>
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
                              <div style='max-width:15%;width:15%;min-height:60%;background-color:#212529;z-index:3;position:fixed;border:1px solid #ffc312'>
                              
                            <?php
                            if(!$_GET)
                            echo"
                            <div style='border-bottom:1px solid #ffc312;padding:5px;color:#FFC312;text-align:center'>
                            
                            <table>
                            <tr class='searchRows searchHeader'>
                                  <th colspan='2' style='color:#FFC312;'>Struka</th>
                                  </tr>
                                  <tr class='searchRows'>
                                    <td>Mašinski inženjering</td>
                                    <td>
                                    <input type='radio' name='struka' id='s1' value='Mašinski inženjering' style='margin:4px'>
                                    </td>
                                  </tr>
                                  <tr class='searchRows'>
                                    <td>Softverski inženjering</td>
                                    <td>
                                    <input type='radio' name='struka' id='s2' value='Softverski inženjering' style='margin:4px'>
                                    </td>
                                  </tr>
                                  <tr class='searchRows'>
                                    <td>Elektrotehnički inženjering</td>
                                    <td>
                                    <input type='radio' name='struka' value='Elektrotehnički inženjering' id='s3' style='margin:4px'>
                                    </td>
                                  </tr>
                                  <tr class='searchRows'>
                                    <td>Računarski inženjering</td>
                                    <td>
                                    <input type='radio' name='struka' id='s4' value='Računarski inženjering' style='margin:4px'>
                                    </td>
                                  </tr>
                                  <tr class='searchRows'>
                                    <td>Urbani inženjering</td>
                                    <td>
                                    <input type='radio' name='struka' id='s5'  value='Urbani inženjering' style='margin:4px'>
                                    </td>
                                  </tr>
                                  <tr class='searchRows'>
                                    <td>Hemijski inženjering</td>
                                    <td>
                                    <input type='radio' name='struka' id='s6' value='Hemijski inženjering'  style='margin:4px'>
                                    </td>
                                  </tr>
                                  <tr class='searchRows'>
                                    <td>Aeronautički inženjering</td>
                                    <td>
                                    <input type='radio' name='struka' value='Aeronautički inženjering' id='s7' style='margin:4px'>
                                    </td>
                                  </tr>
                                  <tr class='searchRows'>
                                    <td>Telekomunikacioni inženjering</td>
                                    <td>
                                    <input type='radio' name='struka' value='Telekomunikacioni inženjering' id='s8' style='margin:4px'>
                                    </td>
                                  </tr>
                            </table>
                             </div>";
  ?>
  <div style='border-bottom:1px solid #ffc312;padding:5px;color:#FFC312;text-align:center'>
                            <table>
                            <tr class='searchRows searchHeader'>
                                  <th colspan='2' style='color:#FFC312;'>Obrazovanje</th>
                                  </tr>
                                  <tr class='searchRows'>
                                    <td>Osnovna škola</td>
                                    <td>
                                    <input type='radio' name='obrazovanje' id='o1' value='Osnovna škola' style='margin:4px'>
                                    </td>
                                  </tr>
                                  <tr class='searchRows'>
                                    <td>Srednja škola</td>
                                    <td>
                                    <input type='radio' name='obrazovanje' id='o2' value='Srednja škola' style='margin:4px'>
                                    </td>
                                  </tr>
                                  <tr class='searchRows'>
                                    <td>Viša škola</td>
                                    <td>
                                    <input type='radio' name='obrazovanje' id='o3' value='Viša škola' style='margin:4px'>
                                    </td>
                                  </tr>
                                  <tr class='searchRows'>
                                    <td>Osnovne studije</td>
                                    <td>
                                    <input type='radio' name='obrazovanje' value='Osnovne studije'id='o4' style='margin:4px'>
                                    </td>
                                  </tr>
                                  <tr class='searchRows'>
                                    <td>Master studije</td>
                                    <td>
                                    <input type='radio' name='obrazovanje' id='o5' value='Master studije' style='margin:4px'>
                                    </td>
                                  </tr>
                                  <tr class='searchRows'>
                                    <td>Doktorske studije</td>
                                    <td>
                                    <input type='radio' name='obrazovanje' id='o6' value='Doktorske studije' style='margin:4px'>
                                    </td>
                                  </tr>
                            </table>
  </div>
                            <div style='border-bottom:1px solid #ffc312;padding:5px;color:#FFC312;text-align:center'>
                            <table>
                            <tr class='searchRows searchHeader'>
                                  <th colspan='2' style='color:#FFC312;'>Datum</th>
                                  </tr>
                                  <tr class='searchRows'>
                                    <td>Prijava do:</td>
                                    <td>
                                    <input type='date' id='start' name='prijavaDo' value='2022-01-01' min='2022-01-01' max='2023-12-31' style='background-color:#212529;color:#ffc312'>
                                    </td>
                                  </tr>
  </table>  
                            
  </div>
  </form>
      </section>
<?php
      $filter1='%%';
      $filter2='%%';
      $kriterijum='%%';
      $date=time();
      $query="SELECT slika, id_o, Naziv_firme, lokacija, sprema, struka, rok, o.kontakt, opis FROM oglasi o JOIN firme f ON o.id_firme=f.id_f JOIN users u ON o.id_korisnika=u.id_u WHERE ((LOWER(Naziv_firme) LIKE ?) OR (LOWER(lokacija) LIKE ?) OR (LOWER(opis) LIKE ?) OR (o.kontakt LIKE ?)) AND struka LIKE ? AND sprema LIKE ?";
      //PRETRAGA
      if(isset($_POST['pretrazi'])){ 
        if(!empty($kriterijum)){
          $kriterijum=mysqli_real_escape_string($db,$_POST['pretraga']);
          $kriterijum=strtolower($kriterijum);
          $kriterijum="%". $kriterijum . "%";
        }
          if(!empty($_POST['obrazovanje']) && !empty($_POST['struka']))
          {
            $filter1=$_POST['struka'];
            $filter2=$_POST['obrazovanje'];
          }
          elseif(!empty($_POST['struka']))
          {
            $filter1=$_POST['struka'];
          }
          elseif(!empty($_POST['obrazovanje']))
          {
            $filter2=$_POST['obrazovanje'];
          }
          if(strtotime($_POST['prijavaDo'])!=1640991600)
          {
            $date=strtotime($_POST['prijavaDo']);
          }
      }
      if(isset($_GET['naziv'])){
        $kriterijum=$_GET['naziv'];
        }
        //QUERY EXECUTE
        $db1=mysqli_stmt_init($db);
        mysqli_stmt_prepare($db1, $query);
        mysqli_stmt_bind_param($db1, "ssssss", $kriterijum, $kriterijum, $kriterijum, $kriterijum ,$filter1, $filter2);
        mysqli_stmt_execute($db1);
        $result = mysqli_stmt_get_result($db1);
        //PRIKAZ OGLASA
        if ($result->num_rows >= 0)
        {
          mysqli_stmt_fetch($db1);
          echo "<section class='sectionContainer'>";
          echo "<div id='vise' style='position:fixed;display:none;z-index:100;background: rgba(128,128,128, 0.7);margin:auto ;min-width:70%;min-height:80%;width:80%;right:10%;left:10%;top:auto;bottom:10%;border:3px solid #FFC312;border-radius:60px;' >";
          echo "<button class='btn btn-warning btn-sm' style='right:0;position:absolute;margin:2%; border-radius:50px; width:30px;' onclick='return ugasi()' name='ugasi'><b>x</b></button>";
          echo "<div id='contents' style='font-size:17px ;border:3px solid #FFC312;margin:5% 20% 0 20%;background-color:grey;border-radius:20px;'></div>";
          echo "<button class='btn btn-danger ' style='margin:7% 0 0% 0;border:1px solid black;' onclick='return prijaviMe()' name='prijavi'>Prijavi me</button>";
          echo "</div>";
          while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
          {
            if(strtotime($row['rok'])>$date)
            {
              $slika=$row['slika'];
              $id1=$row['id_o'];
              if($slika=='')
              {
                echo "<div id='$id1' style='position:relative;background-color:#212529;display:inline-block;width:auto;max-width:300px;height:auto;border:1px solid #212529;margin:10px;border-radius:20px;padding:auto;'\><img style='border:1px solid #212529;border-radius:15px;' src='slike/default.jpg' alt='neka slika'\>" ."<p style='font-size:15px;margin:10%;padding:5px;background-color:#FFC312;opacity:0.85;border:1px solid #FFC312;border-radius:20px;'\>"."Ime kompanije:<b>" .$row["Naziv_firme"]. "  </b><br>Lokacija:<b>" . $row["lokacija"]. "  </b><br>Minimal nivo obrazovanja:<b>" .$row["sprema"]."  </b><br>Tip inženjerstva:<b>".$row["struka"]."  </b>"."</b><br>Prijava moguća do:<b>".date("d.m.Y.", strtotime($row["rok"]))."  </b><br>Kontakt:<b>".$row['kontakt'] ."</b>"."<br><p style='display:none'>".$row['opis']."</p>"."<p style='display:none'>".$username."<p style='display:none'>".$row['id_o']."</p>"."</p></p><br><form method='post'> <button onclick='return prikaziVise($id1)' class='btn btn-danger' name='prikaz' value='$id1' style='border:2px solid black;margin:-10px 0 10px 0;'>Pogledaj više </button></form></div>";
			        }
			        else
			        {
				        echo "<div id='$id1' style='position:relative;background-color:#212529;display:inline-block;width:auto;max-width:300px;height:auto;border:1px solid #212529;margin:10px;border-radius:20px;padding:auto;'\><img style='border:1px solid #212529;border-radius:15px;' src=\"slike/$slika\" alt='neka slika'\>" ."<p style='font-size:15px;margin:10%;padding:5px;background-color:#FFC312;opacity:0.85;border:1px solid #FFC312;border-radius:20px;'\>"."Ime kompanije:<b>" .$row["Naziv_firme"]. "  </b><br>Lokacija:<b>" . $row["lokacija"]. "  </b><br>Minimal nivo obrazovanja:<b>" .$row["sprema"]."  </b><br>Tip inženjerstva:<b>".$row["struka"]."  </b>"."</b><br>Prijava moguća do:<b>".date("d.m.Y.", strtotime($row["rok"]))."  </b><br>Kontakt:<b>".$row['kontakt'] ."</b>"."<br><p style='display:none'>".$row['opis']."</p>"."<p style='display:none'>".$username."<p style='display:none'>".$row['id_o']."</p>"."</p></p><br><form method='post'> <button onclick='return prikaziVise($id1)' class='btn btn-danger' name='prikaz' value='$id1' style='border:2px solid black;margin:-10px 0 10px 0;'>Pogledaj više </button></form></div>";
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