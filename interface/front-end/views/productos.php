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
                <li>Tables</li>
              </ul>
            </div>
          </div>
          <div class="level-right">
            <div class="level-item">
              <div class="buttons is-right">
                <a href="./newProduct.php" class="button is-primary">
                  <span>Agregar Producto</span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="section is-main-section">
        <div class="card has-table has-mobile-sort-spaced">
          <header class="card-header">
            <p class="card-header-title">
              <span class="icon"><i class="mdi mdi-account-multiple"></i></span>
              Productos
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
                      <th>Descripcion</th>
                      <th>Precio</th>
                      <th>Creado</th>
                    
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
                        <td data-label="descripcion"><?php echo $producto['descripcion'] ?></td>
                        <td data-label="precio"><?php echo $producto['precio'] ?></td>
                        <td data-label="Creado">
                          <small class="has-text-grey is-abbr-like"><?php echo $producto['fecha_creacion'] ?></small>
                        </td>
                        <td class="is-actions-cell">
                          <div class="buttons is-right">
                            <a href="updateProduct.php?id=<?php echo $producto['id'] ?>" class="button is-small is-primary" type="button">
                              <span class="icon"><i class="mdi mdi-eye"></i></span>
                            </a>
                            <button onclick="confirmDeletion(<?php echo $producto['id'] ?>)" class="button is-small is-danger jb-modal" data-target="sample-modal" type="button">
                              <span class="icon"><i class="mdi mdi-trash-can"></i></span>
                            </button>
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

    <script>
      function confirmDeletion(id) {
        if (confirm("¿Estás seguro que deseas eliminar este producto?")) {
          // Redirigir al script de eliminación con el id correspondiente
          window.location.href = `../../back-end/funciones/deleteProduct.php?id_delete=${id}`;
        }
      }
    </script>
  </body>

  </html>
<?php
}
?>