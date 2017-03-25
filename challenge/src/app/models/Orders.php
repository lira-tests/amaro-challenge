<?php

class Orders extends \Phalcon\Mvc\Model
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
    public $userId;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    public $statusId;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $created;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $updated;

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
        return 'orders';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Orders[]|Orders
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Orders
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
