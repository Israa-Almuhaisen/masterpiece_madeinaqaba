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
   <link rel="icon" type="image/x-icon" href="./images/logo.png">

   <!-- custom css file link  -->
   <style> 
<?php 
include("css/style.css");
include("css/style_israa.css");
?>
</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">


</head>
<body>
   
<?php include 'components/user_header.php'; ?>



<section class="products">

   <h1 class="heading">Our products</h1>

   <div class="box-container">

   <?php
     $select_products = $conn->prepare("SELECT * FROM `products`"); 
     $select_products->execute();
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
         $i=0;
         $is_product_in_store = ($fetch_product['store']-$fetch_product['sold']);
         if ( $is_product_in_store <= 0 ){
            continue;
         } else { ?>
         <form action="" method="post" class="box" style="height:430px">
            <input type="hidden" name="product_id" value="<?= $fetch_product['product_id']; ?>">
            <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
            <?php 
            if ($fetch_product['is_sale'] == 1){
               ?>
               <input type="hidden" name="price" value="<?=$fetch_product['price_discount'];?>">
               <?php
            } else {
               ?>
               <input type="hidden" name="price" value="<?=$fetch_product['price'];?>">
               <?php
            }
            ?>
            <input type="hidden" name="image" value="<?= $fetch_product['image']; ?>">
            <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
            <a href="quick_view.php?pid=<?= $fetch_product['product_id']; ?>" class="fas fa-eye"></a>
            <img src="uploaded_img/<?= $fetch_product['image']; ?>" alt="">
            <div class="name"><?= $fetch_product['name']; ?></div>
            <?php $product_category = $conn->prepare("SELECT * 
                                             FROM `products`
                                             INNER JOIN `category` ON products.category_id = category.category_id");
                        $product_category->execute();
                        if($product_category->rowCount() > 0){
                           while($fetch_product_category = $product_category->fetch(PDO::FETCH_ASSOC)){ 
                              if($i==0 && $fetch_product['category_id'] == $fetch_product_category['category_id'] ){
                              $i++;
                  ?>
                              <div class="details" style="color : rgb(133, 132, 132); font-size:15px"><span>Category : <?= $fetch_product_category['category_name']; ?></span>
            </div>
                  <?php } } } ?>
            <div class="flex">

               <?php if ($fetch_product['is_sale'] == 1){ ?>

                  <div class="price" style="padding:7px 0px"><span><del style="text-decoration:line-through; color:silver">$<?= $fetch_product['price']; ?></del><ins style="color:rgb(0, 0, 69) !important;;"> $<?=$fetch_product['price_discount'];?></ins> </span></div>

               <?php } else { ?>

                  <div class="name" style="color:rgb(0, 0, 69) !important; padding:20px 0px">$<?= $fetch_product['price']; ?></div> <?php } ?>

               <?php if (($fetch_product['store']-$fetch_product['sold']) != '1'){?>

                  <input style="margin-left: 160px ;" type="number" name="quantity" class="qty" min="1" max="<?= $fetch_product['store']-$fetch_product['sold'];?>" value="1">

               <?php } else { ?>
                  <input type="hidden" name="quantity" value="1">
               <?php } ?> 

            </div>
            <button type="submit" class="btn" name="addTOcart">Add To Cart</button>
         </form>
         <?php
         } } } else { echo '<p class="empty">no products found!</p>'; } ?>

   </div>

</section>


<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>