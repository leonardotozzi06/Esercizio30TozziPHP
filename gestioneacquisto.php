<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $codicefiscale = $_POST['codicefiscale'];
    $settore = $_POST['settore'];
    $codicesconto = $_POST['codicesconto'] ?? '';
    $num_biglietti = $_POST['num_biglietti'] ?? 1;

    $prezzi = [
        'curva' => 30,
        'tribuna_centrale' => 80,
        'tribuna_donore' => 120
    ];

    $totale = $prezzi[$settore] * $num_biglietti;

    if ($codicesconto === 'FIRENZE5') {
        $sconto = $totale * 0.05;
        $totale -= $sconto;
        $scontoText = "Sconto applicato: 5%";
    } else {
        $scontoText = "Codice inesistente";
    }

    $data_ora = date('Y-m-d H:i:s');
    
    echo "<h1>Dettagli Acquisto</h1>";
    echo "<p><strong>Nome:</strong> $nome</p>";
    echo "<p><strong>Cognome:</strong> $cognome</p>";
    echo "<p><strong>Codice Fiscale:</strong> $codicefiscale</p>";
    echo "<p><strong>Settore:</strong> $settore</p>";
    echo "<p><strong>Data e Ora Acquisto:</strong> $data_ora</p>";
    echo "<p><strong>Numero Biglietti:</strong> $num_biglietti</p>";
    
    if ($num_biglietti > 1) {
        echo "<p><strong>Biglietti Aggiuntivi:</strong></p>";
        for ($i = 1; $i <= $num_biglietti - 1; $i++) {
            echo "<p>Codice Fiscale Aggiuntivo: " . $_POST["agg$i"] . "</p>";
        }
    }
    
    echo "<p><strong>Totale da pagare:</strong> €" . number_format($totale, 2) . "</p>";
    if (isset($scontoText)) {
        echo "<p><strong>$scontoText</strong></p>";
    }
}
?>
