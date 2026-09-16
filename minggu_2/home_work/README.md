# Homework Modul 2 — Interactive Profile Card

Aplikasi web interaktif berbasis **Vanilla JavaScript** yang menampilkan kartu profil dan daftar keterampilan. Data profil dimuat secara asinkron dari berkas JSON lokal.

---

## 👤 Identitas Mahasiswa

* **Nama**: Hilmi Kautsar
* **NIM**: 251511041
* **Kelas**: 2B-D3 Teknik Informatika
* **Mata Kuliah**: Proyek 3 — Proyek Pengembangan Perangkat Lunak Berbasis Web

---

## ✨ Fitur Utama

1. **Asynchronous Data Loading (`fetch`)**
   - Mengambil data profil dan keterampilan dari `data/profile.json` secara asinkron menggunakan `async/await`.
   - Menangani empat state UI secara visual: **Loading**, **Error** (dengan tombol Coba Lagi), **Empty** (jika JSON kosong), dan **Content**.
2. **Toggle Detail Informasi**
   - Menampilkan/menyembunyikan detail bio dan lokasi menggunakan `classList.toggle('hidden')`.
   - Mengisi dan memperbarui atribut aksesibilitas `aria-expanded` (`true`/`false`) secara langsung pada tombol.
3. **Toggle Tema (Dark Mode)**
   - Mengubah skema warna tampilan antara mode terang dan gelap berbasis kelas CSS pada elemen `<body>`.
4. **Manajemen Keterampilan (CRUD Sederhana)**
   - **Tambah Keterampilan**: Form dengan validasi input (menolak teks kosong/hanya spasi).
   - **Hapus Keterampilan**: Setiap item memiliki tombol hapus dinamis yang memperbarui state dan tampilan.
   - **Proteksi Klik Berulang**: Menggunakan `event.preventDefault()` dan penguncian state submission untuk mencegah duplikasi data.

---

## 🚀 Cara Menjalankan Menggunakan Local Server
### Langkah-langkah
1. Buka folder proyek home_work di Visual Studio Code.
2. Pasang ekstensi Live Server dari VS Code Marketplace.
3. Klik kanan pada berkas `index.html` lalu pilih **Open with Live Server** (atau tekan pintasan **Alt + L, Alt + O**).
4. Browser akan otomatis terbuka dan mengarah ke alamat http://127.0.0.1:5500/index.html.
