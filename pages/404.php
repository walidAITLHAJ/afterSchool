<?php session_start();
require_once '../connexion.php';
$is_connected = false;
if (isset($_SESSION['cne'])) {
    $is_connected = true;
} elseif (isset($_COOKIE['remember_me'])) {
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
            include 'functions/index-page.php';
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
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Page Not Found</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-icons/3.0.1/iconfont/material-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.css">
    <link rel="stylesheet" href="assets/css/untitled.css">
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- here -->
        <?php
        if (isset($_SESSION['cne'])) {
            $select = "none";
            include 'includes/nav.php';
        } else {
            include '../includes/nav.php';
        }
        if ($is_connected) echo '<div class="d-flex flex-column" id="content-wrapper">';
        else echo '<div class="d-flex flex-column" id="content-wrapper" style="margin-top: 100px;width: 900px;margin-right: auto;margin-left: auto;">'
        ?>
        <div id="content">
            <?php if ($is_connected) include 'includes/user_nav.php' ?>
            <div class="container-fluid">
                <div class="text-center mt-5">
                    <div class="error mx-auto" data-text="404">
                        <p class="m-0">404</p>
                    </div>
                    <p class="text-dark mb-5 lead">Page Not Found</p>
                    <p class="text-black-50 mb-0">It looks like you found a glitch in the matrix...</p>
                    <?php if ($is_connected) echo '<a href="/pages">? Back to Dashboard</a>';
                    else echo' <a href="/">? Back to Home Page</a>'; ?>
                </div>
            </div>
        </div>
        <footer class="bg-white sticky-footer">
            <div class="container my-auto">
                <div class="text-center my-auto copyright"><span>Copyright ? ENSIASClub 2020</span></div>
            </div>
        </footer>
    </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>