<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST["action"])) {

    switch ($_POST["action"]) {

        case 'insert':

            $photos = $_POST['photos'];
            $pathFolder = $_POST['pathFolder'];

			$strMessage = "";
			$success = 0;
			$pathsFiles = [];

            foreach ($photos as $photo) {

                $name = $photo['name'];
                $imageBase64 = $photo['image'];

				list($type, $imageBase64) = explode(';', $imageBase64);
				list($base, $imageBase64) = explode(',', $imageBase64);
				$imageBase64 = base64_decode($imageBase64);

				$pathFile = $pathFolder."/".$name.".jpg";
				$result = file_put_contents($pathFile, $imageBase64);

				// echo "Resultado $result \r";

				if ($result) {
					$success==0?$success=1:'';
					array_push($pathsFiles, array('name' => $name, 'pathFile' => $pathFile));
				} else {
					$success==1?$success=2:'';
					
					$strMessage .= $strMessage==""?"":"\n" . "Falha ao salvar o arquivo $name";
					array_push($pathsFiles, array('name' => $name, 'pathFile' => null));
				}
			}

			$res = [
				'success'	=> $success,
				'message'	=> $strMessage,
				'paths'		=> $pathsFiles
			];

            break;
    }

} else {
    $res = ["error" => "Ação não encontrada"];
}
	echo json_encode($res);
?>
