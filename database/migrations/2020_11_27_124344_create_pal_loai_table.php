<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePalLoaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pal_loai', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedTinyInteger('l_ma')->autoIncrement()->comment('Mã loại sản phẩm');
            $table->string('l_ten', 50)->comment('Tên loại # Tên loại sản phẩm');
            $table->timestamp('l_taoMoi')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Thời điểm tạo # Thời điểm đầu tiên tạo loại sản phẩm');
            $table->timestamp('l_capNhat')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Thời điểm cập nhật # Thời điểm cập nhật loại sản phẩm gần nhất');
            $table->tinyInteger('l_trangThai')->default('2')->comment('Trạng thái # Trạng thái loại sản phẩm: 1-khóa, 2-khả dụng');
            
            $table->unique(['l_ten']);
        });
        DB::statement("ALTER TABLE `pal_loai` comment 'Loại sản phẩm # Loại sản phẩm'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pal_loai');
    }
}
