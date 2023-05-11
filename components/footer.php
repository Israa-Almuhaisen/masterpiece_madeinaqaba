<footer class="footer-section">
        <div class="container">
            <div class="footer-cta pt-5 pb-5">
                <div class="row">
                    <div class="col-xl-4 col-md-4 mb-30">
                        <div class="single-cta">
                            <i class="fas fa-map-marker-alt"></i>
                            <div class="cta-text">
                                <h4>Find us</h4>
                                <span class="footerlink"><a href="https://www.google.com/maps?q=29.535580777518422,35.01226365740026" target="_blank">Aqaba, Jordan.</a></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-4 mb-30">
                        <div class="single-cta">
                            <i class="fas fa-phone"></i>
                            <div class="cta-text">
                                <h4>Call us at</h4>
                                <span class="footerlink"><a href="tel:+962778082251">(+962) 77 808 2251</a></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-4 mb-30">
                        <div class="single-cta">
                            <i class="far fa-envelope-open"></i>
                            <div class="cta-text">
                                <h4>Mail us</h4>
                                <span  class="footerlink"><a href="mailto:info@madeinaqaba.com">info@madeinaqaba.com</a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-content pt-5 pb-5">
                <div class="row">
                    <div class="col-xl-4 col-lg-4 mb-50">
                        <div class="footer-widget">
                            <div class="footer-logo">
                                <a href="index.html"><img src="uploaded_img/madein.png" class="img-fluid" style="width: 120px; height:100px;" alt="logo"></a>
                            </div>
                            <div class="footer-text">
                                <!-- <p>Lorem ipsum dolor sit amet, consec tetur adipisicing elit, sed do eiusmod tempor incididuntut consec tetur adipisicing
                                elit,Lorem ipsum dolor sit amet.</p> -->
                            </div>
                            <div class="footer-social-icon">
                                <span>Follow us</span>
                                <a href="https://www.facebook.com/" target="blank"><i class="fab fa-facebook-f facebook-bg"></i></a>
                                <a href="https://twitter.com/" target="blank"><i class="fab fa-twitter twitter-bg"></i></a>
                                <a href="https://www.google.com/" target="blank"><i class="fab fa-google-plus-g google-bg"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 mb-30">
                        <div class="footer-widget">
                            <div class="footer-widget-heading">
                                <h3>Useful Links</h3>
                            </div>
                            <ul>
                                <li><a href="home.php">Home</a></li>
                                <li><a href="about.php">About</a></li>
                                <li><a href="contact.php">Contact</a></li>
                                <li><a href="products.php">Products</a></li>
                                <!-- <li><a href="partners.php">Partners</a></li> -->
                                <li><a href="sale.php">Products on Sale</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 mb-50">
                        <div class="footer-widget">
                            <div class="footer-widget-heading">
                                <h3>Subscribe</h3>
                            </div>
                            <div class="footer-text mb-25">
                                <p>Don’t miss to subscribe to our new feeds, kindly fill the form below.</p>
                            </div>
                            <div class="subscribe-form">
                                <form action="" method="post">
                                    <input type="text" name="semail" placeholder="Email Address">
                                    <button  type="submit" name="subscribe"><i class="fab fa-telegram-plane"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-area">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 text-center text-lg-left">
                        <div class="copyright-text">
                            <p>Copyright &copy; 2023, All Right Reserved <a href="home.php">Made in Aqaba</a></p>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 d-none d-lg-block text-right">
                        <div class="footer-menu">
                            <ul>
                                <li><a href="home.php">Home</a></li>
                                <li><a href="contact.php">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>



<?php
if(isset($_POST['subscribe'])){
    $semail = $_POST['semail'];
    $insert_semail = $conn->prepare("INSERT INTO subscribers (email) VALUES (:semail)");
    $insert_semail->bindParam(':semail', $semail);
    $insert_semail->execute();
    echo 'Thank you for subscribing, ' .$semail;
}
?>