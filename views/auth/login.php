<h1>Login</h1>

<main class="contenedor seccion contenido-centrado">
        <h1 data-cy="heading-login">Iniciar Sesión</h1>

        <?php foreach($errores as $error) : ?>
            <div data-cy="alerta-login" class="error alerta"><?php echo $error; ?></div>
        <?php endforeach; ?> 
        <form data-cy="formulario-login" method="POST" class="formulario" action="/login">
        <fieldset>
            <legend>Email y Password </legend>

            <label for="email">E-Mail</label>
            <input type="email" name="email" placeholder="Tú E-mail" required id="email">  

            <label for="password">Password</label>
            <input type="password" name = "password" placeholder="Tú Password" id="password" required> 
            

          </fieldset>


        <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
        </form>
    </main>