<?php

include_once '../../back-end/conexion/conexion.php';

session_start();


if (!isset($_SESSION['id']) || !isset($_SESSION['name']) || $_SESSION['rol'] != 1) {
  echo "<meta http-equiv='refresh' content='0; url=index.php?alert=1'>";
} else {

?>


  <!DOCTYPE html>
  <html lang="en" class="has-aside-left has-aside-mobile-transition has-navbar-fixed-top has-aside-expanded">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inventario</title>

    <!-- Bulma is included -->
    <link rel="stylesheet" href="../assets/css/main.min.css">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
  </head>

  <body>
    <div id="app">
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
                <li>Forms</li>
              </ul>
            </div>
          </div>
          <!-- <div class="level-right">
            <div class="level-item">
              <div class="buttons is-right">
                <a href="https://github.com/vikdiesel/admin-one-bulma-dashboard" target="_blank" class="button is-primary">
                  <span class="icon"><i class="mdi mdi-github-circle"></i></span>
                  <span>GitHub</span>
                </a>
              </div>
            </div>
          </div> -->
        </div>
      </section>
      <section class="hero is-hero-bar">
        <div class="hero-body">
          <div class="level">
            <div class="level-left">
              <div class="level-item">
                <h1 class="title">
                  Forms
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
        <div class="card">
          <header class="card-header">
            <p class="card-header-title">
              <span class="icon"><i class="mdi mdi-ballot"></i></span>
              Forms
            </p>
          </header>
          <div class="card-content">
            <!-- Formulario para registrar un nuevo usuario basado en niveles de usuario y con activacion mediante correo electronico -->
            <form action="../../back-end/funciones/insert_producto.php" method="POST" enctype="multipart/form-data">
              <div class="field is-horizontal">

                <div class="field-body">
                  <div class="field">
                    <label for=""><b>img</b></label>
                    <p class="control is-expanded has-icons-left">
                    <input name="imagen" class="input" type="file" accept="image/*" required>
                      <span class="icon is-small is-left"><i class="mdi mdi-rename-box"></i></span>
                    </p>
                  </div>
                </div>
              </div>
              <div class="field is-horizontal">

                <div class="field-body">
                  <div class="field">
                    <label for=""><b>Nombre</b></label>
                    <p class="control is-expanded has-icons-left">
                      <input name="nombre" class="input" type="text" placeholder="" required>
                      <span class="icon is-small is-left"><i class="mdi mdi-rename-box"></i></span>
                    </p>
                  </div>
                </div>
              </div>

              <div class="field is-horizontal">
                <div class="field-body">
                  <div class="field">
                    <label for=""><b>Descripcion</b></label>
                    <p class="control is-expanded has-icons-left">
                      <input name="descripcion" class="input" type="text" placeholder="" required>
                      <span class="icon is-small is-left"><i class="mdi mdi-passport-biometric"></i></span>
                    </p>
                  </div>
                </div>
              </div>
              <div class="field is-horizontal">
                <div class="field-body">
                  <div class="field">
                    <label for=""><b>Precio</b></label>
                    <p class="control is-expanded has-icons-left">
                      <input name="precio" class="input" type="text" placeholder="" required>
                      <span class="icon is-small is-left"><i class="mdi mdi-package-variant"></i></span>
                    </p>
                  </div>
                </div>
              </div>
              <hr>
              <div class="field is-horizontal">
                <div class="field-label">
                  <!-- Left empty for spacing -->
                </div>
                <div class="field-body">
                  <div class="field">
                    <div class="field is-grouped">
                      <div class="control">
                        <button type="submit" class="button is-primary">
                          <span>Guardar</span>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </section>

      <!-- Inicio footer -->
      <?php require '../components/footer.php' ?>
      <!-- Final Footer -->

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
    </div>

    <!-- Scripts below are for demo only -->
    <script type="text/javascript" src="../assets/js/main.min.js"></script>

    <!-- Icons below are for demo only. Feel free to use any icon pack. Docs: https://bulma.io/documentation/elements/icon/ -->
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">
  </body>

  </html>
<?php
}
?>