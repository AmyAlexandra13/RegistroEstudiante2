$(document).ready(function(){

   $(".btn-delete").on("click",function(){
    
    let id = $(this).data("id");

    if(confirm("Esta seguro que quieres eliminar el estudiante")){

        if(id !== null && id !== undefined && id !== "" ){
            window.location.href = "estudiantes/delete.php?id=" + id;            
        }        

    }
    
   });
    
    

});