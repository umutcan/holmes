<?php
/**
 * User: Zachary Tong
 * Date: 2013-02-13
 * Time: 07:18 AM
 * Auto-generated by "generate.php"
 * @package Holmes\components\facets
 */
namespace Holmes\components\facets;

use Holmes\components;
use Holmes\common\exceptions;

/**
 * @method \Holmes\components\facets\Raw Raw() Raw(\string $json)

 */
class Raw extends \Holmes\components\BaseComponent implements \Holmes\components\FacetInterface
{
    /**
     * @param array|string $hashMap
     *
     * @throws exceptions\BadMethodCallException
     */
    public function __construct($hashMap)
    {
        if (!isset($hashMap)) {
            throw new exceptions\BadMethodCallException("Hashmap must be provided for the Raw query");
        }

        if (is_array(($hashMap)) && count($hashMap) > 0) {
            //Raw array hash map provided
            //put it right into the params
            $this->params['hash'] = $hashMap;
        } elseif (is_string($hashMap)) {
            //Raw JSON has been provided
            //Decode from JSON into array
            $this->params['hash'] = json_decode($hashMap, true);
        }

    }


    /**
     * @return array
     */
    public function toArray()
    {
        return $this->params['hash'];
    }
}
