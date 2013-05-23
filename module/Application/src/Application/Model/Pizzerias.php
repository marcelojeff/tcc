<?php
namespace Application\Model;

class Pizzerias extends Neo4jClient {
    /**
     * Get list of pizzerias
     * @return array of nodes type pizzeria
     */
    public function getList() {
        $queryString = "START n=node(0) ".
        		"MATCH (n)-[:PIZZARIA]->(pizzerias) ".
        		"RETURN pizzerias";
        $resultSet = $this->executeQuery($queryString);
        foreach ($resultSet as $node){
        	$pizzerias[] = $node['pizzerias'];
        }
        return $pizzerias;    
    }
}