<?php

include_once '../../back-end/conexion/conexion.php';

session_start();


if (!isset($_SESSION['id']) || !isset($_SESSION['name']) || $_SESSION['rol'] != 1) {
  echo "<meta http-equiv='refresh' content='0; url=index.php?alert=1'>";
} else {

  require_once '../../back-end/funciones/traerUsuariosTienda.php'
?>

  <!DOCTYPE html>
  <html lang="en" class="has-aside-left has-aside-mobile-transition has-navbar-fixed-top has-aside-expanded">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inventario</title>

    <!-- css is included -->
    <link rel="stylesheet" href="../assets/css/vistaDeUsuarios.css">
    <link rel="stylesheet" href="../assets/css/main.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">


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
                <li>Lista de usuarios</li>
              </ul>
            </div>
          </div>

        </div>
      </section>

      <section class="section is-main-section">

        <div class="card has-table">
          <header class="card-header">
            <p class="card-header-title">
              <span class="icon"><i class="mdi mdi-account-multiple"></i></span>
              Clients
            </p>
          </header>
          <div class="card-content">
            <div class="b-table has-pagination">
              <div class="table-wrapper has-mobile-cards">
                <table id="myTable" class="table is-fullwidth is-striped is-hoverable is-fullwidth">
                  <thead>
                    <tr>
                      <th>
                        Id
                      </th>
                      <th></th>
                      <th>Nombre</th>
                      <th>Correo Electronico</th>
                      <th>Creado</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($resultado as $usuario) { ?>
                      <tr>
                        <td class="is-checkbox-cell">
                          <?php echo $usuario['id'] ?>
                        </td>
                        <td class="is-image-cell">
                          <div class="image">
                            <img src="https://avatars.dicebear.com/v2/initials/rebecca-bauch.svg" class="is-rounded">
                          </div>
                        </td>
                        <td data-label="Nombre"><?php echo $usuario['name'] ?></td>
                        <td data-label="Email"><?php echo $usuario['email'] ?></td>
                      
                        <td data-label="Created">
                          <small class="has-text-grey is-abbr-like"><?php echo $usuario['fecha_creacion'] ?></small>
                        </td>
                        <!-- <td class="is-actions-cell">
                          <div class="buttons is-right">
                            <button class="button is-small is-primary" type="button">
                              <span class="icon"><i class="mdi mdi-eye"></i></span>
                            </button>
                            <button class="button is-small is-danger jb-modal" data-target="sample-modal" type="button">
                              <span class="icon"><i class="mdi mdi-trash-can"></i></span>
                            </button>
                          </div>
                        </td> -->
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>

                <!-- final  -->




              </div>
            </div>
          </div>
        </div>
      </section>


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
    <!-- Inicio footer -->
    <?php require '../components/footer.php' ?>
    <!-- Final Footer -->

    <!-- Scripts below are for demo only -->
    <script type="text/javascript" src="../assets/js/main.min.js"></script>

    <!-- Icons below are for demo only. Feel free to use any icon pack. Docs: https://bulma.io/documentation/elements/icon/ -->
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">
    <script src="../assets/js/jquery-3.6.0.js"></script>
    <script type="text/javascript" src="../assets/js/cndDatatable.js"></script>
    <script src="../assets/js/datatableModel.js"></script>

  </body>

  </html>
<?php
}
?>