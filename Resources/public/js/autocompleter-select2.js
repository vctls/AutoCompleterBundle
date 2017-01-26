(function ($) {
    'use strict';
    $.fn.autocompleter = function (options) {

        var settings = {
            url_list:       '',
            url_get:        '',
            placeholder:    '',
            otherOptions:   { minimumInputLength: 2 }
        };

        return this.each(function () {

            if (options) {
                $.extend(true, settings, options);
            }

            var $this = $(this);

            var select2options = {

                ajax: {

                    url:         settings.url_list,
                    dataType:    'json',
                    delay:       250,
                    placeholder: settings.placeholder,

                    data: function (params) {
                        return {
                            term: params.term
                        };
                    },

                    processResults: function (data, params) {
                        return {
                            results: data,
                            pagination: {
                                more: (params.page * 30) < data.total_count
                            }
                        };
                    },

                    cache: true
                },

                escapeMarkup: function (markup) {
                    return markup;
                }
            };

            if (settings.otherOptions) {
                $.extend(true, select2options, options.otherOptions);
            }

            $this.select2(select2options);

        });
    };

})(jQuery);
