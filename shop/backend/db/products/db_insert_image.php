<?php
function subirImagenPNG($fileInput) {
    if (isset($fileInput) && $fileInput['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $fileInput['tmp_name'];
        $fileName = $fileInput['name'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if ($fileExtension !== 'png') {
            return false; // Solo PNG
        }

        $uploadDir = __DIR__ . '/../../uploads/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
        $destPath = $uploadDir . $newFileName;

        if (move_uploaded_file($fileTmpPath, $destPath)) {
            return 'uploads/' . $newFileName;
        }
    }
    return false;
}
?>
