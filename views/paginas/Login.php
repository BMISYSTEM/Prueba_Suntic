<div id="modalzoom" class="tarjec">   
    </div>
        <div class="loginPage">
        <div class="login">
            <?php foreach($errores as $error){?>
                <div class="alerta error">
                    <?php echo $error;?>
                </div>
            <?php }?>
            <form method="POST" class="formulario" action="/">
                <div>
                    <label for="">Usuario</label>
                    <input type="text" placeholder="Usuario" name="email" id="email">
                </div>
                <div>
                    <label for="">Constraseña</label>
                    <input type="password"  name="passwords" id="passwords" class="contrase">
                </div>
                <div >
                    <button type="button" id="ingresar" class="boton-inline" onclick="logint()">Ingresar</button>
                </div>
            </form>
        </div>
    </div>
