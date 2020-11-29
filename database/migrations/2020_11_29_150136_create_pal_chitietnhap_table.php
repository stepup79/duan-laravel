<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePalChitietnhapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pal_chitietnhap', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedBigInteger('pn_ma')->comment('Phiếu nhập # pn_ma # pn_ma # Mã phiếu nhập');
            $table->unsignedBigInteger('sp_ma')->comment('Sản phẩm # sp_ma # sp_ten # Mã sản phẩm');
            $table->unsignedTinyInteger('m_ma')->comment('Màu sắc # m_ma # m_ten # Mã màu sản phẩm, 1-Phối màu (đỏ, vàng, ...)');
            $table->unsignedSmallInteger('ctn_soLuong')->default('1')->comment('Số lượng # Số lượng sản phẩm nhập kho');
            $table->unsignedInteger('ctn_donGia')->default('1')->comment('Đơn giá nhập # Giá nhập kho của sản phẩm');

            $table->primary(['pn_ma', 'sp_ma', 'm_ma']);
            $table->foreign('pn_ma') //cột khóa ngoại là cột `pn_ma` trong table `chitietnhap`
                ->references('pn_ma')->on('pal_phieunhap'); //cột sẽ tham chiếu đến là cột `pn_ma` trong table `phieunhap`
            $table->foreign('sp_ma') //cột khóa ngoại là cột `sp_ma` trong table `chitietnhap`
                ->references('sp_ma')->on('pal_sanpham'); //cột sẽ tham chiếu đến là cột `sp_ma` trong table `sanpham`
            $table->foreign('m_ma') //cột khóa ngoại là cột `m_ma` trong table `chitietnhap`
                ->references('m_ma')->on('pal_mau'); //cột sẽ tham chiếu đến là cột `m_ma` trong table `mau`
        });
        DB::statement("ALTER TABLE `pal_chitietnhap` comment 'Chi tiết nhập # Chi tiết phiếu nhập: sản phẩm, màu, số lượng, đơn giá, phiếu nhập'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pal_chitietnhap');
    }
}
