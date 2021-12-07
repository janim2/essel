<?php

    function fetchServiceIdUsing($con, $service_id){
        $query = "SELECT name FROM services WHERE id = :id";
        $statement = $con->prepare($query);

        $statement->execute(
            array(
                ":id" => $service_id
            )
        );

        return $statement->fetch()['name'];
    }

    function dateFormat($date){
        return date('l, M j, Y', strtotime($date));
    }