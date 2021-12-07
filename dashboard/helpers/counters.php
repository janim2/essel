<?php

    function countProjects($con){
        $query = "SELECT * FROM portfolio";
        $statement = $con->prepare($query);

        $statement->execute();

        return $statement->rowCount();
    }