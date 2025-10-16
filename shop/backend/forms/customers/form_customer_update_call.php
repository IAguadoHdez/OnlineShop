<?php
include __DIR__ . '/../../header.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Cliente</title>
</head>
<body class="bg-[#0D0D0D] m-0 p-0 font-sans">
    <div class="fixed inset-0 z-50 flex items-center justify-center">
        <div class="bg-[#1A1A1A] shadow-2xl rounded-2xl p-10 w-96 text-center border border-[#737373]/30">
            <h1 class="text-2xl font-semibold mb-6 text-[#F5F5F5]">Actualizar cliente</h1>
            <form action="form_customer_update.php" method="POST" class="flex flex-col space-y-4">
                <label for="product_id" class="text-[#737373] font-medium">ID del cliente</label>
                <input type="number" id="product_id" name="product_id" placeholder="Ej: 123" required class="bg-[#F5F5F5] border border-[#737373] rounded-xl p-2 text-center text-[#0D0D0D] focus:outline-none focus:ring-2 focus:ring-[#00C4CC]">
                <input type="submit" value="Actualizar" class="bg-[#FF4D00] text-[#F5F5F5] py-2 rounded-xl cursor-pointer font-semibold hover:bg-[#00C4CC] hover:text-[#0D0D0D] transition-all duration-200">
            </form>
            <a href="../../index.php" class="block mt-5 text-sm text-[#737373] hover:text-[#00C4CC] transition">← Volver al inicio</a>
        </div>
    </div>
</body>
</html>
