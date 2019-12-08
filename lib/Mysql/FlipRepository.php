<?php
/**
 * User: anwar@honestmining.com
 * Date: 2019-12-07
 * Time: 13:31
 */

namespace lib\Mysql;

use app\Disbursement\Entity\Model\ModelInterface;

/**
 * Class FlipRepository
 *
 * @package lib\Mysql
 */
abstract class FlipRepository extends FlipMysqlConnection implements FlipRepositoryInterface
{
    protected $model;

    /**
     * @return string
     */
    abstract public function model() : string ;

    /**
     * set object model
     */
    public function setModel()
    {
        $class = $this->model();
        return $this->model = new $class();
    }

    /**
     * @inheritdoc
     */
    public function findBy(string $attribute, string $value) : ?ModelInterface
    {
        $this->setModel();
        $table = $this->model->table;
        $query = "select * from $table where $attribute = ?";
        $data =  $this->execBinding($query, [
            'value'     => $value
        ],[
            'database'  => $this->model->database ?? getenv('MYSQL_DATABASE')
        ]);

        $this->model->data = (object) $data;

        return is_null($data) ? null : $this->model;

    }

    /**
     * @inheritdoc
     */
    public function findWhere(array $attributes): array
    {
        // TODO: Implement findWhere() method.
    }

    /**
     * @param array $input
     * @return ModelInterface
     */
    public function create(array $input) : ModelInterface
    {
        $this->setModel();
        $input = $this->filter($input);
        $table = $this->model->table;
        $query = "INSERT INTO $table (".implode(',',array_keys($input)).") VALUES ('".implode("','",array_values($input))."')";

        // TODO: make binding for for prevent sql injection
        $this->exec($query, [
            'database'  => $this->model->database ?? getenv('MYSQL_DATABASE')
        ]);

        $this->model->data = (object) $input;

        return $this->model;
    }

    /**
     * @param array $input
     * @return array
     */
    protected function filter(array $input)
    {
        $now = date("Y-m-d H:i:s");
        $tmp = $input;
        foreach ($input as $key =>  $value) {
            if (!in_array($key, $this->model->fillable)) {
                unset($tmp[$key]);
            }
            $tmp['created_at'] = $now;
            $tmp['updated_at'] = $now;
        }
        return $tmp;
    }

    /**
     * @inheritdoc
     */
    public function update(array $input, array $condition): ?ModelInterface
    {
        $this->setModel();
        $input = $this->filter($input);
        $table = $this->model->table;
        $con = $condition['transaction_code'];
        $query = "UPDATE $table SET ";

        foreach($input as $key => $value) $query .= $key."='". $value."', ";
        $query = rtrim($query, ", ");
        $query .= " where transaction_code = $con";

        // TODO: make binding for for prevent sql injection
        $this->exec($query, [
            'database'  => $this->model->database ?? getenv('MYSQL_DATABASE')
        ]);

        return $this->findBy('transaction_code', $con);
    }

    /**
     * @inheritdoc
     */
    public function delete(int $id): bool
    {
        // TODO: Implement delete() method.
    }

}