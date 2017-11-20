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
            if (html.indexOf("/var/www/hogushi_hoang/sunvni/test") >= 0)
            {
                var start = html.indexOf("in <b>/var");
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