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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
   <style>
        body{ font: 14px sans-serif; text-align: center;}
    </style>
    <script>
      function obrisiPrijavu(neki,nesto){
        var odgovor=confirm("Brisanje prijave: Da li ste sigurni?");
        if (odgovor)
        window.location = "obrisiprijavu.php?id="+neki+"&ogl="+nesto;
        return false;
      }
      function skiniCV(idr){
        window.jsPDF = window.jspdf.jsPDF;
        var id=idr;

        var skola=document.getElementById('obr'+id).textContent;
        var username=document.getElementById('username'+id).textContent;
        var struka=document.getElementById('polozaj'+id).textContent;
        var radni=document.getElementById('isk'+id).textContent;
        var ime=document.getElementById('imekor'+id).textContent;
        var kontakt=document.getElementById('kon'+id).textContent;
        var email=document.getElementById('email'+id).textContent;
        var opis=document.getElementById('opis'+id).textContent;
        var doc = new jsPDF();
        doc.setFontSize(20);
        doc.setFont('Times New Roman', 'bold');
        var textX = (doc.internal.pageSize.getWidth() - doc.getTextWidth(username))/2
        doc.text(textX,10,""+ime);
        doc.setFont("monospace");
        doc.setFontSize(15);
        doc.text(20, 30,"Položaj korisnika: "+ struka);
        doc.text(20, 40,"Obrazovanje: "+ skola);
        doc.text(20, 50,"Radno iskustvo: "+ radni+" godina(e)");
        doc.text(20, 60,"Informacije o korisniku: "+ opis);
        doc.text(20, 80,"Kontakt: "+ kontakt);
        doc.text(20, 90,"E-mail: "+ email);
        doc.addPage();
    
        doc.save(username+'.pdf');
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
?>
<section style='background-color:white;max-width:100%;margin:auto;height:auto;min-height:100%;position:relative;padding:50px'>

<table style='border:1px solid #ffc312;'>
<tr class='manageRowsHeader manageRows'>
    <th>Username</th>
    <th>E-mail</th>
    <th>Kontakt</th>
    <th>Ime</th>
    <th colspan='2'>Položaj</th>
    <th>Radno iskustvo</th>
    <th colspan='2'>Obrazovanje</th>
    <th colspan='1'>Postavljen CV</th>
    <th colspan='2'>Opcije</th>
</tr>
<?php
$db1=mysqli_stmt_init($db);
mysqli_stmt_prepare($db1, "SELECT id_pr, id_prijavljenog FROM prijave p JOIN oglasi o ON p.id_oglas=o.id_o WHERE p.id_oglas=?");
mysqli_stmt_bind_param($db1, "s", $_GET['id']);
mysqli_stmt_execute($db1);
$result = mysqli_stmt_get_result($db1);
if($result->num_rows>0)
{
  while($row1 = $result->fetch_assoc())
  {
    $idpr=$row1['id_pr'];
    $kid=$row1['id_prijavljenog'];
    mysqli_stmt_prepare($db1, "SELECT id_u, username, email, kontakt, Ime, polozaj, iskustvo, obrazovanje,informacije,CV from users u JOIN radnik r on u.id_u=r.id_r  WHERE id_u=?");
    mysqli_stmt_bind_param($db1, "s", $kid);
    mysqli_stmt_execute($db1);
    $res = mysqli_stmt_get_result($db1);
    if($result->num_rows>0)
    {
      while($row=$res->fetch_assoc())
      {
        echo "<tr class='manageRows'>";
        $id1=$row['id_u'];
        echo "<td id='username".$row['id_u']."'>";
        echo $row['username'];
        echo "</td>";
        echo "<td id='email".$row['id_u']."'>";
        echo $row['email'];
        echo "</td>";
        echo "<td id='kon".$row['id_u']."'>";
        echo $row['kontakt'];
        echo "</td>";
        echo "<td id='imekor".$row['id_u']."'>";
        echo $row['Ime'];
        echo "</td>";
        echo "<td id='polozaj".$row['id_u']."' colspan='2'>";
        echo $row['polozaj'];
        echo "</td>";
        echo "<td id='isk".$row['id_u']."'>";
        echo $row['iskustvo'];
        echo "</td>";
        echo "<td id='obr".$row['id_u']."' colspan='2'>";
        echo $row['obrazovanje'];
        echo "</td>";
        echo "<td id='cv".$row['id_u']."' colspan='1'>";
        if(!$row['CV'])
        {
          echo "Ne";
          echo "<td><form method='post'><input type='button'data-toggle='tooltip' data-placement='top' title='Ako nije postavljen CV možete skinuti generisan od strane informacija sa sajta' class='btn btn-warning' id='".$row['id_u']."' value='Skini CV' onclick='return skiniCV(".$row['id_u'].")'></form></td>";
        }
        else
        {
          echo "Da";
          echo "<td><form method='post'><input type='button'data-toggle='tooltip' data-placement='top' title='Ako nije postavljen CV možete skinuti generisan od strane informacija sa sajta' class='btn btn-warning' id='".$row['id_u']."' value='Skini CV' onclick='return redirektujCV(".$row['id_u'].")'></form></td>";
        }
        echo "</td>";
        echo "<td><input type='submit' class='btn btn-danger' onclick='return obrisiPrijavu($idpr,$_GET[id])' value='Obriši prijavu'></td>";
        echo "<p id='opis".$row['id_u']."' style='display:none'>".$row['informacije']."</p>";
        echo "</tr>";
      }
    }
  }
}
mysqli_stmt_close($db1);
$result->free();
?>

</table>
</section>
</body>
</html>