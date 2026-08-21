# PANDUAN LENGKAP PENGGUNAAN SISTEM WEBSITE
# IKATAN SARJANA MELAYU YOGYAKARTA (ISMY)
**Dokumen Resmi Petunjuk Teknis, Panduan Operasional & Penjelasan UI/UX**

---

* **Nama Sistem:** Web Portal & Manajemen Keanggotaan ISMY
* **Organisasi:** Ikatan Sarjana Melayu Yogyakarta (ISMY)
* **Versi Sistem:** 1.0 (Rilis Stabil)
* **Teknologi:** Laravel 11, Filament 3 Admin, PostgreSQL, TailwindCSS, DomPDF, BaconQrCode, Alpine.js
* **Target Pembaca:** Pengunjung Publik, Anggota Terdaftar, dan Administrator Sistem

---

## DAFTAR ISI

1. **BAB 1: PENGENALAN SISTEM WEBSITE ISMY**
   - 1.1 Latar Belakang & Tujuan Web
   - 1.2 Hak Akses & Peran Pengguna (*User Roles*)
   - 1.3 Struktur URL & Akses Halaman
2. **BAB 2: PANDUAN PENGGUNA PUBLIK (TAMU & CALON ANGGOTA)**
   - 2.1 Menjelajahi Menu Beranda & Navigasi
   - 2.2 Membaca Berita, Artikel & Kategori Publikasi
   - 2.3 Profil Organisasi, Visi Misi, Sejarah & Unduh AD/ART
   - 2.4 Struktur Kepengurusan & Jaringan Cabang se-DIY
   - 2.5 Fitur Pencarian Global (*Smart Search Engine*)
   - 2.6 Panduan Langkah Demi Langkah Mendaftar Anggota Baru
3. **BAB 3: PANDUAN PORTAL ANGGOTA (MEMBER DASHBOARD)**
   - 3.1 Masuk Akun (*Login Member*)
   - 3.2 Fitur Dashboard & Kartu Tanda Anggota (KTA) Digital
   - 3.3 Cara Mengunduh Kartu Anggota Resmi (Format PDF Cetak)
   - 3.4 Memantau Riwayat Partisipasi Agenda & Kegiatan
   - 3.5 Mengelola Profil Akun & Keamanan Kata Sandi
4. **BAB 4: PANDUAN LENGKAP ADMINISTRATOR (PANEL FILAMENT ADMIN)**
   - 4.1 Masuk ke Panel Administrator (`/admin`)
   - 4.2 Verifikasi Calon Anggota (Fitur 1-Klik *Approval* & Pembuatan Akun Otomatis)
   - 4.3 Manajemen Data Anggota Aktif & Direktori
   - 4.4 Manajemen Berita & Artikel Ilmiah
   - 4.5 Manajemen Kategori Berita & Tag
   - 4.6 Manajemen Agenda & Kegiatan Organisasi
   - 4.7 Manajemen Dokumen Legalitas (AD/ART, SK, LPJ)
   - 4.8 Manajemen Galeri Dokumentasi Foto & Video
   - 4.9 Manajemen Struktur Pengurus & Master Jabatan
   - 4.10 Manajemen Wilayah Cabang DIY
   - 4.11 Manajemen Mitra & Kerjasama
   - 4.12 Pengelolaan Tanya Jawab (FAQ) & Kotak Pesan Masuk
5. **BAB 5: PENJELASAN KONSEP & FILOSOFI DESAIN UI/UX**
   - 5.1 Konsep Visual *"Malay Heritage meets Modern Academic"*
   - 5.2 Standar Palet Warna & Nilai Filosofis
   - 5.3 Tipografi & Hierarki Font
   - 5.4 Fitur Pengalaman Pengguna (*User Experience Highlights*)
   - 5.5 Teknologi Grafis Vektor (SVG) & Keamanan Cetak
6. **LAMPIRAN & INFORMASI TEKNIS**

---

# BAB 1: PENGENALAN SISTEM WEBSITE ISMY

## 1.1 Latar Belakang & Tujuan Web
Website resmi **Ikatan Sarjana Melayu Yogyakarta (ISMY)** dirancang sebagai pusat informasi, media publikasi pemikiran akademis, serta platform digital pengelolaan keanggotaan para cendekiawan, sarjana, profesional, dan mahasiswa pascasarjana rumpun Melayu di Daerah Istimewa Yogyakarta.

Website ini bertujuan untuk:
1. Menjadi gerbang informasi resmi kegiatan, riset, dan artikel kebudayaan ISMY.
2. Memfasilitasi pendaftaran anggota baru secara daring (*online*).
3. Menerbitkan Kartu Tanda Anggota (KTA) digital yang dilengkapi **QR Code verifikasi resmi** dan dapat diunduh dalam format PDF siap cetak.
4. Memberikan sarana pengelolaan konten (*Content Management System*) yang mudah, cepat, dan terpusat bagi jajaran pengurus admin.

## 1.2 Hak Akses & Peran Pengguna (*User Roles*)
Sistem website ISMY membagi hak akses ke dalam 3 kategori pengguna:

| Peran Pengguna | Deskripsi Hak Akses | Area Akses Utama |
| :--- | :--- | :--- |
| **Pengunjung Publik** | Tamu umum tanpa login. Dapat melihat berita, profil, AD/ART, bagan organisasi, melakukan pencarian, dan mengisi formulir pendaftaran anggota. | Halaman Depan Publik (`/`, `/berita`, `/tentang-kami`, `/keanggotaan`) |
| **Anggota Terdaftar** | Sarjana Melayu yang telah memiliki akun dan disetujui. Memiliki akses ke kartu anggota digital, unduh PDF KTA, dan riwayat kegiatan. | Portal Member (`/dashboard`, `/profile`) |
| **Administrator** | Pengurus yang berwenang memverifikasi data anggota, menerbitkan akun, mempublikasikan berita, agenda, dokumen, dan mengelola struktur organisasi. | Panel Admin Filament (`/admin`) |

## 1.3 Struktur URL & Akses Halaman
- Halaman Utama (Beranda): `http://127.0.0.1:8000/`
- Profil & Sejarah: `http://127.0.0.1:8000/tentang-kami`
- Struktur Organisasi: `http://127.0.0.1:8000/struktur-organisasi`
- Berita & Opini: `http://127.0.0.1:8000/berita`
- Pendaftaran Keanggotaan: `http://127.0.0.1:8000/keanggotaan`
- Pencarian Data: `http://127.0.0.1:8000/pencarian`
- Portal Login Anggota: `http://127.0.0.1:8000/login`
- Dashboard Anggota: `http://127.0.0.1:8000/dashboard`
- Panel Administrator: `http://127.0.0.1:8000/admin`

---

# BAB 2: PANDUAN PENGGUNA PUBLIK (TAMU & CALON ANGGOTA)

## 2.1 Menjelajahi Menu Beranda & Navigasi
1. Buka peramban (*web browser*) dan akses alamat website ISMY.
2. Di bagian atas layar terdapat navigasi utama (*Navbar Glassmorphism*):
   - **Logo ISMY**: Klik untuk kembali ke Beranda kapan saja.
   - **Menu Utama**: Tautan langsung ke *Beranda, Tentang Kami, Struktur Organisasi, Berita,* dan *Keanggotaan*.
   - **Ikon Kaca Pembesar**: Membuka kolom pencarian instan.
   - **Tombol Daftar Anggota**: Akses cepat menuju formulir pendaftaran.
   - **Tombol Masuk**: Masuk ke portal anggota terdaftar.
3. Halaman Beranda memuat:
   - **Banner Utama (Hero Section)**: Sambutan visi intelektual Melayu.
   - **Statistik Organisasi**: Jumlah anggota aktif, cabang daerah DIY, agenda tahunan, dan tahun berdiri (1998).
   - **Kabar ISMY Terbaru**: 3 cuplikan berita terbaru dengan thumbnail, tanggal terbit, dan kategori.
   - **Call-to-Action**: Tautan ajakan bergabung menjadi anggota.

## 2.2 Membaca Berita, Artikel & Kategori Publikasi
1. Klik menu **Berita** pada navbar atas.
2. Anda akan diarahkan ke Pusat Informasi (`/berita`).
3. **Memilih Kategori**: Klik salah satu tombol filter kategori di bagian atas (*Semua, Kegiatan, Pengumuman, Opini, Prestasi Anggota, Kebudayaan*).
4. **Membaca Artikel Lengkap**: Klik judul berita atau tombol *"Baca Selengkapnya"*.
5. Di halaman **Detail Berita** (`/berita/{slug}`), Anda dapat melihat:
   - Judul artikel, nama penulis, tanggal terbit, dan total pembaca (*view counter*).
   - Gambar utama artikel.
   - Isi lengkap artikel yang diformat rapi.
   - Rekomendasi 3 artikel berita terkait di bagian bawah.

## 2.3 Profil Organisasi, Visi Misi, Sejarah & Unduh AD/ART
1. Klik menu **Tentang Kami** (`/tentang-kami`).
2. Pelajari sejarah berdirinya ISMY serta *milestone* penting organisasi (1998: Gagasan Awal, 2005: Deklarasi Resmi, 2024: Transformasi Digital & Riset).
3. Simak rumusan **Visi & 4 Misi Utama** serta **4 Nilai Inti** (Integritas, Kolaborasi, Keilmuan, Kebudayaan).
4. **Unduh Berkas AD/ART**:
   - Gulir ke bagian *"Dokumen Legalitas & AD-ART"*.
   - Klik tombol **"Unduh Berkas"** untuk mendownload salinan resmi anggaran dasar dan anggaran rumah tangga organisasi.
5. **Pertanyaan Umum (FAQ)**:
   - Klik pada daftar pertanyaan yang tersedia untuk membuka jawaban penjelasan (*accordion toggle*).

## 2.4 Struktur Kepengurusan & Jaringan Cabang se-DIY
1. Klik menu **Struktur Organisasi** (`/struktur-organisasi`).
2. **Bagan Hierarki Organisasi**: Menampilkan alur kepemimpinan dari Majelis Syura/Dewan Pembina, Ketua Umum, Sekretaris Jenderal, Bendahara Umum, hingga Departemen Teknis.
3. **Pengurus Inti**: Melihat profil tokoh penggerak, nama lengkap, gelar akademis, dan foto resmi pengurus.
4. **Cabang Daerah DIY**: Melihat daftar koordinator cabang di wilayah Kota Yogyakarta, Sleman, Bantul, Kulon Progo, dan Gunungkidul.

## 2.5 Fitur Pencarian Global (*Smart Search Engine*)
1. Klik ikon pencarian pada navbar atau akses `/pencarian`.
2. Masukkan kata kunci pencarian (contoh: *"kebudayaan"*, *"simposium"*, *"UGM"*, *"Sleman"*, atau nama tokoh).
3. Tekan tombol **Cari** atau tekan tombol `Enter`.
4. Sistem akan menampilkan seluruh data terkait yang dikelompokkan secara otomatis ke dalam:
   - **Berita & Artikel**
   - **Kegiatan & Agenda**
   - **Dokumen Resmi**
   - **Direktori Anggota Publik** (hanya menampilkan data nama, keahlian, dan nomor anggota tanpa membuka privasi kontak).

## 2.6 Panduan Langkah Demi Langkah Mendaftar Anggota Baru
Bagi para sarjana, akademisi, dan mahasiswa serumpun Melayu di Yogyakarta, pendaftaran keanggotaan dilakukan dengan langkah berikut:

```
[Buka /keanggotaan] ➔ [Isi Formulir & Kontak] ➔ [Upload Foto & KTP] ➔ [Kirim] ➔ [Tinjauan Admin]
```

1. Buka menu **Keanggotaan** (`/keanggotaan`).
2. Baca syarat & ketentuan keanggotaan.
3. Gulir ke bagian **Formulir Pendaftaran** dan isi data berikut:
   - **Nama Lengkap (beserta gelar):** Contoh: `Dr. Fulan bin Fulan, M.A.`
   - **NIK:** 16 digit Nomor Induk Kependudukan.
   - **Tempat & Tanggal Lahir:** Kota kelahiran dan tanggal lahir.
   - **Alamat Domisili:** Alamat tempat tinggal saat ini di Yogyakarta.
   - **Pendidikan Terakhir:** Pilih jenjang (*S1, S2, S3, atau Profesi*).
   - **Bidang Keahlian / Rumpun Ilmu:** Contoh: `Linguistik Melayu, Sosiologi, Hukum Islam, Kedokteran`.
   - **Nomor Telepon / WhatsApp:** Nomor kontak aktif untuk verifikasi.
   - **Alamat Email:** Email aktif yang akan digunakan sebagai akun login Anda.
4. **Unggah Berkas Pendukung**:
   - **Pas Foto:** Format JPG/PNG (ukuran maks. 2MB, latar merah/biru disarankan).
   - **Kartu Identitas (KTP/Paspor):** Format JPG/PNG/PDF (maks. 2MB).
5. Klik tombol **"Kirim Pendaftaran"**.
6. Muncul notifikasi sukses: *"Pendaftaran Anda telah berhasil dikirim! Tim kami akan meninjau berkas Anda."*
7. Tunggu proses verifikasi oleh pengurus ISMY (biasanya 1x24 jam).

---

# BAB 3: PANDUAN PORTAL ANGGOTA (MEMBER DASHBOARD)

## 3.1 Masuk Akun (*Login Member*)
1. Klik tombol **Masuk** pada navigasi atas atau akses URL `/login`.
2. Masukkan **Email** dan **Password** yang telah didaftarkan.
3. Klik tombol **Log in**.
4. Anda akan langsung diarahkan ke Dashboard Anggota (`/dashboard`).

## 3.2 Fitur Dashboard & Kartu Tanda Anggota (KTA) Digital
Di dalam dashboard anggota, Anda akan melihat tampilan interaktif berupa:
1. **Kartu Anggota Digital**:
   - Desain bernuansa hijau zamrud dan emas dengan motif Melayu.
   - Menampilkan Logo ISMY, Nama Lengkap Anda, Bidang Keahlian, dan Nomor Anggota Resmi (`ISMY-0000X`).
   - Badge status: **AKTIF**.
   - **QR Code Interaktif**: QR Code khusus yang merepresentasikan nomor keanggotaan Anda untuk verifikasi lapangan saat menghadiri kegiatan resmi.
2. **Ringkasan Informasi Profil**:
   - Nomor Anggota, Status Verifikasi, Email Akun, dan Nomor Telepon.

## 3.3 Cara Mengunduh Kartu Anggota Resmi (Format PDF Cetak)
1. Di halaman Dashboard, perhatikan tombol di kanan atas banner: **"Unduh Kartu PDF"**.
2. Klik tombol tersebut.
3. Sistem secara otomatis memproses template PDF berukuran standar **A6 Landscape** dengan resolusi vektor yang jernih.
4. File PDF akan otomatis terunduh ke perangkat Anda dengan nama: `Kartu-Anggota-ISMY-xxxxx.pdf`.
5. Kartu PDF ini siap disimpan di ponsel cerdas atau dicetak pada kartu PVC fisik.

## 3.4 Memantau Riwayat Partisipasi Agenda & Kegiatan
Pada kolom sebelah kanan dashboard, terdapat panel **Riwayat Kegiatan Diikuti**. Di panel ini Anda dapat melihat:
- Judul kegiatan atau sarasehan ilmiah yang Anda ikuti.
- Tanggal pelaksanaan.
- Status kehadiran (*Terdaftar, Hadir, atau Batal*).

## 3.5 Mengelola Profil Akun & Keamanan Kata Sandi
1. Akses menu **Profil** melalui URL `/profile`.
2. Di halaman ini Anda dapat:
   - Memperbarui Nama dan Alamat Email.
   - Mengubah Kata Sandi (*Update Password*): Masukkan kata sandi lama dan tentukan kata sandi baru.
   - Menghapus akun jika diperlukan.

---

# BAB 4: PANDUAN ADMINISTRATOR (PANEL FILAMENT ADMIN)

## 4.1 Masuk ke Panel Administrator (`/admin`)
1. Buka browser dan akses alamat: `http://127.0.0.1:8000/admin`.
2. Masukkan kredensial administrator:
   - **Email:** `admin@ismy.or.id`
   - **Password:** `password`
3. Klik tombol **Sign In**.
4. Anda akan disambut oleh Dashboard Admin Filament dengan menu navigasi di bilah sisi kiri (*sidebar*).

## 4.2 Verifikasi Calon Anggota (Fitur 1-Klik *Approval*)
Ketika calon anggota mendaftar melalui web publik, data pendaftaran akan masuk ke antrean verifikasi.

**Langkah Memverifikasi & Menerbitkan Akun:**
1. Di sidebar kiri, buka menu **Keanggotaan > Pendaftaran Baru**.
2. Anda akan melihat tabel pendaftar dengan status *Pending, Disetujui,* atau *Ditolak*.
3. Klik baris pendaftar atau klik tombol **Edit** untuk memeriksa kelengkapan data dan berkas foto/KTP.
4. Untuk menyetujui pendaftaran, klik tombol hijau **"Setujui & Terbitkan Akun"**:
   - Sistem secara otomatis membuatkan akun `User` baru untuk pendaftar.
   - Sistem membuat record profil `Anggota` resmi dan menerbitkan **Nomor Anggota ISMY Unik**.
   - Status pendaftaran otomatis berubah menjadi `disetujui`.
   - Muncul notifikasi sukses di pojok kanan atas.

## 4.3 Manajemen Data Anggota Aktif & Direktori
1. Buka menu **Keanggotaan > Daftar Anggota**.
2. Anda dapat melihat seluruh anggota yang telah terdaftar resmi beserta nomor keanggotaan dan cabang wilayahnya.
3. Fitur yang tersedia:
   - **Tambah Anggota Manual:** Klik tombol *"New Anggota"* jika admin ingin mendaftarkan anggota secara langsung dari internal.
   - **Ubah Data:** Memperbarui gelar, cabang wilayah, foto, atau mengubah status (*Aktif, Nonaktif, Anggota Kehormatan*).
   - **Filter:** Menyaring anggota berdasarkan cabang wilayah (Sleman, Bantul, dll.) dan status keanggotaan.

## 4.4 Manajemen Berita & Artikel Ilmiah
1. Buka menu **Publikasi & Konten > Berita & Artikel**.
2. Klik tombol **"New Berita & Artikel"** untuk mempublikasikan artikel baru.
3. **Formulir Berita:**
   - **Judul Berita:** Ketik judul artikel. Kolom *Slug URL* akan terisi secara otomatis (*auto-slug*).
   - **Isi Konten:** Gunakan editor teks kaya (*Rich Editor*) untuk memformat paragraf, tebal, miring, daftar poin, kutipan, dan tautan.
   - **Kategori:** Pilih kategori berita dari dropdown (dapat membuat kategori baru langsung di tempat).
   - **Tanggal Terbit:** Tentukan tanggal rilis artikel.
   - **Penulis:** Nama penulis artikel (default: *Admin ISMY*).
   - **Gambar Utama:** Unggah poster atau foto dokumentasi berita.
4. Klik **Create** untuk menerbitkan berita ke halaman web publik.

## 4.5 Manajemen Kategori Berita & Tag
1. Buka menu **Publikasi & Konten > Kategori Berita**.
2. Di sini admin dapat menambah, mengubah, atau menghapus kategori berita (misal: *Opini, Riset Kebudayaan, Pengumuman, Agenda, Prestasi*).

## 4.6 Manajemen Agenda & Kegiatan Organisasi
1. Buka menu **Publikasi & Konten > Agenda & Kegiatan**.
2. Klik **"New Agenda & Kegiatan"**.
3. Lengkapi formulir: Nama Kegiatan, Tanggal, Jam Pelaksanaan (*TimePicker*), Lokasi Acara, Kuota Peserta, dan Unggah Poster.
4. Klik **Create**. Kegiatan yang aktif otomatis muncul pada halaman beranda dan direktori pencarian.

## 4.7 Manajemen Dokumen Legalitas (AD/ART, SK, LPJ)
1. Buka menu **Publikasi & Konten > Dokumen & Regulasi**.
2. Klik **"New Dokumen & Regulasi"**.
3. Masukkan Judul Dokumen, pilih Kategori (*AD/ART Organisasi, SK, Laporan LPJ, atau Dokumen Umum*), dan unggah file berkas (format PDF atau DOCX).
4. Dokumen kategori `ad_art` akan otomatis tersambung ke tombol unduh berkas di halaman *Tentang Kami*.

## 4.8 Manajemen Galeri Dokumentasi Foto & Video
1. Buka menu **Publikasi & Konten > Galeri Dokumentasi**.
2. Klik **"New Galeri Dokumentasi"**.
3. Masukkan Nama Album, Tanggal Kegiatan, dan Keterangan.
4. Pada bagian **Daftar Foto / Video**, klik tombol **"Add to media"** (*Repeater*) untuk mengunggah beberapa foto dokumentasi sekaligus beserta keterangan masing-masing foto.

## 4.9 Manajemen Struktur Pengurus & Master Jabatan
1. **Master Jabatan**: Buka menu **Kepengurusan & Wilayah > Jabatan Organisasi** untuk menambah jabatan (contoh: *Dewan Pembina, Ketua Umum, Sekretaris Jenderal, Bendahara Umum, Ketua Departemen*).
2. **Jajaran Pengurus**: Buka menu **Kepengurusan & Wilayah > Jajaran Pengurus**.
   - Tambahkan nama tokoh pengurus, pilih jabatan dari dropdown, tentukan periode (contoh: `2024-2026`), unggah pas foto avatar, dan tentukan **Nomor Urutan Tampilan** (angka 1 untuk ketua, 2 untuk sekjen, dst.).

## 4.10 Manajemen Wilayah Cabang DIY
1. Buka menu **Kepengurusan & Wilayah > Cabang & Wilayah**.
2. Kelola daftar cabang kabupaten/kota di DIY (Sleman, Bantul, Kota Yogyakarta, Kulon Progo, Gunungkidul) beserta kode wilayah dan alamat sekretariatnya.

## 4.11 Manajemen Mitra & Kerjasama
1. Buka menu **Kemitraan > Mitra & Kerjasama**.
2. Tambahkan nama instansi mitra (contoh: *UGM, UNY, Pemda DIY, Keraton Yogyakarta*), unggah logo kemitraan, dan tulis deskripsi bentuk kerjasama.

## 4.12 Pengelolaan Tanya Jawab (FAQ) & Kotak Pesan Masuk
1. **Tanya Jawab (FAQ):** Buka menu **Publikasi & Konten > Tanya Jawab (FAQ)** untuk menambah atau memperbarui pertanyaan dan jawaban yang tampil di halaman *Tentang Kami*.
2. **Kotak Pesan:** Buka menu **Komunikasi > Kotak Pesan** untuk membaca pesan yang dikirimkan pengunjung melalui formulir kontak web. Admin dapat menandai status pesan sudah dibaca (*read/unread toggle*).

---

# BAB 5: PENJELASAN KONSEP & FILOSOFI DESAIN UI/UX

## 5.1 Konsep Visual *"Malay Heritage meets Modern Academic"*
Desain antarmuka (*User Interface*) dan alur pengalaman pengguna (*User Experience*) web ISMY mengusung identitas kebudayaan Melayu yang adiluhung, dipadukan dengan standar desain portal akademis perguruan tinggi terkemuka dunia.

Prinsip utama desain ini meliputi:
1. **Keanggunan Visual (*Elegance*):** Menghadirkan kesan organisasi terhormat, terpercaya, dan berbobot ilmiah.
2. **Kemudahan Keterbacaan (*High Readability*):** Pemilihan kontras warna dan jarak antar elemen yang nyaman bagi mata.
3. **Keringanan & Responsif (*Speed & Mobile Optimization*):** Animasi halus tanpa membebani performa browser.

## 5.2 Standar Palet Warna & Nilai Filosofis

```
[#0F4C3A Emerald Green] ── Dominasi Marwah & Nilai Keislaman
[#C9A227 Royal Gold]    ── Aksen Kejayaan Ilmu & Kebudayaan Melayu
[#FBF7EE Warm Cream]    ── Latar Belakang Hangat & Ramah Mata
[#121C2A Deep Navy]     ── Tipografi Kontras Tinggi & Tegas
```

- **Emerald Green / Hijau Melayu (`#0F4C3A` & `#003426`):** Warna primer lambang identitas persaudaraan Melayu, religiusitas yang sejuk, dan keteduhan budi pekerti.
- **Royal Gold / Kuning Diraja (`#C9A227` & `#D4AF37`):** Warna sekunder lambang keagungan adat Melayu, kemuliaan ilmu pengetahuan, dan optimisme masa depan.
- **Warm Cream (`#FBF7EE`):** Warna dasar latar menggantikan putih murni (*pure white*) guna mencegah kelelahan mata (*eye fatigue*) saat pembaca menyimak artikel panjang.
- **Deep Navy & Charcoal (`#121C2A`):** Warna teks utama yang menjamin skor kontras teks memenuhi standar aksesibilitas internasional (WCAG AAA).

## 5.3 Tipografi & Hierarki Font
Sistem tipografi menggunakan kombinasi harmonis dua font Google Fonts:
1. **Font Judul / Heading — *Playfair Display* (Serif):**
   - Memberikan nuansa klasik, anggun, berwibawa, dan bernuansa karya ilmiah perguruan tinggi.
2. **Font Isi Teks / Body — *Plus Jakarta Sans* (Sans-Serif):**
   - Sangat bersih, modern, dengan keterbacaan (*legibility*) yang luar biasa tajam di layar ponsel pintar (*smartphone*).

## 5.4 Fitur Pengalaman Pengguna (*User Experience Highlights*)
- **Glassmorphism Header:** Navigasi atas semi-transparan dengan efek kabur (*blur*) yang tetap menempel di atas saat layar digulir.
- **Micro-Interactions & Hover Elevate:** Kartu berita dan tombol aksi memberikan respon gerak halus saat kursor melintas (*hover scale & shadow*).
- **Alpine.js Dynamic Accordion:** FAQ dan menu navigasi mobile terbuka dan tertutup dengan transisi yang sangat mulus tanpa me-refresh halaman.
- **Pencarian Terpadu:** Pengguna tidak perlu membuka menu terpisah untuk mencari berita atau dokumen; satu kotak pencarian merangkum seluruh jenis data.

## 5.5 Teknologi Grafis Vektor (SVG) & Keamanan Cetak
Kartu anggota digital di dashboard dan file PDF menggunakan teknologi **vektor SVG murni**. Hal ini memberikan keuntungan:
1. QR Code dan logo ISMY tidak pecah (*pixelated*) meski dicetak dalam resolusi tinggi atau diperbesar.
2. Proses pembuatan PDF kartu anggota berlangsung sangat cepat (kurang dari 0.5 detik) tanpa ketergantungan pada ekstensi server pihak ketiga.

---

# LAMPIRAN & INFORMASI TEKNIS

### Kredensial Akses Default Sistem:
* **URL Web Publik:** `http://127.0.0.1:8000/`
* **URL Panel Admin:** `http://127.0.0.1:8000/admin`
* **Akun Administrator Default:**
  * **Email:** `admin@ismy.or.id`
  * **Password:** `password`

### Perintah Pemeliharaan Server (Terminal):
* **Menjalankan Server Web:** `php artisan serve`
* **Menjalankan Kompilasi Asset CSS/JS:** `npm run build`
* **Menjalankan Database Seeder Ulang:** `php artisan db:seed`
* **Memastikan Symlink Storage Aktif:** `php artisan storage:link`
* **Menjalankan Pengujian Otomatis:** `php artisan test`

---
*Dokumen ini disusun sebagai panduan resmi operasional website Ikatan Sarjana Melayu Yogyakarta (ISMY).*
