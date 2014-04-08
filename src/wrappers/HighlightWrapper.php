<?php

namespace Holmes\wrappers;

/**
 * Class HighlightWrapper
 * @package Holmes\wrappers
 *
 *
 * @method \Holmes\components\highlights\Highlight Highlight() Highlight()
 */
class HighlightWrapper
{
    /**
     * @var \Holmes\components\HighlightInterface
     */
    protected $highlight;


    /**
     * @param $name
     * @param $arguments
     *
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        $class = '\\Holmes\\components\\highlights\\' . $name;

        if (count($arguments) > 0) {
            $this->highlight = new $class($arguments[0]);
        } else {
            $this->highlight = new $class();
        }

        return $this->highlight;
    }


    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->highlight;
    }

}
