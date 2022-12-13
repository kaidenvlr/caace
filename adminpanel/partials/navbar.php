<div id="nav" class="nav-container d-flex">
      <div class="nav-content d-flex">
        <!-- Logo Start -->
        <div class="logo position-relative">
          <a href="./admin-login.php">
            <!-- Logo can be added directly -->
            <img src="../../images/icourt_logo.png" alt="logo" />

            <!-- Or added via css to provide different ones for different color themes -->
          </a>
        </div>
        <!-- Logo End -->

        <!-- User Menu Start -->
        <div class="user-container d-flex">
          <a href="#" class="d-flex user position-relative" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img class="profile" alt="profile" src="img/profile/profile-11.jpg" />
              <div class="name"><?php echo $_SESSION['username']; ?></div> <!-- edited -->
          </a>
          <div class="dropdown-menu dropdown-menu-end user-menu wide">
              <div class="row mb-1 ms-0 me-0">
                  <div class="col-6 pe-1 ps-1">
                      <ul class="list-unstyled">
                          <li>
                              <a href="./script/logout.php">
                                  <i data-cs-icon="logout" class="me-2" data-cs-size="17"></i>
                                  <span class="align-middle">Выход</span>
                              </a>
                          </li>
                      </ul>
                  </div>
              </div>
          </div>
        </div>
        <!-- User Menu End -->

        <!-- Icons Menu Start -->
        <ul class="list-unstyled list-inline text-center menu-icons">
          <li class="list-inline-item">
            <a href="#" id="pinButton" class="pin-button">
              <i data-cs-icon="lock-on" class="unpin" data-cs-size="18"></i>
              <i data-cs-icon="lock-off" class="pin" data-cs-size="18"></i>
            </a>
          </li>
          <li class="list-inline-item">
            <a href="#" id="colorButton">
              <i data-cs-icon="light-on" class="light" data-cs-size="18"></i>
              <i data-cs-icon="light-off" class="dark" data-cs-size="18"></i>
            </a>
          </li>
        </ul>
        <!-- Icons Menu End -->

        <!-- Menu Start -->
        <div class="menu-container flex-grow-1">
          <ul id="menu" class="menu">
            <li>
              <a href="./admin-login.php">
                <i data-cs-icon="shop" class="icon" data-cs-size="18"></i>
                <span class="label">Панель</span>
              </a>
            </li>

            <?php
            if ($_SESSION['role'] == 0) {
            ?>
            <li>
              <a href="./admin.php">
                <i data-cs-icon="tag" class="icon" data-cs-size="18"></i>
                <span class="label">Администраторы</span>
              </a>
            </li>
            <li>
              <a href="./manager.php">
                <i data-cs-icon="tag" class="icon" data-cs-size="18"></i>
                <span class="label">Менеджеры</span>
              </a>
            </li>
            <li>
              <a href="./news.php">
                <i data-cs-icon="tag" class="icon" data-cs-size="18"></i>
                <span class="label">Новости</span>
              </a>
            </li>
            <li>
              <a href="./city.php">
                <i data-cs-icon="tag" class="icon" data-cs-size="18"></i>
                <span class="label">Города</span>
              </a>
            </li>
            <li>
              <a href="./order.php">
                <i data-cs-icon="cart" class="icon" data-cs-size="18"></i>
                <span class="label">Заказы</span>
              </a>
            </li>
            <li>
              <a href="./customer.php">
                <i data-cs-icon="user" class="icon" data-cs-size="18"></i>
                <span class="label">Пользователи</span>
              </a>
            </li>
            <?php
            } 
            ?>
            <?php
            if ($_SESSION['role'] == 1) {
            ?>
            <li>
              <a href="./city.php">
                <i data-cs-icon="tag" class="icon" data-cs-size="18"></i>
                <span class="label">Города</span>
              </a>
            </li>
            <li>
              <a href="./order.php">
                <i data-cs-icon="cart" class="icon" data-cs-size="18"></i>
                <span class="label">Заказы</span>
              </a>
            </li>
            <li>
              <a href="./customer.php">
                <i data-cs-icon="user" class="icon" data-cs-size="18"></i>
                <span class="label">Пользователи</span>
              </a>
            </li>
            <?php 
            }
            if ($_SESSION['role'] == 2) {
                $sqlcenterrole = "select * from `centerrole` where aid=".$_SESSION['id'];
                $rescenterrole = $conn -> query($sqlcenterrole);
                $datacenterrole = mysqli_fetch_assoc($rescenterrole);
            ?>
            <li>
              <a href="./tarifes.php">
                <i data-cs-icon="tag" class="icon" data-cs-size="18"></i>
                <span class="label">Тарифы</span>
              </a>
            </li>
            <li>
              <a href="./order.php">
                <i data-cs-icon="tag" class="icon" data-cs-size="18"></i>
                <span class="label">Заказы</span>
              </a>
            </li>
            <?php } ?>
          </ul>
        </div>
        <!-- Menu End -->

        <!-- Mobile Buttons Start -->
        <div class="mobile-buttons-container">
          <!-- Menu Button Start -->
          <a href="#" id="mobileMenuButton" class="menu-button">
            <i data-cs-icon="menu"></i>
          </a>
          <!-- Menu Button End -->
        </div>
        <!-- Mobile Buttons End -->
      </div>
      <div class="nav-shadow"></div>
    </div>