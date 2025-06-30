<?php

// conexion a la base de datos
include_once '../../back-end/conexion/conexion.php';

// session start para poder usar variables de session
session_start();

// si el id o el name no estan precentes no cargara la vista y redirigira de nuevo al producto a el inicio de sesion
if (!isset($_SESSION['id']) || !isset($_SESSION['name'])) {
  echo "<meta http-equiv='refresh' content='0; url=index.php?alert=1'>";
} else {

  require_once '../../back-end/funciones/contarDatos.php';

?>

  <!DOCTYPE html>
  <html lang="en" class="has-aside-left has-aside-mobile-transition has-navbar-fixed-top has-aside-expanded">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets//css//alertas.css">
    <link rel="stylesheet" href="../assets/css/vistaDeUsuarios.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <title>Inventario</title>

    <!-- Bulma is included -->
    <link rel="stylesheet" href="../assets/css/main.min.css">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
  </head>

  <body>
    <div id="app">
      <?php include_once '../components/alerts.php'?>
      <!-- Inicio de NavBar -->
      <?php require_once '../components/nav.php' ?>
      <!-- Final de NavBar -->
      <!-- Inicio Aside -->
      <?php require_once '../components/aside.php' ?>
      <!-- Final Aside -->
      <section class="section is-title-bar">
        <div class="level">
          <div class="level-left">
            <div class="level-item">
              <ul>
                <li>Admin</li>
                <li>Dashboard</li>
              </ul>
            </div>
          </div>
          <div class="level-right">
            <div class="level-item">
              <div class="buttons is-right">
                <a href="newProduct.php" class="button is-primary">
                  <span class="icon"><i class="mdi mdi-plus"></i></span>
                  <span>Agregar producto</span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="hero is-hero-bar">
        <div class="hero-body">
          <div class="level">
            <div class="level-left">
              <div class="level-item">
                <h1 class="title">
                  Dashboard
                </h1>
              </div>
            </div>
            <div class="level-right" style="display: none;">
              <div class="level-item"></div>
            </div>
          </div>
        </div>
      </section>
      <section class="section is-main-section">
        <div class="tile is-ancestor">
          <div class="tile is-parent">
            <div class="card tile is-child">
              <div class="card-content">
                <div class="level is-mobile">
                  <div class="level-item">
                    <div class="is-widget-label">
                      <h3 class="subtitle is-spaced">
                        Usuarios
                      </h3>
                      <h1 class="title">
                        <?php echo $total_usuarios ?>
                      </h1>
                    </div>
                  </div>
                  <div class="level-item has-widget-icon">
                    <div class="is-widget-icon"><span class="icon has-text-primary is-large"><i
                          class="mdi mdi-account-multiple mdi-48px"></i></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div style="cursor: pointer;" class="tile is-parent" onclick="verProductos()">
            <div class="card tile is-child">
              <div class="card-content">
                <div class="level is-mobile">
                  <div class="level-item">
                    <div class="is-widget-label">
                      <h3 class="subtitle is-spaced">
                        Productos
                      </h3>
                      <h1 class="title">
                        <?php echo $total_productos ?>
                      </h1>
                    </div>
                  </div>
                  <div class="level-item has-widget-icon">
                    <div class="is-widget-icon"><span class="icon has-text-info is-large"><i
                          class="mdi mdi-cart-outline mdi-48px"></i></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="tile is-parent">
            <div class="card tile is-child">
              <div class="card-content">
                <div class="level is-mobile">
                  <div class="level-item">
                    <div class="is-widget-label">
                      <h3 class="subtitle is-spaced">
                        Facturas Generadas
                      </h3>
                      <h1 class="title">
                        <?php echo $total_facturas ?>
                      </h1>
                    </div>
                  </div>
                  <div class="level-item has-widget-icon">
                    <div class="is-widget-icon"><span class="icon has-text-success is-large"><i
                          class="mdi mdi-finance mdi-48px"></i></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
       

      </section>
      <!-- Inicio footer -->
      <?php require '../components/footer.php' ?>
      <!-- Final Footer -->
    </div>

    <div id="sample-modal" class="modal">
      <div class="modal-background jb-modal-close"></div>
      <div class="modal-card">
        <header class="modal-card-head">
          <p class="modal-card-title">Confirm action</p>
          <button class="delete jb-modal-close" aria-label="close"></button>
        </header>
        <section class="modal-card-body">
          <p>This will permanently delete <b>Some Object</b></p>
          <p>This is sample modal</p>
        </section>
        <footer class="modal-card-foot">
          <button class="button jb-modal-close">Cancel</button>
          <button class="button is-danger jb-modal-close">Delete</button>
        </footer>
      </div>
      <button class="modal-close is-large jb-modal-close" aria-label="close"></button>
    </div>

    <!-- Scripts below are for demo only -->
    <script src="../assets/js/jquery-3.6.0.js"></script>
    <script type="text/javascript" src="../assets/js/main.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
    <script type="text/javascript" src="../assets/js/cndDatatable.js"></script>
    <script src="../assets/js/datatableModel.js"></script>

    <!-- Icons below are for demo only. Feel free to use any icon pack. Docs: https://bulma.io/documentation/elements/icon/ -->
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">
    <script>
      function verProductos() {
        document.location.href = "productos.php"
      }
    </script>
  </body>

  </html>
<?php
}
?>