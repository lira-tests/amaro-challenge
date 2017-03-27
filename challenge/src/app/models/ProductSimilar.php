<?php

namespace Challenge\Model;

/**
 * Class ProductSimilar
 * @package Challenge\Model
 */
class ProductSimilar extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    public $id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $product_id;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $similar_ids;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("challenge");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'product_similar';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ProductSimilar[]|ProductSimilar
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ProductSimilar
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
