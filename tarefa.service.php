<?php

class TarefaService
{
//criando as variaveis de conexao e tarefas que serão recebidas em tarefa_controller.php
    private $conexao;
    private $log;
    //criando uma function construct para verificar e acessar as váriaveis recebidas dentro dos metodos respectivos de cada um. (n entendi nada teno q rever aula 474 . App lista de tasrefas inserindo registro)
    //Precisa receber uma instancia de conexão e Tarefa obrigatóriamente
    public function __construct(Conexao $conexao, Tarefa $tarefa)
    {
        //variavel conexao da tarefa.service está recebendo a $conexao de tarefa_controller.php que está acessando o metodo conectar dentro de conexao.php retornando o link de conexao
        $this->conexao = $conexao->conectar();
        $this->tarefa = $tarefa;
    }

    public function insert()
    {
        // $this->tarefa->__get('tarefa'): Aqui está sendo obtido o valor do atributo 'tarefa' do objeto 'Tarefa'. Este valor será substituído no lugar do parâmetro '
        // ' na consulta SQL. O método __get('tarefa') é usado para acessar o valor do atributo 'tarefa' da classe Tarefa.
        $query = 'insert into tb_tarefas(tarefa) values (:tarefa)';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':tarefa', $this->tarefa->__get('tarefa'));
        $stmt->execute();

    }

    public function read()
    {
        $query = '
            select 
                tb_tarefas.id, 
                tarefa, 
                tb_status.status 
            from 
                tb_tarefas 
            left join 
                tb_status on tb_tarefas.id_status = tb_status.id';
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);

    }
    public function readPendentes()
    {
        $query = '
            select 
                tb_tarefas.id, 
                tarefa, 
                tb_status.status 
            from 
                tb_tarefas 
            left join 
                tb_status on tb_tarefas.id_status = tb_status.id
            where
            tb_tarefas.id_status = :id_status';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':id_status', $this->tarefa->__get('id_status'));
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);

    }

    public function update()
    {
        $query = '
        UPDATE 
           tb_tarefas 
        SET
            tarefa = :tarefa
        WHERE
            id = :id';
    $stmt = $this->conexao->prepare($query);
    $stmt->bindValue(':tarefa', $this->tarefa->__get('tarefa'));
    $stmt->bindValue(':id', $this->tarefa->__get('id'));
    return $stmt->execute();
    }

    public function delete()
    {
        $query = '
        DELETE FROM tb_tarefas WHERE id = :id';
    $stmt = $this->conexao->prepare($query);
    $stmt->bindValue(':id', $this->tarefa->__get('id'));
    return $stmt->execute();
    }

    public function updateRealizado()
    {
        $query = '
        UPDATE 
           tb_tarefas 
        SET
            id_status = :id_status
        WHERE
            id = :id';
    $stmt = $this->conexao->prepare($query);
    $stmt->bindValue(':id_status', $this->tarefa->__get('id_status')) ;
    $stmt->bindValue(':id', $this->tarefa->__get('id'));
    return $stmt->execute();
    }

}
