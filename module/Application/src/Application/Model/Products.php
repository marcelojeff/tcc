<?php
namespace Application\Model;

class Products extends Neo4jClient {
    /**
     * Get product list from a especific pizzeria
     * @param int $pizzeria id
     * @return array List of products with all information about them 
     */
    public function getProductsByPizzeria ($pizzeria){
        $queryString = "START n=node($pizzeria)
                    	MATCH (n)-[relation:SELLS]->(product)
                        WITH product, relation
                        MATCH (type)<-[:IS]-(product)-[:HAS]->(size)
                    	RETURN product, relation, type, size";
        return $this->executeQuery($queryString);
    }
}

?>