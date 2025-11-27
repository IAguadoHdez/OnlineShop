<?php require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/includes/header.php'; ?>

<?php
// Creacion de variables vacias
$emailError = '';
$passwordError = '';
$userError = '';
$lastnameError = '';
$lastname  = '';
$user = '';
$email = '';
$password = '';

// Si el metodo que recibe el server es un post que haga esto 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = ($_POST['email']); // Valor al email con el valor del input del form
    $password = ($_POST['password']); // Valor a la password con el valor del input del form
    $user = ($_POST['user']); // Valor al usuario con el valor del input del form
    $lastname= ($_POST['lastname']); // Valor al usuario con el valor del input del form

    // Si mi input de nombre o apellido dara error
    if(empty($user)){
      $userError = 'El nombre es obligatorio';
    }

    if(empty($lastname)) {
      $lastnameError = 'El apellido es obligatorio';
    }

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
    if (empty($emailError) && empty($passwordError) && empty($userError) && empty($lastnameError)) {
        require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/db/db_login.php';
    }
}
?>

<main class="flex justify-center items-center h-[calc(100vh-160px)] bg-background">
    <form method="POST" action="" novalidate
        class="flex flex-col gap-4 items-center justify-center bg-[#eeeeee] shadow-2xl rounded-2xl p-10 w-full max-w-md text-texto">
        <h2 class="text-3xl font-bold">Registrate</h2>

        <!-- Nombre cliente -->
         <div class="flex flex-col w-full">
            <label for="customer_name" class="mb-1 text-sm font-medium">Nombre</label>
            <input type="text" name="customer_name" id="customer_name" placeholder="Ingresa tu nombre"
                value="<?= htmlspecialchars($user) ?>" class="inputs text-texto placeholder:texto">
            <p class="text-red-500 text-sm mt-1 min-h-[1em]"><?= $userError ?></p>
        </div>

        <!-- Apellido cliente -->
         <div class="flex flex-col w-full">
            <label for="lastname" class="mb-1 text-sm font-medium">Apellido/s</label>
            <input type="text" name="lastname" id="lastname" placeholder="Ingresa tu apellido/s"
                value="<?= htmlspecialchars($lastname) ?>" class="inputs text-texti placeholder:texto">
            <p class="text-red-500 text-sm mt-1 min-h-[1em]"><?= $lastnameError ?></p>
        </div>
        <!-- Email -->
        <div class="flex flex-col w-full">
            <label for="email" class="mb-1 text-sm font-medium">Email</label>
            <input type="email" name="email" id="email" placeholder="Ingresa tu email"
                value="<?= htmlspecialchars($email) ?>" class="inputs text-texto placeholder:texto">
            <p class="text-red-500 text-sm mt-1 min-h-[1em]"><?= $emailError ?></p>
        </div>

        <!-- Password -->
        <div class="flex flex-col w-full">
            <label for="password" class="mb-1 text-sm font-medium">Contraseña</label>
            <input type="password" name="password" id="password" placeholder="Ingresa tu contraseña"
                class="inputs text-texto placeholder:texto">
            <p class="text-red-500 text-sm mt-1 min-h-[1em]"><?= $passwordError ?></p>
        </div>

        <button type="submit" name="submit" class="buttons w-full">Registrate</button>

        <p class=" text-textoSecundario">¿No estas registrado? <a href="register.php" class="links text-accent">Regístrate</a></p>

        <a href="../index.html" class="links">← Volver atras</a>
    </form>
</main>


<?php require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/includes/footer.php'; ?>