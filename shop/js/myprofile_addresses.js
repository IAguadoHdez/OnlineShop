// ---------- POPUP: AÑADIR DIRECCIÓN ----------
function openPopup() {
  document.getElementById("addressPopup").classList.remove("hidden");
}

function closePopup() {
  document.getElementById("addressPopup").classList.add("hidden");
}



// ---------- POPUP: ELIMINAR DIRECCIÓN ----------
function openDeletePopup(id) {
  document.getElementById("delete_address_id").value = id;
  document.getElementById("deletePopup").classList.remove("hidden");
}

function closeDeletePopup() {
  document.getElementById("deletePopup").classList.add("hidden");
}



// ---------- POPUP: EDITAR DIRECCIÓN ----------
function openEditPopup(id, street, floor, city, zipcode, country) {
  document.getElementById("edit_address_id").value = id;
  document.getElementById("edit_street").value = street;
  document.getElementById("edit_floor").value = floor;
  document.getElementById("edit_city").value = city;
  document.getElementById("edit_zipcode").value = zipcode;
  document.getElementById("edit_country").value = country;

  document.getElementById("editPopup").classList.remove("hidden");
}

function closeEditPopup() {
  document.getElementById("editPopup").classList.add("hidden");
}



// ---------- CERRAR POPUP AL HACER CLICK FUERA ----------
document.addEventListener("click", function (e) {
  const popups = ["addressPopup", "editPopup", "deletePopup"];

  popups.forEach(id => {
    const popup = document.getElementById(id);

    if (!popup) return;

    if (!popup.classList.contains("hidden") && e.target === popup) {
      popup.classList.add("hidden");
    }
  });
});
