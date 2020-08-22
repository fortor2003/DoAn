$(document).ready(function () {
    $('#phuongThucThanhToan').select2({
        placeholder: "Chọn 1 phương thức thanh toán",
        allowClear: true
    });

    $('#formThanhToan').on('submit', function (e) {


        // $phuongThucThanhToan = $('#phuongThucThanhToan').val();
        // $email = $('#email').val();
        // $soDienThoai = $('#soDienThoai').val();

        var error = 0;
        var self = $(this);

        var $phuongThucThanhToan = self.find('#phuongThucThanhToan');
        var $email = self.find('#email');
        var $soDienThoai = self.find('#soDienThoai');

        if (!$phuongThucThanhToan.val()) {
            createErrTult("Bạn phải chọn 1 phương thức thanh toán", $phuongThucThanhToan)
            error++;
        }
        var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        if (!emailRegex.test($email.val())) {
            createErrTult("Email không hợp lệ", $email)
            error++;
        }
        if ($soDienThoai.val().length === 0) {
            createErrTult("Số điện thoại không được bỏ trống", $soDienThoai)
            error++;
        }
        if (error != 0) {
            e.preventDefault();
            return;
        }
    });
});
