<?php
/**
 * BillysBilling
 *
 * PHP version 5
 *
 * @category  BillysBilling
 * @package   BillysBilling
 * @author    Lars Olesen <lars@intraface.dk>
 * @copyright 2014 Lars Olesen
 * @license   MIT Open Source License https://opensource.org/licenses/MIT
 * @version   GIT: <git_id>
 * @link      http://github.com/lsolesen/billysbilling
 */

namespace BillysBilling\Products;

use BillysBilling\Billy_EntityRepository;
use BillysBilling\Client\Billy_Request;
use BillysBilling\Exception\Billy_Exception;

/**
 * Class Billy_ProductsRepository
 *
 * @category  BillysBilling
 * @package   BillysBilling
 * @author    Lars Olesen <lars@intraface.dk>
 * @copyright 2014 Lars Olesen
 */
class Billy_ProductsRepository extends Billy_EntityRepository
{
    /**
     * Defines API information for endpoint.
     *
     * @param Billy_Request $request Request object
     */
    public function __construct($request)
    {
        $this->url = '/products';
        $this->recordKey = 'product';
        $this->recordKeyPlural = 'products';
        $this->request = $request;
    }

    /**
     * Returns all account groups.
     *
     * @return Billy_Product[]
     * @throws Billy_Exception
     */
    public function getAll()
    {
        $response = parent::getAll();
        $products = array();
        foreach ($response as $key => $product) {
            $products[$product->id] = new Billy_Product($product);
        }
        return $products;
    }

    /**
     * Returns an account group
     *
     * @param string $id API ID
     *
     * @return Billy_Product
     */
    public function getSingle($id)
    {
        $response = parent::getSingle($id);
        return new Billy_Product($response);
    }

    /**
     * Create an item through an object endpoint.
     *
     * @param Billy_Product $object API Entity object
     *
     * @return mixed
     */
    public function create($object)
    {
        $response = parent::create($object);
        return new Billy_Product($response->{$this->recordKeyPlural}[0]);
    }
}
