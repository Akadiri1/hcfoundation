<?php
ob_start();
$level_check = ['MASTER', 3, 2, 1];

$formError = '';
$formSuccess = $_GET['success'] ?? '';

// Handle creating a new admin
if (array_key_exists('add_admin', $_POST)) {
    $firstname = trim($_POST['firstname'] ?? '');
    $lastname  = trim($_POST['lastname'] ?? '');
    $email     = trim($_POST['email'] ?? '');
    $username  = trim($_POST['username'] ?? '');
    $password  = trim($_POST['password'] ?? '');
    $level     = trim($_POST['level'] ?? '1');

    if (empty($email) || empty($password)) {
        $formError = 'Both email and password are required to create an admin.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $formError = 'Please provide a valid email address.';
    } else {
        // Check if email already exists
        $existing = selectContent($conn, 'admin', ['email' => $email]);
        if (count($existing) > 0) {
            $formError = 'An admin account with this email address already exists.';
        } else {
            $hashed = password_hash($password, PASSWORD_BCRYPT);
            $hashId = 'admin_' . time() . '_' . rand(1000, 9999);
            $uName  = !empty($username) ? $username : strstr($email, '@', true);

            $newAdmin = [
                'hash_id'        => $hashId,
                'firstname'      => !empty($firstname) ? $firstname : 'Admin',
                'lastname'       => !empty($lastname) ? $lastname : 'User',
                'username'       => $uName,
                'input_username' => $uName,
                'email'          => $email,
                'hash'           => $hashed,
                'input_password' => $hashed,
                'verification'   => '1',
                'user_status'    => 1,
                'level'          => in_array($level, ['1', '2', '3', 'MASTER']) ? $level : '1',
                'time_created'   => date("Y-m-d H:i:s"),
                'date_created'   => date("Y-m-d H:i:s"),
            ];

            insert($conn, 'admin', $newAdmin);
            header("Location: /admin-view-admin?success=" . urlencode("Admin " . $email . " created successfully."));
            exit();
        }
    }
}

include 'includes/header.php';

$where = [];
$content = selectContent($conn, 'admin', $where);
?>

<!-- [ Header ] end -->
<div class="container">
  <div class="wrapper">
    <div class="content">
      <div class="content">
        <div class="main-body">
          <div class="page-wrapper">

            <div class="page-header">
              <div class="page-block">
                <div class="row align-items-center">
                  <div class="col-md-12">
                    <div class="page-header-title">
                      <h5>Administrator Accounts</h5>
                    </div>
                    <ul class="breadcrumb">
                      <li class="breadcrumb-item"><a href="/admin"><i class="feather icon-home"></i></a></li>
                      <li class="breadcrumb-item"><a href="#!">Manage Admins</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>

            <?php if (!empty($formError)): ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error:</strong> <?= htmlspecialchars($formError) ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <?php endif; ?>

            <?php if (!empty($formSuccess)): ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success:</strong> <?= htmlspecialchars($formSuccess) ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <?php endif; ?>

            <!-- Add Admin Form Card -->
            <div class="row mb-4">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <h5><i class="feather icon-user-plus mr-1"></i> Add New Administrator</h5>
                  </div>
                  <div class="card-body">
                    <form action="" method="post">
                      <div class="row">
                        <div class="col-md-4 mb-3">
                          <label class="form-label font-weight-bold">First Name</label>
                          <input type="text" name="firstname" class="form-control" placeholder="e.g. John" value="<?= htmlspecialchars($_POST['firstname'] ?? '') ?>">
                        </div>
                        <div class="col-md-4 mb-3">
                          <label class="form-label font-weight-bold">Last Name</label>
                          <input type="text" name="lastname" class="form-control" placeholder="e.g. Doe" value="<?= htmlspecialchars($_POST['lastname'] ?? '') ?>">
                        </div>
                        <div class="col-md-4 mb-3">
                          <label class="form-label font-weight-bold">Username</label>
                          <input type="text" name="username" class="form-control" placeholder="e.g. jdoe" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4 mb-3">
                          <label class="form-label font-weight-bold">Email Address <span class="text-danger">*</span></label>
                          <input type="email" name="email" class="form-control" placeholder="e.g. admin@hcfoundations.com" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                        </div>
                        <div class="col-md-4 mb-3">
                          <label class="form-label font-weight-bold">Password <span class="text-danger">*</span></label>
                          <input type="password" name="password" class="form-control" placeholder="••••••••••••" required>
                        </div>
                        <div class="col-md-4 mb-3">
                          <label class="form-label font-weight-bold">Role / Level</label>
                          <select name="level" class="form-control">
                            <option value="1">Level 1 — Staff</option>
                            <option value="2">Level 2 — Manager</option>
                            <option value="3">Level 3 — Administrator</option>
                            <option value="MASTER">MASTER — Superadmin</option>
                          </select>
                        </div>
                      </div>
                      <button type="submit" name="add_admin" class="btn btn-primary font-weight-bold">
                        <i class="feather icon-plus mr-1"></i> Create Administrator
                      </button>
                    </form>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <h5>Existing Administrators</h5>
                  </div>

                  <div class="card-body">
                    <div class="dt-responsive table-responsive">
                      <table id="simpletable" class="table table-striped table-bordered nowrap">
                        <thead>
                          <tr>
                            <th>Info</th>
                            <th>Role / Level</th>
                            <th>Status</th>
                            <th>Action</th>
                            <th>Date Registered</th>
                          </tr>
                        </thead>
                        <tbody>

                          <?php foreach ($content as $key => $value) {
                            $isMaster = (($value['level'] ?? '') === 'MASTER');
                            $adminName = trim(($value['firstname'] ?? '') . ' ' . ($value['lastname'] ?? ''));
                            if (empty($adminName)) {
                              $adminName = $value['username'] ?? $value['input_username'] ?? 'Admin';
                            }
                            $adminEmail = $value['email'] ?? $value['input_email'] ?? '';
                            $adminUsername = $value['username'] ?? $value['input_username'] ?? '';
                          ?>
                            <tr>
                              <td>
                                <strong>Name:</strong> <?= htmlspecialchars($adminName) ?><br>
                                <strong>Email:</strong> <?= htmlspecialchars($adminEmail) ?><br>
                                <?php if (!empty($adminUsername)): ?>
                                  <small class="text-muted">Username: <?= htmlspecialchars($adminUsername) ?></small>
                                <?php endif; ?>
                              </td>
                              <td>
                                <p class="mb-1">Level: <span class="badge badge-<?= $isMaster ? 'danger' : 'info' ?>"><?= htmlspecialchars($value['level']) ?></span></p>
                                <?php if (!$isMaster): ?>
                                  <a href="/updateContent.php?id=<?= $value['id'] ?>&level=3&data=admin"><button type="button" class="btn btn-primary btn-sm"><i class="feather icon-user"></i> 3</button></a>
                                  <a href="/updateContent.php?id=<?= $value['id'] ?>&level=2&data=admin"><button type="button" class="btn btn-success btn-sm"><i class="feather icon-user"></i> 2</button></a>
                                  <a href="/updateContent.php?id=<?= $value['id'] ?>&level=1&data=admin"><button type="button" class="btn btn-warning btn-sm"><i class="feather icon-user"></i> 1</button></a>
                                <?php else: ?>
                                  <span class="badge badge-secondary">Root (Protected)</span>
                                <?php endif; ?>
                              </td>
                              <td>
                                <p class="mb-1">Status: <?php
                                  if ((int)$value['user_status'] === 1) {
                                    echo '<span class="badge badge-success">Active</span>';
                                  } elseif ($value['user_status'] === null) {
                                    echo '<span class="badge badge-warning">Not Verified</span>';
                                  } else {
                                    echo '<span class="badge badge-danger">Suspended</span>';
                                  }
                                ?></p>
                                <?php if (!$isMaster): ?>
                                  <a href="/updateContent.php?id=<?= $value['id'] ?>&user_status=1&verification=1&data=admin"><button type="button" class="btn btn-success btn-sm"><i class="feather icon-user-check"></i> Verify</button></a>
                                  <a href="/updateContent.php?id=<?= $value['id'] ?>&user_status=2&data=admin"><button type="button" class="btn btn-danger btn-sm"><i class="feather icon-user-x"></i> Suspend</button></a>
                                <?php endif; ?>
                              </td>

                              <td>
                                <?php if (!$isMaster): ?>
                                  <a href="/deleteContent.php?id=<?= $value['id'] ?>&data=admin" onclick="return confirm('Are you sure you want to delete this administrator?');"><button type="button" class="btn btn-danger btn-sm"><i class="feather icon-trash-2"></i> Delete</button></a>
                                <?php else: ?>
                                  <span class="text-muted small">Protected</span>
                                <?php endif; ?>
                              </td>
                              <td><?= htmlspecialchars($value['date_created'] ?? '') ?></td>

                            </tr>
                          <?php } ?>
                        </tbody>
                        <tfoot>
                          <tr>
                            <th>Info</th>
                            <th>Role / Level</th>
                            <th>Status</th>
                            <th>Action</th>
                            <th>Date Registered</th>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- END OF CONTENT -->

          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Required Js -->
  <script src="/da/assets/js/vendor-all.min.js"></script>
  <script src="/da/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
  <script src="/da/assets/js/pcoded.min.js"></script>

  <!-- prism Js -->
  <script src="/da/assets/plugins/prism/js/prism.min.js"></script>
  <script src="/da/assets/js/horizontal-menu.js"></script>
  <script type="text/javascript">
  // Collapse menu
  (function() {
    if ($('#layout-sidenav').hasClass('sidenav-horizontal') || window.layoutHelpers.isSmallScreen()) {
      return;
    }
    try {
      window.layoutHelpers.setCollapsed(
        localStorage.getItem('layoutCollapsed') === 'true',
        false
      );
    } catch (e) {}
  })();
  $(function() {
    // Initialize sidenav
    $('#layout-sidenav').each(function() {
      new SideNav(this, {
        orientation: $(this).hasClass('sidenav-horizontal') ? 'horizontal' : 'vertical'
      });
    });

    // Initialize sidenav togglers
    $('body').on('click', '.layout-sidenav-toggle', function(e) {
      e.preventDefault();
      window.layoutHelpers.toggleCollapsed();
      if (!window.layoutHelpers.isSmallScreen()) {
        try {
          localStorage.setItem('layoutCollapsed', String(window.layoutHelpers.isCollapsed()));
        } catch (e) {}
      }
    });
  });
  $(document).ready(function() {
    $("#pcoded").pcodedmenu({
      MenuTrigger: 'hover',
      SubMenuTrigger: 'hover',
      themelayout: 'horizontal',
    });
  });
  </script>
  <script type="text/javascript">
  // layout types
  $('.layout-type > a').on('click', function() {
    var temp = $(this).attr('data-value');
    $('.layout-type > a').removeClass('active');
    $('.navbar').removeClassPrefix('navbar-image-');
    $(this).addClass('active');
    $('head').append('<link rel="stylesheet" class="layout-css" href="">');
    if (temp == "menu-dark") {
      $('.navbar').removeClassPrefix('menu-');
      $('.navbar').removeClass('navbar-dark');
    }
    if (temp == "menu-light") {
      $('.navbar').removeClassPrefix('menu-');
      $('.navbar').removeClass('navbar-dark');
      $('.navbar').addClass(temp);
    }
    if (temp == "reset") {
      location.reload();
    }
    if (temp == "dark") {
      $('.navbar').removeClassPrefix('menu-');
      $('.navbar').addClass('navbar-dark');
      $('.layout-css').attr("href", "/da/assets/css/layouts/dark.css");
    } else {
      $('.layout-css').attr("href", "");
    }
  });
  // Header Color
  $('.header-color > a').on('click', function() {
    var temp = $(this).attr('data-value');
    $('.header-color > a').removeClass('active');
    $(this).addClass('active');
    if (temp == "header-default") {
      $('.header').removeClassPrefix('header-');
    } else {
      $('.header').removeClassPrefix('header-');
      $('.header').addClass(temp);
    }
  });
  // rtl layouts
  $('#theme-rtl').change(function() {
    $('head').append('<link rel="stylesheet" class="rtl-css" href="">');
    if ($(this).is(":checked")) {
      $('.rtl-css').attr("href", "/da/assets/css/layouts/rtl.css");
      $('html').attr("dir", "rtl");
    } else {
      $('.rtl-css').attr("href", "");
      $('html').removeAttr("dir");
    }
  });
  // Menu Color
  $('.navbar-color > a').on('click', function() {
    var temp = $(this).attr('data-value');
    $('.navbar-color > a').removeClass('active');
    $('.navbar').addClass('brand-dark');
    $('.navbar').removeClassPrefix('menu-');
    $(this).addClass('active');
    if (temp == "navbar-default") {
      $('.navbar').removeClassPrefix('navbar-');
      $('.navbar').removeClassPrefix('brand-dark');
    } else {
      $('.navbar').removeClassPrefix('navbar-');
      $('.navbar').addClass(temp);
    }
  });
  // Active Color
  $('.active-color > a').on('click', function() {
    var temp = $(this).attr('data-value');
    $('.active-color > a').removeClass('active');
    $(this).addClass('active');
    if (temp == "active-default") {
      $('.navbar').removeClassPrefix('active-');
    } else {
      $('.navbar').removeClassPrefix('active-');
      $('.navbar').addClass(temp);
    }
  });

  // Menu Icon Color
  $('#icon-colored').change(function() {
    if ($(this).is(":checked")) {
      $('.navbar').addClass('icon-colored');
    } else {
      $('.navbar').removeClass('icon-colored');
    }
  });

  // title Color
  $('.title-color > a').on('click', function() {
    var temp = $(this).attr('data-value');
    $('.title-color > a').removeClass('active');
    $(this).addClass('active');
    if (temp == "title-default") {
      $('.navbar').removeClassPrefix('title-');
    } else {
      $('.navbar').removeClassPrefix('title-');
      $('.navbar').addClass(temp);
    }
  });
  // Menu Dropdown icon
  function drpicon(temp) {
    if (temp == "style1") {
      $('.navbar').removeClassPrefix('drp-icon-');
    } else {
      $('.navbar').removeClassPrefix('drp-icon-');
      $('.navbar').addClass('drp-icon-' + temp);
    }
  }
  // Menu subitem icon
  function menuitemicon(temp) {
    if (temp == "style1") {
      $('.navbar').removeClassPrefix('menu-item-icon-');
    } else {
      $('.navbar').removeClassPrefix('menu-item-icon-');
      $('.navbar').addClass('menu-item-icon-' + temp);
    }
  }

  $.fn.removeClassPrefix = function(prefix) {
    this.each(function(i, it) {
      var classes = it.className.split(" ").map(function(item) {
        return item.indexOf(prefix) === 0 ? "" : item;
      });
      it.className = classes.join(" ");
    });
    return this;
  };
  </script>

  <!-- modal-window-effects Js -->
  <script src="/da/assets/plugins/modal-window-effects/js/classie.js"></script>
  <script src="/da/assets/plugins/modal-window-effects/js/modalEffects.js"></script>
  <script src="/da/assets/plugins/ekko-lightbox/js/ekko-lightbox.min.js"></script>
  <script src="/da/assets/plugins/lightbox2-master/js/lightbox.min.js"></script>
  <script src="/da/assets/js/pages/ac-lightbox.js"></script>
  <!-- Tables -->
  <script src="/da/assets/plugins/data-tables/js/datatables.min.js"></script>
  <script src="/da/assets/js/pages/data-basic-custom.js"></script>
  <script type="text/javascript" src="/map/getmap.js"></script>
  <script src="/da/assets/js/analytics.js"></script>

</body>
</html>
