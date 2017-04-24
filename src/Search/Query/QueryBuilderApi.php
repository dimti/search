<?php namespace Search\Query;

abstract class QueryBuilderApi
{
    /**
     * @var \Sphinx\SphinxClient
     */
    protected $cl;

    protected $data = [];

    protected $query;

    public function __construct($query)
    {
        $this->setQuery($query);

        $this->cl = new \Sphinx\SphinxClient();
    }

    protected function sendQueryToIndexAndReturnMatches($index_name)
    {
        $result = $this->cl->Query($this->getQuery(), $index_name);

        if ($result === false) {
            $this->data['error_message'] = 'Query failed: ' . $this->cl->GetLastError();
        } else {
            if ($this->cl->GetLastWarning()) {
                $this->data['error_message'] = 'WARNING: ' . $this->cl->GetLastWarning();
            }

            if (!empty($result['matches'])) {
                return $result['matches'];
            }
        }
        return false;
    }

    protected function setQuery($query)
    {
        $this->query = $query;
    }

    protected function getQuery()
    {
        return $this->query;
    }
}