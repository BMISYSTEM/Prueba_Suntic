//comunicacion con el servidor por medio de fech para el logeo
async function logint() {
    // alert(document.getElementById("passwords").value);
    const datos = new FormData();
    let email = document.getElementById("email").value;
    let password = document.getElementById("passwords").value;
    // alert(email)
    datos.append('email',email);
    datos.append('passwords',password);
    try {
        const url ='/';
        const respuesta = await fetch(url,{
            method: 'POST',
            body: datos 
        });
        const resultado = await respuesta.json();
        if(resultado === "true"){
            location.href = "/suntic";
        }else{
            alert(resultado);
        }
    } catch (error) {
        console.log(error);
    }
}
//permiten la previsualizacion de archivos en el lamba
document.querySelector("#carga").addEventListener('change',() =>{
    let pdf = document.querySelector('#carga').files[0];
    let url = URL.createObjectURL(pdf) ;
    console.log(pdf);
    $('#preview').attr('src',url);
});
// creacion de ventana modal para actualizar registros
async function actualizar($id){
 
    let div = ` <div class="over" id="overdiv">
                 <div class="modalaccion">
                 <div class="formularios">
                 <form action="" method="POST">
                     <div class="formulario secciones">
                         <div class="tarjetas">
                             <p>nuevo nombre ${$id}</p>
                            <section >
                                 <input type="text" name="nombre" required>
                                 <input type="hidden" value="${$id}" id="id" name="id">
                                 <input type="hidden" value="actualizar" id="action" name="action">
                            </section>
                         </div>
                     </div>
                     <input type="submit" class="boton-inline" value="Registrar">
                     </form>    
             </div>
                 </div>
                 <p class="exit" onclick="exit()">X</p>
                </div>
    `;
    $('#modalzoom').html(div);
}
//cierre de ventana
const exit = () =>{
    overdiv.remove();
}