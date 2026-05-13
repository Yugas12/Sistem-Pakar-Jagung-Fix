<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class PenyakitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run()
    {
        DB::table('penyakit')->insert([
            [
                'id' => 1,
                'kode' => 'P1',
                'nama' => 'Bulai',
                'deskripsi' => 'Penyakit akibat jamur menyebabkan daun menguning.',
                'solusi' => 'Cabut dan musnahkan tanaman yang sudah parah (kerdil dan daun selurunya belang puih) dengan cara dibakar atau dikubur jauh dari lahan. Segera semprot fungisida sistemik seperti Metalaksil atau Propamokarb hidroklorida pada tanaman yang menunjukkan gejala awal dan tanaman sehat di sekitarnya, penyemprotan diarahkan ke titik tumbuh. Optimalkan pemupukan, khususnya fosfor dan kalium, untuk memperkuat tanaman yang belum terserang parah.'
            ],
            [
                'id' => 2,
                'kode' => 'P2',
                'nama' => 'Bercak Daun',
                'deskripsi' => 'Daun muncul bercak coklat.',
                'solusi' => 'Potong dan buang daun-daun yang sudah terinfeksi untuk mengurangi sumber inokulum. Semprot fungisida kontak dan sistemik seperti campuran Mancozeb dan Difenokonazol atau Klorotalonil dan Azoksistrobin. Ulangi setiap 7-10 hari dengan dosis tepat, terutama jika cuaca lembab. Hentikan penyiraman atas jika memungkinkan, gunakan irigasi tetes atau leb. '
            ],
            [
                'id' => 3,
                'kode' => 'P3',
                'nama' => 'Busuk Pelepah',
                'deskripsi' => 'Pelepah membusuk.',
                'solusi' => 'Kurangi kelembaban mendesak seperti perbaiki drainase, buat parit kecil, dan kurangi frekuensi penyiraman. Semprot fungisida langsung pada bagian pelepah yang terserang menggunakan Propikonazol, Tiadinil, atau Validamisin, tambahkan perekat agar obat menempel di pelepah. Bersihkan gulma dan sisa tanaman di sekitar pertanaman untuk meningkatkan sirkulasi udara.'
            ],
            [
                'id' => 4,
                'kode' => 'P4',
                'nama' => 'Busuk Batang',
                'deskripsi' => 'Batang lunak dan busuk.',
                'solusi' => 'Segera panen lebih awal jika penyakit muncul mendekati masa panen dan batang mulai lemah atau layu untuk menghindari tanaman roboh. Untuk tanaman masih tahap vegetatif, berikan penyangga pada batang yang mulai terinfeksi agar tidak mudah patah. Semprot atau siram fungisida seperti Simoksanil atau Fosetyl-Al di sekitar pangkal batang, efektivitas terbatas jika infeksi sudah dalam. Hindari stres air (kekeringan atau genangan) karena akan memperparah busuk batang.'
            ],
            [
                'id' => 5,
                'kode' => 'P5',
                'nama' => 'Hawar Daun',
                'deskripsi' => 'Daun kering dan mati.',
                'solusi' => 'Jika Bakteri (Hawar Daun Bakteri) Semprot  bakterisida berbahan tembaga (misalnya Cuprous oxide) atau agensi hayati Bacillus subtilis. Pemotongan daun sakit bisa membantu, namun alat potong harus didesinfeksi (misal dengan alkohol) setiap selesai memotong tanaman yang sakit. Jika Jamur (seperti Helminthosporium) Gunakan fungisida seperti Azoksistrobin, Tebuconazole, atau Trifloxystrobin. Hindari melukai tanaman (misal saat penyiangan) karena luka adalah pintu masuk bakteri.'
            ],
        ]);
    }
}
