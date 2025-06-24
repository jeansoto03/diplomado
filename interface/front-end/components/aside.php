<!-- html del aside -->

<aside class="aside is-placed-left is-expanded">
  <div class="aside-tools">
    <div class="aside-tools-label">
      <span><b>Party</b>Color</span>
    </div>
  </div>
  <div class="menu is-menu-main">
    <p class="menu-label">General</p>
    <ul class="menu-list">
      <li>
        <a href="dashboard.php" class="is-active router-link-active has-icon">
          <span class="icon"><i class="mdi mdi-desktop-mac"></i></span>
          <span class="menu-item-label">Inicio</span>
        </a>
      </li>
    </ul>
    <p class="menu-label">Menu</p>
    <ul class="menu-list">
      <?php
      if ($_SESSION['rol'] == 1) {
      ?>
        <li>
          <a href="newUser.php" class="has-icon">
            <span class="icon"><i class="mdi mdi-square-edit-outline"></i></span>
            <span class="menu-item-label">Nuevo usuario</span>
          </a>
        </li>
      <?php
      }
      ?>
      <?php
      if ($_SESSION['rol'] == 1) {
      ?>
        <li>
          <a href="usuarios.php" class="has-icon">
            <span class="icon"><i class="mdi mdi-square-edit-outline"></i></span>
            <span class="menu-item-label">Usuarios</span>
          </a>
        </li>
         <li>
          <a href="usuariosTienda.php" class="has-icon">
            <span class="icon"><i class="mdi mdi-square-edit-outline"></i></span>
            <span class="menu-item-label">Clientes</span>
          </a>
        </li>
      <?php
      }
      ?>
      <li>
        <a href="productos.php" class="has-icon">
          <span class="icon has-update-mark"><i class="mdi mdi-table"></i></span>
          <span class="menu-item-label">Productos</span>
        </a>
      </li>
      <li>
        <a href="invoces.php" class="has-icon">
          <span class="icon has-update-mark"><i class="mdi mdi-table"></i></span>
          <span class="menu-item-label">Invoces</span>
        </a>
      </li>
      <!-- <li>
        <a href="forms.php" class="has-icon">
          <span class="icon"><i class="mdi mdi-square-edit-outline"></i></span>
          <span class="menu-item-label">Forms</span>
        </a>
      </li> -->
    </ul>
    
  </div>
</aside>