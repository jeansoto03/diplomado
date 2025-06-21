<?php

include_once '../../back-end/conexion/conexion.php';

session_start();




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
            <form action="../../back-end/funciones/newUser.php" method="POST">
              <div class="field is-horizontal">
                <div class="field-label is-normal">
                  <label class="label">User</label>
                </div>
                <div class="field-body">
                  <div class="field">
                    <label for=""><b>Nombre</b></label>
                    <p class="control is-expanded has-icons-left">
                      <input name="usuario" class="input" type="text" placeholder="Name" required>
                      <span class="icon is-small is-left"><i class="mdi mdi-account"></i></span>
                    </p>
                  </div>
                  <div class="field">
                    <label for=""><b>Correo</b></label>
                    <p class="control is-expanded has-icons-left has-icons-right">
                      <input name="email" class="input is-success" type="email" placeholder="Email" value="tucorreo@gmail.com" required>
                      <span class="icon is-small is-left"><i class="mdi mdi-mail"></i></span>
                      <span class="icon is-small is-right"><i class="mdi mdi-check"></i></span>
                    </p>
                  </div>
                </div>
              </div>
              <div class="field is-horizontal">
                <div class="field-label"></div>
                <div class="field-body">
                  <div class="field">
                    <label for=""><b>Password</b></label>
                    <p class="control is-expanded has-icons-left">
                      <input name="clave" class="input" type="password" placeholder="Password" required>
                      <span class="icon is-small is-left"><i class="mdi mdi-account"></i></span>
                    </p>
                  </div>
                  <div class="field">
                    <label for=""><b>Confirm Password</b></label>
                    <p class="control is-expanded has-icons-left has-icons-right">
                      <input name="reclave" class="input is-success" type="password" placeholder="Confirm Password" required>
                      <span class="icon is-small is-left"><i class="mdi mdi-mail"></i></span>
                      <span class="icon is-small is-right"><i class="mdi mdi-check"></i></span>
                    </p>
                  </div>
                </div>
              </div>
              <div class="field is-horizontal">
                <div class="field-label is-normal">
                  <label class="label">Tipo de usuario</label>
                </div>
                <div class="field-body">
                  <div class="field is-narrow">
                    <div class="control">
                      <div class="select is-fullwidth">
                        <select name="tipoUsuario" required>
                          <option value="1">Administrador</option>
                        </select>
                      </div>
                    </div>
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
                          <span>Submit</span>
                        </button>
                      </div>
                      <div class="control">
                        <button type="button" class="button is-primary is-outlined">
                          <span>Reset</span>
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
