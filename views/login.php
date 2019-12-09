<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Triple AAA IntrAAAnet</title>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="stylesheet" href="views/assets/css/login.css">
</head>
<body>

  <!------ Include the above in your HEAD tag ---------->

  <div class="wrapper fadeInDown">
    <div id="formContent">
      <!-- Tabs Titles -->

      <!-- Icon -->
      <div class="fadeIn first">
        <img src="<?php echo BASE_URL ?>views/assets/images/aaa-logo-500x.png" id="icon" alt="User Icon" />
      </div>

      <!-- Login Form -->
      <form method="post" action="<?php echo BASE_URL ?>login">
        <input type="text" id="login" class="fadeIn second" name="email" placeholder="Correo electrónico" required>
        <input type="password" id="password" class="fadeIn third" name="password" placeholder="Contraseña" required>
        <input type="submit" class="fadeIn fourth" value="Iniciar Sesión">
        <p class="error"><?php echo base64_decode(htmlentities($_GET['m'])) ?></p>
      </form>

      <!-- Remind Passowrd -->
      <div id="formFooter">
        <a class="underlineHover" href="#">Olvidaste tu contraseña?</a>
      </div>

    </div>
  </div>
</body>
</html>