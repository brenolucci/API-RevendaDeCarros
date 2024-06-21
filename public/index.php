<?php
require_once (realpath(dirname(__FILE__) . '/../') . '/vendor/autoload.php');

use \RevendaTeste\Models\Modelos;

$listaDeModelos = (new Modelos())->buscarModelos();
?>

<ul>
    <?php foreach ($listaDeModelos as $modelo): ?>
        <li><?= $modelo->getId() . ' | ' . $modelo->getNome() . ' | ' . $modelo->getMarca()->getNome() ?></li>
    <?php endforeach; ?>
</ul>