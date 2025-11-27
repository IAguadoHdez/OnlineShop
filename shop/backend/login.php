<?php require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/includes/header.php'; ?>

<?php
// Creacion de variables vacias
$emailError = '';
$passwordError = '';
$email = '';
$password = '';

// Si el metodo que recibe el server es un post que haga esto 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = ($_POST['email']); // Valor al email con el valor del input de mi form
    $password = ($_POST['password']); // Valor a la password con el valor del input de mi form

    // Si mi input de correo esta vacio dara la primera opción
    if (empty($email)) {
        $emailError = 'El email es obligatorio';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = 'El email no es válido'; // Si el correo no es un correo electrónico valido soltara este error
    }
    // Si la contraseña esta vacia dara esto
    if (empty($password)) {
        $passwordError = 'La contraseña es obligatoria';
    }

    // Si no hay errores en pantalla y ha ido todo bien mando el "action" para que se valide ahora con la base de datos
    if (empty($emailError) && empty($passwordError)) {
        require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/db/db_login.php';
    }
}
?>

<main class="flex justify-center items-center h-[calc(100vh-160px)] bg-background">
    <form method="POST" action="" novalidate
        class="flex flex-col gap-6 items-center justify-center bg-[#eeeeee] shadow-2xl rounded-2xl p-10 w-full max-w-md text-texto">
        <h2 class="text-3xl font-bold">LOGIN</h2>

        <!-- Email -->
        <div class="flex flex-col w-full">
            <label for="email" class="mb-1 text-sm font-medium">Email</label>
            <input type="email" name="email" id="email" placeholder="Enter your email"
                value="<?= htmlspecialchars($email) ?>" class="inputs text-texto placeholder:background">
            <p class="text-red-500 text-sm mt-1 min-h-[1em]"><?= $emailError ?></p>
        </div>

        <!-- Password -->
        <div class="flex flex-col w-full">
            <label for="password" class="mb-1 text-sm font-medium">Password</label>
            <input type="password" name="password" id="password" placeholder="Enter your password"
                class="inputs text-texto placeholder:background">
            <p class="text-red-500 text-sm mt-1 min-h-[1em]"><?= $passwordError ?></p>
        </div>

        <button type="submit" name="submit" class="buttons w-full">Login</button>

        <p class=" text-textoSecundario">¿No estas registrado? <a href="register.php" class="links text-accent">Regístrate</a></p>

        <a href="../index.html" class="links">← Volver atras</a>
    </form>
</main>


<?php require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/includes/footer.php'; ?>