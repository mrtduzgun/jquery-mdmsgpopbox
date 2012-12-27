<!DOCTYPE html>
<html>
    <head>
    <title>JQuery Mdmsgpopbox Demo</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link type="text/css" rel="stylesheet" href="../mdmsgpopbox-1.0.css"/>
     <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
     <script src="../jquery-mdmsgpopbox-1.0.js"></script>
     <script type="text/javascript">
         $(function(){
             $("#startRequest").click(function(){
                $.ajax({
                    url: 'server.php',
                    data: {test: 1},
                    success: function(response, textStatus, jqXHR) {

                        if (response == "success") {
                           $.mdmsgpopbox({
                               msgType: 'success',
                               message: 'Your response is success.',
                               finishCallback: function() { // optional
                                   window.location.reload();
                               }
                           });
                        } else {
                           $.mdmsgpopbox({
                               msgType: 'fail',
                               message: 'Your response is fail!'
                           });
                        }
                    }, 
                    error: function(jqXHR, textStatus, errorThrown) {
                        $.mdmsgpopbox({
                            msgType: 'fail',
                            message: 'Your response is fail! Maybe, network is down!'
                        });
                    },
                    beforeSend: function(jqXHR, settings) {
                       $.mdmsgpopbox({
                           msgType: 'loading',
                           message: 'Please wait..'
                       });
                    }
                });
             });
         });
     </script>
</head>
<body>
<div align="center" style="margin-top: 40px;">
    <input type="button" value="Click Me!" id="startRequest"/>
</div>
</body>
</html>