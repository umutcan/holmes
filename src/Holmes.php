<?php
/**
 * Created by IntelliJ IDEA.
 * User: umutcan
 * Date: 4/8/14
 * Time: 2:53 PM
 */

namespace Holmes;

use Elasticsearch\Client;
use Holmes\wrappers;
use Holmes\requests;

class Holmes {

    private $_client;

    /**
     * Holmes constructor, initializes ES Client
     *
     * @param array $param Optional connection settings to over-ride the default
     */
    public function __construct($param = array())
    {
        $this->_client = new Client($param);
    }

    /**
     * Query builder, used to return a QueryWrapper through which a Query component can be selected
     * @return wrappers\QueryWrapper
     */
    public static function queryBuilder()
    {
        return new \Holmes\wrappers\QueryWrapper();
    }


    /**
     * Filter builder, used to return a FilterWrapper through which a Filter component can be selected
     * @return wrappers\FilterWrapper
     */
    public static function filterBuilder()
    {
        return new wrappers\FilterWrapper();
    }


    /**
     * Facet builder, used to return a FilterWrapper through which a Filter component can be selected
     * @return wrappers\FacetWrapper
     */
    public static function facetBuilder()
    {
        return new wrappers\FacetWrapper();
    }


    /**
     * Highlight builder, used to return a HighlightWrapper through which a Highlight component can be selected
     * @return wrappers\HighlightWrapper
     */
    public static function highlightBuilder()
    {
        return new wrappers\HighlightWrapper();
    }


    /**
     * Index builder, used to return a IndexWrapper through which an Index component can be selected
     * @return wrappers\IndexSettingsWrapper
     */
    public static function indexSettingsBuilder()
    {
        return new wrappers\IndexSettingsWrapper();
    }


    /**
     * Mapping builder, used to return a MappingWrapper through which a Mapping component can be selected
     *
     * @param  null|string                     $type
     *
     * @return wrappers\MappingPropertyWrapper
     */
    public static function mappingBuilder($type = null)
    {
        return new wrappers\MappingPropertyWrapper($type);
    }


    /**
     * @return wrappers\SortWrapper
     */
    public static function sortBuilder()
    {
        return new wrappers\SortWrapper();
    }

    /**
     * Used to obtain a SearchRequest object, allows querying the cluster with searches
     * @return requests\SearchRequest
     */
    public function search()
    {
        return new requests\SearchRequest($this->settings['event.dispatcher']);
    }
} 