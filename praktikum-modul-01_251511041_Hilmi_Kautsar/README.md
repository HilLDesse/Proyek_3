# Praktikum Modul 1 - Hilmi Kautsar / 251511000

## Ringkasan Halaman
Halamain ini merupakan web profil mahasiswa yang dibangun menggunakan HTML semantik dan CSS. Profil terdiri dari Tentang personal, keterampilan dan juga kontak mahasiswa Halaman dirancang dengan pendekatan mobile first, memiliki struktur layout yang fleksibel, serta mendukung aksesibilitas navigasi keyboard.

## Tiga Keputusan Teknis
1. **Penerapan Mobile First Layout**: Membangun gaya dasar untuk layar seluler terlebih dahulu menggunakan `flex-direction: column`, kemudian menggunakan media query `(min-width: 768px)` untuk mengubah tata letak menjadi tiga kolom sejajar (`flex-direction: row`).
2. **Penggunaan Design Tokens lewat CSS Custom Properties**: Membatasi penggunaan warna dan spasi melalui variabel `:root` (`--primary-color`, `--bg-color`, `--text-color`, `--spacing-base`) untuk menjaga konsistensi visual di seluruh komponen.
3. **Penerapan Global Box Sizing**: Menggunakan `* { box-sizing: border-box; }` agar perhitungan padding dan border masuk ke dalam total lebar elemen, mencegah terjadinya masalah overflow horizontal.

## Masalah, Diagnosis, dan Perbaikan
- **Masalah 1**: Teks alamat email meluap keluar dari batas kartu pada viewport 320px.  
  Diagnosis: String alamat email tidak memiliki spasi sehingga string melewati batas kartu.  
  Perbaikan: Menambahkan `word-break: break-word;` pada kelas `.card p`.
- **Masalah 2**: Elemen navigasi terpotong pada layar seluler sempit.  
  Diagnosis: Kontainer navigasi berbasis Flexbox belum mengizinkan pemutusan baris.  
  Perbaikan: Menambahkan `flex-wrap: wrap;` pada `nav.container`.

## Hasil Pengujian Empat Viewport
- **320px**: Tampilan 1 kolom vertikal rapi, navigasi membungkus dengan benar, dan bebas dari overflow.
- **375px**: Kartu tersusun vertikal dengan rapih.
- **768px**: Kartu berubah posisi menjadi 3 kolom sejajar secara horizontal.
- **1024px**: Kontainer tertahan pada lebar maksimum `1000px` dan berada tepat di tengah layar.

## Refleksi Belajar
Pembelajaran menggunakan modul dan juga pengerjaan worksheet yang telah diberikan oleh para manager memberikan ilmu ilmu baru untuk saya terkait pembuatan website sederhana menggunakan HTML dan CSS. Hal hal yang baru untuk saya seperti penggunaan design tokens, penerapan mobile-first, dan juga berbagai properti CSS. Praktikum ini juga memberikan saya pengalaman baru terkait penggunakan DevTools dan juga Validator yang digunakan untuk mengecek struktur website. Dalam pengerjaan praktikum ini saya menggunakan AI untuk bertanya terkait tag, properti, ataupun kata kata yang tidak saya pahami, Saya berharap bisa belajar dengan cara yang lebih efisien namun tetap meningkatkan diri saya dalam skill pembuatan website

## Log AI atau Sumber Bantuan
- **Pertanyaan**: "Bagaimana cara menyusun CSS responsif dengan Flexbox tanpa ID selector dan tanpa !important?"
- **Ringkasan Jawaban**: AI memberikan saran struktur mobile-first menggunakan kelas reusable (`.card-list`, `.card`) serta variabel `:root`.
- **Cara Fact Check**: Memeriksa kode menggunakan W3C dan menguji Box Model pada tab Computed di DevTools.
- **Perubahan Sendiri**: Penyesuaian batas breakpoint ke `768px` dan penambahan properti `word-break: break-word;`.