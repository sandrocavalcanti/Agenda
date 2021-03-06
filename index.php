<!DOCTYPE html>
<html>
  <head>
    <title>Agenda Jquery - Ajax - PHP - Mysql</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
<style>
/* custom inclusion of right, left and below tabs */

.tabs-below > .nav-tabs,
.tabs-right > .nav-tabs,
.tabs-left > .nav-tabs {
  border-bottom: 0;
}

.tab-content > .tab-pane,
.pill-content > .pill-pane {
  display: none;
}

.tab-content > .active,
.pill-content > .active {
  display: block;
}


.tabs-left > .nav-tabs > li,
.tabs-right > .nav-tabs > li {
  float: none;
}

.tabs-left > .nav-tabs > li > a,
.tabs-right > .nav-tabs > li > a {
  min-width: 74px;
  margin-right: 0;
  margin-bottom: 3px;
}

.tabs-left > .nav-tabs {
  float: left;
  margin-right: 19px;
  border-right: 1px solid #ddd;
}

.tabs-left > .nav-tabs > li > a {
  margin-right: -1px;
  -webkit-border-radius: 4px 0 0 4px;
     -moz-border-radius: 4px 0 0 4px;
          border-radius: 4px 0 0 4px;
}

.tabs-left > .nav-tabs > li > a:hover,
.tabs-left > .nav-tabs > li > a:focus {
  border-color: #eeeeee #dddddd #eeeeee #eeeeee;
}

.tabs-left > .nav-tabs .active > a,
.tabs-left > .nav-tabs .active > a:hover,
.tabs-left > .nav-tabs .active > a:focus {
  border-color: #ddd transparent #ddd #ddd;
  *border-right-color: #ffffff;
}

.tab-content label{
  font-weight:normal;
  width:100%;
  display:block;
}

.list-group{
  margin-left: 92px;
  margin-top: 10px;
  min-height: 600px;
  max-height: 700px;
  overflow: auto;
}

.mt40{margin-top: 40px}

.tabbable{
  border-right: 1px solid #ddd;
  min-height: 400px;
}

#editar_foto{
  position: absolute;
  z-index: 100;
  padding: 2px;
  text-align: center;
  top: 75px;
  left: 40px;
  font-size: 11px;
}

#carregando {
width: 155px;
height: 44px;
padding: 11px 10px;
background-color: #C00;
color: #FFF;
position: fixed;
top: 0;
right: 0;
font-weight: bold;
z-index: 9000 ;
}

.nav>li>a {
position: relative;
display: block;
padding: 5px 15px;
}

.bar {
    height: 18px;
    background: green;
}

</style>
    
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.maskedinput.min.js"></script>
<script src="js/funcoes.js"></script>




</head>
<body>

  <div class="container">	


  <div class="row">
    
    <h1>Agenda: Jquery + Json + Php + MySQL</h1>

  </div>
  

   <div class="row mt40">
     
             <div class="tabbable tabs-left col-sm-7">
              
             
              <div class="alert fade in" style="display:none;">
                <div id="msg_alert"></div>
              </div>

              <ul class="nav nav-tabs nav-stacked" id="lista_letras">
                 
              </ul>

                <div class="tab-content">
                        <a href="#" data-toggle="modal" data-target="#modalCadastro" style="margin-bottom:10px" class="btn btn-success" role="button"><span class="glyphicon glyphicon-plus"></span></a>

                    <!-- input buscar -->
                        <div class="">
                                <div class="input-group">
                                  <input type="text" class="form-control" id="edit_busca">
                                  <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                      
                                      <span class="glyphicon glyphicon-search"></span>

                                    </button>
                                  </span>
                                </div>
                        </div>
                      <!-- fim input buscar -->
                  
                    <div class="tab-pane fade in active" id="A">

                      

                      <div class="list-group">

                      </div>

                    </div>

                </div>

           
            </div>


            <div class="tab-content col-sm-5 tab-conteudo"  style="display:none">
              <a href="#">
                  <img src="http://demo.okendoken.com/img/2.jpg" class="img-thumbnail" width="80" >
                  <div id="editar_foto" data-toggle="modal" data-target="#modalFoto">editar</div>
              </a>
              <h4 id="nome">
                
              </h4>
              <a id="link_editar" data-toggle="modal" data-target="#myModal"  class="btn-md tip" role="button" data-toggle="tooltip" title="Editar"><span class="glyphicon glyphicon-edit"></span></a>

              <label><strong>E-mail:</strong><label id="email"></label></label>
              <label><strong>Casa:</strong> <label id="casa"></label></label>
              <label><strong>Celular:</strong> <label id="celular"></label></label>

              <hr>

               <label><strong>Endereço:</strong> <label id="endereco"></label>

              <a id="linkgoogle" class="tip" data-toggle="tooltip" title="Ver no Google Maps" style="margin-bottom:10px"  role="button"><span class="glyphicon glyphicon-map-marker"></span></a>
               </label>

              <a id="deletar_contato" class="tip" data-toggle="tooltip" title="Deletar" style="margin-bottom:10px"  role="button"><span class="glyphicon glyphicon-trash"></span></a>
               
              <input type="hidden" id="idcontato">



        </div>

   </div> 
		 

</div>


<!-- Modal Cadastro -->
<div class="modal fade" id="modalCadastro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Contato</h4>
      </div>
      <div class="modal-body">

        <form role="form" id="formContato"  method="post">
          <div class="form-group">
            <label >Nome:</label>
            <input type="text" id="txtnome" class="form-control" name="txtnome" placeholder="Nome">
          </div>
          <div class="form-group">
            <label>E-mail</label>
            <input type="email" id="txtemail" name="txtemail" class="form-control"  placeholder="E-mail">
          </div>
          <div class="form-group">
            <label >Celular:</label>
            <input type="text" name="txtcelular" id="txtcelular" class="form-control">
            
          </div>
          <div class="form-group">
            <label>Fone Casa:</label>
            <input type="text" id="txtcasa"  name="txtcasa" class="form-control">
            
          </div>

           <div class="form-group">
            <label>Endereço:</label>
            <textarea name="txtendereco" id="txtendereco" cols="30" rows="10" class="form-control"></textarea>
            
          </div>
          <input type="hidden" id="idalterar" name="idalterar">
          <input type="hidden" id="action" name="action">
        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="btnSalvarContato">Salvar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- Modal Foto -->
<div class="modal fade" id="modalFoto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Alterar foto</h4>
        </div>
        <div class="modal-body">
            <input id="fileupload" type="file" name="files[]" data-url="server/php/" multiple>
            <div id="progress">
              <div class="bar" style="width: 0%;"></div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
   
<!-- Loading Ajax -->
<div id="carregando" style="display: none">
   Aguarde...
</div>


  </body>
</html>