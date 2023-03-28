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
        $tbl_karyawan = array(
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11045",
                "nama" => "Yosep Nizar Faturohman"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11013",
                "nama" => "Iwan Wirabuana"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "21010",
                "nama" => "Saji Purboretno"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11029",
                "nama" => "Winda"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11043",
                "nama" => "Novi Nurbayanti"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12375",
                "nama" => "Sani Safrizal"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12390",
                "nama" => "Novita Indah Fitriyani"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11042",
                "nama" => "Sigit Wiriyantoro, S.E"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11059",
                "nama" => "Aris Susanto"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12337",
                "nama" => "Mochamad Iqbal Septyan"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11051",
                "nama" => "Rika Rosdiana"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12132",
                "nama" => "Yudas Dwi Andriyana"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12189",
                "nama" => "Gilda Anindita Mahari"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12272",
                "nama" => "Annisa Trifani Nur Fadhillah"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11028",
                "nama" => "Faija Rustama"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12161",
                "nama" => "Rachmi Dwi Kuswanty"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12251",
                "nama" => "Yudan Marfiansyah"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12238",
                "nama" => "Aldi Riefnaldi Drajat"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12270",
                "nama" => "Dian Dahlia"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12333",
                "nama" => "Mia Melany"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12387",
                "nama" => "Destry Herawaty Silaban"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12311",
                "nama" => "Vebby Agisna Nurani"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12367",
                "nama" => "Regina Natalia Barus"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11097",
                "nama" => "Kiki Rizqi Amalia"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12138",
                "nama" => "Deria Putri Ayukarlina"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12139",
                "nama" => "Eriya Hermawati"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12346",
                "nama" => "Shaffa Auliya Farida"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12409",
                "nama" => "Tamara Oktaviani"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12319",
                "nama" => "Novita Rizky Amalia"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11052",
                "nama" => "Zul Kurniawan, dr., MMRS"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11103",
                "nama" => "Bagus Anindito, dr., Sp.PD"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11058",
                "nama" => "Dina Daniarti, dr"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11070",
                "nama" => "Dyah Sita Laksmi, dr"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11015",
                "nama" => "Andi Suwandi, S.Si Apt"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11038",
                "nama" => "Yulia Kartika Nurdin, AMK"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11065",
                "nama" => "Ade Heli Yudiantono, S.Kep., Ners"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11072",
                "nama" => "Arum Susilowati Subhari, dr"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11142",
                "nama" => "Astri Fitran Wilantari, dr., MMRS"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "15013",
                "nama" => "Liza Nursanty"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11020",
                "nama" => "Dedi Iskandar"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11122",
                "nama" => "Anisa Desy Aryanti, S.Farm., Apt"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11105",
                "nama" => "Cipta Pribadi Firmansyah, dr., Sp.An"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11014",
                "nama" => "Ika Agus Prayitno, drg., MMRS"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11121",
                "nama" => "Ahmad Hafidz, dr., Sp.A"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11026",
                "nama" => "M Gugum Gumilar, AMK"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11005",
                "nama" => "Atinaningsih, S.Pd"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11032",
                "nama" => "Wiwin Nurhayati, AMK"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11027",
                "nama" => "Rina Hernawati, Am.Keb"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11023",
                "nama" => "Fitriani, AMK"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11064",
                "nama" => "Rina Mulyani, AMK"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11066",
                "nama" => "Sri Budi Anggraeni, AMK"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11034",
                "nama" => "Wawan Hernawan, Amd"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11068",
                "nama" => "Steven Indra Lesmana W, Amd"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11016",
                "nama" => "Nonih Nurhasanah, AMK"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12287",
                "nama" => "Aswin Rinaldi Gautama, dr"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12373",
                "nama" => "Astia Irvianty, dr., M.M"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11048",
                "nama" => "Ani Mulyani, SE"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11041",
                "nama" => "Wiwit Ari Sopian, S.T"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11090",
                "nama" => "Firman Yulhamsyah, S.Pd"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11019",
                "nama" => "Sri Sudarni"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11060",
                "nama" => "Yulia Indra Rahayu, AMK"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11031",
                "nama" => "Lina Hikmawati, AMK"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11012",
                "nama" => "Eulis Wanridah, Amd.AK"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11092",
                "nama" => "Susilawati, Amd.RMIK"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11107",
                "nama" => "Siti Evriani Nurjanah, Amd.Rad"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11108",
                "nama" => "Kartika Rizki Nugraheni, AMG"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11024",
                "nama" => "Iyam Maryati, AMK"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11056",
                "nama" => "Hendayani, AMK"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11140",
                "nama" => "Nimas Ayu Sari, S.Farm., Apt"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11039",
                "nama" => "Nurhalim, AMK"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11035",
                "nama" => "Nunung, AMK"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11046",
                "nama" => "Nita Widaningsih, AMK"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11050",
                "nama" => "Heny Puspita, AMK"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11074",
                "nama" => "Yunita, Am.Keb"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11094",
                "nama" => "Gallant Ramadhan Pratama, AMK"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11141",
                "nama" => "Muhammad Fahri Rehan, S.P"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11036",
                "nama" => "Sukamto"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12321",
                "nama" => "Muhammad Robby Rachman, Amd.KL"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11117",
                "nama" => "Elida Aprilia, AMK"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11082",
                "nama" => "Dewanti Fitriani, Amd.RMIK"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11061",
                "nama" => "Umi Sulistyowati, AMK"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11079",
                "nama" => "Anita Berlina Andreas, Am.Keb"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11114",
                "nama" => "Dini Novita Lestari, Am.Keb"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11054",
                "nama" => "Yani Mulyani, AMK"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11069",
                "nama" => "Agus Hermawan, AMK"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11095",
                "nama" => "Iman Maoludin, AMK"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11055",
                "nama" => "Eli Hasanah"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11133",
                "nama" => "Fatmawati"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11071",
                "nama" => "Nunu Nugraha, AMK"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11073",
                "nama" => "Ilham Agung Baihaki, AMK"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11119",
                "nama" => "Fauzi Rahmatulloh, AMK"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11080",
                "nama" => "Nurul Kasanah, AMK"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11088",
                "nama" => "Indro Purnomo, AMK"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11057",
                "nama" => "Kusniyati"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11076",
                "nama" => "Asmanah, Am.Keb"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11047",
                "nama" => "Eti Rahmawati, Amd.AK"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11109",
                "nama" => "Hersa Eka Juniar, Amd.AK"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11062",
                "nama" => "Herny Yoanudin, Amd.AK"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11075",
                "nama" => "Angga Suriadiharja, Amd.AK"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11131",
                "nama" => "Ihsan Marga Wiyaksa"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11030",
                "nama" => "Roni Purnawan"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11007",
                "nama" => "Nana Sutisna"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12113",
                "nama" => "Rizky Ayu Permatasari, S.Farm Apt"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12115",
                "nama" => "Iftitah Rahmi, S.Farm Apt"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11137",
                "nama" => "Pratiwi Koswarasari Abidah"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11018",
                "nama" => "Dadang Adiana"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11123",
                "nama" => "Veryssa Maharani Widjaya, AMK"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11001",
                "nama" => "Rina Solihah"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11049",
                "nama" => "Diah Rahayu Kusharjanti, SE"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11116",
                "nama" => "Beni Suprianto"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11115",
                "nama" => "Windi Pirdiani, S.Tr"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11120",
                "nama" => "Rikza Ariny, Amd.RMIK"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11128",
                "nama" => "Irlena Apriliya, Amd.RMIK"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11134",
                "nama" => "Sandhy Fauzan Ramdansyah, Amd.RMIK"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11136",
                "nama" => "Gita Nurwidya"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11053",
                "nama" => "Musaddiq"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11112",
                "nama" => "Meyshani Tuti Kosmana, Amd"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11129",
                "nama" => "Sandra Oktapiani, AMK"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11127",
                "nama" => "Daenuri, Amd.Rad"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11098",
                "nama" => "Dian, AMK"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11096",
                "nama" => "Erlin Kartikawati, AMK"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11110",
                "nama" => "Gita Juwita Sari, AMK"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11130",
                "nama" => "Nurfajar, AMK"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11124",
                "nama" => "Novie Noermalasari, Am.Keb"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11089",
                "nama" => "Nopiati Puspita, AMK"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11077",
                "nama" => "Dini Adiniar, AMK"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11139",
                "nama" => "Tria Anita Octaviana, Amd"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11011",
                "nama" => "Sri Purwanti"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11010",
                "nama" => "Eli Hemawati"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11085",
                "nama" => "Fitria Harselina"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11111",
                "nama" => "Rani Febriyani"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11106",
                "nama" => "Devi Amalia, Amd Farm"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11083",
                "nama" => "Sya'adudin Ardiansyah, AMK"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11125",
                "nama" => "Raafi Nurrahman, AMK"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11017",
                "nama" => "Mulyana"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11025",
                "nama" => "Yanti Suvitri"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11044",
                "nama" => "Saur Rohani, AMK"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11113",
                "nama" => "Riki Nugraha, AMK"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11100",
                "nama" => "Endah Aprianti"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11078",
                "nama" => "Nurlatifah, AMK"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11091",
                "nama" => "Yuli Septiani, Amd.Ft"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11084",
                "nama" => "Rizki Meiriana Redanti, AMK"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11093",
                "nama" => "Putri Dwi Jayanti, Amd.KG"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11099",
                "nama" => "Resya Dwi Fujawati, AMK"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11101",
                "nama" => "Teti Herawati, AMK"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11118",
                "nama" => "Gandi Wibawa, Amd.Ft"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11126",
                "nama" => "Risa Wulandari, Am.Keb"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11132",
                "nama" => "Andri Kusnaedi"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11135",
                "nama" => "Dera Pebriyanti, AMK"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11138",
                "nama" => "Mia Nurul Jannah"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11087",
                "nama" => "Rina Wiranti"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11003",
                "nama" => "Dede Juhana Kusnadi"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11063",
                "nama" => "Yayuk Nuryanah"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11022",
                "nama" => "Endry Lesmana"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11037",
                "nama" => "Samijan"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11004",
                "nama" => "Euis Suhaenah"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12242",
                "nama" => "Rona Kania Utami, dr"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12243",
                "nama" => "Gina Suroyya Almunirah, dr"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12250",
                "nama" => "Sekar Rio Arditha, drg"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12360",
                "nama" => "Feby Purnama, dr., Sp.N"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12388",
                "nama" => "R. Adhika Putra Sudarmadi, dr"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12366",
                "nama" => "Aditya Rahman Hakim"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12271",
                "nama" => "Riky Ramdhani"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12142",
                "nama" => "Rofi Fadilah, Amd Kep"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12247",
                "nama" => "Ai Imas, AMK"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12316",
                "nama" => "Puzy Agustiani"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12336",
                "nama" => "Siti Nurpatimah"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12344",
                "nama" => "Laras Andarina Agustin"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12398",
                "nama" => "Dewi Kania Sriwahyuni"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12166",
                "nama" => "Asri Lestari"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12253",
                "nama" => "Hendra Sugianto"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12332",
                "nama" => "Ari Riansyah"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12100",
                "nama" => "Lisna Siti Agustiani, Amd RMIK"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12180",
                "nama" => "Fany Febriyanti, Amd RMIK"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12245",
                "nama" => "Irma Nurhasanah, Amd.RMIK"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12254",
                "nama" => "Dwi Agung Pamungkas"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12262",
                "nama" => "Tiara Noor Rizkya Agustin"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12275",
                "nama" => "Maharani Puspitasari"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12290",
                "nama" => "Gita Rosa Fauziah, Amd.RMIK"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12301",
                "nama" => "Azka Aulia Dini"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12312",
                "nama" => "Anita Septiarini, Amd.RMIK"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12347",
                "nama" => "Kresna Triyanto"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12354",
                "nama" => "Revi Rosalinda"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12383",
                "nama" => "Bima Anggara"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12164",
                "nama" => "Gelar Pradiana"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12343",
                "nama" => "Ridwan Juliansyah Resiana"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12402",
                "nama" => "Yudi Rahadian Fauzi"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12133",
                "nama" => "Rifki Saepul Malik"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12334",
                "nama" => "S.M Gilang Satya Wijatmika"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12399",
                "nama" => "Sri Rahayu"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12406",
                "nama" => "Muhammad Ma’ruf Albadri"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12131",
                "nama" => "Suryadi, Amd Kep"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12248",
                "nama" => "Fujiarti Marcela, AMK"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12266",
                "nama" => "Monica Octaviani"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12292",
                "nama" => "Resti Ramayani"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12299",
                "nama" => "Revi Cahyani Wulandari"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12300",
                "nama" => "Risma Tri Herdiyanti"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12315",
                "nama" => "Erna Melinda Subandini"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12329",
                "nama" => "Eneng Intan Nurpitasari"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12339",
                "nama" => "Susi Sundari"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12340",
                "nama" => "Fahrul Maulidina Muhamad"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12341",
                "nama" => "Moch Rizky Nurul Ichsan"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12351",
                "nama" => "Intan Saputri"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12371",
                "nama" => "Lia Kamila"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12374",
                "nama" => "Nurul Dwi Aryani"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12403",
                "nama" => "Annisa Salsabila"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12404",
                "nama" => "Dhika Rizky Fitriana"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12407",
                "nama" => "Neng Tita Kartini"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12408",
                "nama" => "Imtinan Karina Lestari"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12151",
                "nama" => "Santi Wulansari, Amd Rad"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12288",
                "nama" => "Evi Pandiana, Amd.Rad"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12310",
                "nama" => "Firman Hafidh"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12348",
                "nama" => "Gilang Muhammad Yasin"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12396",
                "nama" => "Fajrin Walimatussa'adah"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12137",
                "nama" => "Gina Trihandayani, S.Farm Apt"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12283",
                "nama" => "Imania Rezqita Putri Yani"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12368",
                "nama" => "Yasmin Nurul Azizah Salsabila"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12154",
                "nama" => "Hanggara Tri Laksana, Amd Kep"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12165",
                "nama" => "Aditia Choirul Pratama, Amd Kep"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12241",
                "nama" => "Nafa Nabila"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12265",
                "nama" => "Ayu Aprianti"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12284",
                "nama" => "Desi Damayanti"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12345",
                "nama" => "Idad Ashari"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12391",
                "nama" => "Erni Laela Sari"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12134",
                "nama" => "Eva Nurapsari, Amd Keb"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12231",
                "nama" => "Maylasari, Am.Keb"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12280",
                "nama" => "Ayu Belianna Barokah"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12293",
                "nama" => "Nuri Halimah Fauziyah"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12105",
                "nama" => "Dede Syarip Hidayat"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12112",
                "nama" => "Andi Nurdiansyah"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12206",
                "nama" => "Frendy Nugraha"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12246",
                "nama" => "Riyas Febrianty"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12258",
                "nama" => "Aji Imam Muhammad, S.Kep"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12264",
                "nama" => "Taufik Ramdhani"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12281",
                "nama" => "Sarah Annisa Ramadhanty"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12294",
                "nama" => "Fatimah Sundari Banjarsari"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12302",
                "nama" => "Dini Listiawati"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12352",
                "nama" => "Endang Septiani"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12353",
                "nama" => "Wildan Putra Wicaksono"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12362",
                "nama" => "Gilang Rizki Husaeni"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12176",
                "nama" => "Dinda Magdalena Dewi Basit, Amd Farm"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12192",
                "nama" => "Sani Nuroktiani"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12229",
                "nama" => "Nita Nurkomara Sari"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12252",
                "nama" => "Dicky Noer Rochman"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12259",
                "nama" => "Miranti Putri Asri Rahmawati, Amd.Farm"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12260",
                "nama" => "Nina Ayustina, Amd.Farm"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12267",
                "nama" => "Hanny Agustina"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12274",
                "nama" => "Heni Ratna Dewi"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12279",
                "nama" => "Wina Bella Nur Iksani"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12307",
                "nama" => "Ririn Restiana Putri"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12335",
                "nama" => "Kusmiati"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12358",
                "nama" => "Irma Juanita"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12359",
                "nama" => "Annisa Firly Novian"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12382",
                "nama" => "Purnama Lestari"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12392",
                "nama" => "Ardi Fadliansyah"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12212",
                "nama" => "Ai Safitri"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12257",
                "nama" => "Ineu Apriani"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12269",
                "nama" => "Hanika Sari"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12291",
                "nama" => "Rosliani Suprihartini, AMK"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12309",
                "nama" => "Nisa Tazkiatun Nupus"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12320",
                "nama" => "Dian Berlianti, Am.Keb"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12350",
                "nama" => "Annisa Diyah Fitriani"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12356",
                "nama" => "I Kadek Eka Agustiawan"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12376",
                "nama" => "Inda Septia Nur Fitri, AM.Keb"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12378",
                "nama" => "Eka Putri Kusumawati, Amd Kep"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12384",
                "nama" => "Ismayanti, Amd Keb"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12152",
                "nama" => "Dona Marsela Febriani"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12249",
                "nama" => "Fitri Rofiqoh Nurul Fauziah, S.Gz"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12286",
                "nama" => "Winda Jayanti"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12308",
                "nama" => "Egna Sugiana"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12349",
                "nama" => "Diana Ulfah"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12135",
                "nama" => "Aprillianti Nur Fitriana, Amd Kep"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12237",
                "nama" => "Ida Nurhaeni"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12324",
                "nama" => "Annisa Rachmania, AMK"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12328",
                "nama" => "Ogi"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12410",
                "nama" => "Dian Eka Permana"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12282",
                "nama" => "Windy Nadia Puspita, Amd.Kes"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12414",
                "nama" => "Utami Yuliani"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12313",
                "nama" => "Teti Aprianti"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12128",
                "nama" => "Putri Puja Lestari, AMKeb"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12162",
                "nama" => "Nova Astriana Supendi, Amd Kep"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12222",
                "nama" => "Kamila Nur Rahim, Amd.Ft"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12261",
                "nama" => "Reza Nabilla Awalrulah"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12298",
                "nama" => "Ati Febrianti"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12303",
                "nama" => "Hana Aulia Fadiyah"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12338",
                "nama" => "Endang Sri Lestari"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12355",
                "nama" => "Intan Ihza Permatadani"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12364",
                "nama" => "Lisda Areska"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12394",
                "nama" => "Neng Seni Agustine"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12215",
                "nama" => "Wanda Suryana"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12239",
                "nama" => "Desi Rosyanti, AMK"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12256",
                "nama" => "Triyas Budisantoso"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12314",
                "nama" => "Hanif Fadhilah"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12326",
                "nama" => "Imas Herna Komalasari, AMK"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12327",
                "nama" => "Heni Khoerunnisa"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12369",
                "nama" => "Dahlan Hadi Permana"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12393",
                "nama" => "Sri Puspa Pandini"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12255",
                "nama" => "Tamy Andriani"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12268",
                "nama" => "Selviya Nurul Baety"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12140",
                "nama" => "Dita Fauziah, Amd AK"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12226",
                "nama" => "Muhammad Fadholi"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12228",
                "nama" => "Indriana Dewi"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12263",
                "nama" => "Indah Pratiwi Rustandi"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12304",
                "nama" => "Dini Nur Islami Rahayu"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12361",
                "nama" => "Dhea Nugraha Suryana"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12397",
                "nama" => "Maulia Ausy Herrisna"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12235",
                "nama" => "Andi Hidayat"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12323",
                "nama" => "Hilfi Hazman Wafi"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12156",
                "nama" => "Siti Aah Robaeah, Amd"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12179",
                "nama" => "Ainun Nuraeni"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12213",
                "nama" => "Diah Rohmah Hidiyah Sucihati"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12295",
                "nama" => "Widyatami Regine"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12322",
                "nama" => "Reka Melkawati"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12325",
                "nama" => "Ridha Rizal Siahaya"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12342",
                "nama" => "Rositoh"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12377",
                "nama" => "Nur Amalina"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12379",
                "nama" => "Yuli Indrianie"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12380",
                "nama" => "Febriansyah"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12381",
                "nama" => "Supriadi"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12395",
                "nama" => "Mega Fitri Kusmawan"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12400",
                "nama" => "Putri Sekar Widyaningsih"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12401",
                "nama" => "Nita Mulyani"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12405",
                "nama" => "Khanizar Kadaruloh"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "12109",
                "nama" => "Wahyu Ilahi"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "21016",
                "nama" => "Andre Setyawan C"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "22049",
                "nama" => "Arip Haryanto"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "11033",
                "nama" => "Dicky Widyanto"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "21011",
                "nama" => "Dwi Martiasasi"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "21014",
                "nama" => "Sri ratna"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "21008",
                "nama" => "Khusnul Khotimah"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "22012",
                "nama" => "Eka Yuliana Sari"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "21002",
                "nama" => "Hasyim Fauzi"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "21019",
                "nama" => "Nofi Astutik"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "22008",
                "nama" => "Rina Fitri Liawati"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "22055",
                "nama" => "Sheren Bella"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "22070",
                "nama" => "Toreni"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "22033",
                "nama" => "Zul Adhariansyah"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "22037",
                "nama" => "Hayyu Rizky Nur"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "21006",
                "nama" => "Mia Saputri Intansari"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "21007",
                "nama" => "Nana Rohisnaini"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "22058",
                "nama" => "Yanuar Rizal Al'Rosyid"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "21003",
                "nama" => "Teguh Mulyo Widodo"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "21015",
                "nama" => "Sri Rahayu"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "22014",
                "nama" => "Oktavia Sari Kartika Wati, S.Kep"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "21004",
                "nama" => "Isnani"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "22042",
                "nama" => "Ferry Parlin"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "22043",
                "nama" => "Adam Winarno"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "22044",
                "nama" => "Roni Ilhami Wijaya"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "22048",
                "nama" => "Febrian Dwi Saputro, Amd Farm"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "21018",
                "nama" => "Winda Triwilianti, Amd Kep"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "22007",
                "nama" => "Roni Badrussalim, Amd Kep"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "21005",
                "nama" => "Noor Affandi, drg"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "22045",
                "nama" => "Istidhatul Lutfi Anita S A, dr"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "22068",
                "nama" => "Ikka Tientus, dr"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "22069",
                "nama" => "Wika Yuli Deakandi, dr"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "22056",
                "nama" => "Siti Karimatul Abidah, Amd Keb"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "22013",
                "nama" => "Ika Kencana Rukmining Tyas, Amd Kep"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "22039",
                "nama" => "Eni Rivayanti, Amd Kep"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "22051",
                "nama" => "Asri Wuria Ningrum, Amd Kep"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "22059",
                "nama" => "Riska Aprillia, Amd Kep"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "22061",
                "nama" => "Herlinda Putri Oktabiyati, Amd Kep"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "22054",
                "nama" => "Ni'amah"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "22062",
                "nama" => "Luluk Khulailah, Amd Keb"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "22064",
                "nama" => "Danik Arfiani, Amd Kep"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "21012",
                "nama" => "Titik Yunaidah"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "22028",
                "nama" => "Indri Rahayu"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "22005",
                "nama" => "Riza Frika Alvianita, Amd Kep"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "22047",
                "nama" => "Defit Agus Susanto, Amd Kep"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "22050",
                "nama" => "Suci Wulandari, Amd Kep"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "22060",
                "nama" => "Achmad Aidin, Amd Kep"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "22063",
                "nama" => "Anton Dwi Cahyono"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "22065",
                "nama" => "Dayinta Bayu Restiputri, Amd Kep"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "21001",
                "nama" => "Yessy Susilowati, S.Farm"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "22006",
                "nama" => "Rizkha Nanda Pramita, Amd Gz"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "22027",
                "nama" => "Hendri Purwanto"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "22057",
                "nama" => "Anita Choirun Nisak, Amd Farm"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "22041",
                "nama" => "Lasiyanto, Amd Kep"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "22046",
                "nama" => "Hendrik Tri Indra Yuningrat, Amd Kep"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "22067",
                "nama" => "Putri Dwi Wijayanti"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "21009",
                "nama" => "Dini Mulyaningsih"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "22035",
                "nama" => "Rosihan Anwar, dr"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "22053",
                "nama" => "Merisa Surya Septian"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "22052",
                "nama" => "Qurrotul Ayunin"
            ),
            array(
                "id" => Uuid::uuid4(),
                "npp" => "21017",
                "nama" => "Mochamad Firman Azis"
            )
        );
        Employee::insert($tbl_karyawan);
    }
}
