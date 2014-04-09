<?php
/**
 * User: Zachary Tong
 * Date: 2013-02-19
 * Time: 08:26 PM
 * Auto-generated by "generate.filters.php"
 * @package Holmes\components\filters
 */
namespace Holmes\components\filters;

use Holmes\components;

/**
 * @method \Holmes\components\filters\GeoPolygon points() points(array $value)
 * @method \Holmes\components\filters\GeoPolygon _cache() _cache(\bool $value) Default: false

 */
class GeoPolygon extends \Holmes\components\BaseComponent implements \Holmes\components\FilterInterface
{
    public function __construct($hashMap = null)
    {
        $this->params['_cache'] = false;

        parent::__construct($hashMap);
    }


    public function toArray()
    {
        $ret = array(
            'geo_polygon' =>
            array(
                'person.location' =>
                array(
                    'points' => $this->params["points"],
                ),
                '_cache'          => $this->params["_cache"],
            ),
        );

        return $ret;
    }

}
