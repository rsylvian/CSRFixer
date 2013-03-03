var CSRFixerServiceLocation = "../server_side/CSRFixer/Service.php",
    CSRFixerToken = null;

function getRequestObject(){

    var o = null;
    if (window.XMLHttpRequest)
    	o = new XMLHttpRequest();
    else if(window.ActiveXObject)
    {
        try {
            o = new ActiveXObject('Msxml2.XMLHTTP');
        } catch(e1) {
            try {
                o = new ActiveXObject('Microsoft.XMLHTTP');
            } catch(e2){

            }
        }
    }
    return o;
}

function request(adress, callback){

    var o = getRequestObject();
    var async = (callback !== null);

    o.open("GET", adress, async);
    o.send();
    
    if (async)
    {
        o.onreadystatechange = function() {
        	if (o.readyState == 4 && o.status == 200)
        		callback(JSON.parse(o.responseText));
        };
        return;
    }

   	return o.responseText;
}

window.onload = function() { 

    function getToken() {
        request(CSRFixerServiceLocation, function(d){
			CSRFixerToken = d.token;
		});
    }

    getToken();
    this.setInterval(getToken, 30000);
}

