<?php
require_once 'Conexao.php';
class Formulario extends Conexao {
    private $nome;
    private $email;

   
    public function setNome($nome) {
        $this->nome = $nome;
    }

    
    public function getNome() {
        return $this->nome;
    }

   
    public function setEmail($email) {
        $this->email = $email;
    }

    public function getEmail() {
        return $this->email;
    }



    public function salvar($nome, $email) {
    $sql = "INSERT INTO teste (nome, email, mensagem) VALUES (:nome,:email)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':nome', $this->nome);
    $stmt->bindParam(':email', $this->email);
    return $stmt->execute([$nome, $email, $mensagem]);
  }
}