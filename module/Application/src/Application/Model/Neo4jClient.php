<?php
namespace Application\Model;

use Everyman\Neo4j\Client;
use Everyman\Neo4j\Cypher\Query;
use Everyman\Neo4j\Traversal;

class Neo4jClient
{

    protected $client;

    function __construct ()
    {
        $this->client = new Client();
    }

    protected function executeQuery ($queryString)
    {
        $query = new Query($this->client, $queryString);
        return $query->getResultSet();
    }

    protected function setTraversal ($relationships, $maxDepth, $evaluator = Traversal::PruneNone, $filter = Traversal::ReturnAllButStart)
    {
        $traversal = new Traversal($this->client);
        foreach ($relationships as $type => $direction) {
            $traversal->addRelationship($type, $direction);
        }
        $traversal->setPruneEvaluator($evaluator)
            ->setReturnFilter($filter)
            ->setMaxDepth($maxDepth);
        return $traversal;
    }
    /**
     * 
     * @param array $properties['proprierty' => 'value']
     * @param string $type of node
     * @return node
     */
    protected function insert ($properties, $type)
    {
        //TODO check success or not (exeptions?)
        $node = $this->client->makeNode();
        $node->setProperties($properties)
             ->save();
        $root = $this->client->getNode(0);
        $root->relateTo($node, $type)->save();
        return $node;
    }
}