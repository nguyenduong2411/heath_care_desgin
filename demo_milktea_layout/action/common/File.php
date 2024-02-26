<?php

/** do */
function getFileContent($filePath)
{
    $fileContents = file_get_contents($filePath);

    // kiểm tra phát sinh lỗi khi thực hiện đọc file sql
    if (!$fileContents) {
        throw new Exception("Lỗi! Phát sinh khi thực hiện đọc file");
    }

    // Kiểm tra nội dung trong file có bị trống
    if (strlen($fileContents) == 0) {
        throw new Exception("Nội dung của file trống");
    }
    return $fileContents;
}