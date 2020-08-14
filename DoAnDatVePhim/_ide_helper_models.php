<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Ghe
 *
 * @property int $ID
 * @property int $PHONG_CHIEU_ID
 * @property string $MA_HANG
 * @property int $THU_TU_TRONG_HANG
 * @property string $LOAI_GHE
 * @property string $THOI_DIEM_TAO
 * @property string $THOI_DIEM_CAP_NHAT
 * @property-read \App\Models\PhongChieu $phongChieu
 * @method static \Illuminate\Database\Eloquent\Builder|Ghe newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ghe newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ghe query()
 */
	class Ghe extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Phim
 *
 * @property int $ID ID
 * @property int|null $EXTERNAL_ID
 * @property string|null $THE_LOAI_EXTERNAL_ID
 * @property string $TIEU_DE_GOC
 * @property string $TIEU_DE_VI
 * @property string $DIEM_DANH_GIA
 * @property int $THOI_LUONG_CHIEU Thời lượng chiếu tính bằng phút
 * @property string|null $QUOC_GIA_SAN_XUAT
 * @property string|null $NHA_SAN_XUAT
 * @property string|null $DAO_DIEN
 * @property string|null $DIEN_VIEN
 * @property string $NGAY_PHAT_HANH
 * @property string|null $NGAY_KHOI_CHIEU
 * @property string|null $NGAY_KET_THUC
 * @property string|null $NOI_DUNG_TOM_TAT
 * @property string|null $URL_ANH_BIA
 * @property string|null $URL_ANH_PHONG_NEN
 * @property string|null $URL_TRAILER_VIDEO
 * @property string $THOI_DIEM_TAO
 * @property string $THOI_DIEM_CAP_NHAT
 * @property string|null $TRANG_THAI
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TheLoai[] $danhSachTheLoai
 * @property-read int|null $danh_sach_the_loai_count
 * @method static \Illuminate\Database\Eloquent\Builder|Phim newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Phim newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Phim query()
 */
	class Phim extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PhimTheLoai
 *
 * @property int $ID ID
 * @property int $PHIM_ID
 * @property int $THE_LOAI_ID
 * @property string $THOI_DIEM_TAO
 * @property string $THOI_DIEM_CAP_NHAT
 * @property-read \App\Models\Phim $phim
 * @property-read \App\Models\TheLoai $theLoai
 * @method static \Illuminate\Database\Eloquent\Builder|PhimTheLoai newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PhimTheLoai newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PhimTheLoai query()
 */
	class PhimTheLoai extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PhongChieu
 *
 * @property int $ID ID
 * @property int $RAP_ID Xác định rạp mà phòng chiếu này thuộc về
 * @property string $TEN_PHONG Tên Phòng
 * @property int $SUC_CHUA Sức chưa
 * @property string $THOI_DIEM_TAO
 * @property string $THOI_DIEM_CAP_NHAT
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Ghe[] $danhSachGhe
 * @property-read int|null $danh_sach_ghe_count
 * @property-read \App\Models\Rap $rap
 * @method static \Illuminate\Database\Eloquent\Builder|PhongChieu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PhongChieu newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PhongChieu query()
 */
	class PhongChieu extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Rap
 *
 * @property int $ID
 * @property string $TEN_RAP
 * @property string|null $DIA_CHI
 * @property string|null $SO_DIEN_THOAI
 * @property string|null $MO_TA
 * @property string $THOI_DIEM_TAO
 * @property string $THOI_DIEM_CAP_NHAT
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PhongChieu[] $danhSachPhongChieu
 * @property-read int|null $danh_sach_phong_chieu_count
 * @method static \Illuminate\Database\Eloquent\Builder|Rap newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rap newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rap query()
 */
	class Rap extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TaiKhoan
 *
 * @property int $ID ID
 * @property string $EMAIL
 * @property string $MAT_KHAU
 * @property string $LOAI_VAI_TRO
 * @property string $HO_TEN
 * @property string|null $SO_DIEN_THOAI
 * @property int $DIEM_THUONG
 * @property string $THOI_DIEM_TAO
 * @property string $THOI_DIEM_CAP_NHAT
 * @property string|null $THOI_DIEM_KICH_HOAT
 * @property string|null $REMEMBER_TOKEN
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|TaiKhoan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TaiKhoan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TaiKhoan query()
 */
	class TaiKhoan extends \Eloquent implements \Illuminate\Contracts\Auth\MustVerifyEmail {}
}

namespace App\Models{
/**
 * App\Models\TheLoai
 *
 * @property int $ID ID
 * @property int|null $EXTERNAL_ID
 * @property string $TEN_THE_LOAI
 * @property string $THOI_DIEM_TAO
 * @property string $THOI_DIEM_CAP_NHAT
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Phim[] $danhSachPhim
 * @property-read int|null $danh_sach_phim_count
 * @method static \Illuminate\Database\Eloquent\Builder|TheLoai newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TheLoai newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TheLoai query()
 */
	class TheLoai extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\XacThucUrl
 *
 * @property int $ID
 * @property int $TAI_KHOAN_ID
 * @property string $LOAI
 * @property string $SIGNATURE
 * @property string $THOI_DIEM_TAO
 * @property string $THOI_DIEM_CAP_NHAT
 * @property-read \App\Models\TaiKhoan $taiKhoan
 * @method static \Illuminate\Database\Eloquent\Builder|XacThucUrl newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|XacThucUrl newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|XacThucUrl query()
 */
	class XacThucUrl extends \Eloquent {}
}

