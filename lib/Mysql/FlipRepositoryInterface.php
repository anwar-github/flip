<?php
/**
 * User: anwar@honestmining.com
 * Date: 2019-12-07
 * Time: 13:37
 */

namespace lib\Mysql;

use app\Disbursement\Entity\Model\ModelInterface;

/**
 * Interface AbstractFlipRepositoryInterface
 *
 * @package lib\Mysql
 */
interface FlipRepositoryInterface
{
    /**
     * @return string
     */
    public function model() : string;

    /**
     * @param string $attribute
     * @param string $value
     * @return ModelInterface|null
     */
    public function findBy(string $attribute, string $value) : ?ModelInterface;

    /**
     * @param array $attributes
     * @return array
     */
    public function findWhere(array $attributes) : array;

    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes);

    /**
     * @param array $input
     * @param array $condition
     * @return ModelInterface|null
     */
    public function update(array $input, array $condition) : ?ModelInterface;

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id) : bool;
}