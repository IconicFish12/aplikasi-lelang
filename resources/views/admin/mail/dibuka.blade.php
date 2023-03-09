<x-mail::message>
# Pelelangan Dibuka

Kepada Yang Terhormat **{{ $user->nama_lengkap }}**

Salam hangat dari tim lelang kami. Kami ingin memberitahu Anda bahwa pelelangan Barang milik Anda telah dibuka
dan siap untuk diikuti oleh para peminat.

Berikut adalah beberapa informasi penting yang perlu Anda ketahui tentang pelelangan tersebut:

- Nama Barang: **{{ $data->barang->nama_barang }}**
- Tanggal Lelang Dimulai: **{{ \Carbon\Carbon::create($data->tgl_mulai)->format('d-m-Y') }}**
- Tanggal Lelang Diakhiri: **{{ \Carbon\Carbon::create($data->tgl_selasai)->format('d-m-Y') }}**
- Harga awal: **@money($data->barang->harga_barang)**

Jika Anda memiliki pertanyaan atau masalah terkait pelelangan, jangan ragu untuk menghubungi kami.
Kami akan dengan senang hati membantu Anda.

Terima kasih atas kepercayaan Anda kepada tim lelang kami.

<x-mail::button :url="$url">
Aplikasi Lelang
</x-mail::button>

Hormat Saya<br>
{{ auth('petugas')->user()->nama_petugas }}
Petugas Lelang
</x-mail::message>
