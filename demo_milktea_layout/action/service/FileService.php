<?php

namespace action\service;

class FileService
{
    public function __construct()
    {
    }

    /**
     * parse file ini trong thư mục setting
     * 
     * @param string $fileName tên file setting
     * @return array danh sách tham số
     */
    public function parseFilelIni($fileName)
    {
        return parse_ini_file($_SERVER['DOCUMENT_ROOT'] . '/milktea/setting/' . $fileName, true);
    }
}
