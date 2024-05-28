<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<?php
$loggedIn = isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true;
if ($loggedIn &&  isset($_SESSION["username"])){
    $username = $_SESSION["username"];
}

?>


<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img src="<?= IMAGES_URL . "recipe_logo.svg" ?>" width="30" height="30" class="d-inline-block align-top" alt="">
    Recipe Sharing
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0" id="navbarNav">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="<?= BASE_URL . 'recipe'?>">Recipes</a>
        </li>

        <?php if (!$loggedIn) : ?>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="<?= BASE_URL . 'user/login'?>">Log in</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="<?= BASE_URL . 'user/register'?>">Register</a>
        </li>
        <?php endif; ?>
        
        <?php if ($loggedIn) : ?>
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          My account
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="<?= BASE_URL . 'recipe?username=' . $username ?>">My recipes</a>
          <a class="dropdown-item" href="<?= BASE_URL . 'user/logout'?>">Log out</a>
        </div>
        </li>
        <?php endif; ?>

      </ul>
        
    </div>
  </div>
</nav>
