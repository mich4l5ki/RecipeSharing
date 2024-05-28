<!DOCTYPE html>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Recipe List</title>

<?php
$loggedIn = isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true;
if (!$loggedIn) {
    $recipes = array_slice($recipes, 0, 3);
}
?>
<?php include("view/navbar.php"); ?>

<div class="container mt-5">
    <h1 class="text-center mb-5">All Recipes</h1>
    <div class="row">
        <?php foreach ($recipes as $recipe): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-center"><?= htmlspecialchars($recipe['title']) ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted text-center">By <?= htmlspecialchars($recipe['author']) ?></h6>

                        <p class="card-text"><strong>Ingredients:</strong><br> </p>
                        <?php foreach ($recipe['ingredients'] as $ingredient): ?>
                            <p class="card-text">
                                <?= htmlspecialchars($ingredient['name']) ?>: 
                                <?= htmlspecialchars($ingredient['quantity']) ?> 
                                <?= htmlspecialchars($ingredient['unit']) ?>
                            </p>
                        <?php endforeach; ?>
                        <p class="card-text"><strong>Instructions:</strong><br>
                            <?php
                                $instructions = htmlspecialchars($recipe['instructions']);
                                if (strlen($instructions) > 100) {
                                    $instructions = substr($instructions, 0, 100) . '...';
                                }
                                echo nl2br($instructions);
                            ?>
                        </p>
                        <div class="mt-auto text-center mt-3">
                            <a href="<?= BASE_URL . 'recipe?id=' . $recipe['recipeID'] ?>" class="btn btn-primary">Show More</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <?php if (!$loggedIn): ?>
        <div class="text-center mt-4 py-2" style="height: 40px; margin: 0 auto; border: 1px solid #ccc; border-radius: 10px; overflow: hidden;">
            <p>To see more recipes, <a href="<?= BASE_URL . 'user/login' ?>" class="text-decoration-underline">log in</a>.</p>
        </div>
    <?php endif; ?>
</div>

<?php include("view/.php"); ?>