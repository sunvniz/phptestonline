<?php
session_start();
if($_GET["download"])
{
    download_send_headers("mycode.php");
    print(str_ireplace("<br/>", "\\n", $_SESSION["code"]));
    die;
}
if(!$_SESSION["code"])
{
    $filename = "code.php";
    $ourFileName =$filename;
    $ourFileHandle = fopen($ourFileName, 'w');
    $written =  'result will show here';
    fwrite($ourFileHandle,$written);
    fclose($ourFileHandle);
}
function download_send_headers($filename) {
      // disable caching
      $now = gmdate("D, d M Y H:i:s");
      header("Expires: Tue, 03 Jul 2020 06:00:00 GMT");
      header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
      header("Last-Modified: {$now} GMT");

      // force download  
      header("Content-Type: application/force-download");
      header("Content-Type: application/octet-stream");
      header("Content-Type: application/download");

      // disposition / encoding on response body
      header("Content-Disposition: attachment;filename={$filename}");
      header("Content-Transfer-Encoding: binary");
  }
?>

<!DOCTYPE html>
<html>
<head>
    <title>sunvni@gmail.com</title>
    <style type="text/css">
        
    </style>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.10.0/styles/default.min.css">
    <link rel="stylesheet" href="testasset/style.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.10.0/highlight.min.js"></script>
    <script type="text/javascript">        
        function run_code()
        {
            var session_id = $("#session_id").val();
            $(".loader").show();
            $.ajax({
                        url: "./writecode.php",
                        type: "POST",
                        data: {
                            code: genNewLine($("#code_content").val())
                        },
                        success: function (response) {
                            var iframe = document.createElement('iframe');
                                iframe.onload = function() 
                                { 
                                    this.innerHTML = showResult(this);
                                    document.body.removeChild(iframe);
                                };
                                iframe.src = 'test/test_error.php';                                
                                document.body.appendChild(iframe);
                                iframe.style.display = "none";
                                $(".loader").fadeOut(500);
                }
             });
        }
        function showResult(dom)
        {
            var html = $(dom).contents().find('body').html();
            if (html.indexOf("sunvni.com/public_html/test") >= 0)
            {
                var start = html.indexOf("in <b>/h");
                var end = html.indexOf("php</b>") + 3;
                var remove = html.substring(start,end);
                html = html.replace(remove,"");
            }
            $('#run_code').html(html);
            return html;            
        }
        function nl2br (str, is_xhtml) {   
            var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';    
            return (str + '').replace(/\r\n|\n\r|\r|\n/g, '$1'+ breakTag +'$2');
        }
        function genNewLine(text)
        {
            var result = text.replace(/\\n/g, '<br/>');
            return result;
        }
    $(window).on('unload', function(){
        var session_id = $("#session_id").val();    
                    jQuery.ajax({
                      url: "test/deletefile.php",
                      type: 'post',
                      data: 
                      {     
                        session_id : session_id
                      },
                      success: function(response) {
                        console.log(session_id);
                      }
                   });
                });   
    </script>
<link rel="stylesheet" href="testasset/codemirror.css">
<script src="testasset/codemirror.js"></script>
<script src="testasset/matchbrackets.js"></script>
<script src="testasset/htmlmixed.js"></script>
<script src="testasset/xml.js"></script>
<script src="testasset/css.js"></script>
<script src="testasset/clike.js"></script>
<script src="testasset/php.js"></script>
</head>
<body>
<input type="hidden" name="session_id" id="session_id" value="<?=session_id()?>" readonly>
<pre>
<textarea name="code" id="code_content"><?php echo '<?php'."\n"?></textarea>
</pre>
<a class="btn fll" href="javascript:void(0)" onclick="run_code()">RUN</a>
<a class="btn flr" href="?download=1">DOWNLOAD</a>
<div class="result">
<div class="loader"></div>
    <div id="run_code"></div>
</div>
<div class="error"></div>
<script>
$(function(){
      var editor = CodeMirror.fromTextArea(document.getElementById("code_content"), {
        lineNumbers: true,
        matchBrackets: true,
        mode: "application/x-httpd-php",
        indentUnit: 4,
        indentWithTabs: true
      });

       editor.on("blur", function() {
        $("#code_content").html(editor.getValue());
    });
    })
    </script>

</body>
</html>