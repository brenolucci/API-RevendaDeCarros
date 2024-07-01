<?php
require_once (realpath(dirname(__FILE__) . '/../../') . '/vendor/autoload.php');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-Type: application/json');

use RevendaTeste\Models\Versoes;
use RevendaTeste\Models\OpcionaisVersoes;
use RevendaTeste\Requests\VersaoOpcionaisRequest;

define('DS', DIRECTORY_SEPARATOR);
define('FILES_DIR', realpath(dirname(__FILE__) . '/../../') . DS . 'files' . DS);

$response = ['status' => 'error', 'message' => ''];
try {
    $data = $_POST;

    $versoes = new Versoes();
    $versao = $versoes->cadastraVersao($data);

    //Converte a string de opcionais $data['opcionais'] em um array de int.
    $opcoes = explode(',', $data['opcionais']);
    $opcionais = array_map('intval', $opcoes);

    // var_dump($versao->getId());
    // var_dump($opcionais);
    // die;
    //Cadastra opcionais - injetando o id da versão e os opcionais.
    $validatedData = (new VersaoOpcionaisRequest($opcionais, $versao->getId()));

    $opcionais = new OpcionaisVersoes();
    $versaoOpcional = $opcionais->cadastraOpcionalVersao($validatedData);

    // Converter os objetos internos da collection para array
    foreach ($versaoOpcional as $umOpcional => $opcional) {
        $versaoOpcional[$umOpcional] = $opcionais->toArray($opcional);
    }

    // $statusCode = 201;
    // $result = [
    //     'message' => 'Dados Cadastrados com sucesso!',
    //     'data' => $versoes->toArray($versao),
    // ];

    //@todo Cadastrar iamgens - injetando o código da versão
    if (!empty($_FILES['files'])):
        foreach ($_FILES['files']['tmp_name'] as $key => $tmpName):
            if (!is_uploaded_file($tmpName)):
                throw new Exception('Arquivo inválido para upload: ' . error_get_last());
            endif;

            $extensao = strtolower(pathinfo($_FILES['files']['name'][$key], PATHINFO_EXTENSION));
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
                    if (mkdir($dir, 0775, true) === false):
                        throw new Exception("Falha criando o diretório {$dir} no servidor!");
                    endif;
                endif;
            endforeach;

            $newName = uniqid(time()) . '.' . $extensao;
            if (move_uploaded_file($tmpName, $dir . $newName) === false):
                throw new Exception("Falha movendo o arquivo {$_FILES['files']['name'][$key]} para o servidor com o novo nome {$newName}!");
            endif;
        endforeach;

        $response['status'] = 'ok';
        $response['message'] = 'Arquivos enviados com sucesso!';
        // $response['post_data'] = print_r($_POST, 1);
    else:
        $response['message'] = 'Nenhum arquivo enviado!';
    endif;
} catch (\Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
