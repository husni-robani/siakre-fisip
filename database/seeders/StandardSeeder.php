<?php

namespace Database\Seeders;

use App\Models\Standard;
use Illuminate\Database\Seeder;

class StandardSeeder extends Seeder
{
    public function run()
    {
        Standard::create(['name' => 'Visi, Misi dan Tujuan', 'number' => '1', 'description' => 'Penilaian difokuskan pada kejelasan arah, komitmen dan konsistensi pengembangan program studi oleh unit pengelola program studi untuk mencapai kinerja dan mutu yang ditargetkan berdasarkan misi dan langkah-langkah program yang terencana, efektif, dan terarah dalam rangka pewujudan visi perguruan tinggi dan visi keilmuan program studi.']);

        Standard::create(['name' => 'Tata Pamong, Tata Kelola dan Kerjasama', 'number' => '2', 'description' => 'Penilaian difokuskan pada kinerja dan keefektifan kepemimpinan, tata pamong, sistem manajemen sumber daya, sistem penjaminan mutu, sistem komunikasi dan teknologi informasi, program dan kegiatan yang diarahkan pada perwujudan visi dan penuntasan misi yang bermutu, serta terbangun dan terselenggaranya kerjasama dan kemitraan strategis dalam penyelenggaraan pendidikan tinggi, baik akademik maupun non akademik secara berkelanjutan pada tataran nasional, regional, maupun internasional untuk meningkatkan daya saing program studi.',]);

        Standard::create(['name' => 'Mahasiswa', 'number' => '3', 'description' => 'Penilaian difokuskan pada keefektifan sistem penerimaan mahasiswa baru yang adil dan objektif, keseimbangan rasio mahasiswa dengan dosen dan tenaga kependidikan yang menunjang pelaksanaan pembelajaran yang efektif dan efisien, serta program dan keterlibatan mahasiswa dalam pembinaan minat, bakat, dan keprofesian']);

        Standard::create(['name' => 'Sumber Daya Manusia', 'number' => '4', 'description' => 'Penilaian difokuskan pada keefektifan sistem perekrutan, ketersedian sumber daya dari segi jumlah, kualifikasi pendidikan dan kompetensi, program pengembangan, penghargaan, sanksi dan pemutusan hubungan kerja, baik bagi dosen maupun tenaga kependidikan untuk menyelenggarakan kegiatan pendidikan, penelitian, dan pengabdian kepada masyarakat yang bermutu. ']);

        Standard::create(['name' => 'Keuangan, Sarana dan Prasarana', 'number' => '5', 'description' => 'Penilaian keuangan termasuk pembiayaan difokuskan pada kecukupan, keefektifan, efisiensi, dan akuntabilitas, serta keberlanjutan pembiayaan untuk menunjang penyelenggaraan pendidikan, penelitian, dan pengabdian kepada masyarakat. Penilaian sarana dan prasarana difokuskan pada pemenuhan ketersediaan (availability) sarana prasarana, akses civitas akademika terhadap sarana prasarana (accessibility), kegunaan atau pemanfaatan (utility) sarana prasarana oleh sivitas akademika, serta keamanan, keselamatan, kesehatan dan lingkungan dalam menunjang pelaksanaan tridharma perguruan tinggi.']);

        Standard::create(['name' => 'Pendidikan', 'number' => '6', 'description' => 'Penilaian difokuskan pada kebijakan dan pengembangan kurikulum, kesesuaian kurikulum dengan bidang ilmu program studi beserta kekuatan dan keunggulan kurikulum, budaya akademik, proses pembelajaran, sistem penilaian, dan sistem penjaminan mutu untuk menunjang tercapainya capaian pembelajaran lulusan dalam rangka pewujudan visi, misi, dan tujuan perguruan tinggi/unit pengelola program studi.']);

        Standard::create(['name' => 'Penelitian', 'number' => '7', 'description' => 'Penilaian difokuskan pada komitmen untuk mengembangkan penelitian yang bermutu, keunggulan dan kesesuaian program penelitian dengan visi keilmuan program studi dan visi perguruan tinggi/unit pengelola program studi, serta capaian jumlah dan lingkup penelitian']);

        Standard::create(['name' => 'Pengabdian Pada Masyarakat', 'number' => '8', 'description' => 'Penilaian difokuskan pada komitmen untuk mengembangkan dan melaksanakan pengabdian kepada masyarakat, jumlah dan jenis kegiatan, keunggulan dan kesesuaian program pengabdian kepada masyarakat, serta cakupan daerah pengabdian.']);

        Standard::create(['name' => 'Luaran dan Pencapaian Tridharma', 'number' => '9', 'description' => 'Penilaian difokuskan pada pencapaian kualifikasi dan kompetensi lulusan berupa gambaran yang jelas tentang profil dan capaian pembelajaran lulusan dari program studi, penelusuran lulusan, umpan balik dari pengguna lulusan, dan persepsi public terhadap lulusan sesuai dengan capaian pembelajaran lulusan/kompetensi yang ditetapkan oleh program studi dan perguruan tinggi dengan mengacu pada KKNI, jumlah dan keungggulan publikasi ilmiah, jumlah sitasi, jumlah hak kekayaan intelektual, dan kemanfaatan/dampak hasil penelitian terhadap pewujudan visi dan penyelenggaraan misi, serta kontribusi pengabdian kepada masyarakat pada pengembangan dan pemberdayaan sosial, ekonomi, dan kesejahteraan masyarakat. ']);
    }
}
