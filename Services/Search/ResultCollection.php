<?php

namespace Search\SphinxsearchBundle\Services\Search;
use Doctrine\ODM\MongoDB\DocumentManager;

class ResultCollection implements CollectionInterface
{
    /**
     * Array of SearchResultInterface
     *
     * @var Array
     */
    private $results;


    public function __construct($rawResults, MappingCollection $mapping = null, DocumentManager $dm = null)
    {
       // echo 'result_collect';
        foreach ($rawResults as $indexName => $result) {
            $this->results[$indexName] = new IndexSearchResult($indexName, $result,$mapping,$dm);
        }
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->results);
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->results);
    }

    /**
     * @param $indexName
     * @return IndexSearchResult
     */
    public function get($indexName)
    {
        return $this->results[$indexName];
    }
}

