<?php
if (isset($_POST['submit'])) {
    $targetDirectory = "images/";
    // Verificar si el directorio de destino existe, si no, crearlo
    if (!file_exists($targetDirectory)) {
        mkdir($targetDirectory, 0777, true);
    }
    $targetFile = $targetDirectory . basename($_FILES["file"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Verificar si se ha subido correctamente el archivo
    if (!isset($_FILES["file"]["tmp_name"]) || $_FILES["file"]["tmp_name"] === '') {
        echo "<script type='text/javascript'>
                alert('Hubo un error al subir tu archivo.');
                window.location='../../view/asesor/imagenes.php';
            </script>";
        exit; // Salir del script para evitar errores adicionales
    }

    // Comprobar si el archivo es una imagen real
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if ($check === false) {
        echo  "<script type='text/javascript'>
                alert('El archivo no es una imagen.');
                window.location='../../view/asesor/imagenes.php';
            </script>";
        exit;
    }

    // Comprobar si el archivo ya existe
    if (file_exists($targetFile)) {
        echo  "<script type='text/javascript'>
                alert('El archivo ya existe.');
                window.location='../../view/asesor/imagenes.php';
            </script>";
        exit;
    }

    // Permitir solo ciertos formatos de archivo
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo  "<script type='text/javascript'>
                alert('Solo se permiten archivos JPG, JPEG, PNG y GIF.');
                window.location='../../view/asesor/imagenes.php';
            </script>";
        exit;
    }

    // Intentar mover el archivo al directorio de destino
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
        echo  "<script type='text/javascript'>
                alert('El archivo " . basename($_FILES["file"]["name"]) . " ha sido subido.');
                window.location='../../view/asesor/imagenes.php';
            </script>";
    } else {
        echo  "<script type='text/javascript'>
                alert('Hubo un error al subir tu archivo.');
                window.location='../../view/asesor/imagenes.php';
            </script>";
    }
}
?>
