
<?php
$sentencia = $base_de_datos->prepare("SELECT logotipo from local");
$sentencia->execute();
$logo = $sentencia->fetch(PDO::FETCH_OBJ);

?>
<link href="css/login.css" rel="stylesheet" type="text/css"/>
 <div class="container">
        <div class="card card-container">
            <img id="profile-img" class="profile-img-card" src="<?php echo $logo->logotipo?>" />
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin" method='post' action='index.php?p=logear'>
                <span id="reauth-email" class="reauth-email"></span>
                <input type="text" id="user"  name="user"class="form-control" placeholder="Usuario" required autofocus>
                <input type="password" id="contra"  name="contra" class="form-control" placeholder="Contraseña" required>
                
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Logear</button>
            </form><!-- /form -->
            
        </div><!-- /card-container -->
    </div><!-- /container -->
