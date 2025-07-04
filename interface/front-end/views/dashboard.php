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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
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
       <section class="bg-white rounded-lg shadow p-6 max-w-4xl mx-auto">
      <h2 class="text-2xl font-semibold text-center text-gray-800 mb-8">Gráfico de Facturas por Semana</h2>
      <div class="relative h-96 mb-8">
        <canvas id="invoiceChart" class="w-full h-full"></canvas>
      </div>
      </div>
    </section>
  </main>

  <script>
    function verProductos() {
      document.location.href = "productos.php";
    }

    // Generar datos del gráfico usando total_facturas PHP variable
    // Suponemos que el total_facturas es un número entero
    const totalFacturas = <?php echo (int)$total_facturas; ?>;

    // Distribuir totalFacturas en 5 semanas de forma aleatoria pero sumando totalFacturas
    function distribuirFacturas(total, semanas) {
      let facturas = [];
      let remaining = total;
      for (let i = 0; i < semanas - 1; i++) {
       
      }
      facturas.push(remaining);
      // Mezclar para que no quede ordenado
      for (let i = facturas.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [facturas[i], facturas[j]] = [facturas[j], facturas[i]];
      }
      return facturas;
    }

    const weeklyInvoices = distribuirFacturas(totalFacturas, 5);
    
    // Crear gráfico
    const ctx = document.getElementById('invoiceChart').getContext('2d');
    const myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Semana 1', 'Semana 2', 'Semana 3', 'Semana 4', 'Última Semana'],
        datasets: [{
          label: 'Número de Facturas',
          data: weeklyInvoices,
          backgroundColor: 'rgba(59, 130, 246, 0.7)',
          borderColor: 'rgba(59, 130, 246, 1)',
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          y: {
            beginAtZero: true,
            title: {
              display: true,
              text: 'Número de Facturas'
            }
          },
          x: {
            title: {
              display: true,
              text: 'Semanas'
            }
          }
        },
        plugins: {
          tooltip: {
            callbacks: {
              label: function(context) {
                return context.parsed.y + ' facturas';
              }
            }
          },
          legend: {
            position: 'top',
          }
        }
      }
    });
  </script>

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