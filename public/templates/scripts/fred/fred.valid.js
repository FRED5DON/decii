;(function ($, undefined) {
    "use strict";

    var pluginName = 'fred_valid';

    function Valid(value, options) {
        this.options = $.extend({}, $.fn[pluginName].defaults, options);
        //$.each(this.methods, function(k, v) {
        //    self.allowed_rules.push(k);
        //});
    }

    $.extend(Valid.prototype, {
        validate: function (options) {
            var self = this;
            var result = undefined;
            options = options || $.fn[pluginName].defaults;
            if (typeof options === 'object') {
                $.each(options, function (idx, e) {
                    var raw = e['value'];
                    var rules = e['rules'];//{}
                    var errmsg = e['msg'] || '';
                    $.each(rules, function (key, value) {
                        if (self.validType[value] &&
                            typeof self.validType[value] === 'function') {
                            var bool = self.validType[value](null, raw);
                            if (!bool) {
                                result = {'msg': errmsg};
                                return false;
                            }
                        }
                        if (typeof value === 'object') {
                            $.each(value, function (i, re) {
                                if (self.validType[i] &&
                                    typeof self.validType[i] === 'function') {
                                    var bool = self.validType[i](null, raw, re);
                                    if (!bool) {
                                        result = {'msg': errmsg};
                                        return false;
                                    }
                                }
                            });
                        }
                    });
                    if (result) {
                        return false;
                    }
                });
                return result;
            }
        },
        validType: {
            not_empty: function (field, value) {
                return value !== null && $.trim(value).length > 0;
            },
            min_length: function (field, value, min_len, all_rules) {
                var length = $.trim(value).length
                    , result = (length >= min_len);
                if (all_rules && !all_rules['not_empty']) {
                    result = result || length === 0;
                }
                return result;
            },

            max_length: function (field, value, max_len) {
                return $.trim(value).length <= max_len;
            },

            regex: function (field, value, regexp) {
                return regexp.test(value);
            },

            email: function (field, value) {
                // by Scott Gonzalez: http://projects.scottsplayground.com/email_address_validation/
                var regex = /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))$/i;
                return regex.test($.trim(value));
            },

            url: function (field, value) {
                // by Scott Gonzalez: http://projects.scottsplayground.com/iri/
                var regex = /^(https?|ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i;
                return regex.test(value);
            },

            exact_length: function (field, value, exact_length, all_rules) {
                var length = $.trim(value).length
                    , result = (length === exact_length);
                if (!all_rules['not_empty']) {
                    result = result || length === 0;
                }
                return result;
            },

            equals: function (field, value, target) {
                return value === target;
            },

            ip: function (field, value) {
                var regex = /^((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){3}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})$/i;
                return regex.test($.trim(value));
            },

            credit_card: function (field, value) {
                // accept only spaces, digits and dashes
                if (/[^0-9 \-]+/.test(value)) {
                    return false;
                }
                var nCheck = 0
                    , nDigit = 0
                    , bEven = false;

                value = value.replace(/\D/g, "");

                for (var n = value.length - 1; n >= 0; n--) {
                    var cDigit = value.charAt(n);
                    nDigit = parseInt(cDigit, 10);
                    if (bEven) {
                        if ((nDigit *= 2) > 9) {
                            nDigit -= 9;
                        }
                    }
                    nCheck += nDigit;
                    bEven = !bEven;
                }

                return (nCheck % 10) === 0;
            },

            alpha: function (field, value) {
                var regex = /^[a-z]*$/i;
                return regex.test(value);
            },

            abc_dash: function (field, value) {
                var regex = /^[a-z_]*$/i;
                return regex.test(value);
            },
            abcnums_dash: function (field, value) {
                var regex = /^[a-zA-Z0-9_]*$/i;
                return regex.test(value);
            },
            abcsignal_dash: function (field, value) {
                var regex = /^[a-zA-Z0-9_@\.]*$/i;
                return regex.test(value);
            },
            alpha_numeric: function (field, value) {
                var regex = /^[a-z0-9]*$/i;
                return regex.test(value);
            },

            alpha_dash: function (field, value) {
                var regex = /^[a-z0-9_\-]*$/i;
                return regex.test(value);
            },
            alphas_dash: function (field, value) {
                var regex = /^[a-zA-Z0-9_\-]*$/i;
                return regex.test(value);
            },
            digit: function (field, value) {
                var regex = /^\d*$/;
                return regex.test(value);
            },

            numeric: function (field, value) {
                var regex = /^([\+\-]?[0-9]+(\.[0-9]+)?)?$/;
                return regex.test(value);
            },

            // same as numeric
            decimal: function (field, value) {
                var regex = /^([\+\-]?[0-9]+(\.[0-9]+)?)?$/;
                return regex.test(value);
            },
            matches: function (field, value, sValue) {
                return value === sValue;
            }
        },


    });

    /**
     * main function to use on a form (like $('#form).scojs_valid({...})). Performs validation of the form, sets the error messages on form inputs and returns
     * true/false depending on whether the form passed validation or not
     *
     * @param {hash|string} options the hash of rules and messages to validate the form against (and messages to show if failed validation) or the string "option"
     * @param {string} key the option key to retrieve or set. If the third param of the function is available then act as a setter, otherwise as a getter.
     * @param {mixed} value the value to set on the key
     */
    $.fn[pluginName] = function (options) {
        var args = Array.prototype.slice.call(arguments);
        // 合并参数
        return this.each(function (idx, self) {
            // 在这里编写相应的代码进行处理
            var ui = $._data(this, pluginName);
            // 如果该元素没有初始化过(可能是新添加的元素), 就初始化它.
            if (!ui) {
                var opts = $.extend(true, {}, $.fn[pluginName].defaults, typeof options === "object" ? options : {});
                ui = new Valid(self, opts);
                // 缓存插件
                $._data(this, pluginName, ui);
            }
            // 调用方法
            if (typeof options === "string" && typeof ui[options] == "function") {
                // 执行插件的方法
                args = args.slice(1);
                ui[options].apply(ui, args);
            }
            if (typeof options === "object") {
                ui['validate'].apply(ui, args);
            }
        });
    };


    $[pluginName] = function (options) {
        return new Valid(null, options);
    };


    $.fn[pluginName].defaults = {
        rules: [], messages: {}
    };
})(jQuery);