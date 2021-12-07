<?php 
  require_once 'partials/header.php';
  require_once '../dashboard/database/config.php'; 
  require_once '../dashboard/helpers/functions.php'; 

  $id = $_GET['p_id'];

  $query = "SELECT * FROM portfolio WHERE id = :id";

  $statement = $conn->prepare($query);
  $statement->execute(
    array(
      ":id" => $id,
    )
  );

  $result = $statement->fetch();
?>

  <div class="intro intro-single route bg-image" style="background-image: url(assets/img/overlay-bg.jpg)">
    <div class="overlay-mf"></div>
    <div class="intro-content display-table">
      <div class="table-cell">
        <div class="container">
          <h2 class="intro-title mb-4">Portfolio Details</h2>
          <ol class="breadcrumb d-flex justify-content-center">
            <li class="breadcrumb-item">
              <a href="index.php">Home</a>
            </li>
            <li class="breadcrumb-item active">Portfolio Details</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <main id="main">

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-8">
            <div class="portfolio-details-slider swiper">
              <div class="swiper-wrapper align-items-center">

                <div class="swiper-slide">
                  <img src="../dashboard/uploads/projects/<?= $result['image']?>" alt="" style="height: 450px; object-fit:cover;">
                </div>

                <!-- <div class="swiper-slide">
                  <img src="assets/img/portfolio-details-2.jpg" alt="">
                </div>

                <div class="swiper-slide">
                  <img src="assets/img/portfolio-details-3.jpg" alt="">
                </div> -->

              </div>
              <div class="swiper-pagination"></div>
            </div>
          </div>

          <div class="col-lg-4">
            <!-- <div class="portfolio-info"> -->
              <h2>Project information</h2>
              <ul>
                <li><strong>Category</strong>: <?= fetchServiceIdUsing($conn, $result['service_id'])?></li>
                <li><strong>Project date</strong>: <?= dateFormat($result['date']);?></li>
              </ul>
            <!-- </div> -->
            <div class="portfolio-description">
              <h2>Project Summary</h2>
              <p>
                <?= $result['description']?>
              </p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Portfolio Details Section -->

  </main><!-- End #main -->

  <?php require_once 'partials/footer.php' ?>
