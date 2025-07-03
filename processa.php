<?php

require __DIR__ . '/vendor/autoload.php';
require 'Formulario.php';

$formulario = new Formulario();

$nome = isset($_POST['nome']) ? $_POST['nome'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$acao = isset($_POST['acao']) ? $_POST['acao'] : '';

if ($acao == 'salvar') {
  if ($formulario->salvar($nome, $email)) {
    echo "Registro salvo!";
  } else {
    echo "Erro ao salvar.";
  }
}

if ($acao == 'pdf') {
  $mpdf = new \Mpdf\Mpdf();

  $html = "
    <h1>Dados do Formulário</h1>
    <strong>Nome:</strong> $nome<br>
    <strong>Email:</strong> $email<br>
  ";

  $mpdf->WriteHTML($html);
  $mpdf->Output('formulario.pdf', 'I');
}
?>
