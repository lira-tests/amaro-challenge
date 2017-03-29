<?php

namespace Challenge\Model;

use Challenge\Library\Similarity;
use Challenge\Library\Stringer;
use Phalcon\Exception;

/**
 * Class Products
 * @package Challenge\Model
 */
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

        $this->hasMany(
            'id',
            'Challenge\\Model\\Variants',
            'product_id',
            [
                'alias' => 'Variants'
            ]
        );

        $this->hasOne(
            'id',
            'Challenge\\Model\\ProductSimilar',
            'product_id',
            [
                'alias' => 'Similar'
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

    /**
     * @return array
     */
    public static function getAll(): array
    {
        $products = [];

        $allProducts = self::find();

        foreach ($allProducts as $product) {
            $variants = $product->getVariants(
                [
                    'columns' => 'id, name, price, price_old, quantity'
                ]
            );

            $product = $product->toArray();

            $product['variants'] = $variants;

            $products[] = $product;
        }

        return $products;
    }

    /**
     * @param $id
     * @return array
     */
    public static function getById($id): array
    {
        $product = self::findFirst($id);

        $variants = $product->getVariants(
            [
                'columns' => 'id, name, price, price_old, quantity'
            ]
        );
        $similars = $product->getSimilar(
            [
                'columns' => 'similar_ids'
            ]
        );

        $product = $product->toArray();

        $product['variants'] = $variants;
        $product['similars'] = self::find(
            [
                'id IN ({similar:array})',
                'bind' => [
                    'similar' => Stringer::string2Array($similars->similar_ids)
                ],
                'columns' => 'id, name, description'
            ]
        );

        return $product;
    }

    /**
     * Worker to update product similar
     */
    public static function updateSimilar()
    {
        $products = parent::find();

        /** @var Products $product */
        foreach ($products as $product) {
            $similarList = [];

            // Find all except actual product
            $productsSimilar = parent::find(
                [
                    'id != ' . $product->id
                ]
            );

            /** @var Products $productSimilar */
            foreach ($productsSimilar as $productSimilar) {
                $similarCategories = count(array_intersect($product->categories, $productSimilar->categories));
                $similarTags = count(array_intersect($product->tags, $productSimilar->tags));

                $similarList[$productSimilar->id] = Similarity::calculate($similarTags, $similarCategories);
            }

            arsort($similarList);
            $similarList = array_slice($similarList, 0, 3, true);

            // check is update ou create
            if ($product->getSimilar()) {
                $product->getSimilar()->update(
                    [
                        'similar_ids' => array_keys($similarList)
                    ]
                );
            } else {
                $similar = new ProductSimilar();
                $similar->similar_ids = array_keys($similarList);
                $similar->product_id = $product->id;
                $similar->save();
            }
        }
    }

    /**
     * @param array $data
     * @return bool
     * @throws Exception
     */
    public function createProduct(array $data)
    {
        if (!empty($data['id'])) {
            throw new Exception('Não é possível informar o ID para criar um novo produto', 400);
        }

        $product = self::find(['slug = \'' . $data['slug'] . '\'']);

        if (count($product)) {
            throw new Exception('Slug já existe, é um valor único', 400);
        }

        $product = new Products($data);

        if (!empty($data['variants'])) {
            $variants = [];

            foreach ($data['variants'] as $variant) {
                $newVariant = new Variants();
                $newVariant->name = $variant['name'];
                $newVariant->price = $variant['price'];
                $newVariant->priceOld = $variant['price_old'];
                $newVariant->quantity = $variant['quantity'];
                $newVariant->productId = $product;

                $variants[] = $newVariant;
            }

            $product->variants = $variants;
        }

        return $product->save();
    }

    /**
     * @param $id
     * @param array $data
     * @return bool
     * @throws Exception
     */
    public function updateProduct($id, array $data)
    {
        $product = self::findFirst($id);

        if (!$product) {
            throw new Exception('Produto não encontrado', 404);
        }

        foreach ($data as $key => $value) {
            // skip slug unique value
            if ($key == 'slug') {
                continue;
            }

            if ($key == 'variants') {
                foreach ($value as $variantData) {
                    $variant = Variants::findFirst($variantData['id']);
                    foreach ($variantData as $newKey => $newData) {
                        $variant->{$newKey} = $newData;
                    }

                    $variant->save();
                }
            }

            $product->{$key} = $value;
        }

        return $product->save();
    }

    /**
     * Convert to array categories an tags
     */
    public function afterFetch()
    {
        $this->categories = Stringer::string2Array($this->categories);
        $this->tags = Stringer::string2Array($this->tags, '>');
    }

    /**
     * Convert to string before save
     */
    public function beforeSave()
    {
        $this->categories = join(',', (array) $this->categories);
        $this->tags = join('>', (array) $this->tags);
    }

    /**
     * Return to array after save
     */
    public function afterSave()
    {
        $this->categories = Stringer::string2Array($this->categories);
        $this->tags = Stringer::string2Array($this->tags, '>');
    }

}
