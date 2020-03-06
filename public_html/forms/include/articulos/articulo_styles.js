$(document).ready(function(e) {
  // Global Settings
  let edit = false;
  //console.log('jquery is working!');
  fetchTasks();
  $('#task-result').hide();
  $('#task-form').submit(submit);

  miFormulario = document.querySelector('#task-form');
  miFormulario.stock.addEventListener('keypress', mandarNumero);
  miFormulario.precio.addEventListener('keypress', mandarNumero);

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

  $("#imagen").on("change",function(e){
    var nombre = e.target.value.split('\\').pop();
    $("#lbl_span").text(nombre);
    //console.log(nombre);
  })

  function submit(event){
  	event.preventDefault();
  	const url = edit === false ? 'include/articulos/articulo_nuevo.php' : 'include/articulos/articulo_edit.php';
  	var datos = new FormData($("#task-form")[0]);
  	$.ajax({
  		url: url,
  		type: 'POST',
  		data: datos,
  		contentType: false,
  		processData: false,
  		success: function(datos){
		    $('#alert').html(datos)
		    $('#task-form').trigger('reset');
		   	fetchTasks();
        modal.classList.toggle("modal--open");
  		}
  	})
  }
  // search key type event
  $('#search').keyup(function() {
    if($('#search').val()) {
      let search = $('#search').val();
      $.ajax({
        url: 'include/articulos/articulo_buscar.php',
        data: {search},
        type: 'POST',
        success: function (response) {
          if(!response.error) {
            let tasks = JSON.parse(response);
            let template = '';
            tasks.forEach(task => {
              template += `
                  <tr taskId="${task.id_articulo}">
                  <td hidden>${task.id_articulo}</td>
                  <td>
                    ${task.articulo} 
                  </td>
                  <td>${task.categoria}</td>
                  <td>${task.descripcion}</td>
                  <td>${task.precio}</td>
                  <td>${task.stock}</td>
                  <td><img class="foto_art" src="../img/articulos/${task.foto}"></td>
	              <td><a href="#" class="task-item"><span id="icon" class="icon-edit"></span></a></a></td>
	              <td><a class="task-delete"><span id="icon" class="icon-delete"></span></a></td>
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

  // Fetching Tasks
  function fetchTasks() {
    $.ajax({
      url: 'include/articulos/articulo_listar.php',
      type: 'GET',
      success: function(response) {
        const tasks = JSON.parse(response);
        //console.log(response);
        let template = '';
        tasks.forEach(task => {
          template += `
                  <tr taskId="${task.id_articulo}">
                  <td hidden>${task.id_articulo}</td>
                  <td>
                  <a>
                    ${task.articulo} 
                  </a>
                  </td>
                  <td>${task.categoria}</td>
                  <td>${task.descripcion}</td>
                  <td>${task.precio}</td>
                  <td>${task.stock}</td>
                  <td><img class="foto_art" src="../img/articulos/${task.foto}"></td>
	              <td><a href="#" class="task-item"><span id="icon" class="icon-edit"></span></a></a></td>
	              <td><a href="#" class="task-delete"><span id="icon" class="icon-delete"></span></a></td>
                  </tr>
                `
        });
        $('#tasks').html(template);
        /*-----*/
      }
    });
  }
  let modal = document.querySelector('#modal');
  let boton = document.querySelector('#modal__boton');
  boton.addEventListener('click', function(){
  modal.classList.toggle("modal--open");
  });

  // Get a Single Task by Id 
  $(document).on('click', '.task-item', (e) => {
    const element = $(this)[0].activeElement.parentElement.parentElement;
    let id = $(element).attr('taskId');
    if (id===undefined) {
      id='0';
      $('#id_articulo').val('0');
      $('#articulo').val('');
      $('#descripcion').val('');
      $('#stock').val('');
      $('#precio').val('');
    } else {
      $.post('include/articulos/articulo_elegido.php', {id}, (response) => {
      const task = JSON.parse(response);
      $('#id_articulo').val(task.id_articulo);
      $('#articulo').val(task.articulo);
      $('#descripcion').val(task.descripcion);
      $('#stock').val(task.stock);
      $('#precio').val(task.precio);
      edit = true;
      console.log(task);
    });
    }
    console.log(id);    
    
    e.preventDefault();
    $("#lbl_span").text('Elige una imagen');
    modal.classList.toggle("modal--open");
  });

  // Delete a Single Task
  $(document).on('click', '.task-delete', (e) => {
    if(confirm('¿Esta segur@ que desea eliminar el artículo?')) {
      alert("El artículo elegido fue eliminado");
      const element = $(this)[0].activeElement.parentElement.parentElement;
      const id = $(element).attr('taskId');
      $.post('include/articulos/articulo_eliminar.php', {id}, (response) => {
        fetchTasks();
      });
    } else {
      alert("El artículo elegido no fue eliminado")
    }
  });
});