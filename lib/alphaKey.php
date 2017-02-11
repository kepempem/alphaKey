<?php
	/**
		* @author Shani Shlapobersky
		* @see {AlphaKey}
		* @return {AlphaKey} an AlphaKey object.
		* @param options an {Object} of settings.
		* @license MIT
	*/
	class AlphaKey{
		private $defaults = array(
			"key" => ' abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ',
			"TESTING_LENGTH" => 1,
			"TESTING_MAX_VALUE" => PHP_INT_MAX,
			"TESTING_ZERO_INDEX_MAX_VALUE" => 3
		);
		private static function CI_HasAttr($obj,$property){
			if (array_key_exists($property,$obj)){return true;}
			foreach ($obj as $key => $value) {
				if(strtoupper($key)==strtoupper($property)){return true;}
			}
			return false;
		}
		private static function CI_GetAttr($obj,$property){
			if (array_key_exists($property,$obj)){return $obj[$property];}
			foreach ($obj as $key => $value) {
				if(strtoupper($key)==strtoupper($property)){return $obj[$key];}
			}
			return false;
		}
		private static function CI_GetAttrName($obj,$property){
			if (array_key_exists($property,$obj)){return $property;}
			foreach ($obj as $key => $value) {
				if(strtoupper($key)==strtoupper($property)){return $key;}
			}
			return false;
		}
		public function test($index){
			$index = abs($index);
			$r = $index%strlen($this->options[$this->CI_GetAttrName($this->options,'key')]);
			if ($index-$r==0){
				$result = $this->at($r);
			}else{
				$result = $this->test(($index-$r)/strlen($this->options[$this->CI_GetAttrName($this->options,'key')])).$this->at($r);
			}
			return $result;
		}
		private function at($index){
			return $this->options[$this->CI_GetAttrName($this->options,'key')][$index];
		}
		public function testAgainst($fn,$target){
			for($i=0;$i<=$this->CI_GetAttr($this->options,"TESTING_MAX_VALUE");$i++){
				$new_i = $i + pow(strlen($this->CI_GetAttr($this->options,"key")),($this->CI_GetAttr($this->options,"TESTING_LENGTH")-1));
				$result = $fn($this->test($new_i));
				$guess = $this->test($new_i);
				if ($result==$target){return $guess;}
				if($this->CI_GetAttr($this->options,"TESTING_ZERO_INDEX_MAX_VALUE")>0){
					for($c = 1; $c<=$this->CI_GetAttr($this->options,"TESTING_ZERO_INDEX_MAX_VALUE"); $c++){
						if($fn((str_repeat($this->at(0),$c)).$guess)==$target){
							return (str_repeat($this->at(0),$c)).$guess;
						}
					}
				}
			}
			return INF;
		}
		public function setKey($key=$this->defaults["key"]){
			$key = (string) $key;
			if (strlen($key)>0){
				$this->options[$this->CI_GetAttrName($this->options,"key")] = $key;
			} else {
				$this->options[$this->CI_GetAttrName($this->options,"key")] = $this->defaults['key'];
			}
		}
		public function setTestingLength($testingLength=$this->defaults["TESTING_LENGTH"]){
			$testingLength = abs((int) $testingLength);
			$maxTestingLength = strlen($this->test($this->options[$this->CI_GetAttrName($this->options,"TESTING_MAX_VALUE")]));
			if ($testingLength>$maxTestingLength){
				$testingLength = $maxTestingLength;
			} elseif ($testingLength<1) {
				$testingLength = 1;
			}
			$this->options[$this->CI_GetAttrName($this->options,"TESTING_LENGTH")] = $testingLength;
		}
		public function setTestingMaxValue($testingMaxValue=$this->defaults["TESTING_MAX_VALUE"]){
			$testingMaxValue = abs((int) $testingMaxValue);
			if ($testingMaxValue>PHP_INT_MAX){
				$testingMaxValue = PHP_INT_MAX;
			} elseif ($testingMaxValue<1){
				$testingMaxValue = 1;
			}
			$this->options[$this->CI_GetAttrName($this->options,"TESTING_MAX_VALUE")] = $testingMaxValue;
		}
		public function setTestingZeroIndexMaxValue($testingZeroIndexMaxValue=$this->defaults["TESTING_ZERO_INDEX_MAX_VALUE"]){
			$testingZeroIndexMaxValue = abs((int) $testingZeroIndexMaxValue);
			if ($testingZeroIndexMaxValue>PHP_INT_MAX){
				$testingZeroIndexMaxValue = PHP_INT_MAX;
			} elseif ($testingZeroIndexMaxValue<1){
				$testingZeroIndexMaxValue = 1;
			}
			$this->options[$this->CI_GetAttrName($this->options,"TESTING_ZERO_INDEX_MAX_VALUE")] = $testingZeroIndexMaxValue;
		}
		function __construct($options=Array()){
			$this->options=$options;
			foreach ($this->options as $key => $value){
				if(!$this->CI_HasAttr($this->defaults,$key)){
					unset($this->options[$key]);
				}elseif (gettype($this->options[$key])!==gettype($this->CI_GetAttr($this->defaults,$key))){
					$this->options[$key] = $this->CI_GetAttr($this->defaults,$key);
				}
			}
			if(!$this->CI_HasAttr($this->options,"debug_function")){
				$this->options['debug_function'] = create_function('$result,$guess,$index','return INF;');
			} elseif ($this->CI_HasAttr($this->options,"debug_function")&&!gettype($this->CI_GetAttr($this->options,"debug_function"))!=gettype(create_function('$result,$guess,$index','return INF;'))){
				$this->options['debug_function'] = create_function('$result,$guess,$index','return INF;');
			}
			foreach($this->defaults as $key => $value){
				if(!$this->CI_HasAttr($this->options,$key)){
					$this->options[$key] = $this->CI_GetAttr($this->defaults,$key);
				}
			}
		}
	}
?>
