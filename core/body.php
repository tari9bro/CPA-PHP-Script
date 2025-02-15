 <!--loading="lazy"-->
                  
                  <!-- body.php -->
<main class="page-content framework7-root">
    <div class="page-inner white-bg">
        <div id="main-wrapper">
            <div class="row">
                <div class="col-md-6 col-xs-12 col-sm-12 center">
                    <div class="main-page-title">
                        <img src="https://blogger.googleusercontent.com/img/a/AVvXsEiXk47PkxUWrKdP-HHsiPqineKH7wE_z3EJgWlx-PJNVcztlfwFHlBiWkarb1UDn2pXNkppAZlSZRl4Pyyw-nhVzWNorSAUxf5AFdRhyFLZj2M0ToeFHXCZwE8EyQS2xoTtdbqGI7RK_5HFBn6rPOW1Crxia9ZQTGdAQJ1G1CDJiK0xg47nMd8JfIWcCA=s450"
                            class="app-navbar-head-logo center breathing" loading="lazy">
                    </div>

                    <!-- Search Bar -->
                    <div class="search-container">
                        <input type="text" name="search" id="searchBar" class="form-control" placeholder="Search for apps..." value="<?= htmlspecialchars($searchQuery) ?>">
                    </div>
                    <br>
                    
                    <div class="app-box appscloud-block" id="appResults">
                        <?php if (empty($apps)): ?>
                            <p>No apps found matching your search.</p>
                        <?php else: ?>
                            <?php foreach ($apps as $app): ?>
                                <div class="col-md-12 app-list-md">
                                    <div class="app-box">
                                        <img class="img-responsive ios-icon app-icon" src="<?= htmlspecialchars($app['icon_url']) ?>loading="lazy"">
                                        <div class="app-info">
                                            <div class="app-name"><?= htmlspecialchars($app['app_name']) ?></div>
                                            <p class="app-version" style="font-size: 10px"><?= htmlspecialchars($app['platform']) ?></p>
                                        </div>
                                        <a href="javascript:void(0);" 
                                           onclick="install('<?= htmlspecialchars($app['icon_url']) ?>', '<?= htmlspecialchars($app['app_name']) ?>', '<?= htmlspecialchars($app['download_url']) ?>')"
                                           class="btn btn-success btn-xs btn-install">
                                            <span class="install-btn-text"><b>download</b></span>
                                        </a>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div><!-- Main Wrapper -->
                </div><!-- Page Inner -->
            </div>
        </div>
    </div>

    <!-- Install Popup Modal -->
    <div class="popup modal-in" id="install" style="background: #fff; display: none;">
        <div class="fake-homescreen">
            <a id="close" class="close-button"></a>
            <div class="iphone-display" aria-hidden="true">
                <div class="app-icon-area">
                    <div class="app-icon-region">
                        <img id="app_icon" alt="app icon" src="#" class="app-modal-icon" style="width: 33px; height: 33px;">
                    </div>
                    <div class="fake-homescreen-app-name" style="font-size:7.5px!important">
                        <span id="app_name" class="installingAppName"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="block" style="color:#000000">
            <center>
                <div>
                    <div class="app-caption">
                        <h2 id="app-caption-title">title</h2>
                        <p>Follow the steps after install </p>
                    </div>
                    <hr>
                    <div class="details">
                        <a id="install_btn" class="btn btn-info btn-block install-btn" href="#" >install</a>
                         <br>
                        <p>Free </p>
                    </div>
                </div>
            </center>
        </div>
    </div>
</main><!-- Page Content -->
