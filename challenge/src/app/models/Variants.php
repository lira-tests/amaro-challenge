<?php

class Variants extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    public $id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    public $productId;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    public $name;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    public $slug;

    /**
     *
     * @var double
     * @Column(type="double", nullable=false)
     */
    public $price;

    /**
     *
     * @var double
     * @Column(type="double", nullable=true)
     */
    public $priceOld;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $quantity;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    public $active;

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
        return 'variants';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Variants[]|Variants
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Variants
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
