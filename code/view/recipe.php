<!DOCTYPE html>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
<title>Recipe details</title>

<?php include("view/navbar.php"); ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-lg-8">
            <article>
                <header class="mb-4">
                    <h1 class="fw-bolder mb-1"><?= $recipe["title"] ?></h1>
                    <div class="text-muted fst-italic mb-2">Posted by: <?= $recipe["author"] ?></div>
                </header>
                <figure class="mb-4"><img class="img-fluid rounded" src="<?= IMAGES_URL . "food_background.jpg" ?>"  alt="..." /></figure>
                <section class="mb-5">
                    <h3 class="fw-bolder mb-4 mt-5">Ingredients:</h3>
                    <?php foreach ($recipe['ingredients'] as $ingredient): ?>
                        <p class="fs-5 mb-4">
                            <?= ($ingredient['name']) ?>: 
                            <?= ($ingredient['quantity']) ?> 
                            <?= ($ingredient['unit']) ?>
                        </p>
                    <?php endforeach; ?>

                    <h3 class="fw-bolder mb-4 mt-5">Instructions:</h3>
                    <p class="fs-5 mb-4"><?= $recipe["instructions"] ?></p>
                </section>
            </article>
        </div>
    </div>
</div>
