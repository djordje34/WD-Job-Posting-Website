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
    <script>
      function obrisiPrijavu(neki){
        var odgovor=confirm("Brisanje prijave: Da li ste sigurni?");
        if (odgovor)
        window.location = "obrisiprijavu.php?id="+neki;
        return false;
      }

    </script>
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
                <a class="nav-link active" aria-current="page" href="indexp.php">Početna</a>
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
?>
<section style='background-color:white;max-width:100%;margin:auto;height:auto;min-height:100%;position:relative;padding:50px'>

<table style='border:1px solid #ffc312;'>
<tr class='manageRowsHeader manageRows'>
    <th>Ime kompanije</th>
    <th>Lokacija kompanije</th>
    <th>Nivo obrazovanja</th>
    <th>Tip inženjeringa</th>
    <th>Kontakt telefon</th>
    <th colspan='2'>Opis posla</th>
    <th colspan='2'>Datum prijave</th>
</tr>
<?php
$db1=mysqli_stmt_init($db);
$uid=get_user_ID($_SESSION['username']);
mysqli_stmt_prepare($db1, "SELECT id_pr, Naziv_firme, lokacija, sprema, struka, kontakt, opis, Datum_prijave FROM radnik r JOIN prijave p ON r.id_r=p.id_prijavljenog JOIN oglasi o ON p.id_oglas=o.id_o JOIN firme f ON f.id_f=o.id_firme WHERE p.id_prijavljenog=?");
mysqli_stmt_bind_param($db1, "s", $uid);
mysqli_stmt_execute($db1);
$result = mysqli_stmt_get_result($db1);
if($result->num_rows>0){
  while($row = $result->fetch_assoc()){
    $rok=date("d.m.Y.", strtotime($row["Datum_prijave"]));
    $idpr=$row['id_pr'];
        echo "<tr class='manageRows'>";
        echo "<td>";
        echo $row['Naziv_firme'];
        echo "</td>";
        echo "<td>";
        echo $row['lokacija'];
        echo "</td>";
        echo "<td>";
        echo $row['sprema'];
        echo "</td>";
        echo "<td>";
        echo $row['struka'];
        echo "</td>";
        echo "<td colspan='2'>";
        echo $row['kontakt'];
        echo "</td>";
        echo "<td>";
        echo $row['opis'];
        echo "</td>";
        echo "<td colspan='2'>";
        echo $rok;
        echo "</td>";
        echo "<td><input type='submit' class='btn btn-danger' onclick='return obrisiPrijavu($idpr)' value='Obriši prijavu'></td>";
        echo "</tr>";
}
}
$result->free();
?>

</table>
</section>
</body>
</html>