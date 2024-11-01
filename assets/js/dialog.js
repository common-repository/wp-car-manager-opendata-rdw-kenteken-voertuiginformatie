jQuery(document).ready(function ($) {

    function selectTransmission(x) {
        const cases = {
            "H": () => "manual",
            "A": () => "automactiv",
            "C": () => "semi-automatic",
        };
        const value = x;
        const result = cases[value]();
        $('select[name="wpcm-cd[transmission]"]').find('option[value="' + result + '"]').prop('selected', true).trigger('change');
    }

    function selectModel(value) {
        setTimeout(function () {
            $('select[name="wpcm-cd[model]"] > option').each(function () {
                var haystack = value;
                var needle = $(this).text();
                var needleRegExp = new RegExp(needle.replace(/[-[\]{}()*+?.,\\^$|#\s]/g, "\\$&"), "i");
                var result = needleRegExp.test(haystack);
                if (result) {
                    $('select[name="wpcm-cd[model]"]').find("option:contains(" + needle + ")").prop("selected", "selected").trigger("change");
                }
            });
        }, 900);
    }

    function calculateEngineCapacityInLiters(x) {
        var sum = x / 1000;
        var rounded = Math.round(sum * 10) / 10;
        return rounded.toFixed(1);
    }

    function kwToPk(x) {
        return (Math.round(x * 1.3596));
    }

    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1).toLowerCase();
    }

    function dateFormat(value, pattern) {
        var i = 0,
        date = value.toString();
        return pattern.replace(/#/g, _ => date[i++]);
    }

    const capitalize = (s) => {
        if (typeof s !== 'string')
            return ''
            return s.charAt(0).toUpperCase() + s.slice(1)
    }

    var $dlg = $('#amex-dialog');

    $dlg.dialog({
        draggable: true,
        autoOpen: true,
        resizable: false,
        title: amex_opendata_rdw.amex_dialog_title,
        modal: true,
        width: 515,
        height: 'auto',
        closeText: amex_opendata_rdw.amex_dialog_close,
        create: function (event, ui) {
            $("body").css({
                overflow: 'hidden'
            })
        },
        beforeClose: function (event, ui) {
            $("body").css({
                overflow: 'inherit'
            })
        },
    });

    if ($dlg.dialog('isOpen') == true) {
        var input = document.getElementById("amex_licenseplate");
        input.addEventListener("keypress", function (event) {
            if (event.keyCode === 13) {
                event.preventDefault();
                document.getElementById("dialog-submit").click();
            }
        });
        $("#amex_licenseplate").on("keyup", function (event) {
            if (event.keyCode === 13) {
                event.preventDefault();
                document.getElementById("dialog-submit").setAttribute('disabled', 'disabled');
            }
        });
    }
    if ($dlg.dialog('isOpen') == false) {
        document.getElementById("title").blur();
        document.getElementById("publish").focus();
    }

    $('#skip').click(function () {
        $('#amex-dialog').dialog('close');
    });

    $('input.nl.dialog-licenseplate').keydown(function (e) {
        if (e.keyCode == 32) {
            return false;
        }
    });

    $.extend($.expr[':'], {
        'containsi': function (elem, i, match, array) {
            return (elem.textContent || elem.innerText || '').toLowerCase()
            .indexOf((match[3] || "").toLowerCase()) >= 0;
        }
    });

    $("#dialog-submit").click(function () {

        var $this = $(this);
        $this.text(amex_opendata_rdw.amex_dialog_wait_btn)
        $this.append('<span></span>');
        $this.attr('disabled', 'disabled');

        setTimeout(function () {
            $('#amex-dialog').dialog('close');
        }, 2000);

        var myKenteken = $('#amex_licenseplate').val().toUpperCase().replace(/[^\w\s]/gi, '');

        $.ajax({
            url: "https://opendata.rdw.nl/resource/m9d7-ebf2.json",
            type: "GET",
            data: {
                "$limit": 1,
                "kenteken": myKenteken,
                "$$app_token": amex_opendata_rdw.app_token,
            },
        }).done(function (data) {

            $('select[name="wpcm-cd[condition]"]').find('option[value="used"]').prop('selected', true).trigger('change');
            $('select[name="wpcm-cd[make]"]').find('option:containsi(' + data[0].merk + ')').prop('selected', true).trigger('change');

            var dateformat = dateFormat(data[0].datum_eerste_toelating, '####-##-##');

            $('label[for="title"]').hide();
            $('input[id="title"]').removeAttr('placeholder').val(capitalizeFirstLetter(data[0].merk)).trigger('change');
            $('input[name="wpcm-cd[frdate]"]').val(dateformat);
            $('input[name="wpcm-cd[color]"]').val(capitalizeFirstLetter(data[0].eerste_kleur));
            $('input[name="wpcm-cd[body_style]"]').val(capitalize(data[0].inrichting));
            $('input[name="wpcm-cd[doors]"]').val(data[0].aantal_deuren);
            $('input[name="wpcm-cd[engine]"]').val(data[0].cilinderinhoud + 'cc' + ' (' + calculateEngineCapacityInLiters(data[0].cilinderinhoud) + 'L)'); // Engine or engine size

        }).then(function (data) {

            selectModel(data[0].handelsbenaming);

            var kleur = capitalizeFirstLetter(data[0].eerste_kleur);
            var dateY = dateFormat(data[0].datum_eerste_toelating, '####');
            setTimeout(function () {
                var model = $('select#model option:selected').text();
                var engine = calculateEngineCapacityInLiters(data[0].cilinderinhoud) + 'L';
                var power = kwToPk(data[0].nettomaximumvermogen);

                $('input[id="title"]').val(function (index, val) {
                    return val + ' ' + model + ' ' + '(' + dateY + ')';
                });
            }, 1000);

            var variantcode = data[0].variant;
            var uitvoeringscode = data[0].uitvoering;

            $.ajax({
                url: "https://opendata.rdw.nl/resource/r7cw-67gs.json",
                type: "GET",
                data: {
                    "$limit": 1,
                    "eeg_variantcode": variantcode,
                    "eeg_uitvoeringscode": uitvoeringscode,
                    "$$app_token": amex_opendata_rdw.app_token,
                },
            }).done(function (data) {
                var v_type = data[0].type_versnellingsbak;
                selectTransmission(v_type);
            });

        });

        $.ajax({
            url: "https://opendata.rdw.nl/resource/8ys7-d773.json",
            type: "GET",
            data: {
                "$limit": 10,
                "kenteken": myKenteken,
                "$$app_token": amex_opendata_rdw.app_token,
            },
        }).done(function (data) {

            $('input[name="wpcm-cd[power_kw]"]').val(Math.round(data[0].nettomaximumvermogen));
            $('input[name="wpcm-cd[power_hp]"]').val(kwToPk(data[0].nettomaximumvermogen));
            $('input[name="wpcm-cd[fuel_type]"]').val(capitalize(data[0].brandstof_omschrijving));

        });

    });

});