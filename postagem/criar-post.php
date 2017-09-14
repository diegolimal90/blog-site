<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Novo Post | Painel Post</title>
  <?php
      error_reporting(0);
      include_once('php/conexao/seguranca_adm.php');
      //include_once('php/op-pln.php');
      protegePagina();
    ?>

  <script src="js/tinymce/js/tinymce/tinymce.min.js"></script>
  <script type="text/javascript">
    window.onload = function () {
        tinymce.init({
            selector: 'textarea',
            selector: 'textarea',
            height: 150,
            language: 'pt_BR',
            plugins: [
              'advlist autolink lists link image charmap print preview anchor',
              'searchreplace visualblocks code fullscreen',
              'insertdatetime media table contextmenu paste code textcolor'
            ],
            toolbar: 'insertfile undo redo | fontselect | fontsizeselect | forecolor | backcolor | quickimage | styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent',
            content_css: '//www.tinymce.com/css/codepen.min.css',
            setup: function (ed) {
                ed.on('keyup', function (e) { 
                    var count = CountCharacters();
                    var valor = 65550 - count;
                    document.getElementById("character_count").innerHTML = "Caracteres Restante: " + valor;
                });
            }
        });
    }
    function CountCharacters() {
        var body = tinymce.get("txtTinyMCE").getBody();
        var content = tinymce.trim(body.innerText || body.textContent);
        return content.length;
    };
    function ValidateCharacterLength() {
        var max = 65550;
        var count = CountCharacters();
        if (count > max) {
            alert("Você excedeu a quantidade máxima de " + max + " caracteres.")
            return false;
        }
        return;
    }
</script>
  <!-- Bootstrap core CSS -->

  <link href="css/bootstrap.min.css" rel="stylesheet">

  <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
  <link href="css/animate.min.css" rel="stylesheet">

  <!-- Custom styling plus plugins -->
  <link href="css/custom.css" rel="stylesheet">
  <link href="css/icheck/flat/green.css" rel="stylesheet">
	

  <script src="js/jquery.min.js"></script>
	
  <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
      <link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
		<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
        
</head>


<body class="nav-md">

  <div class="container body">


    <div class="main_container">

      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">

          <div class="navbar nav_title" style="border: 0;">
            <a href="painel.php" class="site_title"> Painel Administrativo</span></a>
          </div>
          <div class="clearfix"></div>

           <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

            <div class="menu_section">
              <h3></h3>
              <ul class="nav side-menu">
                <li><a href="criar-post.php"><i class="fa fa-book"></i> Novo Post </a>
                </li>
                <li><a href="consultar-post.php"><i class="fa fa-bookmark"></i>Posts </a>
                </li>
              </ul>
            </div>

          </div>
          <!-- /sidebar menu -->
        </div>
      </div>
      <div class="top_nav">

        <div class="nav_menu">
          <nav class="" role="navigation">
            <ul class="nav navbar-nav navbar-right">
              <li class="">
                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <?php echo $_SESSION['usuarioNomeadm']; ?>
                  <span class=" fa fa-angle-down"></span>
                </a>
                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                  <li><a href="index.html"><i class="fa fa-sign-out pull-right"></i> Sair</a>
                  </li>
                </ul>
              </li>
            </ul>
          </nav>
        </div>

      </div>
      <!-- /top navigation -->

      <!-- page content -->
      <div class="right_col" role="main">
        <div class="">
          <div class="page-title">
            <div class="title_left">
              <h3>Criar Post</h3>
            </div>
          </div>
          <div class="clearfix"></div>

          <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel" style="height:600px;">
                <div class="x_title">
                  <h2></h2>
                  <div class="clearfix"></div>
                </div>
                
                <div class="x_content">
                  <br />
                  <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="php/cad_slide.php" enctype="multipart/form-data">

                    <div class="form-group">
                      <label class="control-label col-md-2 col-sm-3 col-xs-12" for="foto">Titulo <span class="required">*</span>
                      </label>
                      <div class="col-md-9 col-sm-6 col-xs-12">
                        <input type="text" required class="form-control col-md-7 col-xs-12" name="titulo">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-2 col-sm-3 col-xs-12" for="foto">Imagem <span class="required">*</span>
                      </label>
                      <div class="col-md-9 col-sm-6 col-xs-12">
                        <input type="file" class="form-control col-md-12 col-xs-12" id="ingInp" onChange="readURL(this);" name="foto">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-6 col-sm-3 col-xs-12" for="foto">Texto <span class="required">*</span> <div id="character_count"></div>
                      </label>
                      <div class="col-md-12 col-sm-6 col-xs-12">
                        <textarea id="txtTinyMCE" required class="form-control col-md-12" name="texto">
                        </textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <a href="painel.php" class="btn btn-primary">Cancelar</a>
                        <button type="submit" class="btn btn-success" onclick="return ValidateCharacterLength();">Enviar</button>
                      </div>
                    </div>
					          <div class="ln_solid"></div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- footer content -->
        <footer>
          <div class="copyright-info">
            <p class="pull-right">Painel Post - Template - <a href="" style="color:#000">Diego de Lima Lopes</a>
            </p>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->

      </div>
      <!-- /page content -->
    </div>

  </div>

  <div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
  </div>

  <script src="js/bootstrap.min.js"></script>

  <!-- bootstrap progress js -->
  <script src="js/progressbar/bootstrap-progressbar.min.js"></script>
  <script src="js/nicescroll/jquery.nicescroll.min.js"></script>
  <!-- icheck -->
  <script src="js/icheck/icheck.min.js"></script>

  <script src="js/custom.js"></script>

  <!-- pace -->
  <script src="js/pace/pace.min.js"></script>
	
</body>

</html>
