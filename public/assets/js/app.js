document.addEventListener('DOMContentLoaded', () => {
  const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

  const updateHeaderCount = (count, subtotal) => {
    const counter = document.querySelector('[data-cart-count]');
    const subtotalNodes = document.querySelectorAll('[data-cart-subtotal]');

    if (counter) {
      counter.textContent = String(count);
    }

    subtotalNodes.forEach((node) => {
      node.textContent = subtotal;
    });
  };

  document.querySelectorAll('[data-cart-add]').forEach((button) => {
    button.addEventListener('click', async () => {
      const productId = button.getAttribute('data-product-id');
      const quantity = button.getAttribute('data-quantity') || '1';

      const response = await fetch('/cart/add', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-Token': csrf,
        },
        body: JSON.stringify({ product_id: productId, quantity }),
      });

      const data = await response.json();

      if (data.success) {
        updateHeaderCount(data.count, data.subtotal_formatted);
        button.classList.add('is-added');
        setTimeout(() => button.classList.remove('is-added'), 900);
      }
    });
  });

  document.querySelectorAll('[data-cart-quantity]').forEach((field) => {
    field.addEventListener('change', async () => {
      const productId = field.getAttribute('data-product-id');

      const response = await fetch('/cart/update', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-Token': csrf,
        },
        body: JSON.stringify({ product_id: productId, quantity: field.value }),
      });

      const data = await response.json();

      if (data.success) {
        updateHeaderCount(data.count, data.subtotal_formatted);
        window.location.reload();
      }
    });
  });

  document.querySelectorAll('[data-delivery-toggle]').forEach((input) => {
    input.addEventListener('change', () => {
      const deliveryFields = document.querySelector('[data-delivery-fields]');
      if (!deliveryFields) return;
      deliveryFields.hidden = input.value !== 'delivery';
    });
  });
});
