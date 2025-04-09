var setCheck = setInterval(function(){chekUpdate()},1000);
var statOld  = "";
function chekUpdate()
{
	$.ajax({
		type: "GET",
		url: HTTP+"/php/live/live.php",
		success: function(output)
		{
			let statNew = output;
	        if((statOld != "") && (statOld != statNew))
	        {
	        	minifyJs();
	        	setInterval(function(){ location.reload(); },500);
	        }
	        statOld = statNew;
		}
	});
}


function minifyJs()
{
	$.ajax({
		type: "GET",
		url: HTTP+"/php/live/minify-js.php"
	});
}