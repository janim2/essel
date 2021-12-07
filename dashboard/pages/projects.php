<?php 
  require_once '../partials/header.php'; 
  require_once '../database/config.php';

  include_once '../helpers/functions.php';
?>
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">All projects</h4>
                  <!-- <p class="card-description">
                    Add class <code>.table-striped</code>
                  </p> -->
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>
                            Image
                          </th>
                          <th>
                            Name
                          </th>
                          <th>
                            Service
                          </th>
                          <th>
                            Description
                          </th>
                          <th>
                            Date
                          </th>
                          <th>
                            Action
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $query = "SELECT * FROM portfolio";
                          $statement = $conn->prepare($query);

                          $statement->execute();
                          $result = $statement->fetchAll(PDO::FETCH_ASSOC);

                          foreach($result as $results){?>
                            <tr>
                              <td class="py-1">
                                <img src="../uploads/projects/<?= $results['image'];?>" alt="image"/>
                              </td>
                              <td>
                                <?= $results['title'];?>
                              </td>
                              <td>
                                <span class="badge badge-primary">
                                  <?= fetchServiceIdUsing($conn,$results['service_id']);?>
                                </span>
                              </td>
                              <td>
                                <?= $results['description'];?>
                              </td>
                              <td>
                                <?= $results['date'];?>
                              </td>
                              <td>
                                <button class="btn-sm" onclick="location.href='edit_portfolio.php?p_id=<?= $results['id']; ?>'">Edit</button>
                                <button class="btn-sm btn-danger" onclick="delete_project(<?= $results['id']; ?>)">Delete</button>
                              </td>
                          </tr>
                        <?php
                          }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

<?php require_once '../partials/_footer.php'; ?>

<script>
    function delete_project(id){
        var confirmation = confirm("Are you sure you want to delete this project?");
        if(confirmation){
          $.ajax({
            url: "../database/manage_project/delete_project.php",
            method: "POST",
            data: {
              "id" : id,
            },
            success: function (data) {
              if (data == 1) {
                alert('project deleted');
                location.reload();
              } else {
                alert(data);
              }
            },
          });
        }
    }
</script>