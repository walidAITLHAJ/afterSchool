<?php require_once 'connexion.php';
session_start();
if (!isset($_SESSION['cne'])) {
    if (isset($_COOKIE["remember_me"])) {
        //GET THE COOKIE VALUE
        list($user_cne, $hash) = explode(':', $_COOKIE["remember_me"]);
        //LOAD USER DATA
        $sql = "select * from etudiant where cne=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$user_cne]);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        if ($stmt->rowCount() == 1) {
            $row = $stmt->fetch();
            //CHECK IF VALIDE COOKIE
            if ($row["val_cookie"] == $_COOKIE["remember_me"]) {
                //SET USER DATA
                $_SESSION['nom'] = $row['nom'];
                $_SESSION['prenom'] = $row['prenom'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['photo'] = $row['photo'];
                $_SESSION['cne'] = $row['cne'];
                $_SESSION['code_apoge'] = $row['code_apoge'];
                include 'pages/functions/index-page.php';
                //CHANGE THE HASH VALUE
                $rand_val = md5(time() . $row["mpass"]);
                $val_cookie = $row["cne"] . ':' . $rand_val;
                $expire = 30 * 86400;
                setcookie("remember_me", $val_cookie, time() + $expire, "/");
                $sql = "update etudiant set val_cookie=? where (cne=? or code_apoge=?)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$val_cookie, $row["cne"], $row["code_apoge"]]);
                $is_connected = true;
            }
        }
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <!-- ========== Meta Tags ========== -->
    <meta charset="UTF-8">
    <meta name="description" content="Revent -Event managment">
    <meta name="keywords" content="Revent , Event , Managment, Browsing">
    <meta name="author" content="Revent Team">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- ========== Title ========== -->
    <title> Revent - Event Managment</title>
    <!-- ========== Favicon Ico ========== -->
    <!--<link rel="icon" href="fav.ico">-->
    <!-- ========== STYLESHEETS ========== -->
    <!-- Bootstrap CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Fonts Icon CSS -->
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/et-line.css" rel="stylesheet">
    <link href="assets/css/ionicons.min.css" rel="stylesheet">
    <!-- Carousel CSS -->
    <link href="assets/css/owl.carousel.min.css" rel="stylesheet">
    <link href="assets/css/owl.theme.default.min.css" rel="stylesheet">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <!-- Custom styles for this template -->
 <link rel="stylesheet" href="assets/css/main.css">
    
</head>
<body>

    <!--header start here -->
    <header class="header navbar fixed-top navbar-expand-md sticky_header">
        <div class="container">
            <a class="navbar-brand logo" href="/">
                <img src="assets/img/logo.png" alt="afterSchool">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#headernav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="lnr lnr-text-align-right"></span>
            </button>
            <div class="collapse navbar-collapse flex-sm-row-reverse" id="headernav">
                <ul class=" nav navbar-nav menu">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Home</a>
                    </li>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="contact.php">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="pages/login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="pages/register.php">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="">logout</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="pages/profile.php">Profile</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
<!--header end here-->

<!--page title section-->
<section class="inner_cover parallax-window" data-parallax="scroll" data-image-src="assets/img/bg/inner_cover.png">
    <div class="overlay_dark"></div>
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-12">
                <div class="inner_cover_content">
                    <h3>
                        Contact us
                    </h3>
                </div>
            </div>
        </div>

        <div class="breadcrumbs">
            <ul>
                <li><a href="">Home</a>  | </li>
                <li><span>Contact</span></li>
            </ul>
        </div>
    </div>
</section>
<!--page title section end-->


<!--contact section -->
<section class="pt100 pb100">
    <div class="container">
        <img src="assets/img/logo.png" alt="after School" style="
    max-width: 35%;
">
        <div class="row justify-content-center mt100">
            <div class="col-md-6 col-12">
                <div class="contact_info">
                    <h5>
                        After School is here for you
                    </h5>
                    <p>We are honored to have you as a client and we want you to get the best Revent experience.</p>
                    <p>And so if you have any questions, issues, and of course suggestions please feel free to contact us</p><ul class="social_list">

                    <li>
                        <a href="#"><i class="ion-social-facebook"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="ion-social-twitter"></i></a>
                    </li>

                    <li>
                        <a href="#"><i class="ion-social-instagram"></i></a>
                    </li>
                </ul>

                    <ul class="icon_list pt50">
                        <li>
                            <i class="ion-location"></i>
                            <span>Al Irfan<br>Rabat , Morocco</span>
                        </li>
                        <li>
                            <i class="ion-ios-telephone"></i>
                            <span>+212 622920301</span>
                        </li>
                        <li>
                            <i class="ion-email-unread"></i>
                            <span>
                                    aitlhaj.walid@gmail.com
                                </span><br>
                            <span>
                                    soufianesajed@gmail.com
                                </span>
                        </li>

                        <li>
                            <i class="ion-planet"></i>
                            <span>www.ensias.ma</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="contact_form">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="name" style="border: 2px solid red;border-radius: 4px;">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="email" style="border: 2px solid red;border-radius: 4px;">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="subject" style="border: 2px solid red;border-radius: 4px;">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" cols="4" rows="4" placeholder="message" style="border: 2px solid red;border-radius: 4px;"></textarea>
                    </div>
                    <div class="form-group text-right">
                        <button class="btn btn-rounded btn-primary">send message</button>
                    </div>
                </div>
            </div>
            <div>
                <h4>Where to find us</h4>                <!--map -->
                <div><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3308.3200651374673!2d-6.869790584786769!3d33.984311780624544!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xda76ce7f9462dd1%3A0x2e9c39cfa1d9e8d7!2s%C3%89cole%20Nationale%20Sup%C3%A9rieure%20d'Informatique%20et%20d'Analyse%20des%20Syst%C3%A8mes!5e0!3m2!1sfr!2sma!4v1590073250299!5m2!1sfr!2sma" width="1000px" height="400px" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

                </div>
                <!--map end-->
            </div>
        </div>

    </div>
</section>
<!--contact section end -->



<!--footer start -->
<footer>
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-4 col-12">
                <div class="footer_box">
                    <div class="footer_header">
                        <div class="footer_logo">
                            <img src="assets/img/logo.png" alt="revent">
                        </div>
                    </div>
                    <div class="footer_box_body">
                        <p>
                            AfterSchool is a simple yet effective and inovative approach to event managment.
                            Create your account now and choose the plan that suits you best, be it the free to use viewer or the allmighty moderator the choice is yours!
                        </p>
                        <ul class="footer_social">

                            <li>
                                <a href="#"><i class="ion-social-facebook"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="ion-social-twitter"></i></a>
                            </li>

                            <li>
                                <a href="#"><i class="ion-social-instagram"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="footer_box">
                    <div class="footer_header">
                        <h4 class="footer_title">
                            instagram
                        </h4>
                    </div>
                    <div class="footer_box_body">
                        <ul class="instagram_list">
                            <li>
                                <a href="#">
                                    <img src="assets/img/cleander/c1.png" alt="instagram">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="assets/img/cleander/c2.png" alt="instagram">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="assets/img/cleander/c3.png" alt="instagram">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="assets/img/cleander/c3.png" alt="instagram">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="assets/img/cleander/c2.png" alt="instagram">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="assets/img/cleander/c1.png" alt="instagram">
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4">

                <div class="footer_box">
                    <div class="footer_header">
                        <div class="footer_logo">
                            <img src="assets/img/ensias.png" alt="ensias" style="padding-left: 50px;">
                        </div>
                    </div>
                    <div class="footer_box_body">
                        <p>
                            L’École nationale supérieure d’informatique et d’analyse des systèmes (ENSIAS Rabat) est l’une des grandes écoles d’ingénieurs marocaines rattachée à l’université Mohammed V – Souissi de Rabat.
                        </p>
                        <a href="https://www.ensias.ma"><i class="ion-planet"></i></a>
                    </div>
                </div></div>
        </div>
    </div>
</footer>
<div class="copyright_footer">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-12">
                <p>
                    Copyright ©<script>document.write(new Date().getFullYear());</script> All rights reserved
                </p>
            </div>
            <div class="col-12 col-md-6 ">
                <ul class="footer_menu">
                    <li>
                        <a href="">Home</a>
                    </li>
                    <li>
                        <a href="">Contact</a>
                    </li>



                </ul>
            </div>
        </div>
    </div>
</div>
<!--footer end -->

<!-- jquery -->
<script src="assets/js/jquery.min.js"></script>
<!-- bootstrap -->
<script src="assets/js/popper.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/waypoints.min.js"></script>
<script src="assets/js/main.js"></script>

<!--slick carousel -->
<script src="assets/js/owl.carousel.min.js"></script>
<!--parallax -->
<script src="assets/js/parallax.min.js"></script>
<!--Counter up -->
<script src="assets/js/jquery.counterup.min.js"></script>
<!--Counter down -->
<script src="assets/js/jquery.countdown.min.js"></script>
<!-- WOW JS -->
<script src="assets/js/wow.min.js"></script>
<!-- Custom js -->
<!--map -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAuahgsm_qfH1F3iywCKzZNMdgsCfnjuUA"></script>
</body>
</html>