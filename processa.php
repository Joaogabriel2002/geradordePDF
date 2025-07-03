<?php

require __DIR__ . '/vendor/autoload.php';
require 'Formulario.php';

$formulario = new Formulario();

// Captura variáveis do POST
$acao       = isset($_POST['acao']) ? $_POST['acao'] : '';
$nome       = isset($_POST['nome']) ? $_POST['nome'] : '';
$email      = isset($_POST['email']) ? $_POST['email'] : '';
$codigo     = isset($_POST['codigo']) ? $_POST['codigo'] : '';
$descricao  = isset($_POST['descricao']) ? $_POST['descricao'] : '';
$quantidade = isset($_POST['quantidade']) ? $_POST['quantidade'] : '';
$lote       = isset($_POST['lote']) ? $_POST['lote'] : '';
$paletes    = isset($_POST['paletes']) ? $_POST['paletes'] : '';

// Se ação for salvar
if ($acao == 'salvar') {
    if ($formulario->salvar($nome, $email)) {
        echo "Registro salvo!";
    } else {
        echo "Erro ao salvar.";
    }
}

// Se ação for gerar PDF
if ($acao == 'pdf') {
    $mpdf = new \Mpdf\Mpdf([
        'format'      => 'A4',
        'orientation' => 'L'
    ]);

    // Monta a linha da tabela com os campos individuais
    $linhasTabela = "
    <tr>
        <td>1</td>
        <td>" . htmlspecialchars($descricao) . "</td>
        <td>" . htmlspecialchars($quantidade) . "</td>
        <td>" . htmlspecialchars($lote) . "</td>
        <td>" . htmlspecialchars($paletes) . "</td>
    </tr>
    ";

    // HTML do PDF
    $html = '
    <!DOCTYPE html>
    <html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <title>Ficha de Transbordo Interno</title>
        <style>
            body { font-family: sans-serif; font-size: 12px; }
            header { text-align: center; margin-bottom: 20px; }
            header img { max-height: 80px; }
            h1 { margin: 0; }
            .ficha-info { margin-bottom: 20px; }
            .ficha-info div { margin: 5px 0; }
            table { width: 100%; border-collapse: collapse; }
            th, td { border: 1px solid #000; padding: 6px; text-align: center; }
            th { background-color: #ddd; }
        </style>
    </head>
    <body>

    <header>
        <img src="logo.png" alt="Logo">
        <h1>Ficha de Transbordo Interno</h1>
    </header>

    <section class="ficha-info">
        <div><strong>Ficha Nº:</strong> 00001</div>
        <div><strong>Data:</strong> ' . date("d/m/Y") . '</div>
        <div><strong>Nome:</strong> ' . htmlspecialchars($nome) . '</div>
        <div><strong>Email:</strong> ' . htmlspecialchars($email) . '</div>
        <div><strong>Obs:</strong> —</div>
    </section>

    <table>
        <thead>
            <tr>
                <th>Item</th>
                <th>Descrição</th>
                <th>Quantidade</th>
                <th>Lote</th>
                <th>Paletes</th>
            </tr>
        </thead>
        <tbody>
            ' . $linhasTabela . '
        </tbody>
    </table>

    </body>
    </html>
    ';

    // Gera e exibe o PDF
    $mpdf->WriteHTML($html);
    $mpdf->Output('ficha_transbordo.pdf', 'I');
}

?>
