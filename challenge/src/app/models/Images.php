<?php

class Images extends \Phalcon\Mvc\Model
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
    public $variantId;

    /**
     *
     * @var string
     * @Column(type="string", length=200, nullable=false)
     */
    public $url;

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
        return 'images';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Images[]|Images
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Images
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
