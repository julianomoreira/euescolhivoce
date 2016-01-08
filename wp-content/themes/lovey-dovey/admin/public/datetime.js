(function($){

	isNumber = function(n) {
	  return !isNaN(parseFloat(n)) && isFinite(n);
	};

	parseOpt = function(optString) {
		var openIdx, closeIdx, temp, idx, key, val, theval, opt = {};
		for (var i = 0; i < optString.length; i++)
		{
			if (optString[i] == '(')
			{
				openIdx = i;
			}
			if (optString[i] == ')')
			{
				closeIdx = i;
				temp = optString.substring(openIdx + 1, closeIdx);

				idx  = temp.indexOf(':');
				key  = temp.substring(0, idx);
				val  = temp.substring(idx + 1);

				if( val.charAt(0) === "'" && val.slice(-1) === "'" )
				{
					theval = val.slice(1, -1);
					theval = isNumber(theval) ? parseFloat(theval) : theval;
				}
				else
				{
					if( val === 'true' )
						theval = true;
					if( val === 'false' )
						theval = false;
				}

				tempArr  = temp.split(':');
				opt[key] = theval;
			}
		}
		return opt;
	}

	$('.ld-js-datetime').each(function() {
		var options = $(this).data();
		options     = parseOpt(options.vpOpt);
		console.log(options);
		$(this).datetimepicker(options);
	});

})(jQuery);