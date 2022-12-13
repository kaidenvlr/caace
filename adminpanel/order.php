<?php
session_start();
$username = $_SESSION['username'];
include('../db/dbConnect.php');
if (empty($_SESSION['username'])) {
  header("location:admin-login.php");
}

if ($_SESSION['role'] == 2) {
  $sqlcenterrole = "select * from `centerrole` where aid = " . $_SESSION['id'];
  $rescenterrole = $conn -> query($sqlcenterrole);
  $datacenterrole = mysqli_fetch_assoc($rescenterrole);
}
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
    $(document).on('click', '.delete', function(e) {
      var el = $(this);
      var id = $(this).attr('id');
      var name = $(this).attr('name');
      $.ajax({
        type: "GET",
        url: "./script/delete.php",
        data: {
          deleteId: id,
          deleteData: name
        },
        dataType: "html",
        success: function(data) {
          alert("Удалено!");
        }
      })
    });
  </script>
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
                <a href="./dashboard.php" class="muted-link pb-1 d-inline-block breadcrumb-back">
                  <i data-cs-icon="chevron-left" data-cs-size="13"></i>
                  <span class="text-small align-middle">Главная</span>
                </a>
                <h1 class="mb-0 pb-0 display-4" id="title">Список заказов</h1>
              </div>
            </div>
            <!-- Title End -->
            <!-- Top Buttons Start -->
            <div class="col-3 d-flex align-items-end justify-content-end">
              <button type="button" class="export btn btn-outline-primary p-2 pb-1 ps-0 pe-4" name="export-order">Export to Excel</button>
            </div>
            <!-- Top Buttons End -->
          </div>
        </div>
        <!-- Title and Top Buttons End -->

        <!-- Order List Start -->
        <div class="row">
          <div class="col-12 mb-5">
            <div class="card mb-2 bg-transparent no-shadow d-none d-md-block">
              <div class="card-body pt-0 pb-0 sh-3">
                <div class="row g-0 h-100 align-content-center">
                  <div class="col-12 col-md-1 d-flex align-items-center mb-2 mb-md-0 text-muted text-small">ID</div>
                  <div class="col-6 col-md-4 d-flex align-items-center text-alternate text-medium text-muted text-small">ПОЛЬЗОВАТЕЛЬ</div>
                  <div class="col-6 col-md-2 d-flex align-items-center text-alternate text-medium text-muted text-small">СТОИМОСТЬ</div>
                  <div class="col-6 col-md-2 d-flex align-items-center text-alternate text-medium text-muted text-small">ДАТА</div>
                  <div class="col-6 col-md-2 d-flex align-items-center text-alternate text-medium text-muted text-small">СТАТУС</div>
                  <div class="col-6 col-md-1 d-flex align-items-center text-alternate text-medium text-muted text-small">УДАЛИТЬ</div>
                </div>
              </div>
            </div>
            <?php
            if (!empty($datacenterrole['ctid']))
              $sql = "select * from `torder` where kid in (select kid from court where ctid = " . $datacenterrole['ctid'] . ");";
            else
              $sql = "select * from `torder`;";
            $res = $conn->query($sql);
            if ($res->num_rows > 0) {
              while ($data = mysqli_fetch_assoc($res)) {
            ?>
                <div id="checkboxTable">
                  <div class="card mb-2">
                    <div class="card-body pt-0 pb-0 sh-21 sh-md-8">
                      <div class="row g-0 h-100 align-content-center">
                        <div class="col-11 col-md-1 d-flex flex-column justify-content-center mb-2 mb-md-0 order-1 order-md-1 h-md-100 position-relative">
                          <div class="text-muted text-small d-md-none">ID</div>
                          <a href="./orderdetail.php?id=<?php echo $data['oid']; ?>" class="text-truncate h-100 d-flex align-items-center"><?php echo $data['oid']; ?></a>
                        </div>
                        <div class="col-6 col-md-4 d-flex flex-column justify-content-center mb-2 mb-md-0 order-3 order-md-2">
                          <div class="text-muted text-small d-md-none">ПОЛЬЗОВАТЕЛЬ</div>
                          <div class="text-alternate"><?php
                                                      $sqlUser = "select * from `user` where uid=" . $data['uid'];
                                                      $resUser = $conn->query($sqlUser);
                                                      $dataUser = mysqli_fetch_assoc($resUser);
                                                      echo $dataUser['ulastname'] . " " . $dataUser['ufirstname'];
                                                      ?></div>
                        </div>
                        <div class="col-6 col-md-2 d-flex flex-column justify-content-center mb-2 mb-md-0 order-4 order-md-2">
                          <div class="text-muted text-small d-md-none">СТОИМОСТЬ</div>
                          <div class="text-alternate">
                            <span>
                              <span class="text-small">$</span>
                              <?php echo $data['oprice']; ?>
                            </span>
                          </div>
                        </div>
                        <div class="col-6 col-md-2 d-flex flex-column justify-content-center mb-2 mb-md-0 order-5 order-md-2">
                          <div class="text-muted text-small d-md-none">ДАТА</div>
                          <div class="text-alternate"><?php echo $data['odate']; ?></div>
                        </div>
                        <div class="col-6 col-md-2 d-flex flex-column justify-content-center mb-2 mb-md-0 order-last order-md-2">
                          <div class="text-muted text-small d-md-none">СТАТУС</div>
                          <div class="text-alternate">
                            <span class="badge rounded-pill bg-outline-primary"><?php echo $data['ostatus']; ?></span>
                          </div>
                        </div>

                        <div class="col-6 col-md-1 d-flex flex-column justify-content-center mb-2 mb-md-0 order-4 order-md-2">
                          <div class="text-muted text-small d-md-none">УДАЛИТЬ</div>
                          <div class="text-alternate">
                            <a class="delete" name="delete-order" id="<?php echo $data['aid']; ?>" href="javascript:void(0)">
                              <i data-cs-icon="minus" class="text-primary"></i>
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            <?php }
            } else {
              echo "Нет данных о существующих заказах";
            } ?>
          </div>
        </div>
        <!-- Order List End -->

        <!-- Pagination Start -->
        <!-- <div class="d-flex justify-content-center">
          <nav>
            <ul class="pagination">
              <li class="page-item disabled">
                <a class="page-link shadow" href="#" tabindex="-1" aria-disabled="true">
                  <i data-cs-icon="chevron-left"></i>
                </a>
              </li>
              <li class="page-item active"><a class="page-link shadow" href="#">1</a></li>
              <li class="page-item"><a class="page-link shadow" href="#">2</a></li>
              <li class="page-item"><a class="page-link shadow" href="#">3</a></li>
              <li class="page-item">
                <a class="page-link" href="#">
                  <i data-cs-icon="chevron-right"></i>
                </a>
              </li>
            </ul>
          </nav>
        </div> -->
        <!-- Pagination End -->
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
    <script src="js/cs/checkall.js"></script>
    <script src="js/pages/orders.list.js"></script>
    <script src="js/common.js"></script>
    <script src="js/scripts.js"></script>
    <!-- Page Specific Scripts End -->

    <script>
      $(document).on('click', '.export', function(e) {
        var el = $(this);
        var name = $(this).attr('name');
        $.ajax({
          url: "script/xls.php",
          type: "GET",
          data: {
            operation: name
          },
          success: function(result) {
            alert("Exported!");
          }
        })
      });
    </script>
</body>

</html>