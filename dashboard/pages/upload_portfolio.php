<?php 
  require_once '../partials/header.php'; 
  require_once '../database/config.php';
?>
<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">

      <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Upload New Project</h4>
            <p class="card-description">
              Project Information
            </p>
            <form class="forms-sample" id="upload_form">
              <div class="form-group">
                <label for="exampleInputName1">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
              </div>

              <div class="form-group">
                <label for="exampleSelectGender">Category</label>
                <select class="form-control" id="category" name="category" required>
                  <option value="" selected="selected">Select Category</option>
                  <?php
                          $querry='select * from services';
                          $statement=$conn->prepare($querry);
                          $statement->execute();
                          $result=$statement->fetchAll(PDO::FETCH_ASSOC);
                          
                          foreach($result as $results){?>
                  <option value="<?=$results['id']?>"><?=$results['name']?></option>
                  <?php
                        }?>
                </select>
              </div>
              <div class="form-group">
                <label for="exampleSelectGender">Date</label>
                  <input type="date" class="form-control" id="date" name="date" required>
              </div>


              <div class="form-group">  
                <label>File upload</label>
                <input type="file" name="img" id="img" class="file-upload-default" required>
                <div class="input-group col-xs-12">
                  <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                  <span class="input-group-append">
                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                  </span>
                </div>
              </div>
              <div class="form-group">
                <label for="exampleTextarea1">description</label>
                <textarea class="form-control" id="description" name="description" rows="50" required></textarea>
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
      <script>
        $(document).on('submit', '#upload_form', function (event) {
          event.preventDefault(this);
          $.ajax({
            url: "../database/upload_project/upload.php",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
              // alert(data);
              if (data == 1) {
                alert('project added');
                $('#upload_form')[0].reset();
              } else {
                alert(data);
              }
            },
          });
        })
      </script>