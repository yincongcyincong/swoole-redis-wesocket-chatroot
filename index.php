<!DOCTYPE html>
<html>
    <head>
            <title></title>
    </head>
    <body>
	   <div >
       	        <ul id="member">
                </ul>
   	   </div>
	   <div id="container"  style="width:500px;height:300px; border:1px solid red;" ></div>
	   <textarea id="message" style="width:500px; height:100px;" ></textarea>
            <button onclick="send()" >发送</button>
    </body>
    <script src="./jquery-1.12.4.min.js"></script>
    <script type="text/javascript">
        var wesocket = new WebSocket("ws://47.94.130.85:8080");
        wesocket.onopen = function (event) {
            wesocket.send('');
        };
        wesocket.onmessage = function (event) {
	    document.getElementById("container").innerHTML = document.getElementById("container").innerHTML + '<br>'  + event.data;
        }
	function send(){
	    var message = document.getElementById("message").value;
	    wesocket.send(message);
	    document.getElementById("message").value = '';
	}
    </script>
</html>

