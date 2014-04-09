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
 * @method \Holmes\components\filters\Type value() value(\string $value)

 */
class Type extends \Holmes\components\BaseComponent implements \Holmes\components\FilterInterface
{
    public function __construct($hashMap = null)
    {

        parent::__construct($hashMap);
    }


    public function toArray()
    {
        $ret = array(
            'type' =>
            array(
                'value' => $this->params["value"],
            ),
        );

        return $ret;
    }

}
