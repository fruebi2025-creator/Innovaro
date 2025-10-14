// main.js
document.addEventListener('DOMContentLoaded', () => {
  fetchServices();
  bindContactForm();
});

function fetchServices(){
  fetch('api/get_services.php')
    .then(r => r.json())
    .then(data => {
      const list = document.getElementById('services-list');
      list.innerHTML = '';
      if (!data.services || !data.services.length) {
        list.innerHTML = '<p>No services found.</p>';
        return;
      }
      data.services.forEach(s => {
        const card = document.createElement('div');
        card.className = 'card';
        card.innerHTML = `<h4>${escapeHtml(s.title)}</h4>
                          <p>${escapeHtml(s.description).substring(0,180)}...</p>
                          <p><small>Category: ${escapeHtml(s.category || 'General')}</small></p>`;
        list.appendChild(card);
      });
    })
    .catch(err => {
      console.error(err);
      document.getElementById('services-list').innerHTML = '<p>Failed to load services.</p>';
    });
}

function bindContactForm(){
  const form = document.getElementById('contactForm');
  const result = document.getElementById('contactResult');
  form.addEventListener('submit', async (e) => {
    e.preventDefault();
    const fd = new FormData(form);
    const payload = {
      name: fd.get('name'),
      email: fd.get('email'),
      phone: fd.get('phone'),
      message: fd.get('message')
    };
    result.textContent = 'Sending...';
    try {
      const res = await fetch('api/save_inquiry.php', {
        method: 'POST',
        headers: {'Content-Type':'application/json'},
        body: JSON.stringify(payload)
      });
      const json = await res.json();
      if (json.success) {
        result.style.color = 'green';
        result.textContent = 'Message sent — we will contact you soon.';
        form.reset();
      } else {
        result.style.color = 'crimson';
        result.textContent = json.error || 'An error occurred';
      }
    } catch (err) {
      result.style.color = 'crimson';
      result.textContent = 'Request failed';
    }
  });
}

// small helper to avoid XSS
function escapeHtml(text) {
  if (!text) return '';
  return text.replace(/[&<>"']/g, (m) => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[m]));
}
