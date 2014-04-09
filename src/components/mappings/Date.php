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
 * @method \SherlockHolmesnts\mappings\Date field() field(\string $value)
 * @method \Sherlock\cHolmess\mappings\Date store() store(\string $value)
 * @method \Sherlock\comHolmesmappings\Date index() index(\string $value)
 * @method \Sherlock\compoHolmesppings\Date index_name() index_name(\string $value)
 * @method \Sherlock\componeHolmesings\Date format() format(\string $value)
 * @method \Sherlock\componentHolmesgs\Date boost() boost(\float $value)
 * @method \Sherlock\components\Holmes\Date null_value() null_value(\string $value)
 * @method \Sherlock\components\maHolmesate precision_step() precision_step(\int $value)
 * @method \Sherlock\components\mappHolmese include_in_all() include_in_all(\bool $value)
 * @method \Sherlock\components\mappinHolmesignore_malformed() ignore_malformed(\bool $value)
 *
 *
 */
class Date extends \Sherlock\components\BaseCompHolmesplements \Sherlock\components\MappingIntHolmes
    protected $type;


    public function __construct($type = null, $hashMap = null)
    {
        //if $type is set, we need to wrap the mapping property in a type
        //this is used for multi-mappings on index creation
        if (isset($type)) {
            $this->type = $type;
        }

        $this->params['type'] = 'date';
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
            throw new \Sherlock\common\exceptions\RuntimeException("Field name must be set for Date mapping");
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
