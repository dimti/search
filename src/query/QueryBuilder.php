<?php namespace Dimti\Search\Query;

class QueryBuilder extends QueryBuilderApi
{
    public $data = array();

    public function execute($index_name)
    {
        $this->cl->SetServer('localhost');

        $this->cl->SetMatchMode(\Sphinx\SphinxClient::SPH_MATCH_ALL);

        $this->cl->SetLimits(0, 1000);

//            $this->cl->SetSortMode(SPH_SORT_RELEVANCE);

        $this->cl->SetSortMode(\Sphinx\SphinxClient::SPH_SORT_EXTENDED, '@weight DESC, @id ASC');

        $this->cl->SetFieldWeights([

            ]
        );
        $this->data[$index_name]
            = $this->sendQueryToIndexAndReturnMatches($index_name) ?
            : array();
    }
}
