<?php

namespace Holmes\components\highlights;

use Holmes\components;

/**
 * @method \Holmes\components\highlights\Highlight pre_tags() pre_tags(array $value)
 * @method \Holmes\components\highlights\Highlight post_tags() post_tags(array $value)
 * @method \Holmes\components\highlights\Highlight number_of_fragments() number_of_fragments(\int $value)
 * @method \Holmes\components\highlights\Highlight fragment_size() fragment_size(\int $value)
 * @method \Holmes\components\highlights\Highlight fields() fields(array $value)
 */
class Highlight extends \Holmes\components\BaseComponent implements \Holmes\components\HighlightInterface
{

    public function __construct($hashMap = null)
    {
        $this->params['pre_tags']            = null;
        $this->params['post_tags']           = null;
        $this->params['number_of_fragments'] = null;
        $this->params['fragment_size']       = null;
    }


    public function toArray()
    {
        $ret = array(
            'pre_tags'            => $this->params['pre_tags'],
            'post_tags'           => $this->params['post_tags'],
            'number_of_fragments' => $this->params['number_of_fragments'],
            'fragment_size'       => $this->params['fragment_size'],
        );
        $ret = array_merge(
            $ret,
            array(
                'fields' => array(
                    $this->params["fields"]
                )
            )
        );
        return $ret;
    }

}
