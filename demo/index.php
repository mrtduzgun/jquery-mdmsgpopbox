<!DOCTYPE html>
<html>
    <head>
    <title>JQuery Mdmsgpopbox Demo</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link type="text/css" rel="stylesheet" href="../mdmsgpopbox-1.0.css"/>
    <link type="text/css" rel="stylesheet" href="common.css"/>
     <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
     <script src="../jquery-mdmsgpopbox-1.0.js"></script>
     <script type="text/javascript">
         $(function(){
             $(".startRequest").click(function(){
                 var type = $(this).attr("request-type");
                $.ajax({
                    url: 'server.php',
                    data: {test: 1, type: type},
                    success: function(response, textStatus, jqXHR) {

                        if (response == "success") {
                           $.mdmsgpopbox({
                               msgType: 'success',
                               message: 'Your response is success.',
                               finishCallback: function() { // optional
                                   window.location.reload();
                               }
                           });
                        }
                        else if (response == "warning") {
                           $.mdmsgpopbox({
                               msgType: 'warning',
                               message: 'Your response is warning.'
                           });
                        }
                        else if (response == "info") {
                           $.mdmsgpopbox({
                               msgType: 'info',
                               message: 'Your response is info.'
                           });
                        }
                        else {
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
    <div class="mdBlockContainer" style="margin-top: 40px;">
        <div class="mdBlock">
            <div class="mdBlockBody">
                <div class="mdBlockHeader">Demo</div>
                <table class="mdTable">
                    <tr>
                        <td align="center">
                            <input type="button" value="Success Message" class="mdButton startRequest" request-type="success"/>
                        </td>
                    </tr>
                    <tr>
                        <td align="center">
                            <input type="button" value="Fail Message" class="mdButton startRequest" request-type="fail"/>
                        </td>
                    </tr>
                    <tr>
                        <td align="center">
                            <input type="button" value="Warning Message" class="mdButton startRequest" request-type="warning"/>
                        </td>
                    </tr>
                    <tr>
                        <td align="center">
                            <input type="button" value="Info Message" class="mdButton startRequest" request-type="info"/>
                        </td>
                    </tr>
                </table>
            </div>
        </div>        
</div>
</body>
</html>