<?php

namespace Database\Seeders;

use App\Models\Budaya;
use App\Models\Kuliner;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AcehSeeder extends Seeder
{
    public function run(): void
    {
        $kuliner = [
            ['Mie Aceh', 'Makanan', 'Seluruh Aceh', '🍜', true,
             'Mie kuning tebal dengan bumbu rempah yang kuat dan pedas.',
             'Mie Aceh dimasak dengan bumbu kari khas Aceh yang kaya rempah. Tersedia dalam tiga cara penyajian: goreng (kering), tumis (sedikit berkuah), dan kuah. Pilihan isiannya daging sapi, kambing, atau seafood seperti udang dan cumi. Biasanya disajikan dengan emping, bawang merah, acar, dan perasan jeruk nipis.',
             'Mie kuning tebal, cabai, bawang merah, bawang putih, kari, kapulaga, jintan, kecambah, tomat'],
            ['Kuah Beulangong', 'Makanan', 'Aceh Besar', '🍲', true,
             'Gulai daging kental yang dimasak di kuali besar untuk kenduri.',
             'Kuah beulangong dimasak dalam beulangong, yaitu kuali besar, dan menjadi hidangan utama pada kenduri, pesta pernikahan, dan tradisi Meugang. Daging sapi atau kambing dimasak lama bersama bumbu rempah, kelapa parut sangrai, dan pisang kapok muda atau nangka muda.',
             'Daging sapi atau kambing, kelapa parut sangrai, cabai, kunyit, jahe, serai, pisang muda atau nangka muda'],
            ['Ayam Tangkap', 'Makanan', 'Aceh Besar', '🍗', true,
             'Ayam goreng renyah yang ditumpuk daun pandan, daun kari, dan cabai hijau.',
             'Ayam tangkap terkenal dari Aceh Besar. Potongan ayam digoreng hingga kering lalu disajikan bersama gorengan daun kari, daun pandan, dan cabai hijau sehingga aromanya kuat. Hidangan ini cocok dimakan dengan nasi hangat dan sambal.',
             'Ayam kampung, daun kari, daun pandan, cabai hijau, bawang putih, kunyit, jahe'],
            ['Kuah Pliek U', 'Makanan', 'Aceh Besar dan Pidie', '🥬', false,
             'Gulai sayur khas Aceh dengan pliek u, kelapa yang difermentasi.',
             'Pliek u adalah ampas kelapa yang difermentasi, lalu menjadi bumbu utama gulai sayur ini. Isinya beragam: nangka muda, pepaya muda, melinjo, daun singkong, dan rebung, dengan rasa gurih, asam, dan pedas.',
             'Pliek u, nangka muda, melinjo, daun singkong, cabai, kelapa parut, asam sunti'],
            ['Eungkot Keumamah', 'Makanan', 'Aceh', '🐟', false,
             'Ikan tongkol kering yang dimasak dengan bumbu kuning dan asam sunti.',
             'Eungkot keumamah, atau ikan kayu, adalah ikan tongkol yang direbus, dijemur, lalu dimasak dengan bumbu rempah, cabai, dan asam sunti. Hidangan ini tahan lama sehingga dulu menjadi bekal perjalanan jauh.',
             'Ikan tongkol kering, asam sunti, cabai, bawang merah, kunyit, daun kari'],
            ['Sate Matang', 'Makanan', 'Matang, Bireuen', '🍢', false,
             'Sate daging dengan bumbu kacang pekat dan lontong.',
             'Sate matang berasal dari daerah Matang di Kabupaten Bireuen. Daging sapi atau kambing dibakar dan disiram bumbu kacang yang pekat dan pedas, lalu disajikan dengan lontong dan kuah gulai.',
             'Daging sapi atau kambing, kacang tanah, cabai, bawang, kecap, lontong'],
            ['Timphan', 'Kudapan', 'Seluruh Aceh', '🍃', true,
             'Kue ketan berbungkus daun pisang dengan isi srikaya atau kelapa.',
             'Timphan adalah kue tradisional dari adonan pisang dan tepung ketan yang dikukus dalam bungkusan daun pisang. Isinya srikaya atau kelapa manis. Kue ini hampir selalu hadir saat Idulfitri dan Iduladha, serta pada acara adat.',
             'Tepung ketan, pisang, santan, telur, gula, kelapa parut, daun pisang'],
            ['Bu Kulah', 'Makanan', 'Aceh Besar', '🍚', false,
             'Nasi dalam bungkus daun pisang yang dimakan bersama lauk dan sayur.',
             'Bu kulah berarti nasi bungkus. Nasi dibungkus daun pisang, lalu dimakan bersama lauk khas seperti ikan, ayam, atau sambal. Aroma daun pisang membuat nasi terasa lebih harum.',
             'Nasi, daun pisang, lauk ikan atau ayam, sambal, sayur'],
            ['Kopi Gayo', 'Minuman', 'Aceh Tengah dan Bener Meriah', '☕', true,
             'Kopi arabika dataran tinggi Gayo dengan rasa bersih dan seimbang.',
             'Kopi Gayo ditanam di dataran tinggi Gayo pada ketinggian sekitar 1.200 mdpl. Rasanya seimbang, dengan keasaman lembut dan aroma yang kompleks. Kopi ini sudah dikenal di pasar dunia.',
             'Biji kopi arabika Gayo'],
            ['Kopi Sanger', 'Minuman', 'Banda Aceh', '🥛', false,
             'Kopi susu khas warung kopi Aceh yang diseduh dengan saringan kain.',
             'Sanger adalah singkatan dari "sama-sama ngerti", yaitu kopi dengan susu yang takarannya pas. Kopi diseduh dengan saringan kain, lalu dicampur susu kental manis. Minuman ini menemani obrolan panjang di warung kopi di seluruh Aceh.',
             'Kopi robusta, susu kental manis, air panas'],
        ];

        foreach ($kuliner as [$nama, $jenis, $daerah, $emoji, $unggulan, $ringkasan, $deskripsi, $bahan]) {
            Kuliner::updateOrCreate(['slug' => Str::slug($nama)], compact('nama', 'jenis', 'daerah', 'emoji', 'unggulan', 'ringkasan', 'deskripsi', 'bahan'));
        }

        $budaya = [
            ['Tari Saman', 'Tari', '💃', true,
             'Tari duduk dari dataran tinggi Gayo yang digerakkan serempak.',
             'Tari Saman berasal dari masyarakat Gayo. Para penari duduk berbaris dan bergerak serempak dengan tepukan tangan, tepukan dada, dan petikan jari, diiringi syair dan nyanyian. Tarian ini diakui UNESCO sebagai warisan budaya takbenda dan melambangkan kekompakan, kerja sama, serta nilai keagamaan.'],
            ['Rapai Geleng', 'Musik', '🥁', false,
             'Tabuhan rapai bersama gerak kepala dan badan yang bergantian.',
             'Rapai Geleng memadukan tabuhan rapai, yaitu rebana besar, dengan gerak kepala dan tubuh para pemainnya. Pertunjukan dimulai pelan, lalu semakin cepat dan serempak. Kesenian ini biasanya tampil dalam penyambutan tamu dan acara budaya.'],
            ['Rumoh Aceh', 'Arsitektur', '🏠', true,
             'Rumah panggung tradisional Aceh dengan tiang tinggi dan ukiran halus.',
             'Rumoh Aceh adalah rumah panggung dengan tiang tinggi yang melindungi penghuni dari banjir dan binatang buas. Ruang bawahnya dipakai untuk bersantai dan menyimpan hasil panen. Rumah ini dibangun tanpa paku, memakai pasak kayu, dan dihiasi ukiran yang indah.'],
            ['Peusijuek', 'Tradisi', '🌿', false,
             'Upacara tepung tawar untuk memohon berkah dan keselamatan.',
             'Peusijuek adalah tradisi menaburkan beras, padi, dan air tepung tawar sebagai doa keselamatan. Tradisi ini dilakukan pada pernikahan, keberangkatan haji, peresmian rumah, dan saat membeli kendaraan baru.'],
            ['Meugang', 'Tradisi', '🐂', true,
             'Tradisi menyembelih dan menyantap daging bersama sebelum hari besar.',
             'Meugang dilakukan menjelang Ramadan, Idulfitri, dan Iduladha. Warga membeli dan memasak daging, lalu makan bersama keluarga. Tradisi ini juga menjadi momen berbagi dengan tetangga dan kaum dhuafa.'],
            ['Rencong', 'Pusaka', '🗡️', false,
             'Senjata tradisional Aceh yang menjadi lambang keberanian.',
             'Rencong adalah senjata tikam tradisional Aceh berbentuk huruf L. Bilahnya ditempa dengan teliti dan gagangnya sering diukir. Rencong menjadi simbol keberanian, kehormatan, dan identitas Aceh.'],
        ];

        foreach ($budaya as [$nama, $kategori, $emoji, $unggulan, $ringkasan, $deskripsi]) {
            Budaya::updateOrCreate(['slug' => Str::slug($nama)], compact('nama', 'kategori', 'emoji', 'unggulan', 'ringkasan', 'deskripsi'));
        }
    }
}
