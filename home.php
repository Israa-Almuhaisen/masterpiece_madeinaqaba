<?php 
include("components/sessionInclude.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Home</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="icon" type="image/x-icon" href="./images/madein.png" >

   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

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

<div class="home-bg">

   <section class="home">

      <div class="swiper home-slider">
      
         <div class="swiper-wrapper">

            <div class="swiper-slide slide">
               <div class="content">
                  <p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
               <h1>Discover the beauty and creativity of handmade products!</h1>
               <h2>Our handmade marketplace offers a selection of unique items crafted with love and care by artisans,each piece is a work of art, Happy browsing!</h2>
               <a href="products.php" class="btn">Shop Now</a>
               </div>
               <!-- <div class="image">
               <img src="images/home1.png" alt="" style="height: 0vh;">
               </div> -->
            </div>

            <!-- <div class="swiper-slide slide">
               <div class="image">
                  <img src="./images/home2.png" alt="" style="height: 80vh;">
               </div>
               <div class="content">
                  <span style="font-size: 25px;">Botticelli-Map-of-the-Hell</ style="font-size: 25px;">
                  <h3>Rare Arts</h3>
                  <a href="https://www.artmajeur.com/gourdange-damien/en/artworks/12408437/psychedelic-shape-string-art" class="btn">Read More</a>
               </div>
            </div>
            <div class="swiper-slide slide">
               <div class="image">
                  <img src="./images/home.png" alt="" style="height: 80vh;">
               </div>
               <div class="content">
                  <span style="font-size: 25px;">Glowing-Sunset</span>
                  <h3>Popular Arts</h3>
                  <a href="https://www.saatchiart.com/print/Painting-Flowers-Small-bouquet-Acrylic-painting/981650/7120589/view" class="btn">Shop from outside</a>
               </div>
            </div> -->


         </div>

         <div class="swiper-pagination"></div>

      </div>

   </section>

</div>

<!-- ____________________________Start Category_________________________________________ -->

<div class="cat_container">
        <h1 class="heading">Categories</h1>
        <section class="categories-section" id="categories">

<?php
$sql = "SELECT * FROM category WHERE is_deleted=0";
$select_categories= $conn->query($sql);
foreach($select_categories as $fetch_category){
?>										

<div class="categories-section__card"> 
               <div class="category-card">
                    <a href="#1" class="category-card__bg-link"></a>
                    <div class="category-card__image">
                        <img src="./uploaded_img/<?= $fetch_category['image_01']; ?>" alt="" height="250px">
                    </div>
                    <div class="category-card__content">
                        <div class="category-card__content-scroll">
                            <a href='products.php?cat_id=<?= $fetch_category['category_id']; ?>' class="category-card__title"><?= $fetch_category['category_name']; ?></a>
                            <ul class="category-card__list">
                             
                            </ul>
                        </div>
                    </div>
               </div>
            </div>




<?php
}
?>
         
        </section>
    </div>



<!-- ______________________________ END Category________________________________________________ -->


<!-- start for product  -->

<section class="home-products">

   <h1 class="heading">Products on Sale</h1>

   <div class="swiper products-slider">

   <div class="swiper-wrapper">

   <?php
     $select_products = $conn->prepare("SELECT * FROM `products` WHERE is_sale='1'"); 
     $select_products->execute();
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
         $i=0;
         $is_product_in_store = ($fetch_product['store']-$fetch_product['sold']);
         if ( $is_product_in_store <= 0 ){
            continue;
         } else { ?>
   <form action="" method="post" class="swiper-slide slide" style="height:430px">
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
            <?php 
                        }
                     }
                  }
            ?>
      <div class="flex">

         <?php if ($fetch_product['is_sale'] == 1){ ?>

            <div class="price"><span><del style="text-decoration:line-through; color:silver">$<?= $fetch_product['price']; ?></del><ins style="color:#rgb(0, 0, 69) !important; padding:20px 0px"> $<?=$fetch_product['price_discount'];?></ins> </span></div>

         <?php } else { ?>

            <div class="name" style="color:rgb(0, 0, 69) !important;">$<?= $fetch_product['price']; ?></div> <?php } ?>

         <?php if (($fetch_product['store']-$fetch_product['sold']) != '1'){?>


            <input type="number" name="quantity" class="qty" min="1" max="<?=$fetch_product['store']-$fetch_product['sold'];?>" value="1">

         <?php } else { ?>
            <input type="hidden" name="quantity" value="1">
         <?php } ?> 

      </div>
      <button type="submit" class="btn" name="addTOcart">Add To Cart</button>
   </form>
   <?php
      } } }else{
      echo '<p class="empty">No Products Added Yet!</p>';
   }
   ?>

   </div>

   <div class="swiper-pagination"></div>

   </div>

</section>





    <!-- ------------------start footer-------------- -->

    <?php include 'components/footer.php'; ?>

    <!-- ------------------End footer-------------- -->




<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".home-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
    },
});

 var swiper = new Swiper(".category-slider", {
   loop:false,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
         slidesPerView: 2,
       },
      650: {
        slidesPerView: 3,
      },
      768: {
        slidesPerView: 4,
      },
      1024: {
        slidesPerView: 4,
      },
   },
});

var swiper = new Swiper(".products-slider", {
   // loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      550: {
        slidesPerView: 2,
      },
      768: {
        slidesPerView: 2,
      },
      1024: {
        slidesPerView: 3,
      },
   },
});

</script>

</body>
</html>