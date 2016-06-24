<?php namespace Dimti\Search;

use Dimti\Search\Query\QueryBuilder;

class Search
{
    const INDEX_PRODUCTS = 0;

    const INDEX_PRODUCTS_SUPPLEMENTAL = 1;

    protected $search_results;

    protected $queryBuilder;

    public function __construct($query) {
        $this->queryBuilder = new QueryBuilder($query);
    }

    public function processSearchResults()
    {
        if (is_null($this->search_results)) {
            $this->queryBuilder->execute();

            $this->search_results = $this->queryBuilder->data[Search::INDEX_PRODUCTS];

        }
    }

    public function getIdsFromResult($matches_name)
    {
        return array_keys($this->search_results);

        /*
        if (isset($this->search_results[$matches_name]) && is_array($this->search_results[$matches_name])) {
            return array_keys($this->search_results[$matches_name]);
        }
        */
    }
}
