<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Register Form</title>

<h1>Please Register</h1>

<?php if (!empty($errorMessage)): ?>
    <p class="important"><?= $errorMessage ?></p>
<?php endif; ?>

<!-- <form action="<?= BASE_URL . "user/register" ?>" method="post">
    <p>
        <label>Username: <input type="text" name="username" autocomplete="off" 
            required autofocus /></label><br/>
        <label>Password: <input type="password" name="password" required /></label>
    </p>
    <p><button>Log-in</button></p>
</form> -->

<form action="<?= BASE_URL . "user/register" ?>" method="post">
  <label for="username">Username:</label> 
  <input id="username" name="username" required autofocus type="text" />

  <label for="email">Email:</label>
  <input id="email" name="email" required="" type="email" />

  <label for="password">Password:</label>
  <input id="password" name="password" required="" type="password" />

  <input name="register" type="submit" value="Register" />
</form>