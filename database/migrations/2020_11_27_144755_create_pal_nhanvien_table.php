<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePalNhanvienTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pal_nhanvien', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedSmallInteger('nv_ma')->autoIncrement()->comment('Mã nhân viên, 1-chưa phân công');
            $table->string('nv_taiKhoan', 50)->comment('Tài khoản # Tài khoản');
            $table->string('nv_matKhau', 191)->comment('Mật khẩu # Mật khẩu');
            $table->string('nv_hoTen', 100)->comment('Họ tên # Họ tên');
            $table->tinyInteger('nv_gioiTinh')->default('1')->comment('Giới tính # Giới tính: 0-Nữ, 1-Nam, 2-Khác');
            $table->string('nv_email', 100)->comment('Email # Email');
            $table->dateTime('nv_ngaySinh')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Ngày sinh # Ngày sinh');
            $table->string('nv_diaChi', 191)->comment('Địa chỉ # Địa chỉ');
            $table->string('nv_dienThoai', 11)->comment('Điện thoại # Điện thoại');
            $table->timestamp('nv_taoMoi')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Thời điểm tạo # Thời điểm đầu tiên tạo nhân viên');
            $table->timestamp('nv_capNhat')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Thời điểm cập nhật # Thời điểm cập nhật nhân viên gần nhất');
            $table->tinyInteger('nv_trangThai')->default('2')->comment('Trạng thái # Trạng thái nhân viên: 1-khóa, 2-khả dụng');
            $table->unsignedTinyInteger('q_ma')->comment('Quyền # Mã quyền: 1-Giám đốc, 2-Quản trị, 3-Quản lý kho, 4-Kế toán, 5-Nhân viên bán hàng, 6-Nhân viên giao hàng');
            $table->string('nv_ghinhodangnhap', 191)->default(NULL)->comment('Ghi nhớ đăng nhập');
            
            $table->unique(['nv_ma']);
            $table->unique(['nv_gioiTinh']);
            $table->unique(['q_ma']);
            $table->foreign('q_ma') //cột khóa ngoại là cột `q_ma` trong table `nhanvien`
                ->references('q_ma')->on('pal_quyen'); //cột sẽ tham chiếu đến là cột `q_ma` trong table `quyen`         
        });
        DB::statement("ALTER TABLE `pal_nhanvien` comment 'Nhân viên # Nhân viên'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pal_nhanvien');
    }
}
