<?php
/**
 * User: Zachary Tong
 * Date: 3/7/13
 * Time: 8:07 PM
 */

namespace Holmes\wrappers;

use Holmes\components\sorts;

/**
 * @method \Holmes\components\sorts\Field Field() Field()
 */
class SortWrapper
{
    /**
     * @var \Holmes\components\SortInterface
     */
    protected $query;


    /**
     * @param $name
     * @param $arguments
     *
     * @return \Holmes\components\SortInterface
     */
    public function __call($name, $arguments)
    {
        $class = '\\Holmes\\components\\sorts\\' . $name;

        if (count($arguments) > 0) {
            $this->query = new $class($arguments[0]);
        } else {
            $this->query = new $class();
        }

        return $this->query;
    }


    public function __toString()
    {
        return (string)$this->query;
    }

}
