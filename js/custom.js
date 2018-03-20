$( document ).ready(function() {
    $("#mainCountry").change(function() {
        var zip = $('#postZipCode').val();
        var country = $('select[name=Country]').val();

        if( zip.length > 0 ) {
            getCityState(country, zip);
        }
    });

    $("#postZipCode").blur(function() {
        var zip = $('#postZipCode').val();
        var country = $('select[name=Country]').val();

        if( country.length > 0 )
            getCityState(country, zip);
    });
});

function getCityState(country, zip) {
    if( country.length > 0 && zip.length > 0 ) {
        var username = 'larrydanny'; // please change the username with your username
        $.ajax({
            type: 'post',
            url: "./index.php?search=true",
            data: "postalcode=" + zip + "&country=" + country + "&username=" + username,
            complete: function(data, status) {
                console.log(data, status);
                var  postalCode = $.parseJSON(data.responseText);

                if(status == "success" && postalCode.postalCodes.length > 0) {
                    $('#city').val( postalCode.postalCodes[0].placeName );

                    if( typeof(postalCode.postalCodes[0].adminName1) === 'undefined' ) {
                        if( typeof(postalCode.postalCodes[0].adminName2) === 'undefined' ) {
                            $('#provinceState').val( postalCode.postalCodes[0].adminName3 );
                        } else {
                            $('#provinceState').val( postalCode.postalCodes[0].adminName2 );
                        }
                    } else {
                        $('#provinceState').val( postalCode.postalCodes[0].adminName1 );
                    }
                    $('#city-error').hide();
                    $('#provinceState-error').hide();
                } else {
                    $('#city').val( "");
                    $('#provinceState').val( "");
                }
            }
        });
    }
}