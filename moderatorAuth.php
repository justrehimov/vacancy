<?php
  include 'database.php';
  include 'databasemanager.php';
  include 'cookiemanager.php';
  $error = "";
  session_start();
  if (isset($_POST['email']) && isset($_POST['password'])) {
    
    $email = $_POST['email'];
    $password = $_POST['password'];

    $moderatorData = getModeratorByEmail($email);

    if (empty($moderatorData)) {
      $error = "Email not found";
    }
    else {
      $moderatorId = $moderatorData['ID'];
      $moderatorPassword = $moderatorData['PASSWORD'];
      if (password_verify($password, $moderatorPassword)) {
        $_SESSION['moderator'] = $moderatorId;
        header("Location: moderator.php");
      }else{
        $error = "Email or password is invalid";
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Moderator login</title>
</head>
<body>
<form style="width: 50%;margin:6rem auto;" method="post" action="moderatorAuth.php">
  <div class="mb-3">
    <label class="form-label">Email address</label>
    <input type="email" class="form-control" required name="email">
  </div>
  <div class="mb-3">
    <label class="form-label">Password</label>
    <input type="password" class="form-control" required name="password">
  </div>
  <span style="color: red;"><?=$error?></span><br><br>
  <button type="submit" class="btn btn-primary">Login</button>
</form>
</body>
</html>