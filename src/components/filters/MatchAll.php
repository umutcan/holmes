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

 */
class MatchAll extends \Holmes\components\BaseComponent implements \Holmes\components\FilterInterface
{
    public function __construct($hashMap = null)
    {

        parent::__construct($hashMap);
    }


    public function toArray()
    {
        $ret = array(
            'match_all' =>
            array(),
        );

        return $ret;
    }

}
