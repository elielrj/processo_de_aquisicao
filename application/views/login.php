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

    <!-- ícones para site -->
    <?php include_once('index/icones.php'); ?>
    <!-- fim de ícones -->

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden px-md-5-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block text-center">
                                <img src="<?php echo base_url('img/processo.jpg'); ?>" width="300" height="400">
                                <p class="text-justify px-md-5">
                                    <i>"Art. 19. Os órgãos da Administração com competências regulamentares relativas às
                                        atividades
                                        de administração de materiais, de obras e serviços e de licitações e contratos
                                        deverão:
                                    </i>
                                </p>
                                <p class="text-justify px-md-5">
                                    <i>I - instituir instrumentos que permitam, preferencialmente, a centralização dos
                                        procedimentos de aquisição e contratação de bens e serviços;"
                                    </i>
                                </p>
                                <p class="text-right px-md-5">Lei 14.133/21</p>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">

                                    <hr>

                                    <div class="text-center">
                                       
                                            <div class="col-xs-1">
                                            <img src="<?php echo base_url(); ?>icones_da_pagina/favicon-32x32.png" alt="Bootstrap" width="32" height="32">
                                            </div>
                                            
                                            <div class="col-xs-1">
                                                <h1 class="h4 text-gray-900 mb-1">iSALC</h1>
                                            </div>
                                      

                                        <div class="col-xs-1">
                                            <h1 class="h5 text-gray-900 mb-0">Processos de Aquisição</h1>
                                        </div>

                                    </div>

                                    <hr>
                                    </br>

                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-1">Consultar</h1>
                                    </div>

                                    <?php
                                    include_once('index/consultar.php');
                                    include_once('index/login.php');
                                    ?>
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