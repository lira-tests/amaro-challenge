<?php

class Products extends \Phalcon\Mvc\Model
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
     * @var string
     * @Column(type="string", length=150, nullable=false)
     */
    public $name;

    /**
     *
     * @var string
     * @Column(type="string", length=150, nullable=false)
     */
    public $slug;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $tags;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $categories;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $description;

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
        return 'products';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Products[]|Products
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Products
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
