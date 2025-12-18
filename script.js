document.addEventListener('DOMContentLoaded', () => {

  function showToast(message, type = 'info') {
    const toast = document.createElement('div');
    toast.className = `toast toast-${type}`;
    toast.innerHTML = `
      <span>${message}</span>
      <button class="toast-close" aria-label="Tutup">&times;</button>
    `;
    document.body.appendChild(toast);

    setTimeout(() => toast.classList.add('show'), 50);

    const hide = () => {
      toast.classList.remove('show');
      setTimeout(() => toast.remove(), 300);
    };

    toast.querySelector('.toast-close').addEventListener('click', hide);
    setTimeout(hide, 3000);
  }

  const themeBtn = document.getElementById('toggle-theme');
  if (themeBtn) {
    themeBtn.addEventListener('click', () => {
      document.body.classList.toggle('dark-mode');
      const isDark = document.body.classList.contains('dark-mode');
      themeBtn.textContent = isDark ? 'Light Mode' : 'Dark Mode';
      localStorage.setItem('sipus-theme', isDark ? 'dark' : 'light');
      showToast(`Switched to ${isDark ? 'dark' : 'light'} mode`, 'info');
    });

    if (localStorage.getItem('sipus-theme') === 'dark') {
      document.body.classList.add('dark-mode');
      themeBtn.textContent = 'Light Mode';
    }
  }

  const sidebarBtn = document.getElementById('toggle-sidebar');
  const sidebar = document.querySelector('.sidebar');
  const content = document.querySelector('.content');

  if (sidebarBtn && sidebar && content) {
    sidebarBtn.addEventListener('click', () => {
      sidebar.classList.toggle('hide');
      content.style.marginLeft = sidebar.classList.contains('hide') ? '20px' : '270px';
      showToast('Sidebar toggled', 'success');
    });
  }

  function openModal(html) {
    const modal = document.createElement('div');
    modal.className = 'modal show';
    modal.innerHTML = `
      <div class="modal-content">
        <button class="modal-close">&times;</button>
        ${html}
      </div>
    `;
    document.body.appendChild(modal);

    setTimeout(() => modal.classList.add('visible'), 50);

    modal.querySelector('.modal-close').addEventListener('click', () => modal.remove());
    modal.addEventListener('click', (e) => {
      if (e.target === modal) modal.remove();
    });
  }

  document.querySelectorAll('.card, .book-item').forEach(el => {
    el.addEventListener('mouseenter', () => el.classList.add('fade-in'));
    el.addEventListener('mouseleave', () => el.classList.remove('fade-in'));
  });

  const statusContainer = document.getElementById('status-container');

  if (statusContainer) {
    async function updateStatusFromServer() {
      try {
        const res = await fetch("get_status.php");
        if (!res.ok) throw new Error("Network error");

        const data = await res.json();

        statusContainer.innerHTML = "";
        const frag = document.createDocumentFragment();

        data.forEach(b => {
          const card = document.createElement('div');
          card.className = "card";

          card.innerHTML = `
            <h3>${escapeHtml(b.judul)}</h3>
            <p>Penulis: ${escapeHtml(b.penulis)}</p>
            <p>Tahun: ${escapeHtml(b.tahun)}</p>
            <p>Status: <span class="status ${b.status}">${escapeHtml(b.status)}</span></p>
            ${b.tanggal_kembali ? `<p>Kembali: ${escapeHtml(b.tanggal_kembali)}</p>` : ""}
          `;

          frag.appendChild(card);
        });

        statusContainer.appendChild(frag);

      } catch (err) {
        showToast("Gagal memuat status dari server", "error");
      }
    }

    updateStatusFromServer();
    setInterval(updateStatusFromServer, 10000);
  }

  document.querySelectorAll('.info-toggle').forEach(toggle => {
    toggle.addEventListener('click', () => {
      const panel = toggle.nextElementSibling;
      if (!panel) return;

      panel.classList.toggle('show');
      panel.style.maxHeight = panel.classList.contains('show')
        ? panel.scrollHeight + 'px'
        : '0';

      toggle.textContent = panel.classList.contains('show')
        ? "Sembunyikan"
        : "Lihat Detail";
    });
  });

 
  function escapeHtml(s) {
    return String(s)
      .replace(/&/g, "&amp;")
      .replace(/</g, "&lt;")
      .replace(/>/g, "&gt;")
      .replace(/"/g, "&quot;")
      .replace(/'/g, "&#039;");
  }

});

