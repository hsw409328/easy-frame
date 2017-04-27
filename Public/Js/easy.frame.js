/**
 * Created by haoshuaiwei on 2017/4/26.
 */

var ef = ef || {};
var ef = (function () {
    ef.init = function () {
        console.log('感谢您使用EasyFrame Javascript');
        console.log('Email:409328820@qq.com');
        console.log('WebSite:www.51hsw.com');
        console.log('Github:www.github.com/hsw409328');
    };
    ef.eventbind = function (obj, event, data, fn) {
        $(obj).bind(event, data, fn);
    };
    /**
     * Ajax Get请求
     * @param url 不可为空
     * @param data 参数，可为空
     * @param fn 不可为空，回调函数
     */
    ef.get = function (url, data, fn) {
        if ($.trim(url) == '') {
            return false;
        }
        $.get(url, data, fn);
    };
    /**
     * Ajax Post请求
     * @param url 不可为空
     * @param data 可为空
     * @param fn 不可为空，回调函数
     */
    ef.post = function (url, data, fn) {
        if ($.trim(url) == '') {
            return false;
        }
        $.post(url, data, fn);
    };
    /**
     * Ajax 跨域请求，仅支持GET
     * @param url 不可为空
     * @param data 参数
     * @param fn 回调成功处理函数
     * @param error_fn 回调失败处理函数
     */
    ef.jsonp = function (url, data, fn, error_fn) {
        if ($.trim(url) == '') {
            return false;
        }
        $.ajax({
            url: url,
            dataType: 'jsonp',
            processData: false,
            type: 'get',
            success: fn,
            error: error_fn
        });
    };
    return {
        init: ef.init,
        eventbind: ef.eventbind,
        get: ef.get,
        post: ef.post,
        jsonp: ef.jsonp
    }
})();