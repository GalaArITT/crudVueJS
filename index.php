<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Crud con Vue JS </title>
    <!-- Bootstrap CSS -->    
    <link rel="stylesheet" href="bootstrap/bootstrap-4.3.1-dist/css/bootstrap.min.css">
    <!-- FontAwesom CSS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" 
    integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">        
    <!--Sweet Alert 2 -->
    <link rel="stylesheet" href="pluggins/sweetalert2/sweetalert2.min.css">        
    <!--CSS custom -->  
    <link rel="stylesheet" href="main.css">  
</head>
<body>
    <header>
        <h2 class="text-center text-dark"><span class="badge badge-secondary">Listado de Elementos</span></h2>
    </header>    

    <!--tabla de datos -->
    <div id="appNombres">
        <div class="container">
            <div class="row">
                <div class="col">
                    <button @click="btnAlta" class="btn btn-success" title="Agregar nuevo elemento">
                        <i class="fas fa-plus-circle fa-2xs"></i></button>
                </div>
                <div class="col text-right">                        
                    <h5>Total de Elementos: <span class="badge badge-success">{{total}}</span></h5>
                </div>  
            </div>
            <div class="row mt-5">
                    <div class="col-lg-12">
                        <table class="table table-striped">
                            <thead>
                                <tr class="bg-primary text-light">
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Sexo</th>
                                    <th>Edad</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(personas,indice) of personas">                                
                                <td>{{personas.id}}</td>                                
                                <td>{{personas.nombre}}</td>
                                <td>{{personas.sexo}}</td>
                                <td>
                                    <div class="col-md-8">
                                    <input type="number" v-model.number="personas.edad" class="form-control text-right" disabled>      
                                    </div>    
                                </td>
                                <td>
                                <div class="btn-group" role="group">
                                    <button class="btn btn-secondary" title="Editar" @click="btnEditar(personas.id, personas.nombre, personas.sexo, personas.edad)"><i class="fas fa-pencil-alt"></i></button>    
                                    <button class="btn btn-danger" title="Eliminar" @click="btnBorrar(personas.id)"><i class="fas fa-trash-alt"></i></button>      
								</div>
                                </td>
                            </tr>  
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>

    <!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="jquery/jquery-3.4.1.min.js"></script>
    <script src="popper/popper.min.js"></script>
    <script src="bootstrap/bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>         
    <!--Vue.JS -->    
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>              
    <!--Axios -->      
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.15.2/axios.js"></script>    
    <!--Sweet Alert 2 -->        
    <script src="pluggins/sweetalert2/sweetalert2.all.min.js"></script>      
    <!--Código custom -->          
    <script src="main.js"></script> 
</body>
</html>