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
   <link rel="stylesheet" href="style.css">
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
   <script type="text/javascript" src="skripta.js"></script>
   <script type="text/javascript">
    // Funkcija od korsinka trazi potvrdu brisanja
    function brisi(id)
    {
        var odgovor=confirm("Brisanje korisnika: Da li ste sigurni?");
        if (odgovor)
        window.location = "brisi.php?id="+id;
    }
    function izmeni(id)
    {
        window.location = "izmeni.php?id="+id;
    }
    </script>
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
                <a class="nav-link active" aria-current="page" href="indexa.php">Početna</a>
              </li>
              <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="dodajradnika.php">Dodaj radnika</a>
              </li>
              <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="dodajposlodavca.php">Dodaj poslodavca</a>
              </li>
              <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="dodajadmina.php">Dodaj admina</a>
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
if($_SESSION['choice']=='2'){
  header("location: indexr.php");
  exit;
}
?>
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
error_reporting(E_ALL);
ini_set('display_errors', 1);
$check=5;
$query = "SELECT id_u, username, email, kontakt, Ime, informacije, polozaj, iskustvo, obrazovanje, choice FROM users u JOIN radnik r ON u.id_u=r.id_r";
if(isset($_POST['pretrazi'])){
  $kriterijum=mysqli_real_escape_string($db,$_POST['pretraga']);
  $kriterijum=strtolower($kriterijum);
  $kriterijum="%". $kriterijum . "%";
  if(!empty($kriterijum)){
    $query.=" WHERE (LOWER(username) LIKE ?) OR (LOWER(email) LIKE ?) OR (kontakt LIKE ?) OR (LOWER(Ime) LIKE ?) OR (LOWER(informacije) LIKE ?) OR (LOWER(polozaj) LIKE ?)";
    $check=2;
  }
}
$db1=mysqli_stmt_init($db);
mysqli_stmt_prepare($db1, $query);
if($check==2)
{
  mysqli_stmt_bind_param($db1, "ssssss", $kriterijum, $kriterijum, $kriterijum, $kriterijum, $kriterijum, $kriterijum);
}
mysqli_stmt_execute($db1);
$result = mysqli_stmt_get_result($db1);
echo "<section style='background-color:white'>";
echo "Radnici:";
echo "<table>";
echo "<tr class=' manageRowsHeader manageRows'>";
echo "<th> korisničko ime </th>";
echo "<th> e-mail adresa </th>";
echo "<th> kontakt telefon </th>";
echo "<th> ime korisnika </th>";
echo "<th colspan='2'> informacija o korisniku </th>";
echo "<th colspan='2'> položaj korisnika </th>";
echo "<th> radno iskustvo </th>";
echo "<th colspan='2'> obrazovanje </th>";
echo "<th colspan='2'> opcije </th>";
echo "</tr>";
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
  if($row["choice"]==2)
  {
    echo "<tr class='manageRows'>";
    $id1=$row['id_u'];
    echo "<td>";
    echo $row['username'];
    echo "</td>";
    echo "<td>";
    echo $row['email'];
    echo "</td>";
    echo "<td>";
    echo $row['kontakt'];
    echo "</td>";
    echo "<td>";
    echo $row['Ime'];
    echo "</td>";
    echo "<td  colspan='2' >";
    echo $row['informacije'];
    echo "</td>";
    echo "<td colspan='2'>";
    echo $row['polozaj'];
    echo "</td>";
    echo "<td>";
    echo $row['iskustvo'];
    echo "</td>";
    echo "<td colspan='2'>";
    echo $row['obrazovanje'];
    echo "</td>";
    echo "<td><input type='button' class='btn btn-warning' id='".$row['id_u']."' value='brisi' onclick='brisi(this.id)'></td>";
    echo "<td><input type='button' class='btn btn-warning' id='".$row['id_u']."' value='izmeni' onclick='izmeni(this.id)'></td>";
    echo "</tr>";
  }
}
echo "</table>";
echo "</section>";
$query = "SELECT id_u, Naziv_firme, username, email, kontakt, struka, choice FROM users u JOIN poslodavac p ON u.id_u=p.id_p JOIN firme f ON u.id_u=f.id_poslodavca";
if(isset($_POST['pretrazi'])){
  $kriterijum=mysqli_real_escape_string($db,$_POST['pretraga']);
  $kriterijum=strtolower($kriterijum);
  $kriterijum="%". $kriterijum . "%";
  if(!empty($kriterijum)){
    $query.=" WHERE (LOWER(Naziv_firme) LIKE ?) OR (LOWER(username) LIKE ?) OR (LOWER(email) LIKE ?) OR (kontakt LIKE ?) OR (LOWER(struka) LIKE ?)";
    $check=1;
  }
}
$db1=mysqli_stmt_init($db);
mysqli_stmt_prepare($db1, $query);
if($check==1)
{
  mysqli_stmt_bind_param($db1, "sssss", $kriterijum, $kriterijum, $kriterijum, $kriterijum, $kriterijum);
}
mysqli_stmt_execute($db1);
$result = mysqli_stmt_get_result($db1);
echo "<section style='background-color:white; margin:5%'>";
echo "Poslodavci:";
echo "<table>";
echo "<tr class=' manageRowsHeader manageRows'>";
echo "<th> korisničko ime </th>";
echo "<th> e-mail adresa </th>";
echo "<th> kontakt telefon </th>";
echo "<th> ime kompanije koju predstavlja </th>";
echo "<th > struka kompanije </th>";
echo "<th colspan='2'> opcije </th>";
echo "</tr>";
while($row = $result->fetch_assoc())
{
  if($row["choice"]==1)
  {
    $id1=$row['id_u'];
    echo "<tr class='manageRows'>";
    echo "<td >";
    echo $row['username'];
    echo "</td>";
    echo "<td>";
    echo $row['email'];
    echo "</td>";
    echo "<td>";
    echo $row['kontakt'];
    echo "</td>";
    echo "<td >";
    echo $row['Naziv_firme'];
    echo "</td>";
    echo "<td >";
    echo $row['struka'];
    echo "</td>";
    echo "<td><input type='button' class='btn btn-warning' id='".$row['id_u']."' value='brisi' onclick='brisi(this.id)'></td>";
    echo "<td><input type='button' class='btn btn-warning' id='".$row['id_u']."' value='izmeni' onclick='izmeni(this.id)'></td>";
    echo "</tr>";
  }
}
echo "</table>";
echo "</section>";
echo "</div>";
echo "</section>";
$result->free();
mysqli_stmt_close($db1);
?>
</body>
</html>