function getKeywords(_Keyword, _Country, _Language, _Source) {
    var data = {
        'action': 'wpkf_keywords_ajax',
        'getAjaxWPKeyword': _Keyword,
        'getAjaxWPCountry': _Country,
        'getAjaxWPLanguage': _Language,
        'getAjaxWPSource': _Source
    };
    /*
    console.log(_Keyword);
    console.log(_Country);
    console.log(_Language);
    console.log(_Source);
    */
    // evil ajaxtan donen veriyi buraya yazdiriyor

    jQuery.post(ajaxurl, data, function (response) {
        jQuery("#wpkf-title").removeAttr("style");
        jQuery("#wpkf-keywords").removeAttr("style");
        
        console.log(response);
        
        var wordsArray = response.split(', ');
        var myElement = document.getElementById("wpkf-keywords");

        for (var i = 0; i < wordsArray.length - 1; i++) {
            if (i == 0) {
                var keywordsHTML = '<span class="tag"><p>' + wordsArray[0] + '</p></span>';
            } else {
                keywordsHTML += '<span class="tag"><p>' + wordsArray[i] + '</p></span>';
            }
        }
        myElement.innerHTML = keywordsHTML;
    });
}

jQuery(document).ready(function () {
    jQuery("#wpkf-keywords").on("click", "span", function () {
        var targetText = jQuery(this).find("p").text();
        var temporaryInput = jQuery("<input>");
        jQuery("body").append(temporaryInput);
        temporaryInput.val(targetText).select();
        document.execCommand("copy");
        temporaryInput.remove();
    });
});
