<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePalGopyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pal_gopy', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('gy_ma')->comment('Mã góp ý');
            $table->dateTime('gy_thoiGian')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Thời điểm góp ý # Thời điểm góp ý');
            $table->text('gy_noiDung')->comment('Góp ý # Nội dung góp ý');
            $table->unsignedBigInteger('kh_ma')->comment('Khách hàng # kh_ma # kh_hoTen # Mã khách hàng');
            $table->unsignedBigInteger('sp_ma')->comment('Sản phẩm # sp_ma # sp_ten # Mã sản phẩm');
            $table->unsignedTinyInteger('gy_trangThai')->default('3')->comment('Trạng thái # Trạng thái góp ý: 1-khóa, 2-hiển thị, 3-chờ duyệt');

            $table->foreign('kh_ma') //cột khóa ngoại là cột `kh_ma` trong table `gopy`
                ->references('kh_ma')->on('pal_khachhang'); //cột sẽ tham chiếu đến là cột `kh_ma` trong table `khachhang`
            $table->foreign('sp_ma') //cột khóa ngoại là cột `sp_ma` trong table `gopy`
                ->references('sp_ma')->on('pal_sanpham'); //cột sẽ tham chiếu đến là cột `sp_ma` trong table `sanpham`
        });
        DB::statement("ALTER TABLE `pal_gopy` comment 'Góp ý # Góp ý'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pal_gopy');
    }
}
