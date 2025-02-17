<?php
    session_start();
    if (isset($_SESSION['account'])) {
      // Lấy thông tin tài khoản hiện tại
      
      $account = $_SESSION['account'];
      include ('DB/DBcontext.php');
      $sql = "SELECT * FROM `accountcustomer` WHERE `SDT` = '$account' OR `Email` = '$account'";
      $data = $db->ArraySelect($sql);
      if(count($data) > 0){
          $account_id = $data[0]['id'];
          echo $account_id;
          if($data[0]['access']!='employee'){
            echo"
            <script>
              alert('Không có quyền truy cập!');
              window.location.href = '../index.php';
            </script>";
          }
      }
      else{
          echo"
          <script>
            alert('tài khoản không tồn tại!');
            window.location.href = '../login.html';
          </script>";
      }
    }
    else{
      echo"
          <script>
            alert('Vui lòng đăng nhập!');
            window.location.href = '../login.html';
          </script>";
    }
    
    
    $dataorder = $db->ArraySelect("SELECT * FROM `order` WHERE status = 'waiting'");

    $datamesm = $db->ArraySelect("SELECT * FROM `contact` WHERE status = 0");

    $db->closeConnection();

    $tb = count($dataorder);
    $tb1 = count($datamesm);
?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
<!-- Màn hình Block UI -->
<div id="blockUI">
    <div class="text-center bg-white p-4 rounded shadow">
        <div class="spinner-border text-primary" role="status"></div>
        <p class="mt-2 fw-bold">Loading...</p>
    </div>
</div>
<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">
    
    <div class="d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        <span class="d-none d-lg-block">Admin</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->
    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-bell"></i>
            <span class="badge bg-primary badge-number"><?php echo $tb ?> </span>
          </a><!-- End Notification Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li class="dropdown-header">
              You have <?php echo $tb ?> new notifications
              <a href="order.php"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <?php
                foreach($dataorder as $item){
                  $datetimeFromDB = $item['DayCreate'];
                  $now = new DateTime();
                  $past = new DateTime($datetimeFromDB);
                  $diff = $now->diff($past);
                  $time = "";
                  if ($diff->s > 0) $time = $diff->s . " seconds ago";
                  if ($diff->i > 0) $time = $diff->i . " minutes ago";
                  if ($diff->h > 0) $time = $diff->h . " hours ago";
                  if ($diff->d > 0) $time = $diff->d . " days ago";
                  if ($diff->m > 0) $time = $diff->m . " months ago";
                  if ($diff->y > 0) $time = $diff->y . " years ago";

                  
            ?>
            <li class="notification-item" onclick="orderclick('product_in_order.php?orderId=<?php echo $item['id'] ?>')">
              <i class="bi bi-exclamation-circle text-warning"></i>
              <div>
                <h4>Order: <?php echo $item['id'] ?></h4>
                <p><?php echo $item['FullName'] ?></p>
                <p><?php echo $item['Phone'] ?></p>
                <p><?php echo $item['address'] ?></p>
                <p>Total: <?php echo $item['total'] ?></p>
                <p><?php echo $time ?></p>
              </div>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <?php
                }
            ?>        
            <li class="dropdown-footer">
              <a href="order.php">Show all notifications</a>
            </li>

          </ul><!-- End Notification Dropdown Items -->

        </li><!-- End Notification Nav -->

        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-chat-left-text"></i>
            <span class="badge bg-success badge-number"><?php echo $tb1 ?></span>
          </a><!-- End Messages Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
            <li class="dropdown-header">
              You have <?php echo $tb1 ?> new messages
              <a href="contact.php"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <?php
                foreach($datamesm as $item){
                  $datetimeFromDB = $item['CreateDay'];
                  $now = new DateTime();
                  $past = new DateTime($datetimeFromDB);
                  $diff = $now->diff($past);
                  $time = "";
                  if ($diff->s > 0) $time = $diff->s . " seconds ago";
                  if ($diff->i > 0) $time = $diff->i . " minutes ago";
                  if ($diff->h > 0) $time = $diff->h . " hours ago";
                  if ($diff->d > 0) $time = $diff->d . " days ago";
                  if ($diff->m > 0) $time = $diff->m . " months ago";
                  if ($diff->y > 0) $time = $diff->y . " years ago";

                  
            ?>
            <li class="message-item">
              <a onmouseover="editStatusContact(<?php echo $item['id'] ?>)">
                <div>
                  <h4><?php echo $item['fullname'] ?></h4>
                  <p>New message from <?php echo $item['Email'] ?></p>
                  <h5><?php echo $item['Subject'] ?></h3>
                  <p><?php echo $item['Message'] ?></p>
                  <p><?php echo $time ?></p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <?php } ?>
            <li class="dropdown-footer">
              <a href="contact.php">Show all messages</a>
            </li>

          </ul><!-- End Messages Dropdown Items -->

        </li><!-- End Messages Nav -->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="https://cdn.pixabay.com/photo/2015/09/09/14/02/icon-931551_1280.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">Admin</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>Admin</h6>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <script>
    orderclick = function(href){
      window.location.href = href;
    };
  </script>