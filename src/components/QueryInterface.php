<?php
/**
 * User: Zachary Tong
 * Date: 2/6/13
 * Time: 8:39 PM
 * @package Holmes\components
 */
namespace Holmes\components;

/**
 * Interface for filter components, always used in conjunction with the BaseComponent class
 */
interface QueryInterface
{
    public function toArray();


    public function toJSON();
}
