<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Keranjang Belanja</title>
</head>

<body>

    <h1>Keranjang Belanja Tanpa Login</h1>

    <p>
        <a href="{{ url('/') }}">Kembali ke daftar barang</a>
    </p>

    <h2>Isi Keranjang</h2>

    <div id="isiKeranjang"></div>

    <p>
        <strong>
            Total:
            <span id="total">Rp 0</span>
        </strong>
    </p>

    <button type="button" id="btnKosongkan">
        Kosongkan keranjang
    </button>

    <script>

        const KUNCI_KERANJANG = 'keranjang';

        // Data produk berasal dari database Laravel
        const produk = @json($barangs);

        function rupiah(angka) {
            return 'Rp ' + Number(angka).toLocaleString('id-ID');
        }

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

        function tampilkanKeranjang() {

            const container =
                document.getElementById('isiKeranjang');

            const totalElement =
                document.getElementById('total');

            const keranjang = bacaKeranjang();

            container.innerHTML = '';

            let total = 0;

            if (keranjang.length === 0) {

                container.innerHTML =
                    '<p>Keranjang kosong.</p>';

                totalElement.textContent = 'Rp 0';

                return;
            }

            keranjang.forEach(function (item) {

                const p = produk.find(function (produk) {

                    return Number(produk.id) === Number(item.id);

                });

                if (!p) {
                    return;
                }

                const jumlah =
                    Number(item.jumlah);

                const subtotal =
                    Number(p.harga) * jumlah;

                total += subtotal;

                const div =
                    document.createElement('div');

                div.innerHTML = `
                    <p>
                        <strong>${p.nama}</strong>
                    </p>

                    <p>
                        ${rupiah(p.harga)}
                        ×
                        ${jumlah}
                        =
                        ${rupiah(subtotal)}
                    </p>

                    <button
                        type="button"
                        onclick="kurangi(${p.id})"
                    >
                        -
                    </button>

                    <span>${jumlah}</span>

                    <button
                        type="button"
                        onclick="tambah(${p.id})"
                    >
                        +
                    </button>

                    <button
                        type="button"
                        onclick="hapus(${p.id})"
                    >
                        Hapus
                    </button>

                    <hr>
                `;

                container.appendChild(div);

            });

            totalElement.textContent =
                rupiah(total);
        }

        function tambah(id) {

            const keranjang =
                bacaKeranjang();

            const item =
                keranjang.find(function (item) {

                    return Number(item.id) === Number(id);

                });

            const p =
                produk.find(function (produk) {

                    return Number(produk.id) === Number(id);

                });

            if (!item || !p) {
                return;
            }

            // Jangan melebihi stok
            if (item.jumlah >= Number(p.stok)) {

                alert('Jumlah tidak boleh melebihi stok.');

                return;
            }

            item.jumlah++;

            simpanKeranjang(keranjang);

            tampilkanKeranjang();
        }

        function kurangi(id) {

            const keranjang =
                bacaKeranjang();

            const index =
                keranjang.findIndex(function (item) {

                    return Number(item.id) === Number(id);

                });

            if (index === -1) {
                return;
            }

            keranjang[index].jumlah--;

            if (keranjang[index].jumlah <= 0) {

                keranjang.splice(index, 1);

            }

            simpanKeranjang(keranjang);

            tampilkanKeranjang();
        }

        function hapus(id) {

            let keranjang =
                bacaKeranjang();

            keranjang =
                keranjang.filter(function (item) {

                    return Number(item.id) !== Number(id);

                });

            simpanKeranjang(keranjang);

            tampilkanKeranjang();
        }

        document
            .getElementById('btnKosongkan')
            .addEventListener('click', function () {

                localStorage.removeItem(
                    KUNCI_KERANJANG
                );

                tampilkanKeranjang();

            });

        tampilkanKeranjang();

    </script>

</body>

</html>