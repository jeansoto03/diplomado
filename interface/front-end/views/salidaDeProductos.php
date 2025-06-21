<?php

include_once '../../back-end/conexion/conexion.php';

session_start();


if (!isset($_SESSION['id']) || !isset($_SESSION['name']) || $_SESSION['rol'] != 1) {
  echo "<meta http-equiv='refresh' content='0; url=index.php?alert=1'>";
} else {

  require_once '../../back-end/funciones/traerProductos.php';
?>

  <!DOCTYPE html>
  <html lang="en" class="has-aside-left has-aside-mobile-transition has-navbar-fixed-top has-aside-expanded">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- css  -->
    <link rel="stylesheet" href="../assets/css/vistaDeUsuarios.css">
    <link rel="stylesheet" href="../assets/css/main.min.css">
    <link rel="stylesheet" href="../assets/css/modal.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <title>Inventario</title>
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
                <li>Tables</li>
              </ul>
            </div>
          </div>

        </div>
      </section>

      <section class="section is-main-section">
        <div class="card has-table has-mobile-sort-spaced">
          <header class="card-header">
            <p class="card-header-title">
              <span class="icon"><i class="mdi mdi-account-multiple"></i></span>
              Generar salida de producto
            </p>
            <a href="#" class="card-header-icon">
              <span class="icon"><i class="mdi mdi-reload"></i></span>
            </a>
          </header>
          <div class="card-content">
            <div class="b-table has-pagination">
              <div class="table-wrapper has-mobile-cards">
                <table id="myTable" class="table is-fullwidth is-striped is-hoverable is-fullwidth">
                  <thead>
                    <tr>
                      <th>Id</th>

                      <th>Nombre</th>
                      <th>Modelo</th>
                      <th>Marca</th>
                      <th>Cantidad</th>
                      <th>Creado</th>
                      <th>Categoria</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($productos as $producto) { ?>
                      <tr>
                        <td data-label="Id">
                          <?php echo $producto['id'] ?>
                        </td>
                        <td data-label="Nombre"><?php echo $producto['nombre'] ?></td>
                        <td data-label="Modelo"><?php echo $producto['modelo'] ?></td>
                        <td data-label="Marca"><?php echo $producto['marca'] ?></td>
                        <td data-label="Cantidad"><?php echo $producto['cantidad'] ?></td>
                        <td data-label="Creado">
                          <small class="has-text-grey is-abbr-like"><?php echo $producto['fecha_creacion'] ?></small>
                        </td>
                        <td data-label="Categoria" class="is-image-cell">
                          <?php echo $producto['categoria'] ?>
                        </td>
                        <td class="is-actions-cell">
                          <div class="buttons is-right">
                            <button onclick="window.modal.showModal();"><span><svg fill="#ffffff" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 596.7 596.7" xml:space="preserve" stroke="#ffffff">
                                  <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                  <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                  <g id="SVGRepo_iconCarrier">
                                    <g>
                                      <g>
                                        <path d="M233.401,199.496l3.418-29.707c121.029,13.926,163.694,52.406,163.694,52.406s-1.848-147.22-150.812-164.359l3.418-29.707 l-139.563,70.76L233.401,199.496z"></path>
                                        <polygon points="77.537,195.251 0,195.251 0,241.151 47.922,241.151 76.993,305.411 596.7,305.411 596.7,259.511 106.607,259.511 "></polygon>
                                        <rect x="113.22" y="336.012" width="459" height="45.898"></rect>
                                        <rect x="140.76" y="412.512" width="403.92" height="45.898"></rect>
                                        <circle cx="194.31" cy="524.201" r="44.37"></circle>
                                        <circle cx="494.189" cy="524.201" r="44.37"></circle>
                                      </g>
                                    </g>
                                  </g>
                                </svg></span></button>


                          </div>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

    <dialog id="modal">
      <h2>Este es el título de mi ventana modal</h2>
      <p>Este es un texto de ejemplo dentro de una ventana modal</p>
      <button onclick="window.modal.close();">Cerrar</button>
    </dialog>
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