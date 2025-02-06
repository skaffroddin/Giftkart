<?php
// Start the session
session_start();

if (!isset($_SESSION["user"])) {
    echo "<script>window.open('login.php', '_self')</script>";
    die();
}

include("connection.php");

// Fetch brands and categories
$sql = "SELECT brand_name, brand_id FROM brands";
$categories = "SELECT cat_id, cat_name FROM categories";
$result = $con->query($sql);
$category = $con->query($categories);

if (isset($_POST['add_product'])) {
    // Sanitize inputs
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $price = mysqli_real_escape_string($con, $_POST['price']);
    $product_category = mysqli_real_escape_string($con, $_POST['category']);
    $brand = mysqli_real_escape_string($con, $_POST['brand']);
    $description = mysqli_real_escape_string($con, $_POST['desc']);

    // Handle file upload
    $filename = $_FILES['image']['name'];
    $tempname = $_FILES['image']['tmp_name'];
    $folder = '../images/products/' . $filename;

   

  move_uploaded_file($tempname, $folder);

    // Insert product into the database
    $add_product_query = "INSERT INTO products (pro_name, pro_price, cat_id, brand_id, pro_des, pro_image1, pro_image2) 
                          VALUES ('$name', '$price', $product_category, $brand, '$description', '$folder', '')";

   $con->query($add_product_query) ;
        echo "<script>alert('Product Added Successfully')</script>";
        echo "<script>window.open('add_product.php', '_self')</script>";
   
}
@include('header.php');
?>

<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8 panel" style="margin-top: 30px">
                <br><br>
                <h2 style="margin-left:25px;">Add Product</h2>
                <br>
                <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                    <!-- Product Name -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="product_name">PRODUCT NAME</label>
                        <div class="col-md-4">
                            <input id="product_name" name="name" placeholder="PRODUCT NAME" class="form-control input-md" required="" type="text" style="width: 300px">
                        </div>
                    </div>
                    <!-- Product Price -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="product_price">PRODUCT PRICE</label>
                        <div class="col-md-4">
                            <input id="product_price" name="price" placeholder="PRODUCT PRICE" class="form-control input-md" required="" type="number" style="width: 300px">
                        </div>
                    </div>
                    <!-- Product Category -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="product_category">PRODUCT CATEGORY</label>
                        <div class="col-md-4">
                            <?php
                            echo "<select id='product_category' name='category' class='form-control' style='width: 300px'>";
                            if (mysqli_num_rows($category) > 0) {
                                while ($row = mysqli_fetch_assoc($category)) {
                                    echo "<option value='" . $row['cat_id'] . "'>" . $row['cat_name'] . "</option>";
                                }
                            }
                            echo "</select>";
                            ?>
                        </div>
                    </div>
                    <!-- Product Brand -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="product_brand">PRODUCT BRAND</label>
                        <div class="col-md-4">
                            <?php
                            echo "<select id='product_brand' name='brand' class='form-control' style='width: 300px'>";
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='" . $row['brand_id'] . "'>" . $row['brand_name'] . "</option>";
                                }
                            }
                            echo "</select>";
                            ?>
                        </div>
                    </div>
                    <!-- Product Description -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="product_description">PRODUCT DESCRIPTION</label>
                        <div class="col-md-4">
                            <textarea id="product_description" name="desc" placeholder="PRODUCT DESCRIPTION" class="form-control input-md" required cols="8" rows="9" style="width: 300px"></textarea>
                        </div>
                    </div>
                    <!-- Main Image -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="product_image">PRODUCT MAIN IMAGE</label>
                        <div class="col-md-4">
                            <input id="product_image" name="image" class="input-file" type="file">
                        </div>
                    </div>
                    <!-- Submit Button -->
                    <div class="form-group">
                        <div class="col-md-5">
                            <button id="singlebutton" name="add_product" class="btn btn-primary" style="float:right;">ADD PRODUCT</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include('footer.php');
?>
