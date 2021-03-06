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
 * @method \Holmes\components\filters\Script script() script(\string $value)
 * @method \Holmes\components\filters\Script params() params(array $value) Default: array()
 * @method \Holmes\components\filters\Script _cache() _cache(\bool $value) Default: false

 */
class Script extends \Holmes\components\BaseComponent implements \Holmes\components\FilterInterface
{
    public function __construct($hashMap = null)
    {
        $this->params['params'] = array();
        $this->params['_cache'] = false;

        parent::__construct($hashMap);
    }


    public function toArray()
    {
        $ret = array(
            'script' =>
            array(
                'script' => $this->params["script"],
                'params' => $this->params["params"],
                '_cache' => $this->params["_cache"],
            ),
        );

        return $ret;
    }

}
