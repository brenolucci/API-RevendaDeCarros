<?php
require_once (realpath(dirname(__FILE__) . '/../') . '/vendor/autoload.php');

use \RevendaTeste\Models\Modelos;
use \RevendaTeste\Models\Versoes;

$listaDeModelos = (new Modelos())->buscarModelos();
$listaDeVersoes = (new Versoes())->buscaVersoes();
?>

<ul>
    <?php foreach ($listaDeVersoes as $versao): ?>
        <li><?= $versao->getId() . ' | ' . $versao->getModelo()->getNome() . ' | ' . $versao->getNome() . ' | ' . $versao->getAno() . '/' . $versao->getAnoModelo() . ' | ' . 'R$' . $versao->getPreco() . ',00' . ' | ' . $versao->getQuilometragem() . ' km' . ' | ' . $versao->getLocalizacao() . ' | ' . $versao->getCombustivel()->getNome() ?>
        </li>
    <?php endforeach; ?>
</ul>

<hr>

<?php if (!empty($_POST)) :?>
<?php if (!empty($_POST)) :?>
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
    <label for="arquivo">Selecione o arquivo para upload</label>
    <input type="file" name="arquivo" id="arquivo" />
</form>