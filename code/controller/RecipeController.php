<?php

require_once("model/RecipeDB.php");
require_once("ViewHelper.php");

class RecipeController {

    public static function index() {
        if (isset($_GET["id"])) {
            // $recipe = RecipeDB::get($_GET["id"]);
            // echo("<script>console.log('PHP: " . print_r($recipe) . "');</script>");
            ViewHelper::render("view/recipe.php", ["recipe" => RecipeDB::get($_GET["id"])]);
        } elseif (isset($_GET["username"]) && isset($_SESSION["loggedin"]) &&  $_SESSION["loggedin"] === true) {
            ViewHelper::render("view/recipe-user.php", ["recipes" => RecipeDB::getAllUser($_GET["username"])]);
        } else {
            ViewHelper::render("view/recipe-list.php", ["recipes" => RecipeDB::getAll()]);
        }
    }

    public static function recipeEditForm($dataID = null, $errors = []) {
        if (is_null($dataID)){
            $recipe = RecipeDB::get($_GET["id"]);
        } else {
            $recipe = RecipeDB::get($dataID);
        }
        
        ViewHelper::render("view/recipe-edit.php", ["recipe" => $recipe, "errors" => $errors]);
    }

    public static function editRecipe() {
        $rules = [
            "title" => [
                "filter" => FILTER_VALIDATE_REGEXP,
                "options" => ["regexp" => "/^[a-zA-Z\s]+$/"]
            ],
            "instructions" => FILTER_SANITIZE_SPECIAL_CHARS,
            "id" => [
                "filter" => FILTER_VALIDATE_INT,
                "options" => ["min_range" => 1]
            ],
            "ingredients" => [
                "filter" => FILTER_SANITIZE_SPECIAL_CHARS,
                "flags" => FILTER_REQUIRE_ARRAY
            ],
            "quantity" => [
                "filter" => FILTER_VALIDATE_INT,
                "options" => ["min_range" => 0.01],
                "flags" => FILTER_REQUIRE_ARRAY
            ],
            "units" => [
                "filter" => FILTER_SANITIZE_SPECIAL_CHARS,
                "flags" => FILTER_REQUIRE_ARRAY
            ]
        ];

        $data = filter_input_array(INPUT_POST, $rules);
        $errors["title"] = empty($data["title"]) ? "Provide the recipe title." : "";
        $errors["title"] = $data["title"] === false ? "For title use only small/capital letters and spaces" : "";
        $errors["instructions"] = empty($data["instructions"]) ? "Provide some instruction" : "";
        $errors["id"] = $data["id"] === false ? "Id should be positive number." : "";
        $errors["ingredients"] = empty($data["ingredients"]) ? "Provide some ingredients" : "";
        $errors["quantity"] = empty($data["quantity"]) ? "Provide quantiy" : "";
        $errors["quantity"] = $data["quantity"] === false ? "quantity must be float min value 0.1" : "";
        $errors["units"] = $data["units"] === false ? "unit error" : "";
        
        $isDataValid = true;
        foreach ($errors as $error) {
            $isDataValid = $isDataValid && empty($error);
        }
        if ($isDataValid) {
            RecipeDB::editRecipe($data["title"], $data["instructions"], $data["id"], $data["ingredients"], $data["quantity"], 
                $data["units"]);
            ViewHelper::redirect(BASE_URL . "recipe?id=" . $data["id"]);
        } else {
            self::recipeEditForm($data["id"], $errors);
        }
    }

    public static function delete() {
        $rules = [
            "id" => [
                "filter" => FILTER_VALIDATE_INT,
                "options" => ["min_range" => 1]
            ]
        ];
        $data = filter_input_array(INPUT_POST, $rules);

        RecipeDB::delete($data["id"]);
        ViewHelper::redirect(BASE_URL . 'recipe?username=' . $_SESSION["username"]);
    }

    public static function addRecipeForm($errors = []) {        
        ViewHelper::render("view/recipe-add.php", ["errors" => $errors]);
    }

    public static function addRecipe() {
        $rules = [
            "title" => [
                "filter" => FILTER_VALIDATE_REGEXP,
                "options" => ["regexp" => "/^[a-zA-Z\s]+$/"]
            ],
            "instructions" => FILTER_SANITIZE_SPECIAL_CHARS,
            "ingredients" => [
                "filter" => FILTER_SANITIZE_SPECIAL_CHARS,
                "flags" => FILTER_REQUIRE_ARRAY
            ],
            "quantity" => [
                "filter" => FILTER_VALIDATE_INT,
                "options" => ["min_range" => 0.01],
                "flags" => FILTER_REQUIRE_ARRAY
            ],
            "units" => [
                "filter" => FILTER_SANITIZE_SPECIAL_CHARS,
                "flags" => FILTER_REQUIRE_ARRAY
            ]
        ];

        $data = filter_input_array(INPUT_POST, $rules);
        $errors["title"] = empty($data["title"]) ? "Provide the recipe title." : "";
        $errors["title"] = $data["title"] === false ? "For title use only small/capital letters and spaces" : "";
        $errors["instructions"] = empty($data["instructions"]) ? "Provide some instruction" : "";
        $errors["ingredients"] = empty($data["ingredients"]) ? "Provide some ingredients" : "";
        $errors["quantity"] = empty($data["quantity"]) ? "Provide quantiy" : "";
        $errors["quantity"] = $data["quantity"] === false ? "quantity must be float min value 0.1" : "";
        $errors["units"] = $data["units"] === false ? "unit error" : "";
        
        $isDataValid = true;
        foreach ($errors as $error) {
            $isDataValid = $isDataValid && empty($error);
        }
        
        if ($isDataValid) {
            $recipeID = RecipeDB::addRecipe($data["title"], $data["instructions"], $data["ingredients"], $data["quantity"], 
                $data["units"], $_SESSION["userID"]);
            ViewHelper::redirect(BASE_URL . "recipe?id=" . $recipeID);
        } else {
            self::addRecipeForm($errors);
        }
    }

}