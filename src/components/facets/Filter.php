<?php
/**
 * User: Zachary Tong
 * Date: 3/16/13
 * Time: 11:06 AM
 */

namespace Holmes\components\facets;

use Holmes\common\exceptions\BadMethodCallException;
use Holmes\common\exceptions\RuntimeException;
use Holmes\components;

/**]
 * Class Filter
 * @package Holmes\components\facets
 *
 * @method \Holmes\components\facets\Filter facetname() facetname(\string $value)
 * @method \Holmes\components\facets\Filter filter() filter(\Holmes\components\FilterInterface $value)
 * @method \Holmes\components\facets\DateHistogram facet_filter() facet_filter(\Holmes\components\FilterInterface $value)
 */
class Filter extends components\BaseComponent implements components\FacetInterface
{
    /**
     * @param null $hashMap
     */
    public function __construct($hashMap = null)
    {

        $this->params['facetname']    = null;
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
            $this->params['field'] = $fieldName;
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
            throw new RuntimeException("Field parameter is required for a Filter Facet");
        }

        if ($this->params['field'] === null) {
            throw new RuntimeException("Field parameter may not be null");
        }

        if (!isset($this->params['filter'])) {
            throw new RuntimeException("Filter parameter is required for a Filter Facet");
        }

        if (!$this->params['filter'] instanceof components\FilterInterface) {
            throw new RuntimeException("Filter parameter must be a Filter component");
        }

        //if the user didn't provide a facetname, use the field as a default name
        if ($this->params['facetname'] === null) {
            $this->params['facetname'] = $this->params['field'];
        }

        if ($this->params['facet_filter'] !== null) {
            $this->params['facet_filter'] = $this->params['facet_filter']->toArray();
        }

        $ret = array(
            $this->params['facetname'] => array(
                "filter"       => $this->params['filter']->toArray(),
                "facet_filter" => $this->params['facet_filter']
            )
        );

        return $ret;
    }

}
