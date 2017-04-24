<?php namespace Search;

use Search\Query\QueryBuilder;

class Search
{
    protected $search_results;

    protected $queryBuilder;

    public function __construct($query) {
        $this->queryBuilder = new QueryBuilder($query);
    }

    public function processSearchResults($index_name = 'products')
    {
        if (is_null($this->search_results)) {
            $this->queryBuilder->execute($index_name);

            $this->search_results = $this->queryBuilder->data[$index_name];

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
