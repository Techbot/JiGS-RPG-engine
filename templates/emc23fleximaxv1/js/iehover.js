sfHovernav = function() {
	var lis = document.getElementById("nav").getElementsByTagName("LI");
	for (var i=0; i<lis.length; i++) {
		lis[i].onmouseover=function() {
			this.className+=" iehover";
			}
			lis[i].onmouseout=function() {
				this.className=this.className.replace(new RegExp(" iehover\\b"), "");
				}
			}
		}
if (window.attachEvent) window.attachEvent("onload", sfHovernav);

sfHoverleft = function() {
	var lis = document.getElementById("left").getElementsByTagName("LI");
	for (var i=0; i<lis.length; i++) {
		lis[i].onmouseover=function() {
			this.className+=" iehover";
			}
			lis[i].onmouseout=function() {
				this.className=this.className.replace(new RegExp(" iehover\\b"), "");
				}
			}
		}
if (window.attachEvent) window.attachEvent("onload", sfHoverleft);

sfHoverright = function() {
	var lis = document.getElementById("right").getElementsByTagName("LI");
	for (var i=0; i<lis.length; i++) {
		lis[i].onmouseover=function() {
			this.className+=" iehover";
			}
			lis[i].onmouseout=function() {
				this.className=this.className.replace(new RegExp(" iehover\\b"), "");
				}
			}
		}
if (window.attachEvent) window.attachEvent("onload", sfHoverright);