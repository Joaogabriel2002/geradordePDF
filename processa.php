<?php

require __DIR__ . '/vendor/autoload.php';
require 'Formulario.php';

$formulario = new Formulario();



$acao       = isset($_POST['acao']) ? $_POST['acao'] : '';
$codigo     = isset($_POST['codigo']) ? $_POST['codigo'] : '';
$descricao  = isset($_POST['descricao']) ? $_POST['descricao'] : '';
$quantidade = isset($_POST['quantidade']) ? $_POST['quantidade'] : '';
$lote       = isset($_POST['lote']) ? $_POST['lote'] : '';
$paletes    = isset($_POST['paletes']) ? $_POST['paletes'] : '';

$formulario->setCodigo($codigo);
$formulario->setDescricao($descricao);
$formulario->setQuantidade($quantidade);
$formulario->setLote($lote);
$formulario->setOutros($paletes);  
$formulario->setObservacao('');
$formulario->setUsuarioId(20); 
$ultimoId = $formulario->salvar($codigo,$descricao,$quantidade,$lote,$paletes);
if ($ultimoId) {
    echo "Registro salvo! ID: " . $ultimoId;
} else {
    echo "Erro ao salvar.";
}





if ($acao == 'salvar') {
    if ($formulario->salvar($codigo,$descricao,$quantidade,$lote,$paletes)) {
        echo "Registro salvo!";
    } else {
        echo "Erro ao salvar.";
    }
}


if ($acao == 'pdf') {
    $mpdf = new \Mpdf\Mpdf([
        'format'      => 'A4',
        'orientation' => 'L'
    ]);

    // Monta a linha da tabela com os campos individuais
    $linhasTabela = "
    <tr>

        <td>" . htmlspecialchars($codigo) . "</td>
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
        <div><strong>Ficha Nº:</strong> ' . htmlspecialchars($ultimoId) . '</div>
        <div><strong>Data:</strong> ' . date("d/m/Y") . '</div>
        <div><strong>Obs:</strong> —</div>
    </section>

    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Descrição</th>
                <th>Quantidade</th>
                <th>Lote</th>
                <th>Paletes</th>
            </tr>
        </thead>
        <tbody>
            ' . $linhasTabela. '
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
