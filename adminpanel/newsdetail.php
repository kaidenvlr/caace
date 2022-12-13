<?php
session_start();
$username = $_SESSION['username'];
include('../db/dbConnect.php');
if (empty($_SESSION['username'])) {
  header("location:admin-login.php");
}

$centerId = $_GET['id'];
?>

<!DOCTYPE html>
<html lang="en" data-footer="true" data-override='{"attributes": {"placement": "vertical", "layout": "boxed" }, "storagePrefix": "ecommerce-platform"}'>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Admin Panel</title>
    <meta name="description" content="Ecommerce Order List Page" />
    <!-- Favicon Tags Start -->
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="img/favicon/apple-touch-icon-57x57.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/favicon/apple-touch-icon-114x114.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/favicon/apple-touch-icon-72x72.png" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/favicon/apple-touch-icon-144x144.png" />
    <link rel="apple-touch-icon-precomposed" sizes="60x60" href="img/favicon/apple-touch-icon-60x60.png" />
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="img/favicon/apple-touch-icon-120x120.png" />
    <link rel="apple-touch-icon-precomposed" sizes="76x76" href="img/favicon/apple-touch-icon-76x76.png" />
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="img/favicon/apple-touch-icon-152x152.png" />
    <link rel="icon" type="image/png" href="img/favicon/favicon-196x196.png" sizes="196x196" />
    <link rel="icon" type="image/png" href="img/favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/png" href="img/favicon/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="img/favicon/favicon-16x16.png" sizes="16x16" />
    <link rel="icon" type="image/png" href="img/favicon/favicon-128.png" sizes="128x128" />
    <meta name="application-name" content="&nbsp;" />
    <meta name="msapplication-TileColor" content="#FFFFFF" />
    <meta name="msapplication-TileImage" content="img/favicon/mstile-144x144.png" />
    <meta name="msapplication-square70x70logo" content="img/favicon/mstile-70x70.png" />
    <meta name="msapplication-square150x150logo" content="img/favicon/mstile-150x150.png" />
    <meta name="msapplication-wide310x150logo" content="img/favicon/mstile-310x150.png" />
    <meta name="msapplication-square310x310logo" content="img/favicon/mstile-310x310.png" />
    <!-- Favicon Tags End -->
    <!-- Font Tags Start -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="font/CS-Interface/style.css" />
    <!-- Font Tags End -->
    <!-- Vendor Styles Start -->
    <link rel="stylesheet" href="css/vendor/bootstrap.min.css" />
    <link rel="stylesheet" href="css/vendor/OverlayScrollbars.min.css" />

    <!-- Vendor Styles End -->
    <!-- Template Base Styles Start -->
    <link rel="stylesheet" href="css/styles.css" />
    <!-- Template Base Styles End -->

    <link rel="stylesheet" href="css/main.css" />
    <script src="js/base/loader.js"></script>
</head>

<body>
    <div id="root">
        <?php include('./partials/navbar.php') ?>

        <main>
            <div class="container">
                <!-- Title and Top Buttons Start -->
                <div class="page-title-container">
                    <div class="row">
                        <!-- Title Start -->
                        <div class="col-auto mb-3 mb-md-0 me-auto">
                            <div class="w-auto sw-md-70">
                                <a href="./news.php" class="muted-link pb-1 d-inline-block breadcrumb-back">
                                    <i data-cs-icon="chevron-left" data-cs-size="13"></i>
                                    <span class="text-small align-middle">Новости</span>
                                </a>
                                <h1 class="mb-0 pb-0 display-4" id="title">Данные о новости №<?php echo $_GET['id']; ?></h1>
                            </div>
                        </div>
                        <!-- Title End -->
                    </div>
                </div>
                <!-- Title and Top Buttons End -->

                <div class="row gx-4 gy-5">
                    <!-- Customer Start -->
                    <?php
                    $sqlItem = "select * from `news` where nid=" . $_GET['id'];
                    $resItem = $conn->query($sqlItem);
                    $dataItem = mysqli_fetch_assoc($resItem);
                    ?>
                    <div class="col-12 col-xl-4 col-xxl-5">
                        <h2 class="small-title">Информация</h2>
                        <div class="card">
                            <div class="card-body mb-n5">
                                <div class="d-flex align-items-center flex-column">
                                    <div class="mb-5 d-flex align-items-center flex-column">
                                        <div class="h5 mb-1"><?php echo $dataItem['ntitle']; ?></div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <div class="d-flex flex-row justify-content-between w-100 w-sm-50 w-xl-100 mb-5">
                                        <a href="./addnews.php?editId=<?php echo $_GET['id']; ?>" class="btn btn-primary w-100 me-2">Редактировать</a>
                                    </div>
                                </div>
                                <div class="mb-5">
                                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                        <div class="carousel-inner" style="margin-left: auto; margin-right: auto;">
                                            <?php
                                            $sqlImage = "select * from `newsimage` where nid=" . $_GET['id'];
                                            $resImage = $conn->query($sqlImage);
                                            $k = 0;
                                            while ($dataImage = mysqli_fetch_assoc($resImage)) {
                                                if ($k == 0) {
                                                    $k += 1;
                                            ?>
                                                    <div class="carousel-item active">
                                                        <img class="d-block w-300 h-100" src="./uploads/<?php echo $dataImage['nimgname']; ?>" alt="image">
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="carousel-item">
                                                        <img class="d-block w-300 h-100" src="./uploads/<?php echo $dataImage['nimgname']; ?>" alt="image">
                                                    </div>
                                            <?php }
                                            } ?>
                                        </div>
                                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        </a>
                                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Customer End -->

                    <div class="col-12 col-xl-8 col-xxl-6">
                        <!-- Recent Orders Start -->
                        <div class="d-flex justify-content-between">
                            <h2 class="small-title">Данные</h2>
                        </div>
                        <div class="mb-1">
                            <div class="card mb-2">
                                <div class="row g-0 sh-16 sh-md-8">
                                    <div class="col">
                                        <div class="card-body pt-0 pb-0 h-100">
                                            <div class="row g-0 h-100 align-content-center">
                                                <div class="col-6 col-md-3 d-flex flex-column justify-content-center mb-2 mb-md-0 h-md-100">
                                                    <div class="text-muted text-small d-md-none">ID</div>
                                                    <div class="text-alternate">ID</div>
                                                </div>
                                                <div class="col-6 col-md-9 d-flex flex-column justify-content-center mb-2 mb-md-0">
                                                    <div class="text-muted text-small d-md-none">ID</div>
                                                    <div class="text-alternate"><?php echo $dataItem['nid'] ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-1">
                            <div class="card mb-2">
                                <div class="row g-0 sh-16 sh-md-8">
                                    <div class="col">
                                        <div class="card-body pt-0 pb-0 h-100">
                                            <div class="row g-0 h-100 align-content-center">
                                                <div class="col-6 col-md-3 d-flex flex-column justify-content-center mb-2 mb-md-0 h-md-100">
                                                    <div class="text-muted text-small d-md-none">ЗАГОЛОВОК</div>
                                                    <div class="text-alternate">ЗАГОЛОВОК</div>
                                                </div>
                                                <div class="col-6 col-md-9 d-flex flex-column justify-content-center mb-2 mb-md-0">
                                                    <div class="text-muted text-small d-md-none">ЗАГОЛОВОК</div>
                                                    <div class="text-alternate"><?php echo $dataItem['ntitle'] ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-1">
                            <div class="card mb-2">
                                <div class="row g-0 sh-16 sh-md-8">
                                    <div class="col">
                                        <div class="card-body pt-0 pb-0 h-100">
                                            <div class="row g-0 h-100 align-content-center">
                                                <div class="col-6 col-md-3 d-flex flex-column justify-content-center mb-2 mb-md-0 h-md-100">
                                                    <div class="text-muted text-small d-md-none">КРАТКОЕ ОПИСАНИЕ</div>
                                                    <div class="text-alternate">Краткое описание</div>
                                                </div>
                                                <div class="col-6 col-md-9 d-flex flex-column justify-content-center mb-2 mb-md-0">
                                                    <div class="text-muted text-small d-md-none">КРАТКОЕ ОПИСАНИЕ</div>
                                                    <div class="text-alternate"><?php echo $dataItem['nslogan']; ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-1">
                            <div class="card mb-2">
                                <div class="row g-0">
                                    <div class="col">
                                        <div class="card-body pt-0 pb-0 h-100">
                                            <div class="row g-0 h-100 align-content-center">
                                                <div class="col-6 col-md-3 d-flex flex-column justify-content-center mb-2 mb-md-0 h-md-100">
                                                    <div class="text-muted text-small d-md-none">КОНТЕНТ</div>
                                                    <div class="text-alternate">Контент</div>
                                                </div>
                                                <div class="col-6 col-md-9 d-flex flex-column justify-content-center mb-2 mb-md-0">
                                                    <div class="text-muted text-small d-md-none">КОНТЕНТ</div>
                                                    <div class="text-alternate"><?php echo $dataItem['ncontent'] ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Recent Orders End -->
                    </div>
                </div>
            </div>
        </main>

        <?php include('./partials/footer.php'); ?>

    <!-- Vendor Scripts Start -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="js/vendor/jquery-3.5.1.min.js"></script>
    <script src="js/vendor/bootstrap.bundle.min.js"></script>
    <script src="js/vendor/OverlayScrollbars.min.js"></script>
    <script src="js/vendor/autoComplete.min.js"></script>
    <script src="js/vendor/clamp.min.js"></script>
    <script src="js/vendor/tagify.min.js"></script>
    <!-- Vendor Scripts End -->

    <!-- Template Base Scripts Start -->
    <script src="font/CS-Line/csicons.min.js"></script>
    <script src="js/base/helpers.js"></script>
    <script src="js/base/globals.js"></script>
    <script src="js/base/nav.js"></script>
    <script src="js/base/search.js"></script>
    <script src="js/base/settings.js"></script>
    <script src="js/base/init.js"></script>
    <!-- Template Base Scripts End -->
    <!-- Page Specific Scripts Start -->
    <script src="js/pages/customers.detail.js"></script>
    <script src="js/common.js"></script>
    <script src="js/scripts.js"></script>
    <!-- Page Specific Scripts End -->
</body>

</html>