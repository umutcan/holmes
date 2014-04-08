<?php
/**
 * User: Zachary Tong
 * Date: 2/19/13
 * Time: 9:21 PM
 */
namespace Holmes\wrappers;

use Holmes\components\filters;

/**
 * @method \Holmes\components\filters\Bool Bool() Bool()
 * @method \Holmes\components\filters\AndFilter AndFilter() AndFilter()
 * @method \Holmes\components\filters\Exists Exists() Exists()
 * @method \Holmes\components\filters\GeoBoundingBox GeoBoundingBox() GeoBoundingBox()
 * @method \Holmes\components\filters\GeoDistance GeoDistance() GeoDistance()
 * @method \Holmes\components\filters\GeoDistanceRange GeoDistanceRange() GeoDistanceRange()
 * @method \Holmes\components\filters\GeoPolygon GeoPolygon() GeoPolygon()
 * @method \Holmes\components\filters\HasChild HasChild() HasChild()
 * @method \Holmes\components\filters\HasParent HasParent() HasParent()
 * @method \Holmes\components\filters\Ids Ids() Ids()
 * @method \Holmes\components\filters\Limit Limit() Limit()
 * @method \Holmes\components\filters\MatchAll MatchAll() MatchAll()
 * @method \Holmes\components\filters\Missing Missing() Missing()
 * @method \Holmes\components\filters\Nested Nested() Nested()
 * @method \Holmes\components\filters\Not Not() Not()
 * @method \Holmes\components\filters\NumericRange NumericRange() NumericRange()
 * @method \Holmes\components\filters\OrFilter OrFilter() OrFilter()
 * @method \Holmes\components\filters\Prefix Prefix() Prefix()
 * @method \Holmes\components\filters\Query Query() Query()
 * @method \Holmes\components\filters\Range Range() Range()
 * @method \Holmes\components\filters\Script Script() Script()
 * @method \Holmes\components\filters\Term Term() Term()
 * @method \Holmes\components\filters\Terms Terms() Terms()
 * @method \Holmes\components\filters\Type Type() Type()
 */
class FilterWrapper
{
    /**
     * @var \Holmes\components\FilterInterface
     */
    protected $filter;


    public function __call($name, $arguments)
    {
        $class = '\\Holmes\\components\\filters\\' . $name;

        if (count($arguments) > 0) {
            $this->filter = new $class($arguments[0]);
        } else {
            $this->filter = new $class();
        }

        return $this->filter;
    }


    public function __toString()
    {
        return (string)$this->filter;
    }

}
