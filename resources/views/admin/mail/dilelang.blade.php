<x-mail::message>
# Informasi Lelang Barang

Halo **{{ $data->barang->user->nama_lengkap }}** sang pemilik barang,

Kami ingin memberitahu Anda bahwa barang Anda sudah **dilelang** dengan rincian sebagai berikut :

- **Nama Barang**: {{ $data->barang->nama_barang }}
- **Deskripsi Barang**: {{ $data->barang->deskripsi_barang }}
- **Harga Akhir**: @money($data->harga_lelang)
- **Pemenang Lelang**: {{ $user->nama_lengkap }}
- **Tanggal Selesai Lelang**: {{ \Carbon\Carbon::create($data->tgl_lelang)->format('d-m-Y') }}

Terima kasih atas partisipasi Anda dalam lelang barang kami.
Jangan ragu untuk menghubungi kami jika Anda memiliki pertanyaan atau keluhan.

Hormat Saya<br>
{{ auth('petugas')->user()->nama_petugas }}
Petugas Lelang
</x-mail::message>
