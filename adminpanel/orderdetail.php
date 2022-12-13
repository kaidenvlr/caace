<?php
session_start();
$username = $_SESSION['username'];
include('../db/dbConnect.php');
if (empty($_SESSION['username'])) {
  header("location:admin-login.php");
}

$orderId = $_GET['id'];

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
              <div class="w-auto sw-md-50">
                <a href="./order.php" class="muted-link pb-1 d-inline-block breadcrumb-back">
                  <i data-cs-icon="chevron-left" data-cs-size="13"></i>
                  <span class="text-small align-middle">Заказы</span>
                </a>
                <h1 class="mb-0 pb-0 display-4" id="title">Данные о заказе № <?php echo $orderId; ?></h1>
              </div>
            </div>
            <!-- Title End -->

            <!-- Top Buttons Start -->
            <div class="col-12 col-md-5 d-flex align-items-end justify-content-end">

              <!-- Dropdown Button Start -->
              <div class="ms-1">
                <button type="button" class="btn btn-outline-primary btn-icon btn-icon-only" data-bs-offset="0,3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-submenu>
                  <i data-cs-icon="more-horizontal"></i>
                </button>
              </div>
              <!-- Dropdown Button End -->
            </div>
            <!-- Top Buttons End -->
          </div>
        </div>
        <!-- Title and Top Buttons End -->
        <?php
        $sql = "select * from `torder` where oid=" . $orderId;
        $res = $conn->query($sql);
        $data = mysqli_fetch_assoc($res);

        $sqlCenter = "select * from `center` where ctid = (select ctid from `court` where kid = " . $data['kid'] . ")";
        $resCenter = $conn -> query($sqlCenter);
        $dataCenter = mysqli_fetch_assoc($resCenter);

        $sqlCourt = "select * from `court` where kid=" . $data['kid'];
        $resCourt = $conn->query($sqlCourt);
        $dataCourt = mysqli_fetch_assoc($resCourt);


        $sqlUser = "select * from `user` where uid=" . $data['uid'];
        $resUser = $conn->query($sqlUser);
        $dataUser = mysqli_fetch_assoc($resUser);

        $sqlTimestart = "select tsname from `timeslot` where tsid = " . $data['ostart'];
        $resTimestart = $conn -> query($sqlTimestart);
        $dataTimestart = mysqli_fetch_assoc($resTimestart);

        $sqlTimeend = "select tsname from `timeslot` where tsid = " . $data['oend'];
        $resTimeend = $conn -> query($sqlTimeend);
        $dataTimeend = mysqli_fetch_assoc($resTimeend);

        $sqlCity = "select * from `city` where cid=(select cid from `center` where ctid = (select ctid from `court` where kid=" . $data['kid'] . '))';
        $resCity = $conn->query($sqlCity);
        $dataCity = mysqli_fetch_assoc($resCity);
        ?>
        <div class="row gx-4 gy-5">
          <div class="col-12 col-xl-8 col-xxl-9 mb-n5">
            <!-- Status Start -->
            <h2 class="small-title">Статус</h2>
            <div class="mb-5">
              <div class="row g-2">

                <div class="col-12 col-sm-4 col-lg-4">
                  <div class="card sh-13 sh-lg-15 sh-xl-14">
                    <div class="h-100 row g-0 card-body align-items-center py-3">
                      <div class="col-auto pe-3">
                        <div class="border border-primary sw-6 sh-6 rounded-xl d-flex justify-content-center align-items-center">
                          <i data-cs-icon="tag" class="text-primary"></i>
                        </div>
                      </div>
                      <div class="col">
                        <div class="p mb-0 d-flex align-items-center lh-1-25">ID бронирования</div>
                        <div class="text-primary"><?php echo $orderId; ?></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-4 col-lg-4">
                  <div class="card sh-13 sh-lg-15 sh-xl-14">
                    <div class="h-100 row g-0 card-body align-items-center py-3">
                      <div class="col-auto pe-3">
                        <div class="border border-primary sw-6 sh-6 rounded-xl d-flex justify-content-center align-items-center">
                          <i data-cs-icon="clipboard" class="text-primary"></i>
                        </div>
                      </div>
                      <div class="col">
                        <div class="p mb-0 d-flex align-items-center lh-1-25">Статус бронирования</div>
                        <div class="text-primary"><?php echo $data['ostatus'] ?></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-4 col-lg-4">
                  <div class="card sh-13 sh-lg-15 sh-xl-14">
                    <div class="h-100 row g-0 card-body align-items-center py-3">
                      <div class="col-auto pe-3">
                        <div class="border border-primary sw-6 sh-6 rounded-xl d-flex justify-content-center align-items-center">
                          <i data-cs-icon="calendar" class="text-primary"></i>
                        </div>
                      </div>
                      <div class="col">
                        <div class="p mb-0 d-flex align-items-center lh-1-25">Дата бронирования</div>
                        <div class="text-primary"><?php echo $data['odate']; ?></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Status End -->
          </div>
          <!-- Address Start -->
          <div class="col-12 col-xl-4 col-xxl-4">
            <h2 class="small-title">Данные о пользователе</h2>
            <div class="card mb-5">
              <div class="card-body mb-n5">
                <div class="mb-5">
                  <p class="text-small text-muted mb-2">ПОЛЬЗОВАТЕЛЬ</p>
                  <div class="row g-0 mb-2">
                    <div class="col-auto">
                      <div class="sw-3 me-1">
                        <i data-cs-icon="user" class="text-primary" data-cs-size="17"></i>
                      </div>
                    </div>
                    <div class="col text-alternate align-middle"><?php echo $dataUser['ulastname'] . " " . $dataUser['ufirstname']; ?></div>
                  </div>
                  <div class="row g-0 mb-2">
                    <div class="col-auto">
                      <div class="sw-3 me-1">
                        <i data-cs-icon="email" class="text-primary" data-cs-size="17"></i>
                      </div>
                    </div>
                    <div class="col text-alternate"><?php echo $dataUser['email']; ?></div>
                  </div>
                  <div class="row g-0 mb-2">
                    <div class="col-auto">
                      <div class="sw-3 me-1">
                        <i data-cs-icon="pin" class="text-primary" data-cs-size="17"></i>
                      </div>
                    </div>
                    <div class="col text-alternate"><?php echo $dataCity['cname']; ?></div>
                  </div>
                  <div class="row g-0 mb-2">
                    <div class="col-auto">
                      <div class="sw-3 me-1">
                        <i data-cs-icon="phone" class="text-primary" data-cs-size="17"></i>
                      </div>
                    </div>
                    <div class="col text-alternate"><?php echo $data['ophone']; ?></div>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-xl-6 col-xxl-6">
            <h2 class="small-title">Данные о теннисном центре</h2>
            <div class="card mb-5">
              <div class="card-body mb-n5">
                <div class="mb-5">
                  <p class="text-small text-muted mb-2">ТЕННИСНЫЙ ЦЕНТР</p>
                  <div class="row g-0 mb-2">
                    <div class="col-auto">
                      <div class="sw-3 me-1">
                        <i data-cs-icon="prize" class="text-primary" data-cs-size="17"></i>
                      </div>
                    </div>
                    <div class="col text-alternate align-middle"><?php echo $dataCenter['ctname'] . ", " . $dataCourt['kname']; ?></div>
                  </div>
                  <div class="row g-0 mb-2">
                    <div class="col-auto">
                      <div class="sw-3 me-1">
                        <i data-cs-icon="clock" class="text-primary" data-cs-size="17"></i>
                      </div>
                    </div>
                    <div class="col text-alternate"><?php echo $dataTimestart['tsname'] . " - " . $dataTimeend['tsname']; ?></div>
                  </div>
                  <div class="row g-0 mb-2">
                    <div class="col-auto">
                      <div class="sw-3 me-1">
                        <i data-cs-icon="money" class="text-primary" data-cs-size="17"></i>
                      </div>
                    </div>
                    <div class="col text-alternate"><?php echo $data['oprice']; ?></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Address End -->
        </div>
      </div>
    </main>

    <!-- Layout Footer Start -->
    <?php include('./partials/footer.php'); ?>

  <!-- Vendor Scripts Start -->
  <script src="js/vendor/jquery-3.5.1.min.js"></script>
  <script src="js/vendor/bootstrap.bundle.min.js"></script>
  <script src="js/vendor/OverlayScrollbars.min.js"></script>
  <script src="js/vendor/autoComplete.min.js"></script>
  <script src="js/vendor/clamp.min.js"></script>

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

  <script src="js/common.js"></script>
  <script src="js/scripts.js"></script>
  <!-- Page Specific Scripts End -->
</body>

</html>