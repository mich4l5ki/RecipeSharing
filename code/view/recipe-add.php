<!DOCTYPE html>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
<title>Edit Recipe</title>

<?php include("view/navbar.php"); ?>

<div class="container mt-4">
        <h1>Add Recipe</h1>

        <form action="<?= BASE_URL . "recipe/add" ?>" method="post">
            <?php if (!empty($errors)): ?>
                <ul class="list-unstyled text-danger">
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" name="title" value="" required pattern="[a-zA-Z\s]+">
            </div>
            <div class="form-group">
                    <label for="ingredients">Ingredients:</label>
                    <table class="table" id="ingredientTable">
                        <thead>
                            <tr>
                                <th>Ingredient</th>
                                <th>Amount</th>
                                <th>Unit</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><input type="text" class="form-control" name="ingredients[]" value="" required></td>
                            <td><input type="number" class="form-control" name="quantity[]" value="" required min='1'></td>
                            <td><input type="text" class="form-control" name="units[]" value=""></td>
                            <td><button class="btn btn-sm btn-danger delete-row">Delete</button></td>
                        </tr>
                        </tbody>
                    </table>
                    <button type="button" id="addIngredient" class="btn btn-primary">Add Ingredient</button>
            </div>

            <div class="form-group">
                <label for="instructions">Instructions:</label>
                <textarea class="form-control" id="instructions" name="instructions" rows="6"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </form>

        <hr>
    </div>

    <script>
$(document).ready(function() {
    $('#addIngredient').click(function(e) {
        e.preventDefault();
        var newRow = '<tr>' +
                        '<td><input type="text" class="form-control" name="ingredients[]" required></td>' +
                        '<td><input type="number" class="form-control" name="quantity[]" required min="1"></td>' +
                        '<td><input type="text" class="form-control" name="units[]"></td>' +
                        '<td><button class="btn btn-sm btn-danger delete-row">Delete</button></td>' +
                    '</tr>';
        $('#ingredientTable tbody').append(newRow);
    });

    $(document).on('click', '.delete-row', function(e) {
        e.preventDefault();
        $(this).closest('tr').remove();
    });
});
</script>