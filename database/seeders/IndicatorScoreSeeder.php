<?php

namespace Database\Seeders;

use App\Models\Score;
use App\Models\ScoreResponse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IndicatorScoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['aspek' => 'Kepemimpinan', 'indikator' => 'Strategi - Perencanaan', 'jawaban' => 'Tidak mempunyai kemampuan dalam menyusun rencana/jadwal kerja', 'skor' => 1],
            ['aspek' => 'Kepemimpinan', 'indikator' => 'Strategi - Perencanaan', 'jawaban' => 'Kurang mempunyai kemampuan dalam menyusun rencana/jadwal kerja', 'skor' => 2],
            ['aspek' => 'Kepemimpinan', 'indikator' => 'Strategi - Perencanaan', 'jawaban' => 'Cukup mempunyai kemampuan dalam menyusun rencana/jadwal kerja', 'skor' => 3],
            ['aspek' => 'Kepemimpinan', 'indikator' => 'Strategi - Perencanaan', 'jawaban' => 'Mampu menyusun rencana/jadwal kerja sesuai yang diharapkan', 'skor' => 4],
            ['aspek' => 'Kepemimpinan', 'indikator' => 'Strategi - Perencanaan', 'jawaban' => 'Merupakan seorang konseptor yang baik/ideal secara konsisten', 'skor' => 5],

            ['aspek' => 'Kepemimpinan', 'indikator' => 'Strategi - Pengawasan', 'jawaban' => 'Tidak mempunyai kemampuan pengawasan terhadap bawahan, selalu tidak mengetahui masalah-masalah yang terjadi dibawahnya', 'skor' => 1],
            ['aspek' => 'Kepemimpinan', 'indikator' => 'Strategi - Pengawasan', 'jawaban' => 'Kurang mempunyai kemampuan pengawasan terhadap bawahan, sering tidak mengetahui masalah-masalah yang terjadi dibawahnya', 'skor' => 2],
            ['aspek' => 'Kepemimpinan', 'indikator' => 'Strategi - Pengawasan', 'jawaban' => 'Cukup mempunyai kemampuan pengawasan terhadap bawahan, sering mengetahui masalah-masalah yang terjadi dibawahnya', 'skor' => 3],
            ['aspek' => 'Kepemimpinan', 'indikator' => 'Strategi - Pengawasan', 'jawaban' => 'Secara aktif mampu melakukan pengawasan terhadap bawahan, selalu mengetahui masalah-masalah yang terjadi dibawahnya', 'skor' => 4],
            ['aspek' => 'Kepemimpinan', 'indikator' => 'Strategi - Pengawasan', 'jawaban' => 'Sangat aktif dalam melakukan pengawasan yang disusun secara periodik dan kontinyu, sehingga mampu memahami dan mendeteksi apa yang terjadi dibawahnya', 'skor' => 5],

            ['aspek' => 'Kepemimpinan', 'indikator' => 'Strategi - Inovasi', 'jawaban' => 'Tidak pernah memberikan ide yang cemerlang', 'skor' => 1],
            ['aspek' => 'Kepemimpinan', 'indikator' => 'Strategi - Inovasi', 'jawaban' => 'Sesekali memberikan ide yang cemerlang', 'skor' => 2],
            ['aspek' => 'Kepemimpinan', 'indikator' => 'Strategi - Inovasi', 'jawaban' => 'Cukup memberikan ide yang cemerlang', 'skor' => 3],
            ['aspek' => 'Kepemimpinan', 'indikator' => 'Strategi - Inovasi', 'jawaban' => 'Selalu memberikan ide yang dan merealisasikannya', 'skor' => 4],
            ['aspek' => 'Kepemimpinan', 'indikator' => 'Strategi - Inovasi', 'jawaban' => 'Sangat aktif dalam memberikan ide yang cemerlang dan merealisasikannya', 'skor' => 5],

            ['aspek' => 'Kepemimpinan', 'indikator' => 'Kepemimpinan', 'jawaban' => 'Tidak mempunyai kemampuan untuk memimpin dan mengarahkan bawahan', 'skor' => 1],
            ['aspek' => 'Kepemimpinan', 'indikator' => 'Kepemimpinan', 'jawaban' => 'Kurang mempunyai kemampuan untuk memimpin dan mengarahkan bawahan', 'skor' => 2],
            ['aspek' => 'Kepemimpinan', 'indikator' => 'Kepemimpinan', 'jawaban' => 'Cukup mempunyai kemampuan untuk memimpin dan mengarahkan bawahan', 'skor' => 3],
            ['aspek' => 'Kepemimpinan', 'indikator' => 'Kepemimpinan', 'jawaban' => 'Mempunyai kemampuan untuk memimpin yang baik, mengarahkan bawahan', 'skor' => 4],
            ['aspek' => 'Kepemimpinan', 'indikator' => 'Kepemimpinan', 'jawaban' => 'Mempunyai kemampuan untuk memimpin yang sangat baik, mengarahkan bawahan', 'skor' => 5],

            ['aspek' => 'Kepemimpinan', 'indikator' => 'Membimbing dan Membangun', 'jawaban' => 'Tidak mempunyai kemampuan untuk membimbing yang baik, membangun rekan kerja baik dalam pencapaian nilai perusahaan maupun tugas utama dan sasaran kinerjanya', 'skor' => 1],
            ['aspek' => 'Kepemimpinan', 'indikator' => 'Membimbing dan Membangun', 'jawaban' => 'Kurang mempunyai kemampuan untuk membimbing yang baik, membangun rekan kerja baik dalam pencapaian nilai perusahaan maupun tugas utama dan sasaran kinerjanya', 'skor' => 2],
            ['aspek' => 'Kepemimpinan', 'indikator' => 'Membimbing dan Membangun', 'jawaban' => 'Cukup mempunyai kemampuan untuk membimbing yang baik, membangun rekan kerja baik dalam pencapaian nilai perusahaan maupun tugas utama dan sasaran kinerjanya', 'skor' => 3],
            ['aspek' => 'Kepemimpinan', 'indikator' => 'Membimbing dan Membangun', 'jawaban' => 'Mempunyai kemampuan untuk membimbing yang baik, membangun rekan kerja baik dalam pencapaian nilai perusahaan maupun tugas utama dan sasaran kinerjanya', 'skor' => 4],
            ['aspek' => 'Kepemimpinan', 'indikator' => 'Membimbing dan Membangun', 'jawaban' => 'Mempunyai kemampuan untuk membimbing yang sangat baik, membangun rekan kerja baik dalam pencapaian nilai perusahaan maupun tugas utama dan sasaran kinerjanya', 'skor' => 5],

            ['aspek' => 'Kepemimpinan', 'indikator' => 'Pengambilan Keputusan', 'jawaban' => 'Tidak berani dalam pengambilan keputusan, tidak melakukan pertimbangan dalam pengambilan keputusan serta tidak bertanggung jawab dalam setiap keputusan yang diambil', 'skor' => 1],
            ['aspek' => 'Kepemimpinan', 'indikator' => 'Pengambilan Keputusan', 'jawaban' => 'Kurang dalam pengambilan keputusan, kurang melakukan pertimbangan dalam pengambilan keputusan serta kurang bertanggung jawab dalam setiap keputusan yang diambil', 'skor' => 2],
            ['aspek' => 'Kepemimpinan', 'indikator' => 'Pengambilan Keputusan', 'jawaban' => 'Mempunyai kemampuan yang cukup dalam pengambilan keputusan serta melakukan pertimbangan yang cukup setiap pengambilan keputusan serta bertanggung jawab dalam setiap keputusan yang diambil', 'skor' => 3],
            ['aspek' => 'Kepemimpinan', 'indikator' => 'Pengambilan Keputusan', 'jawaban' => 'Mempunyai kemampuan yang baik dalam pengambilan keputusan serta melakukan pertimbangan yang baik setiap pengambilan keputusan serta selalu bertanggung jawab dalam setiap keputusan yang diambil', 'skor' => 4],
            ['aspek' => 'Kepemimpinan', 'indikator' => 'Pengambilan Keputusan', 'jawaban' => 'Mempunyai kemampuan yang sangat baik dalam pengambilan keputusan serta melakukan pertimbangan yang sangat baik setiap pengambilan keputusan serta selalu bertanggung jawab dalam setiap keputusan yang diambil', 'skor' => 5],

            ['aspek' => 'Nilai-nilai Perusahaan dan Perilaku', 'indikator' => 'Kerjasama', 'jawaban' => 'Tidak dapat berhubungan baik atau bekerja sama dengan pimpinan atau bawahan atau rekan sekerja. Tidak peduli terhadap pencapaian target kerja dalam departemen atau bagian atau unitnya', 'skor' => 1],
            ['aspek' => 'Nilai-nilai Perusahaan dan Perilaku', 'indikator' => 'Kerjasama', 'jawaban' => 'Kurang dapat berhubungan baik atau bekerja sama dengan pimpinan atau bawahan atau rekan sekerja. Kurang peduli terhadap pencapaian target kerja dalam departemen atau bagian atau unitnya', 'skor' => 2],
            ['aspek' => 'Nilai-nilai Perusahaan dan Perilaku', 'indikator' => 'Kerjasama', 'jawaban' => 'Mempunyai hubungan yang sangat baik dan dapat bekerja sama dengan pimpinan atau bawahan atau rekan sekerja. Ada kepedulian terhadap pencapaian target kerja dalam departemen atau bagian atau unitnya', 'skor' => 3],
            ['aspek' => 'Nilai-nilai Perusahaan dan Perilaku', 'indikator' => 'Kerjasama', 'jawaban' => 'Mempunyai hubungan yang sangat baik dan mampu bekerja sama dengan pimpinan atau bawahan atau rekan sekerja. Memiliki kepedulian terhadap pencapaian target kerja dalam departemen atau bagian atau unitnya', 'skor' => 4],
            ['aspek' => 'Nilai-nilai Perusahaan dan Perilaku', 'indikator' => 'Kerjasama', 'jawaban' => 'Selalu mengutamakan hubungan baik dan kerja sama dalam bekerja baik dengan pimpinan atau bawahan atau rekan sekerja. Mampu memberikan motivasi kepada rekan sekerja untuk selalu mencapai bahkan melampaui target kerja dalam departemen atau bagian atau unitnya', 'skor' => 5],

            ['aspek' => 'Nilai-nilai Perusahaan dan Perilaku', 'indikator' => 'Komunikasi', 'jawaban' => 'Tidak dapat menjalin komunikasi yang baik dalam hubungan kerja dengan rekan satu departemen/bagian/unit maupun lintas antar departemen/bagian/unit. Selalu mengabaikan infomasi/pesan yang diterimanya dan tidak mem-follow up serta memberikan feedback sebagaimana mestinya', 'skor' => 1],
            ['aspek' => 'Nilai-nilai Perusahaan dan Perilaku', 'indikator' => 'Komunikasi', 'jawaban' => 'Kurang dapat menjalin komunikasi yang baik dalam hubungan kerja dengan rekan satu departemen/bagian/unit maupun lintas antar departemen/bagian/unit. Sering mengabaikan infomasi/pesan yang diterimanya dan tidak mem-follow up serta memberikan feedback sebagaimana mestinya', 'skor' => 2],
            ['aspek' => 'Nilai-nilai Perusahaan dan Perilaku', 'indikator' => 'Komunikasi', 'jawaban' => 'Cukup dapat menjalin komunikasi yang baik dalam hubungan kerja dengan rekan satu departemen/bagian/unit maupun lintas antar departemen/bagian/unit. Cukup memperhatikan infomasi/pesan yang diterimanya dan ada upaya untuk memfollow up serta memberikan feedback sebagaimana mestinya', 'skor' => 3],
            ['aspek' => 'Nilai-nilai Perusahaan dan Perilaku', 'indikator' => 'Komunikasi', 'jawaban' => 'Memiliki keterampilan berkomunikasi yang baik dalam hubungan kerja dengan rekan satu departemen/bagian/unit maupun lintas antar departemen/bagian/unit. Selalu memperhatikan infomasi/pesan yang diterimanya dan selalu menindaklanjuti, mem-follow up serta memberikan feedback sebagaimana mestinya tanpa perlu diingatkan', 'skor' => 4],
            ['aspek' => 'Nilai-nilai Perusahaan dan Perilaku', 'indikator' => 'Komunikasi', 'jawaban' => 'Sangat memiliki keterampilan berkomunikasi yang baik dalam hubungan kerja dengan rekan satu departemen/bagian/unit maupun lintas antar departemen/bagian/unit. Sangat memperhatikan infomasi/pesan yang diterimanya dan selalu menindaklanjuti, mem-follow up serta memberikan feedback sebagaimana mestinya tanpa perlu diingatkan', 'skor' => 5],

            ['aspek' => 'Nilai-nilai Perusahaan dan Perilaku', 'indikator' => 'Disiplin dan Kehadiran / Absensi', 'jawaban' => 'Sering ijin, mangkir, terlambat dan pernah mendapatkan SP', 'skor' => 1],
            ['aspek' => 'Nilai-nilai Perusahaan dan Perilaku', 'indikator' => 'Disiplin dan Kehadiran / Absensi', 'jawaban' => 'Pernah ijin, mangkir, terlambat dan pernah mendapatkan SP', 'skor' => 2],
            ['aspek' => 'Nilai-nilai Perusahaan dan Perilaku', 'indikator' => 'Disiplin dan Kehadiran / Absensi', 'jawaban' => 'Pernah ijin, terlambat dan pernah mendapatkan SP', 'skor' => 3],
            ['aspek' => 'Nilai-nilai Perusahaan dan Perilaku', 'indikator' => 'Disiplin dan Kehadiran / Absensi', 'jawaban' => 'Pernah ijin, terlambat dan tidak pernah mendapatkan SP', 'skor' => 4],
            ['aspek' => 'Nilai-nilai Perusahaan dan Perilaku', 'indikator' => 'Disiplin dan Kehadiran / Absensi', 'jawaban' => 'Tidak pernah ijin, mangkir, terlambat dan tidak pernah mendapatkan SP.', 'skor' => 5],

            ['aspek' => 'Nilai-nilai Perusahaan dan Perilaku', 'indikator' => 'Dedikasi dan Integritas', 'jawaban' => 'Tidak memiliki ketulusan dalam bekerja. Selalu memperhitungkan untung ruginya dalam bekerja dan apa yang dikatakannya selalu tidak sesuai dengan perbuatannya dan tidak dapat dipertanggungjawabkan. Acuh tak acuh terhadap tugas dan tanggung jawabnya, selalu terlihat santai', 'skor' => 1],
            ['aspek' => 'Nilai-nilai Perusahaan dan Perilaku', 'indikator' => 'Dedikasi dan Integritas', 'jawaban' => 'Kurang memiliki ketulusan dalam bekerja. Masih memperhitungkan untung ruginya dalam bekerja dan apa yang dikatakannya masih belum sesuai dengan perbuatannya dan kurang dapat dipertanggungjawabkan. Masih sering perlu diingatkan akan tugas dan tanggung jawabnya', 'skor' => 2],
            ['aspek' => 'Nilai-nilai Perusahaan dan Perilaku', 'indikator' => 'Dedikasi dan Integritas', 'jawaban' => 'Cukup memiliki ketulusan dalam bekerja. Cukup memiliki kepedulian dan kesadaran dalam bekerja, namun kadang-kadang apa yang dikatakannya masih belum sesuai dengan perbuatannya walaupun cukup berat dipertanggungjawabkan. Kadang-kadang masih sering perlu diingatkan akan tugas dan tanggung jawabnya', 'skor' => 3],
            ['aspek' => 'Nilai-nilai Perusahaan dan Perilaku', 'indikator' => 'Dedikasi dan Integritas', 'jawaban' => 'Memiliki ketulusan dalam bekerja. Memiliki kepedulian dan kesadaran dalam bekerja, sering apa yang dikatakannya sesuai dengan perbuatannya dan dapat dipertanggungjawabkan tanpa harus diingatkan. Sesekali perlu diingatkan akan tugas dan tanggung jawabnya', 'skor' => 4],
            ['aspek' => 'Nilai-nilai Perusahaan dan Perilaku', 'indikator' => 'Dedikasi dan Integritas', 'jawaban' => 'Selalu memiliki ketulusan dalam bekerja. Sangat memiliki kepedulian dan kesadaran dalam bekerja, selalu apa yang dikatakannya sesuai dengan perbuatannya dan dapat dipertanggungjawabkan. Tidak perlu diingatkan akan tugas dan tanggung jawabnya', 'skor' => 5],

            ['aspek' => 'Nilai-nilai Perusahaan dan Perilaku', 'indikator' => 'Etika', 'jawaban' => 'Tidak memiliki tata krama pergaulan. Tidak memahami bagaimana harus bersikap baik terhadap bawahan, rekan sekerja, atasan maupun pelanggan', 'skor' => 1],
            ['aspek' => 'Nilai-nilai Perusahaan dan Perilaku', 'indikator' => 'Etika', 'jawaban' => 'Kurang memahami tata krama pergaulan. Kurang memahami bagaimana harus bersikap baik terhadap bawahan, rekan sekerja, atasan maupun pelanggan', 'skor' => 2],
            ['aspek' => 'Nilai-nilai Perusahaan dan Perilaku', 'indikator' => 'Etika', 'jawaban' => 'Cukup memahami tata krama pergaulan. Dapat memahami bagaimana harus bersikap baik terhadap bawahan, rekan sekerja, atasan maupun pelanggan', 'skor' => 3],
            ['aspek' => 'Nilai-nilai Perusahaan dan Perilaku', 'indikator' => 'Etika', 'jawaban' => 'Selalu mengutamakan tata krama pergaulan baik terhadap rekan sekerja, atasan maupun pelanggan. Serta dapat menyesuaikan diri sesuai dengan situasi dan kondisinya', 'skor' => 4],
            ['aspek' => 'Nilai-nilai Perusahaan dan Perilaku', 'indikator' => 'Etika', 'jawaban' => 'Sangat mengutamakan tata krama pergaulan secara konsisten baik terhadap rekan sekerja, atasan maupun pelanggan. Sangat pandai menyesuaikan diri sesuai dengan situasi dan kondisinya', 'skor' => 5],

            ['aspek' => 'Sasaran Kinerja dan Proses Pencapaian', 'indikator' => 'Goal - Pencapaian Kinerja', 'jawaban' => 'Setiap hasil pekerjaannya selalu tidak sesuai dengan yang diharapkan, target tidak tercapai.', 'skor' => 1],
            ['aspek' => 'Sasaran Kinerja dan Proses Pencapaian', 'indikator' => 'Goal - Pencapaian Kinerja', 'jawaban' => 'Beberapa hasil pekerjaan perlu diperbaiki, target tidak tercapai.', 'skor' => 2],
            ['aspek' => 'Sasaran Kinerja dan Proses Pencapaian', 'indikator' => 'Goal - Pencapaian Kinerja', 'jawaban' => 'Semua hasil pekerjaannya cukup dapat dipertanggungjawabkan, kadang perlu koreksi dan target tidak semuanya tercapai', 'skor' => 3],
            ['aspek' => 'Sasaran Kinerja dan Proses Pencapaian', 'indikator' => 'Goal - Pencapaian Kinerja', 'jawaban' => 'Semua hasil pekerjaannya dapat dipertanggungjawabkan, secara konsisten baik dan sesuai target yang telah ditetapkan.', 'skor' => 4],
            ['aspek' => 'Sasaran Kinerja dan Proses Pencapaian', 'indikator' => 'Goal - Pencapaian Kinerja', 'jawaban' => 'Semua hasil pekerjaannya selalu dapat dipertanggungjawabkan, secara konsisten selalu baik dan sesuai target yang telah ditetapkan', 'skor' => 5],

            ['aspek' => 'Sasaran Kinerja dan Proses Pencapaian', 'indikator' => 'Error - Pencapaian kinerja', 'jawaban' => 'Tingkat kesalahan kerja sangat tinggi sehingga menjadi tidak efektif dan efisien.', 'skor' => 1],
            ['aspek' => 'Sasaran Kinerja dan Proses Pencapaian', 'indikator' => 'Error - Pencapaian kinerja', 'jawaban' => 'Tingkat kesalahan kerja masih tinggi sehingga kurang efektif dan efisien.', 'skor' => 2],
            ['aspek' => 'Sasaran Kinerja dan Proses Pencapaian', 'indikator' => 'Error - Pencapaian kinerja', 'jawaban' => 'Kesalahan kerja masih ada walaupun tidak banyak.', 'skor' => 3],
            ['aspek' => 'Sasaran Kinerja dan Proses Pencapaian', 'indikator' => 'Error - Pencapaian kinerja', 'jawaban' => 'Tingkat kesalahan kerja sangat kecil.', 'skor' => 4],
            ['aspek' => 'Sasaran Kinerja dan Proses Pencapaian', 'indikator' => 'Error - Pencapaian kinerja', 'jawaban' => 'Tidak ada kesalahan kerja.', 'skor' => 5],

            ['aspek' => 'Sasaran Kinerja dan Proses Pencapaian', 'indikator' => 'Proses - Pencapaian Kinerja ( Dokumen )', 'jawaban' => 'Setiap hasil kerja, sarana kerja, dokumen/arsip tidak tertata secara rapih, selalu tidak tertib dan tercecer bahkan hilang.', 'skor' => 1],
            ['aspek' => 'Sasaran Kinerja dan Proses Pencapaian', 'indikator' => 'Proses - Pencapaian Kinerja ( Dokumen )', 'jawaban' => 'Beberapa dari hasil kerja, sarana kerja, dokumen/arsip kurang tertata secara rapih, kurang tertib dan sering tercecer.', 'skor' => 2],
            ['aspek' => 'Sasaran Kinerja dan Proses Pencapaian', 'indikator' => 'Proses - Pencapaian Kinerja ( Dokumen )', 'jawaban' => 'Kadang-kadang sarana kerja, dokumen/arsip atau hasil kerja lainnya tertata cukup rapih, jarang terjadi dokumen/arsip/hasil kerja lainnya yang tercecer/tidak lengkap/hilang.', 'skor' => 3],
            ['aspek' => 'Sasaran Kinerja dan Proses Pencapaian', 'indikator' => 'Proses - Pencapaian Kinerja ( Dokumen )', 'jawaban' => 'Hampir setiap sarana kerja, dokumen/arsip atau hasil kerja lainnya tertata dengan rapih, hampir tidak pernah terjadi dokumen/arsip/hasil kerja lainnya yang tercecer/tidak lengkap/hilang.', 'skor' => 4],
            ['aspek' => 'Sasaran Kinerja dan Proses Pencapaian', 'indikator' => 'Proses - Pencapaian Kinerja ( Dokumen )', 'jawaban' => 'Sangat kompeten dalam mengatur seluruh sarana kerja, dokumen/arsip atau hasil kerja lainnya tertata dengan sangat rapih, tidak pernah terjadi dokumen/arsip/hasil kerja lainnya yang tercecer/hilang.', 'skor' => 5],

            ['aspek' => 'Sasaran Kinerja dan Proses Pencapaian', 'indikator' => 'Proses - Pencapaian Kinerja ( Inisiatif )', 'jawaban' => 'Selalu menunggu perintah, tidak ada kemauan untuk bertindak sendiri.', 'skor' => 1],
            ['aspek' => 'Sasaran Kinerja dan Proses Pencapaian', 'indikator' => 'Proses - Pencapaian Kinerja ( Inisiatif )', 'jawaban' => 'Sering menunggu perintah, walau ada kalanya dapat bertindak sendiri.', 'skor' => 2],
            ['aspek' => 'Sasaran Kinerja dan Proses Pencapaian', 'indikator' => 'Proses - Pencapaian Kinerja ( Inisiatif )', 'jawaban' => 'Cukup ada kemauan untuk bertindak sendiri, walau hanya terbatas kepada tugas dan tanggung jawabnya.', 'skor' => 3],
            ['aspek' => 'Sasaran Kinerja dan Proses Pencapaian', 'indikator' => 'Proses - Pencapaian Kinerja ( Inisiatif )', 'jawaban' => 'Hampir setiap tugas dan tanggung jawabnya dapat diselesaikan sendiri, kadang-kadang ada kemauan untuk memberikan alternatif tindakan tanpa harus diarahkan.', 'skor' => 4],
            ['aspek' => 'Sasaran Kinerja dan Proses Pencapaian', 'indikator' => 'Proses - Pencapaian Kinerja ( Inisiatif )', 'jawaban' => 'Selalu ada kemauan untuk mengembangkan sesuatu yang lebih baik dan melakukan skala prioritas dalam mengatur dan menyelesaikan tugas dan tanggung jawabnya tanpa harus diarahkan.', 'skor' => 5],

            ['aspek' => 'Sasaran Kinerja dan Proses Pencapaian', 'indikator' => 'Proses - Pencapaian Kinerja ( Pola Pikir )', 'jawaban' => 'Tidak berpikir positif dan tidak konsisten dalam melakukan pencapaian kinerja.', 'skor' => 1],
            ['aspek' => 'Sasaran Kinerja dan Proses Pencapaian', 'indikator' => 'Proses - Pencapaian Kinerja ( Pola Pikir )', 'jawaban' => 'Kurang berpikir positif dan kurang konsisten dalam melakukan pencapaian kinerja. ( Selalu diingatkan untuk selalu berpikir positif dan konsisten )..', 'skor' => 2],
            ['aspek' => 'Sasaran Kinerja dan Proses Pencapaian', 'indikator' => 'Proses - Pencapaian Kinerja ( Pola Pikir )', 'jawaban' => 'Cukup berpikir positif dan cukup konsisten dalam melakukan pencapaian kinerja ( Kadang diingatkan untuk selalu berpikir positif dan konsisten ).', 'skor' => 3],
            ['aspek' => 'Sasaran Kinerja dan Proses Pencapaian', 'indikator' => 'Proses - Pencapaian Kinerja ( Pola Pikir )', 'jawaban' => 'Berpikir positif dan tetap konsisten dalam melakukan pencapaian kinerja.', 'skor' => 4],
            ['aspek' => 'Sasaran Kinerja dan Proses Pencapaian', 'indikator' => 'Proses - Pencapaian Kinerja ( Pola Pikir )', 'jawaban' => 'Selalu berpikir positif dan selalu tetap konsisten dalam melakukan pencapaian kinerja.', 'skor' => 5],
        ];

        Score::insert($data);
    }
}
