/**
 * Función para crear una nueva tarea.
 * @function
 * @listens click
 * @param {Event} event - Evento de click en el botón de crear tarea.
 */
document.getElementById("crearTarea").addEventListener("click", function(event) {
  // Obtener el valor de la nueva tarea desde el elemento de entrada.
  var nuevaTarea = document.getElementById("nuevaTarea").value;

  // Enviar una solicitud POST para crear la tarea.
  fetch('crear_tarea.php', {
      method: 'POST',
      headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: 'tarea=' + nuevaTarea,
  })
  .then(response => {
      // Verificar si la respuesta de la red fue exitosa.
      if (!response.ok) {
          throw new Error('Network response was not ok');
      }
      // Devolver el contenido de la respuesta como texto.
      return response.text();
  })
  .then(data => {
      // Mostrar un mensaje de alerta con el resultado de la creación de la tarea.
      alert(data);
      // Si la tarea se creó con éxito, redirigir a la página de tareas.
      if (data === "Tarea creada exitosamente") {
          window.location.href = "tareas.php";
      }
  })
  .catch(error => console.error('Error:', error)); // Capturar y manejar errores.
});


/**
 * Función para eliminar una tarea.
 * @function
 * @listens click
 * @param {Event} event - Evento de click en el enlace de eliminación de tarea.
 */
document.querySelectorAll('.eliminarTarea').forEach(function(enlace) {
  enlace.addEventListener('click', function(event) {
    event.preventDefault(); // Prevenir el comportamiento predeterminado del enlace
    var idTarea = this.dataset.id;
    
    /**
     * Función para mostrar una alerta.
     * @function
     * @param {string} mensaje - Mensaje que se mostrará en la alerta.
     * @param {string} tipo - Tipo de alerta (por ejemplo: 'success', 'danger', etc.).
     */
    function mostrarAlerta(mensaje, tipo) {
      var alerta = document.createElement('div');
      alerta.classList.add('alert', 'alert-' + tipo);
      alerta.textContent = mensaje;
      document.body.appendChild(alerta);
      
      setTimeout(function() {
        alerta.remove();
      }, 3000);
    }

    // Confirmación nativa del navegador
    var confirmarEliminar = confirm("Are you sure you want to delete this task?");
    
    if (confirmarEliminar) {
      // Si el usuario confirma la eliminación, enviar la solicitud de eliminación
      fetch('eliminar_tarea.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'id_tarea=' + idTarea,
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          // Eliminar la fila de la tabla
          var fila = document.getElementById('fila' + idTarea);
          fila.remove();
          // Mostrar una alerta de éxito
          mostrarAlerta("Your file has been deleted.", "success");
        } else {
          mostrarAlerta("Error: " + data.error, "danger");
        }
      })
      .catch(error => console.error('Error:', error));
    }
  });
});

/**
 * Función para editar una tarea.
 * @function
 * @listens click
 * @param {Event} event - Evento de click en el botón de edición de tarea.
 */
document.querySelectorAll('.editarTarea').forEach(function(boton) {
  boton.addEventListener('click', function() {
      var idTarea = this.dataset.id;
      var editarForm = document.querySelector('.editarForm[data-id="' + idTarea + '"]');
      var tareaEditada = editarForm.querySelector('input[name="tarea_editada"]').value;

      // Mostrar el formulario de edición
      editarForm.style.display = 'block';

      fetch('modificar_tarea.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'id_tarea=' + idTarea + '&tarea_editada=' + tareaEditada,
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          // Actualizar la tarea en la tabla
          var filaTarea = document.querySelector('#fila' + idTarea + ' .fa-plus');
          filaTarea.nextElementSibling.textContent = tareaEditada;

          // Ocultar el formulario de edición
          editarForm.style.display = 'none';
        } else {
          alert(data.error);
        }
      })
      .catch(error => console.error('Error:', error));
  });
});

/**
 * Función para marcar una tarea como realizada.
 * @function
 * @listens click
 * @param {Event} event - Evento de click en el botón de marcar tarea como realizada.
 */
document.querySelectorAll('.marcarRealizada').forEach(function(boton) {
  boton.addEventListener('click', function(event) {
    event.preventDefault(); // Prevenir el comportamiento predeterminado del enlace

    var idTarea = this.dataset.id;

    fetch('marcar_tarea_realizada.php?id=' + idTarea, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        var tareaElement = document.querySelector(`#tarea${idTarea}`);
        tareaElement.classList.add('tachado');
      } else {
        console.error('Error al marcar la tarea como realizada');
      }
    })
    .catch(error => console.error('Error:', error));
  });
});




