<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Kapella Bootstrap Admin Dashboard Template</title>
    <!-- base:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/base/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_horizontal-navbar.html -->
        <div class="horizontal-menu">
            <nav class="navbar top-navbar col-lg-12 col-12 p-0">
                <div class="container-fluid">
                    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between">
                        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                            <a class="navbar-brand brand-logo" href="index.html"><img src="assets/images/logo.svg"
                                    alt="logo" /></a>
                            <a class="navbar-brand brand-logo-mini" href="index.html"><img
                                    src="assets/images/logo-mini.svg" alt="logo" /></a>
                        </div>
                        <ul class="navbar-nav navbar-nav-right">
                            <li class="nav-item dropdown  d-lg-flex d-none">
                                <button type="button" class="btn btn-inverse-primary btn-sm">Product </button>
                            </li>
                            <li class="nav-item dropdown d-lg-flex d-none">
                                <a class="dropdown-toggle show-dropdown-arrow btn btn-inverse-primary btn-sm"
                                    id="nreportDropdown" href="#" data-toggle="dropdown">
                                    Reports
                                </a>
                                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                                    aria-labelledby="nreportDropdown">
                                    <p class="mb-0 font-weight-medium float-left dropdown-header">Reports</p>
                                    <a class="dropdown-item">
                                        <i class="mdi mdi-file-pdf text-primary"></i>
                                        Pdf
                                    </a>
                                    <a class="dropdown-item">
                                        <i class="mdi mdi-file-excel text-primary"></i>
                                        Exel
                                    </a>
                                </div>
                            </li>
                            <li class="nav-item dropdown d-lg-flex d-none">
                                <button type="button" class="btn btn-inverse-primary btn-sm">Settings</button>
                            </li>
                            <li class="nav-item nav-profile dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown"
                                    id="profileDropdown">
                                    <span class="nav-profile-name">Johnson</span>
                                    <span class="online-status"></span>
                                    <img src="assets/images/faces/face28.png" alt="profile" />
                                </a>
                                <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                                    aria-labelledby="profileDropdown">
                                    <a class="dropdown-item">
                                        <i class="mdi mdi-settings text-primary"></i>
                                        Settings
                                    </a>
                                    <a class="dropdown-item">
                                        <i class="mdi mdi-logout text-primary"></i>
                                        Logout
                                    </a>
                                </div>
                            </li>
                        </ul>
                        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                            data-toggle="horizontal-menu-toggle">
                            <span class="mdi mdi-menu"></span>
                        </button>
                    </div>
                </div>
            </nav>
            <?=view('template/menu')?>
        </div>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-sm-6 mb-4 mb-xl-0">
                            <div class="d-lg-flex align-items-center">
                                <div>
                                    <h3 class="text-dark font-weight-bold mb-2">Dashboard</h3>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-sm-6">
                            <div class="d-flex align-items-center justify-content-md-end">
                                <div class="pr-1 mb-3 mb-xl-0">
                                    <button type="button" class="btn btn-outline-inverse-info btn-icon-text">
                                        Feedback
                                        <i class="mdi mdi-message-outline btn-icon-append"></i>
                                    </button>
                                </div>
                                <div class="pr-1 mb-3 mb-xl-0">
                                    <button type="button" class="btn btn-outline-inverse-info btn-icon-text">
                                        Help
                                        <i class="mdi mdi-help-circle-outline btn-icon-append"></i>
                                    </button>
                                </div>
                                <div class="pr-1 mb-3 mb-xl-0">
                                    <button type="button" class="btn btn-outline-inverse-info btn-icon-text">
                                        Print
                                        <i class="mdi mdi-printer btn-icon-append"></i>
                                    </button>
                                </div>
                            </div>
                        </div> -->
                    </div>
                    <div class="row mt-4">
                        <div class="col-lg-12 stretch-card">
                            <?=$this->renderSection('content')?>
                        </div>
                    </div>
                </div>

                <footer class="footer">
                    <div class="footer-wrap">
                        <div class="d-sm-flex justify-content-center justify-content-sm-between">
                            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright ©
                                bootstrapdash.com 2020</span>
                            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a
                                    href="https://www.bootstrapdash.com/" target="_blank">Bootstrap dashboard
                                    templates</a> from Bootstrapdash.com</span>
                        </div>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- base:js -->
    <script src="assets/vendors/base/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="assets/js/template.js"></script>
    <!-- endinject -->
    <!-- plugin js for this page -->
    <!-- End plugin js for this page -->
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <script src="assets/vendors/progressbar.js/progressbar.min.js"></script>
    <script src="assets/vendors/chartjs-plugin-datalabels/chartjs-plugin-datalabels.js"></script>
    <script src="assets/vendors/justgage/raphael-2.1.4.min.js"></script>
    <script src="assets/vendors/justgage/justgage.js"></script>
    <!-- Custom js for this page-->
    <script src="assets/js/dashboard.js"></script>
    <!-- End custom js for this page-->
</body>

</html>