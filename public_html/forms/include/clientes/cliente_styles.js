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

  miFormulario = document.querySelector('#cliente-form');
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
        url: 'include/clientes/cliente_buscar.php',
        data: {search},
        type: 'POST',
        success: function (response) {
          console.log(response);
          if(!response.error) {
            let tasks = JSON.parse(response);
            let template = '';
            tasks.forEach(task => {
              template += `
                  <tr taskId="${task.id_clientes}">
                  <td hidden>${task.id_clientes}</td>
                  <td>${task.documento}</td>
                  <td>${task.razon_social}</td>
                  <td>${task.correo}</td>
                  <td>${task.telefono}</td>
                  <td>${task.direccion}</td>
                  <td>${task.fecha_creacion}</td>
                  <td><a href="#" class="task-item"><span id="icon" class="icon-edit"></span></a></a></td>
                  <td><a href="#"class="task-delete"><span id="icon" class="icon-delete"></span></a></td>
                  </tr>
                `
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
  $('#cliente-form').submit(function(e) {
    const postData = {
      id_clientes: $('#id_clientes').val(),
      razon_social: $('#razon_social').val(),
      documento: $('#documento').val(),
      telefono: $('#telefono').val(),
      direccion: $('#direccion').val(),
      correo: $('#correo').val()
    };
    const url = edit === false ? 'include/clientes/cliente_nuevo.php' : 'include/clientes/cliente_edit.php';
    console.log(postData, url);
    $.post(url, postData, (response) => {
    $('#alert').html(response);
    $('#cliente-form').trigger('reset');
    fetchTasks();
    modal.classList.toggle("modal--open");
    });    
    e.preventDefault();
  });
  /*-----------------------guardar-editar-----------------------*/

/*----------------------Fetching Tasks----------------------*/
  function fetchTasks() {
    $.ajax({
      url: 'include/clientes/cliente_listar.php',
      type: 'GET',
      success: function(response) {
        const tasks = JSON.parse(response);
        let template = '';
        tasks.forEach(task => {
          template += `
                  <tr taskId="${task.id_clientes}">
                  <td hidden>${task.id_clientes}</td>
                  <td>${task.documento}</td>
                  <td>${task.razon_social}</td>
                  <td>${task.correo}</td>
                  <td>${task.telefono}</td>
                  <td>${task.direccion}</td>
                  <td>${task.fecha_creacion}</td>
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
      $('#id_clientes').val('0');
      $('#razon_social').val('');
      $('#documento').val('');
      $('#correo').val('');
      $('#telefono').val('');
      $('#direccion').val('');
    } else {
      $.post('include/clientes/cliente_elegido.php', {id}, (response) => {
      const task = JSON.parse(response);
      $('#id_clientes').val(task.id_clientes);
      $('#razon_social').val(task.razon_social);
      $('#documento').val(task.documento);
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
      $.post('include/clientes/cliente_eliminar.php', {id}, (response) => {
        fetchTasks();
      });
    } else {
      alert("El usuario elegido no fue eliminado")
    }
  });
/*-------------------------eliminar-------------------------*/


});