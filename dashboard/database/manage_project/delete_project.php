<?php
    require_once('../config.php');

    $id = $_POST['id'];

    $query = "DELETE FROM portfolio WHERE id = :id";

    $statement = $conn->prepare($query);

    $has_removed = $statement->execute(
        array(
            ":id" => $id
        )
    );

    if($has_removed){
        echo "1";
    }else{
        echo "Something went wrong";
    }

