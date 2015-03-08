window.onload = function() {
	
			//var datetoday = new Date();
			//var timenow=datetoday.getTime();
			//var datetoday.setTime(timenow);
			var thehour = new Date().getHours();
			
			if (thehour >= 20)
			 timeofday = "night";
			else if (thehour >= 17)
			 timeofday = "dusk";
			else if (thehour >= 9)
			 timeofday = "day";
			else if (thehour >= 5)
			 timeofday = "dawn";
			else
			 timeofday = "night";
			 
			$("body").addClass(timeofday);

};