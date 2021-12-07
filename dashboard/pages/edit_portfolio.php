<?php 
  require_once '../partials/header.php'; 
  require_once '../database/config.php';

  $id = $_GET['p_id'];

  $pquery = "SELECT * FROM portfolio WHERE id = :id";
  $pstatement = $conn->prepare($pquery);

  $pstatement->execute(
    array(
      ":id" => $id,
    )
  );

  $presult = $pstatement->fetch();
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- partial -->
<div class="main-panel">
<div class="content-wrapper">
  <div class="row">

    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Edit - <?= $presult['title']; ?></h4>
          <p class="card-description">
            Project Information
          </p>
          <form class="forms-sample" id="upload_form">
            <div class="form-group">
              <label for="exampleInputName1">Name</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="<?= $presult['title']?>" required>
            </div>

            <div class="form-group">
              <label for="exampleSelectGender">Category</label>
              <select class="form-control" id="category" name="category" required>
                <?php
                        $querry='select * from services';
                        $statement=$conn->prepare($querry);
                        $statement->execute();
                        $result=$statement->fetchAll(PDO::FETCH_ASSOC);
                        
                        foreach($result as $results){
                          if($presult['service_id'] == $results['id']){?>
                  <option selected="selected" value="<?=$results['id']?>"><?=$results['name']?></option>
                  <?php
                            }
                            else{?>
                  <option value="<?=$results['id']?>"><?=$results['name']?></option>
                  <?php
                          }
                            ?>
                  <?php
                        }?>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleSelectGender">Date</label>
                <input type="date" class="form-control" id="date" name="date" value="<?= $presult['date']?>" required>
            </div>


            <div class="form-group">  
              <label>File upload</label>
              <input type="file" name="img" id="img" class="file-upload-default">
              <div class="">
                  <img src="../uploads/projects/<?= $presult['image'];?>" style="width: 150px; height: 150px;object-fit:cover; margin-bottom:5px">
                </div>
              <div class="input-group col-xs-12">
                <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                <span class="input-group-append">
                  <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                </span>
              </div>
            </div>
            <div class="form-group">
              <label for="exampleTextarea1">description</label>
              <textarea class="form-control" id="description" name="description" rows="50" required><?= $presult['description']?></textarea>
            </div>
            <button type="submit" class="btn btn-primary me-2">Submit</button>
            <!-- <button class="btn btn-light">Cancel</button> -->
          </form>
        </div>
      </div>
    </div>
    <?php 
require_once '../partials/_footer.php'; 
?>
<script src="../js/file-upload.js"></script>
<script src="../js/js_helpers.js"></script>

  <script>
    function save(id, image){
      setCookie("edit_id", id, 1);
      setCookie("current_image", image, 1);
    }

    $(document).on('submit', '#upload_form', function (event) {
      event.preventDefault(this);
      save('<?= $presult['id']?>', '<?= $presult['image']?>');
      $.ajax({
        url: "../database/manage_project/edit_project.php",
        method: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
          // alert(data);
          if (data == 1) {
            alert('project editted');
            location.reload();
          } else {
            alert(data);
          }
        },
      });     
    })
  </script>