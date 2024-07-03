<?php
require_once (realpath(dirname(__FILE__) . '/../../') . '/vendor/autoload.php');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-Type: application/json');

use RevendaTeste\Models\Versoes;
use RevendaTeste\Models\OpcionaisVersoes;
use RevendaTeste\Requests\VersaoOpcionaisRequest;
use RevendaTeste\Models\Imagens;
use RevendaTeste\ORM\Database;

define('DS', DIRECTORY_SEPARATOR);
define('FILES_DIR', realpath(dirname(__FILE__) . '/../../') . DS . 'files' . DS);

$response = ['status' => 'error', 'message' => ''];
try {
    $versoes = new Versoes();

    $versoes->beginTransaction();

    $data = $_POST;

    $versao = $versoes->cadastraVersao($data);

    //Converte a string de opcionais $data['opcionais'] em um array de int.
    $opcoes = explode(',', $data['opcionais']);
    $opcionais = array_map('intval', $opcoes);

    //Cadastra opcionais - injetando o id da versão e os opcionais.
    $validatedData = (new VersaoOpcionaisRequest($opcionais, $versao->getId()));

    $opcionais = new OpcionaisVersoes();
    $versaoOpcional = $opcionais->cadastraOpcionalVersao($validatedData);

    // Converter os objetos internos da collection para array
    foreach ($versaoOpcional as $umOpcional => $opcional) {
        $versaoOpcional[$umOpcional] = $opcionais->toArray($opcional);
    }

    // Cadastrar iamgens - injetando o código da versão
    if (empty($_FILES['files'])):
        throw new \InvalidArgumentException('Nenhum arquivo enviado!', 422);
    endif;

    foreach ($_FILES['files']['tmp_name'] as $key => $tmpName):
        if (!is_uploaded_file($tmpName)):
            throw new Exception('Arquivo inválido para upload: ' . error_get_last(), 422);
        endif;

        $extensao = strtolower(pathinfo($_FILES['files']['name'][$key], PATHINFO_EXTENSION));
        if (!in_array($extensao, ['jpg', 'jpeg', 'webp', 'png', 'gif', 'tiff'])):
            throw new Exception('Formato de arquivo inválido!', 422);
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
                if (mkdir($dir, 0775, true) === false):
                    throw new Exception("Falha criando o diretório {$dir} no servidor!", 400);
                endif;
            endif;
        endforeach;

        $newName = uniqid(time()) . '.' . $extensao;
        $imagens = new Imagens;
        $imagem = $imagens->cadastraImagem($versao->getId(), $dir . $newName);

        if (move_uploaded_file($tmpName, $dir . $newName) === false):
            throw new Exception("Falha movendo o arquivo {$_FILES['files']['name'][$key]} para o servidor com o novo nome {$newName}!");
        endif;
    endforeach;

    $versoes->commit();
    $response['status'] = 'ok';
    $response['message'] = 'Versão cadastrada com sucesso!';

} catch (\Exception $e) {
    $versoes->rollback();
    $response['message'] = $e->getMessage();
    http_response_code($e->getCode());
}

echo json_encode($response);
