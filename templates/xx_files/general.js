var Cookie = {

	get: function(name)
	{
		cookies = document.cookie;
		name = name+"=";
		cookiePos = cookies.indexOf(name);
		
		if(cookiePos != -1) 
		{
			cookieStart = cookiePos+name.length;
			cookieEnd = cookies.indexOf(";", cookieStart);
			
			if(cookieEnd == -1) 
			{
				cookieEnd = cookies.length;
			}
			
			return unescape(cookies.substring(cookieStart, cookieEnd));
		}
	},

	set: function(name, value, expires)
	{
		if(!expires) 
		{
			expires = "; expires=Wed, 1 Jan 2020 00:00:00 GMT;"
		} 
		else 
		{
			expire = new Date();
			expire.setTime(expire.getTime()+(expires*1000));
			expires = "; expires="+expire.toGMTString();
		}
		
		if(cookieDomain) 
		{
			domain = "; domain="+cookieDomain;
		}
		else
		{
			domain = "";
		}
		
		if(cookiePath != "") 
		{
			path = cookiePath;
		}
		else
		{
			path = "";
		}
		
		document.cookie = name+"="+escape(value)+"; path="+path+domain+expires;
	},

	unset: function(name)
	{
		Cookie.set(name, 0, -1);
	}
}

var DomLib = {

	addClass: function(element, name)
	{
		if(element)
		{
			if(element.className != "")
			{
				element.className += " "+name;
			}
			else
			{
				element.className = name;
			}
		}
	},

	removeClass: function(element, name)
	{
		if(element.className == element.className.replace(" ", "-"))
		{
			element.className = element.className.replace(name, "");
		}
		else
		{
			element.className = element.className.replace(" "+name, "");
		}
	},

	getElementsByClassName: function(oElm, strTagName, strClassName)
	{
	    var arrElements = (strTagName == "*" && document.all)? document.all : oElm.getElementsByTagName(strTagName);
	    var arrReturnElements = new Array();
	    strClassName = strClassName.replace(/\-/g, "\\-");
	    var oRegExp = new RegExp("(^|\\s)" + strClassName + "(\\s|$)");
	    var oElement;
		
	    for(var i=0; i < arrElements.length; ++i)
		{
	        oElement = arrElements[i];
			
	        if(oRegExp.test(oElement.className))
			{
	            arrReturnElements.push(oElement);
	        }
	    }
		
	    return (arrReturnElements)
	},

	// This function is from quirksmode.org
	// Modified for use in MyBB
	getPageScroll: function()
	{
		var yScroll;
		
		if(self.pageYOffset)
		{
			yScroll = self.pageYOffset;
		}
		else if(document.documentElement && document.documentElement.scrollTop) // Explorer 6 Strict
		{
			yScroll = document.documentElement.scrollTop;
		}
		else if(document.body) // all other Explorers
		{
			yScroll = document.body.scrollTop;
		}
		
		arrayPageScroll = new Array('',yScroll);
		
		return arrayPageScroll;
	},

	// This function is from quirksmode.org
	// Modified for use in MyBB
	getPageSize: function()
	{
		var xScroll, yScroll;

		if(window.innerHeight && window.scrollMaxY)
		{
			xScroll = document.body.scrollWidth;
			yScroll = window.innerHeight + window.scrollMaxY;
		}
		else if(document.body.scrollHeight > document.body.offsetHeight) // All but Explorer Mac
		{
			xScroll = document.body.scrollWidth;
			yScroll = document.body.scrollHeight;
		}
		else  // Explorer Mac...would also work in Explorer 6 Strict, Mozilla and Safari
		{
			xScroll = document.body.offsetWidth;
			yScroll = document.body.offsetHeight;
		}

		var windowWidth, windowHeight;
		if(self.innerHeight) // all except Explorer
		{
			windowWidth = self.innerWidth;
			windowHeight = self.innerHeight;
		}
		else if(document.documentElement && document.documentElement.clientHeight)  // Explorer 6 Strict Mode
		{
			windowWidth = document.documentElement.clientWidth;
			windowHeight = document.documentElement.clientHeight;
		}
		else if (document.body) // other Explorers
		{
			windowWidth = document.body.clientWidth;
			windowHeight = document.body.clientHeight;
		}
		
		var pageHeight, pageWidth;
		
		// For small pages with total height less then height of the viewport
		if(yScroll < windowHeight)
		{
			pageHeight = windowHeight;
		}
		else
		{
			pageHeight = yScroll;
		}

		// For small pages with total width less then width of the viewport
		if(xScroll < windowWidth)
		{
			pageWidth = windowWidth;
		}
		else
		{
			pageWidth = xScroll;
		}
		
		var arrayPageSize = new Array(pageWidth,pageHeight,windowWidth,windowHeight);
		
		return arrayPageSize;
	}

}

var ActivityIndicator = Class.create();

ActivityIndicator.prototype = {
	initialize: function(owner, options)
	{
		var image;
		
		if(options && options.image)
		{
			image = "<img src=\""+options.image+"\" alt=\"\" />";
		}
		else
		{
			image = "";
		}
		
		this.height = options.height || 150;
		this.width = options.width || 150;
		
		if(owner == "body")
		{
			arrayPageSize = DomLib.getPageSize();
			arrayPageScroll = DomLib.getPageScroll();
			var top = arrayPageScroll[1] + ((arrayPageSize[3] - 35 - this.height) / 2);
			var left = ((arrayPageSize[0] - 20 - this.width) / 2);
			owner = document.getElementsByTagName("body").item(0);
		}
		else
		{
			if($(owner))
			{
				owner = $(owner);
			}
			
			element = owner;
			top = left = 0;
			
			do
			{
				top += element.offsetTop || 0;
				left += element.offsetLeft || 0;
				element = element.offsetParent;
			} while(element);

			left += owner.offsetWidth;
			top += owner.offsetHeight;
		}
		
		this.spinner = document.createElement("div");
		this.spinner.style.border = "1px solid #000000";
		this.spinner.style.background = "#FFFFFF";
		this.spinner.style.position = "absolute";
		this.spinner.style.zIndex = 1000;
		this.spinner.style.textAlign = "center";
		this.spinner.style.verticalAlign = "middle";

		this.spinner.innerHTML = "<br />"+image+"<br /><br /><strong>Loading</strong>";
		this.spinner.style.width = this.width + "px";
		this.spinner.style.height = this.height + "px";
		this.spinner.style.top = top + "px";
		this.spinner.style.left = left + "px";
		this.spinner.id = "spinner";
		owner.insertBefore(this.spinner, owner.firstChild);
	},

	destroy: function()
	{
		Element.remove(this.spinner);
	}
}