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
    echo "<section class='sectionContainer'>
    <div style='margin:10% 25%;border:2px solid #ffC312;border-radius:15px;'>
    <form method='get' class='formContainer' action='dodajadmina.php'>
   <div class='input-group form-group formedGroupAddon' style='border-radius:0 10px 10px 0;'>
                               <div class='input-group-prepend groupAddon' >
                                   <span class='input-group-text'><i class='fas fa-user normalIconContainer'></i></span>
                               </div>
                               <input class='textContainer' type='text' name='username' class='form-control' placeholder='Korisničko ime admina' required>
                           </div> 

                           <div class='input-group form-group formedGroupAddon' style='border-radius:0 10px 10px 0;'>
                           <div class='input-group-prepend groupAddon' >
                           <span class='input-group-text'><i class='fas fa-user normalIconContainer'></i></span>
                       </div>
                       <input class='textContainer' type='password' name='password' class='form-control' placeholder='Šifra admina' required>
                   </div> 


                           <div class='input-group form-group formedGroupAddon' style='border-radius:0 10px 10px 0;'>
                           <div class='input-group-prepend groupAddon'>
                           <span class='input-group-text'><i class='fas fa-envelope normalIconContainer'></i></span>
                       </div>
                       <input class='textContainer' type='email' name='email' class='form-control' placeholder='E-mail admina'required>
                   </div> 

                   <div class='input-group form-group formedGroupAddon'>
                   <div class='input-group-prepend groupAddon'>
                       <span class='input-group-text'><i class='fas fa-phone normalIconContainer'></i></span>
                   </div> 
                    <input class='telContainerBig' type='tel' id='phone' name='kontakt' pattern='^(\+\d{1,2,3}\s?)?1?\-?\.?\s?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$' placeholder='Kontakt telefon'required>
            
                   <div class='input-group-prepend' style='background-color:#FFC312;border:1px solid black;margin:0 40% 0 0;max-height:20px;width:30%'>
                   <small class='telContainerLabel'>Format:+XXX-6X-XXX-XXXX </small>
                   </div>
                   </div>
                   <input name='id' type='hidden' size='20'>
                   <button type='submit' class='btn btn-danger submitBtnStyle' value='dodaj' name='dodaj'>Sačuvaj promene</button>
                   <button type='submit'  class='btn btn-warning submitBtnStyle' onclick=\"location.href='indexa.php';return false\" value='back'>Nazad</button>
                   </div>
                   </form>
                   </div>
                   </section>
</body>
</html>";

  
    
    if(isset($_GET['dodaj']))
    {
        $db = mysqli_connect('localhost', 'root','', 'dobra_baza');
        $db1=mysqli_stmt_init($db);
        mysqli_stmt_prepare($db1, "SELECT id_u FROM users WHERE username=? OR email=? LIMIT 1");
        mysqli_stmt_bind_param($db1, "ss", $_GET['username'], $_GET['email']);
        mysqli_stmt_execute($db1);
        mysqli_stmt_bind_result($db1, $user);
        mysqli_stmt_fetch($db1);
        if ($user>0) // if user exists
        {
            array_push($errors, "Username ili email vec postoji.");
        }
        if (count($errors) == 0)
        {
            $hashed_password = password_hash($_GET['password'],PASSWORD_BCRYPT);//encrypt the password before saving in the database
            $choice=3;
            mysqli_stmt_prepare($db1, "INSERT INTO users (username, email, password,choice,kontakt) VALUES(?,?,?,?,?)");
            mysqli_stmt_bind_param($db1, "sssss", $_GET['username'], $_GET['email'], $hashed_password, $choice, $_GET['kontakt']);
            mysqli_stmt_execute($db1);
        }
        mysqli_stmt_close($db1);
        echo "<script> location.href='indexa.php'</script>";
        exit;
    }