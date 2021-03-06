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
 * @method \Holmes\components\filters\Query query() query(\Holmes\components\QueryInterface $value)
 * @method \Holmes\components\filters\Query _cache() _cache(\bool $value) Default: false

 */
class Query extends \Holmes\components\BaseComponent implements \Holmes\components\FilterInterface
{
    public function __construct($hashMap = null)
    {
        $this->params['_cache'] = false;

        parent::__construct($hashMap);
    }


    public function toArray()
    {
        $ret = array(
            'fquery' => array(
                'query'  => $this->params["query"]->toArray(),
                '_cache' => $this->params["_cache"],
            ),
        );

        return $ret;
    }

}
