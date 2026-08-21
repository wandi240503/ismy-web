<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Wilayah;
use App\Models\Jabatan;
use App\Models\Pengurus;
use App\Models\KategoriBerita;
use App\Models\Berita;
use App\Models\Faq;
use App\Models\Dokumen;
use App\Models\Kegiatan;
use App\Models\Anggota;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Admin User
        $admin = User::firstOrCreate(
            ['email' => 'admin@ismy.or.id'],
            [
                'name' => 'Administrator ISMY',
                'password' => Hash::make('password'),
            ]
        );

        // 2. Wilayah / Cabang DIY
        $wilayahData = [
            ['nama' => 'Kota Yogyakarta', 'kode' => 'DIY-YK', 'deskripsi' => 'Pengurus Cabang Wilayah Kota Yogyakarta (Kotagede & sekitarnya).'],
            ['nama' => 'Sleman', 'kode' => 'DIY-SLM', 'deskripsi' => 'Pengurus Cabang Wilayah Kabupaten Sleman (Kawasan Kampus).'],
            ['nama' => 'Bantul', 'kode' => 'DIY-BTL', 'deskripsi' => 'Pengurus Cabang Wilayah Kabupaten Bantul.'],
            ['nama' => 'Kulon Progo', 'kode' => 'DIY-KP', 'deskripsi' => 'Pengurus Cabang Wilayah Kabupaten Kulon Progo.'],
            ['nama' => 'Gunungkidul', 'kode' => 'DIY-GK', 'deskripsi' => 'Pengurus Cabang Wilayah Kabupaten Gunungkidul.'],
        ];

        foreach ($wilayahData as $w) {
            Wilayah::firstOrCreate(['nama' => $w['nama']], $w);
        }

        $sleman = Wilayah::where('kode', 'DIY-SLM')->first();

        // 3. Jabatan Organisasi
        $jabatanData = [
            ['nama' => 'Dewan Pembina', 'level' => 'dewan_pembina'],
            ['nama' => 'Ketua Umum', 'level' => 'ketua'],
            ['nama' => 'Wakil Ketua Umum', 'level' => 'ketua'],
            ['nama' => 'Sekretaris Jenderal', 'level' => 'sekretaris'],
            ['nama' => 'Bendahara Umum', 'level' => 'bendahara'],
            ['nama' => 'Ketua Dept. Pendidikan & Riset', 'level' => 'departemen'],
            ['nama' => 'Ketua Dept. Sosial Budaya', 'level' => 'departemen'],
            ['nama' => 'Ketua Dept. Pengembangan Ekonomi', 'level' => 'departemen'],
            ['nama' => 'Ketua Humas & Publikasi', 'level' => 'departemen'],
        ];

        foreach ($jabatanData as $j) {
            Jabatan::firstOrCreate(['nama' => $j['nama']], $j);
        }

        // 4. Pengurus Inti
        $ketuaUmum = Jabatan::where('nama', 'Ketua Umum')->first();
        $sekjen = Jabatan::where('nama', 'Sekretaris Jenderal')->first();
        $bendum = Jabatan::where('nama', 'Bendahara Umum')->first();
        $deptPendidikan = Jabatan::where('nama', 'Ketua Dept. Pendidikan & Riset')->first();

        if ($ketuaUmum && Pengurus::count() === 0) {
            Pengurus::create([
                'nama' => 'Prof. Dr. Ahmad Zulkifli',
                'jabatan_id' => $ketuaUmum->id,
                'periode' => '2024-2026',
                'urutan' => 1,
            ]);

            if ($sekjen) {
                Pengurus::create([
                    'nama' => 'Dr. Siti Aminah, M.Si',
                    'jabatan_id' => $sekjen->id,
                    'periode' => '2024-2026',
                    'urutan' => 2,
                ]);
            }

            if ($bendum) {
                Pengurus::create([
                    'nama' => 'Hj. Rina Melati, SE',
                    'jabatan_id' => $bendum->id,
                    'periode' => '2024-2026',
                    'urutan' => 3,
                ]);
            }

            if ($deptPendidikan) {
                Pengurus::create([
                    'nama' => 'Dr. Budi Santoso',
                    'jabatan_id' => $deptPendidikan->id,
                    'periode' => '2024-2026',
                    'urutan' => 4,
                ]);
            }
        }

        // 5. Kategori Berita
        $kategoriData = [
            ['nama' => 'Kegiatan', 'slug' => 'kegiatan'],
            ['nama' => 'Pengumuman', 'slug' => 'pengumuman'],
            ['nama' => 'Opini', 'slug' => 'opini'],
            ['nama' => 'Prestasi Anggota', 'slug' => 'prestasi'],
            ['nama' => 'Kebudayaan', 'slug' => 'kebudayaan'],
        ];

        foreach ($kategoriData as $k) {
            KategoriBerita::firstOrCreate(['slug' => $k['slug']], $k);
        }

        $katKebudayaan = KategoriBerita::where('slug', 'kebudayaan')->first();
        $katOpini = KategoriBerita::where('slug', 'opini')->first();
        $katPengumuman = KategoriBerita::where('slug', 'pengumuman')->first();
        $katPrestasi = KategoriBerita::where('slug', 'prestasi')->first();

        // 6. Berita Inisial
        if ($katKebudayaan && Berita::count() === 0) {
            Berita::create([
                'judul' => 'Simposium Nasional Kebudayaan Melayu di Era Digital',
                'slug' => 'simposium-nasional-kebudayaan-melayu-di-era-digital',
                'konten' => 'ISMY sukses menyelenggarakan simposium tahunan yang mengumpulkan ratusan cendekiawan Melayu di Daerah Istimewa Yogyakarta. Acara ini membahas transformasi digital dan bagaimana sarjana Melayu beradaptasi tanpa melupakan akar budaya luhur.',
                'kategori_berita_id' => $katKebudayaan->id,
                'penulis' => 'Dr. Ahmad Zulkifli',
                'tanggal_terbit' => now()->subDays(5),
                'view_count' => 128,
            ]);

            if ($katOpini) {
                Berita::create([
                    'judul' => 'Relevansi Sastra Klasik dalam Kurikulum Perguruan Tinggi',
                    'slug' => 'relevansi-sastra-klasik-dalam-kurikulum-perguruan-tinggi',
                    'konten' => 'Mengkaji ulang pentingnya karya sastra lampau sebagai fondasi pemikiran kritis sarjana muda di tengah perkembangan pesat peradaban akademis modern.',
                    'kategori_berita_id' => $katOpini->id,
                    'penulis' => 'Dr. Siti Aminah, M.Si',
                    'tanggal_terbit' => now()->subDays(10),
                    'view_count' => 89,
                ]);
            }

            if ($katPengumuman) {
                Berita::create([
                    'judul' => 'Pembukaan Pendaftaran Beasiswa Riset Budaya Melayu 2024',
                    'slug' => 'pembukaan-pendaftaran-beasiswa-riset-budaya-melayu-2024',
                    'konten' => 'ISMY kembali membuka program beasiswa penelitian kebudayaan untuk mahasiswa jenjang Magister (S2) dan Doktoral (S3) yang sedang menempuh studi di perguruan tinggi Yogyakarta.',
                    'kategori_berita_id' => $katPengumuman->id,
                    'penulis' => 'Sekretariat ISMY',
                    'tanggal_terbit' => now()->subDays(14),
                    'view_count' => 312,
                ]);
            }

            if ($katPrestasi) {
                Berita::create([
                    'judul' => 'Penghargaan Internasional untuk Publikasi Jurnal Anggota ISMY',
                    'slug' => 'penghargaan-internasional-untuk-publikasi-jurnal-anggota-ismy',
                    'konten' => 'Tiga anggota ISMY berhasil meraih penghargaan Best Paper dalam Konferensi Kebudayaan Asia yang diselenggarakan di Kuala Lumpur.',
                    'kategori_berita_id' => $katPrestasi->id,
                    'penulis' => 'Humas ISMY',
                    'tanggal_terbit' => now()->subDays(20),
                    'view_count' => 195,
                ]);
            }
        }

        // 7. Agenda Kegiatan
        if (Kegiatan::count() === 0) {
            Kegiatan::create([
                'judul' => 'Sarasehan Budaya & Temu Ilmiah Sarjana Melayu',
                'slug' => 'sarasehan-budaya-dan-temu-ilmiah-sarjana-melayu',
                'deskripsi' => 'Pertemuan silaturahmi akbar sarjana dan akademisi Melayu se-Yogyakarta dalam rangka menyongsong tahun akademik baru.',
                'tanggal' => now()->addDays(15),
                'waktu' => '09:00:00',
                'lokasi' => 'Auditorium Mandiri UGM, Yogyakarta',
                'kuota' => 150,
            ]);

            Kegiatan::create([
                'judul' => 'Workshop Penulisan Jurnal Bereputasi Internasional',
                'slug' => 'workshop-penulisan-jurnal-bereputasi-internasional',
                'deskripsi' => 'Pelatihan intensif metodologi penelitian kebudayaan dan penulisan artikel ilmiah bereputasi Scopus bersama reviewer nasional.',
                'tanggal' => now()->addDays(30),
                'waktu' => '08:30:00',
                'lokasi' => 'Gedung Pascasarjana UNY, Yogyakarta',
                'kuota' => 50,
            ]);
        }

        // 8. FAQ
        if (Faq::count() === 0) {
            Faq::create([
                'pertanyaan' => 'Siapa saja yang dapat bergabung menjadi anggota ISMY?',
                'jawaban' => 'Seluruh sarjana (S1/S2/S3), cendekiawan, profesional, dan mahasiswa pascasarjana rumpun Melayu yang bertempat tinggal, studi, atau berkarya di Daerah Istimewa Yogyakarta.',
                'urutan' => 1,
            ]);

            Faq::create([
                'pertanyaan' => 'Bagaimana proses verifikasi dan penerbitan nomor anggota?',
                'jawaban' => 'Setelah mengisi formulir pendaftaran di menu Keanggotaan, berkas Anda akan ditinjau oleh Tim Verifikasi dalam 1-2 hari kerja. Setelah disetujui, akun digital dan Kartu Anggota resmi dengan QR Code akan langsung diterbitkan.',
                'urutan' => 2,
            ]);

            Faq::create([
                'pertanyaan' => 'Apakah ada iuran keanggotaan berkala?',
                'jawaban' => 'Keanggotaan dasar tidak dipungut biaya bulanan. Dukungan dana kegiatan dihimpun melalui donasi sukarela, kemitraan sponsor riset, dan program kolaborasi kebudayaan.',
                'urutan' => 3,
            ]);
        }

        // 9. Dokumen Legalitas (AD/ART)
        if (Dokumen::count() === 0) {
            Dokumen::create([
                'judul' => 'Anggaran Dasar & Anggaran Rumah Tangga (AD/ART) ISMY',
                'deskripsi' => 'Dokumen resmi pedoman pokok tata kelola dan aturan dasar organisasi Ikatan Sarjana Melayu Yogyakarta.',
                'file_path' => 'dokumens/ad-art-ismy.pdf',
                'kategori' => 'ad_art',
            ]);
        }

        // 10. Sample Anggota untuk Admin
        if ($admin && !Anggota::where('user_id', $admin->id)->exists()) {
            Anggota::create([
                'user_id' => $admin->id,
                'wilayah_id' => $sleman?->id,
                'nomor_anggota' => 'ISMY-00001',
                'nama_lengkap' => $admin->name,
                'nik' => '3404010101900001',
                'tempat_lahir' => 'Yogyakarta',
                'tanggal_lahir' => '1990-01-01',
                'alamat' => 'Jl. Kaliurang Km 5, Sleman, D.I. Yogyakarta',
                'telepon' => '081234567890',
                'pendidikan_terakhir' => 'S2',
                'bidang_keahlian' => 'Sosiologi & Budaya Melayu',
                'status_keanggotaan' => 'aktif',
            ]);
        }

        // 11. Akun Anggota Wandi Muhammad (ISMY-00003)
        $wandiUser = User::firstOrCreate(
            ['email' => 'wandimuhammad@gmail.com'],
            [
                'name' => 'Wandi Muhammad',
                'password' => Hash::make('password123'),
            ]
        );

        if ($wandiUser && !Anggota::where('user_id', $wandiUser->id)->exists()) {
            Anggota::create([
                'user_id' => $wandiUser->id,
                'wilayah_id' => $sleman?->id,
                'nomor_anggota' => 'ISMY-00003',
                'nama_lengkap' => 'Wandi Muhammad',
                'nik' => '3404010101990003',
                'tempat_lahir' => 'Yogyakarta',
                'tanggal_lahir' => '1999-05-24',
                'alamat' => 'Sleman, D.I. Yogyakarta',
                'telepon' => '081234567899',
                'pendidikan_terakhir' => 'S1',
                'bidang_keahlian' => 'Teknologi Informasi & Budaya Digital',
                'status_keanggotaan' => 'aktif',
            ]);
        }
    }
}
