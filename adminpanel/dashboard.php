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
            <div class="col-12 col-md-7">
              <a class="muted-link pb-2 d-inline-block hidden" href="#">
                <span class="align-middle lh-1 text-small">&nbsp;</span>
              </a>
              <h1 class="mb-0 pb-0 display-4" id="title">Добро пожаловать, <?php echo $_SESSION['username']; ?></h1>
            </div>
            <!-- Title End -->
          </div>
        </div>
        <!-- Title and Top Buttons End -->

        <!-- Stats Start -->
        <div class="row">
          <div class="col-12">
            <div class="d-flex">
              <h2 class="small-title">Статистика за все время</h2>
            </div>


            <div class="mb-5">
              <div class="row g-2">

                <?php if ($_SESSION['role'] == 2) { ?>
                  <div class="col-6 col-md-8 col-lg-6">
                <?php } else { ?>
                  <div class="col-6 col-mb-6 col-lg-3">
                <?php } ?>
                  <div class="card h-100 hover-scale-up cursor-pointer">
                    <div class="card-body d-flex flex-column align-items-center">
                      <div class="sw-6 sh-6 rounded-xl d-flex justify-content-center align-items-center border border-primary mb-4">
                        <i data-cs-icon="basket" class="text-primary"></i>
                      </div>
                      <div class="mb-1 d-flex align-items-center text-alternate text-small lh-1-25">КОЛИЧЕСТВО ЗАКАЗОВ</div>
                      <div class="text-primary cta-4">
                        <?php
                        if ($_SESSION['role'] == 2) {
                          $sqlCenter = "select ctid from `centerrole` where aid = " . $_SESSION['id'];
                          $resCenter = $conn -> query($sqlCenter);
                          $dataCenter = mysqli_fetch_assoc($resCenter);
                          $sql = "select count(*) c from `torder` where kid in (select kid from `court` where ctid = ". $dataCenter['ctid'] . ")";
                        }
                        else 
                          $sql = "select count(*) c from `torder`";
                        $res = $conn -> query($sql);
                        $data = mysqli_fetch_assoc($res);
                        echo $data['c']
                        ?></div>
                    </div>
                  </div>
                </div>


                <?php if ($_SESSION['role'] != 2) { ?>
                <div class="col-6 col-md-4 col-lg-3">
                  <div class="card h-100 hover-scale-up cursor-pointer">
                    <div class="card-body d-flex flex-column align-items-center">
                      <div class="sw-6 sh-6 rounded-xl d-flex justify-content-center align-items-center border border-primary mb-4">
                        <i data-cs-icon="user" class="text-primary"></i>
                      </div>
                      <div class="mb-1 d-flex align-items-center text-alternate text-small lh-1-25">КОЛИЧЕСТВО ПОЛЬЗОВАТЕЛЕЙ</div>
                      <div class="text-primary cta-4"><?php
                                                      $sql = "select count(*) c from `user`;";
                                                      $res = $conn->query($sql);
                                                      $data = mysqli_fetch_assoc($res);
                                                      echo $data['c']
                                                      ?></div>
                    </div>
                  </div>
                </div>
                <?php } ?>


                <?php if ($_SESSION['role'] != 2) {?>
                <div class="col-6 col-md-4 col-lg-3">
                  <div class="card h-100 hover-scale-up cursor-pointer">
                    <div class="card-body d-flex flex-column align-items-center">
                      <div class="sw-6 sh-6 rounded-xl d-flex justify-content-center align-items-center border border-primary mb-4">
                        <i data-cs-icon="tag" class="text-primary"></i>
                      </div>
                      <div class="mb-1 d-flex align-items-center text-alternate text-small lh-1-25">КОЛИЧЕСТВО ГОРОДОВ</div>
                      <div class="text-primary cta-4">
                        <?php
                          $sql = "select count(*) c from `city`;";
                          $res = $conn->query($sql);
                          $data = mysqli_fetch_assoc($res);
                          echo $data['c']
                        ?>
                      </div>
                    </div>
                  </div>
                </div>
                <?php } ?>

              </div>
            </div>
          </div>
        </div>
        <!-- Stats End -->

        <div class="row">
          <!-- Recent Orders Start -->
          <div class="col-xl-6 mb-5">
            <h2 class="small-title">Последние заказы</h2>
            <div class="mb-n2 scroll-out">
              <div class="scroll-by-count" data-count="6">
                <?php
                if ($_SESSION['role'] == 2) {
                  $sqlCenter = "select ctid from `centerrole` where aid = " . $_SESSION['id'];
                  $resCenter = $conn -> query($sqlCenter);
                  $dataCenter = mysqli_fetch_assoc($resCenter);
                  $sql = "select oid, uid, ostatus, kid, oprice, odate from `torder` where kid in (select kid from `court` where ctid = ". $dataCenter['ctid'] . ") order by oid desc limit 6";
                } else 
                  $sql = "select oid, uid, kid, oprice from `torder` order by oid desc limit 6;";
                $res = $conn->query($sql);
                if ($res->num_rows > 0) {
                  while ($data = mysqli_fetch_assoc($res)) {
                ?>
                    <div class="card mb-2 sh-15 sh-md-6">
                      <div class="card-body pt-0 pb-0 h-100">
                        <div class="row g-0 h-100 align-content-center">
                          <div class="col-6 col-md-2 d-flex align-items-center mb-3 mb-md-0 h-md-100">
                            <a href="./orderdetail.php?id=<?php echo $data['oid']; ?>" class="body-link stretched-link">Заказ #<?php echo $data['oid']; ?></a>
                          </div>
                          <div class="col-12 col-md-3 d-flex align-items-center justify-content-md-end mb-1 mb-md-0 text-alternate">
                            <?php
                            $sqlUser = "select ufirstname, ulastname from `user` where uid = " . $data['uid'];
                            $resUser = $conn -> query($sqlUser);
                            $dataUser = mysqli_fetch_assoc($resUser);
                            echo $dataUser['ulastname'] . " " . $dataUser['ufirstname']; ?>
                          </div>
                          <div class="col-12 col-md-3 d-flex align-items-center text-muted mb-1 mb-md-0 justify-content-end">
                            <span class="badge bg-outline-primary me-1"><?php echo $data['ostatus']; ?></span>
                          </div>
                          <div class="col-12 col-md-2 d-flex align-items-center justify-content-md-end mb-1 mb-md-0 text-alternate">
                            <?php echo $data['odate']; ?>
                          </div>
                          <div class="col-12 col-md-2 d-flex align-items-center justify-content-md-end mb-1 mb-md-0 text-alternate">
                            <?php echo $data['oprice']; ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php }
                } else {
                  ?>
                  <div class="card mb-2 sh-15 sh-md-6">
                    <div class="card-body pt-0 pb-0 h-100">
                      <div class="row g-0 h-100 align-content-center">
                        No data.
                      </div>
                    </div>
                  </div>
                <?php } ?>
              </div>
            </div>
          </div>

          <div class="col-xl-6 mb-5">
            <h2 class="small-title">Последние зарегистрированные пользователи</h2>
            <div class="mb-n2 scroll-out">
              <div class="scroll-by-count" data-count="6">
                <?php
                $sql = "select uid, email, ufirstname, ulastname from `user` order by uid desc limit 6;";
                $res = $conn->query($sql);
                if ($res->num_rows > 0) {
                  while ($data = mysqli_fetch_assoc($res)) {
                ?>
                    <div class="card mb-2 sh-15 sh-md-6">
                      <div class="card-body pt-0 pb-0 h-100">
                        <div class="row g-0 h-100 align-content-center">
                          <div class="col-10 col-md-4 d-flex align-items-center mb-3 mb-md-0 h-md-100">
                            <a href="./customerdetail.php?id=<?php echo $data['uid']; ?>" class="body-link stretched-link">Пользователь #<?php echo $data['uid']; ?></a>
                          </div>
                          <div class="col-12 col-md-4 d-flex align-items-center mb-1 mb-md-0 text-alternate">
                            <?php echo $data['ulastname']." ".$data['ufirstname']; ?>
                          </div>
                          <div class="col-12 col-md-3 d-flex align-items-center justify-content-md-end mb-1 mb-md-0 text-alternate">
                            <?php echo $data['email']; ?></div>
                        </div>
                      </div>
                    </div>
                  <?php }
                } else {
                  ?>
                  <div class="card mb-2 sh-15 sh-md-6">
                    <div class="card-body pt-0 pb-0 h-100">
                      <div class="row g-0 h-100 align-content-center">
                        No data.
                      </div>
                    </div>
                  </div>
                <?php } ?>
              </div>
            </div>
          </div>
          <!-- Performance End -->
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
  <script src="js/vendor/Chart.bundle.min.js"></script>
  <script src="js/vendor/chartjs-plugin-rounded-bar.min.js"></script>
  <script src="js/vendor/jquery.barrating.min.js"></script>
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
  <script src="js/cs/charts.extend.js"></script>
  <script src="js/pages/dashboard.js"></script>
  <script src="js/common.js"></script>
  <script src="js/scripts.js"></script>
  <script src="https://kit.fontawesome.com/a9f6196afa.js" crossorigin="anonymous"></script>
  <!-- Page Specific Scripts End -->
</body>

</html>