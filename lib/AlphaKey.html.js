(function(){
	if (typeof AlphaKey=='function'){
		var __REFRESH_ALPHA_KEYS__=function(){
			var __ALPHA_KEY_ELEMENTS__=[...document.getElementsByTagName("AlphaKey")];
			__ALPHA_KEY_ELEMENTS__.forEach(function(el){
				if((!el.hasAttribute("solved"))&&el.hasAttribute("fn")&&el.hasAttribute("target")&&(typeof eval(el.getAttribute("fn"))=="function")){
					var __OPTIONS__={};
					if(el.hasAttribute("options")&&(typeof eval("("+el.getAttribute("options")+")")=="object")){
						__OPTIONS__ = eval("("+el.getAttribute("options")+")");
					}
					var solver=AlphaKey(__OPTIONS__);
					el.innerText=solver.testAgainst(eval(el.getAttribute("fn")),el.getAttribute("target"));
					el.setAttribute("solved","true");
				}
			});
		};
		if(document.readyState=="complete"){__REFRESH_ALPHA_KEYS__();}
		else{window.addEventListener("load",__REFRESH_ALPHA_KEYS__);}
		window.addEventListener("load",function(){
			var __OBSERVER__=new MutationObserver(__REFRESH_ALPHA_KEYS__);
			__OBSERVER__.observe(document.body,{childList:true});
		});
	}
})();
