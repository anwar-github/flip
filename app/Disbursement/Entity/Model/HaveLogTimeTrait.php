<?php
/**
 * User: anwar@honestmining.com
 * Date: 2019-12-08
 * Time: 12:31
 */

namespace app\Disbursement\Entity\Model;

/**
 * Trait HaveLogTimeTrait
 *
 * @package app\Disbursement\Entity\Model
 */
trait HaveLogTimeTrait
{
    /**
     * @inheritdoc
     */
    public function getCreatedAt() : ?string
    {
        return $this->data->created_at;
    }

    /**
     * @inheritdoc
     */
    public function getUpdatedAt() : ?string
    {
        return $this->data->updated_at;
    }
}