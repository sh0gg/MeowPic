// Lista de imágenes (puedes agregar más)
const imagenes = [
    './imagenes/gatitos/gatito1.jpg',
    './imagenes/gatitos/gatito2.jpg',
    './imagenes/gatitos/gatito3.jpg',
    './imagenes/gatitos/gatito4.jpg',
    './imagenes/gatitos/gatito5.jpg',
    './imagenes/gatitos/gatito6.jpg',
    './imagenes/gatitos/gatito7.jpg',
    './imagenes/gatitos/gatito8.jpg',
    './imagenes/gatitos/gatito9.jpg',
    './imagenes/gatitos/gatito10.jpg',

];

function mostrarFotoAleatoria() {
    const indiceAleatorio = Math.floor(Math.random() * imagenes.length);
    const img = document.getElementById('imagen-gatito');
    img.src = imagenes[indiceAleatorio];
}

// Mostrar una imagen al cargar la página
window.onload = mostrarFotoAleatoria;
