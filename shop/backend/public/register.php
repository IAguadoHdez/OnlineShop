<?php require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/includes/header.php'; ?>

<?php
// Creación de variables vacías
$emailError = '';
$passwordError = '';
$userError = '';
$lastnameError = '';
$lastname = '';
$user = '';
$email = '';
$password = '';

// Si el método recibido es POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // ⬅ IMPORTANTE: Cambié "user" por "customer_name" para que coincida con el input
    $user = ($_POST['customer_name']);
    $lastname = ($_POST['lastname']);
    $email = ($_POST['email']);
    $password = ($_POST['password']);

    // Validación de nombre
    if (empty($user)) {
        $userError = 'El nombre es obligatorio';
    }

    // Validación de apellido
    if (empty($lastname)) {
        $lastnameError = 'El apellido es obligatorio';
    }

    // Validación de email
    if (empty($email)) {
        $emailError = 'El email es obligatorio';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = 'El email no es válido';
    }

    // Validación de contraseña
    if (empty($password)) {
        $passwordError = 'La contraseña es obligatoria';
    }

    // Si no hay errores, procesamos el registro en la BD
    if (empty($emailError) && empty($passwordError) && empty($userError) && empty($lastnameError)) {
        require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/db/db_register.php';
    }
}
?>

<main class="flex justify-center items-center h-[calc(100vh-160px)] bg-background">
    <form method="POST" action="" novalidate
        class="flex flex-col gap-4 items-center justify-center bg-[#eeeeee] shadow-2xl rounded-2xl p-10 w-full max-w-md text-texto">
        <h2 class="text-3xl font-bold">Regístrate</h2>

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
                value="<?= htmlspecialchars($lastname) ?>" class="inputs text-texto placeholder:texto">
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

        <button type="submit" name="submit" class="buttons w-full">Regístrate</button>

        <p class="text-textoSecundario">¿Ya estás registrado? <a href="login.php" class="links text-accent">Iniciar
                sesión</a></p>

        <a href="../index.html" class="links">← Volver atrás</a>
    </form>
</main>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/includes/footer.php'; ?>