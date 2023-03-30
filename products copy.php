<?php 
include("components/sessionInclude.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Products</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="icon" type="image/x-icon" href="./images/madein.png">

   

   <!-- custom css file link  -->
   <style> 
<?php 
include("css/style.css");
include("css/style_israa.css");
include("css/style_productFilters.css");
?>
</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">


</head>
<body>
   
<?php include 'components/user_header.php'; ?>


<!-- products -->
<div class="product-section">

<h1 class="heading">Our products</h1>

		<div class="container">

			<div class="row">
                <div class="col-md-12">
                    <div class="product-filters">
                        <ul>
									<li class="active" data-filter="*">All</li>
								<?php
								$sql = "SELECT * FROM category WHERE is_deleted=0";
								$select_categories= $conn->query($sql);
								foreach($select_categories as $fetch_category){
								?>										
								<li data-filter=".<?= $fetch_category['category_id']; ?>"><?= $fetch_category['category_name']; ?></li>
								<?php
								}
								?>
                        </ul>
                    </div>
                </div>
            </div>

			<div class="row product-lists">
			<?php					
					$sql = "SELECT * FROM `products`";
					$select_products= $conn->query($sql);
					foreach($select_products as $product){
					?>

							<div class="col-lg-4 col-md-6 text-center <?= $product['category_id']; ?>">
								<div class="single-product-item">
									<div class="product-image">
										<a href="quick_view.php?pid=<?= $product['product_id']; ?>">
										<img width=200px height=200px src='./uploaded_img/<?= $product['image']; ?>' alt="">
										</a>
										<h2 STYLE="font-size:27px"><?= $product['name']; ?></h2>
										<span STYLE="font-size:20px"><?= $product['price']; ?></span> <SPAN STYLE="font-size:16pt">$</SPAN></br></br>
										<!-- <a href="add_to_cart.php?productid=<?= $product['product_id']; ?>" class="cart-btn"> <SPAN STYLE="font-size:16pt">Add to Cart</SPAN> </a>					 -->
										<form>
											<!-- <input type="hidden" name="selected_prod" value=<?=$selected_prod;?>> -->
									
											<!-- <button type="submit" class="cart-btn> -->
											<a href="add_to_cart.php?productid=<?=$product['product_id']?>" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
											<!-- </button> -->
										</form>
										<?php
											// if ($_SERVER['REQUEST_METHOD']=="POST") {
											//  $_SESSION["added_products"] = [];
											// 	// $added_product = [$product["product_id"],$_POST["qun"],$product["product_name"],$product["description"],$product["model_year"],$product["brand"],$product["price"],$product["category_id"],$product["pic_main"],$product["rate"],$product["in_stock"],$product["is_discount"],$product["discount"]];
											// 	// $added_product = array($_POST["selected_prod"]);
											// 	$added_product = unserialize($_POST["selected_prod"]);
											// 	// print_r($added_product);
											// 	// if (! isset($_SESSION["added_products"])){
											// 	// $_SESSION["added_products"] = [];
											// 	// }
											// 	array_push($_SESSION["added_products"],$added_product);
											// 	print_r($_SESSION["added_products"]);
											// }
										?>
									</div>
								</div>
							</div>
					<?php
					}
					?>
				
			</div>

			<!-- <div class="row">
				<div class="col-lg-12 text-center">
					<div class="pagination-wrap">
						<ul>
							<li><a href="#">Prev</a></li>
							<li><a class="active" href="#">1</a></li>
							<li><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">Next</a></li>
						</ul>
					</div>
				</div>
			</div> -->
		</div>
	</div>
	<!-- end products -->



<?php include 'components/footer.php'; ?>

<!-- <script src="js/script.js"></script> -->
	<!-- jquery -->
	<script src="js2/jquery-1.11.3.min.js"></script>
	<!-- bootstrap -->
	<!-- <script src="js2/bootstrap.min.js"></script> -->
	<!-- count down -->
	<!-- <script src="js2/jquery.countdown.js"></script> -->
	<!-- isotope -->
	<script src="js2/jquery.isotope-3.0.6.min.js"></script>
	<!-- waypoints -->
	<!-- <script src="js2/waypoints.js"></script> -->
	<!-- owl carousel -->
	<script src="js2/owl.carousel.min.js"></script>
	<!-- magnific popup -->
	<!-- <script src="js2/jquery.magnific-popup.min.js"></script> -->
	<!-- mean menu -->
	<!-- <script src="js2/jquery.meanmenu.min.js"></script> -->
	<!-- sticker js -->
	<!-- <script src="js2/sticker.js"></script> -->
	<!-- main js -->
	<script src="js2/main.js"></script>
</body>
</html>