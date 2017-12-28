if ($(this).val().length < 3) {
        return;
    }

    return getOptions();
});

// получить список стран
var getOptions = function() {

    var str = $('.js_input').val();

    $.ajax({
        url: "/server.php?s=" + str,
        type: "GET",
        success: function(res) {
            var array = JSON.parse(res);
            return renderOptions(array);
        },
        error: function(err) {
            console.log(err);
        }
    });
};

// добавить options в select
var renderOptions = function(array) {

    var options = '<option>Не выбрано</option>';

    if (array.length) {
        for (var i = 0; i < array.length; i++) {
            options += '<option value="' + array[i] + '">' + array[i] + '</option>'
        }
    }

    $('.js_select').empty().html(options);
};