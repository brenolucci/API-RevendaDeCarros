<?php
require_once (realpath(dirname(__FILE__) . '/../../') . '/vendor/autoload.php');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-Type: application/json');

use \RevendaTeste\Models\Modelos;
use \RevendaTeste\Models\Versoes;

define('DS', DIRECTORY_SEPARATOR);
define('FILES_DIR', realpath(dirname(__FILE__) . '/../') . DS . 'files' . DS);

$response = ['status' => 'error', 'message' => ''];
try {
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

        $response['status'] = 'success';
        $response['message'] = 'Arquivos enviados para o servidor com sucesso!';
    else:
        $response['message'] = 'Nenhum arquivo enviado!';
    endif;
} catch (\Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
