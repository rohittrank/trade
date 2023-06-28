<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Trading WebSocket Test</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
</head>
<body>
    <div id="output"></div>

    <script language="javascript" type="text/javascript">
        $(document).ready(function() {
            var wsUri = "ws://localhost/trading/Tradingssss";
            var output = $("#output");

            function writeToScreen(message) {
                output.append("<p>" + message + "</p>");
            }

            if ("WebSocket" in window) {
                var websocket = new WebSocket(wsUri);

                websocket.onopen = function(evt) {
                    writeToScreen("CONNECTED");
                    writeToScreen("Endpoint: " + wsUri);
                };

                websocket.onmessage = function(evt) {
                    var event = JSON.parse(evt.data);
                    // Handle the received message
                    if (event.MessageType == "AuthenticateResult" && event.Complete) {
                        // Authentication successful, do further operations if needed
                    } else {
                        // Handle other message types
                    }
                };

                websocket.onerror = function(evt) {
                    writeToScreen('<span style="color: red;">ERROR:</span> ' + evt.data);
                };

                websocket.onclose = function(evt) {
                    writeToScreen("DISCONNECTED");
                };
            } else {
                writeToScreen("WebSocket not supported by this browser.");
            }
        });
    </script>
</body>
</html>
