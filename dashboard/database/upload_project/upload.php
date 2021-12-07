<?php
    session_start();
    require_once('../config.php');
    if(isset($_POST['name'])){
        $targetPath = "";

        if (is_array($_FILES)) {
            //image one upload
            if (is_uploaded_file($_FILES['img']['tmp_name'])) {
                $sourcePath = $_FILES['img']['tmp_name'];
                $targetPath = "../../uploads/projects/" . $_FILES['img']['name'];
                if (move_uploaded_file($sourcePath, $targetPath)) {
                }
            }


        }

        $name           = $_POST['name'];
        $worktypeid     = $_POST['category'];
        $description    = $_POST['description'];
        $date           = $_POST['date'];
        
        $is_present_query = "SELECT * FROM portfolio WHERE title = :name
            AND service_id = :worktypeid  AND date = :date AND description = :_description";
        $is_present_statement = $conn->prepare($is_present_query);

        $is_present_statement->execute(
            array(
                ":name"             => $name,
                ":worktypeid"       => $worktypeid,
                ":date"             => $date,
                ":_description"     => $description,
            )
        );
        $count = $is_present_statement->rowCount();
        if($count == 0){
            $query = "INSERT INTO portfolio(title, image, service_id, date, description) 
            VALUES(:_name, :image,  :_work_type_id, :_date, :_summary)";
            $statement = $conn->prepare($query);
    
            $has_added = $statement->execute(
                array(
                    ":_name"         => $name,
                    ":image"         => $_FILES['img']['name'],
                    ":_work_type_id" => $worktypeid,
                    ":_date"         => $date,
                    ":_summary"      => $description, 
                )
            );
    
            if($has_added){
                echo "1";
            }
            else{
                echo "Something went wrong";
            }
        }
        else{
            echo "Project already exists";
        }
        
    }
    else{
        header('location: ../../403.php');
    }

?>