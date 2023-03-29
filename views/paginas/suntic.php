<!-- modal flotante para actualizacion de nombre de pdf -->
<div id="modalzoom">
</div>
<!-- grid principal que se divide en 3 partes -->
<div class="pagina_carga" >
    <!-- columna 1 de grid permite cargar y guardar en la base de datos -->
    <div class="menu">
        <div class="alerta">
            <?php if(!empty($error)){ echo $error;}?>
        </div>
        <form action="/suntic" method="POST" enctype="multipart/form-data" class="formulario">
            <div class="carga">
                <label for="">Selecciona el archivo</label>
                <input type="file" id="carga" name="file">
            </div>
            <input type="submit" class="boton-inline" value="Registrar" name="pdf" accept="pdf">
        </form>
    </div>
    <!-- columna 2 de grid visualizador de archivos pdf-->
    <embed id="preview" src="" type="application/pdf" class="preview" width="100%" height="100%" 
    background-color="white">
    <!-- columna 3 de grid visualizador de lista de archivos en la base de datos -->
    <div class="tabla_registros">
    <h2>Archivos Pdf</h2>
    <table class="pdftablet">
        <thead>
            <th>Id</th>
            <th>nombre</th>
            <th>acciones</th>
        </thead>
        <tbody>
            <?php foreach($pdfs as $pdfs){?>
                <tr>
                    <td><?php echo $pdfs->id;?></td>
                    <td><?php echo $pdfs->nombre;?></td>
                    <td>
                        <form method="POST"  class="elimnar_actualizar">
                            <input type="hidden" name="id" value = "<?php echo $pdfs->id;?>">
                            <input type="hidden" name="nombre"  value = "<?php echo $pdfs->nombre;?>">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <button  onclick="actualizar(<?php echo $pdfs->id;?>)" class="boton-verde-block">Actualizar</button>
                    </td>
            <?php }?>
        </tbody>
    </table>
    </div>
</div>