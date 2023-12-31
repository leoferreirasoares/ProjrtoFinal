<header id="js-header" class="u-header u-header--sticky-top">
    <div class="u-header__section u-header__section--admin-dark g-min-height-65">
      <nav class="navbar no-gutters g-pa-0">
        <div class="col-auto d-flex flex-nowrap u-header-logo-toggler g-py-12">
          <!-- Logo -->
          <a href="dashboard.php" class="navbar-brand d-flex align-self-center g-hidden-xs-down g-line-height-1 py-0 g-mt-5 g-color-white">
              TechBarber
</a>
          <!-- End Logo -->

          <!-- Sidebar Toggler -->
          <a class="js-side-nav u-header__nav-toggler d-flex align-self-center ml-auto" href="#!" data-hssm-class="u-side-nav--mini u-sidebar-navigation-v1--mini" data-hssm-body-class="u-side-nav-mini" data-hssm-is-close-all-except-this="true" data-hssm-target="#sideNav">
            <i class="hs-admin-align-left"></i>
          </a>
          <!-- End Sidebar Toggler -->
        </div>

        <!-- Messages/Notifications/Top Search Bar/Top User -->
        <div class="col-auto d-flex g-py-12 g-pl-40--lg ml-auto">
          <!-- Top Messages -->
          
          <!-- End Top Messages -->

          <!-- Top Notifications -->
          
          <!-- End Top Notifications -->

          <!-- Top Search Bar (Mobi) -->
          
          <!-- End Top Search Bar (Mobi) -->

          <!-- Top User -->
          <div class="col-auto d-flex g-pt-5 g-pt-0--sm g-pl-10 g-pl-20--sm">
            <div class="g-pos-rel g-px-10--lg">
              <a id="profileMenuInvoker" class="d-block" href="#!" aria-controls="profileMenu" aria-haspopup="true" aria-expanded="false" data-dropdown-event="click" data-dropdown-target="#profileMenu" data-dropdown-type="css-animation" data-dropdown-duration="300"
              data-dropdown-animation-in="fadeIn" data-dropdown-animation-out="fadeOut">
                
                <span class="g-pos-rel g-top-2">
        <span class="g-hidden-sm-down"><?=$_SESSION['nome']?></span>
                <i class="hs-admin-angle-down g-pos-rel g-top-2 g-ml-10"></i>
                </span>
              </a>

              <!-- Top User Menu -->
              <ul id="profileMenu" class="g-pos-abs g-left-0 g-width-100x--lg g-nowrap g-font-size-14 g-py-20 g-mt-17 rounded" aria-labelledby="profileMenuInvoker">
               <li class="mb-0">
                   <a class="media g-color-lightred-v2--hover g-py-5 g-px-20" href="logout.php">
                    <span class="d-flex align-self-center g-mr-12">
                        <i class="hs-admin-shift-right"></i>
                    </span>
                    <span class="media-body align-self-center">Sair</span>
                  </a>
                </li>
              </ul>
              <!-- End Top User Menu -->
            </div>
          </div>
          <!-- End Top User -->
        </div>
        <!-- End Messages/Notifications/Top Search Bar/Top User -->

        <!-- End Top Activity Toggler -->
      </nav>

    </div>
  </header>

