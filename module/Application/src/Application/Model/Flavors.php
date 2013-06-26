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
    public function getAll(){
        $query = "START n=node(0) ".
            "MATCH (n)-[:FLAVOR]->(flavors) ".
            "RETURN flavors";
        $resultSet = $this->executeQuery($query);
        return $resultSet;
        /*$relationships = array(
        		'HAS' => Relationship::DirectionOut
        );
        $traversal = $this->setTraversal($relationships, 1);
        foreach ($resultSet as $row) {
        	$flavorId = $row['flavors']->getId();
        	$ingredients[$flavorId] = $traversal->getResults($row['flavors'], Traversal::ReturnTypeNode);
        }
        return array('flavors' => $resultSet, 'ingredients' => $ingredients);*/
    }
    //TODO apagar relação
    public function setIngredients($ingredients, $flavor) {
        $flavor = $this->client->getNode($flavor);
        foreach ($ingredients as $ingredient) {
            $ingredientNode = $this->client->getNode($ingredient);
            $paths = $flavor->findPathsTo($ingredientNode, 'HAS', Relationship::DirectionOut)
                            ->setMaxDepth(1)
                            ->getPaths();
            if(empty($paths)){
                $flavor->relateTo($ingredientNode, 'HAS')->save();
            }
            
        }
    }
}

?>