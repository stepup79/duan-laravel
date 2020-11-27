<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePalXuatxuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pal_xuatxu', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedSmallInteger('xx_ma')->autoIncrement()->comment('Mã xuất xứ');
            $table->string('xx_ten', 100)->comment('Xuất xứ # Xuất xứ của sản phẩm');
            $table->timestamp('xx_taoMoi')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Thời điểm tạo # Thời điểm đầu tiên tạo xuất xứ');
            $table->timestamp('xx_capNhat')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Thời điểm cập nhật # Thời điểm cập nhật xuất xứ gần nhất');
            $table->tinyInteger('xx_trangThai')->default('2')->comment('Trạng thái # Trạng thái xuất xứ: 1-khóa, 2-khả dụng');
        
            $table->unique(['xx_ma']);
        });
        DB::statement("ALTER TABLE `pal_xuatxu` comment 'Xuất xứ # Xuất xứ của sản phẩm'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pal_xuatxu');
    }
}
