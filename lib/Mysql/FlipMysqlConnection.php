<?php
/**
 * User: anwar@honestmining.com
 * Date: 2019-12-07
 * Time: 12:41
 */

namespace lib\Mysql;

use http\Params;

/**
 * Class FlipMysqlConnection
 */
class FlipMysqlConnection
{

    /**
     * @param array $connection
     * @return \mysqli
     */
    public function connection(array $connection = []) : \mysqli
    {
        $host       = $connection['host'] ?? getenv('MYSQL_HOST');
        $username   = $connection['username'] ?? getenv('MYSQL_USER');
        $password   = $connection['password'] ?? getenv('MYSQL_PASSWORD');
        $database   = $connection['database'] ?? getenv('MYSQL_DATABASE');

        try {
            if (is_null($connection['database'])) $conn = new \mysqli($host, $username, $password);
            else $conn = new \mysqli($host, $username, $password, $database);

            return $conn;
        }
        catch(\Exception $exception)
        {
            echo "Connection failed: " . $exception->getMessage();
        }
    }

    /**
     * @param string $query
     * @param array $connection
     * @return bool|\mysqli_result
     */
    public function exec(string $query, array $connection = [])
    {
        $conn = $this->connection($connection);
        $res = $conn->query($query);
        $conn->close();

        return $res;
    }

    /**
     * @param string $query
     * @param $params
     * @param array $connection
     * @return array|null
     */
    public function execBinding(string $query, $params, array $connection = [])
    {
        $conn = $this->connection($connection);
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $params['value']);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        $stmt->close();
        $conn->close();

        return $data;
    }
}