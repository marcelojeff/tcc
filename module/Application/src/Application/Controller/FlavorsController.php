<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\Flavors;
use Zend\View\Model\JsonModel;

/**
 * FlavorsController
 *
 * @author
 *
 *
 * @version
 *
 *
 */
class FlavorsController extends AbstractActionController
{

    private function getUrl($url, $proxy = false){
    	//echo $url;
    	$ch = curl_init();
    	$timeout = 0; // set to zero for no timeout
    	curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    	curl_setopt ($ch, CURLOPT_URL, $url);
    	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
    	/*curl_setopt($ch, CURLOPT_HTTPHEADER, array('content-type: application/x-www-form-urlencoded', 
      												sparql-results+json));*/
    	if($proxy){
    		curl_setopt($ch, CURLOPT_PROXY, "http://proxy.cedeteg.unicentro.br"); //your proxy url
    		curl_setopt($ch, CURLOPT_PROXYPORT, "8080"); // your proxy port number
    		curl_setopt($ch, CURLOPT_PROXYUSERPWD, "sboss:123456"); //username:pass
    	}
    	$file_contents = curl_exec($ch);
    	curl_close($ch);
    	return $file_contents;
    }
    public function indexAction ()
    {
        // TODO Auto-generated FlavorsController::indexAction() default action
        return new ViewModel();
    }
    public function getAbstractAction(){
        $resource = 'http://dbpedia.org/resource/' . $_GET['resource'];
        
        $query = "PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
        PREFIX dbpedia-owl: <http://dbpedia.org/ontology/>
        SELECT ?abst WHERE {
        <$resource> dbpedia-owl:abstract ?abst .
        FILTER langMatches( lang(?abst), 'pt')
        }";
        //echo $query;
            
            
        /*$(this).append('<embed src="http://translate.google.com/translate_tts?ie=UTF-8&q=Bacon&tl=en&total=1&idx=0&textlen=5&prev=input" height="0" width="0">');
        $url = "http://dbpedia.org/sparql?default-graph-uri=http://dbpedia.org&query=" + escape($query) + "&format=json";*/
        $url = 'http://dbpedia.org/sparql?default-graph-uri=http://dbpedia.org&query=' . urlencode($query) . '&format=json';
        $data = json_decode ( $this->getUrl( $url ), true );
        //print_r($data);exit;
        $result = $data ['results']['bindings'];
        		//var_dump($result);
        //echo json_encode( $result );
        $result = new JsonModel($result);
        return $result;
    }
   
    
    public function listAction ()
    {
        $pizzeria = $this->params('pizzeria');
        $product = $this->params('product');
        $flavors = new Flavors();
        $results = $flavors->getList($pizzeria, $product);
        return array(
            'flavors' => $results['flavors'],
            'ingredients' => $results['ingredients']
        );
    }
}