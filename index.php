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
    <meta name="description" content="AfterSchool -Event managment">
    <meta name="keywords" content="AfterSchool , Event , Managment, Browsing">
    <meta name="author" content="AfterSchool Team">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- ========== Title ========== -->
    <title> AfterSchool - Event Managment</title>
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
    <div class="loader">
        <div class="loader-outter"></div>
        <div class="loader-inner"></div>
    </div>
    <!--header start here -->
    <header class="header navbar fixed-top navbar-expand-md sticky_header">
        <div class="container">
            <a class="navbar-brand logo" href="/">
                <img src="assets/img/logo.png" alt="AfterSchool">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#headernav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="lnr lnr-text-align-right"></span>
            </button>
            <div class="collapse navbar-collapse flex-sm-row-reverse" id="headernav">
                <ul class=" nav navbar-nav menu">
                    <li class="nav-item">
                        <a class="nav-link active" href="/afterSchool">Home</a>
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
                    
                </ul>
            </div>
        </div>
    </header>
    <!--header end here-->









    <section id="home" class="home-cover">
        <div class="cover_slider owl-carousel owl-theme">
            <div class="cover_item" style="background: url('assets/img/bg/slider.png');">
                <div class="slider_content">
                    <div class="slider-content-inner">
                        <div class="container">
                            <div class="slider-content-center">
                                <h2 class="cover-title">
                                    Prepare yourself for the
                                </h2>
                                <strong class="cover-xl-text">Highlight</strong>
                                <p class="cover-date">
                                    Coming Soon  - City, Casablanca.
                                </p>
                                <a href="" class=" btn btn-primary btn-rounded" >
                                    Browse event
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cover_item" style="background: url('assets/img/bg/5-m.jpg');">
                <div class="slider_content">
                    <div class="slider-content-inner">
                        <div class="container">
                            <div class="slider-content-center">
                                <h2 class="cover-title">
                                    Add your
                                </h2>
                                <strong class="cover-xl-text">Event</strong>
                                <p class="cover-date">
                                    Join US<br>
                                    Manage your personal and public events
                                </p>
                                <a href="pages/register.php" class=" btn btn-primary btn-rounded">
                                    Create an account
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cover_item" style="background: url('assets/img/bg/6-m.jpg');">
                <div class="slider_content">
                    <div class="slider-content-inner">
                        <div class="container">
                            <div class="slider-content-center">
                                <h2 class="cover-title">
                                    Manage and
                                </h2>
                                <strong class="cover-xl-text">Supervise</strong>
                                <h2 class="cover-title">
                                </h2>
                                <p class="cover-date">
                                    Become a Membre<br>Complete access and control over your own Team.
                                </p>
                                <a href="pages/login.php" class="btn btn-primary btn-rounded">
                                    Login
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="cover_nav">
            <ul class="cover_dots">
                <li class="active" data="0"><span>1</span></li>
                <li  data="1"><span>2</span></li>
                <li  data="2"><span>3</span></li>
            </ul>
        </div>
    </section>
    <!--event info end -->
        <?php include 'includes/clubs_events_index.php'; ?>


        <?php include 'includes/events.php' ?>
        
    <!--event calender-->
    <section class="pb100">
        <div class="container">
            <div class="table-responsive">
                <table class="event_calender table">
                    <thead class="event_title">
                    <tr>
                        <th>
                            <i class="ion-ios-calendar-outline"></i>
                            <span>School Clubs</span>
                        </th>
                        <th></th>
                        <th></th>
                        <th></th>


                    </thead>
                    <tbody>
                                        </tr>
                <?php
        foreach ($clubs as $club) {
            if ($club['photo'] === null) continue;
            $acro_club = $club['acro_club'];
            $club_name = $club['nom_club'];
            $description = $club['texte_desc'];
            $id = $club['id_club'];
            $photo = "data:image/*;base64," . base64_encode($club['photo']);
            $href = "pages/clubs.php?target=" . $acro_club . "&id=" . $id;
        ?>
                    <tr>
                        <td>
                            <img class="img-thumbnail" src=<?php echo htmlspecialchars($photo) ?>>
                        </td>
                        <td>
                            <h4><?php echo htmlspecialchars(strtoupper($club_name)) ?></h4>
                        </td>
                    <?php
                    if ($description != '') {
                    ?>
                        <td>
                            <?php echo htmlspecialchars($description) ?>
                        </td>
                    <?php
                    }
                    ?>
                        <td>
                            <a class="btn btn-primary btn-rounded" role="button" href=<?php echo htmlspecialchars($href) ?>>Read More</a>
                        </td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
           
        </div>
    </section>


    <!--event calender end -->



    


    <!--get tickets section -->
<section class="bg-img pt100 pb100" style="background-image: url(assets/img/bg/tickets.png');">
    <div class="container">



    </div>
</section>
<!--get tickets section end-->

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


</body>
</html>