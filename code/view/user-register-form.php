<!DOCTYPE html>

<!-- <link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>"> -->
<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<title>Register form</title>


<?php include("view/navbar.php"); ?>

<body>
<div class="container">
  <h2>Sign Up</h2>

  <?php if (!empty($errorMessage)): ?>
    <div class="alert alert-danger" role="alert">
    <?= $errorMessage ?>
    </div>
      <!-- <p class="important"><?= $errorMessage ?></p> -->
  <?php endif; ?>

  <p>Please fill this form to create an account.</p>

  <form action="<?= BASE_URL . "user/register" ?>" method="post">
    <div class="form-group">
      <label for="username">Username:</label> 
      <input type= "text" name="username" class="form-control" required autofocus pattern="[a-zA-Z0-9"/>
    </div>

    <div class="form-group">
      <label for="password">Password:</label>
      <input name="password" type="password" class="form-control" required minlength="12"/>
    </div>

    <div class="form-group">
      <label for="confirm_password">Confirm Password:</label>
      <input name="confirm_password" type="password" class="form-control"required />
    </div>

    <p><button type="submit" class="btn btn-outline-primary">Register</button><p>
    <p>Already have an account? <a href="<?= BASE_URL . "user/login" ?>">Login here</a>.</p>
  </form>
            
</div>

</body>
