  function irAPaginaDePago() {
            // Redireccionar a la página de pago
            window.location.href = 'http://localhost/catedraa/pago.php'; 
        }

        

        function eliminarProducto(index) {
            // Realizar una solicitud AJAX para eliminar el producto sin recargar la página
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Mostrar una alerta con un icono cuando se elimina el producto
                    mostrarAlerta('¡Producto eliminado del carrito!', true);
                    // Recargar la página después de eliminar el producto
                    setTimeout(function() {
                        window.location.reload();
                    }, 1000);
                }
            };
            xhr.open("POST", "", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("eliminarDelCarrito=1&index=" + index);
        }

        // Función para mostrar alerta y ocultarla después de un tiempo determinado
        function mostrarAlerta(mensaje, exito) {
            const alerta = document.createElement('div');
            alerta.className = 'alerta';
            alerta.textContent = mensaje;

            if (exito) {
                alerta.style.backgroundColor = '#C0392B'; // verde
                const icono = document.createElement('span');
                icono.className = 'fa fa-check';
                alerta.appendChild(icono);
            } else {
                alerta.style.backgroundColor = '#333'; // color original
            }

            document.body.appendChild(alerta);

            setTimeout(function() {
                alerta.style.opacity = '0';
                setTimeout(function() {
                    alerta.remove();
                }, 1000);
            }, 1000);
        }