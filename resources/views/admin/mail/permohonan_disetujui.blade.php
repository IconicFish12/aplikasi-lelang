<x-mail::message>
# Permohonan Disetujui

Yang Terhomat **{{ $user }}**

Kami senang memberitahu Anda bahwa permohonan lelang Anda telah **disetujui!**
Kami ingin mengucapkan selamat dan terima kasih telah memilih layanan lelang kami.

Berikut adalah detail persetujuan permohonan lelang Anda:
- Status Persetujuan : **Disetujui**,
- Waktu Disetujui : **{{ \Carbon\Carbon::create($data->updated_at)->format('d-m-Y') }}**,
- Nama Barang : **{{ $data->nama_barang }}**,
- Harga Barang : **@money($data->harga_barang)**

Silahkan Login dan mengisi data barang anda didalam Website Aplikasi Lelang dengan menekan tombol dibawah ini
Terima kasih lagi atas kepercayaan Anda pada layanan lelang kami. Kami berharap lelang Anda sukses dan membawa hasil yang memuaskan.

<x-mail::button :url="$url">
Aplikasi Lelang
</x-mail::button>

Hormat Saya,<br>
{{ $petugas }}
Petugas Lelang
</x-mail::message>
