<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePalMauSanphamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pal_mau_sanpham', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedBigInteger('sp_ma')->comment('Màu sắc # m_ma # m_ten # Mã sản phẩm');
            $table->unsignedTinyInteger('m_ma')->comment('Sản phẩm # sp_ma # sp_ten # Mã màu sản phẩm');
            $table->unsignedSmallInteger('msp_soluong')->default('0')->comment('Số lượng # Số lượng sản phẩm tương ứng với màu');

            $table->primary(['sp_ma', 'm_ma']);
            $table->foreign('sp_ma') //cột khóa ngoại là cột `sp_ma` trong table `mau_sanpham`
                ->references('sp_ma')->on('pal_sanpham'); //cột sẽ tham chiếu đến là cột `sp_ma` trong table `sanpham` 
            $table->foreign('m_ma') //cột khóa ngoại là cột `m_ma` trong table `mau_sanpham`
                ->references('m_ma')->on('pal_mau'); //cột sẽ tham chiếu đến là cột `m_ma` trong table `mau` 
        });
        DB::statement("ALTER TABLE `pal_mau_sanpham` comment 'Số lượng sản phẩm theo màu # Số lượng sản phẩm tương ứng với các màu'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pal_mau_sanpham');
    }
}
