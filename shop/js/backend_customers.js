document.addEventListener("DOMContentLoaded", () => {
  const customerContainer = document.getElementById("customer-container");
  const searchInput = document.getElementById("search");

  async function fetchCustomers(query = "") {
    try {
      const url =
        "/student002/shop/backend/endpoints/searchCustomers.php?q=" +
        encodeURIComponent(query);

      const response = await fetch(url);

      const data = await response.json();

      customerContainer.innerHTML = "";

      if (data.length === 0) {
        customerContainer.innerHTML = "<p>No hay clientes</p>";
        return;
      }

      data.forEach((customer) => {
        const card = document.createElement("div");
        card.className = "bg-[#eeeeee] p-4 rounded-xl shadow-lg";

        card.innerHTML = `
            <div class="flex justify-between mb-2">
                <span class="font-semibold">Cliente #${customer.customer_id}</span>
            </div>
            <p class="mb-2 text-sm">Nombre: ${customer.customer_name}, ${customer.lastname}</p>
            <p class="mb-2 text-sm">Email: ${customer.email}</p>
            <p class="mb-2 font-semibold">Teléfono: ${customer.phone}</p>
        `;

        customerContainer.appendChild(card);
      });
    } catch (error) {
        console.error("Error al cargar clientes", error);
        customerContainer.innerHTML = "<p>Error al cargar clientes</p>";
    }
  }
  fetchCustomers();

  // Escuchar input
  searchInput.addEventListener("keyup", () => {
    fetchCustomers(searchInput.value);
  })
});
