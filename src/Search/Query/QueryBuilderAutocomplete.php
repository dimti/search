<?php namespace Search\Query;

class QueryBuilderAutocomplete extends QueryBuilderApi
{
    const INDEX_AUTOCOMPLETE = 0;

    private static $index_name = array(
        self::INDEX_AUTOCOMPLETE => 'autocomplete',
    );

    public $data = array();

    private $sphinx_model;

    public function __construct($query)
    {
        $this->sphinx_model = new SphinxModel();

        parent::__construct($query);
    }

    public function execute()
    {
        $this->data = json_encode($this->sphinx_model->getListByKeyword($this->getQuery(), self::$index_name[self::INDEX_AUTOCOMPLETE]));
    }
}
