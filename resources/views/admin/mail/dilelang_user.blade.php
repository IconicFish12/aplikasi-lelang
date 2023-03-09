<x-mail::message>
# Informasi Pemenang Lelang

Halo **{{ $user->nama_lengkap }}**,

Kami ingin memberitahu bahwa Anda adalah pemenang lelang dengan rincian sebagai berikut:

- **Nama Barang**: {{ $data->barang->nama_barang }}
- **Deskripsi Barang**: {{ $data->barang->deskripsi_barang }}
- **Harga Akhir**: @money($data->harga_lelang)
- **Penjual**: {{ $data->barang->user->nama_lengkap }}
- **Tanggal Selesai Lelang**: {{ \Carbon\Carbon::create($data->tgl_lelang)->format('d-m-Y') }}

Silahkan hubungi penjual untuk mengatur pembayaran dan pengiriman barang.
Jangan ragu untuk menghubungi kami jika Anda memiliki pertanyaan atau keluhan.

Terima kasih atas partisipasi Anda dalam lelang barang kami.

Salam,<br>
{{ auth('petugas')->user()->nama_lengkap }}
Petugas Lelang
</x-mail::message>
