<?php require $_SERVER['DOCUMENT_ROOT'] . '/student002/shop/backend/header.php' ?>

<main class="bg-[#1a1a1a] h-screen items-center justify-center">
  <div class="flex flex-col gap-4 p-10 bg-background  rounded ">
    <h3 class="text-xl font-bold text-center">Update password</h3>
    <form class="flex flex-col gap-4">
      <div>
        <label for="updatePass">New Password</label>
        <input type="password" class="inputs">
      </div>
  
      <div>
        <label for="reupdatePass">Type password again</label>
        <input type="password" class="inputs">
      </div>
  
      <button type="submit" class="buttons p-2">Save password</button>
    </form>
  </div>
</main>