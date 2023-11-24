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
            <h1 class="g-font-weight-600 g-font-size-28 g-color-black g-mb-28">Comissões</h1>
            <div class="row">
                <div class="col-xl-12">
                    <div class="js-custom-scroll g-height-500 g-pa-15 g-pa-0-30-25--md">
                        <form class="g-brd-around g-brd-gray-light-v4 g-pa-30 g-mb-30" id="formComissoes">
                            <div class="row">
                                <input type="hidden" name="metodo" value="comissoes">
                                <div class="col-md-6 col-sm-12">                                    
                                    <div class="form-group g-mb-30">
                                        <label class="g-mb-10">Data</label>
                                        <input id="dataComissao" class="form-control obrigatorio" name="data" type="date">
                                          
                                    </div>

                                </div>
                                <div class="col-md-6 col-sm-12">    
                                    <div class="form-group row g-mb-25">
                                        <label class="col-form-label" for="profissionais">Profissional</label>
                                        <select class="custom-select mb-3 obrigatorio" id="profissionais" name="idUsuario"  onchange="buscaHorarioDisponivel()">
                                        </select>
                                    </div>
                                </div>
                            </div>                           
                            <button type="button" class="btn btn-md u-btn-primary rounded-0" onclick="calculaComissoes">Calcular</button>
                        </form>
                    </div>
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
  <script src="../assets/js/components/hs.count-qty.js"></script>
  <script src="./assets/js/helpers/hs.focus-state.js"></script>
  <script src="./assets/js/funcoes.js"></script>
  <!-- JS Custom -->
  <script src="./assets/js/custom.js"></script>

  <!-- JS Plugins Init. -->
  <script>
    $(document).on('ready', function () {
      // initialization of custom select
      $('.js-select').selectpicker();
      
      // initialization of range datepicker
      $.HSCore.components.HSRangeDatepicker.init('.js-range-datepicker');
      // initialization of sidebar navigation component
      $.HSCore.components.HSSideNav.init('.js-side-nav');
  
      // initialization of hamburger
      $.HSCore.helpers.HSHamburgers.init('.hamburger');
  
      // initialization of HSDropdown component
      $.HSCore.components.HSDropdown.init($('[data-dropdown-target]'), {
        dropdownHideOnScroll: false
      });
  
      // initialization of custom scrollbar
      $.HSCore.components.HSScrollBar.init($('.js-custom-scroll'));
  
      // initialization of forms
      $.HSCore.components.HSCountQty.init('.js-quantity');
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
