<?php

namespace Database\Seeders;

use App\Models\Kuliner;
use Illuminate\Database\Seeder;

class ResepSeeder extends Seeder
{
    public function run(): void
    {
        $resep = [
            'mie-aceh' => ['45 menit', '4 porsi', [
                'Rebus mie kuning hingga setengah matang, lalu tiriskan.',
                'Haluskan bawang merah, bawang putih, cabai, jintan, dan kapulaga. Tumis sampai harum.',
                'Masukkan daging atau udang dan bumbu kari, masak sampai matang.',
                'Tambahkan tomat, kecambah, dan mie, lalu aduk rata. Tambahkan kaldu untuk versi kuah.',
                'Sajikan dengan emping, acar, dan perasan jeruk nipis.']],
            'kuah-beulangong' => ['2,5 jam', '8 porsi', [
                'Sangrai kelapa parut sampai cokelat, lalu haluskan.',
                'Haluskan cabai, kunyit, jahe, bawang, dan rempah lainnya.',
                'Tumis bumbu halus, masukkan daging, lalu tambahkan air.',
                'Masak dengan api kecil sampai daging empuk. Masukkan pisang atau nangka muda dan kelapa sangrai.',
                'Koreksi rasa, lalu sajikan dengan nasi hangat.']],
            'ayam-tangkap' => ['1 jam', '4 porsi', [
                'Lumuri ayam dengan kunyit dan garam, diamkan 30 menit.',
                'Goreng ayam sampai kering dan keemasan.',
                'Goreng daun kari, daun pandan yang diiris, dan cabai hijau sampai renyah.',
                'Campur ayam dengan gorengan daun, lalu sajikan dengan nasi dan sambal.']],
            'kuah-pliek-u' => ['1,5 jam', '6 porsi', [
                'Sangrai pliek u sebentar, lalu haluskan bersama kelapa parut.',
                'Tumis bumbu halus sampai harum.',
                'Tuang air, masukkan pliek u, dan didihkan.',
                'Masukkan sayur yang keras lebih dulu (nangka, pepaya), lalu melinjo dan daun singkong.',
                'Masak sampai bumbu meresap dan kuah mengental.']],
            'eungkot-keumamah' => ['45 menit', '4 porsi', [
                'Suwir ikan kayu, lalu rendam sebentar agar tidak terlalu keras.',
                'Tumis bumbu halus bersama asam sunti.',
                'Masukkan ikan dan daun kari, lalu masak sampai bumbu meresap dan agak kering.',
                'Sajikan dengan nasi hangat.']],
            'sate-matang' => ['1,5 jam', '4 porsi', [
                'Potong daging dadu, lalu marinasi dengan bumbu selama 30 menit.',
                'Tusuk daging dan bakar sambil diolesi bumbu.',
                'Haluskan kacang dan bumbu, lalu masak menjadi saus pekat.',
                'Sajikan sate dengan lontong dan siram saus kacang.']],
            'timphan' => ['1,5 jam', '12 buah', [
                'Haluskan pisang, lalu campur dengan tepung ketan dan santan sampai adonan kalis.',
                'Olesi daun pisang dengan minyak, lalu isi dengan adonan dan srikaya atau kelapa.',
                'Bungkus rapat, lalu kukus 30 sampai 40 menit.',
                'Dinginkan sebelum disajikan.']],
            'bu-kulah' => ['1 jam', '4 bungkus', [
                'Masak nasi sampai pulen.',
                'Siapkan lauk dan sambal.',
                'Layukan daun pisang di atas api, lalu alasi dengan nasi dan lauk.',
                'Bungkus rapat dan diamkan beberapa menit agar aroma daun meresap.']],
            'kopi-gayo' => ['10 menit', '1 cangkir', [
                'Giling biji kopi dengan tingkat sedang.',
                'Panaskan air sampai sekitar 92 hingga 96 derajat Celsius.',
                'Seduh 15 gram kopi dengan 250 ml air, tunggu 3 sampai 4 menit, lalu saring.',
                'Nikmati tanpa gula atau dengan sedikit gula.']],
            'kopi-sanger' => ['10 menit', '1 gelas', [
                'Masukkan bubuk kopi ke saringan kain.',
                'Tuang air panas perlahan sampai kopi menetes ke gelas.',
                'Tambahkan 1 sampai 2 sendok susu kental manis, lalu aduk.',
                'Sajikan selagi panas.']],
        ];

        foreach ($resep as $slug => [$waktu, $porsi, $langkah]) {
            Kuliner::where('slug', $slug)->update([
                'waktu' => $waktu, 'porsi' => $porsi, 'langkah' => implode("\n", $langkah),
            ]);
        }
    }
}
