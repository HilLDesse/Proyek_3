'use strict';

const peserta = [
  { id: 1, nama: 'Alya', prodi: 'Teknik Informatika' },
  { id: 2, nama: 'Bima', prodi: 'Sistem Informasi' },
];

const form = document.querySelector('#form-peserta');
const namaInput = document.querySelector('#nama');
const prodiInput = document.querySelector('#prodi');
const filterInput = document.querySelector('#filter-prodi');
const daftar = document.querySelector('#daftar-peserta');
const status = document.querySelector('#status');
const errorNama = document.querySelector('#error-nama');
const errorProdi = document.querySelector('#error-prodi');

function validasiPeserta(calon) {
  const namaTrimmed = calon.nama ? calon.nama.trim() : '';
  let errNama = '';
  let errProdi = '';

  if (!namaTrimmed) {
    errNama = 'Nama peserta wajib diisi.';
  } else if (namaTrimmed.length < 3) {
    errNama = 'Nama peserta minimal 3 karakter.';
  }

  if (!calon.prodi) {
    errProdi = 'Program studi wajib dipilih.';
  }

  return {
    valid: errNama === '' && errProdi === '',
    errorNama: errNama,
    errorProdi: errProdi
  };
}

function buatKartuPeserta(item) {
  const article = document.createElement('article');
  article.classList.add('kartu');

  const h2 = document.createElement('h2');
  h2.textContent = item.nama;

  const p = document.createElement('p');
  p.textContent = item.prodi;

  article.appendChild(h2);
  article.appendChild(p);

  return article;
}

function renderPeserta(data) {
  if (data.length === 0) {
    const pKosong = document.createElement('p');
    pKosong.textContent = 'Tidak ada peserta';
    daftar.replaceChildren(pKosong);
    status.textContent = 'Menampilkan 0 peserta.';
    return;
  }

  const kartus = data.map(item => buatKartuPeserta(item));
  daftar.replaceChildren(...kartus);
  status.textContent = `Menampilkan ${data.length} peserta.`;
}

function dapatkanDataTerfilter() {
  const filterValue = filterInput.value;
  if (filterValue === 'semua') {
    return peserta;
  }
  return peserta.filter(p => p.prodi === filterValue);
}

form.addEventListener('submit', (event) => {
  event.preventDefault();

  const calon = {
    nama: namaInput.value,
    prodi: prodiInput.value
  };

  const hasilValidasi = validasiPeserta(calon);

  errorNama.textContent = hasilValidasi.errorNama;
  if (hasilValidasi.errorNama) {
    namaInput.setAttribute('aria-invalid', 'true');
  } else {
    namaInput.removeAttribute('aria-invalid');
  }

  errorProdi.textContent = hasilValidasi.errorProdi;
  if (hasilValidasi.errorProdi) {
    prodiInput.setAttribute('aria-invalid', 'true');
  } else {
    prodiInput.removeAttribute('aria-invalid');
  }

  if (!hasilValidasi.valid) {
    return;
  }

  const pesertaBaru = {
    id: Date.now(),
    nama: calon.nama.trim(),
    prodi: calon.prodi
  };

  peserta.push(pesertaBaru);

  form.reset();
  errorNama.textContent = '';
  errorProdi.textContent = '';
  namaInput.removeAttribute('aria-invalid');
  prodiInput.removeAttribute('aria-invalid');

  renderPeserta(dapatkanDataTerfilter());
});

filterInput.addEventListener('change', () => {
  renderPeserta(dapatkanDataTerfilter());
});

renderPeserta(peserta);