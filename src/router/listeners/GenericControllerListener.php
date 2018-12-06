<?php
namespace de\hannespries\router\listeners;

use de\hannespries\router\ResolveResult;
use de\hannespries\router\RouterListener;

class GenericControllerListener implements RouterListener {
	
	private static $singletons = [];

	public function checkType($type) {
		return strtolower($type) == 'controller';
	}

	public function call($data, $args = []) {
		$result = new ResolveResult();
		try{
			$clazz = $data['class'];
			$method = $data['method'];
			
			$singleton = strtolower($data['singleton']) == 'true';
			
			$obj = null;
			$ref = new \ReflectionClass($clazz);
			if($singleton){
				if(isset(self::$singletons[$clazz])){					
					$obj = $ref->newInstance();
					self::$singletons[$clazz] = $obj;
				}
				else{
					$obj = self::$singletons[$clazz];
				}
			}
			else{
				$obj = $ref->newInstance();
			}
			
			$content = $ref->getMethod($method)->invokeArgs($obj, $args);
			
			$result->setContent($content);
			$result->setType(get_class($content));
		}
		catch(\Exception $e){
			$result->setException($e);
		}
		return $result;
	}

}