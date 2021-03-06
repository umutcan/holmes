<?php
/**
 * User: Zachary Tong
 * Date: 3/16/13
 * Time: 11:29 AM
 */

namespace Holmes\components\facets;


use Holmes\common\exceptions\BadMethodCallException;
use Holmes\common\exceptions\RuntimeException;
use Holmes\components;

/**]
 * Class GeoDistance
 * @package Holmes\components\facets
 *
 * @method \Holmes\components\facets\GeoDistance facetname() facetname(\string $value)
 * @method \Holmes\components\facets\GeoDistance ranges() ranges(array $value)
 * @method \Holmes\components\facets\GeoDistance pin_location() pin_location(mixed $value)
 * @method \Holmes\components\facets\GeoDistance unit() unit(\string $value)
 * @method \Holmes\components\facets\GeoDistance value_field() value_field(\string $value)
 * @method \Holmes\components\facets\GeoDistance value_script() value_script(string $value)
 * @method \Holmes\components\facets\GeoDistance params() params(array $value)
 * @method \Holmes\components\facets\GeoDistance lang() lang(\string $value)
 * @method \Holmes\components\facets\DateHistogram facet_filter() facet_filter(\Holmes\components\FilterInterface $value)
 */
class GeoDistance extends components\BaseComponent implements components\FacetInterface
{
    /**
     * @param null $hashMap
     */
    public function __construct($hashMap = null)
    {

        $this->params['facetname']    = null;
        $this->params['ranges']       = null;
        $this->params['pin_location'] = null;
        $this->params['unit']         = null;
        $this->params['value_field']  = null;
        $this->params['value_script'] = null;
        $this->params['params']       = null;
        $this->params['lang']         = null;
        $this->params['facet_filter'] = null;

        parent::__construct($hashMap);
    }


    /**
     * @param $fieldName
     *
     * @throws \Holmes\common\exceptions\BadMethodCallException
     * @return $this
     */
    public function field($fieldName)
    {
        if (is_string($fieldName)) {
            $this->params['field'][] = $fieldName;
        } else {
            throw new BadMethodCallException("Field must be a string");
        }

        return $this;
    }


    /**
     * @throws \Holmes\common\exceptions\RuntimeException
     * @return array
     */
    public function toArray()
    {
        if (!isset($this->params['field'])) {
            throw new RuntimeException("Field parameter is required for a GeoDistance Facet");
        }

        if ($this->params['field'] === null) {
            throw new RuntimeException("Field parameter may not be null");
        }

        //if the user didn't provide a facetname, use the field as a default name
        if ($this->params['facetname'] === null) {
            $this->params['facetname'] = $this->params['field'][0];
        }

        if ($this->params['facet_filter'] !== null) {
            $this->params['facet_filter'] = $this->params['facet_filter']->toArray();
        }


        $ret = array(
            $this->params['facetname'] => array(
                "geo_distance" => array(
                    $this->params['field'] => array(
                        "pin.location"  => $this->params['pin_location'],
                        "ranges"        => $this->params['ranges'],
                        "value_field"   => $this->params['value_field'],
                        "value_script"  => $this->params['value_script'],
                        "params"        => $this->params['params'],
                        "lang"          => $this->params['lang'],
                        "unit"          => $this->params['unit'],
                        "distance_type" => $this->params['distance_type']
                    )
                ),
                "facet_filter" => $this->params['facet_filter']
            )
        );

        return $ret;
    }

}
