<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePalDonhangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pal_donhang', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('dh_ma')->comment('Mã đơn hàng, 1-Không xuất hóa đơn');
            $table->unsignedBigInteger('kh_ma')->comment('Khách hàng # kh_ma # kh_hoTen # Mã khách hàng');
            $table->dateTime('dh_thoiGianDatHang')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Thời điểm đặt hàng # Thời điểm đặt hàng');
            $table->dateTime('dh_thoiGianNhanHang')->comment('Thời điểm giao hàng # Thời điểm giao hàng theo yêu cầu của khách hàng');
            $table->string('dh_nguoiNhan', 100)->comment('Người nhận quà # Họ tên người nhận (tên hiển thị)');
            $table->string('dh_diaChi', 191)->comment('Địa chỉ người nhận # Địa chỉ người nhận');
            $table->string('dh_dienThoai', 11)->comment('Điện thoại người nhận # Điện thoại người nhận');
            $table->string('dh_nguoiGui', 100)->comment('Người tặng quà # Người tặng (tên hiển thị)');
            $table->text('dh_loiChuc')->default(NULL)->comment('Lời chúc # Lời chúc ghi trên thiệp');
            $table->unsignedTinyInteger('dh_daThanhToan')->default('0')->comment('Đã thanh toán # Đã thanh toán tiền (trường hợp tặng quà)');
            $table->unsignedSmallInteger('nv_xuLy')->default('1')->comment('Xử lý đơn hàng # nv_ma # nv_hoTen # Mã nhân viên (người xử lý đơn hàng), 1-chưa phân công');
            $table->dateTime('dh_ngayXuLy')->default(NULL)->comment('Thời điểm xử lý # Thời điểm xử lý đơn hàng');
            $table->unsignedSmallInteger('nv_giaoHang')->default('1')->comment('Giao hàng # nv_ma # nv_hoTen # Mã nhân viên (người lập phiếu giao hàng và giao hàng), 1-chưa phân công');
            $table->dateTime('dh_ngayLapPhieuGiao')->default(NULL)->comment('Thời điểm lập phiếu giao # Thời điểm lập phiếu giao');
            $table->dateTime('dh_ngayGiaoHang')->default(NULL)->comment('Thời điểm khách nhận được hàng # Thời điểm khách nhận được hàng');
            $table->timestamp('dh_taoMoi')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Thời điểm tạo # Thời điểm đầu tiên tạo đơn hàng');
            $table->timestamp('dh_capNhat')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Thời điểm cập nhật # Thời điểm cập nhật đơn hàng gần nhất');
            $table->unsignedTinyInteger('dh_trangThai')->default('1')->comment('Trạng thái # Trạng thái đơn hàng: 1-nhận đơn, 2-xử lý đơn, 3-giao hàng, 4-hoàn tất, 5-đổi trả, 6-hủy');
            $table->unsignedTinyInteger('vc_ma')->comment('Dịch vụ giao hàng # vc_ma # vc_ten # Mã dịch vụ giao hàng');
            $table->unsignedTinyInteger('tt_ma')->comment('Phương thức thanh toán # tt_ma # tt_ten # Mã phương thức thanh toán');

            $table->foreign('kh_ma') //cột khóa ngoại là cột `kh_ma` trong table `donhang`
                ->references('kh_ma')->on('pal_khachhang'); //cột sẽ tham chiếu đến là cột `kh_ma` trong table `khachhang`
            $table->foreign('nv_xuLy') //cột khóa ngoại là cột `nv_xuLy` trong table `donhang`
                ->references('nv_ma')->on('pal_nhanvien'); //cột sẽ tham chiếu đến là cột `nv_ma` trong table `nhanvien`
            $table->foreign('nv_giaoHang') //cột khóa ngoại là cột `nv_giaoHang` trong table `donhang`
                ->references('nv_ma')->on('pal_nhanvien'); //cột sẽ tham chiếu đến là cột `nv_ma` trong table `nhanvien`
            $table->foreign('vc_ma') //cột khóa ngoại là cột `vc_ma` trong table `donhang`
                ->references('vc_ma')->on('pal_vanchuyen'); //cột sẽ tham chiếu đến là cột `vc_ma` trong table `vanchuyen`
            $table->foreign('tt_ma') //cột khóa ngoại là cột `tt_ma` trong table `donhang`
                ->references('tt_ma')->on('pal_thanhtoan'); //cột sẽ tham chiếu đến là cột `tt_ma` trong table `thanhtoan`
        });
        DB::statement("ALTER TABLE `pal_donhang` comment 'Đơn hàng # Đơn hàng'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pal_donhang');
    }
}
