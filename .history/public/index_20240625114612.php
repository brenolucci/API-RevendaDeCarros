<?php
require_once (realpath(dirname(__FILE__) . '/../') . '/vendor/autoload.php');

use \RevendaTeste\Models\Modelos;
use \RevendaTeste\Models\Versoes;

define('DS', DIRECTORY_SEPARATOR);
define('FILES_DIR', realpath(dirname(__FILE__) . '/../') . DS . 'files' . DS);

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

<?php
$msg = '';
try {
    if (!empty($_FILES['arquivo'])):
        // echo '<pre>';
        // print_r($_FILES['arquivo']);
        // echo '</pre>';
        // echo FILES_DIR;
        // die;

        if (!is_uploaded_file($_FILES['arquivo']['tmp_name'])):
            throw new Exception('Arquivo inválido para upload: ' . error_get_last());
        endif;

        $extensao = strtolower(pathinfo($_FILES['arquivo']['name'], PATHINFO_EXTENSION));
        if (!in_array($extensao, ['jpg', 'jpeg', 'webp', 'png', 'gif', 'tiff'])):
            throw new Exception('Formato de arquivo inválido!');
        endif;

        $created = new \DateTime();
        $filepath = [
            FILES_DIR,
            $created->format('Y') . DS,
            $created->format('m') . DS
        ];

        $dir = '';
        foreach ($filepath as $index => $path):
            $dir .= $path;

            if (file_exists($dir) === false):
                if (mkdir($dir, 0775) === false):
                    throw new Exception("Falha criando o diretório {$dir} no servidor!");
                endif;
            endif;
        endforeach;

        $newName = uniqid(time()) . '.' . $extensao;
        if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $dir . $newName) === false):
            throw new Exception("Falha movendo o arquivo {$_FILES['arquivo']['name']} o servidor com o novo nome {$newName}!");
        endif;

        if (unlink($dir . $newName) === false):
            throw new Exception("Falha removendo o arquivo {$newName} do servidor!");
        endif;

        $msg = 'Arquivo enviado para o servidor com sucesso!';
    endif;
} catch (\Exception $e) {
    $msg = $e->getMessage();
}

if (!empty($msg)):
    ?>
    <div><strong><?= $msg ?></strong></div>
<?php endif; ?>
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
    <div>
        <label for="arquivo">Selecione o arquivo para upload</label>
        <input type="file" name="arquivo" id="arquivo" />
    </div>
    <div>
        <button type="submit">Enviar arquivo</button>
    </div>
</form>