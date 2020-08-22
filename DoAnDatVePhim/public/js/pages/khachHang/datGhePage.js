var danhSachDongHoDemNguoc = [];
var suatChieuId = null;
var sum = 0;

$(document).ready(function () {
    suatChieuId = $('#suatChieuId').val();
    //1. Buttons for choose order method
    //order factor
    $('.order__control-btn').click(function (e) {
        e.preventDefault();

        $('.order__control-btn').removeClass('active');
        $(this).addClass('active');
    })

    //2. Init vars for order data
    // var for booking;
    var numberTicket = $('.choosen-number'),
        sumTicket = $('.choosen-cost'),
        cheapTicket = $('.choosen-number--cheap'),
        middleTicket = $('.choosen-number--middle'),
        expansiveTicket = $('.choosen-number--expansive'),
        sits = $('.choosen-sits');

    //3. Choose sits (and count price for them)
    //users choose sits


    $('.sits__place').click(function (e) {
        e.preventDefault();
        var place = $(this).attr('data-place');
        var ticketPrice = parseInt($(this).attr('data-price'));
        if (!$(e.target).hasClass('sits-state--your')) {
            if (!$(this).hasClass('sits-state--not') && !$(this).hasClass('sits-state--sold') && !$(this).hasClass('sits-state--wait-for-pay')) {
                $(this).addClass('sits-state--your');
                $('.checked-place').prepend('<span class="choosen-place ' + place + '">' + place + '</span>');
                sum += ticketPrice;
                $('.checked-result').text('đ ' + sum.toLocaleString());
            }
        } else {
            $(this).removeClass('sits-state--your');
            $('.' + place + '').remove();
            sum -= ticketPrice;
            $('.checked-result').text('đ ' + sum.toLocaleString());
        }
    });

    //--- Step for data  ---//
    //Get data from pvevius page
    var url = decodeURIComponent(document.URL);
    var prevDate = url.substr(url.indexOf('?') + 1);

    $('.top-scroll').parent().find('.top-scroll').remove();

    // Lấy danh sách trạng thái của ghế
    apiCall('suat-chieu/' + suatChieuId + '/ghe?tinh_trang=DA_THANH_TOAN', 'get', null).then(data => {
        capNhatTinhTrangGhe(data);
    });

    // Lắng nghe các sự kiện realtime
    Echo.private('KhachHang.DatVe.' + suatChieuId)
        .listen('.TaoDonDatVeEvent', (e) => {
            console.log('Da nhan trang thai ghe moi');
            capNhatTinhTrangGhe(e);
        });

    //Serialize, add new data and send to next page
    $('#formDatGhe').on('submit', function (e) {
        const danhSachGheId = $.map($('.sits-state--your[data-ghe-id]'), function (el, i) {
            return parseInt($(el).attr('data-ghe-id'));
        });
        if (!danhSachGheId || danhSachGheId.length === 0) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Bạn phải chọn ghế để có thể đến bước kế tiếp',
                confirmButtonText: 'Đã hiểu'
            })
        }
        $('#danhSachGheId').val(JSON.stringify(danhSachGheId));
    });
});

function capNhatTinhTrangGhe(tinhTrang) {
    danhSachDongHoDemNguoc.forEach(timer => {
        clearInterval(timer);
    });
    danhSachDongHoDemNguoc = [];
    danhSachGheChoThanhToan = tinhTrang.ghe_cho_thanh_toan;
    danhSachGheDaThanhToan = tinhTrang.ghe_da_thanh_toan;
    // Cập nhật giao diện các ghế đã thanh toán
    $(danhSachGheDaThanhToan.map(item => '.sits__place[data-ghe-id="' + item.ghe_id + '"]').join(',')).each(function () {
        let sitPlace = $(this);
        if (sitPlace.hasClass('sits-state--your')) {
            const price = parseInt(sitPlace.data('price'));
            const place = sitPlace.data('place');
            sum -= price;
            $('.checked-place .' + place).remove();
        }
        sitPlace.removeClass('sits-state--sold sits-state--wait-for-pay sits-state--your').addClass('sits-state--sold');
    });
    // Cập nhật giao diện các ghế chờ thanh toán
    danhSachGheChoThanhToan.forEach(ghe => {
        let sitPlace = $('.sits__place[data-ghe-id="' + ghe.ghe_id + '"]');
        if (sitPlace.hasClass('sits-state--your')) {
            const price = parseInt(sitPlace.data('price'));
            const place = sitPlace.data('place');
            sum -= price;
            $('.checked-place .' + place).remove();
        }
        sitPlace.removeClass('sits-state--sold sits-state--wait-for-pay sits-state--your').addClass('sits-state--wait-for-pay').html('&nbsp;').css('text-indent', 1);
        let soGiayDemNguoc = ghe.so_giay_dem_nguoc;
        sitPlace.html(soGiayDemNguoc-- + ' s');
        let timer = setInterval(function () {
            if (soGiayDemNguoc > 0) {
                sitPlace.html(soGiayDemNguoc-- + ' s');
            } else {
                sitPlace.removeClass('sits-state--wait-for-pay').css('text-indent', -9999);
                clearInterval(timer);
            }
        }, 1000);
        danhSachDongHoDemNguoc.push(timer);
    });
    capNhatTongTien();
}

function capNhatTongTien() {
    $('.checked-result').text('đ ' + sum.toLocaleString());
}
