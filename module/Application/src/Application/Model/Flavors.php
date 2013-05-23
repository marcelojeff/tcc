<?php
namespace Application\Model;

use Application\Model\Neo4jClient;
use Everyman\Neo4j\Traversal;
use Everyman\Neo4j\Relationship;

class Flavors extends Neo4jClient {
    
    public function getList($pizzeria, $product){
        //TODO retrive relation properties
        $queryString = "START n=node($product), p=node($pizzeria)
                    	MATCH (n)<-[:FOR]-(flavor)<-[:SELLS_F]-(p)
                        WITH flavor
                        MATCH (flavor)-[:IS]->(flavorName)
                        RETURN flavor, flavorName";
        $resultSet = $this->executeQuery($queryString);
        
        $relationships = array(
        		'HAS' => Relationship::DirectionOut
        );
        $traversal = $this->setTraversal($relationships, 1);
        foreach ($resultSet as $row) {
        	$flavorId = $row['flavorName']->getId();
        	$ingredients[$flavorId] = $traversal->getResults($row['flavorName'], Traversal::ReturnTypeNode);
        }
        return array('flavors' => $resultSet, 'ingredients' => $ingredients);
    }
}

?>