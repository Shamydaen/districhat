<!DOCTYPE HTML>
<html>
   <head>
       <script src="jquery.min.js"></script>
       <!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
       
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
       
       <link rel="stylesheet" href="chat.css" >
       
      <script type="text/javascript">
       var ws;
          function IniciarConexion(){
                ws= new WebSocket("ws://achex.ca:4010");
                ws.onopen= function(){
                    
                     ws.send('{"setID":"MichatRoom","passwd":"54321"}');
                }
                ws.onmessage= function(Mensajes){
                    var MensajesObtenidos=Mensajes.data;
                    var objeto= jQuery.parseJSON(MensajesObtenidos);
                    
                    if((objeto.ContenidoM!=null)&&(objeto.NombreU!=null)){
                        // copiar el item del chat y anexarlo al chat
                        
                        $( "#plantilla" ).clone().appendTo( ".chat" );
                        $('.chat #plantilla').show(10);
                        $('.chat #plantilla .Nombre').html(objeto.NombreU);
                        $('.chat #plantilla .Mensaje').html(objeto.ContenidoM);
             
                         var formattedDate = new Date();
                         var d = formattedDate.getUTCDate();
                         var m =  formattedDate.getMonth()+1;
                         var y = formattedDate.getFullYear();
                         var h= formattedDate.getHours();
                         var min= formattedDate.getMinutes();

                        Fecha=d+"/"+m+"/"+y+" "+h+":"+min;

                        $('.chat #plantilla .Tiempo').html(Fecha);
                        $('.chat #plantilla').attr("id","");
                        
                        
                    }
                    
                    
                    
                }
                ws.onclose= function(){
                alert("Conexión Cerrada");
                }
          }
          IniciarConexion();
          
       </script>
   </head>
   <body>
       
       <div class="container">
    <div class="row">
        <div class="col-md-5">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-comment"></span> Chat
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                            <span class="glyphicon glyphicon-chevron-down"></span>
                        </button>
                        <ul class="dropdown-menu slidedown">
                            <li><a href="http://www.jquery2dotnet.com"><span class="glyphicon glyphicon-refresh">
                            </span>Refresh</a></li>
                            <li><a href="http://www.jquery2dotnet.com"><span class="glyphicon glyphicon-ok-sign">
                            </span>Available</a></li>
                            <li><a href="http://www.jquery2dotnet.com"><span class="glyphicon glyphicon-remove">
                            </span>Busy</a></li>
                            <li><a href="http://www.jquery2dotnet.com"><span class="glyphicon glyphicon-time"></span>
                                Away</a></li>
                            <li class="divider"></li>
                            <li><a href="http://www.jquery2dotnet.com"><span class="glyphicon glyphicon-off"></span>
                                Sign Out</a></li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body">
                    <ul class="chat"> </ul>
                </div>
                <div class="panel-footer">
                    <div class="input-group">
                        <input id="Mensaje" type="text" class="form-control input-sm" placeholder="Type your message here..." />
                        <span class="input-group-btn">
                            <button class="btn btn-warning btn-sm" id="btnEnviar" >
                                Send</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

       <li style="display:none" id="plantilla" class="left clearfix">
           <span class="chat-img pull-left">
             <img src="http://placehold.it/50/55C1E7/fff&text=U"class="img-circle" />
           </span>
            <div class="chat-body clearfix">
                    <div class="header">
                      <strong class="primary-font Nombre" >Jack Sparrow</strong> 
                        <small class="pull-right text-muted">
                        <span class="glyphicon glyphicon-asterisk Tiempo"
                        </span> 30/07/2018 </small>
                    </div>
                        <p class="Mensaje">
                               Mensaje
                        </p>
                </div>
            </li>
       
        
    
      <script>
          var Nombre= prompt("Nombre:");
          
       $('#btnEnviar').click(function(){
ws.send('{"to":"MichatRoom","NombreU":"'+Nombre+'","ContenidoM":"'+$('#Mensaje').val()+'"}');
           $('#Mensaje').val("");
       });
       </script>
   </body>
</html>