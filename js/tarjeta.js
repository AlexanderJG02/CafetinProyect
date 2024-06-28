     function mostrarTarjeta() {
            var tipoPago = document.getElementById("tipo_pago");
            var tarjeta = document.querySelector(".tarjeta");
            if (tipoPago.value === "tarjeta") {
                tarjeta.style.display = "block";
            } else {
                tarjeta.style.display = "none";
            }
        }
        
        function mostrarAlerta(mensaje, exito) {
            const alerta = document.createElement('div');
            alerta.className = 'alerta';
            alerta.textContent = mensaje;

            if (exito) {
                alerta.style.backgroundColor = '#4CAF50'; 
                const icono = document.createElement('i');
                icono.className = 'fas fa-check';
                alerta.appendChild(icono);
            } else {
                alerta.style.backgroundColor = '#333';
            }

            document.body.appendChild(alerta);

            setTimeout(function() {
                alerta.style.opacity = '1';
            }, 100);

            setTimeout(function() {
                alerta.style.opacity = '0';
                setTimeout(function() {
                    alerta.remove();
                }, 1000);
            }, 4000);
        }