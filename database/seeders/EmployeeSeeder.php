<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tbl_karyawan = [
            [
                "id" => "0098e247-ae75-4a91-bedf-ee134f4165de",
                "npp" => "22005",
                "nama" => "Riza Frika Alvianita, Amd Kep",
                "level" => "IV A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "0173b3e5-8257-4f2e-a2b5-1fc4f9b9cf86",
                "npp" => "34014",
                "nama" => "Octa Bella Barokahi",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "01824734-9c48-4723-bed4-7ab1f9df1ee6",
                "npp" => "24127",
                "nama" => "Yessy Kristiana, Amd Kep",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "01fc27b7-cc48-4c6f-9772-4e058149af42",
                "npp" => "24282",
                "nama" => "Fio Rezha Irawan, A.Md.Kes",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "028cfede-dad6-4382-95ac-f3178cfe245a",
                "npp" => "12384",
                "nama" => "Ismayanti, Amd Keb",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "02a28266-2e63-4ff4-88ca-6b581e1eaaa0",
                "npp" => "22043",
                "nama" => "Adam Winarno",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "02cedacd-c245-43aa-a906-30c2e7788033",
                "npp" => "12310",
                "nama" => "Firman Hafidh",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "032c6e1d-a95d-4de5-afca-b8f867771375",
                "npp" => "11103",
                "nama" => "Bagus Anindito, dr., Sp.PD",
                "level" => "I A NS",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "057b8c38-d3ba-48c3-bd71-d7a613009dde",
                "npp" => "12239",
                "nama" => "Desi Rosyanti, AMK",
                "level" => "IV A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "05ded6c1-9c2d-41e0-9631-e42119049e9e",
                "npp" => "21017",
                "nama" => "Mochamad Firman Azis",
                "level" => "IV B",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "06119372-76f4-4e88-9386-3b10d06ca9a2",
                "npp" => "34008",
                "nama" => "Mega Yusinta",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "0657ce50-ce24-4062-863c-afa0bf17820d",
                "npp" => "22059",
                "nama" => "Riska Aprillia, Amd Kep",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "06f479a5-aaa1-45c4-991d-5f4524c4563a",
                "npp" => "12391",
                "nama" => "Erni Laela Sari",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "0749518a-0a7b-4dea-b6fb-c6cbef511aca",
                "npp" => "11131",
                "nama" => "Ihsan Marga Wiyaksa",
                "level" => "IV A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "077aeefb-3f4d-4fab-90b2-132a6471c983",
                "npp" => "11053",
                "nama" => "Musaddiq",
                "level" => "IV B",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "07cda821-c33d-4919-a319-62e1abb852cb",
                "npp" => "11093",
                "nama" => "Putri Dwi Jayanti, Amd.KG",
                "level" => "IV B",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "080bf961-2eb1-4378-bb08-9e4eab59fb17",
                "npp" => "30038",
                "nama" => "Mei Heni Susanti, A.Md.Kep",
                "level" => "N\/A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "082b4a72-6bd9-47c9-825e-00037334cbcd",
                "npp" => "24185",
                "nama" => "Frasetyo Hari Cahyono",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "08447fb4-5d56-4d85-b7e3-52c7d0fe0e15",
                "npp" => "24253",
                "nama" => "Zulfia Novita",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "08f78886-b2d1-46f7-9f14-6d118d64ff3c",
                "npp" => "30002",
                "nama" => "Fitria Aji Wulandari",
                "level" => "N\/A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "0909253d-981a-42ed-a788-11156a7780ce",
                "npp" => "30028",
                "nama" => "Zulfania, S.Kep.Ns",
                "level" => "N\/A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "0920f357-c88e-4b9a-813d-649166e6fb53",
                "npp" => "22039",
                "nama" => "Eni Rivayanti, Amd Kep",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "09dcbc1a-faec-405e-afeb-5e98016b9672",
                "npp" => "11112",
                "nama" => "Meyshani Tuti Kosmana, Amd",
                "level" => "IV B",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "09ffcb8d-22d4-4e09-a13f-45ab6fc04b12",
                "npp" => "11069",
                "nama" => "Agus Hermawan, AMK",
                "level" => "IV A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "0a681e52-b2d2-4088-8540-bf41be40cfc5",
                "npp" => "24311",
                "nama" => "Rizal Sahril Sabirin, A.Md.Kep",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "0b84c589-4379-49a9-933e-60998e8edaed",
                "npp" => "11109",
                "nama" => "Hersa Eka Juniar, Amd.AK",
                "level" => "IV A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "0c076a85-6aaf-4aff-93de-c8e64d9022b0",
                "npp" => "21001",
                "nama" => "Yessy Susilowati, S.Farm",
                "level" => "II NS",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "0c204065-ef59-447b-864b-51195d4a3517",
                "npp" => "34015",
                "nama" => "Yuni Indrawati, A.Md.Kep",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "0c2b012f-bc09-492e-b332-f2aaa22b86d2",
                "npp" => "24024",
                "nama" => "Yuwana Hadi Wirawan, Amd Kep",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "0cc27b10-d470-44f5-a0b5-038df8016c1d",
                "npp" => "24077",
                "nama" => "Wahyu Hidayat",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "0d07cac5-364d-4232-8741-847823cc4c0a",
                "npp" => "22008",
                "nama" => "Rina Fitri Liawati",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "0dd66df1-b55c-46bf-905d-c03de939c48d",
                "npp" => "21016",
                "nama" => "Andre Setyawan Candra N, dr",
                "level" => "I B",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "0e679260-beae-453d-b203-81ea7fb1ab2d",
                "npp" => "24297",
                "nama" => "Hoirul Amanda Putra, S.Kom",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "0e698acb-71d8-47bc-9625-092eac398edd",
                "npp" => "24157",
                "nama" => "Winda Indriani",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "0ebc665c-cc7f-43a1-ad5c-453d52a39549",
                "npp" => "12410",
                "nama" => "Dian Eka Permana",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "0ecd9d70-f34d-4292-80b9-4d441389e4a7",
                "npp" => "24205",
                "nama" => "Sri Widarsih",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "0ee7fc11-b8ff-4c66-94d5-741bc3d8e64b",
                "npp" => "30014",
                "nama" => "Weni Wahyu Widianti",
                "level" => "N\/A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "0fb1d306-6af1-420a-abc0-04611fd1ece9",
                "npp" => "12404",
                "nama" => "Dhika Rizky Fitriana",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "1027d483-5b43-44a1-8fa7-5f8b5f2525a3",
                "npp" => "11134",
                "nama" => "Sandhy Fauzan Ramdansyah, Amd.RMIK",
                "level" => "IV B",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "106af375-5c01-47e8-a4a1-1e8817633694",
                "npp" => "30042",
                "nama" => "Elvin Candra Luvita, S.Kep.Ns",
                "level" => "N\/A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "107a540a-43cf-4be6-829e-40f3de37b9aa",
                "npp" => "12142",
                "nama" => "Rofi Fadilah, Amd Kep",
                "level" => "IV A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "10c1e322-9cf5-447b-9599-6c6458d7e369",
                "npp" => "12399",
                "nama" => "Sri Rahayu",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "10df8e14-56d5-445e-8cfd-d6e6ee114de1",
                "npp" => "24181",
                "nama" => "Atika Pangestika",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "10e4fbbd-929b-42ed-b4fb-bda8e558842d",
                "npp" => "24268",
                "nama" => "Rizky Maulidina",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "10eff89b-30f7-451f-8965-be61b3764a5d",
                "npp" => "22067",
                "nama" => "Putri Dwi Wijayanti",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "1140b627-c7bc-4e0a-85c9-6d9d3239df43",
                "npp" => "12367",
                "nama" => "Regina Natalia Barus",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "11717ba8-b196-4acc-bf62-641f8a445daa",
                "npp" => "24323",
                "nama" => "Retno Fatmalagandi",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "11b8e592-db29-40e8-a01c-a03b434f5b83",
                "npp" => "24276",
                "nama" => "Miftachul Jannah",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "1207cb3f-0444-40ee-90cf-89a8c95979f9",
                "npp" => "24214",
                "nama" => "Dwi Wahyu Rachmawati",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "121b5237-d959-4f17-8555-62e375bfab17",
                "npp" => "24262",
                "nama" => "Risma Deliya Tamara",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "122b687d-dce3-40d6-9a6b-9f45c46fd5a9",
                "npp" => "32004",
                "nama" => "Gilda Anindita Mahari, dr",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "1298c96d-0f16-4634-9923-bbb1d9948fe3",
                "npp" => "11016",
                "nama" => "Nonih Nurhasanah, AMK",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "1382715f-39ea-431d-9f3b-96b37742664e",
                "npp" => "34002",
                "nama" => "Adi Candra Wijaya",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "138a3251-51dd-4966-869f-07710a747c9b",
                "npp" => "11092",
                "nama" => "Susilawati, Amd.RMIK",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "1391bed0-7251-4ebd-9c32-24411ff772dc",
                "npp" => "25069",
                "nama" => "dr. Bondan, Sp.PD",
                "level" => "dr Sp",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "13a187e0-cce4-454d-8661-3a854dac55c6",
                "npp" => "12269",
                "nama" => "Hanika Sari",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "14148b90-24e3-41fc-abbf-1cfd99dd447e",
                "npp" => "12322",
                "nama" => "Reka Melkawati",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "14316012-771f-43d0-93b3-4b4e48405165",
                "npp" => "11056",
                "nama" => "Hendayani, AMK",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "149433d3-05a2-415e-9ea4-0f2fdabfd564",
                "npp" => "30029",
                "nama" => "Faitul Romela, A.Md.Kep",
                "level" => "N\/A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "14d6af59-c1a8-4b59-9cce-a4447aa708e6",
                "npp" => "21002",
                "nama" => "Hasyim Fauzi, Amd kep",
                "level" => "II",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "1533febc-dff0-4302-bca1-09348a48814e",
                "npp" => "12111",
                "nama" => "test karyawan 1",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "15448d98-7cb3-44eb-bb15-369ae0e271aa",
                "npp" => "12416",
                "nama" => "Nadhira Maraya Risdiani",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "15b69683-9b53-4146-b23d-c2f17b3c7391",
                "npp" => "11033",
                "nama" => "Dicky Widyanto, S.Kom",
                "level" => "I C",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "15b8a471-af41-4941-b60d-a28e9e14c459",
                "npp" => "24031",
                "nama" => "Anik Retna Iswari, Amd Kep",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "16468d9f-6230-4774-8270-c0af3926d931",
                "npp" => "22007",
                "nama" => "Roni Badrussalim, Amd Kep",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "18504f53-e1dd-46bb-b869-c6440fe46ecd",
                "npp" => "11011",
                "nama" => "Sri Purwanti",
                "level" => "IV B",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "18d7259d-212b-4c69-aa91-003f2f20eb3f",
                "npp" => "30024",
                "nama" => "Lailatul Firdausiyah",
                "level" => "N\/A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "19833567-c035-4299-8ab5-920b1e2f8bd2",
                "npp" => "24292",
                "nama" => "Ananda Nicola Hidayat, S.Kep.Ners",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "1acb2e62-5174-40cd-bf56-051a19a0f5d9",
                "npp" => "24204",
                "nama" => "Bakhrudin Zamzam",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "1aeab7f6-034d-49aa-9459-dad85c6fd066",
                "npp" => "35006",
                "nama" => "Fathiya Ainul Mardhiyah, dr",
                "level" => "drU",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "1b37f885-be93-4d7a-bc14-f60216e706c4",
                "npp" => "11080",
                "nama" => "Nurul Kasanah, AMK",
                "level" => "IV A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "1b7b654a-738c-4e09-a793-8e94b1634cc5",
                "npp" => "12290",
                "nama" => "Gita Rosa Fauziah, Amd.RMIK",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "1b8be5f1-ba4b-4ae7-ab52-845cd0f7095e",
                "npp" => "30013",
                "nama" => "Erdya Ferianda Pradita",
                "level" => "N\/A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "1bc6c7b7-188e-4f97-8c1e-d05319f4d353",
                "npp" => "24315",
                "nama" => "Cintia Mulyaningtyas Putri",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "1c409bff-6581-4439-b015-1deb3b462e3c",
                "npp" => "12294",
                "nama" => "Fatimah Sundari Banjarsari",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "1c4c9957-f9c2-47bd-a1ef-33b8872ba63f",
                "npp" => "12212",
                "nama" => "Ai Safitri",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "1c7f95bb-52de-4909-bd75-2598642a7248",
                "npp" => "25006",
                "nama" => "dr. Midastri Totok Wismono, Sp. PK",
                "level" => "dr Sp",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "1c9094f1-5c0f-4b06-ac79-1e7b0d9335d6",
                "npp" => "24313",
                "nama" => "Jihan Prawira Yudha",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "1cff34ca-fe85-4334-b310-1a173fe062cb",
                "npp" => "12340",
                "nama" => "Fahrul Maulidina Muhamad",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "1d3522f9-b139-4fa8-8b20-fa4bc3e16087",
                "npp" => "22074",
                "nama" => "Iwan Setyawan, Amd Kep",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "1d5bf00d-cf20-4b84-a6d9-c1248a16da80",
                "npp" => "24144",
                "nama" => "Agusnita Panca Indriati",
                "level" => "IV A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "1d8fd1a4-b93e-462a-9c7f-fd0708849968",
                "npp" => "30003",
                "nama" => "Paramita Dewi",
                "level" => "N\/A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "1dafd154-dae8-4e20-90ea-a2e693061d3c",
                "npp" => "30006",
                "nama" => "Lutfiatul Muakhidah",
                "level" => "N\/A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "1dbceb4f-d706-4bdd-8f03-86ca42e6f3ff",
                "npp" => "24036",
                "nama" => "A'an Dwi Safaringga",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "1e3bd7fe-c843-4dd7-9084-8e8cf98b50ee",
                "npp" => "12281",
                "nama" => "Sarah Annisa Ramadhanty",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "1e714fff-5271-4ace-ba91-2501c2e6b9f1",
                "npp" => "34013",
                "nama" => "Fandhiyan Parta Nugraha",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "1ecb3547-f715-4eb3-85ee-5a4c6b256d6f",
                "npp" => "12413",
                "nama" => "Ihwan Syah",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "1ecd8a00-151c-401d-b29f-ebdb8d946e4a",
                "npp" => "11034",
                "nama" => "Wawan Hernawan, Amd",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "1f65b6f6-dc8d-4114-af59-ca8fd7fd9229",
                "npp" => "24027",
                "nama" => "Juni Fatikah S.",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "1f9ed99f-7634-4853-8de5-cba57b405340",
                "npp" => "12110",
                "nama" => "test karyawan 3",
                "level" => "II NS",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "201b184e-2b98-47a0-b5ab-15a92655086d",
                "npp" => "24251",
                "nama" => "Tri Suryono Putro",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "215dee36-13a5-40cc-b230-dd5a8a1bf1ea",
                "npp" => "24280",
                "nama" => "Revi Maqrisa, A.Md.Rad",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "2205c1bf-e99f-43b4-93ae-c5ff816fe922",
                "npp" => "12260",
                "nama" => "Nina Ayustina, Amd.Farm",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "223da7d6-9908-4559-83c6-b3fb821d7c95",
                "npp" => "22076",
                "nama" => "Yessy Kristiana, Amd Kep",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "2285c753-d306-42f8-b49a-2582f038a788",
                "npp" => "12320",
                "nama" => "Dian Berlianti, Am.Keb",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "22998f01-46bb-4010-a966-3ab33efd994d",
                "npp" => "11129",
                "nama" => "Sandra Oktapiani, AMK",
                "level" => "IV A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "2317571d-9732-4104-b550-847232d645a6",
                "npp" => "12262",
                "nama" => "Tiara Noor Rizkya Agustin",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "2353b13c-8be9-4f17-abf3-e6857e5c28d3",
                "npp" => "24310",
                "nama" => "Bagus Setia Prayitno, A.Md.Kep",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "237b83e5-a8f4-4411-a708-82ae5681cc1b",
                "npp" => "32012",
                "nama" => "Nurul Azizah",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "245c3bff-5d0e-4d5d-8cfa-c8ec14908a73",
                "npp" => "12287",
                "nama" => "Aswin Rinaldi Gautama, dr",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "248afae2-df54-4e1a-b1cf-e46cded604a8",
                "npp" => "22013",
                "nama" => "Ika Kencana Rukmining Tyas, Amd Kep",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "252f776b-8d3b-4026-9c9d-1dc714d364dc",
                "npp" => "11038",
                "nama" => "Yulia Kartika Nurdin, AMK",
                "level" => "II",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "25a8cade-ca54-47cb-81cc-9c24949be140",
                "npp" => "12328",
                "nama" => "Ogi",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "25e5e5b6-8021-44de-bbc0-cb2e26eaf70a",
                "npp" => "11020",
                "nama" => "Dedi Iskandar",
                "level" => "II",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "25eb6c55-6091-4a76-b9f4-bbe2e075f9a3",
                "npp" => "24121",
                "nama" => "Octaviani Defi",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "26171add-3879-4f89-98d2-561d747e5cf5",
                "npp" => "24230",
                "nama" => "Rizki Agustya",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "262f08d9-a24a-40be-9676-648838bb7389",
                "npp" => "24190",
                "nama" => "Julialdy Eko Kurniawan",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "263f8fba-4e2b-48f7-b9d3-c9b17cd1afc9",
                "npp" => "22082",
                "nama" => "Rose Rona Aisyah",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "26bd55fe-2f53-4026-9521-34681ad44a86",
                "npp" => "11138",
                "nama" => "Mia Nurul Jannah",
                "level" => "IV A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "26eacd60-e675-400d-86f4-cc13c690bac7",
                "npp" => "34018",
                "nama" => "Alfian Nur Shodikin",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "26eb33de-e3fc-43cc-b56c-16a18b585f28",
                "npp" => "22080",
                "nama" => "Nellindra Lyanta Sukma, Amd Kep",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "27cfdb72-c0fd-4c0b-b92c-c31147d94c30",
                "npp" => "11085",
                "nama" => "Fitria Harselina",
                "level" => "IV B",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "28173d0a-20a4-4205-aa68-9917766e2e08",
                "npp" => "11091",
                "nama" => "Yuli Septiani, Amd.Ft",
                "level" => "IV A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "28ab1b82-38e0-4c04-9a0b-ff94fc30f132",
                "npp" => "24053",
                "nama" => "M Nur Roziqin",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "28c43064-0dce-4160-9143-26102f16a300",
                "npp" => "11017",
                "nama" => "Mulyana",
                "level" => "IV B",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "2954a797-e7df-4db4-92c6-4895d6e7074f",
                "npp" => "12132",
                "nama" => "Yudas Dwi Andriyana, Amd Kes",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "2981c4d6-2eb7-408c-b821-4fe18a55fd20",
                "npp" => "12166",
                "nama" => "Asri Lestari",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "29bbbd92-3a59-4218-876e-d4d7046177e9",
                "npp" => "34027",
                "nama" => "Fitria Nur Athirah",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "29d7d76b-5e55-48fd-a997-93c16d13e77b",
                "npp" => "34001",
                "nama" => "Budi Arisandi",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "2a574b76-6617-4367-9760-aeb8f5c4ac42",
                "npp" => "30027",
                "nama" => "apt. Achmad Fatoni, S.Farm",
                "level" => "N\/A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "2a687daf-b104-4bd3-9c90-286fbbfc89c6",
                "npp" => "12165",
                "nama" => "Aditia Choirul Pratama, Amd Kep",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "2aa456db-9c26-49ff-8d63-2083126a3c00",
                "npp" => "24324",
                "nama" => "Rizky Ardi Lesmana",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "2b693334-93a8-41f0-9bae-89e695f49e03",
                "npp" => "21012",
                "nama" => "Titik Yunaidah",
                "level" => "IV A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "2c0b4cab-5f59-4e02-a7da-f27f369abfbb",
                "npp" => "24089",
                "nama" => "Neneng Miari, Amd Kep",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "2c3c56e2-3255-4024-ab4b-7af262b70016",
                "npp" => "22027",
                "nama" => "Hendri Purwanto",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "2ca0f963-66cd-4315-9be6-525156014cb4",
                "npp" => "11139",
                "nama" => "Tria Anita Octaviana, Amd",
                "level" => "IV B",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "2cb6f6e0-e3eb-436e-8262-f85206e710f7",
                "npp" => "12265",
                "nama" => "Ayu Aprianti",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "2cff95cf-6f93-48c1-bace-1ff67ee09e65",
                "npp" => "24256",
                "nama" => "Wiyadi",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "2d2ef895-0f43-44fb-9160-99a6a612ce7d",
                "npp" => "11045",
                "nama" => "Yosep Nizar Faturohman, S.Sos",
                "level" => "I B",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "2d35a00c-b2d2-4e5d-afc4-0124a9aec0bf",
                "npp" => "12229",
                "nama" => "Nita Nurkomara Sari",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "2dd8a198-a505-4338-99c0-dc3166485342",
                "npp" => "24143",
                "nama" => "Nurul Maulidya",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "2e32170b-7eee-4cc9-a8a3-93735ba34af5",
                "npp" => "24090",
                "nama" => "Zakiyah Putri Amalia",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "2f89db53-7ddb-4086-83fa-74faa682be87",
                "npp" => "12395",
                "nama" => "Mega Fitri Kusmawan",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "2ffe077a-91d0-406c-a5f8-a1b2e6141102",
                "npp" => "35001",
                "nama" => "Yulianik Siskawati,drg",
                "level" => "drg",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "3020dc96-fb59-4614-931f-08f2390b7ffd",
                "npp" => "30026",
                "nama" => "Imroatus Sholikhah",
                "level" => "N\/A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "31f9f249-e512-4aea-91f9-47664b33c874",
                "npp" => "24203",
                "nama" => "Alfisyamas Nisa Pamenang",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "33057d53-a089-4c6a-9bd5-23cdb9e6ed06",
                "npp" => "12275",
                "nama" => "Maharani Puspitasari",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "33348301-c9e7-41ae-b0eb-ec542a1dd15a",
                "npp" => "12293",
                "nama" => "Nuri Halimah Fauziyah",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "33357081-535c-4bf9-a109-b34edcc587e6",
                "npp" => "22064",
                "nama" => "Danik Arfiani, Amd Kep",
                "level" => "IV A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "3350f825-e66d-4bf3-99d1-12fb9e34fd02",
                "npp" => "30009",
                "nama" => "Kristian Hartanto",
                "level" => "N\/A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "33898bd0-521a-4123-b6d8-b12704a0a88a",
                "npp" => "12304",
                "nama" => "Dini Nur Islami Rahayu",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "33b6bcef-1331-4470-beb9-cdefe80291f8",
                "npp" => "25021",
                "nama" => "dr. Vina Tri Aditya, Sp. PD",
                "level" => "dr Sp",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "33e2ed41-d9bb-4eed-8699-fed820efbd21",
                "npp" => "11005",
                "nama" => "Atinaningsih, S.Pd",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "34586421-9e74-4d76-ae3c-fe3b361eb3fa",
                "npp" => "11025",
                "nama" => "Yanti Suvitri",
                "level" => "IV B",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "3484e96b-e405-4344-b1d2-81440f8808f3",
                "npp" => "11014",
                "nama" => "Ika Agus Prayitno, drg., MMRS",
                "level" => "II NS",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "349b9571-42d0-4863-a0b3-b0c0fb8d2c14",
                "npp" => "22062",
                "nama" => "Luluk Khulailah, Amd Keb",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "34feb1f1-7b77-4ec8-8333-425ad0e9dfd8",
                "npp" => "22048",
                "nama" => "Febrian Dwi Saputro, Amd Farm",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "350cee00-3ba8-462d-b9b2-b294eb80d393",
                "npp" => "11076",
                "nama" => "Asmanah, Am.Keb",
                "level" => "IV A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "356b9ed1-15aa-45b5-86ae-e2561857a98a",
                "npp" => "12237",
                "nama" => "Ida Nurhaeni",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "3607bd0e-84bf-4d9b-8b8e-57e8ff70708b",
                "npp" => "24307",
                "nama" => "Alfi Mahmuda, A.Md.Farm",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "3623445f-3cab-4dbc-b047-c640034ca7c0",
                "npp" => "25077",
                "nama" => "dr. Zulfakhri, Sp.An",
                "level" => "dr Sp",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "36468abb-94ff-4fb8-a0ca-fb5be90c9cf3",
                "npp" => "24165",
                "nama" => "Achmad Rian Pratama",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "36ce3f9d-2390-4c9f-aa54-539e1f5361a3",
                "npp" => "25007",
                "nama" => "dr. Petrina Kemala Dewi, Sp.PD",
                "level" => "dr Sp",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "37fa2b6d-5394-4d1a-ac62-4fd78f77e1b5",
                "npp" => "11058",
                "nama" => "Dina Daniarti, dr",
                "level" => "I B",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "380cb97b-a08f-41ee-8188-f1272fb86386",
                "npp" => "32006",
                "nama" => "Hayyu Rizky Nur Rahma, drg",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "3820bb9f-96e6-439e-8f7a-21a2e3c33576",
                "npp" => "30007",
                "nama" => "Imro'atul Muflikha",
                "level" => "N\/A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "385a75f4-46b4-4f87-9ac8-54dbadddb628",
                "npp" => "24108",
                "nama" => "Esa Kurniawati",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "386db893-3bd0-438c-9884-f14637ebd813",
                "npp" => "11124",
                "nama" => "Novie Noermalasari, Am.Keb",
                "level" => "IV A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "38984b9f-c5f8-44e2-a6af-ab3fd79c866e",
                "npp" => "34016",
                "nama" => "Khoiriyatul Dwi Rusliyana",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "396c8a17-b50c-4ab8-a93b-3974b3a8480c",
                "npp" => "24274",
                "nama" => "Rionaldy Rexy Johana Candra Negara",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "3a7cc71e-2850-4ac5-bb63-471a8ac8a8b1",
                "npp" => "11132",
                "nama" => "Andri Kusnaedi",
                "level" => "IV B",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "3a8cbff5-4bdc-4ec3-9f3a-1509406f2cf4",
                "npp" => "12109",
                "nama" => "Wahyu Ilahi",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "3ac2d0aa-dc3e-493a-b1c5-a0f50d9fc177",
                "npp" => "12368",
                "nama" => "Yasmin Nurul Azizah Salsabila",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "3ad0f799-4586-48c2-bd81-dba98c0ef72b",
                "npp" => "24301",
                "nama" => "Avira Hajar Sawitri, S.Farm",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "3aec5fc6-2f20-49c5-850f-43053ec5b0e9",
                "npp" => "34021",
                "nama" => "Fitria Tutik Handayani",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "3afb2fe7-f6b5-4e32-bb93-3754b1c520e4",
                "npp" => "12253",
                "nama" => "Hendra Sugianto",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "3b04ede0-25d1-4fe2-b954-6e3c06deeb58",
                "npp" => "11120",
                "nama" => "Rikza Ariny, Amd.RMIK",
                "level" => "IV B",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "3b82c695-1df6-4d6f-b6ea-91a925d2a78b",
                "npp" => "11089",
                "nama" => "Nopiati Puspita, AMK",
                "level" => "IV B",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "3bddbf07-21f9-4e7f-ac6c-78cba1392c11",
                "npp" => "24228",
                "nama" => "Frasetyo Hari Cahyono",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "3c0cd5d9-c760-427a-97ef-fa28338eee8c",
                "npp" => "22012",
                "nama" => "Eka Yuliana Sari, Amd Keb",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "3c6a5162-b3f1-4112-97b6-3b74bcf6b861",
                "npp" => "12350",
                "nama" => "Annisa Diyah Fitriani",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "3cb6a280-aef5-4eae-80cc-a7e9efa13955",
                "npp" => "24164",
                "nama" => "Novi Maslahah",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "3cf8e6e9-d7f7-47a3-9037-a6f33b71c802",
                "npp" => "21006",
                "nama" => "Mia Saputri Intansari",
                "level" => "II",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "3d2e7eab-25dd-4941-9ebd-326d2ebe2e52",
                "npp" => "11126",
                "nama" => "Risa Wulandari, Am.Keb",
                "level" => "IV B",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "3d978548-e2d8-401e-a4cd-3716962dea3c",
                "npp" => "12288",
                "nama" => "Evi Pandiana, Amd.Rad",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "3dc83beb-77cd-40c4-929c-56bf1d575a28",
                "npp" => "24120",
                "nama" => "Nurhidayati",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "3de2e596-0591-4048-a5fc-efcd485fe371",
                "npp" => "11136",
                "nama" => "Gita Nurwidya",
                "level" => "IV B",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "3e0978de-1009-418b-bb83-1dc8fd710572",
                "npp" => "24321",
                "nama" => "Wardatun Nafisah",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "3e2a3c0e-f64b-4099-9a31-d5ab9853fe61",
                "npp" => "24234",
                "nama" => "Novela Dinda Esperanza",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "3e52fa49-4a6c-43ab-ae12-bed69eb947e6",
                "npp" => "30001",
                "nama" => "Erlina Wahyuningtyah",
                "level" => "N\/A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "3ed21210-82a3-4f40-b1a3-904d8f6967a2",
                "npp" => "22033",
                "nama" => "Zul Adhariansyah, Amd Kep",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "3eea455a-8cb9-484c-be55-eaf17baa38ee",
                "npp" => "12113",
                "nama" => "Rizky Ayu Permatasari, S.Farm Apt",
                "level" => "IV A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "3fa1a858-8104-43a5-bdd5-628fd7ec959c",
                "npp" => "22046",
                "nama" => "Hendrik Tri Indra Yuningrat, Amd Kep",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "3ff2241b-3296-42c6-932c-330278d6ec43",
                "npp" => "35004",
                "nama" => "Arsyad Parama Santosa, dr",
                "level" => "drU",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "40462add-8858-4cf5-9f3f-2b843cbdc785",
                "npp" => "12176",
                "nama" => "Dinda Magdalena Dewi Basit, Amd Farm",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "41037fff-9692-4f74-b196-b3611e7bf378",
                "npp" => "34028",
                "nama" => "Ririn Widartin",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "4222a552-cbaa-491b-b674-be098ad8fad0",
                "npp" => "24277",
                "nama" => "Rizki Nur Azizah, A.Md.Kes",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "422da5d1-4026-4fbf-8462-f3583823da5d",
                "npp" => "35005",
                "nama" => "Nikita Bilqist Kaspia, dr",
                "level" => "drU",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "428e09a3-ea82-4841-8619-a0323dab07e2",
                "npp" => "12366",
                "nama" => "Aditya Rahman Hakim",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "42a31183-4fbf-4b29-a693-a00fc825c034",
                "npp" => "24059",
                "nama" => "Annisa Dian Sari, Amd Keb",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "430d0a21-199a-45d0-85cb-863d680da463",
                "npp" => "22065",
                "nama" => "Dayinta Bayu Restiputri, Amd Kep",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "430e529e-b006-4a9c-b428-3fb611f71415",
                "npp" => "12135",
                "nama" => "Aprillianti Nur Fitriana, Amd Kep",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "430f7195-f658-4a0d-9593-3d6ade171936",
                "npp" => "24285",
                "nama" => "Fianda Restalia, dr",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "437c4ae3-dd78-4795-84cf-a658523e8fdc",
                "npp" => "24029",
                "nama" => "Evi Dina M, Amd Kep",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "43a8db34-454f-48a9-b9ee-c02123294c3b",
                "npp" => "24096",
                "nama" => "Timur Tri Aria Chandra",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "43bf7976-17fc-448e-8abb-3c0cc4ca0ceb",
                "npp" => "24169",
                "nama" => "Ike Elly Susanti",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "43f90aa7-52ba-47e3-bf87-668e95c7a20d",
                "npp" => "21015",
                "nama" => "Sri Rahayu",
                "level" => "II NS",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "4457b53d-486e-4525-81cc-7035622e0b00",
                "npp" => "12164",
                "nama" => "Gelar Pradiana",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "45824749-6e17-454b-8791-22e6b794e19e",
                "npp" => "12319",
                "nama" => "Novita Rizky Amalia",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "45bd965a-7691-4678-8932-c3bc267733f2",
                "npp" => "12282",
                "nama" => "Windy Nadia Puspita, Amd.Kes",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "45d52ba3-3ae9-4480-8118-c648ff2a6f2b",
                "npp" => "24001",
                "nama" => "Suwandi",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "4679133b-9712-4e70-b973-c8388cedfd6d",
                "npp" => "12337",
                "nama" => "Mochamad Iqbal Septyan",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "467ad827-3730-4cf5-a5f9-f0c8b69291cc",
                "npp" => "24041",
                "nama" => "Totok Hariyanto",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "4692ca7b-4eed-4ccb-9ce0-54fab70ec3a6",
                "npp" => "11105",
                "nama" => "Cipta Pribadi Firmansyah, dr., Sp.An",
                "level" => "II NS",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "47499f8a-a7e2-41ba-a023-631dcb330420",
                "npp" => "24172",
                "nama" => "Ike Elly Susanti",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "48560b1f-dcaa-4e97-8015-1d606cd5f051",
                "npp" => "22060",
                "nama" => "Achmad Aidin, Amd Kep",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "48641e3f-9946-46c5-b03e-9634aeb7af16",
                "npp" => "34007",
                "nama" => "Nita Faradina, dr",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "48cc94f8-d6a3-4723-9b41-e7ce5769caaf",
                "npp" => "12162",
                "nama" => "Nova Astriana Supendi, Amd Kep",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "48e2efb4-f6ad-444e-a5a8-df2e8b852862",
                "npp" => "12134",
                "nama" => "Eva Nurapsari, Amd Keb",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "48edf1fc-5f18-45ea-950a-f62da44ed99e",
                "npp" => "12301",
                "nama" => "Azka Aulia Dini",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "4960b956-260a-4a21-8676-cd1e8d44b6c2",
                "npp" => "12343",
                "nama" => "Ridwan Juliansyah Resiana",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "49fb1b46-58ec-4697-b4e4-6129d7ce4799",
                "npp" => "11010",
                "nama" => "Eli Hemawati",
                "level" => "IV B",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "4a5c0e53-ac5b-4aa1-98b9-313e2bcef5f7",
                "npp" => "11141",
                "nama" => "Muhammad Fahri Rehan, S.P",
                "level" => "IV A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "4ad8bcc8-d8d4-43ee-82f4-a5e9212f6987",
                "npp" => "32007",
                "nama" => "Annisa Trifani Nur Fadhillah, drg",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "4b15081a-ddc1-4869-a2fc-5bae30c1f293",
                "npp" => "12283",
                "nama" => "Imania Rezqita Putri Yani",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "4b3700b5-c313-488d-a61d-85d698f5e354",
                "npp" => "24151",
                "nama" => "Elvina Damayanti",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "4b80a63c-baac-4220-b1a4-03e7d3408c35",
                "npp" => "30011",
                "nama" => "Stefanus Septian Yosi Putra",
                "level" => "N\/A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "4bcde816-f35f-4f06-9650-b76149e32ca0",
                "npp" => "24288",
                "nama" => "Feminar Lintang Hakiki, A.Md.Kep",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "4bdc1945-be8c-4e72-8264-6feb0bb46fae",
                "npp" => "24052",
                "nama" => "Rudi Cahyono",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "4c28e5a1-bff0-401f-956a-0cb94f2adc80",
                "npp" => "21005",
                "nama" => "Noor Affandi, drg",
                "level" => "IV B",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "4c37c8fa-707a-428c-8e2a-a45fd5125d81",
                "npp" => "24187",
                "nama" => "Nike Prasetiyaningsih",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "4c7a81f1-945d-4bf2-a410-08a79e12a035",
                "npp" => "25078",
                "nama" => "dr. Skotlastika Rani F, Sp. An",
                "level" => "dr Sp",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "4d04ddf8-a531-460d-9992-f19bca02e441",
                "npp" => "22071",
                "nama" => "Dewi Sri Wulandari, dr., Sp.PD",
                "level" => "II",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "4e309a30-7f5f-4e7d-8a39-5331fea9b883",
                "npp" => "11087",
                "nama" => "Rina Wiranti",
                "level" => "IV B",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "4ef9af00-114f-41f1-becb-eb78d01eeab9",
                "npp" => "25019",
                "nama" => "dr. Bambang Hariyatno, Sp. S",
                "level" => "dr Sp",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "501cfb47-4c14-48ac-ab29-f69a392edc94",
                "npp" => "11030",
                "nama" => "Roni Purnawan",
                "level" => "IV A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "5034714e-51a6-4429-855f-be69800cf3ea",
                "npp" => "11024",
                "nama" => "Iyam Maryati, AMK",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "50bd4fc0-561c-4c7b-b35b-3d2d60e9de68",
                "npp" => "11044",
                "nama" => "Saur Rohani, AMK",
                "level" => "IV B",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "50dee6ee-7e6b-4173-aa3e-7673a842d9c3",
                "npp" => "24258",
                "nama" => "Hikmah Tri Wahyuni, dr",
                "level" => "II",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "5104787d-f63a-4ef3-87c5-35a2a92056c3",
                "npp" => "24023",
                "nama" => "Een Ermawati, A.Md.Keb.",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "5121249e-3f2a-4256-a60c-82b85358c319",
                "npp" => "24240",
                "nama" => "Heniza Afkarina Noviari",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "5173a99e-bb0b-48b2-b4c6-8791a2e941f8",
                "npp" => "11073",
                "nama" => "Ilham Agung Baihaki, AMK",
                "level" => "IV A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "51ac3e9a-0f4d-4071-9afe-7832179ef7c2",
                "npp" => "24202",
                "nama" => "Chika Oktavia Sahara",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "51e5cba7-832a-4ae4-ab0a-9c38d12a2424",
                "npp" => "22041",
                "nama" => "Lasiyanto, Amd Kep",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "52db2946-208b-43ea-8afb-ee40e3f74ea8",
                "npp" => "11127",
                "nama" => "Daenuri, Amd.Rad",
                "level" => "IV B",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "52f946b5-dfe8-443e-ad42-0be488c99b2e",
                "npp" => "24237",
                "nama" => "Nadia Silvi Fernia Agustin",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "52fe37a8-af8c-450b-aad1-acdd1068da33",
                "npp" => "30031",
                "nama" => "Destya Olivia Ayucandra, Amd.Keb",
                "level" => "N\/A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "52feac97-90a8-4f81-adb8-e3f97ecbd91b",
                "npp" => "24075",
                "nama" => "Rose Rona Aisyah",
                "level" => "IV A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "533f30ce-06aa-4517-ba9e-3442a49e7e5b",
                "npp" => "12383",
                "nama" => "Bima Anggara",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "544ee4c4-a69b-44c7-b6aa-41a04db9cee7",
                "npp" => "24180",
                "nama" => "Fitriya",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "55234d3d-a4b7-4a87-9a9e-2670429f8181",
                "npp" => "12339",
                "nama" => "Susi Sundari",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "558ef886-a47e-4e5d-bd91-8ddca2816e43",
                "npp" => "24198",
                "nama" => "Arif Ridho Hidayat",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "55ae15f0-c984-42c5-8618-b957f71b86f2",
                "npp" => "12349",
                "nama" => "Diana Ulfah",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "56392622-62af-4b12-96c2-d12403747b94",
                "npp" => "24201",
                "nama" => "Desi Alif Nurdianti",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "567314a7-8a4c-44e6-9cc0-4b27547404a5",
                "npp" => "12257",
                "nama" => "Ineu Apriani",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "56b094f7-68b7-4c53-b0cc-c26a8aafbeb1",
                "npp" => "34023",
                "nama" => "Rieza Rizqy Alda, dr",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "57204119-e7ed-4504-ba45-b84700e88cb9",
                "npp" => "12336",
                "nama" => "Siti Nurpatimah",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "576ccadf-a85b-4d30-af7e-dc7a920bb16a",
                "npp" => "34020",
                "nama" => "Rosica Panji Pradani",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "5795fa41-e6d6-4822-88e8-063c7ebb8c60",
                "npp" => "24226",
                "nama" => "Aden Meilian",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "599657cc-a355-4f91-b430-d5c9ebf0f7d7",
                "npp" => "12390",
                "nama" => "Novita Indah Fitriyani",
                "level" => "II",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "59cc0aba-d471-40e8-8e26-8179ee0209de",
                "npp" => "12341",
                "nama" => "Moch Rizky Nurul Ichsan",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "5b5119f5-d171-49e8-a044-80ab49f7535c",
                "npp" => "12354",
                "nama" => "Revi Rosalinda",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "5be9aeb8-3874-4ab3-8095-55a38b2e07cf",
                "npp" => "24245",
                "nama" => "Intan Purnama Sari",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "5c4b1774-050f-426f-a641-d0f64d2a9654",
                "npp" => "32009",
                "nama" => "Merisa Surya Septian",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "5d6b4098-ff7c-4b1a-986d-666b846671b4",
                "npp" => "22051",
                "nama" => "Asri Wuria Ningrum, Amd Kep",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "5d9d1548-7f0d-4388-ab37-3958e2c0fcd8",
                "npp" => "24255",
                "nama" => "Wardah Khoirunnisa Faludi",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "5dcd497a-5f5d-4785-8713-62427a64b7ad",
                "npp" => "24263",
                "nama" => "Warsito",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "5e3822b9-6cb6-426a-ba4e-5e0fdf3df188",
                "npp" => "11036",
                "nama" => "Sukamto",
                "level" => "IV A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "5ea5ee0c-7784-4908-a2a3-e064c624980f",
                "npp" => "21018",
                "nama" => "Winda Triwilianti, Amd Kep",
                "level" => "IV A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "5eee2832-f048-4fd2-972f-9b883bf6e1f2",
                "npp" => "34012",
                "nama" => "M Firman Rizaldi",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "5ef0e420-df76-4209-8dd1-e4294ee22062",
                "npp" => "12115",
                "nama" => "Iftitah Rahmi, S.Farm Apt",
                "level" => "IV A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "5f03fc95-07cf-4c41-be2d-32b232089ce6",
                "npp" => "12309",
                "nama" => "Nisa Tazkiatun Nupus",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "5f9a5049-ba6d-4847-883f-5ac816cf02aa",
                "npp" => "32008",
                "nama" => "Shaffa Auliya Farida",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "5fc4ca7f-1f92-48b5-abc9-6d4d25306a95",
                "npp" => "30035",
                "nama" => "Nailatul Chusna, A.Md.Kep",
                "level" => "N\/A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "600ea5cb-9e81-4d19-88e2-bdd11b877d6e",
                "npp" => "22069",
                "nama" => "Wika Yuli Deakandi, dr",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "60f1155b-4d13-41bf-87e4-2948a598464c",
                "npp" => "11032",
                "nama" => "Wiwin Nurhayati, AMK",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "612d35aa-00e3-4be9-88b5-865225148435",
                "npp" => "11057",
                "nama" => "Kusniyati",
                "level" => "IV A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "6192b9f7-c469-4346-9801-9b9250f5ba4b",
                "npp" => "25073",
                "nama" => "dr. Adhi Satriyo Utomo, Sp.OT",
                "level" => "dr Sp",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "61ff943d-7f7a-40a1-82af-29677580d539",
                "npp" => "12156",
                "nama" => "Siti Aah Robaeah, Amd",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "631c18f0-8739-4820-956f-d2b1072bda4b",
                "npp" => "12154",
                "nama" => "Hanggara Tri Laksana, Amd Kep",
                "level" => "IV A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "6341658d-b8fa-4ae6-a3cb-ab8d6abe8744",
                "npp" => "11046",
                "nama" => "Nita Widaningsih, AMK",
                "level" => "III NS",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "634f3311-4c64-418b-9abc-f52cfdb486de",
                "npp" => "25022",
                "nama" => "dr. Ersty Istyawati, Sp. THT-KL",
                "level" => "dr Sp",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "6358a2ba-40ae-4be4-a4fb-688b1bced7bf",
                "npp" => "11018",
                "nama" => "Dadang Adiana",
                "level" => "IV B",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "63e7d16b-ded5-409a-bee9-ebfcde06b4b5",
                "npp" => "21004",
                "nama" => "Isnani",
                "level" => "IV A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "63fe431f-ecf6-45d9-8f95-e060b1335237",
                "npp" => "24066",
                "nama" => "Supaijin",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "643ce7e6-eb77-4607-acd2-9214ce126d7d",
                "npp" => "12414",
                "nama" => "Utami Yulianingsih",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "646a6e18-1562-46c4-aea9-b71c6774639f",
                "npp" => "12419",
                "nama" => "Rijaludin",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "651e29a9-ea41-41d2-8eb6-cc2fd7b86f49",
                "npp" => "24072",
                "nama" => "Nora Nur Rokhmah",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "661fd7fc-935c-4e6e-975f-49c753e56f65",
                "npp" => "30008",
                "nama" => "Mochamad Nofan Afandi",
                "level" => "N\/A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "67380a85-cd22-43fc-82cf-fdefe85b8bbd",
                "npp" => "12422",
                "nama" => "Meirza Selsar Triasya",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "67a0b57f-313c-403e-ab3a-4fe18bdc464b",
                "npp" => "12427",
                "nama" => "Devi Setiani",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "68281402-7752-4b0e-a04b-ad105b6fdfe6",
                "npp" => "12128",
                "nama" => "Putri Puja Lestari, AMKeb",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "684421f3-eebb-46a7-8c92-137340d61b87",
                "npp" => "12314",
                "nama" => "Hanif Fadhilah",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "684f5724-2bda-49f4-b051-5a6b501610ea",
                "npp" => "34024",
                "nama" => "Sinta Nur Hayati",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "68df23b0-5b05-4d0c-964d-8f8f444500ad",
                "npp" => "32011",
                "nama" => "Dita Putri Septiani",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "68ee9760-9047-4f27-9380-aa0208206112",
                "npp" => "25036",
                "nama" => "dr. Fahmy Rusnanta, Sp. JP",
                "level" => "dr Sp",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "6916d4ee-bd5e-48c9-8824-9daae9756a79",
                "npp" => "24264",
                "nama" => "Dony Aris Fianto",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "69fc304c-08b7-414d-942f-30e07a81b050",
                "npp" => "11054",
                "nama" => "Yani Mulyani, AMK",
                "level" => "IV A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "6a004170-f717-4a9b-8bde-03b69d81babd",
                "npp" => "12299",
                "nama" => "Revi Cahyani Wulandari",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "6a1971d3-0ecf-4bf2-a504-04dc35f004f8",
                "npp" => "24177",
                "nama" => "Een Ermawati, A.Md.Keb.",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "6a6397d7-38c5-4cb8-b208-5020f978cd69",
                "npp" => "12137",
                "nama" => "Gina Trihandayani, S.Farm Apt",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "6aa08e98-807c-4f8f-a772-ae963b0b77ae",
                "npp" => "12179",
                "nama" => "Ainun Nuraeni",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "6adbde2b-cfe0-46f4-92d4-108c5c27e182",
                "npp" => "24316",
                "nama" => "Novita Sari",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "6af68b24-1b12-478b-852c-ea04f7732cea",
                "npp" => "12428",
                "nama" => "Afiyah Hadianti Pangasih Lembana",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "6b28a036-f9ee-40f6-9517-66d9cc9c4376",
                "npp" => "30019",
                "nama" => "Nikita Amelia Arsita",
                "level" => "N\/A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "6e0e74e8-7088-4983-a4c3-67ce4260ecde",
                "npp" => "12206",
                "nama" => "Frendy Nugraha",
                "level" => "IV A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "6ec991a0-c132-4474-b4a8-a5be8fb11897",
                "npp" => "12405",
                "nama" => "Khanizar Kadaruloh",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "6ed89b6d-80c0-4a56-aa78-5d39246c0335",
                "npp" => "12392",
                "nama" => "Ardi Fadliansyah",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "6f9a2894-6083-4b08-9d89-30b5c18bf0bb",
                "npp" => "22081",
                "nama" => "Rusman Hadi Santoso",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "6fe2a9fa-c20e-4cb4-9008-74c17a4fe933",
                "npp" => "12380",
                "nama" => "Febriansyah",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "6fe996ec-f17b-415f-969c-9a8927ac4d48",
                "npp" => "11052",
                "nama" => "Zul Kurniawan, dr., MMRS",
                "level" => "I A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "6ff9d2ea-88d7-4ca8-8f04-3b8e16a9c562",
                "npp" => "12358",
                "nama" => "Irma Juanita",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "7013b2e4-a57d-4bf8-846b-46c1dfc14310",
                "npp" => "11007",
                "nama" => "Nana Sutisna",
                "level" => "IV A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "70308064-58c4-4834-97d0-57af5feae535",
                "npp" => "11108",
                "nama" => "Kartika Rizki Nugraheni, AMG",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "705eb227-3374-4c66-918d-750451cd7618",
                "npp" => "25030",
                "nama" => "dr. Dechrist Yohanes Eddy Wibowo, Sp.M",
                "level" => "dr Sp",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "70bb3902-d995-42ca-960c-92876e6e2d7b",
                "npp" => "11060",
                "nama" => "Yulia Indra Rahayu, AMK",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "712ffbbc-1dff-4b0e-9f78-24c43c7e5f14",
                "npp" => "11090",
                "nama" => "Firman Yulhamsyah, S.Pd",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "7194b7ca-093e-4919-a48b-a06d9980a856",
                "npp" => "11001",
                "nama" => "Rina Solihah",
                "level" => "IV B",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "71b3e93c-8a66-46f7-b482-e95c09275865",
                "npp" => "12279",
                "nama" => "Wina Bella Nur Iksani",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "723cd5d0-0027-4970-a592-fee97ec14302",
                "npp" => "11029",
                "nama" => "Winda, SE",
                "level" => "II",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "724a7470-8de6-4130-bcb5-b422a19c34b2",
                "npp" => "24241",
                "nama" => "Mochammad Yusril Rizkyawan",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "726a4efe-48dd-4fcc-8807-acd829382002",
                "npp" => "22055",
                "nama" => "Sheren Bella Ridca, dr",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "732c0d5d-2e75-4121-972f-c5a5187f2b99",
                "npp" => "22073",
                "nama" => "Inayatul Afiyah",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "73c81b4c-abe8-44a0-897e-fc5a3170fb70",
                "npp" => "12388",
                "nama" => "R. Adhika Putra Sudarmadi, dr",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "74d1384d-1513-458c-ad53-9a51eec083ba",
                "npp" => "24199",
                "nama" => "Desi Alif Nurdianti",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "75e4c179-7c56-4009-ace2-489ffe503b99",
                "npp" => "12394",
                "nama" => "Neng Seni Agustine",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "76066374-c22b-41af-8f50-09737e211787",
                "npp" => "34009",
                "nama" => "Susiana",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "76fb4af5-bc8e-48ed-9a54-58d8d45373bc",
                "npp" => "34025",
                "nama" => "Ninik Nurma Wati",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "77163814-ff36-44a1-b080-291ff726ff2f",
                "npp" => "11100",
                "nama" => "Endah Aprianti",
                "level" => "IV B",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "772e9f72-7aca-437d-8736-072a6616589d",
                "npp" => "12412",
                "nama" => "Yuan Astriani",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "781b37a0-68ce-4b56-b08c-0750f9edfe55",
                "npp" => "24106",
                "nama" => "Ninis Dwi Pratiwi",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "782c1a59-aab3-4856-bf34-662a64094c45",
                "npp" => "30012",
                "nama" => "Riyan Bagus Dwi",
                "level" => "N\/A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "79ef50fb-4382-4de4-8278-60b47fcaff7e",
                "npp" => "24085",
                "nama" => "Eli Yeni Ermawati, Amd Kep",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "79f804a0-2ea2-496c-93e1-312c7c4e22e1",
                "npp" => "25063",
                "nama" => "Feny Damayanti, dr",
                "level" => "dr U",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "7a57fcde-522a-424e-a535-c40f8aaba852",
                "npp" => "12426",
                "nama" => "Laksmana Putra Perbawa",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "7ba50ae2-6d22-4b4e-a3a6-6fa45564d55d",
                "npp" => "34017",
                "nama" => "Ahmad Faisol",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "7ce949b9-3cfb-4819-99f3-aec03426fccd",
                "npp" => "24208",
                "nama" => "Novela Dinda Esperanza",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "7ce9fb12-81fb-4b9e-abff-93086ac7e3e5",
                "npp" => "11114",
                "nama" => "Dini Novita Lestari, Am.Keb",
                "level" => "IV A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "7d44c4c2-78ad-4947-8599-497d0cd71c93",
                "npp" => "11012",
                "nama" => "Eulis Wanridah, Amd.AK",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "7d7304e2-39cd-4914-bc83-3ebf7b70a44d",
                "npp" => "11043",
                "nama" => "Novi Nurbayanti, Amd.Perkes",
                "level" => "II",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "7e69b07e-b8e8-4e3a-9ca1-f4ab672a20b0",
                "npp" => "12316",
                "nama" => "Puzy Agustiani",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "7e764326-5637-4759-8865-fc0d8d4fd31f",
                "npp" => "12418",
                "nama" => "Tommy Ainul Azhar",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "7eaf65ff-f420-4cea-be22-09e3351ddc2d",
                "npp" => "11051",
                "nama" => "Rika Rosdiana",
                "level" => "IV A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "8080f051-4d58-46cd-ad04-07630fa63051",
                "npp" => "24074",
                "nama" => "Nabela Chitra Santika, Amd Kep",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "81fdd037-61e7-493c-9abe-918ed0520ff9",
                "npp" => "12359",
                "nama" => "Annisa Firly Novian",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "82029fde-2bb0-48f9-8341-549919d8d8e8",
                "npp" => "24259",
                "nama" => "Yeni Octavia, dr",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "823abcc8-5b1e-49d2-81a3-2f7b3d1352c8",
                "npp" => "22006",
                "nama" => "Rizkha Nanda Pramita, Amd Gz",
                "level" => "IV A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "8270f1f9-c2b7-446b-a7c4-5d36871b1e18",
                "npp" => "24239",
                "nama" => "Aden Meilian",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "82b28715-8cf4-4762-ba99-d5c21c6dfdb9",
                "npp" => "24043",
                "nama" => "Nanang Setyawan",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "82d5da17-a4a2-4114-8ecd-28b7d10a4ab6",
                "npp" => "24067",
                "nama" => "Nurul Huda, Amd Kep",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "8386cc57-576c-4a6f-80ac-290d908e0189",
                "npp" => "11096",
                "nama" => "Erlin Kartikawati, AMK",
                "level" => "IV A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "83fe1e16-9d33-469a-9136-b70544a26f11",
                "npp" => "12313",
                "nama" => "Teti Aprianti",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "846811ae-95c6-4bbc-a7f8-53e56609ef8f",
                "npp" => "24322",
                "nama" => "Laila Cholistin",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "84d1a145-08b6-43b2-805e-0e6c2ea2afa3",
                "npp" => "24068",
                "nama" => "Dian Sofianto",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "852d6fa3-6d6f-4d3a-b2bc-9264e8dd8252",
                "npp" => "24242",
                "nama" => "Yulia Agustia",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "86e71110-23d2-43a3-bac8-d89964a5d304",
                "npp" => "12270",
                "nama" => "Dian Dahlia",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "8736182e-c889-4e65-a79a-8c051995d334",
                "npp" => "12254",
                "nama" => "Dwi Agung Pamungkas",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "87715b61-53bc-4d99-9aa3-d1ca88211cf3",
                "npp" => "11083",
                "nama" => "Sya'adudin Ardiansyah, AMK",
                "level" => "IV B",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "87df9678-fa41-4513-9ff0-e6e04f6e538e",
                "npp" => "24250",
                "nama" => "Lailatul Masruro",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "881161e8-305d-4a62-abe5-828e6799e9ef",
                "npp" => "25075",
                "nama" => "dr. Milanitalia Gadys Rosandy, Sp.PD",
                "level" => "dr Sp",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "88325af6-43ba-484f-bf9e-a53a732a073b",
                "npp" => "21019",
                "nama" => "Nofi Astutik, Amd Keb",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "893233ec-ffd2-4e8c-89f9-b5c2cd6782b2",
                "npp" => "24010",
                "nama" => "Sri Wahyu Rika Asih",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "89ba1b69-b859-4190-b608-d636346c325a",
                "npp" => "12421",
                "nama" => "Yogi Hidayaturizki",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "8a70d2a5-4650-4d4b-b8a8-61dddd99722a",
                "npp" => "11088",
                "nama" => "Indro Purnomo, AMK",
                "level" => "IV A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "8ac45eb7-0342-48ed-a49d-b4f4d3013c86",
                "npp" => "25025",
                "nama" => "dr. Andra Prasetyawati, Sp Rad",
                "level" => "dr Sp",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "8b3ea86a-cce7-4406-9db5-853c44ff860e",
                "npp" => "24325",
                "nama" => "Sandi Dwi Kuncahyo, dr",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "8b515da8-4b35-422c-8d06-25aa0c304899",
                "npp" => "12312",
                "nama" => "Anita Septiarini, Amd.RMIK",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "8bec0a4b-5a48-4a95-b09e-761b6c022344",
                "npp" => "12351",
                "nama" => "Intan Saputri",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "8bf7ab77-67f0-4b4f-9a29-39cd01746ca1",
                "npp" => "12295",
                "nama" => "Widyatami Regine",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "8c4df407-63ae-49de-b638-71cac3e95664",
                "npp" => "24136",
                "nama" => "Fatimatus Zahroh",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "8c7675de-9e92-4a0e-bede-233313dc58c8",
                "npp" => "11041",
                "nama" => "Wiwit Ari Sopian, S.T",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "8ccadad5-afb6-4f11-bd65-c0dad126f3c0",
                "npp" => "12406",
                "nama" => "Muhammad Ma'ruf Albadri",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "8d5f226e-52fc-471f-bd6d-3b65b7441225",
                "npp" => "25005",
                "nama" => "dr. Hanafi, Sp. B.",
                "level" => "dr Sp",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "8ecf6b0b-75fe-4a43-898a-8913ec39e1ee",
                "npp" => "24101",
                "nama" => "M Abdur Rohman, Amd Kep",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "8f6d9167-3e66-4e53-9ed5-5579055ad482",
                "npp" => "24026",
                "nama" => "Ika Nur Choiriyah",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "8f6f2f5a-24bd-4504-989f-582243b524bf",
                "npp" => "24211",
                "nama" => "Moch Khusni Mubaroq",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "8fdff22f-8c86-4e2e-8131-8228a1742f62",
                "npp" => "11055",
                "nama" => "Eli Hasanah",
                "level" => "IV A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "90949b23-bdc2-46e2-91ad-3b2211b89df5",
                "npp" => "11050",
                "nama" => "Heny Puspita, AMK",
                "level" => "III NS",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "91182f5d-7b20-4254-9001-59fb04d4bd9f",
                "npp" => "24284",
                "nama" => "Errika Nur Cahyani, A.Md.Kes",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "9135e3b6-369e-421a-8154-8a1c030bf180",
                "npp" => "24286",
                "nama" => "Dewi Martinda Hartono, drg",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "9145da52-4f1f-4945-ab4d-248282a598ad",
                "npp" => "22061",
                "nama" => "Herlinda Putri Oktabiyati, Amd Kep",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "914b0e76-bb9f-418d-83f3-ad8f8a3e0f92",
                "npp" => "22068",
                "nama" => "Ikka Tientus, dr",
                "level" => "II",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "91d33224-c59d-470c-99ab-3b932c842986",
                "npp" => "12311",
                "nama" => "Vebby Agisna Nurani",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "92474849-8932-4038-9ece-b00da7dc23d8",
                "npp" => "22052",
                "nama" => "Qurrotul Ayunin",
                "level" => "IV A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "938e5bc8-c09c-4e50-8be4-16c1859528fc",
                "npp" => "11128",
                "nama" => "Irlena Apriliya, Amd.RMIK",
                "level" => "IV B",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "93c780fe-5615-49c4-a709-e7aadd255ca5",
                "npp" => "24289",
                "nama" => "Donny Farid Budiharto, A.Md.Kep",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "94189e52-76b0-4de6-94fe-d7e122520662",
                "npp" => "24249",
                "nama" => "Yossi Ajeng Pratiwi",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "944ecffa-4296-48d5-9df2-c19fc673b67f",
                "npp" => "34019",
                "nama" => "Salma Lutfia Azzahra",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "94f46e06-d698-4cd2-b235-5cffa6a27644",
                "npp" => "24236",
                "nama" => "Dina Erlinda",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "9509521e-1ea4-4931-860a-6d6ea344e7a1",
                "npp" => "12286",
                "nama" => "Winda Jayanti",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "950ff574-db7a-42db-be4c-94a7be6c50ec",
                "npp" => "12298",
                "nama" => "Ati Febrianti",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "95930eab-772b-4293-b233-ad86aff52d04",
                "npp" => "12268",
                "nama" => "Selviya Nurul Baety",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "95d3775e-ed04-4a61-b005-f81b86f502b5",
                "npp" => "24281",
                "nama" => "Nur Avivatur Rohmah, A.Md.Kes",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "961d2bcf-a255-4127-86b2-cc8383418315",
                "npp" => "22072",
                "nama" => "Yuwana Hadi Wirawan, Amd Kep",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "96408cb4-044a-490a-a10e-72c6f653a6ec",
                "npp" => "11123",
                "nama" => "Veryssa Maharani Widjaya, AMK",
                "level" => "IV A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "9671f103-b71c-4129-9f2a-afa749c727ab",
                "npp" => "11082",
                "nama" => "Dewanti Fitriani, Amd.RMIK",
                "level" => "IV A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "9688e7aa-61be-43a5-b325-568609cc4578",
                "npp" => "12215",
                "nama" => "Wanda Suryana",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "96b5a959-a348-4d53-88da-81efb068dbcc",
                "npp" => "24182",
                "nama" => "Nike Prasetiyaningsih",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "97203757-45f4-4277-9b14-a08005d46b71",
                "npp" => "11022",
                "nama" => "Endry Lesmana",
                "level" => "IV B",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "9770bae2-72f5-4d1f-9865-4cfb57a4604e",
                "npp" => "12307",
                "nama" => "Ririn Restiana Putri",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "979507f1-95c7-4df2-805a-d38177dc5d94",
                "npp" => "34026",
                "nama" => "Liuk Irawati, dr",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "97d15b4e-2e01-4b05-9e04-15bf037799ee",
                "npp" => "11071",
                "nama" => "Nunu Nugraha, AMK",
                "level" => "IV A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "97ef2d34-c80d-47df-b701-0150644b8efa",
                "npp" => "22044",
                "nama" => "Roni Ilhami Wijaya",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "987d4788-52c3-45b3-9fdd-a217966a65cd",
                "npp" => "12431",
                "nama" => "Ai Imas",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "989e8e87-19aa-4c78-b008-2790c2a0519b",
                "npp" => "25068",
                "nama" => "dr. Griesinta Trianty Andria Pinahayu, Sp.PA",
                "level" => "dr Sp",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "98d19316-8441-44ef-a9cb-f11c8bf5e61d",
                "npp" => "12402",
                "nama" => "Yudi Rahadian Fauzi",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "99080670-8f65-44a5-aada-2c4ea3b2fd08",
                "npp" => "12300",
                "nama" => "Risma Tri Herdiyanti",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "99481a96-6b4b-4912-8024-82fd14965d50",
                "npp" => "11133",
                "nama" => "Fatmawati",
                "level" => "IV A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "99c253a7-172d-4d94-83ea-00896e4358ad",
                "npp" => "24296",
                "nama" => "Bimbi Wahyu Anggraini",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "9a5d45f4-ab3f-49d0-9e4b-d41401b820a0",
                "npp" => "32001",
                "nama" => "Yudan Marfiansyah, Amd.Kes",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "9a9e84d0-e7b1-44e8-b461-eb6327df9146",
                "npp" => "12345",
                "nama" => "Idad Ashari",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "9ad8ac89-3797-4775-b379-2f13de850a4f",
                "npp" => "11106",
                "nama" => "Devi Amalia, Amd Farm",
                "level" => "IV B",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "9b5abdb0-aab3-4b41-8b1c-9d644b35dd3e",
                "npp" => "30020",
                "nama" => "Wahyu Widayanti",
                "level" => "N\/A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "9b8f8c20-e431-439a-af43-cdd7b3f23d8b",
                "npp" => "21009",
                "nama" => "Dini Mulyaningsih",
                "level" => "II",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "9bea0397-8a43-4a9e-a04f-f9775ad1372f",
                "npp" => "11119",
                "nama" => "Fauzi Rahmatulloh, AMK",
                "level" => "IV A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "9c0e81e0-ba19-4ce8-9065-ce80e3f28d75",
                "npp" => "24073",
                "nama" => "Iwan Setyawan, Amd Kep",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "9c9169eb-46f3-4908-a42f-453ed982035c",
                "npp" => "12131",
                "nama" => "Suryadi, Amd Kep",
                "level" => "IV A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "9c9eaa3f-04bc-4fda-beb9-f1cb8cc14b0a",
                "npp" => "24320",
                "nama" => "Alfi Nur Diana",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "9d75aa29-2e07-49c7-b591-3af7bfe8c0e9",
                "npp" => "22063",
                "nama" => "Anton Dwi Cahyono",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "9de778d8-2816-472d-822a-50c3f3c95c24",
                "npp" => "24162",
                "nama" => "David Setiyawan",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "9f7942d3-a65e-4f03-bea1-5633479ac461",
                "npp" => "11048",
                "nama" => "Ani Mulyani, SE",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "9fb3b57f-792a-4578-9b60-1ce5b439b95b",
                "npp" => "22084",
                "nama" => "Agustina Tri Wahyuni",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "a03267ed-06eb-41d6-aae7-76ce32782d20",
                "npp" => "11072",
                "nama" => "Arum Susilowati Subhari, dr",
                "level" => "II",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "a06a68dd-cc3a-4d53-98b6-c45241be512e",
                "npp" => "24278",
                "nama" => "Deva Gita Carresa, A.Md.Farm",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "a0e84b87-5ad4-4c85-9392-e5c35975b17f",
                "npp" => "30039",
                "nama" => "Rodhotul Janah",
                "level" => "N\/A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "a110c4d2-4c1b-4763-8d42-b64838059509",
                "npp" => "12315",
                "nama" => "Erna Melinda Subandini",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "a15ab745-a700-4cd5-9236-9ea9e6023788",
                "npp" => "12424",
                "nama" => "Khilda Azmi Zulfani",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "a1708402-1201-4977-9441-9df8c2184f36",
                "npp" => "11099",
                "nama" => "Resya Dwi Fujawati, AMK",
                "level" => "IV B",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "a170cd40-addd-43c5-8dcc-7592fa2fdf1d",
                "npp" => "11063",
                "nama" => "Yayuk Nuryanah",
                "level" => "IV B",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "a1785b64-48d1-4cb0-8737-b82b2cfb5c7f",
                "npp" => "12258",
                "nama" => "Aji Imam Muhammad, S.Kep",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "a17d7523-ba5a-449c-b17d-7ccf56652015",
                "npp" => "12152",
                "nama" => "Dona Marsela Febriani",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "a1924aa2-7bee-4b7b-98f7-cf934d53994a",
                "npp" => "11061",
                "nama" => "Umi Sulistyowati, AMK",
                "level" => "IV A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "a28125de-2545-466f-8518-a4b3b8075fea",
                "npp" => "11107",
                "nama" => "Siti Evriani Nurjanah, Amd.Rad",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "a2a39a50-f8a3-4d52-80eb-5d167fabe7be",
                "npp" => "12266",
                "nama" => "Monica Octaviani",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "a31d49c4-b69f-4261-9dad-810d6347e62f",
                "npp" => "11059",
                "nama" => "Aris Susanto, Amd.Perkes",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "a45745b4-44be-45d3-b747-9c1015681718",
                "npp" => "22049",
                "nama" => "Arip Hariyanto",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "a4624651-2c0b-4cea-a2e6-eb395e702259",
                "npp" => "11003",
                "nama" => "Dede Juhana Kusnadi",
                "level" => "IV B",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "a49e52c9-1c22-4e9d-8b3a-5b40d98f207e",
                "npp" => "34004",
                "nama" => "Hesti Rosalina , dr",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "a4a5819d-42be-439a-a43c-b404cafeed40",
                "npp" => "24173",
                "nama" => "Husnul Cholilah",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "a4a73bf3-c306-4259-9bec-7369f137c1a4",
                "npp" => "24216",
                "nama" => "Nadia Silvi Fernia Agustin",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "a533ad4c-2442-4f64-a3b8-2b734d22d4c6",
                "npp" => "30040",
                "nama" => "Yusnik Aliwafa, A.Md.Kep",
                "level" => "N\/A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "a5b467d5-6042-4695-946f-4ffa41e43647",
                "npp" => "12329",
                "nama" => "Eneng Intan Nurpitasari",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "a64506ca-537d-4224-8c0f-9a52b83692dd",
                "npp" => "12133",
                "nama" => "Rifki Saepul Malik",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "a67bcd81-4130-4570-aa51-79b6a6050123",
                "npp" => "11121",
                "nama" => "Ahmad Hafidz, dr., Sp.A",
                "level" => "II NS",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "a713ca21-9055-4a0b-861f-34de704e272c",
                "npp" => "32003",
                "nama" => "Rachmi Dwi Kuswanty, Amd Kes",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "a72e33fa-3e59-4264-93c2-07aad9970b1c",
                "npp" => "12335",
                "nama" => "Kusmiati",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "a7cdf119-a1cb-4798-bca9-768038503890",
                "npp" => "12327",
                "nama" => "Heni Khoerunnisa",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "a8315628-ec82-40a8-808e-3a6fd54311c2",
                "npp" => "12375",
                "nama" => "Sani Safrizal",
                "level" => "II",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "a8ba2da0-7b35-4eaa-aa8e-5f67142ab789",
                "npp" => "12321",
                "nama" => "Muhammad Robby Rachman, Amd.KL",
                "level" => "IV A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "aa0b23cd-e246-44df-a047-f58b85536afa",
                "npp" => "24115",
                "nama" => "Ariandita Dwi Prasetyo",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "aa1c26ca-37c7-4d29-8089-ce99bc5a5fb3",
                "npp" => "24300",
                "nama" => "Rif'ah Fina Maulida",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "aa24ce0c-7187-42dc-af67-fa6db01cdbdb",
                "npp" => "12364",
                "nama" => "Lisda Areska",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "aa2dd502-99fb-44a2-9074-c43b798792aa",
                "npp" => "12396",
                "nama" => "Fajrin Walimatussa'adah",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "aa3804da-7e5a-49d2-82fe-4a7714ea007e",
                "npp" => "24080",
                "nama" => "Setia Wulandari",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "aa45d1e1-581d-45bb-aba8-e6f583388ee7",
                "npp" => "24193",
                "nama" => "Titin Tri Mulyani",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "aac104aa-3dc4-4975-b704-b226ae056300",
                "npp" => "12324",
                "nama" => "Annisa Rachmania, AMK",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "ab3c2c32-4585-417c-a744-7d3ce9c1325c",
                "npp" => "12377",
                "nama" => "Nur Amalina",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "ab5c4eb6-bc05-4f41-ae8d-11f2cea232f6",
                "npp" => "12302",
                "nama" => "Dini Listiawati",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "ab9e022e-4cc0-42a4-a4a0-5a29c9b80872",
                "npp" => "22047",
                "nama" => "Defit Agus Susanto, Amd Kep",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "aba3e905-17ad-46c9-81ce-dd7ca2921b77",
                "npp" => "24231",
                "nama" => "Hendra Apriliyanto",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "abb79df0-a29b-412e-abf9-adb3a5d9334b",
                "npp" => "12192",
                "nama" => "Sani Nuroktiani",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "ac207266-3695-459c-bc6b-3e2acaffb6da",
                "npp" => "24298",
                "nama" => "Novita Wulansari",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "acb7065e-cbbd-4f27-a5cc-b0a223452df0",
                "npp" => "24306",
                "nama" => "Aji Tama, A.Md.Farm",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "accf4de1-ba13-4ce3-b25d-915d16292c56",
                "npp" => "24279",
                "nama" => "Mujiati, A.Md.AK",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "ad30ca2d-dc09-4668-a7f4-623fade5e409",
                "npp" => "24050",
                "nama" => "Tantowi Bagus Prasetyo, Amd Kep",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "ad9bd361-dc4d-4805-a96f-ca2951d65576",
                "npp" => "24309",
                "nama" => "Rendy Jati Arbianto, A.Md.Kes",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "ae22b1bd-4953-4c9f-b309-ba30769e13c9",
                "npp" => "22028",
                "nama" => "Indri Rahayu",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "ae39ac09-7f94-4091-89b3-c640c942e707",
                "npp" => "24257",
                "nama" => "Andro Abraham Damanik, dr",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "aeedb976-b210-45b2-b5e6-bf78fbce423c",
                "npp" => "11111",
                "nama" => "Rani Febriyani",
                "level" => "IV B",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "af3a5810-4416-4dee-bdce-e96a91babf20",
                "npp" => "12432",
                "nama" => "Yosa Adisti",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "af5d3da0-e772-4d9c-b071-222c8ab81412",
                "npp" => "24215",
                "nama" => "Fera Mazroatul Ulya",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "b0218c1f-6388-4e7d-b0e1-7f0b87cc3d7a",
                "npp" => "24252",
                "nama" => "Nova Yulia Wulandari",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "b0862175-05dc-4cc5-96d1-ac7e540006eb",
                "npp" => "24044",
                "nama" => "Supriyono",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "b0e0058a-ec2b-4610-8d0d-0db3f5d9c3d0",
                "npp" => "25070",
                "nama" => "dr. Dion Juniar Fitra, Sp.OG",
                "level" => "dr Sp",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "b1566fbe-1e12-477f-88c2-66d845655565",
                "npp" => "22079",
                "nama" => "Eka Putri Radotul Jannah, Amd Farm",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "b17876ea-2683-470e-bd09-05e64d27b267",
                "npp" => "11019",
                "nama" => "Sri Sudarni",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "b17f2257-5240-4c18-91da-4a2ae3279697",
                "npp" => "11039",
                "nama" => "Nurhalim, AMK",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "b1f2f257-0c4a-4948-8959-03cdc12f5f2e",
                "npp" => "24103",
                "nama" => "Harmoko Dwi Prasetyo",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "b25f3e76-c13c-4688-8a67-9f3b5bd1ad52",
                "npp" => "24033",
                "nama" => "Inayatul Afiyah",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "b2ef7b89-df52-4889-a0d0-e7956dfc159d",
                "npp" => "24318",
                "nama" => "Lafifah Amalia",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "b33237ce-42e6-4cb7-80da-83ce824168ef",
                "npp" => "12326",
                "nama" => "Imas Herna Komalasari, AMK",
                "level" => "IV A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "b36997ab-0ac0-4ccf-a9f8-07f4fdc342a7",
                "npp" => "21007",
                "nama" => "Nana Rohisnaini",
                "level" => "II",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "b38c7c34-751d-4278-9731-b87c0401d266",
                "npp" => "10022",
                "nama" => "Lia Yuliani",
                "level" => "0",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "b3f57c85-f146-4434-af5f-f327aaf23919",
                "npp" => "24110",
                "nama" => "Achmad Nurroziqin",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "b4125061-c7ca-4a4f-99af-fc2b86e862fd",
                "npp" => "30022",
                "nama" => "Istiqamah",
                "level" => "N\/A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "b4769b4e-fdc5-4e44-8390-a0484582dcaa",
                "npp" => "24049",
                "nama" => "Eka Putri Radotul Jannah, Amd Farm",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "b53a9416-582b-4042-b791-2f188d765b71",
                "npp" => "33001",
                "nama" => "Novia Siti Fitriyani",
                "level" => "PT",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "b5be8fd5-0bf7-41ce-8608-5e96dbf13639",
                "npp" => "30032",
                "nama" => "Amelia Fatmawati, Amd.Rad",
                "level" => "N\/A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "b5edbca3-271e-4a70-ab94-abcda1e5851b",
                "npp" => "12373",
                "nama" => "Astia Irvianty, dr., M.M",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "b6052000-c1f7-47b3-8ee0-a6e57d91fa74",
                "npp" => "12231",
                "nama" => "Maylasari, Am.Keb",
                "level" => "IV A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "b639de09-e8ba-4f5d-8d03-4d23d32a088c",
                "npp" => "24233",
                "nama" => "Agam Senatama",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "b65c4dfc-db74-43c3-8721-c4a803fc4499",
                "npp" => "2588",
                "nama" => "Tuning Rudyati",
                "level" => "0",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "b6697217-8406-4281-9400-700451cb6e4f",
                "npp" => "24008",
                "nama" => "Puji Hariasih",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "b697e282-db1a-4e66-94bb-00d560b4d5b9",
                "npp" => "25074",
                "nama" => "Febri Dwi Anggara, A.Md.AK",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "b6cfa3c1-1463-49e9-bbbe-451a7f90bb28",
                "npp" => "12430",
                "nama" => "Irma Nurhasanah",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "b877c24a-909c-4d5d-bedb-f972418c7ace",
                "npp" => "12355",
                "nama" => "Intan Ihza Permatadani",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "b89358d1-9f0e-4e4f-b413-f5714f00ca19",
                "npp" => "24118",
                "nama" => "Wike Hadi Widianto, Amd Kep",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "b9b746f0-49c6-4339-87de-7d748ea69cd4",
                "npp" => "24265",
                "nama" => "Alissa Qotrunada Assyafi'iya",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "bab70c4e-eaa5-4948-8a5e-dab960108618",
                "npp" => "12308",
                "nama" => "Egna Sugiana",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "bab96340-0116-4abe-a395-c1a5e2f3c323",
                "npp" => "34011",
                "nama" => "Dewi Intan Sari",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "bbec382f-ec05-4939-815e-273310f87223",
                "npp" => "24178",
                "nama" => "Husnul Cholilah",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "bbece3d4-c243-418c-8351-66d4af0a071c",
                "npp" => "11142",
                "nama" => "Astri Fitran Wilantari, dr., MMRS",
                "level" => "II",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "bcd05b87-b7cb-401d-83e0-e20d226f2d45",
                "npp" => "12325",
                "nama" => "Ridha Rizal Siahaya",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "bcd6e2b5-7aec-4cdb-acab-1d7b49017f28",
                "npp" => "11023",
                "nama" => "Fitriani, AMK",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "bd6470b8-9805-436a-948e-5523bc77d86d",
                "npp" => "22057",
                "nama" => "Anita Choirun Nisak, Amd Farm",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "bd6f882f-0864-467a-bf96-26d3c228579d",
                "npp" => "24200",
                "nama" => "Arif Ridho Hidayat",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "bdade92d-d468-4a2c-82be-2be9abb69352",
                "npp" => "11115",
                "nama" => "Windi Pirdiani, S.Tr",
                "level" => "IV B",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "bdfce9e6-218b-4c00-9273-f9b2ec009145",
                "npp" => "25029",
                "nama" => "dr. Alharsya Franklyn Ruckle, Sp.U",
                "level" => "dr Sp",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "be49fc03-da57-4824-bbb8-557aecd707b5",
                "npp" => "30033",
                "nama" => "Reva Ayu Karisma, A.Md.Kes",
                "level" => "N\/A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "bfdf43ac-1bf2-498d-9d0a-c4ce657ccc74",
                "npp" => "35002",
                "nama" => "RR Ardianti Rachma Wardhani, dr",
                "level" => "drU",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "bfed248c-af31-4f89-ab0d-064277bbf721",
                "npp" => "11118",
                "nama" => "Gandi Wibawa, Amd.Ft",
                "level" => "IV B",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "c03701ae-fc13-4c78-aed7-e9f2d8519101",
                "npp" => "25076",
                "nama" => "dr. Christian Surya Eka Putra, Sp.P",
                "level" => "dr Sp",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "c04f848f-4ebb-4335-840d-9738740b88ea",
                "npp" => "12271",
                "nama" => "Riky Ramdhani",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "c05a1c55-93d8-4e21-b804-965a2681c5aa",
                "npp" => "34006",
                "nama" => "Yudik Wahyu Musavianto",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "c0b27b93-f436-4787-b5f1-99aa14de9b15",
                "npp" => "11130",
                "nama" => "Nurfajar, AMK",
                "level" => "IV B",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "c0d97952-6905-491f-a67e-6b3fdb737006",
                "npp" => "30034",
                "nama" => "apt. Vilza Dwiki Yuvita, S.Farm",
                "level" => "N\/A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "c17a975c-4ca9-4062-8e52-d5a07618d4b1",
                "npp" => "12274",
                "nama" => "Heni Ratna Dewi",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "c1ce85f0-463e-4395-ae9d-7a26064cab44",
                "npp" => "30023",
                "nama" => "Galis Nurma",
                "level" => "N\/A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "c1f2f41e-b5c9-48c7-b5d4-0e1061af69b6",
                "npp" => "21003",
                "nama" => "Teguh Mulyo Widodo",
                "level" => "II",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "c211e669-eb84-4c2b-a42e-7a6dc8851d2c",
                "npp" => "22054",
                "nama" => "Ni'amah",
                "level" => "IV A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "c260e1fd-e61c-4183-8916-195bc80d7611",
                "npp" => "12361",
                "nama" => "Dhea Nugraha Suryana",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "c2e81255-1725-46e0-9ad3-d319675f0d8f",
                "npp" => "11042",
                "nama" => "Sigit Wiriyantoro, S.E",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "c394994b-8c1e-452c-bf39-50e713adee2a",
                "npp" => "34010",
                "nama" => "Erika Febriana Rahayu",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "c4182f2e-8c14-487b-8cb0-da86767a9758",
                "npp" => "25071",
                "nama" => "dr. Bimo Mubyarto, Sp.N",
                "level" => "dr Sp",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "c43aeeac-1720-4c2d-a125-f394723932fc",
                "npp" => "24062",
                "nama" => "Ernawati",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "c4bab9bd-bb62-44c7-9f27-5429c86d85b4",
                "npp" => "12403",
                "nama" => "Annisa Salsabila",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "c4fc6dfe-64a9-4b44-9ae1-10a73089f7b2",
                "npp" => "12213",
                "nama" => "Diah Rohmah Hidiyah Sucihati",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "c5284257-cdfd-4416-9fa8-72b6e3411303",
                "npp" => "12382",
                "nama" => "Purnama Lestari",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "c5358ed2-4996-42c0-a104-98e4ee3b231e",
                "npp" => "12371",
                "nama" => "Lia Kamila",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "c584c395-f4a5-4e3c-ac2a-be445d2a3e6c",
                "npp" => "11037",
                "nama" => "Samijan",
                "level" => "IV B",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "c60c3968-cf0d-4c06-ae22-d359c077ac28",
                "npp" => "35003",
                "nama" => "Debi Lestari, dr",
                "level" => "drU",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "c65f8318-965b-4437-a6a6-090e8b5bd867",
                "npp" => "24291",
                "nama" => "Novitri Setyowati, S.Kep.Ners",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "c6673229-877e-422e-bbef-1fc6f7f947a9",
                "npp" => "24140",
                "nama" => "Retno Anggraeni",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "c7118bed-bbf8-407d-b9e0-c1f5dc098e01",
                "npp" => "11015",
                "nama" => "Andi Suwandi, S.Si Apt",
                "level" => "II",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "c731f88c-8d82-47ae-87ee-f699ec07c2b1",
                "npp" => "24141",
                "nama" => "Muhammad Arifin",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "c760f81a-adab-4d17-8d24-cbe52f45218f",
                "npp" => "24314",
                "nama" => "Moch Ricky Asda Putra Pratama",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "c76b99a6-1ce1-4e96-93cd-30cecc4bf352",
                "npp" => "11095",
                "nama" => "Iman Maoludin, AMK",
                "level" => "IV A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "c7819430-5c39-44a7-aa7c-24f245c9c252",
                "npp" => "24266",
                "nama" => "Novian Eka Rivaldi",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "c83bc92c-f445-49a7-8665-f91c51c549cf",
                "npp" => "24319",
                "nama" => "Renal Asparega Eko",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "c85ae9f2-4e2d-498f-ae52-d13da0614d4f",
                "npp" => "12267",
                "nama" => "Hanny Agustina",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "c86e7ac7-a77d-4255-939e-ea393f9f160a",
                "npp" => "12408",
                "nama" => "Imtinan Karina Lestari",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "c916a37b-0cc5-4385-a5a3-5c390c5bdb4e",
                "npp" => "12263",
                "nama" => "Indah Pratiwi Rustandi",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "c967922e-92f2-4622-bee1-c1917b9383ae",
                "npp" => "24275",
                "nama" => "Mustaqim Nur Hidayat",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "c9bbfeeb-6f67-4382-93fe-bbf0d19f761a",
                "npp" => "12112",
                "nama" => "test karyawan 2",
                "level" => "IV B",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "caa4770d-9ed9-45a4-9db1-3a57927c98ef",
                "npp" => "21008",
                "nama" => "Khusnul Khotimah",
                "level" => "II",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "caf87568-4bec-48bb-972d-96e5d989a007",
                "npp" => "24219",
                "nama" => "Wafa Azwaruddin Nur, dr",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "cb0b6000-d144-4bbe-8487-95e800a140ca",
                "npp" => "22083",
                "nama" => "Timur Tri Aria Chandra",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "cb37274a-e3a8-49f3-9513-32e0d6e0e478",
                "npp" => "22075",
                "nama" => "Octaviani Defi",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "cb68124a-df38-45e8-877e-0984021b5262",
                "npp" => "11094",
                "nama" => "Gallant Ramadhan Pratama, AMK",
                "level" => "III NS",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "cb8140d2-41ca-4656-a5c6-8363e4e615a0",
                "npp" => "12284",
                "nama" => "Desi Damayanti",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "cb85c570-beb0-46b3-8c6f-a6ee3c01df5e",
                "npp" => "24152",
                "nama" => "Achmad Zaenuri",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "cb96d52e-5a55-4cbe-b63c-c03d08b15f07",
                "npp" => "12425",
                "nama" => "Cyntia Wahyu Nin Tyas",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "cc89a06c-8616-4d33-bd2d-7c3c2436ddc7",
                "npp" => "30030",
                "nama" => "Dinda Indraswari, A.Md.Kep",
                "level" => "N\/A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "cc9fed5e-691a-4a27-8a09-d37e73eb3af7",
                "npp" => "24235",
                "nama" => "Ainul Yakin, dr",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "ccc93272-e714-4172-b24d-02050453ecd3",
                "npp" => "24002",
                "nama" => "Ferdina Anggarda E",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "cd040381-a182-4dcb-bb72-1eaddda252b1",
                "npp" => "11117",
                "nama" => "Elida Aprilia, AMK",
                "level" => "IV A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "cd69efb4-bb05-40cc-a041-07159b7415a9",
                "npp" => "12420",
                "nama" => "Erina Puspitasari",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "cd9ed724-89b2-47ca-a8f7-c97808dfcd97",
                "npp" => "24153",
                "nama" => "Maulana Issa Harris",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "cde40085-18d9-4b3e-b37f-5186b4d965b2",
                "npp" => "11079",
                "nama" => "Anita Berlina Andreas, Am.Keb",
                "level" => "IV A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "ce0b04ee-a71b-40d2-89ac-50d753bfeb2d",
                "npp" => "24145",
                "nama" => "Diajeng Puji Lestari",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "ce511d75-179a-4083-8419-84ae82604312",
                "npp" => "22056",
                "nama" => "Siti Karimatul Abidah, Amd Keb",
                "level" => "IV A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "ce7d14f2-6c76-4a5e-9ea9-5e1f4b96633e",
                "npp" => "22045",
                "nama" => "Istidhatul Lutfi Anita S A, dr",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "ceebf1fb-4870-4ba0-80d9-dc8d20fdcd61",
                "npp" => "11125",
                "nama" => "Raafi Nurrahman, AMK",
                "level" => "IV A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "cf3f7e83-8aa7-4ab9-a6e9-caaf0ed41b23",
                "npp" => "24248",
                "nama" => "Ainul Yakin, dr",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "cf4ce400-e515-45d3-a226-fb211d6f1509",
                "npp" => "34029",
                "nama" => "Thoriqul Ikhsan",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "cfd4b6f6-29a5-452b-9a36-77e754c297b8",
                "npp" => "11078",
                "nama" => "Nurlatifah, AMK",
                "level" => "IV B",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "d00ab2e7-0d94-4267-894e-e9148659bfe4",
                "npp" => "24317",
                "nama" => "Khoirun Nisa'",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "d00b3002-d03b-40cf-bac2-1ce7c6b3c761",
                "npp" => "25035",
                "nama" => "dr. Satwika Budhi Pradhana, Sp.Rad",
                "level" => "dr Sp",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "d05c1242-dfc5-4f34-be98-2d7cec295d88",
                "npp" => "24065",
                "nama" => "Rusman Hadi Santoso",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "d0e2ca30-7efc-4406-a4d9-a0d94ef7ef3f",
                "npp" => "12180",
                "nama" => "Fany Febriyanti, Amd RMIK",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "d1262f34-456f-4ba1-a35f-0c0826f01658",
                "npp" => "24094",
                "nama" => "Anita Imtikhana, Amd Kep",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "d129dedb-c6e7-4be7-bbc1-0c2bddbe738d",
                "npp" => "24040",
                "nama" => "Aris Arianto",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "d13544ff-8e08-4c58-be9b-ef9840ca4537",
                "npp" => "24254",
                "nama" => "Elen Jihan Pratma",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "d137a78e-1b34-4280-808a-726bbf3fe16c",
                "npp" => "12376",
                "nama" => "Inda Septia Nur Fitri, AM.Keb",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "d15df336-ad0d-4c5e-846b-528eafbf036e",
                "npp" => "30017",
                "nama" => "Dinar Indasari",
                "level" => "N\/A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "d1cb01f4-0108-4b47-bd8b-efa29d7a7f85",
                "npp" => "25037",
                "nama" => "dr. Tommy Nugroho W, Sp.A.MBioMed.",
                "level" => "dr Sp",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "d1d9b37e-37bf-4d8d-b15f-158062d3b1bb",
                "npp" => "11116",
                "nama" => "Beni Suprianto",
                "level" => "IV B",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "d1daf2d0-4244-4edf-b75b-263413248252",
                "npp" => "12256",
                "nama" => "Triyas Budisantoso",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "d230e487-dc82-4f69-9c27-8cea968f0363",
                "npp" => "11064",
                "nama" => "Rina Mulyani, AMK",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "d231b7b5-4aa1-4bdb-a415-147636558269",
                "npp" => "12407",
                "nama" => "Neng Tita Kartini",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "d24d6c38-f87b-44f6-8b35-dfcd225ced2f",
                "npp" => "22014",
                "nama" => "Oktavia Sari Kartika Wati, S.Kep",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "d2685aba-7af4-4f09-a108-62860fb2aced",
                "npp" => "32002",
                "nama" => "Deria Putri Ayukarlina, Amd RMIK",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "d27ebae3-c19c-4e5a-b0db-fcc17a61d644",
                "npp" => "24229",
                "nama" => "Muhammad Bisri",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "d2afe679-2a67-4a59-bbba-1fef53bdb9ec",
                "npp" => "12338",
                "nama" => "Endang Sri Lestari",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "d2cfc5d9-5082-488a-891b-dd6d13011077",
                "npp" => "11035",
                "nama" => "Nunung, AMK",
                "level" => "III NS",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "d2da0bce-ed15-4484-a9c1-64d994bef210",
                "npp" => "30015",
                "nama" => "Andik Pratugas Setiawan",
                "level" => "N\/A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "d2f01545-cd92-4f85-b3c1-3dcf49d65c52",
                "npp" => "12151",
                "nama" => "Santi Wulansari, Amd Rad",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "d3273db2-6a5f-427d-b872-1cd7d5ee6a7b",
                "npp" => "11027",
                "nama" => "Rina Hernawati, Am.Keb",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "d33a7a9e-fdfd-4561-a848-42279f2fba82",
                "npp" => "12348",
                "nama" => "Gilang Muhammad Yasin",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "d353dc97-7201-41d3-af0f-14c10fb2f9a5",
                "npp" => "24146",
                "nama" => "Dwi Rachmawati",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "d4ff1d73-cb91-43e7-9d6b-3129bbb76b69",
                "npp" => "24055",
                "nama" => "Deny Priyantono",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "d52054ea-2a54-425d-bc6d-9fcf540dae79",
                "npp" => "12226",
                "nama" => "Muhammad Fadholi",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "d5347d20-526f-48c3-a719-e5b4904ea1a1",
                "npp" => "21011",
                "nama" => "Dwi Martiasasi",
                "level" => "II",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "d54cdb3d-6bfd-4b3e-9d2f-e0068ce4f2a3",
                "npp" => "12342",
                "nama" => "Rositoh",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "d595fc9d-f521-4ba1-a64a-b94be82e5261",
                "npp" => "11074",
                "nama" => "Yunita, Am.Keb",
                "level" => "III NS",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "d59bc484-cfdc-4f2d-b7f8-19a72cd20f9e",
                "npp" => "11110",
                "nama" => "Gita Juwita Sari, AMK",
                "level" => "IV A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "d60e7217-f21a-48a8-bd45-98f82a6a19a4",
                "npp" => "24244",
                "nama" => "Dina Atika Ghisani",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "d6350349-9b9b-4bff-8861-a811ff86d8fe",
                "npp" => "24095",
                "nama" => "Agus Santoso",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "d63f54a6-2a29-4312-93b6-1a3f23558a2c",
                "npp" => "24061",
                "nama" => "Nellindra Lyanta Sukma, Amd Kep",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "d7abbcc9-c0d8-4eca-a1fc-2a56c76019f8",
                "npp" => "12292",
                "nama" => "Resti Ramayani",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "d7b90307-1e97-403d-a5bf-78e5d930324d",
                "npp" => "12238",
                "nama" => "Aldi Riefnaldi Drajat",
                "level" => "IV A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "d821b3ce-fedc-4c20-9e4d-21caadc65c69",
                "npp" => "11140",
                "nama" => "Nimas Ayu Sari, S.Farm., Apt",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "d8620c0c-36a3-44f8-92e5-69ee365f3db9",
                "npp" => "24287",
                "nama" => "Aprilia Tri Kartikasari, S.Kep.Ners",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "d8ee53fd-4df6-4aa9-b4d0-4168eeea8c68",
                "npp" => "11026",
                "nama" => "M Gugum Gumilar, AMK",
                "level" => "II",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "d94819ef-498f-4f0c-bfaf-bf274a04d899",
                "npp" => "12347",
                "nama" => "Kresna Triyanto",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "da092437-60f8-4aea-8c11-880eee55c98f",
                "npp" => "11135",
                "nama" => "Dera Pebriyanti, AMK",
                "level" => "IV A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "da2ad740-8485-4bd4-b5bf-b12965bafba1",
                "npp" => "32005",
                "nama" => "Rosihan Anwar, dr",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "daa1a9ec-82aa-4c99-9c8e-883aed30a03e",
                "npp" => "11098",
                "nama" => "Dian, AMK",
                "level" => "IV A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "daae5911-8261-4f46-b6ae-c918ff79a7ee",
                "npp" => "24028",
                "nama" => "Novia Susanti",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "dae852dc-6e55-46aa-ae2e-120d6c45b05b",
                "npp" => "30025",
                "nama" => "Mochamad Ilham Firmansyah",
                "level" => "N\/A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "db2e5525-4fd9-45b9-ba3a-02667cc2e4ac",
                "npp" => "22070",
                "nama" => "Toreni Yurista, dr",
                "level" => "II",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "dbf7284e-3bf9-475a-b745-0ec91c709dfb",
                "npp" => "30041",
                "nama" => "Micra Rahayu, A.Md.Kep",
                "level" => "N\/A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "dc16e8d7-52fb-402b-8a5e-79cb629b76a5",
                "npp" => "24290",
                "nama" => "Endang Sriyani, S.Kep.Ners",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "dccd1dda-b2a1-4c06-96eb-2ba458a8c42c",
                "npp" => "24012",
                "nama" => "Ida Susanti",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "dd09ae90-022e-4cb8-abe2-fc21f670f84b",
                "npp" => "11137",
                "nama" => "Pratiwi Koswarasari Abidah",
                "level" => "IV A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "dd19d63b-31b5-4af6-ac56-8b1d36f0fbc5",
                "npp" => "24038",
                "nama" => "Wahyu Arianto",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "dd3538b3-14e2-475e-860a-c3dbe8f021f0",
                "npp" => "11113",
                "nama" => "Riki Nugraha, AMK",
                "level" => "IV B",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "dd666c4c-9a07-43d9-a087-31ad7d6e4c6f",
                "npp" => "24222",
                "nama" => "Wafa Azwaruddin Nur, dr",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "de11725b-de7f-42b2-ae4e-7668696fc416",
                "npp" => "24168",
                "nama" => "Mochammad Sholeh Handika",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "de412d18-a7ea-4e64-ac93-abb9dae3aac1",
                "npp" => "21010",
                "nama" => "Saji Purboretno, dr",
                "level" => "I A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "de9433f1-d673-499b-9e24-b9ba7a490a5a",
                "npp" => "22050",
                "nama" => "Suci Wulandari, Amd Kep",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "df08131a-a82e-4644-b7e1-83f2497134f1",
                "npp" => "24260",
                "nama" => "Dwi Enjang Agustin Lindasari",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "df276d36-f662-4cc2-b860-631b2fc26717",
                "npp" => "11075",
                "nama" => "Angga Suriadiharja, Amd.AK",
                "level" => "IV A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "df4e60b3-f6fc-43b1-bbd1-50ed0178428d",
                "npp" => "24293",
                "nama" => "Dheeayu Rizky Mulya Tianti, S.Kep.Ners",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "dff15f85-0fb2-4339-a10d-b73603e6cfa7",
                "npp" => "25020",
                "nama" => "dr. Fadilah Mutaqin, Sp. A",
                "level" => "dr Sp",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "e05f1e0a-77ea-47d3-ba75-d1a1039f7845",
                "npp" => "12353",
                "nama" => "Wildan Putra Wicaksono",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "e083f273-c8b6-4c54-84e6-38d06ccd05dc",
                "npp" => "24299",
                "nama" => "Cahyani Irmawati, S.Ft",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "e0f1385d-9976-4120-b241-3127c7468d8e",
                "npp" => "22042",
                "nama" => "Ferry Parlin",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "e220f1fa-25cb-4314-81ac-2d1ee42dc0df",
                "npp" => "12400",
                "nama" => "Putri Sekar Widyaningsih",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "e26e3bae-cce1-43dd-931a-f2fa692a05ba",
                "npp" => "24269",
                "nama" => "Kurniawan Tri Putra",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "e282f370-683c-483a-be9a-89d948c70b5f",
                "npp" => "24056",
                "nama" => "Evi Zuhriyatul Wardani",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "e2b7b4f5-c34d-43a3-b3dc-26684ca81053",
                "npp" => "24007",
                "nama" => "Ifatul Khasanah",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "e2c403a2-0414-4816-9ec3-58402a7db84a",
                "npp" => "11031",
                "nama" => "Lina Hikmawati, AMK",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "e36443f9-c10a-4aef-8fc4-898ef35e16b0",
                "npp" => "32010",
                "nama" => "Tamara Oktaviani",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "e385c6a1-e056-4b7d-b9a7-d1255cc2cc62",
                "npp" => "24232",
                "nama" => "Wahyu Septian Fajar",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "e39932d4-ce40-4e0c-aad8-6a25ad8476a4",
                "npp" => "30036",
                "nama" => "Unun Widiyanti Lestari, A.Md.Kep",
                "level" => "N\/A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "e3bea184-f740-46be-8e4a-116486600432",
                "npp" => "22077",
                "nama" => "Dony Dwi Kiputranto",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "e43f0164-8978-4bd3-b232-3a2f7e92cf9c",
                "npp" => "34022",
                "nama" => "Putri Maulidya Chasanah",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "e482f570-4f33-42df-a09c-9889947f54d6",
                "npp" => "12398",
                "nama" => "Dewi Kania Sriwahyuni",
                "level" => "IV A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "e54ec76f-1df9-438a-9e75-14ad3c940f76",
                "npp" => "25034",
                "nama" => "dr. Miftakhul Huda, Sp.KJ",
                "level" => "dr Sp",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "e56a33a0-bb8a-4d11-b3e7-69acf6e1d061",
                "npp" => "12374",
                "nama" => "Nurul Dwi Aryani",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "e5746c18-75a8-4643-8f3c-a11acee65b04",
                "npp" => "12369",
                "nama" => "Dahlan Hadi Permana",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "e5839c44-4480-42b8-acc6-981d2a9f6952",
                "npp" => "30010",
                "nama" => "Faria efendi",
                "level" => "N\/A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "e5a5f3e4-f997-4724-bfd6-1c7aaa68afd5",
                "npp" => "24186",
                "nama" => "Atika Pangestika",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "e618f8f2-5d11-4ff7-8c27-d0cc4850ff99",
                "npp" => "12243",
                "nama" => "Gina Suroyya Almunirah, dr",
                "level" => "III NS",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "e67dc374-31e9-44c5-bd4f-e30d94f846e7",
                "npp" => "12264",
                "nama" => "Taufik Ramdhani",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "e71b5194-1ada-478a-9f16-43a987dc305c",
                "npp" => "30018",
                "nama" => "Chumaidi",
                "level" => "N\/A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "e735d0df-7539-4e52-bc54-cdc125f0ffb0",
                "npp" => "12379",
                "nama" => "Yuli Indrianie",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "e7971401-ed00-453e-8172-cc07b2181250",
                "npp" => "24197",
                "nama" => "Ika Nur Choiriyah",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "e827f5d1-89cc-44e4-a879-218179bb6240",
                "npp" => "11065",
                "nama" => "Ade Heli Yudiantono, S.Kep., Ners",
                "level" => "II",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "e8b3139b-f8f8-46e2-891e-71acf9464dd7",
                "npp" => "24142",
                "nama" => "M Bashori Romadhoni",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "e8d63add-e427-4f86-b781-4fff57e9ce7a",
                "npp" => "12303",
                "nama" => "Hana Aulia Fadiyah",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "e94ae9b9-68c0-426e-9e35-2ae96b786f97",
                "npp" => "12381",
                "nama" => "Supriadi",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "e97ed812-f0d6-41c7-9f3f-5b3692ec6c4c",
                "npp" => "24098",
                "nama" => "Danang Kurdiansyah",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "e9ce4870-750e-4e1e-97f9-3b4593e21ce3",
                "npp" => "24163",
                "nama" => "Sochibul Huda",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "ea3c60ba-bc65-4bd9-a332-5be1d52428dd",
                "npp" => "34005",
                "nama" => "Indah Styarini",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "eba85bbf-533c-4a20-bfc4-74f77fb9a29c",
                "npp" => "24167",
                "nama" => "Eko Bagus, dr",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "ebe6853a-9395-4b35-9119-5e9a8aec53d2",
                "npp" => "12140",
                "nama" => "Dita Fauziah, Amd AK",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "ec5387ce-8663-4343-b3d8-94d7461e2b61",
                "npp" => "12323",
                "nama" => "Hilfi Hazman Wafi",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "ec7991d9-5ef7-43aa-bef8-bad823f7a618",
                "npp" => "11101",
                "nama" => "Teti Herawati, AMK",
                "level" => "IV B",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "ecb79d22-38b7-411a-ba2b-40db2e145dbe",
                "npp" => "12344",
                "nama" => "Laras Andarina Agustin",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "ee47354c-d6c5-46a4-8fb2-d7658351482c",
                "npp" => "24032",
                "nama" => "Tri Purnawati",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "eecc3d74-d49d-41a5-b2df-67a434b3db9f",
                "npp" => "11004",
                "nama" => "Euis Suhaenah",
                "level" => "IV B",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "eed24e00-db70-478d-82bc-02b3ca668824",
                "npp" => "12378",
                "nama" => "Eka Putri Kusumawati, Amd Kep",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "ef26a998-07a3-4d04-b3d0-aa3d757c526d",
                "npp" => "12352",
                "nama" => "Endang Septiani",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "ef488e2f-3200-4f98-a719-164fef4ed291",
                "npp" => "12261",
                "nama" => "Reza Nabilla Awalrulah",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "efe06603-ed18-40c5-8385-fa206256c515",
                "npp" => "30021",
                "nama" => "Rara Restu Amiroh Manar",
                "level" => "N\/A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "eff214a4-41cb-4648-a345-66f36156362a",
                "npp" => "11084",
                "nama" => "Rizki Meiriana Redanti, AMK",
                "level" => "IV B",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "f0475f1e-8e27-448b-ad9d-1b5354389f20",
                "npp" => "24206",
                "nama" => "Bakhrudin Zamzam",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "f1392295-e894-4447-a8b0-a43d130523e6",
                "npp" => "12333",
                "nama" => "Mia Melany",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "f1622413-c65c-491d-b364-f31e8df39488",
                "npp" => "11062",
                "nama" => "Herny Yoanudin, Amd.AK",
                "level" => "IV A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "f275127c-d2a3-4db5-bc17-9db13a63ea1a",
                "npp" => "11028",
                "nama" => "Faija Rustama, AMK",
                "level" => "III NS",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "f2f75e32-bf13-4082-8d9d-c770d922d4f1",
                "npp" => "24156",
                "nama" => "Khoirun Nikmah",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "f3798f06-5d6c-4ad4-959b-1b4fa66e8425",
                "npp" => "12100",
                "nama" => "Lisna Siti Agustiani, Amd RMIK",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "f3d3220c-ee89-4ee2-9218-83bf67ca03dc",
                "npp" => "12228",
                "nama" => "Indriana Dewi",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "f3e0afc0-d2d8-4bf3-9288-e4a303c6fac7",
                "npp" => "12105",
                "nama" => "Dede Syarip Hidayat",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "f3ef791d-ed78-44d5-906c-a88dd9caf7ec",
                "npp" => "12259",
                "nama" => "Miranti Putri Asri Rahmawati, Amd.Farm",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "f40ca62c-556d-4f15-9246-e9804f291718",
                "npp" => "12222",
                "nama" => "Kamila Nur Rahim, Amd.Ft",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "f4242e99-5624-41da-bee7-2bbd12520eea",
                "npp" => "24195",
                "nama" => "Julialdy Eko Kurniawan",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "f481ba98-cf8a-494a-ae09-b5480ab64934",
                "npp" => "30004",
                "nama" => "Elvira Yulianti",
                "level" => "N\/A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "f4cb0615-4578-4206-9c2d-4631cac2157c",
                "npp" => "11013",
                "nama" => "Iwan Wirabuana, SE",
                "level" => "I C",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "f4ef591f-4245-4aff-bf40-9a95fdc9a0b4",
                "npp" => "22058",
                "nama" => "Yanuar Rizal Al'Rosyid",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "f4f695c8-8a8f-42dc-982e-0b114e043976",
                "npp" => "24025",
                "nama" => "Edo Hermawan",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "f531b1c0-844c-43d5-81d0-f7bef57712ba",
                "npp" => "12393",
                "nama" => "Sri Puspa Pandini",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "f5b018ec-67a6-4383-840a-9f53c6fa35ab",
                "npp" => "24034",
                "nama" => "Eko Purnomo Putro, Amd Kep",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "f6510a3d-f470-41ef-9e4a-96acc4289f9c",
                "npp" => "12332",
                "nama" => "Ari Riansyah",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "f65c0686-16d8-4307-a51d-4b50d1453093",
                "npp" => "25013",
                "nama" => "dr. Irma Selekta Vera, Sp.M",
                "level" => "dr Sp",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "f677cc75-4ea8-496c-b4e6-c3363a1c2baa",
                "npp" => "11066",
                "nama" => "Sri Budi Anggraeni, AMK",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "f6aa4324-babb-49e3-8a05-bb4daa80b243",
                "npp" => "11068",
                "nama" => "Steven Indra Lesmana W, Amd",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "f78f564f-0f6f-40e9-a2ac-140c8d94802f",
                "npp" => "12280",
                "nama" => "Ayu Belianna Barokah",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "f82c2096-f104-4b0b-b442-5dc78fb77d9a",
                "npp" => "24188",
                "nama" => "Titin Tri Mulyani",
                "level" => "III",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "f8eda0d5-16ca-4efb-be30-f5281903fe98",
                "npp" => "11049",
                "nama" => "Diah Rahayu Kusharjanti, SE",
                "level" => "IV B",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "f8ef6d6d-ad76-4817-8bd8-4f293aae80c2",
                "npp" => "25027",
                "nama" => "Prof. Dr.dr. Sardjana,SP OG (K),SH,NSL",
                "level" => "dr Sp",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "f8f731b4-85c5-4531-bba4-b342ac080aee",
                "npp" => "24192",
                "nama" => "Dyah Kusuma Ningtyas",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "f90adc32-2d4e-4092-a6a0-941fa0209c92",
                "npp" => "24117",
                "nama" => "Agustina Tri Wahyuni",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "f98f525d-59fb-4d88-872f-0be348be7813",
                "npp" => "11070",
                "nama" => "Dyah Sita Laksmi, dr",
                "level" => "I B",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "f9c775c2-1db3-4fac-b10f-0fdd62dec6d0",
                "npp" => "11122",
                "nama" => "Anisa Desy Aryanti, S.Farm., Apt",
                "level" => "II",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "f9f88791-6f4c-4750-bf24-2365fdc2e5ed",
                "npp" => "12423",
                "nama" => "Moh. Solehuddin Al-Ayyubi",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "fa3973be-9013-426e-a6a0-e6c200ac6648",
                "npp" => "24261",
                "nama" => "Maulida Ratna Hapsari",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "faa1002a-5dc9-49f2-b72c-47d67e17c0ff",
                "npp" => "24161",
                "nama" => "Dony Dwi Kiputranto",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "fb43146a-29db-4d6f-9dfb-85838f679e4a",
                "npp" => "12397",
                "nama" => "Maulia Ausy Herrisna",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "fb625fbe-01a5-4acd-9e7f-dae6603a3234",
                "npp" => "11077",
                "nama" => "Dini Adiniar, AMK",
                "level" => "IV B",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "fc01ad5b-75d3-459b-86a3-9057ef0fd88d",
                "npp" => "24227",
                "nama" => "Agus Saiful Amin",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "fc1ab8a1-d7f4-497f-aa7e-4af686c49915",
                "npp" => "25010",
                "nama" => "dr. Johannes Sudarwantono, Sp.OG",
                "level" => "dr Sp",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "fc1d89b5-bb06-4003-a327-d0ac135d46b4",
                "npp" => "11047",
                "nama" => "Eti Rahmawati, Amd.AK",
                "level" => "IV A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "fc2523f6-99e6-4a73-8fd2-2a4b2b3da64b",
                "npp" => "24170",
                "nama" => "Rizqiatul Kamalia",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "fc8d6d11-b9eb-422f-bf30-320d65817926",
                "npp" => "24035",
                "nama" => "Laili Choirun Nisak, Amd Kep",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "fcd0bf55-3a5c-4d89-affb-c787908cc0ca",
                "npp" => "24124",
                "nama" => "Dwi Novianto",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "fd0948ec-da89-4e63-9bc1-a953a5b571e9",
                "npp" => "24109",
                "nama" => "Lilik Ro'ikawati",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "fdc0ccf3-7fe6-4b3d-a889-37a922343cd9",
                "npp" => "24079",
                "nama" => "I'in Nur Indayani, Amd Kep",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "fdee361f-cd66-4ac0-bc12-7e92554b95b9",
                "npp" => "10002",
                "nama" => "Hadi Filino G",
                "level" => "0",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "fe4494a4-2243-4990-9097-37a3e6fd5dcf",
                "npp" => "24150",
                "nama" => "Lia Fibriarini",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "fe8f6737-35bf-4a36-a21e-2d22da9dbb93",
                "npp" => "30037",
                "nama" => "Nafisatul Ida, A.Md.Kep",
                "level" => "N\/A",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "fe91ef52-a025-4cb5-9c55-cf37e9136e79",
                "npp" => "24308",
                "nama" => "Ulfah Mufidah Zachroh Suprali Putri",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "fecf3e8b-66a2-428d-b160-3f5c0c35a518",
                "npp" => "24046",
                "nama" => "Adi Alamsyah",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "ff487856-4436-4929-97f3-26e57984c0cc",
                "npp" => "24158",
                "nama" => "Ery Arumingtyas Dewantini",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "ff71ae7e-870c-4c1e-9ba3-80dad460dfd0",
                "npp" => "12415",
                "nama" => "Nur Khadijah, dr",
                "level" => "III NS",
                "created_at" => null,
                "updated_at" => null
            ],
            [
                "id" => "fff17aa4-b8ba-420c-bd5f-73f4f6d8595a",
                "npp" => "24267",
                "nama" => "Gemalani Setiyaning Gusti",
                "level" => "V",
                "created_at" => null,
                "updated_at" => null
            ]
        ];
        Employee::insert($tbl_karyawan);
    }
}
