(function(){


getIframeIo = function(onSuccess, onError){
	var io = new goog.net.IframeIo();
	goog.events.listen(io, "success", onSuccess);
	goog.events.listen(io, "error", onError);
	return io;
};

onSuccess = function(e){
	console.log(e.target);
};

onError = function(e){
	console.log("error");
};

getCredential = function (){
	console.log("in getCredential");
	
	var io = getIframeIo(onSuccess, onError);
	
	io.send("http://sso.example.com:2195/v1/cred", "POST");
};

getCredential();


}).call(this);

