<?php include('server.php');?>
<html>
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
    $db1=mysqli_stmt_init($db);
    mysqli_stmt_prepare($db1, "SELECT choice FROM users WHERE id_u=?");
    mysqli_stmt_bind_param($db1, "s", $_GET["id"]);
    mysqli_stmt_execute($db1);
    mysqli_stmt_bind_result($db1, $choice);
    mysqli_stmt_fetch($db1);
    if($choice==2) //radnik
    {
        mysqli_stmt_prepare($db1, "SELECT id_u, username, email, kontakt, Ime, informacije, polozaj, iskustvo, obrazovanje FROM users u JOIN radnik r ON u.id_u=r.id_r WHERE u.id_u=?");
        mysqli_stmt_bind_param($db1, "s", $_GET["id"]);
        mysqli_stmt_execute($db1);
        $result = mysqli_stmt_get_result($db1);
        $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
        echo "<section class='sectionContainer'>
        <div style='margin:10% 25%;border:2px solid #ffC312;border-radius:15px;'>
        <form method='get' class='formContainer' action='izmeni.php'>
       <div class='input-group form-group formedGroupAddon' style='border-radius:0 10px 10px 0;'>
                                   <div class='input-group-prepend groupAddon' >
                                       <span class='input-group-text'><i class='fas fa-user normalIconContainer'></i></span>
                                   </div>
                                   <input class='textContainer' type='text' name='username' class='form-control' placeholder='Korisnicko ime' value='$user[username]' required>
                               </div> 
                               <div class='input-group form-group formedGroupAddon' style='border-radius:0 10px 10px 0;'>
                               <div class='input-group-prepend groupAddon'>
                               <span class='input-group-text'><i class='fas fa-envelope normalIconContainer'></i></span>
                           </div>
                           <input class='textContainer' type='email' name='email' class='form-control' placeholder='e-mail' value='$user[email]' required>
                       </div> 

                       <div class='input-group form-group formedGroupAddon' style='border-radius:0 10px 10px 0;'>
                       <div class='input-group-prepend groupAddon'>
                       <span class='input-group-text'><i class='fas fa-signature normalIconContainer'></i></span>
                   </div>
                   <input class='textContainer' type='text' name='Ime' class='form-control' placeholder='Ime korisnika' value='$user[Ime]' required>
               </div> 

               <div class='input-group form-group formedGroupAddon' style='border-radius:0 10px 10px 0;'>
               <div class='input-group-prepend groupAddon'>
               <span class='input-group-text'><i class='fas fa-briefcase normalIconContainer'></i></span>
           </div>
           <textarea rows='4' cols='50' name='informacije' style='min-height:130px;max-height:300px;max-width:90%;' class='form-control' placeholder='Informacije o radniku' >$user[informacije]</textarea>
       </div> 

       <div class='input-group form-group formedGroupAddon' style='border-radius:0 10px 10px 0;'>
       <div class='input-group-prepend groupAddon'>
       <span class='input-group-text'><i class='fas fa-industry normalIconContainer'></i></span>
    </div>
    <select class='form-select selectContainer' aria-label='Izbor' name='polozaj'>
    <option disabled>Trenutni izbor:$user[polozaj]</option>
    <option value='Mašinski inženjering'>Mašinski inženjering</option>
     <option value='Softverski inženjering'>Softverski inženjering</option>
     <option value='Elektrotehnički inženjering'>Elektrotehnički inženjering</option>
     <option value='Računarski inženjering'>Računarski inženjering</option>
     <option value='Urbani inženjering'>Urbani inženjering</option>
     <option value='Hemijski inženjering'>Hemijski inženjering</option>   
     <option value='Aeronautički inženjering'>Aeronautički inženjering</option>  
     <option value='Telekomunikacioni inženjering'>Telekomunikacioni inženjering</option>  
    </optgroup>
</select> </div> 
    <div class='input-group form-group formedGroupAddon' style='border-radius:0 10px 10px 0;max-width:30%;'>
    <div class='input-group-prepend groupAddon'>
    <span class='input-group-text'><i class='fas fa-wrench normalIconContainer'></i></span>
</div>
<input type='number' min='0' max='60' name='iskustvo' class='form-control numberContainer' placeholder='Radno iskustvo' required value='$user[iskustvo]'>
</div>

<div class='input-group form-group formedGroupAddon' style='border-radius:0 10px 10px 0;'>
<div class='input-group-prepend groupAddon'>
<span class='input-group-text'><i class='fas fa-industry normalIconContainer'></i></span>
</div>
<select class='form-select selectContainer' aria-label='Izbor' name='obrazovanje'>
                            <option disabled>Trenutni izbor:$user[obrazovanje]</option>
                             <option value='Osnovna škola'>Osnovna škola</option>
                             <option value='Srednja škola'>Srednja škola</option>
                             <option value='Više strukovne studije'>Više strukovne studije</option>
                             <option value='Osnovne akademske studije'>Osnovne akademske studije</option>
                             <option value='Master akademske studije'>Master akademske studije</option>
                             <option value='Doktorske studije'>Doktorske studije</option>  
</optgroup>
</select> </div> 


       <div class='input-group form-group formedGroupAddon'>
                                   <div class='input-group-prepend groupAddon'>
                                       <span class='input-group-text'><i class='fas fa-phone normalIconContainer'></i></span>
                                   </div> 
                                    <input class='telContainerBig' type='tel' id='phone' name='kontakt' pattern='^(\+\d{1,2,3}\s?)?1?\-?\.?\s?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$' placeholder='Kontakt telefon' value='$user[kontakt]' required>
                            
                                   <div class='input-group-prepend' style='background-color:#FFC312;border:1px solid black;margin:0 40% 0 0;max-height:20px;width:30%'>
                                   <small class='telContainerLabel'>Format:+XXX-6X-XXX-XXXX </small>
                                   </div>
                                   </div>
                                   <input name='id' type='hidden' size='20' value='$user[id_u]'>
                                     <button type='submit' class='btn btn-danger submitBtnStyle' value='izmeni' name='izmeni'>Sačuvaj promene</button>
                                     <button type='submit'  class='btn btn-warning submitBtnStyle' onclick=\"location.href='indexa.php';return false\" value='back'>Nazad</button>
                                     </div>
                                   </form>
                                   </div>
                                   </section> ";
        
        
        echo "

        </body>
        </html>";
    }
    if($choice==1) //poslodavac
    {
        mysqli_stmt_prepare($db1, "SELECT id_u, Naziv_firme, username, email, kontakt, struka FROM users u JOIN poslodavac p ON u.id_u=p.id_p JOIN firme f ON u.id_u=f.id_poslodavca WHERE u.id_u=?");
        mysqli_stmt_bind_param($db1, "s", $_GET["id"]);
        mysqli_stmt_execute($db1);
        $result = mysqli_stmt_get_result($db1);
        $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
        echo "<section class='sectionContainer'>
        <div style='margin:10% 25%;border:2px solid #ffC312;border-radius:15px;'>
        <form method='get' class='formContainer' action='izmeni.php'>
       <div class='input-group form-group formedGroupAddon' style='border-radius:0 10px 10px 0;'>
                                   <div class='input-group-prepend groupAddon' >
                                       <span class='input-group-text'><i class='fas fa-user normalIconContainer'></i></span>
                                   </div>
                                   <input class='textContainer' type='text' name='username' class='form-control' placeholder='Korisnicko ime' value='$user[username]' required>
                               </div> 
                               <div class='input-group form-group formedGroupAddon' style='border-radius:0 10px 10px 0;'>
                               <div class='input-group-prepend groupAddon'>
                               <span class='input-group-text'><i class='fas fa-envelope normalIconContainer'></i></span>
                           </div>
                           <input class='textContainer' type='email' name='email' class='form-control' placeholder='e-mail' value='$user[email]' required>
                       </div> 

                       <div class='input-group form-group formedGroupAddon' style='border-radius:0 10px 10px 0;'>
                       <div class='input-group-prepend groupAddon'>
                       <span class='input-group-text'><i class='fas fa-building normalIconContainer'></i></span>
                   </div>
                   <input class='textContainer' type='text' name='naziv' class='form-control' placeholder='Ime kompanije korisnika' value='$user[Naziv_firme]' required>
               </div> 


       <div class='input-group form-group formedGroupAddon' style='border-radius:0 10px 10px 0;'>
       <div class='input-group-prepend groupAddon'>
       <span class='input-group-text'><i class='fas fa-industry normalIconContainer'></i></span>
    </div>
    <select class='form-select selectContainer' aria-label='Izbor' name='struka'>
    <option disabled>Trenutni izbor:$user[struka]</option>
    <option value='Mašinski inženjering'>Mašinski inženjering</option>
     <option value='Softverski inženjering'>Softverski inženjering</option>
     <option value='Elektrotehnički inženjering'>Elektrotehnički inženjering</option>
     <option value='Računarski inženjering'>Računarski inženjering</option>
     <option value='Urbani inženjering'>Urbani inženjering</option>
     <option value='Hemijski inženjering'>Hemijski inženjering</option>   
     <option value='Aeronautički inženjering'>Aeronautički inženjering</option>  
     <option value='Telekomunikacioni inženjering'>Telekomunikacioni inženjering</option>  
    </optgroup>
</select> </div> 




       <div class='input-group form-group formedGroupAddon'>
                                   <div class='input-group-prepend groupAddon'>
                                       <span class='input-group-text'><i class='fas fa-phone normalIconContainer'></i></span>
                                   </div> 
                                    <input class='telContainerBig' type='tel' id='phone' name='kontakt' pattern='^(\+\d{1,2,3}\s?)?1?\-?\.?\s?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$' placeholder='Kontakt telefon' value='$user[kontakt]' required>
                            
                                   <div class='input-group-prepend' style='background-color:#FFC312;border:1px solid black;margin:0 40% 0 0;max-height:20px;width:30%'>
                                   <small class='telContainerLabel'>Format:+XXX-6X-XXX-XXXX </small>
                                   </div>
                                   </div>
                                   <input name='id' type='hidden' size='20' value='$user[id_u]'>
                                     <button type='submit' class='btn btn-danger submitBtnStyle' value='izmeni' name='izmeni'>Sačuvaj promene</button>
                                     <button type='submit'  class='btn btn-warning submitBtnStyle' onclick=\"location.href='indexa.php';return false\" value='back'>Nazad</button>
                                     </div>
                                   </form>
                                   </div>
                                   </section> ";
        
        
        echo "

        </body>
        </html>";






    }
    
    if(isset($_GET['izmeni']))
    {
        if($choice==2)
        {
            mysqli_stmt_prepare($db1, "UPDATE radnik SET Ime=?, obrazovanje=?, polozaj=?, informacije=?, iskustvo=? WHERE id_r=?");
            mysqli_stmt_bind_param($db1, "ssssss", $_GET["Ime"], $_GET["obrazovanje"], $_GET["polozaj"], $_GET["informacije"], $_GET["iskustvo"], $_GET['id']);
            mysqli_stmt_execute($db1);

            mysqli_stmt_prepare($db1, "UPDATE users SET kontakt = ?, email = ?, username = ? WHERE id_u = ?");
            mysqli_stmt_bind_param($db1, "ssss", $_GET["kontakt"], $_GET["email"],$_GET["username"],$_GET['id']);
            mysqli_stmt_execute($db1);
            echo "<script> location.href='izmeni.php?id=".$_GET['id']."'</script>";
        }
        if($choice==1)
        {
            mysqli_stmt_prepare($db1, "UPDATE poslodavac SET struka = ? WHERE id_p = ?");
            mysqli_stmt_bind_param($db1, "ss", $_GET["struka"], $_GET['id']);
            mysqli_stmt_execute($db1);

            mysqli_stmt_prepare($db1, "UPDATE users SET kontakt = ?, email = ?, username = ? WHERE id_u = ?");
            mysqli_stmt_bind_param($db1, "ssss", $_GET["kontakt"], $_GET["email"],$_GET["username"],$_GET['id']);
            mysqli_stmt_execute($db1);

            mysqli_stmt_prepare($db1, "UPDATE oglasi SET kontakt = ? WHERE id_korisnika = ?");
            mysqli_stmt_bind_param($db1, "ss", $_GET["kontakt"],$_GET['id']);
            mysqli_stmt_execute($db1);

            mysqli_stmt_prepare($db1, "UPDATE firme SET Naziv_firme = ? WHERE id_poslodavca = ?");
            mysqli_stmt_bind_param($db1, "ss", $_GET["naziv"],$_GET['id']);
            mysqli_stmt_execute($db1);
            echo "<script> location.href='izmeni.php?id=".$_GET['id']."'</script>";
        }
    }
    $result->free();
    mysqli_stmt_close($db1);