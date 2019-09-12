//definir ruta del crud para axios
var url = "bd/crud.php";
var appNombres = new Vue({
    el:"#appNombres",
    data:{ //datos a utilizar
        personas:[],//guardamos todas las personas
        //datos de la tabla
        nombre:"",
        sexo:"",
        edad:"",
        total:0,
    },
    methods:{
        //metodos a utilizar
        //Botones
        //para enviar datos con axios es necesario agregar el async para 
        //realizar peticiones ajax
        btnAlta: async function(){
            const {value: formValues} = await Swal.fire({
                title: 'Agregar nueva persona',
                html:
                '<div class="row"><label class="col-sm-3 col-form-label">Nombre</label><div class="col-sm-7"><input id="nombre" type="text" class="form-control"></div></div><div class="row"><label class="col-sm-3 col-form-label">Sexo</label><div class="col-sm-7"><input id="sexo" type="text" class="form-control"></div></div><div class="row"><label class="col-sm-3 col-form-label">Edad</label><div class="col-sm-7"><input id="edad" type="number" min="0" class="form-control"></div></div>',              
                focusConfirm: false,
                showCancelButton: true,
                confirmButtonText: 'Guardar',          
                preConfirm: () => {            
                    return [
                      this.nombre = document.getElementById('nombre').value,
                      this.sexo = document.getElementById('sexo').value,
                     this.edad = document.getElementById('edad').value                    
                    ]
                  }
                })        
                if(this.nombre == "" || this.sexo == "" || this.edad == 0){
                        Swal.fire({
                          type: 'info',
                          title: 'Datos incompletos',                                    
                        }) 
                }       
                else{          
                  this.altaPersona();          
                  const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      showConfirmButton: false,
                      timer: 3000
                    });
                    Toast.fire({
                      type: 'success',
                      title: '¡Producto Agregado!'
                    })                
                }
        },
        btnEditar:async function(id,nombre,sexo,edad){
            await Swal.fire({
                title: 'Modificar una persona',
                html:
                '<div class="form-group"><div class="row"><label class="col-sm-3 col-form-label">Nombre</label><div class="col-sm-7"><input id="nombre" value="'+nombre+'" type="text" class="form-control"></div></div><div class="row"><label class="col-sm-3 col-form-label">Sexo</label><div class="col-sm-7"><input id="sexo" value="'+sexo+'" type="text" class="form-control"></div></div><div class="row"><label class="col-sm-3 col-form-label">Edad</label><div class="col-sm-7"><input id="edad" value="'+edad+'" type="number" min="0" class="form-control"></div></div></div>', 
                focusConfirm: false,
                showCancelButton: true,                         
                }).then((result) => {
                  if (result.value) {
                    console.log("lee datos");                                             
                    nombre = document.getElementById('nombre').value,    
                    sexo = document.getElementById('sexo').value,
                    edad = document.getElementById('edad').value,                    
                    console.log("recibe datos");
                    this.editarPersona(id,nombre,sexo,edad);
                    console.log("dato guardado");
                    Swal.fire(
                      '¡Actualizado!',
                      'El registro ha sido actualizado.',
                      'success'
                    )                  
                  }
                });
        },
        btnBorrar:function(id){
            Swal.fire({
                title: '¿Está seguro de borrar el registro: '+id+" ?",         
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Borrar'
              }).then((result) => {
                if (result.value) {            
                  this.borrarPersona(id);             
                  //se muestra el mensaje de eliminado
                  Swal.fire(
                    '¡Eliminado!',
                    'El registro ha sido borrado.',
                    'success'
                  )
                }
              })  
        },
        //procedimientos

        //listar elementos
        listaPersonas: function(){
            //llamar a axios
            axios.post(url,{opcion:4}).then(response => {
                this.personas = response.data;
                this.total = this.personas.length;
                //comprobar en consola
                console.log(this.personas); 
                console.log(this.total);           
            });
        },
        //agregarElemento
        altaPersona: function(){
          //llamar a axios
          axios.post(url,{opcion:1,nombre:this.nombre,sexo:this.sexo,edad:this.edad}).then(response => {
              this.listaPersonas();          
          });
          //resetear los campos
          this.nombre = "",
          this.sexo= "",
          this.edad= 0;
        }, 
        //editarElemento 
        editarPersona: function(id, nombre, sexo, edad){
          //axios
          axios.post(url, {opcion:2, id:id, nombre:nombre, sexo: sexo, edad:edad }).then(response =>{           
            this.listaPersonas();           
         });         
        },
        borrarPersona:function(id){
          axios.post(url,{opcion:3,id:id}).then(response=>{
            this.listaPersonas();
          });
        }
    },
    created:function(){
        this.listaPersonas();
    },
    computed:{
        //contar registros
      /*  totalElementos: function(){
          //llamar a axios
          axios.post(url,{opcion:4}).then(response => {
              this.total = response.data.total;
              //comprobar en consola
              console.log(this.total);            
          });
      }
      totalElementos(){
        this.total = 0;
        for(person of this.personas){
            this.total = this.total + parseInt(person.edad);
        }
        return this.total;   
      }*/
    }
});
