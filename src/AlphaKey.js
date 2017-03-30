/**
	* @constructor
	* @author Shani Shlapobersky
	* @this {AlphaKey}
	* @see {AlphaKey}
	* @returns {AlphaKey} an AlphaKey object.
	* @param options an {Object} of settings.
	* @license MIT
*/
function AlphaKey(options={}){
	if (!(this instanceof AlphaKey)){return new AlphaKey(options);}
	this.defaults={
		key:" abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ",
		debug_function:function(result,guess,index){},
		TESTING_LENGTH:1,
		TESTING_MAX_VALUE:Number.MAX_VALUE,
		TESTING_ZERO_INDEX_MAX_VALUE:3,
		MULTI_MATCHES: false
	};
	this.defaults.TESTING_MAX_LENGTH = this.test(this.defaults.TESTING_MAX_VALUE).length+1;
	var properties = (function(defaults){var ar=[];for(var key in defaults){ar.push(key);}return ar;})(this.defaults);
	this.options=options;
	for(var p in this.options){
		for(var i=0;i<=properties.length;i++){
			if(i==properties.length){delete this.options[p];break;}
			if(p.toLowerCase()==properties[i].toLowerCase()){
				this.options[properties[i]]=this.options[p];
				if (p!=properties[i]){
					delete this.options[p];
				}
				break;
			}
		}
	}
	for(var d in this.defaults){
		if(!this.options.hasOwnProperty(d)||typeof(this.options[d])!=typeof(this.defaults[d])){
			this.options[d]=this.defaults[d];
		}
	}
}
AlphaKey.prototype = {
	options:{},
	testAgainst:function(fn,target){
		if (typeof fn=='string'){
			fn=new Function(fn);
		}
		if (typeof fn=='function'){
			for(var c=0;c<=this.options.TESTING_MAX_VALUE;c++){
				var new_c = c+((this.options.test_length>0) ? Math.pow(this.options.key.length,this.options.test_length-1):0);
				var _GUESS = this.test(new_c);
				var _RESULT = fn(_GUESS);
				this.options.debug_function(_RESULT,_GUESS,new_c);
				if(_RESULT==target){
					return _GUESS;
				}
				if (this.options.TESTING_ZERO_INDEX_MAX_VALUE>0){
					for(var s=0;s<=this.options.TESTING_ZERO_INDEX_MAX_VALUE;s++){
						if(fn(this.at(0).repeat(s)+_GUESS)==target){
							return this.at(0).repeat(s)+_GUESS;
						}
					}
				}
			}
			throw new Error("No match found.");
			return Infinity;
		}
	},
	test:function(index){
		index=Math.abs(index);
		if(index==NaN){index=0;}else if(index==Infinity){index=this.options.TESTING_MAX_VALUE;}
		var r=index%this.options.key.length,result;
		if (index-r==0){
			result=this.at(r);
		}else{
			result=this.test((index-r)/this.options.key.length)+this.at(r);
		}
		return result;
	},
	at: function(index){
		return this.options.key.charAt(index);
	},
  setTestingLength: function(len=this.defaults.TESTING_LENGTH){
		if(len>=1&&len<=this.test(this.options.TESTING_MAX_VALUE).length){
			this.options.TESTING_LENGTH=len;
		}else if(len<1){
			this.options.TESTING_LENGTH=1;
		}else if(len>this.test(this.options.TESTING_MAX_VALUE).length){
			this.options.TESTING_LENGTH=this.test(this.options.TESTING_MAX_VALUE).length;
		}
  },
  setKey: function(key=this.defaults.key){
			if(key.toString().length>0){
				this.options.key=key.toString();
			} else {
				this.options.key=this.defaults.key;
			}
  },
	setTestingMaxValue: function(testingMaxValue=this.defaults.TESTING_MAX_VALUE){
		if (typeof testingMaxValue !== 'number'||testingMaxValue === Infinity) {
			if (parseInt(testingMaxValue)==NaN||testingMaxValue === Infinity){
				testingMaxValue = this.defaults.TESTING_MAX_VALUE;
			} else {
				testingMaxValue = parseInt(testingMaxValue);
			}
		}
		this.options.TESTING_MAX_VALUE = testingMaxValue;
	},
	setDebugFunction: function(debugFunction=this.defaults.debug_function){
		if (typeof debugFunction !== 'function') {
			debugFunction = new Function(debugFunction);
		}
		this.options.debug_function = debugFunction;
	},
	setTestingZeroIndexMaxValue: function(testingZeroIndexMaxValue=this.defaults.TESTING_ZERO_INDEX_MAX_VALUE){
		if (typeof testingZeroIndexMaxValue !== 'number'||testingZeroIndexMaxValue === Infinity) {
			if (parseInt(testingZeroIndexMaxValue)==NaN||testingZeroIndexMaxValue === Infinity){
				testingZeroIndexMaxValue = this.defaults.TESTING_MAX_VALUE;
			} else {
				testingZeroIndexMaxValue = parseInt(testingZeroIndexMaxValue);
			}
		}
		this.options.TESTING_ZERO_INDEX_MAX_VALUE = testingZeroIndexMaxValue;
	}
};
