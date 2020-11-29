<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePalMauTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pal_mau', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedTinyInteger('m_ma')->autoIncrement()->comment('Mã màu sản phẩm, 1-Phối màu (đỏ, vàng, ...)');
            $table->string('m_ten', 50)->comment('Tên màu # Tên màu sản phẩm');
            $table->timestamp('m_taoMoi')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Thời điểm tạo # Thời điểm đầu tiên tạo màu');
            $table->timestamp('m_capNhat')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Thời điểm cập nhật # Thời điểm cập nhật màu gần nhất');
            $table->tinyInteger('m_trangThai')->default('2')->comment('Trạng thái # Trạng thái màu sản phẩm: 1-khóa, 2-khả dụng');
        
            $table->unique(['m_ten']);
        });
        DB::statement("ALTER TABLE `pal_mau` comment 'Màu sắc # Màu sản phẩm'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pal_mau');
    }
}
