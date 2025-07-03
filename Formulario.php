<?php
require_once 'Conexao.php';
class Formulario extends Conexao {
    private $id;
    private $codigo;
    private $data;
    private $descricao;
    private $quantidade;
    private $lote;
    private $outros;
    private $observacao;
    private $usuario_id;

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getData() {
        return $this->data;
    }

    public function getCodigo() {
        return $this->codigo;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function getQuantidade() {
        return $this->quantidade;
    }

    public function getLote() {
        return $this->lote;
    }

    public function getOutros() {
        return $this->outros;
    }

    public function getObservacao() {
        return $this->observacao;
    }

    public function getUsuarioId() {
        return $this->usuario_id;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

     public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
    }

    public function setLote($lote) {
        $this->lote = $lote;
    }

    public function setOutros($outros) {
        $this->outros = $outros;
    }

    public function setObservacao($observacao) {
        $this->observacao = $observacao;
    }

    public function setUsuarioId($usuario_id) {
        $this->usuario_id = $usuario_id;
    }


public function salvar($codigo, $descricao, $quantidade, $lote, $outros) {
    $this->codigo = $codigo;
    $this->descricao = $descricao;
    $this->quantidade = $quantidade;
    $this->lote = $lote;
    $this->outros = $outros;
    $this->observacao = '';
    $this->usuario_id = 1;

    $sql = "INSERT INTO transbordo 
        (codigo, descricao, quantidade, lote, outros, observacao, usuario_id) 
        VALUES 
        (:codigo, :descricao, :quantidade, :lote, :outros, :observacao, :usuario_id)";
        
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':codigo', $this->codigo);
    $stmt->bindParam(':descricao', $this->descricao);
    $stmt->bindParam(':quantidade', $this->quantidade);
    $stmt->bindParam(':lote', $this->lote);
    $stmt->bindParam(':outros', $this->outros);
    $stmt->bindParam(':observacao', $this->observacao);
    $stmt->bindParam(':usuario_id', $this->usuario_id);
    
    if ($stmt->execute()) {
        return $this->conn->lastInsertId();  // Retorna o ID da inserção
    } else {
        return false;
    }
}
}