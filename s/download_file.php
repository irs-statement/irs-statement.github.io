<?php
function getRandomFile() {
    $folderPath = 'download';
    $files = array_diff(scandir($folderPath), ['.', '..']);

    if (empty($files)) {
        return null;
    }

    $files = array_values($files);
    $randomIndex = array_rand($files);
    return $folderPath . '/' . $files[$randomIndex];
}

$selectedFile = getRandomFile();

if ($selectedFile && file_exists($selectedFile)) {
    $fileName = basename($selectedFile);
    $fileSize = filesize($selectedFile);

    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header("Content-Disposition: attachment; filename=\"$fileName\"");
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Content-Length: ' . $fileSize);
    flush();
    readfile($selectedFile);
    exit;
} else {
    echo "No file available for download.";
}
?>
