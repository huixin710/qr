<title>PHP使用Google API產生QR code並使用PHP下載</title>
   
   <script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
   <script>
       $(function () {
           
               createqrcode();            
          
           
           function createqrcode() {
               var input_text = "https://www.youtube.com";
               var width = $("#range").val()
               var rectangle = width + "x" + width;
               var url = "https://chart.googleapis.com/chart?chs=" + rectangle + "&cht=qr&chl=" + input_text + "&choe=UTF-8&chld=M|2";
               var qr_code = "<img alt='Your QRcode' src='" + url + "' />";
               $('#qrcode').html(qr_code);
               $('#range_value').html(width);
           }
           
           $("#down_img_btn").click(function(){
               var input_text = $("#input_text").val();
               var range = $("#range").val();
               $.ajax({
               url: "qrcode_action.php",
               data: "&input_text="+input_text+"&range="+range,
               type:"POST",
               dataType:'text',

               success: function(message){
                   document.getElementById("message").innerHTML=message;
               },

               error:  function(jqXHR, textStatus, errorThrown){ 
               document.getElementById("message").innerHTML=errorThrown; 
               }
               }); 
           });
       });
   </script>



       
       <div id="message"></div>
       <div id="qrcode"></div>