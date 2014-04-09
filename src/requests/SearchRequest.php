<?php
/**
 * User: Zachary Tong
 * Date: 2/10/13
 * Time: 12:10 PM
 * @package Holmes\requests
 */
namespace Holmes\requests;


use Holmes\common\exceptions;
use Holmes\components;
use Holmes\components\queries;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Holmes\components\FacetInterface;
use Holmes\responses\QueryResponse;
use Elasticsearch\Client;

/**
 * SearchRequest facilitates searching an ES index using the ES query DSL
 *
 * @method \Holmes\requests\SearchRequest timeout() timeout(\int $value)
 * @method \Holmes\requests\SearchRequest from() from(\int $value)
 * @method \Holmes\requests\SearchRequest size() size(\int $value)
 * @method \Holmes\requests\SearchRequest search_type() search_type(\int $value)
 * @method \Holmes\requests\SearchRequest routing() routing(mixed $value)
 */
class SearchRequest
{
    /** var Elasticsearch\Client */
    protected $client;


    public function __construct(Client $client)
    {
        $this->client = $client;
    }


    /**
     * @param $name
     * @param $args
     *
     * @return SearchRequest
     */
    public function __call($name, $args)
    {
        $this->params[$name] = $args[0];

        return $this;
    }


    /**
     * Sets the index to operate on
     *
     * @param  string        $index     indices to query
     * @param  string        $index,... indices to query
     *
     * @return SearchRequest
     */
    public function index($index)
    {
        $this->params['index'] = array();
        $args                  = func_get_args();
        foreach ($args as $arg) {
            $this->params['index'][] = $arg;
        }

        return $this;
    }


    /**
     * Sets the type to operate on
     *
     * @param  string        $type     types to query
     * @param  string        $type,... types to query
     *
     * @return SearchRequest
     */
    public function type($type)
    {
        $this->params['type'] = array();
        $args                 = func_get_args();
        foreach ($args as $arg) {
            $this->params['type'][] = $arg;
        }

        return $this;
    }


    /**
     * Sets the query that will be executed
     *
     * @param $query
     *
     * @return SearchRequest
     */
    public function query($query)
    {
        $this->params['query'] = $query;

        return $this;
    }


    /**
     * Sets the query or queries that will be executed
     *
     * @param  \Holmes\components\SortInterface|array,... $value
     *
     * @return SearchRequest
     */
    public function sort($value)
    {
        $args = func_get_args();

        //single param, array of sorts
        if (count($args) == 1 && is_array($args[0])) {
            $args = $args[0];
        }

        foreach ($args as $arg) {
            if ($arg instanceof \Holmes\components\SortInterface) {
                $this->params['sort'][] = $arg->toArray();
            }
        }

        return $this;
    }


    /**
     * Sets the fields that will be returned
     *
     * @param $fields
     *
     * @return SearchRequest
     */
    public function fields($fields)
    {
        $this->params['fields'] = $fields;

        return $this;
    }


    /**
     * Sets the filter that will be executed
     *
     * @param $filter
     *
     * @return SearchRequest
     */
    public function filter($filter)
    {
        $this->params['filter'] = $filter;

        return $this;
    }


    /**
     * Sets the facets to operate on
     *
     * @param  FacetInterface $facets     types to query
     * @param  FacetInterface $facets,... types to query
     *
     * @return SearchRequest
     */
    public function facets($facets)
    {
        $this->params['facets'] = array();
        if (is_array($facets)){
            $args = $facets;
        }else{
            $args = func_get_args();
        }
        foreach ($args as $arg) {
            if ($arg instanceof FacetInterface) {
                $this->params['facets'][] = $arg;
            }
        }

        return $this;
    }


    /**
     * @param HighlightInterface $highlight
     *
     * @return SearchRequest
     */
    public function highlight($highlight)
    {
        $this->params['highlight'] = $highlight;

        return $this;
    }


    /**
     * Set the min_score value
     * Documents with a score below this value will be discarded
     * @param Integer $score minimal score
     */
    public function min_score($score)
    {
        $this->params['min_score'] =  $score;
        return $this;
    }


    /**
     * Execute the search request on the ES cluster
     *
     * @throws \Holmes\common\exceptions\RuntimeException
     * @return \Holmes\responses\QueryResponse
     */
    public function execute()
    {

        $finalQuery = $this->composeFinalQuery();

        if (isset($this->params['index'])) {
            $index = implode(',', $this->params['index']);
        } else {
            $index = '';
        }

        if (isset($this->params['type'])) {
            $type = implode(',', $this->params['type']);
        } else {
            $type = '';
        }

        if (isset($this->params['search_type'])) {
            $queryParams[] = $this->params['search_type'];
        }

        if (isset($this->params['routing'])) {
            $queryParams[] = $this->params['routing'];
        }

        if (isset($queryParams)) {
            $queryParams = '?' . implode("&", $queryParams);
        } else {
            $queryParams = '';
        }

        $index = $this->extractArgument($params, 'index');
        unset($params['index']);

        $type = $this->extractArgument($params, 'type');
        unset($params['type']);

        $body = $this->extractArgument($params, 'body');
        unset($params['body']);

        $searchParams = array(
            "index" => $index,
            "type" => $type,
            "body" => $finalQuery
        );
        $resultSet = $this->client->search($searchParams);
        return $resultSet;

    }


    /**
     * Return a JSON representation of the final search request
     *
     * @return string
     */
    public function toJSON()
    {
        $finalQuery = $this->composeFinalQuery();

        return $finalQuery;
    }


    /**
     * Composes the final query, aggregating together the queries, filters, facets and associated parameters
     *
     * @return string
     * @throws \Holmes\common\exceptions\RuntimeException
     */
    private function composeFinalQuery()
    {
        $finalQuery = array();

        if (isset($this->params['fields'])) {
            $finalQuery['fields'] = $this->params['fields'];
        }

        if (isset($this->params['query']) && $this->params['query'] instanceof components\QueryInterface) {
            $finalQuery['query'] = $this->params['query']->toArray();
        }

        if (isset($this->params['filter']) && $this->params['filter'] instanceof components\FilterInterface) {
            $finalQuery['filter'] = $this->params['filter']->toArray();
        }

        if (isset($this->params['facets'])) {
            $tFacets = array();
            foreach ($this->params['facets'] as $facet) {
                //@todo Investigate a better way of doing this
                //array_merge is supposedly slow when merging arrays of arrays
                if ($facet instanceof FacetInterface) {
                    $tFacets = array_merge($tFacets, $facet->toArray());
                }
            }
            $finalQuery['facets'] = $tFacets;
            unset($tFacets);
        }

        if (isset($this->params['highlight']) && $this->params['highlight'] instanceof components\HighlightInterface) {
            $finalQuery['highlight'] = $this->params['highlight']->toArray();
        }

        foreach (array('from', 'size', 'timeout', 'sort', 'min_score') as $key) {
            if (isset($this->params[$key])) {
                $finalQuery[$key] = $this->params[$key];
            }
        }

        $finalQuery = json_encode($finalQuery, true);

        return $finalQuery;
    }

    /**
     * @param $response
     * @return \Holmes\responses\QueryResponse|\Holmes\responses\Response
     */
    protected function getReturnResponse($response)
    {
        return new QueryResponse($response);
    }

}
