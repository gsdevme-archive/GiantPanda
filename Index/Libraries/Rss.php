<?php

	namespace Libraries;

	use \Exception;
	use \DOMDocument;
	use \stdClass;

	/**
	 * Quick class to pull down the latest commits from the RSS feed
	 */
	class Rss
	{

		public function get($url, $node='item')
		{
			try {
				$rss = file_get_contents($url, false, stream_context_create(array(
						'http' => array(
							'method' => 'GET',
							'user_agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_3) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.56 Safari/535.11'
						))));
			} catch (Exception $e) {
				return null;
			}

			if(($rss) && (!empty($rss))){
				$return = array();
				$doc = new DOMDocument('1.0', 'UTF-8');
				$doc->loadXML($rss);

				foreach ($doc->getElementsByTagName($node) as $entry) {	
					$data = new stdClass;

				    foreach($entry->getElementsByTagName('*') as $childNodes){
				    	$name = strtolower($childNodes->tagName);

				    	switch($name){
				    		case 'link':
				    			$data->$name = strip_tags($childNodes->getAttribute('href'));
				    			break;
				    		default:
				    			$data->$name = $childNodes->nodeValue;
				    			break;
				    	}
				    }

				    array_push($return, $data);
				}

				return $return;
			}			

			return null;
		}

	}