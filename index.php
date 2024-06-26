<?php
$acao = 'recuperar_pendente';
require 'tarefa_controller_public.php';
?>

<script>

function editar(id, txt_tarefa) {
			//Criar um form para editar
			let form = document.createElement('form')
			form.action = 'index.php?pag=index&acao=atualizar'
			form.method = 'post'
			form.className = 'row'
			// Criar um input para entrada de texto
			let inputTarefa = document.createElement('input')
			inputTarefa.type = 'text'
			inputTarefa.name = 'tarefa'
			inputTarefa.className = 'col-9 form-control'
			inputTarefa.value = txt_tarefa

			//criar um input hidden para guardar o id da tarefa
			let inputId = document.createElement('input')
			inputId.type = 'hidden'
			inputId.name = 'id'
			inputId.value = id


			//criar um button para envio do form
			let button = document.createElement('button')
			button.type = 'submit'
			button.className = 'col-3 btn btn-info'
			button.innerHTML = 'Atualizar'

			//incluir inputTarefa no form
			form.appendChild(inputTarefa)
			//incluir inputID no form
			form.appendChild(inputId)
			//incluir button no form
			form.appendChild(button)


			console.log(form)
			//selecionar a div tarefa com o id
			let tarefa = document.getElementById('tarefa_'+id)
			//limpar o texto da tarefa para inclusaoi do form
			tarefa.innerHTML= ""

			//incluir form na pagina
			tarefa.insertBefore(form, tarefa[0])

			// alert(txt_tarefa)
		}

		function remover(id){
			location.href = 'index.php?pag=index&acao=remover&id='+id;

		}

		function realizado(id, id_status){

			location.href = 'index.php?pag=index&acao=realizado&id='+id;

		}


</script>


<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>App Lista Tarefas</title>

		<link rel="stylesheet" href="css/estilo.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	</head>

	<body>
		<nav class="navbar navbar-light bg-light">
			<div class="container">
				<a class="navbar-brand" href="#">
					<img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
					App Lista Tarefas
				</a>
			</div>
		</nav>
		<?php if (isset($_GET['delete']) && $_GET['delete'] == 1) {?>
    	<div class="bg-danger pt-2 text-white d-flex justify-content-center">
        	<h5>Tarefa deletada com sucesso!</h5>
    	</div>
		<?php } else if (isset($_GET['realizada']) && $_GET['realizada'] == 1) {?>
		<div class="bg-success pt-2 text-white d-flex justify-content-center">
			<h5>Tarefa alterada para realizada com sucesso!</h5>
		</div>
		<?php }?>

		<div class="container app">
			<div class="row">
				<div class="col-md-3 menu">
					<ul class="list-group">
						<li class="list-group-item active"><a href="#">Tarefas pendentes</a></li>
						<li class="list-group-item"><a href="nova_tarefa.php">Nova tarefa</a></li>
						<li class="list-group-item"><a href="todas_tarefas.php">Todas tarefas</a></li>
					</ul>
				</div>

				<div class="col-md-9">
					<div class="container pagina">
						<div class="row">
							<div class="col">
								<h4>Tarefas pendentes</h4>
								<hr />
								<?php foreach ($tarefas as $indice => $tarefa) {?>
								<div class="row mb-3 d-flex align-items-center tarefa">
									<div class="col-sm-9" id="tarefa_<?=$tarefa->id?>"> <?=$tarefa->tarefa;?> (<?=$tarefa->status;?>)</div>
									<div class="col-sm-3 mt-2 d-flex justify-content-between">
									<i class="fas fa-trash-alt fa-lg text-danger" onclick="remover(<?=$tarefa->id?>)"></i>
									<i class="fas fa-edit fa-lg text-info"onclick="editar(<?=$tarefa->id?>, '<?=$tarefa->tarefa?>')"></i>
									<i class="fas fa-check-square fa-lg text-success" onclick="realizado(<?=$tarefa->id?>)"></i>
									</div>
								</div>
									<?php }?>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
