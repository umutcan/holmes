<?php
/**
 * User: Zachary Tong
 * Date: 3/14/13
 * Time: 6:54 AM
 */

namespace Holmes\wrappers;

/**
 * Class FacetWrapper
 * @package Holmes\wrappers
 *
 *
 * @method \Holmes\components\facets\Terms Terms() Terms()
 * @method \Holmes\components\facets\Range Range() Range()
 * @method \Holmes\components\facets\Histogram Histogram() Histogram()
 * @method \Holmes\components\facets\DateHistogram DateHistogram() DateHistogram()
 * @method \Holmes\components\facets\Filter Filter() Filter()
 * @method \Holmes\components\facets\Query Query() Query()
 * @method \Holmes\components\facets\Statistical Statistical() Statistical()
 * @method \Holmes\components\facets\TermsStats TermsStats() TermsStats()
 * @method \Holmes\components\facets\GeoDistance GeoDistance() GeoDistance()
 */
class FacetWrapper
{
    /**
     * @var \Holmes\components\FacetInterface
     */
    protected $facet;


    /**
     * @param $name
     * @param $arguments
     *
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        $class = '\\Holmes\\components\\facets\\' . $name;

        if (count($arguments) > 0) {
            $this->facet = new $class($arguments[0]);
        } else {
            $this->facet = new $class();
        }

        return $this->facet;
    }


    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->facet;
    }

}
