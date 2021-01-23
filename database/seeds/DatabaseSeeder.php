<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        // $this->call(VanchuyenTableSeeder::class);
        // $this->call(ThanhToanTableSeeder::class);
        // $this->call(LoaiTableSeeder::class);
        // $this->call(KhachhangTableSeeder::class);
        // $this->call(XuatxuTableSeeder::class);
        // $this->call(MauTableSeeder::class);
        // $this->call(ChudeTableSeeder::class);
        // $this->call(QuyenTableSeeder::class);
        // $this->call(SanphamTableSeeder::class);
        // $this->call(NhanvienTableSeeder::class);
        // $this->call(NhacungcapTableSeeder::class);

        // $this->call(DonhangTableSeeder::class);
        // $this->call(MauSanphamTableSeeder::class);
        // $this->call(GopyTableSeeder::class);
        // $this->call(ChudeSanphamTableSeeder::class);
        // $this->call(KhuyenmaiTableSeeder::class);
        // $this->call(PhieunhapTableSeeder::class);
        $this->call(ChitietdonhangTableSeeder::class);
        // $this->call(HoadonsiTableSeeder::class);
        // $this->call(HoadonleTableSeeder::class);
        // $this->call(KhuyenmaiSanphamTableSeeder::class);
        // $this->call(ChitietnhapTableSeeder::class);
        
    }
}
