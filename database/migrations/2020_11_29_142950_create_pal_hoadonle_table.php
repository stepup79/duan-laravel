<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePalHoadonleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pal_hoadonle', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('hdl_ma')->comment('Mã hóa đơn bán lẻ');
            $table->string('hdl_nguoiMuaHang', 100)->comment('Người mua hàng # Họ tên người mua hàng');
            $table->string('hdl_dienThoai', 11)->comment('Điện thoại # Điện thoại');
            $table->string('hdl_diaChi', 191)->comment('Địa chỉ # Địa chỉ');
            $table->unsignedSmallInteger('nv_lapHoaDon')->comment('Lập hóa đơn # nv_ma # nv_hoTen # Mã nhân viên (người lập hóa đơn)');
            $table->dateTime('hdl_ngayXuatHoaDon')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Thời điểm xuất # Thời điểm xuất hóa đơn');
            $table->unsignedBigInteger('dh_ma')->default('1')->comment('Đơn hàng # dh_ma # dh_ma # Mã đơn hàng, 1-Không xuất hóa đơn');
            
            $table->foreign('nv_lapHoaDon') //cột khóa ngoại là cột `nv_lapHoaDon` trong table `hoadonle`
                ->references('nv_ma')->on('pal_nhanvien'); //cột sẽ tham chiếu đến là cột `nv_ma` trong table `nhanvien`
            $table->foreign('dh_ma') //cột khóa ngoại là cột `dh_ma` trong table `hoadonle`
                ->references('dh_ma')->on('pal_donhang'); //cột sẽ tham chiếu đến là cột `dh_ma` trong table `donhang`
        });
        DB::statement("ALTER TABLE `pal_hoadonle` comment 'Hóa đơn bán lẻ # Hóa đơn bán lẻ: sản phẩm, màu, số lượng, đơn giá, đơn hàng'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pal_hoadonle');
    }
}
