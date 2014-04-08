<?php
/**
 * User: Zachary Tong
 * Date: 2/16/13
 * Time: 8:12 PM
 */

namespace Holmes\wrappers;

use Holmes\common\exceptions;

/**
 * @method \Holmes\components\mappings\String String() String()
 * @method \Holmes\components\mappings\Number Number() Number()
 * @method \Holmes\components\mappings\Date Date() Date()
 * @method \Holmes\components\mappings\Boolean Boolean() Boolean()
 * @method \Holmes\components\mappings\Binary Binary() Binary()
 * @method \Holmes\components\mappings\Object Object() Object()
 * @method \Holmes\components\mappings\Analyzer Analyzer() Analyzer()
 */
class MappingPropertyWrapper
{
    /**
     * @var \Holmes\components\MappingInterface
     */
    protected $property;
    protected $type;


    /**
     * @param  string                                             $type
     *
     * @throws \Holmes\common\exceptions\BadMethodCallException
     */
    public function __construct($type)
    {
        if (!isset($type)) {
                        throw new \Holmes\common\exceptions\BadMethodCallException("Type must be set for mapping property");
        }

        $this->type = $type;

    }


    public function __call($name, $arguments)
    {
        $class = '\\Holmes\\components\\mappings\\' . $name;

        //Type can be passed in the with constructor, used for multi-mappings on index creation
        //Argument[0] is an optional hashmap to define properties via an array
        if (count($arguments) > 0) {
            $this->property = new $class($this->type, $arguments[0]);
        } else {
            $this->property = new $class($this->type);
        }

        return $this->property;
    }

}
