<?php

namespace Database\Seeders;

use App\Models\DescProgramBelajar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DescProgramBelajarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
            DescProgramBelajar::create([
                's1' => "<h3>✨ <strong>Kuliah S1 Safwa Ulum Nafi'ah Islamiyah</strong>✨</h3><p><br>💠 <strong>KEUNGGULAN </strong>💠<br><strong>1. Belajar dan Praktek Langsung bersama Native Speaker</strong><br>🧔 Ustadz Abdurrahman Muhammad Mazaariq Al-Yamany&nbsp;<br>🧔 Ustadz Ali Abdullah Mohsin Saria Al-Yamany&nbsp;<br>🧕 Ustadzah Basma Al-Hassan Al-Rifai&nbsp;<br>🧕 Ustadzah Munirah Asy-Syabibiy&nbsp;<br>&nbsp;<br><strong>2. Belajar Bahasa Arab Dari Dasar Secara Intensif Selama 3 Bulan</strong><br><br><strong>3. Sertifikat dan Gelar Non Akademik:</strong> Certified in Arabic Language Associate (C.ALA), bagi peserta yg memenuhi persyaratan<br><br>🔰 <strong>FASILITAS EKSLUSIF</strong> 🔰<br>1. Learning Kit: Kamus Saku 1000 Kosa kata, Buku Mutaba'ah, Alat Tulis, dan Buku Catatan.&nbsp;<br>2.&nbsp; PDF Modul Pembelajaran<br>3.&nbsp; Pembelajaran Interaktif via Zoom Meeting 4x pertemuan per pekan<br>Hari: Kamis-Ahad&nbsp;<br>Pukul: 20.00-21.30 WIB (Durasi 90 menit per pertemuan)&nbsp;<br>&nbsp;<br>4. Bimbingan menghafal 1000 mufrodat<br>5. Rekaman Kelas Zoom akses lifetime<br>6. Grup Whatsapp untuk tugas, diskusi dan konsultasi<br>&nbsp;<br><strong>Segera Daftar!</strong><br>&nbsp;<br>🖥 <strong>Kuota Peserta 30 Ikhwan dan 30 Akhwat</strong><br>1 kelas terdiri dari 15 peserta&nbsp;<br>&nbsp;<br>👥 <strong>Syarat Peserta:</strong><br>- Mampu membaca Al-Quran / Huruf Hijaiyah&nbsp;<br>- Usia 17-50 tahun&nbsp;<br>&nbsp;<br>📤 Bantu share info ini ke saudara dan teman-teman lainnya.</p>",
                
                'kursus' => "<h3>✨ <strong>Madrasah Bahasa Arab SUNI (MABANI) - Level Mubtadi' (Pemula) </strong>✨</h3><p><br>💠 <strong>KEUNGGULAN </strong>💠<br><strong>1. Belajar dan Praktek Langsung bersama Native Speaker</strong><br>🧔 Ustadz Abdurrahman Muhammad Mazaariq Al-Yamany&nbsp;<br>🧔 Ustadz Ali Abdullah Mohsin Saria Al-Yamany&nbsp;<br>🧕 Ustadzah Basma Al-Hassan Al-Rifai&nbsp;<br>🧕 Ustadzah Munirah Asy-Syabibiy&nbsp;<br>&nbsp;<br><strong>2. Belajar Bahasa Arab Dari Dasar Secara Intensif Selama 3 Bulan</strong><br><br><strong>3. Sertifikat dan Gelar Non Akademik:</strong> Certified in Arabic Language Associate (C.ALA), bagi peserta yg memenuhi persyaratan<br><br>🔰 <strong>FASILITAS EKSLUSIF</strong> 🔰<br>1. Learning Kit: Kamus Saku 1000 Kosa kata, Buku Mutaba'ah, Alat Tulis, dan Buku Catatan.&nbsp;<br>2.&nbsp; PDF Modul Pembelajaran<br>3.&nbsp; Pembelajaran Interaktif via Zoom Meeting 4x pertemuan per pekan<br>Hari: Kamis-Ahad&nbsp;<br>Pukul: 20.00-21.30 WIB (Durasi 90 menit per pertemuan)&nbsp;<br>&nbsp;<br>4. Bimbingan menghafal 1000 mufrodat<br>5. Rekaman Kelas Zoom akses lifetime<br>6. Grup Whatsapp untuk tugas, diskusi dan konsultasi<br>&nbsp;<br><strong>Segera Daftar!</strong><br>&nbsp;<br>🖥 <strong>Kuota Peserta 30 Ikhwan dan 30 Akhwat</strong><br>1 kelas terdiri dari 15 peserta&nbsp;<br>&nbsp;<br>👥 <strong>Syarat Peserta:</strong><br>- Mampu membaca Al-Quran / Huruf Hijaiyah&nbsp;<br>- Usia 17-50 tahun&nbsp;<br>&nbsp;<br>📤 Bantu share info ini ke saudara dan teman-teman lainnya.</p>",
            ]);
        */

        $data = [
            [
                'course_id' => NULL,
                'title'     => 'Kuliah S1',
                'keyword'   => 'KULIAHS1',
                'desc'      => "<h3>✨ <strong>Kuliah S1 Safwa Ulum Nafi'ah Islamiyah</strong>✨</h3><p><br>💠 <strong>KEUNGGULAN </strong>💠<br><strong>1. Belajar dan Praktek Langsung bersama Native Speaker</strong><br>🧔 Ustadz Abdurrahman Muhammad Mazaariq Al-Yamany&nbsp;<br>🧔 Ustadz Ali Abdullah Mohsin Saria Al-Yamany&nbsp;<br>🧕 Ustadzah Basma Al-Hassan Al-Rifai&nbsp;<br>🧕 Ustadzah Munirah Asy-Syabibiy&nbsp;<br>&nbsp;<br><strong>2. Belajar Bahasa Arab Dari Dasar Secara Intensif Selama 3 Bulan</strong><br><br><strong>3. Sertifikat dan Gelar Non Akademik:</strong> Certified in Arabic Language Associate (C.ALA), bagi peserta yg memenuhi persyaratan<br><br>🔰 <strong>FASILITAS EKSLUSIF</strong> 🔰<br>1. Learning Kit: Kamus Saku 1000 Kosa kata, Buku Mutaba'ah, Alat Tulis, dan Buku Catatan.&nbsp;<br>2.&nbsp; PDF Modul Pembelajaran<br>3.&nbsp; Pembelajaran Interaktif via Zoom Meeting 4x pertemuan per pekan<br>Hari: Kamis-Ahad&nbsp;<br>Pukul: 20.00-21.30 WIB (Durasi 90 menit per pertemuan)&nbsp;<br>&nbsp;<br>4. Bimbingan menghafal 1000 mufrodat<br>5. Rekaman Kelas Zoom akses lifetime<br>6. Grup Whatsapp untuk tugas, diskusi dan konsultasi<br>&nbsp;<br><strong>Segera Daftar!</strong><br>&nbsp;<br>🖥 <strong>Kuota Peserta 30 Ikhwan dan 30 Akhwat</strong><br>1 kelas terdiri dari 15 peserta&nbsp;<br>&nbsp;<br>👥 <strong>Syarat Peserta:</strong><br>- Mampu membaca Al-Quran / Huruf Hijaiyah&nbsp;<br>- Usia 17-50 tahun&nbsp;<br>&nbsp;<br>📤 Bantu share info ini ke saudara dan teman-teman lainnya.</p>",
            ],
            [
                'course_id' => 1,
                'title'     => 'MABANI',
                'keyword'   => 'MABANI',
                'desc'      => "<h3>✨ <strong>Madrasah Bahasa Arab SUNI (MABANI) - Level Mubtadi' (Pemula) </strong>✨</h3><p><br>💠 <strong>KEUNGGULAN </strong>💠<br><strong>1. Belajar dan Praktek Langsung bersama Native Speaker</strong><br>🧔 Ustadz Abdurrahman Muhammad Mazaariq Al-Yamany&nbsp;<br>🧔 Ustadz Ali Abdullah Mohsin Saria Al-Yamany&nbsp;<br>🧕 Ustadzah Basma Al-Hassan Al-Rifai&nbsp;<br>🧕 Ustadzah Munirah Asy-Syabibiy&nbsp;<br>&nbsp;<br><strong>2. Belajar Bahasa Arab Dari Dasar Secara Intensif Selama 3 Bulan</strong><br><br><strong>3. Sertifikat dan Gelar Non Akademik:</strong> Certified in Arabic Language Associate (C.ALA), bagi peserta yg memenuhi persyaratan<br><br>🔰 <strong>FASILITAS EKSLUSIF</strong> 🔰<br>1. Learning Kit: Kamus Saku 1000 Kosa kata, Buku Mutaba'ah, Alat Tulis, dan Buku Catatan.&nbsp;<br>2.&nbsp; PDF Modul Pembelajaran<br>3.&nbsp; Pembelajaran Interaktif via Zoom Meeting 4x pertemuan per pekan<br>Hari: Kamis-Ahad&nbsp;<br>Pukul: 20.00-21.30 WIB (Durasi 90 menit per pertemuan)&nbsp;<br>&nbsp;<br>4. Bimbingan menghafal 1000 mufrodat<br>5. Rekaman Kelas Zoom akses lifetime<br>6. Grup Whatsapp untuk tugas, diskusi dan konsultasi<br>&nbsp;<br><strong>Segera Daftar!</strong><br>&nbsp;<br>🖥 <strong>Kuota Peserta 30 Ikhwan dan 30 Akhwat</strong><br>1 kelas terdiri dari 15 peserta&nbsp;<br>&nbsp;<br>👥 <strong>Syarat Peserta:</strong><br>- Mampu membaca Al-Quran / Huruf Hijaiyah&nbsp;<br>- Usia 17-50 tahun&nbsp;<br>&nbsp;<br>📤 Bantu share info ini ke saudara dan teman-teman lainnya.</p>",
            ],
            [
                'course_id' => 2,
                'title'     => 'Dirasah Islamiyah',
                'keyword'   => 'DIRASAHISLAMIYAH',
                'desc'      => "<h3>✨ <strong>Dirasah Islamiyah</strong>✨</h3><p><br>💠 <strong>KEUNGGULAN </strong>💠<br><strong>1. Belajar dan Praktek Langsung bersama Native Speaker</strong><br>🧔 Ustadz Abdurrahman Muhammad Mazaariq Al-Yamany&nbsp;<br>🧔 Ustadz Ali Abdullah Mohsin Saria Al-Yamany&nbsp;<br>🧕 Ustadzah Basma Al-Hassan Al-Rifai&nbsp;<br>🧕 Ustadzah Munirah Asy-Syabibiy&nbsp;<br>&nbsp;<br><strong>2. Belajar Bahasa Arab Dari Dasar Secara Intensif Selama 3 Bulan</strong><br><br><strong>3. Sertifikat dan Gelar Non Akademik:</strong> Certified in Arabic Language Associate (C.ALA), bagi peserta yg memenuhi persyaratan<br><br>🔰 <strong>FASILITAS EKSLUSIF</strong> 🔰<br>1. Learning Kit: Kamus Saku 1000 Kosa kata, Buku Mutaba'ah, Alat Tulis, dan Buku Catatan.&nbsp;<br>2.&nbsp; PDF Modul Pembelajaran<br>3.&nbsp; Pembelajaran Interaktif via Zoom Meeting 4x pertemuan per pekan<br>Hari: Kamis-Ahad&nbsp;<br>Pukul: 20.00-21.30 WIB (Durasi 90 menit per pertemuan)&nbsp;<br>&nbsp;<br>4. Bimbingan menghafal 1000 mufrodat<br>5. Rekaman Kelas Zoom akses lifetime<br>6. Grup Whatsapp untuk tugas, diskusi dan konsultasi<br>&nbsp;<br><strong>Segera Daftar!</strong><br>&nbsp;<br>🖥 <strong>Kuota Peserta 30 Ikhwan dan 30 Akhwat</strong><br>1 kelas terdiri dari 15 peserta&nbsp;<br>&nbsp;<br>👥 <strong>Syarat Peserta:</strong><br>- Mampu membaca Al-Quran / Huruf Hijaiyah&nbsp;<br>- Usia 17-50 tahun&nbsp;<br>&nbsp;<br>📤 Bantu share info ini ke saudara dan teman-teman lainnya.</p>",
            ]
        ];

        foreach ($data as $key => $item) {
            DescProgramBelajar::create($item);
        }
    }
}
