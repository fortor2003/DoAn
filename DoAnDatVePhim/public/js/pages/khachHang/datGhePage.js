$(document).ready(function () {

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

//data elements init
    var sum = 0;
    var cheap = 0;
    var middle = 0;
    var expansive = 0;

    $('.sits__place').click(function (e) {
        e.preventDefault();
        var place = $(this).attr('data-place');
        var ticketPrice = $(this).attr('data-price');

        if (!$(e.target).hasClass('sits-state--your')) {

            if (!$(this).hasClass('sits-state--not')) {
                $(this).addClass('sits-state--your');

                $('.checked-place').prepend('<span class="choosen-place ' + place + '">' + place + '</span>');

                switch (ticketPrice) {
                    case '10':
                        sum += 10;
                        cheap += 1;
                        break;
                    case '20':
                        sum += 20;
                        middle += 1;
                        break;
                    case '30':
                        sum += 30;
                        expansive += 1;
                        break;
                }

                $('.checked-result').text('$' + sum);
            }
        } else {
            $(this).removeClass('sits-state--your');

            $('.' + place + '').remove();

            switch (ticketPrice) {
                case '10':
                    sum -= 10;
                    cheap -= 1;
                    break;
                case '20':
                    sum -= 20;
                    middle -= 1;
                    break;
                case '30':
                    sum -= 30;
                    expansive -= 1;
                    break;
            }

            $('.checked-result').text('$' + sum)
        }

        //data element init
        var number = $('.checked-place').children().length;

        //data element set
        numberTicket.val(number);
        sumTicket.val(sum);
        cheapTicket.val(cheap);
        middleTicket.val(middle);
        expansiveTicket.val(expansive);


        //data element init
        var chooseSits = '';
        $('.choosen-place').each(function () {
            chooseSits += ', ' + $(this).text();
        });

        //data element set
        sits.val(chooseSits.substr(2));
    });

//--- Step for data  ---//
//Get data from pvevius page
    var url = decodeURIComponent(document.URL);
    var prevDate = url.substr(url.indexOf('?') + 1);

//Serialize, add new data and send to next page
    $('.booking-form').submit(function (e) {
        e.preventDefault();
        var bookData = $(this).serialize();

        var fullData = prevDate + '&' + bookData
        var action,
            control = $('.order__control-btn.active').text();

        if (control == "Purchase") {
            action = 'book3-buy.html';
        } else if (control == "Reserve") {
            action = 'book3-reserve.html';
        }

        $.get(action, fullData, function (data) {
        });
    });

    $('.top-scroll').parent().find('.top-scroll').remove();

//4. Choosing sits mobile
//init select box
    $('.sits__sort').selectbox({
        onChange: function (val, inst) {

            $(inst.input[0]).children().each(function (item) {
                $(this).removeAttr('selected');
            })
            $(inst.input[0]).find('[value="' + val + '"]').attr('selected', 'selected');
        }

    });

//add new sits line
    $('.add-sits-line').click(function (e) {
        e.preventDefault();
        var temp = $('<div class="sits-select"><select name="sorting_item" class="sits__sort sit-row" tabindex="0"><option selected="selected" value="1">A</option><option value="2">B</option><option value="3">C</option><option value="4">D</option><option value="5">E</option><option value="6">F</option><option value="7">G</option> <option value="8">I</option><option value="9">J</option><option value="10">K</option><option value="11">L</option></select><select name="sorting_item" class="sits__sort sit-number" tabindex="1"><option selected="selected" value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option></select><a href="#" class="btn btn-md btn--warning toogle-sits">Choose sit</a></div>');
        temp.find('.toogle-sits').click(ChoosePlace);
        temp.find('.sits__sort').selectbox({
            onChange: function (val, inst) {

                $(inst.input[0]).children().each(function (item) {
                    $(this).removeAttr('selected');
                })
                $(inst.input[0]).find('[value="' + val + '"]').attr('selected', 'selected');
            }

        });
        $('.sits-area--mobile-wrap').append(temp);


        $(this).blur();

    });

//choose sits
    $('.toogle-sits').click(ChoosePlace);


    function ChoosePlace(e) {
        e.preventDefault();

        var row = $(this).parent().find('.sit-row option[selected="selected"]').text();
        var number = $(this).parent().find('.sit-number option[selected="selected"]').text();
        var ch_sits = row + number;
        var ticketPrice = 0;

        if ($('.checked-place').find(".choosen-place[data-sit='" + ch_sits + "']").length) {
            alert('same place');
            return 0;
        }


        $('.sits-area--mobile .checked-place').prepend('<span class="choosen-place" data-sit="' + ch_sits + '">' + ch_sits + '</span>');

        if (row == "A" || row == "B" || row == "C" || row == "D") {
            ticketPrice = 10;
        } else if (row == "E" || row == "F" || row == "G" || row == "I") {
            ticketPrice = 20;
        } else if (row == "J" || row == "K" || row == "L") {
            ticketPrice = 30;
        }

        switch (ticketPrice) {
            case 10:
                sum += 10;
                break;
            case 20:
                sum += 20;
                break;
            case 30:
                sum += 30;
                break;
        }

        $('.checked-result').text('$' + sum);


        $(this).removeClass('btn--warning').unbind('click', ChoosePlace);
        $(this).addClass('btn--danger').text('remove sit').blur();


        $(this).click(function (e) {
            e.preventDefault();

            var row = $(this).parent().find('.sit-row option[selected="selected"]').text();
            var numbers = $(this).parent().find('.sit-number option[selected="selected"]').text();
            var ch_sit = row + number;

            var activeSit = $('.checked-place').find(".choosen-place[data-sit='" + ch_sits + "']");

            if (activeSit.length) {
                activeSit.remove();
                $(this).parent().remove();

                if (row == "A" || row == "B" || row == "C" || row == "D") {
                    ticketPrice = 10;
                } else if (row == "E" || row == "F" || row == "G" || row == "I") {
                    ticketPrice = 20;
                } else if (row == "J" || row == "K" || row == "L") {
                    ticketPrice = 30;
                }

                switch (ticketPrice) {
                    case 10:
                        sum -= 10;
                        break;
                    case 20:
                        sum -= 20;
                        break;
                    case 30:
                        sum -= 30;
                        break;
                }

                $('.checked-result').text('$' + sum);
            }
        })
    }
});
