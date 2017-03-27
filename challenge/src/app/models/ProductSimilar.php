<?php

namespace Challenge\Model;

use Challenge\Library\Stringer;

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

        $this->belongsTo(
            'product_id',
            'Challenge\\Model\\Products',
            'id',
            [
                'alias' => 'Products'
            ]
        );
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

    /**
     * Convert to array similar ids
     */
    public function afterFetch()
    {
        $this->similar_ids = Stringer::string2Array($this->similar_ids);
    }

    /**
     * Convert to string before save
     */
    public function beforeSave()
    {
        $this->similar_ids = join(',', (array) $this->similar_ids);
    }

    /**
     * Return to array after save
     */
    public function afterSave()
    {
        $this->similar_ids = Stringer::string2Array($this->similar_ids);
    }

}
