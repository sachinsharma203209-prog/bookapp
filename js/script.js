async function postForm(url, data) {
  const body = new URLSearchParams(data);
  const res = await fetch(url, { method: 'POST', headers: { 'Accept': 'application/json' }, body });
  return res.json();
}

document.querySelectorAll('.add-to-cart').forEach(btn => {
  btn.addEventListener('click', async () => {
    const r = await postForm('/api/cart.php', { action: 'add', book_id: btn.dataset.bookId, quantity: 1 });
    alert(r.ok ? 'Added to cart' : (r.error || 'Failed'));
  });
});

document.querySelectorAll('.remove-item').forEach(btn => {
  btn.addEventListener('click', async () => {
    const r = await postForm('/api/cart.php', { action: 'remove', cart_id: btn.dataset.cartId });
    if (r.ok) location.reload();
  });
});
