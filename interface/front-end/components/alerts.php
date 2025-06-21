<?php
if (empty($_GET['alert'])) {
    echo "";
}

//EL USUARIO NO EXISTE
elseif ($_GET['alert'] == 1) {
    echo '<div id="modalAlert" class="modalAlert">
        <div class="modalAlert-content">
            <h2>ALERTA</h2>
            <p>El usuario o clave son incorrectos. Por favor, intentelo nuevamente.</p>
            <button id="manualClose" class="close-btn">Cerrar</button>
        </div>
    </div>';
}

//SALIO DEL SISTEMA CON EXITO
elseif ($_GET['alert'] == 2) {
    echo '<div id="modalAlert" class="modalAlert">
        <div class="modalAlert-content">
            <h2>ALERTA</h2>
            <p>Sesión cerrada exitósamente.</p>
            <button id="manualClose" class="close-btn">Cerrar</button>
        </div>
    </div>';
}

// producto y componentes agregado correctamente
elseif ($_GET['alert'] == 3) {
    echo '<div id="modalAlert" class="modalAlert">
        <div class="modalAlert-content">
            <h2>ALERTA</h2>
            <p>Producto agregado correctamente</p>
            <button id="manualClose" class="close-btn">Cerrar</button>
        </div>
    </div>';
}


//usuario agregado
elseif ($_GET['alert'] == 4) {
    echo '<div id="modalAlert" class="modalAlert">
        <div class="modalAlert-content">
            <h2>ALERTA</h2>
            <p>El usuario ha sido creado satisfactoriamente</p>
            <button id="manualClose" class="close-btn">Cerrar</button>
        </div>
    </div>';
}

// el componente no ha sido encontrado
elseif ($_GET['alert'] == 5) {
    echo '<div id="modalAlert" class="modalAlert">
        <div class="modalAlert-content">
            <h2>ALERTA</h2>
            <p>El componente no ha sido encontrado</p>
            <button id="manualClose" class="close-btn">Cerrar</button>
        </div>
    </div>';
}
?>
<!-- FIN DE LAS ALERTAS -->
<script type="module">
    const modal = document.getElementById('modalAlert');
    const manualCloseButton = document.getElementById('manualClose');

    // Cerrar el modal manualmente
    if (manualCloseButton) {
        manualCloseButton.onclick = function () {
            modal.style.display = "none";
        };
    }

    // Cerrar el modal automáticamente después de 4 segundos
    setTimeout(function () {
        if (modal) {
            modal.style.display = "none";
        }
    }, 4000);

    // Limpiar la URL eliminando el parámetro `alert` sin recargar la página
    const url = new URL(window.location.href);
    if (url.searchParams.has('alert')) {
        url.searchParams.delete('alert'); // Eliminar el parámetro "alert"
        window.history.replaceState({}, document.title, url.pathname); // Reemplazar la URL en el historial
    }
;

</script>