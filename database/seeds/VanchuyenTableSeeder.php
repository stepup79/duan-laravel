<?php

use Illuminate\Database\Seeder;

class VanchuyenTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $list = [];
        $faker    = Faker\Factory::create('vi_VN');

        for ($i=1; $i <= 5; $i++) {
            $today = new DateTime();
            array_push($list, [
                'vc_ten'                  => "vc_ten $i",
                'vc_chiPhi'               => $faker->numberBetween(25000, 35000, 50000),
                'vc_dienGiai'             => "vc_dienGiai $i",
                'vc_taoMoi'               => $today->format('Y-m-d H:i:s'),
                'vc_capNhat'              => $today->format('Y-m-d H:i:s'),
                'vc_trangThai'            => $faker->numberBetween(1, 2)
            ]);
        }
        DB::table('pal_vanchuyen')->insert($list);
    }
}
