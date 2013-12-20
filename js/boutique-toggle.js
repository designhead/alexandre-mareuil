/* source: http://stackoverflow.com/questions/13063838/add-change-parameter-of-url-and-redirect-to-the-new-url */
function setGetParameter(paramName, paramValue)
{
	var url = window.location.href;
	if (url.indexOf(paramName + "=") >= 0)
	{
		var prefix = url.substring(0, url.indexOf(paramName));
		var suffix = url.substring(url.indexOf(paramName)).substring(url.indexOf("=") + 1);
		suffix = (suffix.indexOf("&") >= 0) ? suffix.substring(suffix.indexOf("&")) : "";
		url = prefix + paramName + "=" + paramValue + suffix;
	}
	else
	{
	if (url.indexOf("?") < 0)
		url += "?" + paramName + "=" + paramValue;
	else
		url += "&" + paramName + "=" + paramValue;
	}
	window.location.href = url;
}

jQuery(function($){
	/* turn boutique background off on click */
	$('ul.sub-menu li.boutique-off').on('click', setGetParameter('boutique', 'off') );

	/* turn boutique background on on click */
	$('ul.sub-menu li.boutique-on').on('click', setGetParameter('boutique', 'on') );

});
