<!DOCTYPE html>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
<title>Login form</title>

<?php include("view/navbar.php"); ?>

<body>
<div class="container">
  <h2>Sign In</h2>

  <?php if (!empty($errorMessage)): ?>
    <div class="alert alert-danger" role="alert">
    <?= $errorMessage ?>
    </div>
  <?php endif; ?>

  <p>Please fill this form to sign in.</p>

  <form action="<?= BASE_URL . "user/login" ?>" method="post">
    <div class="form-group">
      <label for="username">Username:</label> 
      <input type= "text" name="username" class="form-control" required autofocus/>
    </div>

    <div class="form-group">
      <label for="password">Password:</label>
      <input name="password" type="password" class="form-control" required/>
    </div>

    <p><button type="submit" class="btn btn-outline-primary">Log In</button><p>
    <p>Don't have an account?  <a href="<?= BASE_URL . "user/register" ?>">Register here</a>.</p>
  </form>
</div>

</body>
