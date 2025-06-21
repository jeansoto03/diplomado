<?php
include_once '../../back-end/conexion/conexion.php';

session_start();

if (!isset($_SESSION['id']) || !isset($_SESSION['name']) || $_SESSION['rol'] != 1) {
  echo "<meta http-equiv='refresh' content='0; url=index.php?alert=1'>";
  exit;
}

require_once '../../back-end/funciones/traerFacturas.php';
?>

<!DOCTYPE html>
<html lang="en" class="has-aside-left has-aside-mobile-transition has-navbar-fixed-top has-aside-expanded">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Facturas</title>

  <!-- css is included -->
  <link rel="stylesheet" href="../assets/css/vistaDeUsuarios.css">
  <link rel="stylesheet" href="../assets/css/main.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
  
  <!-- PDF Libraries -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
  
  <style>
    .json-view {
      background-color: #f8f8f8;
      border: 1px solid #e1e1e1;
      border-radius: 4px;
      padding: 10px;
      font-family: monospace;
      font-size: 14px;
      max-height: 200px;
      overflow-y: auto;
      white-space: pre-wrap;
      word-break: break-all;
    }
    .modal-content {
      max-width: 800px;
      max-height: 80vh;
      overflow: auto;
    }
    .buttons .button {
      margin-bottom: 0.25rem;
    }
  </style>
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
              <li>Facturas</li>
            </ul>
          </div>
        </div>
        <div class="level-right">
          <div class="level-item">
            <div class="buttons is-right">
              <!-- Puedes agregar botones adicionales aquí si es necesario -->
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="section is-main-section">
      <div class="card has-table has-mobile-sort-spaced">
        <header class="card-header">
          <p class="card-header-title">
            <span class="icon"><i class="mdi mdi-receipt"></i></span>
            Facturas
          </p>
          <a href="#" class="card-header-icon" onclick="location.reload()">
            <span class="icon"><i class="mdi mdi-reload"></i></span>
          </a>
        </header>
        <div class="card-content">
          <div class="b-table has-pagination">
            <div class="table-wrapper has-mobile-cards">
              <table id="myTable" class="table is-fullwidth is-striped is-hoverable">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Email</th>
                    <th>Empresa</th>
                    <th>Fecha</th>
                    <th>Monto</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($facturas as $factura) { 
                    $products_json = htmlspecialchars($factura['products']);
                  ?>
                    <tr>
                      <td data-label="Id"><?php echo $factura['id'] ?></td>
                      <td data-label="email"><?php echo $factura['email'] ?></td>
                      <td data-label="empresa"><?php echo $factura['business_name'] ?></td>
                      <td data-label="Creado">
                        <small class="has-text-grey is-abbr-like"><?php echo date('d/m/Y', strtotime($factura['date'])) ?></small>
                      </td>
                      <td data-label="monto">$<?php echo number_format($factura['total'], 2, ',', '.') ?></td>
                      <td data-label="Acciones">
                        <div class="buttons">
                          <button class="button is-small is-info view-products" 
                                  data-products='<?= $products_json ?>'>
                            <span class="icon"><i class="mdi mdi-eye"></i></span>
                            <span>Productos</span>
                          </button>
                          <button class="button is-small is-success download-pdf" 
                                  data-id="<?= $factura['id'] ?>"
                                  data-rif="<?= htmlspecialchars($factura['rif']) ?>"
                                  data-business="<?= htmlspecialchars($factura['business_name']) ?>"
                                  data-date="<?= date('d/m/Y', strtotime($factura['date'])) ?>"
                                  data-total="<?= number_format($factura['total'], 2, ',', '.') ?>"
                                  data-email="<?= htmlspecialchars($factura['email']) ?>"
                                  data-created="<?= date('d/m/Y H:i', strtotime($factura['created_at'])) ?>"
                                  data-products='<?= $products_json ?>'>
                            <span class="icon"><i class="mdi mdi-file-pdf"></i></span>
                            <span>PDF</span>
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
  
  <!-- Modal para ver productos -->
  <div class="modal" id="productsModal">
    <div class="modal-background"></div>
    <div class="modal-card">
      <header class="modal-card-head">
        <p class="modal-card-title">Detalle de Productos</p>
        <button class="delete" aria-label="close" id="closeModal"></button>
      </header>
      <section class="modal-card-body">
        <div class="json-view" id="productsJson"></div>
        <table class="table is-fullwidth is-striped mt-4" id="productsTable">
          <thead>
            <tr>
              <th>Producto</th>
              <th>Cantidad</th>
              <th>Precio Unitario</th>
              <th>Subtotal</th>
            </tr>
          </thead>
          <tbody id="productsTableBody"></tbody>
        </table>
      </section>
      <footer class="modal-card-foot">
        <button class="button" id="closeModalBtn">Cerrar</button>
      </footer>
    </div>
  </div>
  
  <!-- Inicio footer -->
  <?php require '../components/footer.php' ?>
  <!-- Final Footer -->

  <!-- Scripts -->
  <script type="text/javascript" src="../assets/js/main.min.js"></script>
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">
  <script src="../assets/js/jquery-3.6.0.js"></script>
  <script type="text/javascript" src="../assets/js/cndDatatable.js"></script>
  <script src="../assets/js/datatableModel.js"></script>
  
  <script>
    // Modal para ver productos
    const modal = document.getElementById('productsModal');
    const productsJson = document.getElementById('productsJson');
    const productsTableBody = document.getElementById('productsTableBody');
    const closeButtons = document.querySelectorAll('#closeModal, #closeModalBtn');
    
    // Delegación de eventos para los botones de ver productos
    document.addEventListener('click', function(e) {
      if (e.target.closest('.view-products')) {
        const button = e.target.closest('.view-products');
        const productsData = JSON.parse(button.getAttribute('data-products'));
        productsJson.textContent = JSON.stringify(productsData, null, 2);
        
        // Generar tabla de productos
        productsTableBody.innerHTML = '';
        productsData.forEach(product => {
          const subtotal = product.quantity * product.price;
          const row = document.createElement('tr');
          row.innerHTML = `
            <td>${product.name}</td>
            <td>${product.quantity}</td>
            <td>$${product.price.toFixed(2)}</td>
            <td>$${subtotal.toFixed(2)}</td>
          `;
          productsTableBody.appendChild(row);
        });
        
        modal.classList.add('is-active');
      }
    });
    
    closeButtons.forEach(button => {
      button.addEventListener('click', () => {
        modal.classList.remove('is-active');
      });
    });
    
    // Generar PDF
    document.addEventListener('click', function(e) {
      if (e.target.closest('.download-pdf')) {
        const button = e.target.closest('.download-pdf');
        const facturaData = {
          id: button.getAttribute('data-id'),
          rif: button.getAttribute('data-rif'),
          business: button.getAttribute('data-business'),
          date: button.getAttribute('data-date'),
          total: button.getAttribute('data-total'),
          email: button.getAttribute('data-email'),
          created: button.getAttribute('data-created'),
          products: JSON.parse(button.getAttribute('data-products'))
        };
        
        generatePDF(facturaData);
      }
    });
    
    function generatePDF(facturaData) {
      const { jsPDF } = window.jspdf;
      const doc = new jsPDF();
      
      // Configuración inicial
      doc.setFontSize(18);
      doc.text(`FACTURA #${facturaData.id}`, 105, 15, null, null, 'center');
      
      doc.setFontSize(12);
      doc.text(`Fecha: ${facturaData.date}`, 15, 25);
      doc.text(`Registrada: ${facturaData.created}`, 15, 30);
      
      // Información de la empresa
      doc.setFontSize(14);
      doc.text('Datos de la Empresa', 15, 40);
      doc.setFontSize(12);
      doc.text(`RIF: ${facturaData.rif}`, 15, 45);
      doc.text(`Nombre: ${facturaData.business}`, 15, 50);
      
      // Información del cliente
      doc.setFontSize(14);
      doc.text('Datos del Cliente', 15, 60);
      doc.setFontSize(12);
      doc.text(`Email: ${facturaData.email}`, 15, 65);
      
      // Tabla de productos
      doc.setFontSize(14);
      doc.text('Detalle de Productos', 15, 75);
      
      const tableData = facturaData.products.map(product => {
        const subtotal = product.quantity * product.price;
        return [
          product.name,
          product.quantity,
          `$${product.price.toFixed(2)}`,
          `$${subtotal.toFixed(2)}`
        ];
      });
      
      // Añadir fila de total
      tableData.push(['', '', 'TOTAL:', facturaData.total]);
      
      doc.autoTable({
        startY: 80,
        head: [['Producto', 'Cantidad', 'Precio Unitario', 'Subtotal']],
        body: tableData,
        theme: 'grid',
        headStyles: { fillColor: [41, 128, 185], textColor: 255 },
        styles: { fontSize: 10, cellPadding: 3 },
        columnStyles: {
          0: { cellWidth: 'auto' },
          1: { cellWidth: 25 },
          2: { cellWidth: 40 },
          3: { cellWidth: 30 }
        },
        didDrawCell: function(data) {
          if (data.row.index === tableData.length - 1 && data.column.index === 2) {
            doc.setFontSize(12);
            doc.setFont(undefined, 'bold');
          }
        }
      });
      
      // Firma
      const finalY = doc.lastAutoTable.finalY + 15;
      doc.setFontSize(10);
      doc.text('Firma del Responsable', 150, finalY);
      doc.line(150, finalY + 2, 190, finalY + 2);
      
      // Guardar PDF
      doc.save(`factura_${facturaData.id}.pdf`);
    }
  </script>
</body>
</html>