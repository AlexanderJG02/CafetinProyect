// Función para agregar producto al carrito
    function agregarAlCarrito(nombre, precio) {
        const formData = new FormData();
        formData.append('agregarAlCarrito', true);
        formData.append('nombre', nombre);
        formData.append('precio', precio);
        fetch('carrito.php', {
            method: 'POST',
            body: formData
        }).then(response => {
            if (response.ok) {
                mostrarAlerta('¡Producto agregado al carrito!', true);
            } else {
                mostrarAlerta('Ha ocurrido un error al agregar el producto al carrito.', false);
            }
        });
    }

    // Función para agregar producto al pedido
    function agregarAlPedido(nombre, precio) {
        const formData = new FormData();
        formData.append('agregarAlPedido', true);
        formData.append('nombre', nombre);
        formData.append('precio', precio);
        fetch('pagarPedido.php', { 
            method: 'POST',
            body: formData
        }).then(response => {
            if (response.ok) {
                mostrarAlerta('¡Producto agregado al pedido!', false);
            } else {
                mostrarAlerta('Ha ocurrido un error al agregar el producto al pedido.', false);
            }
        });
    }

    // Función para mostrar alerta y ocultarla después de un tiempo determinado 
    function mostrarAlerta(mensaje, exito) {
        const alerta = document.createElement('div');
        alerta.className = 'alerta';
        alerta.textContent = mensaje;

        if (exito) {
            alerta.style.backgroundColor = '#28a745'; 
            const icono = document.createElement('span');
            icono.className = 'fa fa-check';
            alerta.appendChild(icono);
        } else {
            alerta.style.backgroundColor = '#007bff'; 
        }

        document.body.appendChild(alerta);

        setTimeout(function() {
            alerta.style.opacity = '0';
            setTimeout(function() {
                alerta.remove();
            }, 1000);
        }, 1000);
    }