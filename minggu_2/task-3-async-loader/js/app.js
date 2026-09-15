'use strict';

const status = document.querySelector('#status');
const daftar = document.querySelector('#daftar-materi');
const tombolMuat = document.querySelector('#muat');
const tombolCobaLagi = document.querySelector('#coba-lagi');

function aturState(state, pesan) {
  status.dataset.state = state;
  status.textContent = pesan;
  tombolCobaLagi.hidden = state !== 'error';
}

async function ambilMateri() {
  const response = await fetch('data/materi.json');
  if (!response.ok) {
    throw new Error(`Gagal memuat data (HTTP Status: ${response.status})`);
  }
  return await response.json();
}

function renderMateri(data) {
  daftar.replaceChildren();
  data.forEach((item) => {
    const kartu = document.createElement('article');
    kartu.className = 'kartu';

    const judul = document.createElement('h3');
    judul.textContent = item.judul;

    const durasi = document.createElement('p');
    durasi.textContent = `Durasi: ${item.durasi} menit`;

    kartu.appendChild(judul);
    kartu.appendChild(durasi);
    daftar.appendChild(kartu);
  });
}

async function muatData() {
  aturState('loading', 'Memuat data...');
  tombolMuat.disabled = true;
  daftar.replaceChildren();

  try {
    const data = await ambilMateri();
    if (!Array.isArray(data) || data.length === 0) {
      aturState('empty', 'Tidak ada materi yang tersedia.');
    } else {
      renderMateri(data);
      aturState('success', 'Materi berhasil dimuat.');
    }
  } catch (error) {
    console.error('Detail Error:', error);
    aturState('error', error.message || 'Terjadi kesalahan saat memuat data.');
  } finally {
    tombolMuat.disabled = false;
  }
}

tombolMuat.addEventListener('click', muatData);
tombolCobaLagi.addEventListener('click', muatData);