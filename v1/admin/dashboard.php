<?php
ob_start();
$level_check = ['MASTER', 3, 2, 1];

// Used to trigger modern admin styles in header
$stranger = true;
include APP_PATH . "/admin/includes/header.php";

// Counts for overview cards
$countInitiatives = count(selectContent($conn, "panel_initiatives", []));
$countBlog        = count(selectContent($conn, "panel_blog", []));
$countGallery     = count(selectContent($conn, "panel_gallery", []));
$countTeam        = count(selectContent($conn, "panel_team", []));
$countFaqs        = count(selectContent($conn, "panel_faqs", []));
$countPartners    = count(selectContent($conn, "panel_partners", []));
$countAdmins      = count(selectContent($conn, "admin", []));
$siteInfo         = selectContent($conn, "settings_website_info", []);
$siteName         = $siteInfo[0]['input_name'] ?? 'Hathany Cosmos Foundation';
?>

<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <div class="pcoded-content">
            <div class="pcoded-inner-content">
                
                <div class="page-header">
                    <div class="page-block">
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <div class="page-header-title">
                                    <h4 class="m-b-10">Admin Data Management Console</h4>
                                </div>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/admin"><i class="feather icon-home"></i></a></li>
                                    <li class="breadcrumb-item"><a href="#!">Dashboard</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="main-body">
                    <div class="page-wrapper">
                        
                        <!-- Welcome Banner -->
                        <div class="row mb-4">
                            <div class="col-sm-12">
                                <div class="card" style="background: linear-gradient(135deg, #1c7c9c 0%, #0d3b4c 100%); color: white; border-radius: 1rem;">
                                    <div class="card-body p-4">
                                        <div class="row align-items-center">
                                            <div class="col-md-8">
                                                <h3 class="text-white font-weight-bold">Welcome to <?= htmlspecialchars($siteName) ?> CMS</h3>
                                                <p class="text-white-50 mb-0">Manage all website content, initiatives, blog articles, gallery photography, team members, and foundation settings directly.</p>
                                            </div>
                                            <div class="col-md-4 text-md-right mt-3 mt-md-0">
                                                <a href="/" target="_blank" class="btn btn-light font-weight-bold" style="border-radius: 0.5rem;">
                                                    <i class="feather icon-external-link mr-1"></i> View Live Site
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Statistics Grid -->
                        <div class="row">
                            
                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-8">
                                                <h4 class="text-c-blue"><?= $countInitiatives ?></h4>
                                                <h6 class="text-muted m-b-0">Initiatives</h6>
                                            </div>
                                            <div class="col-4 text-right">
                                                <i class="feather icon-target f-28 text-c-blue"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer bg-c-blue p-2 text-center">
                                        <a href="/manage/initiatives" class="text-white small">Manage Initiatives &rarr;</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-8">
                                                <h4 class="text-c-green"><?= $countBlog ?></h4>
                                                <h6 class="text-muted m-b-0">Blog Posts</h6>
                                            </div>
                                            <div class="col-4 text-right">
                                                <i class="feather icon-file-text f-28 text-c-green"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer bg-c-green p-2 text-center">
                                        <a href="/manage/blog" class="text-white small">Manage Blog &rarr;</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-8">
                                                <h4 class="text-c-yellow"><?= $countGallery ?></h4>
                                                <h6 class="text-muted m-b-0">Gallery Items</h6>
                                            </div>
                                            <div class="col-4 text-right">
                                                <i class="feather icon-image f-28 text-c-yellow"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer bg-c-yellow p-2 text-center">
                                        <a href="/manage/gallery" class="text-white small">Manage Gallery &rarr;</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-8">
                                                <h4 class="text-c-red"><?= $countTeam ?></h4>
                                                <h6 class="text-muted m-b-0">Team Members</h6>
                                            </div>
                                            <div class="col-4 text-right">
                                                <i class="feather icon-users f-28 text-c-red"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer bg-c-red p-2 text-center">
                                        <a href="/manage/team" class="text-white small">Manage Team &rarr;</a>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Content Sections Navigation -->
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Content Management Shortcuts</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3 col-sm-6 mb-3">
                                                <div class="border rounded p-3 text-center">
                                                    <i class="feather icon-compass f-24 text-c-blue mb-2 d-block"></i>
                                                    <h6>Initiatives</h6>
                                                    <a href="/add/initiatives" class="btn btn-outline-primary btn-sm mr-1">Add</a>
                                                    <a href="/manage/initiatives" class="btn btn-primary btn-sm">Manage</a>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-6 mb-3">
                                                <div class="border rounded p-3 text-center">
                                                    <i class="feather icon-book-open f-24 text-c-green mb-2 d-block"></i>
                                                    <h6>Blog Articles</h6>
                                                    <a href="/add/blog" class="btn btn-outline-success btn-sm mr-1">Add</a>
                                                    <a href="/manage/blog" class="btn btn-success btn-sm">Manage</a>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-6 mb-3">
                                                <div class="border rounded p-3 text-center">
                                                    <i class="feather icon-camera f-24 text-c-yellow mb-2 d-block"></i>
                                                    <h6>Gallery</h6>
                                                    <a href="/add/gallery" class="btn btn-outline-warning btn-sm mr-1">Add</a>
                                                    <a href="/manage/gallery" class="btn btn-warning btn-sm">Manage</a>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-6 mb-3">
                                                <div class="border rounded p-3 text-center">
                                                    <i class="feather icon-user-check f-24 text-c-red mb-2 d-block"></i>
                                                    <h6>Team</h6>
                                                    <a href="/add/team" class="btn btn-outline-danger btn-sm mr-1">Add</a>
                                                    <a href="/manage/team" class="btn btn-danger btn-sm">Manage</a>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-6 mb-3">
                                                <div class="border rounded p-3 text-center">
                                                    <i class="feather icon-activity f-24 text-c-blue mb-2 d-block"></i>
                                                    <h6>Impact Stats</h6>
                                                    <a href="/add/impact_stats" class="btn btn-outline-primary btn-sm mr-1">Add</a>
                                                    <a href="/manage/impact_stats" class="btn btn-primary btn-sm">Manage</a>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-6 mb-3">
                                                <div class="border rounded p-3 text-center">
                                                    <i class="feather icon-heart f-24 text-c-green mb-2 d-block"></i>
                                                    <h6>Core Values</h6>
                                                    <a href="/add/core_values" class="btn btn-outline-success btn-sm mr-1">Add</a>
                                                    <a href="/manage/core_values" class="btn btn-success btn-sm">Manage</a>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-6 mb-3">
                                                <div class="border rounded p-3 text-center">
                                                    <i class="feather icon-help-circle f-24 text-c-yellow mb-2 d-block"></i>
                                                    <h6>FAQs</h6>
                                                    <a href="/add/faqs" class="btn btn-outline-warning btn-sm mr-1">Add</a>
                                                    <a href="/manage/faqs" class="btn btn-warning btn-sm">Manage</a>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-6 mb-3">
                                                <div class="border rounded p-3 text-center">
                                                    <i class="feather icon-briefcase f-24 text-c-red mb-2 d-block"></i>
                                                    <h6>Partners</h6>
                                                    <a href="/add/partners" class="btn btn-outline-danger btn-sm mr-1">Add</a>
                                                    <a href="/manage/partners" class="btn btn-danger btn-sm">Manage</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script src="/da/assets/js/vendor-all.min.js"></script>
<script src="/da/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="/da/assets/js/pcoded.min.js"></script>
</body>
</html>
