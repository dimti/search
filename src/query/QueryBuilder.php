<?php namespace Dimti\Search\Query;

class QueryBuilder extends QueryBuilderApi
{
    const INDEX_PRODUCTS = 0;

    static $index_name = array(
        self::INDEX_PRODUCTS => 'products',
    );

    public $data = array();

    public function execute()
    {
        $this->cl->SetServer('localhost');

        $this->cl->SetMatchMode(\Sphinx\SphinxClient::SPH_MATCH_ALL);

        $this->cl->SetLimits(0, 1000);

//            $this->cl->SetSortMode(SPH_SORT_RELEVANCE);

        $this->cl->SetSortMode(\Sphinx\SphinxClient::SPH_SORT_EXTENDED, '@weight DESC, @id ASC');

        $this->cl->SetFieldWeights([

            ]
        );
        $this->data[self::INDEX_PRODUCTS]
            = $this->sendQueryToIndexAndReturnMatches(self::$index_name[self::INDEX_PRODUCTS]) ?
            : array();
    }
}
