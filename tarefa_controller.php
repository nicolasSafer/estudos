<?php

require "../../../../../app_tarefas/tarefa.model.php";
require "../../../../../app_tarefas/tarefa.service.php";
require "../../../../../app_tarefas/conexao.php";

//variavel $acao(controller) vai verificar e receber se tem algum valor na global GET(URL) se não  ele vai receber a variavel $acao(todas_tarefas.php);
$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

// se tiver o valor inserir na URL/_GET vai iniciar o código de insert
if (isset($_GET['acao']) && $_GET['acao'] == 'inserir') {
//criando a instancia Tarefa para acessar a $tarefa e utilizar o metodo __set para inserir um valor
    $tarefa = new Tarefa();
    $tarefa->__set('tarefa', $_POST['tarefa']); //foi pro model
//criando a instancia de conexão para realizar a verificação de conexão do banco
    $conexao = new Conexao();
//criando a instancia de tarefaService que é responsável pelo CRUD do projeto e passando a $conexao(conexao.php) e $tarefa(tarefa.model.php) para o __construct
    $tarefaService = new TarefaService($conexao, $tarefa);
    $tarefaService->insert();
    header('Location: nova_tarefa.php?inclusao=1');
} // no evento onclick ou post é passado a variavel $acao com um valor para realizar as verificação do tipo de CRUD
else if ($acao == 'recuperar') {
    $tarefa = new Tarefa();
    $conexao = new Conexao();

    $tarefaService = new TarefaService($conexao, $tarefa);
    $tarefas = $tarefaService->read();
} else if ($acao == 'recuperar_pendente') {
    $tarefa = new Tarefa();
    $tarefa->__set('id_status', 1);
    $conexao = new Conexao();

    $tarefaService = new TarefaService($conexao, $tarefa);
    $tarefas = $tarefaService->readPendentes();
} else if ($acao == 'atualizar') {
    $tarefa = new Tarefa();
    $tarefa->__set('id', $_POST['id']);
    $tarefa->__set('tarefa', $_POST['tarefa']);
    $conexao = new Conexao();

    $tarefaService = new TarefaService($conexao, $tarefa);
    $tarefaService->update();
        if (isset($_GET['pag']) && $_GET['pag'] == 'index') {
            header('Location: index.php');
        } else {
            header('Location: todas_tarefas.php');
        }

} else if ($acao == 'remover') {

    $tarefa = new Tarefa();
    $tarefa->__set('id', $_GET['id']);
    $conexao = new Conexao();

    $tarefaService = new TarefaService($conexao, $tarefa);
    $tarefaService->delete();
    if (isset($_GET['pag']) && $_GET['pag'] == 'index') {
        header('Location: index.php?delete=1');
    } else {
        header('Location: todas_tarefas.php?delete=1');
    }

} else if ($acao == 'realizado') {

    $tarefa = new Tarefa();
    $tarefa->__set('id', $_GET['id'])->__set('id_status', 2);
    $conexao = new Conexao();

    $tarefaService = new TarefaService($conexao, $tarefa);
    $tarefaService->updateRealizado();
        if (isset($_GET['pag']) && $_GET['pag'] == 'index') {
            header('Location: index.php?realizada=1');
        } else {
            header('Location: todas_tarefas.php?realizada=1');
        }

}
