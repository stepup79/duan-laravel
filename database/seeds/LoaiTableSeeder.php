<?php

use Illuminate\Database\Seeder;

class LoaiTableSeeder extends Seeder
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

        $type = ["Hoa lẻ", "Phụ kiện", "Bó hoa", "Giỏ hoa", "Hoa hộp giấy",
                    "Kệ hoa", "Vòng hoa", "Bình hoa", "Hoa hộp gỗ"];
        sort($type);

        $today = new DateTime('2019-01-01 08:00:00');

        for ($i=1; $i <= count($type); $i++) {
            array_push($list, [
                'l_ma'      => $i,
                'l_ten'     => $type[$i-1],
                'l_taoMoi'  => $today->format('Y-m-d H:i:s'),
                'l_capNhat' => $today->format('Y-m-d H:i:s'),
                'l_trangThai' => 2
            ]);
        }
        DB::table('pal_loai')->insert($list);
    }
}
