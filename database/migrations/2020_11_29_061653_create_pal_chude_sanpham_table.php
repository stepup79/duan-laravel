<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePalChudeSanphamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pal_chude_sanpham', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedBigInteger('sp_ma')->comment('Sản phẩm # sp_ma # sp_ten # Mã sản phẩm');
            $table->unsignedTinyInteger('cd_ma')->comment('Chủ để # cd_ma # cd_ten # Mã chủ đề');

            $table->primary(['sp_ma', 'cd_ma']);
            $table->foreign('sp_ma') //cột khóa ngoại là cột `sp_ma` trong table `chude_sanpham`
                ->references('sp_ma')->on('pal_sanpham'); //cột sẽ tham chiếu đến là cột `sp_ma` trong table `sanpham`
            $table->foreign('cd_ma') //cột khóa ngoại là cột `cd_ma` trong table `chude_sanpham`
                ->references('cd_ma')->on('pal_chude'); //cột sẽ tham chiếu đến là cột `cd_ma` trong table `chude`
        });
        DB::statement("ALTER TABLE `pal_chude_sanpham` comment 'Chủ đề sản phẩm # Sản phầm thuộc các chủ đề'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pal_chude_sanpham');
    }
}
