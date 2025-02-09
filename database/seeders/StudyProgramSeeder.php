<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\StudyProgram;

class StudyProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $studyPrograms = [
            [
                'id' => '1',
                'name' => 'S1 Teknik Informatika',
                'short_name' => 'TI',
                'faculty_id' => '1',
            ],
            [
                'id' => '2',
                'name' => 'S1 Teknik Elektro',
                'short_name' => 'TE',
                'faculty_id' => '1',
            ],
            [
                'id' => '3',
                'name' => 'S1 Pendidikan Teknik Informatika',
                'short_name' => 'PTI',
                'faculty_id' => '1',
            ],
            [
                'id' => '4',
                'name' => 'S1 Pendidikan Teknik Elektro',
                'short_name' => 'PTE',
                'faculty_id' => '1',
            ],
            [
                'id' => '5',
                'name' => 'S1 Pendidikan Teknik Mesin',
                'short_name' => 'PTM',
                'faculty_id' => '1',
            ],
            [
                'id' => '6',
                'name' => 'S1 Pendidikan Teknik Otomotif',
                'short_name' => 'PTO',
                'faculty_id' => '1',
            ],
            [
                'id' => '7',
                'name' => 'S1 Teknik Mesin',
                'short_name' => 'TM',
                'faculty_id' => '1',
            ],
            [
                'id' => '8',
                'name' => 'S1 Teknik Industri',
                'short_name' => 'TI',
                'faculty_id' => '1',
            ],
            [
                'id' => '9',
                'name' => 'S1 Pendidikan Teknik Bangunan',
                'short_name' => 'PTB',
                'faculty_id' => '1',
            ],
            [
                'id' => '10',
                'name' => 'S1 Teknik Sipil',
                'short_name' => 'TS',
                'faculty_id' => '1',
            ],
            [
                'id' => '11',
                'name' => 'S1 Pendidikan Tata Boga',
                'short_name' => 'PTB',
                'faculty_id' => '1',
            ],
            [
                'id' => '12',
                'name' => 'S1 Pendidikan Tata Busana',
                'short_name' => 'PTB',
                'faculty_id' => '1',
            ],
            [
                'id' => '13',
                'name' => 'D4 Perpustakaan Digital',
                'short_name' => 'PD',
                'faculty_id' => '9',
            ],
            [
                'id' => '14',
                'name' => 'D4 Animasi',
                'short_name' => 'AN',
                'faculty_id' => '9',
            ],
            [
                'id' => '15',
                'name' => 'D4 Manajemen Pemasaran',
                'short_name' => 'MP',
                'faculty_id' => '9',
            ],
            [
                'id' => '16',
                'name' => 'D4 Akuntansi',
                'short_name' => 'AK',
                'faculty_id' => '9',
            ],
            [
                'id' => '17',
                'name' => 'D4 Teknologi Rekayasa Manufaktur',
                'short_name' => 'TRM',
                'faculty_id' => '9',
            ],
            [
                'id' => '18',
                'name' => 'D4 Teknologi Rekayasa Otomotif',
                'short_name' => 'TRO',
                'faculty_id' => '9',
            ],
            [
                'id' => '19',
                'name' => 'D4 Teknologi Rekayasa dan Pemeliharaan Bangunan Sipil',
                'short_name' => 'TRPBS',
                'faculty_id' => '9',
            ],
            [
                'id' => '20',
                'name' => 'D4 Teknologi Rekayasa Pembangkit Energi',
                'short_name' => 'TRPE',
                'faculty_id' => '9',
            ],
            [
                'id' => '21',
                'name' => 'D4 Teknologi Rekayasa Sistem Elektronika',
                'short_name' => 'TRSE',
                'faculty_id' => '9',
            ],
            [
                'id' => '22',
                'name' => 'D4 Tata Boga',
                'short_name' => 'TB',
                'faculty_id' => '9',
            ],
            [
                'id' => '23',
                'name' => 'D4 Desain Mode',
                'short_name' => 'DM',
                'faculty_id' => '9',
            ],
            [
                'id' => '24',
                'name' => 'S1 Bimbingan dan Konseling',
                'short_name' => 'BK',
                'faculty_id' => '4',
            ],
            [
                'id' => '25',
                'name' => 'S1 Teknologi Pendidikan',
                'short_name' => 'TP',
                'faculty_id' => '4',
            ],
            [
                'id' => '26',
                'name' => 'S1 Administrasi Pendidikan',
                'short_name' => 'AP',
                'faculty_id' => '4',
            ],
            [
                'id' => '27',
                'name' => 'S1 Pendidikan Luar Sekolah',
                'short_name' => 'PLS',
                'faculty_id' => '4',
            ],
            [
                'id' => '28',
                'name' => 'S1 Pendidikan Guru Sekolah Dasar',
                'short_name' => 'PGSD',
                'faculty_id' => '4',
            ],
            [
                'id' => '29',
                'name' => 'S1 Pendidikan Guru Pendidikan Anak Usia Dini',
                'short_name' => 'PGPAUD',
                'faculty_id' => '4',
            ],
            [
                'id' => '30',
                'name' => 'S1 Pendidikan Luar Biasa',
                'short_name' => 'PLB',
                'faculty_id' => '4',
            ],
            [
                'id' => '31',
                'name' => 'S1 Pend. Bahasa, Sastra Indonesia dan Daerah',
                'short_name' => 'PBSID',
                'faculty_id' => '5',
            ],
            [
                'id' => '32',
                'name' => 'S1 Bahasa dan Sastra Indonesia',
                'short_name' => 'BSI',
                'faculty_id' => '5',
            ],
            [
                'id' => '33',
                'name' => 'S1 Ilmu Perpustakaan',
                'short_name' => 'IP',
                'faculty_id' => '5',
            ],
            [
                'id' => '34',
                'name' => 'S1 Pendidikan Bahasa Inggris',
                'short_name' => 'PBI',
                'faculty_id' => '5',
            ],
            [
                'id' => '35',
                'name' => 'S1 Bahasa dan Sastra Inggris',
                'short_name' => 'BSI',
                'faculty_id' => '5',
            ],
            [
                'id' => '36',
                'name' => 'S1 Pendidikan Bahasa Arab',
                'short_name' => 'PBA',
                'faculty_id' => '5',
            ],
            [
                'id' => '37',
                'name' => 'S1 Pendidikan Bahasa Jerman',
                'short_name' => 'PBJ',
                'faculty_id' => '5',
            ],
            [
                'id' => '38',
                'name' => 'S1 Pendidikan Bahasa Mandarin',
                'short_name' => 'PBM',
                'faculty_id' => '5',
            ],
            [
                'id' => '39',
                'name' => 'S1 Pendidikan Seni Rupa',
                'short_name' => 'PSR',
                'faculty_id' => '5',
            ],
            [
                'id' => '40',
                'name' => 'S1 Pendidikan Seni Tari dan Musik',
                'short_name' => 'PSTM',
                'faculty_id' => '5',
            ],
            [
                'id' => '41',
                'name' => 'S1 Desain Komunikasi Visual',
                'short_name' => 'DKV',
                'faculty_id' => '5',
            ],
            [
                'id' => '42',
                'name' => 'S1 Pendidikan Matematika',
                'short_name' => 'PM',
                'faculty_id' => '2',
            ],
            [
                'id' => '43',
                'name' => 'S1 Matematika',
                'short_name' => 'M',
                'faculty_id' => '2',
            ],
            [
                'id' => '44',
                'name' => 'S1 Pendidikan Fisika',
                'short_name' => 'PF',
                'faculty_id' => '2',
            ],
            [
                'id' => '45',
                'name' => 'S1 Fisika',
                'short_name' => 'F',
                'faculty_id' => '2',
            ],
            [
                'id' => '46',
                'name' => 'S1 Pendidikan Kimia',
                'short_name' => 'PK',
                'faculty_id' => '2',
            ],
            [
                'id' => '47',
                'name' => 'S1 Kimia',
                'short_name' => 'K',
                'faculty_id' => '2',
            ],
            [
                'id' => '48',
                'name' => 'S1 Pendidikan Biologi',
                'short_name' => 'PB',
                'faculty_id' => '2',
            ],
            [
                'id' => '49',
                'name' => 'S1 Biologi',
                'short_name' => 'B',
                'faculty_id' => '2',
            ],
            [
                'id' => '50',
                'name' => 'S1 Bioteknologi',
                'short_name' => 'BT',
                'faculty_id' => '2',
            ],
            [
                'id' => '51',
                'name' => 'S1 Gizi',
                'short_name' => 'G',
                'faculty_id' => '2',
            ],
            [
                'id' => '52',
                'name' => 'S1 Pendidikan Ilmu Pengetahuan Alam',
                'short_name' => 'PIPA',
                'faculty_id' => '2',
            ],
            [
                'id' => '53',
                'name' => 'S1 Pendidikan Tata Niaga',
                'short_name' => 'PTN',
                'faculty_id' => '10',
            ],
            [
                'id' => '54',
                'name' => 'S1 Pendidikan Administrasi Perkantoran',
                'short_name' => 'PAP',
                'faculty_id' => '10',
            ],
            [
                'id' => '55',
                'name' => 'S1 Manajemen',
                'short_name' => 'M',
                'faculty_id' => '10',
            ],
            [
                'id' => '56',
                'name' => 'S1 Pendidikan Akuntansi',
                'short_name' => 'PA',
                'faculty_id' => '10',
            ],
            [
                'id' => '57',
                'name' => 'S1 Akuntansi',
                'short_name' => 'A',
                'faculty_id' => '10',
            ],
            [
                'id' => '58',
                'name' => 'S1 Pendidikan Ekonomi',
                'short_name' => 'PE',
                'faculty_id' => '10',
            ],
            [
                'id' => '59',
                'name' => 'S1 Ekonomi Pembangunan',
                'short_name' => 'EP',
                'faculty_id' => '10',
            ],
            [
                'id' => '60',
                'name' => 'S1 Pendidikan Jasmani, Kesehatan dan Rekreasi',
                'short_name' => 'PJKR',
                'faculty_id' => '7',
            ],
            [
                'id' => '61',
                'name' => 'S1 Ilmu Kesehatan Masyarakat',
                'short_name' => 'IKM',
                'faculty_id' => '7',
            ],
            [
                'id' => '62',
                'name' => 'S1 Ilmu Keolahragaan',
                'short_name' => 'IK',
                'faculty_id' => '7',
            ],
            [
                'id' => '63',
                'name' => 'S1 Pendidikan Kepelatihan Olahraga',
                'short_name' => 'PKO',
                'faculty_id' => '7',
            ],
            [
                'id' => '64',
                'name' => 'S1 Pendidikan Pancasila dan Kewarganegaraan',
                'short_name' => 'PPKn',
                'faculty_id' => '3',
            ],
            [
                'id' => '65',
                'name' => 'S1 Pendidikan Geografi',
                'short_name' => 'PG',
                'faculty_id' => '3',
            ],
            [
                'id' => '66',
                'name' => 'S1 Geografi',
                'short_name' => 'G',
                'faculty_id' => '3',
            ],
            [
                'id' => '67',
                'name' => 'S1 Pendidikan Sejarah',
                'short_name' => 'PS',
                'faculty_id' => '3',
            ],
            [
                'id' => '68',
                'name' => 'S1 Ilmu Sejarah',
                'short_name' => 'IS',
                'faculty_id' => '3',
            ],
            [
                'id' => '69',
                'name' => 'S1 Pendidikan Ilmu Pengetahuan Sosial',
                'short_name' => 'PIPS',
                'faculty_id' => '3',
            ],
            [
                'id' => '70',
                'name' => 'S1 Pendidikan Sosiologi',
                'short_name' => 'PSO',
                'faculty_id' => '3',
            ],
            [
                'id' => '71',
                'name' => 'S1 Ilmu Komunikasi',
                'short_name' => 'IK',
                'faculty_id' => '3',
            ],
            [
                'id' => '72',
                'name' => 'S1 Psikologi',
                'short_name' => 'P',
                'faculty_id' => '6',
            ],
            [
                'id' => '73',
                'name' => 'S1 Kedokteran',
                'short_name' => 'K',
                'faculty_id' => '8',
            ],
            [
                'id' => '74',
                'name' => 'S1 Keperawatan',
                'short_name' => 'K',
                'faculty_id' => '8',
            ],
            [
                'id' => '75',
                'name' => 'S1 Kebidanan',
                'short_name' => 'K',
                'faculty_id' => '8',
            ],
        ];

        foreach ($studyPrograms as $studyProgram) {
            \App\Models\StudyProgram::create($studyProgram);
        }
    }
}
