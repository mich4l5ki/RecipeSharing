<?php

require_once "DBInit.php";

class RecipeDB {

    public static function get($id) {
        $db = DBInit::getInstance();

        $statement = $db->prepare(
            "SELECT recipe.recipeID, user.username AS author, title, instructions, recipeIngredients.ingredient, recipeIngredients.quantity, recipeIngredients.unit
            FROM recipe
            JOIN user ON recipe.userID = user.userID
            LEFT JOIN recipeIngredients ON recipe.recipeID = recipeIngredients.recipeID
            WHERE recipe.recipeID = :id"
        );
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        if ($result != null) {
            $recipe = [
                'recipeID' => $result[0]['recipeID'],
                'author' => $result[0]['author'],
                'title' => $result[0]['title'],
                'instructions' => $result[0]['instructions'],
                'ingredients' => []
            ];

            foreach ($result as $row) {
                $recipe['ingredients'][] = [
                    'name' => $row['ingredient'],
                    'quantity' => $row['quantity'],
                    'unit' => $row['unit']
                ];
            }

            return $recipe;
        } else {
            throw new InvalidArgumentException("No record with id $id");
        }
    }

    public static function getAll() {
        $db = DBInit::getInstance();
    
        $statement = $db->prepare(
            "SELECT recipe.recipeID, user.username AS author, title, instructions, recipeIngredients.ingredient, recipeIngredients.quantity, recipeIngredients.unit
            FROM recipe
            JOIN user ON recipe.userID = user.userID
            LEFT JOIN recipeIngredients ON recipe.recipeID = recipeIngredients.recipeID"
        );
        $statement->execute();
    
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    
        // Group the ingredients by recipeID
        $recipes = RecipeDB::GetRecipesWithIngredients($result);
    
        return $recipes;
    }

    public static function getAllUser($username) {
        $db = DBInit::getInstance();
    
        $statement = $db->prepare(
            "SELECT recipe.recipeID, user.username AS author, title, instructions, recipeIngredients.ingredient, recipeIngredients.quantity, recipeIngredients.unit
            FROM recipe
            JOIN user ON recipe.userID = user.userID
            LEFT JOIN recipeIngredients ON recipe.recipeID = recipeIngredients.recipeID
            WHERE user.username = :username"
        );
        $statement->bindParam(":username", $username, PDO::PARAM_STR);
        $statement->execute();
    
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    
        // Group the ingredients by recipeID
        $recipes = RecipeDB::GetRecipesWithIngredients($result);
    
        return $recipes;
    }

    public static function GetRecipesWithIngredients($result) {
        $recipes = [];
        foreach ($result as $row) {
            $recipeID = $row['recipeID'];
            if (!isset($recipes[$recipeID])) {
                $recipes[$recipeID] = [
                    'recipeID' => $row['recipeID'],
                    'author' => $row['author'],
                    'title' => $row['title'],
                    'instructions' => $row['instructions'],
                    'ingredients' => []
                ];
            }
            $recipes[$recipeID]['ingredients'][] = [
                'name' => $row['ingredient'],
                'quantity' => $row['quantity'],
                'unit' => $row['unit']
            ];
        }

        return array_values($recipes);
    }

    public static function editRecipe($title, $instructions, $id, $ingredients, $quantity, $units) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("UPDATE recipe SET title = :title, instructions = :instructions WHERE recipeID = :id");

        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->bindParam(":title", $title, PDO::PARAM_STR);
        $statement->bindParam(":instructions", $instructions, PDO::PARAM_STR);
        $statement->execute();

        $statement = $db->prepare("DELETE FROM recipeIngredients WHERE recipeID = :recipeID");
        $statement->bindParam(":recipeID", $id, PDO::PARAM_INT);
        $statement->execute();

        foreach ($ingredients as $key => $ingredient) {
            $statement = $db->prepare("INSERT INTO recipeIngredients (recipeID, ingredient, quantity, unit) VALUES (:recipeID, :ingredient, :quantity, :unit)");
            $statement->bindParam(":recipeID", $id, PDO::PARAM_INT);
            $statement->bindParam(":ingredient", $ingredient);
            $statement->bindParam(":quantity", $quantity[$key]);
            $statement->bindParam(":unit", $units[$key]);
            $statement->execute();
        }
    }

    public static function delete($id) {
        $db = DBInit::getInstance();
        
        $statement = $db->prepare("DELETE FROM recipe WHERE recipeID = :recipeID");
        $statement->bindParam(":recipeID", $id, PDO::PARAM_INT);
        $statement->execute();
    }

    public static function addRecipe($title, $instructions, $ingredients, $quantity, $units, $userID) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("INSERT INTO recipe (title, instructions, userID) VALUES (:title, :instructions, :userID)");

        $statement->bindParam(":title", $title, PDO::PARAM_STR);
        $statement->bindParam(":instructions", $instructions, PDO::PARAM_STR);
        $statement->bindParam(":userID", $userID, PDO::PARAM_INT);
        $statement->execute();

        $recipeID = $db->lastInsertId();

        foreach ($ingredients as $key => $ingredient) {
            $statement = $db->prepare("INSERT INTO recipeIngredients (recipeID, ingredient, quantity, unit) VALUES (:recipeID, :ingredient, :quantity, :unit)");
            $statement->bindParam(":recipeID", $recipeID, PDO::PARAM_INT);
            $statement->bindParam(":ingredient", $ingredient);
            $statement->bindParam(":quantity", $quantity[$key]);
            $statement->bindParam(":unit", $units[$key]);
            $statement->execute();
        }

        return $recipeID;
    }
}
