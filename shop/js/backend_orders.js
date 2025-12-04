document.addEventListener("DOMContentLoaded", () => {
  const ordersContainer = document.getElementById("orders-container");
  const searchInput = document.getElementById("search");

  async function fetchOrders(query = "") {
    try {
      const url =
        "/student002/shop/backend/endpoints/searchOrders.php?q=" +
        encodeURIComponent(query);

      const response = await fetch(url);

      const data = await response.json();

      ordersContainer.innerHTML = "";

      if (data.length === 0) {
        ordersContainer.innerHTML = "<p>No hay pedidos</p>";
        return;
      }

      data.forEach((order) => {
        const card = document.createElement("div");
        card.className = "bg-[#eeeeee] p-4 rounded-xl shadow-lg";

        card.innerHTML = `
            <div class="flex justify-between mb-2">
                <span class="font-semibold">Pedido #${order.order_id}</span>
            </div>
            <p class="mb-2 text-sm">Envío: ${order.street} ${order.floor}, ${order.zipcode} ${order.city}</p>
            <p class="mb-2 text-sm">Método de pago: ${order.payment_method}</p>
            <p class="mb-2 font-semibold">Total: ${Number(order.total_price).toFixed(2)} €</p>
            <p class="font-semibold">Estado: <span class="text-accent">${order.status}</span></p>
        `;

        ordersContainer.appendChild(card);
      });
    } catch (error) {
        console.error("Error al cargar pedidos", error);
        ordersContainer.innerHTML = "<p>Error al cargar pedidos</p>";
    }
  }
  fetchOrders();

  // Escuchar input
  searchInput.addEventListener("keyup", () => {
    fetchOrders(searchInput.value);
  })
});
