<?php 
include('header.php');
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
<div id="carousel-example-generic" class="carousel slide" style="margin-bottom: 30px;" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="images/slider2.jpg" alt="...">
      <div class="carousel-caption">
        ...
      </div>
    </div>
    <div class="item">
      <img src="images/slider1.jpg" alt="...">
      <div class="carousel-caption">
        ...
      </div>
    </div>
    <div class="item">
      <img src="images/slider3.jpg" alt="...">
      <div class="carousel-caption">
        ...
      </div>
    </div>
    ...
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>


<!-- Main Content -->
<div class="container my-4 ">
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
                   
                    <span class="text-muted float-end"> Rs. <?php echo $row['pro_price']; ?></span>
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
          </div>

<?php include('footer.php'); ?>
