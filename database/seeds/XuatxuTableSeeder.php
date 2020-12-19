<?php

use Illuminate\Database\Seeder;

class XuatxuTableSeeder extends Seeder
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

        for ($i=1; $i <= 30; $i++) {
            $today = new DateTime();
            array_push($list, [
                'xx_ten'                  => "xx_ten $i",
                'xx_taoMoi'               => $today->format('Y-m-d H:i:s'),
                'xx_capNhat'              => $today->format('Y-m-d H:i:s'),
                'xx_trangThai'            => $faker->numberBetween(1, 2)
            ]);
        }
        DB::table('pal_xuatxu')->insert($list);
    }
}
