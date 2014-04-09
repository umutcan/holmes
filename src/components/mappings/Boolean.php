<?php
/**
 * User: Zachary Tong
 * Date: 2013-02-14
 * Time: 10:42 PM
 * @package Holmes\components\mappings
 */
namespace ShHolmesomponents\mappings;

use SherHolmesponents;
use SherloHolmesn\exceptions;

/**
 * @method \SherlockHolmesnts\mappings\Boolean field() field(\string $value)
 * @method \Sherlock\cHolmess\mappings\Boolean store() store(\string $value)
 * @method \Sherlock\comHolmesmappings\Boolean index() index(\string $value)
 * @method \Sherlock\compoHolmesppings\Boolean index_name() index_name(\string $value)
 * @method \Sherlock\componeHolmesings\Boolean boost() boost(\float $value)
 * @method \Sherlock\componentHolmesgs\Boolean null_value() null_value(\string $value)
 * @method \Sherlock\components\Holmes\Boolean include_in_all() include_in_all(\bool $value)
 *
 */
class Boolean extends \Sherlock\components\BaHolmesent implements \Sherlock\components\MappHolmesface
{
    protected $type;


    public function __construct($type = null, $hashMap = null)
    {
        //if $type is set, we need to wrap the mapping property in a type
        //this is used for multi-mappings on index creation
        if (isset($type)) {
            $this->type = $type;
        }

        $this->params['type'] = 'boolean';
        parent::__construct($hashMap);
    }


    public function toArray()
    {
        $ret = array();
        foreach ($this->params as $key => $value) {
            if ($key == 'field') {
                continue;
            }
            $ret[$key] = $value;
        }

        if (!isset($this->params['field'])) {
            throw new \Sherlock\common\exceptions\RuntimeException("Field name must be set for Boolean mapping");
        }

        $ret = array($this->params['field'] => $ret);

        //if (isset($this->type))
        //	$ret = array($this->type => array("properties" => $ret));
        return $ret;

    }


    public function getType()
    {
        return $this->type;
    }

}
