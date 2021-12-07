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
        $id             = $_COOKIE['edit_id'];
        $current_image  = $_COOKIE['current_image'];
        $name           = $_POST['name'];
        $worktypeid     = $_POST['category'];
        $description    = $_POST['description'];
        $date           = $_POST['date'];
     
        $query = "UPDATE portfolio SET title = :_name, image = :image, 
                service_id = :_work_type_id, 
                date = :_date, description = :_summary WHERE id = :id";
                $statement = $conn->prepare($query);

        $has_added = $statement->execute(
            array(
                ":_name"         => $name,
                ":image"         => $_FILES['img']['name'] ?? $current_image,
                ":_work_type_id" => $worktypeid,
                ":_date"         => $date,
                ":_summary"      => $description, 
                ":id"            => $id,
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
        header('location: ../../403.php');
    }

?>