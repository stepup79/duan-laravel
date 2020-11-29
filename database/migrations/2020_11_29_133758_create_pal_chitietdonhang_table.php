<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePalChitietdonhangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pal_chitietdonhang', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedBigInteger('dh_ma')->comment('Đơn hàng # dh_ma # dh_ma # Mã đơn hàng');
            $table->unsignedBigInteger('sp_ma')->comment('Sản phẩm # sp_ma # sp_ten # Mã sản phẩm');
            $table->unsignedTinyInteger('m_ma')->comment('Màu sắc # m_ma # m_ten # Mã màu sản phẩm, 1-Phối màu (đỏ, vàng, ...)');
            $table->unsignedSmallInteger('ctdh_soLuong')->default('1')->comment('Số lượng # Số lượng sản phẩm đặt mua');
            $table->unsignedInteger('ctdh_donGia')->default('1')->comment('Đơn giá # Giá bán');

            $table->primary(['dh_ma', 'sp_ma', 'm_ma']);
            $table->foreign('dh_ma') //cột khóa ngoại là cột `dh_ma` trong table `chitietdonhang`
                ->references('dh_ma')->on('pal_donhang'); //cột sẽ tham chiếu đến là cột `dh_ma` trong table `donhang`
            $table->foreign('sp_ma') //cột khóa ngoại là cột `sp_ma` trong table `chitietdonhang`
                ->references('sp_ma')->on('pal_sanpham'); //cột sẽ tham chiếu đến là cột `sp_ma` trong table `sanpham`
            $table->foreign('m_ma') //cột khóa ngoại là cột `m_ma` trong table `chitietdonhang`
                ->references('m_ma')->on('pal_mau'); //cột sẽ tham chiếu đến là cột `m_ma` trong table `mau`
        });
        DB::statement("ALTER TABLE `pal_chitietdonhang` comment 'Chi tiết đơn hàng # Chi tiết đơn hàng: sản phẩm, màu, số lượng, đơn giá, đơn hàng'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pal_chitietdonhang');
    }
}
