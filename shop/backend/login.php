<?php require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/header.php'; ?>

<?php 
// Creacion de variables vacias
$emailError = ''; 
$passwordError = '';
$email = '';
$password = '';

// Si el metodo que recibe el server es un post que haga esto 
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = ($_POST['email']); // Valor al email con el valor del input de mi form
    $password = ($_POST['password']); // Valor a la password con el valor del input de mi form

    // Si mi input de correo esta vacio dara la primera opción
    if(empty($email)){
        $emailError = 'El email es obligatorio';
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = 'El email no es válido'; // Si el correo no es un correo electrónico valido soltara este error
    }
    // Si la contraseña esta vacia dara esto
    if(empty($password)){
        $passwordError = 'La contraseña es obligatoria';
    }

    // Si no hay errores en pantalla y ha ido todo bien mando el "action" para que se valide ahora con la base de datos
    if(empty($emailError) && empty($passwordError)) {
    require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/db/db_login.php';
}
}



?>


<main class="flex justify-center items-center h-screen">
    <!-- No usamos el action para dejar procesar el codigo de php al navegador y hacemos el novalidate para que el HTML no se superponga a los errores que quiero poner yo-->
    <form method="POST" action="" novalidate class="flex flex-col gap-6 items-center justify-center bg-[#111111] border border-accent/60 rounded-2xl p-10 shadow-[0_0_15px_accent]/30 w-[350px]">
        <h2 class="text-3xl font-bold text-call-to-action">LOGIN</h2>
        <p class="text-red-500 text-sm min-h-[1em]"></p>

        <div class="flex flex-col w-full">
            <label class="text-texto text-sm mb-1" for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Enter Email" required class="inputs">
            <p class="text-red-500 text-sm min-h-[1em]">
                <?php echo $emailError?>
            </p>
        </div>

        <div class="flex flex-col w-full">
            <label class="text-texto text-sm mb-1" for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Enter Password" required class="inputs">
            <p class="text-red-500 text-sm min-h-[1em]">
                <?php echo $passwordError?>
            </p>
        </div>

        <button type="submit" name="submit" class="buttons w-full">Login</button>
        <p class="text-sm text-texto/60 mt-2">¿No tienes cuenta? <a href="#" class="text-accent hover:text-callToAction hover:underline">Regístrate</a></p>
        <a href="../index.html" class="text-texto/60 block mt-6 text-sm text-texto-secundario hover:text-accent transition">← Volver atras</a>
    </form>
    
</main>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/footer.php'; ?>
