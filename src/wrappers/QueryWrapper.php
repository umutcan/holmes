<?php
/**
 * User: Zachary Tong
 * Date: 2/10/13
 * Time: 1:05 PM
 */
namespace Holmes\wrappers;

use Holmes\components\queries;

/**
 * @method \Holmes\components\queries\Bool Bool() Bool()
 * @method \Holmes\components\queries\Boosting Boosting() Boosting()
 * @method \Holmes\components\queries\ConstantScore ConstantScore() ConstantScore()
 * @method \Holmes\components\queries\CustomBoostFactor CustomBoostFactor() CustomBoostFactor()
 * @method \Holmes\components\queries\CustomFiltersScore CustomFiltersScore() CustomFiltersScore()
 * @method \Holmes\components\queries\CustomScore CustomScore() CustomScore()
 * @method \Holmes\components\queries\DisMax DisMax() DisMax()
 * @method \Holmes\components\queries\Field Field() Field()
 * @method \Holmes\components\queries\FilteredQuery FilteredQuery() FilteredQuery()
 * @method \Holmes\components\queries\Fuzzy Fuzzy() Fuzzy()
 * @method \Holmes\components\queries\FuzzyLikeThis FuzzyLikeThis() FuzzyLikeThis()
 * @method \Holmes\components\queries\FuzzyLikeThisField FuzzyLikeThisField() FuzzyLikeThisField()
 * @method \Holmes\components\queries\HasChild HasChild() HasChild()
 * @method \Holmes\components\queries\HasParent HasParent() HasParent()
 * @method \Holmes\components\queries\Ids Ids() Ids()
 * @method \Holmes\components\queries\Indices Indices() Indices()
 * @method \Holmes\components\queries\Match Match() Match()
 * @method \Holmes\components\queries\MatchAll MatchAll() MatchAll()
 * @method \Holmes\components\queries\MoreLikeThis MoreLikeThis() MoreLikeThis()
 * @method \Holmes\components\queries\MoreLikeThisField MoreLikeThisField() MoreLikeThisField()
 * @method \Holmes\components\queries\Nested Nested() Nested()
 * @method \Holmes\components\queries\Prefix Prefix() Prefix()
 * @method \Holmes\components\queries\QueryString QueryString() QueryString()
 * @method \Holmes\components\queries\QueryStringMultiField QueryStringMultiField() QueryStringMultiField()
 * @method \Holmes\components\queries\Range Range() Range()
 * @method \Holmes\components\queries\Term Term() Term()
 * @method \Holmes\components\queries\Terms Terms() Terms()
 * @method \Holmes\components\queries\TopChildren TopChildren() TopChildren()
 * @method \Holmes\components\queries\Wildcard Wildcard() Wildcard()
 * @method \Holmes\components\queries\Raw Raw() Raw()
 */
class QueryWrapper
{
    /**
     * @var \Holmes\components\QueryInterface
     */
    protected $query;


    public function __call($name, $arguments)
    {
        $class = '\\Holmes\\components\\queries\\' . $name;

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
