<?php

namespace Database\Seeders;

use App\Models\PercentRelation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LevelScoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $data =[
           ['status'=>'atasan','level'=>'I A','nilai'=>0.6],
           ['status'=>'atasan','level'=>'I B','nilai'=>0.6],
           ['status'=>'atasan','level'=>'I C','nilai'=>0.6],
           ['status'=>'atasan','level'=>'IA NS','nilai'=>0.6],
           ['status'=>'atasan','level'=>'I A NS','nilai'=>0.6],
           ['status'=>'atasan','level'=>'II','nilai'=>0.6],
           ['status'=>'atasan','level'=>'II NS','nilai'=>0.6],
           ['status'=>'atasan','level'=>'III','nilai'=>0.6],
           ['status'=>'atasan','level'=>'III NS','nilai'=>0.6],
           ['status'=>'atasan','level'=>'IV A','nilai'=>0.6],
           ['status'=>'atasan','level'=>'IV B','nilai'=>0.65],
           ['status'=>'atasan','level'=>'V','nilai'=>0.65],
           
           ['status'=>'self','level'=>'I A','nilai'=>0.05],
           ['status'=>'self','level'=>'I B','nilai'=>0.05],
           ['status'=>'self','level'=>'I C','nilai'=>0.05],
           ['status'=>'self','level'=>'IA NS','nilai'=>0.05],
           ['status'=>'self','level'=>'I A NS','nilai'=>0.05],
           ['status'=>'self','level'=>'II','nilai'=>0.05],
           ['status'=>'self','level'=>'II NS','nilai'=>0.05],
           ['status'=>'self','level'=>'III','nilai'=>0.05],
           ['status'=>'self','level'=>'III NS','nilai'=>0.05],
           ['status'=>'self','level'=>'IV A','nilai'=>0.05],
           ['status'=>'self','level'=>'IV B','nilai'=>0.1],
           ['status'=>'self','level'=>'V','nilai'=>0.1],
           
           ['status'=>'rekan kerja','level'=>'I A','nilai'=>0.2],
           ['status'=>'rekan kerja','level'=>'I B','nilai'=>0.2],
           ['status'=>'rekan kerja','level'=>'I C','nilai'=>0.2],
           ['status'=>'rekan kerja','level'=>'IA NS','nilai'=>0.2],
           ['status'=>'rekan kerja','level'=>'I A NS','nilai'=>0.2],
           ['status'=>'rekan kerja','level'=>'II','nilai'=>0.2],
           ['status'=>'rekan kerja','level'=>'II NS','nilai'=>0.2],
           ['status'=>'rekan kerja','level'=>'III','nilai'=>0.2],
           ['status'=>'rekan kerja','level'=>'III NS','nilai'=>0.2],
           ['status'=>'rekan kerja','level'=>'IV A','nilai'=>0.2],
           ['status'=>'rekan kerja','level'=>'IV B','nilai'=>0.25],
           ['status'=>'rekan kerja','level'=>'V','nilai'=>0.25],
           
           ['status'=>'staff','level'=>'I A','nilai'=>0.15],
           ['status'=>'staff','level'=>'I B','nilai'=>0.15],
           ['status'=>'staff','level'=>'I C','nilai'=>0.15],
           ['status'=>'staff','level'=>'IA NS','nilai'=>0.15],
           ['status'=>'staff','level'=>'I A NS','nilai'=>0.15],
           ['status'=>'staff','level'=>'II','nilai'=>0.15],
           ['status'=>'staff','level'=>'II NS','nilai'=>0.15],
           ['status'=>'staff','level'=>'III','nilai'=>0.15],
           ['status'=>'staff','level'=>'III NS','nilai'=>0.15],
           ['status'=>'staff','level'=>'IV A','nilai'=>0.15],
           ['status'=>'staff','level'=>'IV B','nilai'=>0],
           ['status'=>'staff','level'=>'V','nilai'=>0],
    ];

        PercentRelation::insert($data);
    }
}
