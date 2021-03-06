<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Profile - X-Analytics</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css?h=715ee84282ef74aa97d50e75981ca95b">
    <link rel="manifest" href="manifest.json?h=3a3dfa5f960c51ab237f2071e4bd9d71">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css?h=2c0fc24b3d3038317dc51c05339856d0">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css?h=2c0fc24b3d3038317dc51c05339856d0">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css?h=2c0fc24b3d3038317dc51c05339856d0">
</head>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
            <div class="container-fluid d-flex flex-column p-0">
                <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon rotate-n-15"><i class="fa fa-certificate"></i></div>
                    <div class="sidebar-brand-text mx-3"><span>X-Analytics</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="nav navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item" role="presentation"><a class="nav-link" href="index.html"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="profile.html"><i class="fas fa-user"></i><span>Profile</span></a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="login.html"><i class="far fa-user-circle"></i><span>Login</span></a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="Add.html"><i class="fas fa-window-maximize"></i><span>Hinzufügen</span></a></li>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle mr-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <ul class="nav navbar-nav flex-nowrap ml-auto">
                            <div class="d-none d-sm-block topbar-divider"></div>
                            <li class="nav-item dropdown no-arrow" role="presentation">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><span class="d-none d-lg-inline mr-2 text-gray-600 small">Valerie Luna</span><img class="border rounded-circle img-profile" src="assets/img/avatars/avatar1.jpeg?h=0ecc82101fb9a10ca459432faa8c0656"></a>
                                    <div
                                        class="dropdown-menu shadow dropdown-menu-right animated--grow-in" role="menu"><a class="dropdown-item" role="presentation" href="#"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Profile</a><a class="dropdown-item" role="presentation" href="#"><i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Settings</a>
                                        <a
                                            class="dropdown-item" role="presentation" href="#"><i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Activity log</a>
                                            <div class="dropdown-divider"></div><a class="dropdown-item" role="presentation" href="#"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Logout</a></div>
                    </div>
                    </li>
                    </ul>
            </div>
            </nav>
            <div class="container-fluid">
                <h3 class="text-dark mb-4">Profile</h3>
                <div class="row mb-3">
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col">
                                <div class="card shadow mb-3">
                                    <div class="card-header py-3">
                                        <p class="text-primary m-0 font-weight-bold">User Settings</p>
                                    </div>
                                    <div class="card-body">
                                        <form action="profile_Form.php" method="post">
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group">
														<label for="username"><strong>Username</strong></label>
														<input class="form-control" type="text" value="<? $nutzerVW->get_username_by_id($_SESSION['ID_USER'])?>" name="username">
													</div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
														<label for="email"><strong>Email Address</strong></label>
														<input class="form-control" type="email" value="<? echo $nutzerVW->get_email_byID($_SESSION['ID_USER'])?>" name="email">
													</div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group">
														<label for="name"><strong>Name</strong></label>
														<input class="form-control" type="text" value="<? $nutzerVW->get_name_by_id($_SESSION['ID_USER'])?>" name="name">
													</div>
                                                </div>
                                            </div>
											<div hidden>
												<input type="checkbox" value="True" name="changeUser" checked>
											</div>
                                            <div class="form-group"><button class="btn btn-primary btn-sm" type="submit">Save Settings</button></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <h1>Webseite</h1>
						<?php foreach($productVW->get_all_Page($_SESSION['ID_USER])['URL'] as $URL){ ?>
							<form action="profile_Form.php" method="post">
								<div class="form-group">
									<div class="form-row">
										<div class="col">
											<input class="form-control" type="url" name="URL" placeholder=<? echo $URL ?>>
											<div hidden>
												<input type="checkbox" value="True" name="changeWebseite" checked>
												<input type="checkbox" value="<? echo $URL ?>" name="oldURL" checked>
											</div>
										</div>
									</div>
								</div>
								<button class="btn btn-primary" type="submit">Save Webseite</button></div>
							</form>
						<? } ?>
                </div>
                <div class="card shadow mb-5"></div>
            </div>
        </div>
        <footer class="bg-white sticky-footer">
            <div class="container my-auto">
                <div class="text-center my-auto copyright"><span>Copyright © X-Analytics 2020</span></div>
            </div>
        </footer>
    </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a></div>
    <script src="assets/js/jquery.min.js?h=83e266cb1712b47c265f77a8f9e18451"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js?h=7c038681746a729e2fff9520a575e78c"></script>
    <script src="assets/js/chart.min.js?h=2c0fc24b3d3038317dc51c05339856d0"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/script.min.js?h=b86d882c5039df370319ea6ca19e5689"></script>
</body>

</html>