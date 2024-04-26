
<div class="footer">
    <span id="fecha_actual"></span>
</div>


<script>
    // Función para actualizar la fecha actual
    function actualizarFecha() {
        const fecha = new Date();
        const opciones = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        document.getElementById('fecha_actual').textContent = fecha.toLocaleDateString('es-ES', opciones);
    }

    // Ejecutar la función para actualizar la fecha al cargar la página
    actualizarFecha();
    // Actualizar la fecha cada segundo
    setInterval(actualizarFecha, 1000);
</script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
