<?php
namespace action\common;

include('DB.php');
use action\common\DB;

include_once('File.php');

class Query
{
    public function __construct()
    {
    }

    /**
     * Thực thi các SQL: Insert, Update, Delete
     * 
     * @param string $sqlFilePath đường dẫn đến file SQL
     * @param array $params đối số đại cho các giá trị trong câu query
     * @return bool TRUE thành công or FALSE thất bại
     */
    public function doExecute(string $sqlFilePath, array $params = [])
    {
        $result = false;

        try {
            $connect = DB::openConnection();
            $sql = getFileContent($sqlFilePath);

            $stmt = $connect->prepare($sql, [\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY]);

            $connect->beginTransaction();
            $result = $stmt->execute($params);
            $connect->commit();
        } catch (\Exception $exception) {
            $connect->rollBack();
            throw new \Exception($exception->getMessage(), (int)$exception->getCode());
        }

        return $result;
    }

    /**
     * Thực thi SQL: get 1 record
     * 
     * @param string $sqlFilePath đường dẫn đến file SQL
     * @param array $params đối số đại cho các giá trị trong câu query
     * @return array danh sách thông tin của đối tượng
     */
    public function doSelect($sqlFilePath, array $params = [])
    {
        $result = [];

        try {
            $connect = DB::openConnection();
            $sql = getFileContent($sqlFilePath);

            $stmt = $connect->prepare($sql, [\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY]);
            $stmt->execute($params);

            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage(), (int)$exception->getCode());
        }

        return $result;
    }

    /**
     * Thực thi SQL: get nhiều record
     * 
     * @param string $sqlFilePath đường dẫn đến file SQL
     * @param array $params đối số đại cho các giá trị trong câu query
     * @return array danh sách thông tin của đối tượng
     */
    public function doSelectAll($sqlFilePath, array $params = [])
    {
        $result = [];

        try {
            $connect = DB::openConnection();
            $sql = getFileContent($sqlFilePath);

            $stmt = $connect->prepare($sql, [\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY]);
            $stmt->execute($params);

            $result = $stmt->fetchAll();
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage(), (int)$exception->getCode());
        }

        return $result;
    }
}
