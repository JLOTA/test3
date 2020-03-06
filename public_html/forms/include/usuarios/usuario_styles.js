$(document).ready(function() {
//modal
  let modal = document.querySelector('#modal');
  let boton = document.querySelector('#modal__boton');
  boton.addEventListener('click', function(){
  modal.classList.toggle("modal--open");
  });
// Global Settings
  let edit = false;
  fetchTasks();

  miFormulario = document.querySelector('#user-form');
  //miFormulario.stock.addEventListener('keypress', mandarNumero);

  function mandarNumero(e){
    if (!soloNumeros(event)){
      e.preventDefault();
    }
  }
  function soloNumeros(e){
    var key = e.charCode;
    //console.log(key);
    return key >= 46 && key <= 57;
  }

  /*-------------------buscador-------------------*/
  $('#search').keyup(function() {
    if($('#search').val()) {
      let search = $('#search').val();
      $.ajax({
        url: 'include/usuarios/usuario_buscar.php',
        data: {search},
        type: 'POST',
        success: function (response) {
          console.log(response);
          if(!response.error) {
            let tasks = JSON.parse(response);
            let template = '';
            tasks.forEach(task => {
              template += `
                  <tr taskId="${task.id_usuarios}">
                  <td hidden>${task.id_usuarios}</td>
                  <td>${task.dni}</td>
                  <td>${task.nombres}</td>
                  <td>${task.apellidos}</td>
                  <td>${task.correo}</td>
                  <td>${task.telefono}</td>
                  <td hidden>${task.direccion}</td>
                <td><a href="#" class="task-item"><span id="icon" class="icon-edit"></span></a></a></td>
                <td><a href="#" class="task-delete"><span id="icon" class="icon-delete"></span></a></td>
                  </tr>`
            });
            $('#tasks').html(template);
          }
        } 
      })
    } else {
      fetchTasks();
    }
  });
  /*-------------------buscador-------------------*/

  /*-----------------------guardar-editar-----------------------*/
  $('#user-form').submit(function(e) {
    const postData = {
      dni: $('#dni').val(),
      password: $('#password').val(),
      id_tipo_usuario: $('#id_tipo_usuario').val(),
      nombres: $('#nombres').val(),
      apellidos: $('#apellidos').val(),
      telefono: $('#telefono').val(),
      direccion: $('#direccion').val(),
      correo: $('#correo').val(),
      id_usuarios: $('#id_usuarios').val()
    };
    console.log(postData);
    const url = edit === false ? 'include/usuarios/usuario_nuevo.php' : 'include/usuarios/usuario_edit.php';
    console.log(postData, url);
    $.post(url, postData, (response) => {
    console.log(postData);
    $('#alert').html(response);
    $('#user-form').trigger('reset');
    fetchTasks();
    modal.classList.toggle("modal--open");
    });    
    e.preventDefault();
  });
  /*-----------------------guardar-editar-----------------------*/

/*----------------------Fetching Tasks----------------------*/
  function fetchTasks() {
    $.ajax({
      url: 'include/usuarios/usuario_listar.php',
      type: 'GET',
      success: function(response) {
        const tasks = JSON.parse(response);
        let template = '';
        tasks.forEach(task => {
          template += `
                  <tr taskId="${task.id_usuarios}">
                  <td hidden>${task.id_usuarios}</td>
                  <td>
                    ${task.dni} 
                  </td>
                  <td>${task.nombres}</td>
                  <td>${task.apellidos}</td>
                  <td>${task.correo}</td>
                  <td>${task.telefono}</td>
                  <td hidden>${task.direccion}</td>
                  <td>${task.fecha_creacion}</td>
                  <td>${task.cargo}</td>
                  <td><a href="#" class="task-item"><span id="icon" class="icon-edit"></span></a></a></td>
                  <td><a href="#"class="task-delete"><span id="icon" class="icon-delete"></span></a></td>
                  </tr>
                `
        });
        $('#tasks').html(template);
        /*-----*/
      }
    });
  }
/*----------------------Fetching Tasks----------------------*/

/*-----------------------solo 1 usuario-----------------------*/
  $(document).on('click', '.task-item', (e) => {
    const element = $(this)[0].activeElement.parentElement.parentElement;
    let id = $(element).attr('taskId');
    if (id===undefined) {
      id='0';
      $('#id_usuarios').val('0');
      $('#dni').val('');
      $('#nombres').val('');
      $('#apellidos').val('');
      $('#password').val('');
      $('#correo').val('');
      $('#telefono').val('');
      $('#direccion').val('');
    } else {
      $.post('include/usuarios/usuario_elegido.php', {id}, (response) => {
      const task = JSON.parse(response);
      $('#id_usuarios').val(task.id_usuarios);
      $('#dni').val(task.dni);
      $('#nombres').val(task.nombres);
      $('#apellidos').val(task.apellidos);
      $('#password').val(task.password);
      $('#correo').val(task.correo);
      $('#telefono').val(task.telefono);
      $('#direccion').val(task.direccion);
      edit = true;
      console.log(task);
    });
    }    
    e.preventDefault();
    modal.classList.toggle("modal--open");
  });
/*-----------------------solo 1 usuario-----------------------*/

/*-------------------------eliminar-------------------------*/
  $(document).on('click', '.task-delete', (e) => {
    if(confirm('¿Esta segur@ que desea eliminar el usuario?')) {
      alert("El usuario elegido fue eliminado");
      const element = $(this)[0].activeElement.parentElement.parentElement;
      const id = $(element).attr('taskId');
      console.log(element);
      $.post('include/usuarios/usuario_eliminar.php', {id}, (response) => {
        fetchTasks();
      });
    } else {
      alert("El usuario elegido no fue eliminado")
    }
  });
/*-------------------------eliminar-------------------------*/


});