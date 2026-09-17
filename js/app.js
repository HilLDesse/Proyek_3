'use strict';

const fasilitasData = [
  { id: 1, judul: 'Wi-Fi 100 Mbps', deskripsi: 'Koneksi stabil dan cepat untuk zoom meeting atau unduh materi kuliah.', gambar: 'assets/wifi.jpg' },
  { id: 2, judul: 'Stop kontak Tiap Meja', deskripsi: 'Bebas khawatir baterai laptop habis saat nugas seharian.', gambar: 'assets/stopkontak.jpg' },
  { id: 3, judul: 'Harga Student-Friendly', deskripsi: 'Menu kopi dan camilan lezat dengan harga ramah kantong mahasiswa.', gambar: 'assets/budget.jpg' }
];

const menuData = [
  { id: 101, nama: 'Kopi Susu Nugas', kategori: 'kopi', harga: 12000, gambar: 'assets/kopsu.jpg' },
  { id: 102, nama: 'Coffee Latte', kategori: 'kopi', harga: 12000, gambar: 'assets/coffelatte.jpg' },
  { id: 103, nama: 'Matcha Latte', kategori: 'non-kopi', harga: 15000, gambar: 'assets/matchalatte.jpg' },
  { id: 104, nama: 'Milk Shake', kategori: 'non-kopi', harga: 15000, gambar: 'assets/milk.jpg' }
];

const faqData = [
  { id: 1, pertanyaan: 'Berapa jam operasional Kopi Teman Tugas?', jawaban: 'Kami buka setiap hari mulai pukul 08.00 hingga 23.00 WIB.' },
  { id: 2, pertanyaan: 'Apakah tersedia colokan di setiap meja?', jawaban: 'Ya, seluruh meja indoor maupun outdoor dilengkapi stopkontak khusus.' },
  { id: 3, pertanyaan: 'Apakah bisa reservasi tempat untuk kerja kelompok?', jawaban: 'Bisa, kamu cukup mengisi form kontak di bawah untuk pesan tempat.' }
];

const DOM = {
  hamburgerBtn: document.querySelector('#hamburger-btn'),
  navMenu: document.querySelector('#nav-menu'),
  themeToggleBtn: document.querySelector('#theme-toggle'),
  daftarFasilitas: document.querySelector('#daftar-fasilitas'),
  daftarMenu: document.querySelector('#daftar-menu'),
  filterContainer: document.querySelector('#filter-container'),
  pesanMenuKosong: document.querySelector('#pesan-menu-kosong'),
  faqContainer: document.querySelector('#faq-container'),
  formKontak: document.querySelector('#form-kontak'),
  inputNama: document.querySelector('#nama'),
  inputEmail: document.querySelector('#email'),
  inputPesan: document.querySelector('#pesan'),
  errorNama: document.querySelector('#error-nama'),
  errorEmail: document.querySelector('#error-email'),
  errorPesan: document.querySelector('#error-pesan'),
  ringkasanPesan: document.querySelector('#ringkasan-pesan'),
  backToTopBtn: document.querySelector('#back-to-top')
};

function handleNavToggle() {
  const isOpen = DOM.navMenu.classList.toggle('active');
  DOM.hamburgerBtn.setAttribute('aria-expanded', isOpen.toString());
}

function handleThemeToggle() {
  const isDark = document.body.classList.toggle('dark-theme');
  DOM.themeToggleBtn.setAttribute('aria-pressed', isDark.toString());
  DOM.themeToggleBtn.textContent = isDark ? 'Mode Terang' : 'Mode Gelap';
}

function renderFasilitas() {
  DOM.daftarFasilitas.replaceChildren();

  fasilitasData.forEach((item) => {
    const card = document.createElement('article');
    card.className = 'card';

    const img = document.createElement('img');
    img.src = item.gambar;
    img.alt = `Ikon ${item.judul}`;
    img.className = 'card-icon';

    const h3 = document.createElement('h3');
    h3.textContent = item.judul;

    const p = document.createElement('p');
    p.textContent = item.deskripsi;

    card.append(img, h3, p);
    DOM.daftarFasilitas.appendChild(card);
  });
}

function renderMenu(items) {
  DOM.daftarMenu.replaceChildren();

  if (items.length === 0) {
    DOM.pesanMenuKosong.classList.remove('hidden');
    return;
  }

  DOM.pesanMenuKosong.classList.add('hidden');

  items.forEach((item) => {
    const card = document.createElement('article');
    card.className = 'card-menu';

    const img = document.createElement('img');
    img.src = item.gambar;
    img.alt = item.nama;

    const h3 = document.createElement('h3');
    h3.textContent = item.nama;

    const p = document.createElement('p');
    p.textContent = `Rp ${item.harga.toLocaleString('id-ID')}`;

    card.append(img, h3, p);
    DOM.daftarMenu.appendChild(card);
  });
}

function handleFilterMenu(event) {
  const target = event.target;
  if (!target.classList.contains('btn-filter')) return;

  const buttons = DOM.filterContainer.querySelectorAll('.btn-filter');
  buttons.forEach(btn => btn.classList.remove('active'));
  target.classList.add('active');

  const category = target.dataset.category;
  if (category === 'semua') {
    renderMenu(menuData);
  } else {
    const filtered = menuData.filter(item => item.kategori === category);
    renderMenu(filtered);
  }
}

function renderFaq() {
  DOM.faqContainer.replaceChildren();

  faqData.forEach((item) => {
    const faqItem = document.createElement('div');
    faqItem.className = 'faq-item';

    const btn = document.createElement('button');
    btn.className = 'faq-question';
    btn.type = 'button';
    btn.setAttribute('aria-expanded', 'false');

    const questionText = document.createElement('span');
    questionText.textContent = item.pertanyaan;

    const icon = document.createElement('span');
    icon.textContent = '+';

    btn.append(questionText, icon);

    const answerDiv = document.createElement('div');
    answerDiv.className = 'faq-answer';

    const answerText = document.createElement('p');
    answerText.textContent = item.jawaban;
    answerDiv.appendChild(answerText);

    btn.addEventListener('click', () => {
      const isExpanded = btn.getAttribute('aria-expanded') === 'true';

      const allBtns = DOM.faqContainer.querySelectorAll('.faq-question');
      const allAnswers = DOM.faqContainer.querySelectorAll('.faq-answer');
      allBtns.forEach(b => {
        b.setAttribute('aria-expanded', 'false');
        b.querySelector('span:last-child').textContent = '+';
      });
      allAnswers.forEach(a => a.classList.remove('open'));

      if (!isExpanded) {
        btn.setAttribute('aria-expanded', 'true');
        icon.textContent = '−';
        answerDiv.classList.add('open');
      }
    });

    faqItem.append(btn, answerDiv);
    DOM.faqContainer.appendChild(faqItem);
  });
}

function resetFormErrors() {
  DOM.errorNama.textContent = '';
  DOM.errorEmail.textContent = '';
  DOM.errorPesan.textContent = '';
  DOM.inputNama.removeAttribute('aria-invalid');
  DOM.inputEmail.removeAttribute('aria-invalid');
  DOM.inputPesan.removeAttribute('aria-invalid');
}

function handleFormSubmit(event) {
  event.preventDefault();
  resetFormErrors();

  const nama = DOM.inputNama.value.trim();
  const email = DOM.inputEmail.value.trim();
  const pesan = DOM.inputPesan.value.trim();

  let isValid = true;

  if (nama.length < 3) {
    DOM.errorNama.textContent = 'Nama wajib diisi minimal 3 karakter.';
    DOM.inputNama.setAttribute('aria-invalid', 'true');
    isValid = false;
  }

  if (!email.includes('@') || !email.includes('.')) {
    DOM.errorEmail.textContent = 'Masukkan alamat email yang valid.';
    DOM.inputEmail.setAttribute('aria-invalid', 'true');
    isValid = false;
  }

  if (pesan.length < 5) {
    DOM.errorPesan.textContent = 'Pesan wajib diisi minimal 5 karakter.';
    DOM.inputPesan.setAttribute('aria-invalid', 'true');
    isValid = false;
  }

  if (!isValid) return;

  DOM.ringkasanPesan.replaceChildren();

  const title = document.createElement('h3');
  title.textContent = 'Pesan Berhasil Terkirim!';

  const pNama = document.createElement('p');
  pNama.textContent = `Nama: ${nama}`;

  const pEmail = document.createElement('p');
  pEmail.textContent = `Email: ${email}`;

  const pPesan = document.createElement('p');
  pPesan.textContent = `Pesan: ${pesan}`;

  DOM.ringkasanPesan.append(title, pNama, pEmail, pPesan);
  DOM.ringkasanPesan.classList.remove('hidden');

  DOM.formKontak.reset();
}

function handleScroll() {
  if (window.scrollY > 300) {
    DOM.backToTopBtn.classList.remove('hidden');
  } else {
    DOM.backToTopBtn.classList.add('hidden');
  }
}

function scrollToTop() {
  window.scrollTo({ top: 0, behavior: 'smooth' });
}

document.addEventListener('DOMContentLoaded', () => {
  renderFasilitas();
  renderMenu(menuData);
  renderFaq();

  DOM.hamburgerBtn.addEventListener('click', handleNavToggle);
  DOM.themeToggleBtn.addEventListener('click', handleThemeToggle);
  DOM.filterContainer.addEventListener('click', handleFilterMenu);
  DOM.formKontak.addEventListener('submit', handleFormSubmit);
  DOM.backToTopBtn.addEventListener('click', scrollToTop);
  window.addEventListener('scroll', handleScroll);
});