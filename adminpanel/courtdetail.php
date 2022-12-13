<?php
session_start();
$username = $_SESSION['username'];
include('../db/dbConnect.php');
if (empty($_SESSION['username'])) {
  header("location:admin-login.php");
}

$cat = !empty($_GET['cat']) ? $_GET['cat'] : '';
$subcat = !empty($_GET['subcat']) ? $_GET['subcat'] : '';
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
              <div class="w-auto sw-md-30">
                <a href="./court.php" class="muted-link pb-1 d-inline-block breadcrumb-back">
                  <i data-cs-icon="chevron-left" data-cs-size="13"></i>
                  <span class="text-small align-middle">Корты</span>
                </a>
                <h1 class="mb-0 pb-0 display-4" id="title">Корт #<?php echo $_GET['id'] ?></h1>
              </div>
            </div>
          </div>
        </div>
        <!-- Title and Top Buttons End -->

        <div class="row gx-4 gy-5">
          <!-- Customer Start -->
          <div class="col-12 col-xl-4 col-xxl-3">
            <h2 class="small-title">Информация</h2>
            <?php
            $sql = "select * from `court` where kid = " . $_GET['id'];
            $res = $conn->query($sql);
            $data = mysqli_fetch_assoc($res);
            ?>
            <div class="card">
              <div class="card-body mb-n5">
                <div class="d-flex align-items-center flex-column">
                  <div class="mb-5 d-flex align-items-center flex-column">
                    <div class="h5 mb-1"><?php echo $data['kname']; ?></div>
                  </div>
                </div>
                <div class="d-flex justify-content-center">
                  <div class="d-flex flex-row justify-content-between w-100 w-sm-50 w-xl-100 mb-5">
                    <a href="./addcourt.php?edit=<?php echo $_GET['id']; ?>" class="btn btn-primary w-100 me-2">Редактировать</a>
                  </div>
                </div>
                <div class="mb-5">
                  <div class="row g-0 align-items-center mb-2">
                    <div class="col-auto">
                      <div class="border border-primary sw-5 sh-5 rounded-xl d-flex justify-content-center align-items-center">
                        <i data-cs-icon="credit-card" class="text-primary"></i>
                      </div>
                    </div>
                    <div class="col ps-3">
                      <div class="row g-0">
                        <div class="col">
                          <div class="p mb-0 sh-5 d-flex align-items-center lh-1-25">Количество бронирований</div>
                        </div>
                        <div class="col-auto">
                          <div class="sh-5 d-flex align-items-center">
                            <?php
                            $sql = "select count(*) c from `torder` where kid=" . $_GET['id'];
                            $res = $conn->query($sql);
                            $data = mysqli_fetch_assoc($res);
                            echo $data['c'];
                            ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Customer End -->
        </div>
      </div>
    </main>

    <?php include('./partials/footer.php'); ?>

  <!-- Vendor Scripts Start -->
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