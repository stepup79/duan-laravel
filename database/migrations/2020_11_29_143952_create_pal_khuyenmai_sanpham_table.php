<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePalKhuyenmaiSanphamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pal_khuyenmai_sanpham', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedBigInteger('km_ma')->comment('Chương trình # km_ma # km_ten # Mã chương trình khuyến mãi');
            $table->unsignedBigInteger('sp_ma')->comment('Sản phẩm # sp_ma # sp_ten # Mã sản phẩm');
            $table->unsignedTinyInteger('m_ma')->comment('Màu sắc # m_ma # m_ten # Mã màu sản phẩm, 1-Phối màu (đỏ, vàng, ...)');
            $table->string('kmsp_giaTri', 50)->default('100;0')->comment('Giá trị khuyến mãi # Giá trị khuyến mãi (giảm tiền/giảm % tiền, số lượng), định dạng: tien;soLuong (soLuong = 0, không giới hạn số lượng)');
            $table->unsignedTinyInteger('kmsp_trangThai')->default('2')->comment('Trạng thái # Trạng thái khuyến mãi: 1-ngưng khuyến mãi, 2-có hiệu lực');

            $table->primary(['km_ma', 'sp_ma', 'm_ma']);
            $table->foreign('km_ma') //cột khóa ngoại là cột `km_ma` trong table `khuyenmai_sanpham`
                ->references('km_ma')->on('pal_khuyenmai'); //cột sẽ tham chiếu đến là cột `km_ma` trong table `khuyenmai`
            $table->foreign('sp_ma') //cột khóa ngoại là cột `sp_ma` trong table `khuyenmai_sanpham`
                ->references('sp_ma')->on('pal_sanpham'); //cột sẽ tham chiếu đến là cột `sp_ma` trong table `sanpham`
            $table->foreign('m_ma') //cột khóa ngoại là cột `m_ma` trong table `khuyenmai_sanpham`
                ->references('m_ma')->on('pal_mau'); //cột sẽ tham chiếu đến là cột `m_ma` trong table `mau`
        });
        DB::statement("ALTER TABLE `pal_khuyenmai_sanpham` comment 'Thông tin khuyến mãi sản phẩm # Chi tiết về chương trình khuyến mãi'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pal_khuyenmai_sanpham');
    }
}
