<?php
/**
 * User: anwar@honestmining.com
 * Date: 2019-12-07
 * Time: 13:37
 */

namespace lib\Mysql;

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
     * @return array
     */
    public function findBy(string $attribute, string $value) : array;

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
     * @param array $attributes
     * @return array
     */
    public function update(array $attributes) : array;

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id) : bool;
}