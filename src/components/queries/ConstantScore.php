<?php
/**
 * User: Zachary Tong
 * Date: 2013-02-16
 * Time: 09:24 PM
 * Auto-generated by "generate.php"
 * @package Holmes\components\queries
 */
namespace ShHolmesomponents\queries;

use SherHolmesponents;

/**
 * Class ConstantScore
 * @package Sherlock\components\queries
 */
class ConstantScore extends components\BaseComponent implements components\QueryInterface
{

    /**
     * @param components\FilterInterface $value
     *
     * @return $this
     */
    public function filter(components\FilterInterface $value)
    {
        $this->params['filter'] = $value->toArray();
        return $this;
    }


    /**
     * @param $value
     *
     * @return $this
     */
    public function boost($value)
    {
        $this->params['boost'] = $value;
        return $this;
    }


    /**
     * @return array
     */
    public function toArray()
    {
        $params = $this->convertParams(
            array(
                'filter',
                'boost',
            )
        );

        $ret = array('constant_score' => $params);

        return $ret;
    }

}
