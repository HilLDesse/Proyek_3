<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Toko Alat Tulis</title>
</head>

<body>

    <h1>Toko Alat Tulis</h1>

    <p>
        <a href="{{ url('/keranjang') }}">
            Keranjang (<span id="jumlahKeranjang">0</span>)
        </a>
    </p>

    <h2>Daftar Barang</h2>

    <ul>
        @forelse ($barangs as $barang)

            <li>
                <strong>{{ $barang->nama }}</strong>
                -
                Rp {{ number_format($barang->harga, 0, ',', '.') }}
                -
                Stok: {{ $barang->stok }}

                <button
                    type="button"
                    onclick="tambahKeKeranjang({{ $barang->id }})"
                    @disabled($barang->stok <= 0)
                >
                    Masukkan ke keranjang
                </button>
            </li>

        @empty

            <li>Belum ada barang.</li>

        @endforelse
    </ul>

    <script>

        const KUNCI_KERANJANG = 'keranjang';

        function bacaKeranjang() {
            try {
                return JSON.parse(
                    localStorage.getItem(KUNCI_KERANJANG)
                ) || [];
            } catch (error) {
                return [];
            }
        }

        function simpanKeranjang(keranjang) {
            localStorage.setItem(
                KUNCI_KERANJANG,
                JSON.stringify(keranjang)
            );
        }

        function jumlahItemKeranjang() {
            const keranjang = bacaKeranjang();

            return keranjang.reduce(function (total, item) {
                return total + Number(item.jumlah);
            }, 0);
        }

        function tampilkanJumlahKeranjang() {
            document.getElementById('jumlahKeranjang').textContent =
                jumlahItemKeranjang();
        }

        function tambahKeKeranjang(id) {

            const keranjang = bacaKeranjang();

            const item = keranjang.find(function (item) {
                return Number(item.id) === Number(id);
            });

            if (item) {
                item.jumlah++;
            } else {
                keranjang.push({
                    id: id,
                    jumlah: 1
                });
            }

            simpanKeranjang(keranjang);

            tampilkanJumlahKeranjang();
        }

        tampilkanJumlahKeranjang();

    </script>

</body>
</html>