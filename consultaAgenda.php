<?php
session_start();
if (isset($_SESSION['id']) and  $_SESSION['id'] > 0){ ?>
<!DOCTYPE html>
<html lang="pt">
<head>
  <?php include_once './header.php';?>
</head>

<body>
  <!-- Header -->
  <?php include_once './menuHeader.php'; ?>
  <!-- End Header -->
  <main class="container-fluid px-0 g-pt-65">
    <div class="row no-gutters g-pos-rel g-overflow-x-hidden">
      <!-- Sidebar Nav -->
      <?php include_once './menu.php'; ?>
      <!-- End Sidebar Nav -->
      <div class="col g-ml-45 g-ml-0--lg g-pb-65--md">
        <div class="g-pa-20">
            <div class="row">
                <div class="col-xl-12">

                  <!-- Income Cards -->
                    <div class="card g-brd-gray-light-v7 g-mb-30">
                        <div class="js-custom-scroll g-height-500 g-pa-15 g-pa-0-30-25--md">
                            <table class="table table-responsive-sm w-100">
                                <thead>
                                    <tr>                                        
                                        <th class="g-font-weight-600 g-color-gray-dark-v6 g-brd-top-none">Data</th>
                                        <th class="g-font-weight-600 g-color-gray-dark-v6 g-brd-top-none">Hora Inicio</th>
                                        <th class="g-font-weight-600 g-color-gray-dark-v6 g-brd-top-none">Hora Fim</th>
                                        <th class="g-font-weight-600 g-color-gray-dark-v6 g-brd-top-none">Barbeiro</th>
                                        <th class="g-font-weight-600 g-color-gray-dark-v6 g-brd-top-none">Cliente</th>
                                        <th class="g-font-weight-600 g-color-gray-dark-v6 g-brd-top-none">Serviço</th>
                                        <th class="g-font-weight-600 g-color-gray-dark-v6 g-brd-top-none">Preço</th>
                                        <th class="g-font-weight-600 g-color-gray-dark-v6 g-brd-top-none">#</th>
                                    </tr>
                                </thead>
                              <tbody id="agendamentos"></tbody>
                            </table>
                        </div>
                    </div>
                  <!-- End Income Cards -->
                </div>
            </div>
        </div>

        <!-- Footer -->
        <?php include_once './footer.php'; ?>
        <!-- End Footer -->
      </div>
    </div>
  </main>

  <!-- JS Global Compulsory -->
  <script src="./assets/vendor/jquery/jquery.min.js"></script>
  <script src="./assets/vendor/jquery-migrate/jquery-migrate.min.js"></script>

  <script src="./assets/vendor/popper.min.js"></script>
  <script src="./assets/vendor/bootstrap/bootstrap.min.js"></script>

  <script src="./assets/vendor/cookiejs/jquery.cookie.js"></script>


  <!-- jQuery UI Core -->
  <script src="./assets/vendor/jquery-ui/ui/widget.js"></script>
  <script src="./assets/vendor/jquery-ui/ui/version.js"></script>
  <script src="./assets/vendor/jquery-ui/ui/keycode.js"></script>
  <script src="./assets/vendor/jquery-ui/ui/position.js"></script>
  <script src="./assets/vendor/jquery-ui/ui/unique-id.js"></script>
  <script src="./assets/vendor/jquery-ui/ui/safe-active-element.js"></script>

  <!-- jQuery UI Helpers -->
  <script src="./assets/vendor/jquery-ui/ui/widgets/menu.js"></script>
  <script src="./assets/vendor/jquery-ui/ui/widgets/mouse.js"></script>

  <!-- jQuery UI Widgets -->
  <script src="./assets/vendor/jquery-ui/ui/widgets/datepicker.js"></script>

  <!-- JS Plugins Init. -->
  <script src="./assets/vendor/appear.js"></script>
  <script src="./assets/vendor/bootstrap-select/js/bootstrap-select.min.js"></script>
  <script src="./assets/vendor/flatpickr/dist/js/flatpickr.min.js"></script>
  <script src="./assets/vendor/malihu-scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
  <script src="./assets/vendor/chartist-js/chartist.min.js"></script>
  <script src="./assets/vendor/chartist-js-tooltip/chartist-plugin-tooltip.js"></script>
  <script src="./assets/vendor/fancybox/jquery.fancybox.min.js"></script>

  <!-- JS Unify -->
  <script src="./assets/js/hs.core.js"></script>
  <script src="./assets/js/components/hs.side-nav.js"></script>
  <script src="./assets/js/helpers/hs.hamburgers.js"></script>
  <script src="./assets/js/components/hs.range-datepicker.js"></script>
  <script src="./assets/js/components/hs.datepicker.js"></script>
  <script src="./assets/js/components/hs.dropdown.js"></script>
  <script src="./assets/js/components/hs.scrollbar.js"></script>
  <script src="./assets/js/components/hs.area-chart.js"></script>
  <script src="./assets/js/components/hs.donut-chart.js"></script>
  <script src="./assets/js/components/hs.bar-chart.js"></script>
  <script src="./assets/js/helpers/hs.focus-state.js"></script>
  <script src="./assets/js/components/hs.popup.js"></script>
  <script src="./assets/js/funcoes.js"></script>
  <!-- JS Custom -->
  <script src="./assets/js/custom.js"></script>

  <!-- JS Plugins Init. -->
  <script>
    $(document).on('ready', function () {
      // initialization of custom select
      $('.js-select').selectpicker();
  
      // initialization of hamburger
      $.HSCore.helpers.HSHamburgers.init('.hamburger');
  
      // initialization of charts
      $.HSCore.components.HSAreaChart.init('.js-area-chart');
      $.HSCore.components.HSDonutChart.init('.js-donut-chart');
      $.HSCore.components.HSBarChart.init('.js-bar-chart');
  
      // initialization of sidebar navigation component
      $.HSCore.components.HSSideNav.init('.js-side-nav', {
        afterOpen: function() {
          setTimeout(function() {
            $.HSCore.components.HSAreaChart.init('.js-area-chart');
            $.HSCore.components.HSDonutChart.init('.js-donut-chart');
            $.HSCore.components.HSBarChart.init('.js-bar-chart');
          }, 400);
        },
        afterClose: function() {
          setTimeout(function() {
            $.HSCore.components.HSAreaChart.init('.js-area-chart');
            $.HSCore.components.HSDonutChart.init('.js-donut-chart');
            $.HSCore.components.HSBarChart.init('.js-bar-chart');
          }, 400);
        }
      });
  
      // initialization of range datepicker
      $.HSCore.components.HSRangeDatepicker.init('#rangeDatepicker, #rangeDatepicker2, #rangeDatepicker3');
  
      // initialization of datepicker
      $.HSCore.components.HSDatepicker.init('#datepicker', {
        dayNamesMin: [
          'SU',
          'MO',
          'TU',
          'WE',
          'TH',
          'FR',
          'SA'
        ]
      });
  
      // initialization of HSDropdown component
      $.HSCore.components.HSDropdown.init($('[data-dropdown-target]'), {dropdownHideOnScroll: false});
  
      // initialization of custom scrollbar
      $.HSCore.components.HSScrollBar.init($('.js-custom-scroll'));
  
      // initialization of popups
      $.HSCore.components.HSPopup.init('.js-fancybox', {
        btnTpl: {
          smallBtn: '<button data-fancybox-close class="btn g-pos-abs g-top-25 g-right-30 g-line-height-1 g-bg-transparent g-font-size-16 g-color-gray-light-v3 g-brd-none p-0" title=""><i class="hs-admin-close"></i></button>'
        }
      });
    buscaAgendamento();
});
      
  </script>
</body>

</html>
<?php 
}else{
    session_unset();
    session_destroy();
    echo "<script langauge:'javascript' >
               window.alert('Você precisa estar logado para ecessar essa página.');
       window.location = 'index.php';
       </script>"; 
} ?>