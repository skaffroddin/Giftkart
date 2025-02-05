<?php 
@include('header.php');
include "connection.php";

$sql = "SELECT products.*, categories.cat_name FROM products, categories WHERE products.cat_id = categories.cat_id";
$result = mysqli_query($con, $sql);
$result_count = mysqli_num_rows($result);

$sql_categories = "SELECT * FROM categories";
$result_cat = mysqli_query($con, $sql_categories);
$resultcat_count = mysqli_num_rows($result_cat);

$sql_brand = "SELECT * FROM brands";
$result_brand = mysqli_query($con, $sql_brand);
$resultbrand_count = mysqli_num_rows($result_brand);
?>

<div class="container my-4">
  <div class="row">
    <!-- Sidebar -->
    <div class="col-md-3">
      <div class="card p-3 mb-4">
        <h3>Categories</h3>
        <h6><?php echo $resultcat_count; ?> ITEMS</h6>
        <?php if (mysqli_num_rows($result_cat) > 0): ?>
          <ul class="list-group">
            <?php while($rowcat = mysqli_fetch_assoc($result_cat)): ?>
              <li class="list-group-item">
                <a href="all_products.php?category=<?php echo $rowcat['cat_id']; ?>" class="text-decoration-none">
                  <?php echo $rowcat['cat_name']; ?>
                </a>
              </li>
            <?php endwhile; ?>
          </ul>
        <?php endif; ?>
      </div>

      <div class="card p-3">
        <h3>Brands</h3>
        <h6><?php echo $resultbrand_count; ?> ITEMS</h6>
        <?php if (mysqli_num_rows($result_brand) > 0): ?>
          <ul class="list-group">
            <?php while($rowbrand = mysqli_fetch_assoc($result_brand)): ?>
              <li class="list-group-item">
                <a href="all_products.php?category=<?php echo $rowbrand['brand_id']; ?>" class="text-decoration-none">
                  <?php echo $rowbrand['brand_name']; ?>
                </a>
              </li>
            <?php endwhile; ?>
          </ul>
        <?php endif; ?>
      </div>
    </div>

    <!-- Main Content -->
    <div class="col-md-9">
      <div class="mb-4">
        <h2>Products</h2>
        <h6><?php echo $result_count; ?> ITEMS</h6>
      </div>
      <div class="row">
        <?php if (mysqli_num_rows($result) > 0): ?>
          <?php while($row = mysqli_fetch_assoc($result)): ?>
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
              <div class="card">
                <img src="images/<?php echo $row['pro_image1']; ?>" class="card-img-top" alt="Product Image" style="height: 150px; object-fit: cover;">
                <div class="card-body">
                  <h5 class="card-title"><?php echo $row['pro_name']; ?></h5>
                  <p class="card-text">
                    <?php echo $row['cat_name']; ?>
                    <span class="text-muted float-end"><?php echo $row['pro_price']; ?></span>
                  </p>
                  <a href="details.php?product_detail=<?php echo $row['pro_id']; ?>" class="btn btn-primary btn-sm w-100">View Details</a>
                </div>
              </div>
            </div>
          <?php endwhile; ?>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <!-- Client Reviews -->
  <div class="text-center my-5">
    <h2>Client Reviews</h2>
    <div class="carousel slide" id="clientReviews" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <div class="row">
            <div class="col-md-6">
              <img src="images/client1.jpg" class="img-fluid" alt="Client 1">
            </div>
            <div class="col-md-6 d-flex flex-column justify-content-center">
              <h4>Scott Swanson</h4>
              <p class="fst-italic">"The Pacific Grove Chamber of Commerce would like to thank eLab Communications and Mr. Will Elkadi for all the efforts and suggestions."</p>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <div class="row">
            <div class="col-md-6">
              <img src="images/client2.jpg" class="img-fluid" alt="Client 2">
            </div>
            <div class="col-md-6 d-flex flex-column justify-content-center">
              <h4>Jane Doe</h4>
              <p class="fst-italic">"It's always a pleasure to work with Will and his team. They are personable, responsive, and results-oriented!"</p>
            </div>
          </div>
        </div>
      </div>
      <a class="carousel-control-prev" href="#clientReviews" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </a>
      <a class="carousel-control-next" href="#clientReviews" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
      </a>
    </div>
  </div>
</div>

<?php @include('footer.php'); ?>
