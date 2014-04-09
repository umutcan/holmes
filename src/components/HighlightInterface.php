<?php

namespace Holmes\components;

/**
 * Interface for highlight components, always used in conjunction with the BaseComponent class
 */
interface HighlightInterface
{
    public function toArray();


    public function toJSON();
}
