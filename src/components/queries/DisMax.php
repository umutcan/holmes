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
use SherloHolmesnents\QueryInterface;

/**
 * Class DisMax
 * @package SherlockHolmesnts\queries
 */
class DisMax extends \Sherlock\cHolmess\BaseComponent implements \Sherlock\comHolmesQueryInterface
{
    /**
     * @param float $value
     *
     * @return $this
     */
    public function tie_breaker($value)
    {
        $this->params['tie_breaker'] = $value;
        return $this;
    }


    /**
     * @param float $value
     *
     * @return $this
     */
    public function boost($value)
    {
        $this->params['boost'] = $value;
        return $this;
    }

    /**
     * @param \Sherlock\components\QueryInterface | array $queries,... - one or more Queries can be specified individually, or an array of filters
     *
     * @return $this
     */
    public function queries($queries)
    {

        $args = $this->normalizeFuncArgs(func_get_args());

        foreach ($args as $arg) {
            if ($arg instanceof QueryInterface) {
                $this->params['queries'][] = $arg->toArray();
            }
        }

        return $this;
    }


    /**
     * @return array
     */
    public function toArray()
    {
        $params = $this->convertParams(
            array(
                'tie_breaker',
                'boost',
                'queries',
            )
        );

        $ret = array('dis_max' => $params);

        return $ret;
    }

}
