<?php

namespace Challenge\Model;

/**
 * Class Orders
 * @package Challenge\Model
 */
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

        $this->hasOne(
            'user_id',
            'Challenge\\Model\\Users',
            'id',
            [
                'alias' => 'Users'
            ]
        );

        $this->hasOne(
            'status_id',
            'Challenge\\Model\\Status',
            'id',
            [
                'alias' => 'Status'
            ]
        );

        $this->hasMany(
            'id',
            'Challenge\\Model\\OrderItems',
            'order_id',
            [
                'alias' => 'OrderItems'
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

    /**
     * @return \Phalcon\Mvc\Model\ResultsetInterface
     */
    public static function getOrders()
    {
        return self::query()
            ->columns(
                [
                    'Challenge\\Model\\Orders.id',
                    'u.name',
                    's.status'
                ]
            )
            ->innerJoin('Challenge\\Model\\Users', 'user_id = u.id', 'u')
            ->innerJoin('Challenge\\Model\\Status', 'status_id = s.id', 's')
            ->execute()
        ;
    }

    /**
     * @param int $orderId
     * @return array
     */
    public static function getOrderProducts(int $orderId) : array
    {
        $order = self::findFirst($orderId);

        $itemList = $order->getOrderItems();

        $items = [];

        /** @var OrderItems $item */
        foreach ($itemList as $item) {
            /** @var Variants $variant */
            foreach ($item->getVariants() as $variant) {
                /** @var Products $product */
                $product = $variant->getProducts();
                /** @var Images $image */
                $image = $variant->getImages();
                $items[$item->id][] = [
                    'product' => [
                        'id' => $product->id,
                        'name' => $product->name,
                        'description' => $product->description,
                    ],
                    'variant' => [
                        'id' => $variant->id,
                        'name' => $variant->name,
                    ],
                    'image' => [
                       'url' => $image->url
                    ],
                    'quantity' => $item->quantity,
                ];
            }
        }

        return $items;
    }

}
