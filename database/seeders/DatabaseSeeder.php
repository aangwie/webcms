<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\About;
use App\Models\Service;
use App\Models\Portfolio;
use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Keep the main admin user, but use firstOrCreate so it doesn't fail if already exists.
        User::firstOrCreate(
            ['email' => 'admin@webcms.com'],
            [
                'name' => 'Administrator',
                'password' => bcrypt('password'),
            ]
        );

        // --- ABOUT SEEDER ---
        About::truncate();
        About::create([
            'content' => 'Billnesia adalah mitra teknologi inovatif yang berfokus pada pengembangan aplikasi web profesional dan solusi manajemen jaringan terintegrasi. Didirikan dengan dedikasi untuk mendukung ekosistem bisnis dan pendidikan di era digital, Billnesia menyediakan layanan menyeluruh mulai dari pembuatan company profile, sistem informasi akademik, toko online, hingga setup dan manajemen bandwidth menggunakan perangkat Mikrotik.',
        ]);

        // --- SERVICES SEEDER (6 Items) ---
        Service::truncate();
        $services = [
            [
                'name' => 'Web Sekolah',
                'icon' => 'fas fa-school',
                'description' => 'Pembuatan website sekolah profesional dengan keamanan dan responsibilitas yang tinggi serta mendukung akses dari berbagai browser.',
                'is_active' => true,
            ],
            [
                'name' => 'Web Portofolio',
                'icon' => 'fas fa-user-tie',
                'description' => 'Pembuatan website branding atau portofolio untuk memperkenalkan kemampuan yang Anda miliki sebagai ajang promosi di dunia digital.',
                'is_active' => true,
            ],
            [
                'name' => 'Web UMKM',
                'icon' => 'fas fa-store',
                'description' => 'Menyediakan Website untuk pemasaran personal dilengkapi fitur optimasi dan SEO untuk meningkatkan penelusuran mesin pencari.',
                'is_active' => true,
            ],
            [
                'name' => 'Mikrotik Manajemen',
                'icon' => 'fas fa-network-wired',
                'description' => 'Jaringan Anda di rumah atau kantor mengalami masalah dalam pengaturan mikrotik? Kami siap membantu permasalahan Anda dengan profesional.',
                'is_active' => true,
            ],
            [
                'name' => 'Custom Web App',
                'icon' => 'fas fa-code',
                'description' => 'Pengembangan aplikasi web kustom berbasis framework Laravel modern sesuai dengan kebutuhan unik dan alur proses bisnis organisasi Anda.',
                'is_active' => true,
            ],
            [
                'name' => 'Pelayanan Prima',
                'icon' => 'fas fa-heart',
                'description' => 'Layanan dengan sepenuh hati dan dedikasi penuh untuk mencapai kepuasan pelanggan melalui dukungan teknis yang berkelanjutan dan andal.',
                'is_active' => true,
            ]
        ];
        foreach ($services as $svc) {
            Service::create($svc);
        }

        // --- PORTFOLIOS SEEDER (6 Items) ---
        Portfolio::truncate();
        $portfolios = [
            [
                'title' => 'Website PPDB Online Madrasah',
                'client' => 'Instansi Pendidikan',
                'completion_date' => '2023-05-10',
                'description' => 'Sistem Informasi Penerimaan Peserta Didik Baru terintegrasi secara online dengan fitur manajemen pendaftaran, seleksi berkas, dan pengumuman instan.',
            ],
            [
                'title' => 'Sistem Informasi Manajemen Klinik',
                'client' => 'Klinik Sehat Bersama',
                'completion_date' => '2023-08-20',
                'description' => 'Aplikasi manajemen operasional klinik terpadu untuk pengaturan antrian pasien, rekam medis elektronik, dan pengelolaan stok farmasi otomatis.',
            ],
            [
                'title' => 'Company Profile PT Sumber Rejeki',
                'client' => 'PT Sumber Rejeki',
                'completion_date' => '2023-02-15',
                'description' => 'Situs web profil perusahaan yang elegan, sangat cepat, dan responsif, dirancang khusus untuk meningkatkan online presence secara meyakinkan.',
            ],
            [
                'title' => 'Setup Jaringan Mikrotik SMPN 1',
                'client' => 'SMPN 1 Maju',
                'completion_date' => '2024-01-10',
                'description' => 'Manajemen bandwidth terpusat menggunakan Load Balancing multi-ISP dan pembuatan landing page hotspot area aman untuk radius seluruh siswa dan guru.',
            ],
            [
                'title' => 'Toko Online Baju Kekinian',
                'client' => 'Baju Kekinian Store',
                'completion_date' => '2023-11-05',
                'description' => 'Platform e-commerce dengan interaksi canggih, integrasi payment gateway virtual account otomatis, dan perhitungan ongkos kirim ke seluruh Indonesia.',
            ],
            [
                'title' => 'Sistem Inventory Gudang ERP',
                'client' => 'Logistik Cepat CV',
                'completion_date' => '2024-03-01',
                'description' => 'Sistem pendataan barang masuk dan keluar dengan fitur pembaca barcode scanner dan laporan riwayat mutasi stok gudang antar cabang.',
            ]
        ];
        foreach ($portfolios as $pf) {
            $pf['slug'] = Str::slug($pf['title']) . '-' . rand(100, 999);
            Portfolio::create($pf);
        }

        // --- POSTS SEEDER (3 Items) ---
        Post::truncate();
        $posts = [
            [
                'title' => 'Pentingnya Manajemen Jaringan Mikrotik untuk Sekolah',
                'category' => 'Networking',
                'content' => '<p>Dalam era digital yang berkembang pesat, infrastruktur jaringan menjadi tulang punggung dari seluruh aktivitas belajar mengajar di sekolah modern. Mengontrol dan mendistribusikan akses internet dengan manajemen bandwidth menggunakan alat sekuat Router Mikrotik sangat krusial agar kegiatan <em>e-learning</em> maupun administrasi berjalan lancar tanpa hambatan kuota yang tersedot oleh aktivitas non-edukatif. Keamanan hotspot juga menjadi pertimbangan utama.</p>',
                'is_published' => true,
            ],
            [
                'title' => 'Tips Memilih Jasa Pembuatan Website Profesional di Tahun Ini',
                'category' => 'Web Development',
                'content' => '<p>Membuat website fungsional untuk bisnis Anda tidak bisa dilakukan secara instan dan sembarangan. Pastikan Anda memilih agency atau developer berbakat yang sangat memahami aspek krusial UI/UX, optimasi SEO organik, keamanan siber, dan yang paling penting adalah dukungan serta jaminan stabilitas layanan setelah website selesai dibuat (maintenance). <strong>Billnesia</strong> hadir memberikan garansi fungsionalitas dan desain menawan yang 100% <em>mobile-friendly</em> untuk mendongkrak omzet klien.</p>',
                'is_published' => true,
            ],
            [
                'title' => 'Billnesia Merilis Layanan Baru: Audit Optimasi Keamanan Jaringan',
                'category' => 'Berita',
                'content' => '<p>Kabar sangat gembira bagi para pelaku usaha, instansi, dan institusi pendidikan! Dalam komitmen kami untuk terus berevolusi, <strong>Billnesia</strong> kini memperluas jangkauan portofolio layanannya dengan secara resmi menghadirkan paket eksklusif "Audit dan Optimasi Keamanan Jaringan Internet". Serangkaian layanan terpadu ini mencakup pencegahan pembobolan, pemblokiran situs-situs negatif, instalasi sistem <em>firewall protection</em> yang solid, mitigasi DDoS dasar, serta pencegahan intrusi jahat pada seluruh simpul jaringan Mikrotik di lokasi Anda.</p>',
                'is_published' => true,
            ]
        ];
        foreach ($posts as $pt) {
            $pt['slug'] = Str::slug($pt['title']) . '-' . rand(100, 999);
            Post::create($pt);
        }
    }
}
