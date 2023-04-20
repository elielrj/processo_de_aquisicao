<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block ">
                                <img src="<?php echo base_url('application/img/braco-forte.jpg'); ?>" width="465" height="685">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Processo de Aquisição</h1>
                                    </div>
                                    
                                        
                                    
                                        <form class="user" id="form" action="index.php/Usuario_Controller/logar" method="POST" >
                                        

                                            <?php
                                                if(isset($_SESSION['email_valido'])):
                                                    if(!$_SESSION['email_valido']):
                                                    
                                            ?>
                                                    <div class='form-group'>
                                                        <p>Email inválido!</p>
                                                    </div>
                                                    
                                                
                                            <?php
                                                    endif;
                                                endif; 

                                                if(isset($_SESSION['senha_valida'])):
                                                    if(!$_SESSION['senha_valida']):
                                            ?>
                                                    <div class='form-group'>
                                                        <p>Senha inválida!</p>
                                                    </div>

                                            <?php
                                                    endif;
                                                endif;
                                            ?>

                                            <!-- email -->
                                            <div class="form-group">
                                                <input 
                                                type="email" 
                                                class="form-control form-control-user inputs register" 
                                                id="email" 
                                                aria-describedby="emailHelp" 
                                                placeholder="Digite seu email..." 
                                                name="email" 
                                                autofocus
                                          
                                                required>
                                            </div>

                                            <!-- senha -->
                                            <div class="form-group">
                                                <input 
                                                type="password" 
                                                class="form-control form-control-user" 
                                                id="senha" 
                                                placeholder="Digite sua senha" 
                                                name="senha"  
                                                required >
                                            </div>
                                            
                                            
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox small">
                                                    <input 
                                                        type="checkbox" 
                                                        class="custom-control-input" 
                                                        id="customCheck" 
                                                        checked>
                                                    <label 
                                                        class="custom-control-label" 
                                                        for="customCheck">Lembre-me
                                                    </label>
                                                </div>
                                            </div>
                                                        
                                         <input class="form-group btn btn-primary btn-user btn-block" type="submit" value="Login">
                                            

                                            <hr>
                                            <!--  LOGIN WITH GOOGL -->
                                            <a href="index.html" class="btn btn-google btn-user btn-block">
                                                <i class="fab fa-google fa-fw"></i> Login com Google
                                            </a>
                                            <!--  LOGIN WITH AMAZOON -->
                                            <a href="index.html" class="btn btn-google btn-user btn-block">
                                                <i class="fab fa-google fa-fw"></i> Login com Amazoon
                                            </a>
                                            <!--  LOGIN WITH FACEBOOK -->
                                            <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                                <i class="fab fa-facebook-f fa-fw"></i> Login com Facebook
                                            </a>
                                            <!--  LOGIN WITH TOKEN -->
                                            <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                                <i class="fab fa-facebook-f fa-fw"></i> Login com Token
                                            </a>

                                        </form>



                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="recuperarSenha.php">Esqueceu sua senha?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="criarUsuario.php">Criar conta!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>


</html>