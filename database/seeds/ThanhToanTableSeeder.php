<?php

use Illuminate\Database\Seeder;

class ThanhToanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $list =[];

        $type = ["Tiền mặt", "Thanh toán tại cửa hàng", "Chuyển khoản"];
        sort($type);
        $des = ["tt Tiền mặt", "tt Thanh toán tại cửa hàng", "tt Chuyển khoản"];
        sort($des);

        $today = new DateTime('2020-01-01 08:00:00');
        for ($i=1; $i <= count($type); $i++) {
            array_push($list,[
                'tt_ma'        => $i,
                'tt_ten'       => $type[$i-1],
                'tt_dienGiai'  => $des[$i-1],
                'tt_taoMoi'    => $today->format('Y-m-d H:i:s'),
                'tt_capNhat'   => $today->format('Y-m-d H:i:s'),
                'tt_trangThai' => 2
            ]);
        }
        DB::table('pal_thanhtoan')->insert($list);        
    }
}
