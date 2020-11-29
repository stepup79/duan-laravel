<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePalHinhanhTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pal_hinhanh', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedBigInteger('sp_ma')->comment('Sản phẩm # sp_ma # sp_ten # Mã sản phẩm');           
            $table->unsignedTinyInteger('ha_stt')->default('1')->comment('Số thứ tự # Số thứ tự hình ảnh của mỗi sản phẩm');
            $table->string('ha_ten', 150)->comment('Tên hình ảnh # Tên hình ảnh (không bao gồm đường dẫn)');           

            $table->primary(['sp_ma', 'ha_stt']);
            $table->unique(['ha_ten']);
            $table->foreign('sp_ma') //cột khóa ngoại là cột `sp_ma` trong table `hinhanh`
                ->references('sp_ma')->on('pal_sanpham'); //cột sẽ tham chiếu đến là cột `sp_ma` trong table `sanpham`
        });
        DB::statement("ALTER TABLE `pal_hinhanh` comment 'Hình ảnh sản phẩm # Các hình ảnh chi tiết của sản phẩm'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pal_hinhanh');
    }
}
