document.addEventListener("DOMContentLoaded", () => {
    // ====== Загальні елементи ======
    const modal = document.getElementById("modal");
    const modalClose = document.getElementById("modal-close");
    const cartModal = document.getElementById("cartModal");
    const cartClose = document.getElementById("cart-close");
    const cartForm = document.getElementById("cart-form");

    // ====== МОДАЛКА ДЕТАЛЕЙ (якщо треба для перегляду тварини) ======
    document.querySelectorAll(".animal-image img").forEach(img => {
        img.addEventListener("click", () => {
            const card = img.closest(".animal-card");
            modal.querySelector("#modal-image").src = img.src;
            modal.querySelector("#modal-name").textContent = card.querySelector("h2").textContent;
            modal.querySelector("#modal-species").textContent = card.querySelector(".species").textContent;
            modal.querySelector("#modal-desc").textContent = card.querySelector(".desc").textContent;
            modal.querySelector("#modal-price").textContent = card.querySelector(".price").textContent;

            openModal(modal);
        });
    });

    modalClose.addEventListener("click", () => closeModal(modal));

    // ====== МОДАЛКА ДОДАВАННЯ В КОШИК ======
    document.querySelectorAll(".cart-btn").forEach(btn => {
        btn.addEventListener("click", () => {
            const id = btn.dataset.id;
            const name = btn.dataset.name;
            const price = btn.dataset.price;

            document.getElementById("cart-item-name").textContent = name;
            document.getElementById("cart-item-price").textContent = price;
            document.getElementById("animal_id").value = id;

            // Динамічна зміна маршруту
            cartForm.setAttribute("action", `/cart/${id}`);

            openModal(cartModal);
        });
    });

    cartClose.addEventListener("click", () => closeModal(cartModal));

    window.addEventListener("click", (e) => {
        if (e.target === modal) closeModal(modal);
        if (e.target === cartModal) closeModal(cartModal);
    });

    // ====== Анімації відкриття/закриття ======
    function openModal(m) {
        m.classList.remove("hidden");
        setTimeout(() => m.classList.add("show"), 10);
    }

    function closeModal(m) {
        m.classList.remove("show");
        setTimeout(() => m.classList.add("hidden"), 300);
    }
});
