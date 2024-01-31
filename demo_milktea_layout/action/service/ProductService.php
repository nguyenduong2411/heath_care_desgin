<?php

namespace action\service;

include($_SERVER['DOCUMENT_ROOT'] . '/milktea/action/common/Query.php');

use action\common\Query;

class ProductService
{
    public $query;
    public function __construct()
    {
        $this->query = new Query();
    }

    /**
     * Get sản phẩm đối tượng bằng ID
     * 
     * @param string $sqlFilePath đường dẫn đến file SQL
     * @param array $sqlParams danh sách chứa ID của sản phẩm đối tượng
     * @return array danh sách thông tin của sản phẩm
     */
    public function GetProductById(string $sqlFilePath, array $sqlParams = [])
    {
        return $this->query->doSelect($sqlFilePath, $sqlParams);
    }
}
