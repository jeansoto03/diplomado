const ctx = document.getElementById('myChart').getContext('2d');

// Crea la instancia inicial de la gráfica
const myChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: [], // Etiquetas vacías, se llenarán dinámicamente
    datasets: [{
      label: 'Cantidad de Productos',
      data: [], // Datos vacíos, se llenarán dinámicamente
      backgroundColor: 'rgba(54, 162, 235, 0.5)',
      borderColor: 'rgba(54, 162, 235, 1)',
      borderWidth: 1
    }]
  },
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
});

let url = "http://localhost/inventario/back-end/funciones/datosGrafica.php";

// Obtiene los datos del backend
fetch(url)
  .then(response => response.json()) // Asegúrate de que los datos sean JSON
  .then(datos => mostrar(datos))
  .catch(error => console.error("Error al cargar los datos:", error));

// Función para mostrar los datos en la gráfica
const mostrar = (productos) => {
  productos.forEach(element => {
    myChart.data.labels.push(element.categoria); // Añade el nombre del producto como etiqueta
    myChart.data.datasets[0].data.push(element.total); // Añade la cantidad como valor
  });
  
  myChart.update(); // Actualiza la gráfica con los nuevos datos
};

console.log(myChart);
