<?php
namespace Application\Model;

class Ingredients extends Neo4jClient{
    
    public function create($properties) {
    	return $this->insert($properties, 'INGREDIENT');
    }
    //TODO criar método generico para obter listagens simples
    public function getList(){
        $queryString = "START n=node(0) ".
        		"MATCH (n)-[:INGREDIENT]->(ingredients) ".
        		"RETURN ingredients";
        $resultSet = $this->executeQuery($queryString);
        foreach ($resultSet as $node){
        	$ingredients[] = $node['ingredients'];
        }
        return $ingredients; 
    }
    public function getListByFlavor($flavorId){
        $queryString = "START n=node($flavorId) ".
        		"MATCH (n)-[:HAS]->(ingredients) ".
        		"RETURN ingredients";
        
        $flavorIngredients = $this->executeQuery($queryString);
        $ingredients['in'] = $ingredients['out'] = array();
        foreach ($flavorIngredients as $node){
        	$ingredients['on'][] = $node['ingredients'];
        }
        $queryString = "START n=node(0), flavor=node($flavorId) ".
        		"MATCH (n)-[:INGREDIENT]->(ingredients) ".
        		"WHERE NOT(flavor-[:HAS]->ingredients) ".
        		"RETURN ingredients";
        $anotherIngredients = $this->executeQuery($queryString);
        $ingredients['out'] = array();
        foreach ($anotherIngredients as $node) {
        	$ingredients['out'][] = $node['ingredients'];
        }
        return $ingredients;
    }
}

?>