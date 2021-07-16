(function () {
    var q = QPlayer;
    var $ = q.$;
    var plugin = q.plugin = {
        version: '1.0.0',
        setList: function (list) {
            var length = list.length;
            if (length === 0) {
                return;
            }
            var asyncList = {};
            var asyncTotal = 0;
            var asyncCount = 0;
            var asyncOffset = 0;
            var isComplete = false;
            function complete() {
                if (!isComplete || asyncCount !== asyncTotal) {
                    return;
                }
                var keys = Object.keys(asyncList);
                keys.sort();
                var length = keys.length;
                for (var i = 0; i < length; ++i) {
                    var key = keys[i];
                    var array = asyncList[key];
                    var len = array.length;
                    var index = parseInt(key) + asyncOffset;
                    splice(list, index, 1, array);
                    asyncOffset += len - 1;
                }
                q.list = list;
            }
            for (var i = 0; i < length; ++i) {
                var current = list[i];
                if (!(current.type && !current.provider)) {
                    continue;
                }
                ++asyncTotal;
                (function (i) {
                    $.ajax({
                        url: plugin.api,
                        data: current,
                        success: function (array) {
                            if (!Array.isArray(array)) {
                                return;
                            }
                            asyncList[i] = array;
                        },
                        complete: function () {
                            ++asyncCount;
                            complete();
                        }
                    });
                })(i);
            }
            isComplete = true;
            complete();
        }
    };
    function splice(source, start, deleteCount, dest) {
        var dLength = Array.isArray(dest) ? dest.length : 0;
        var sLength = source.length;
        if (start > sLength) {
            start = sLength;
        } else if (start < 0) {
            start = 0;
        }
        if (deleteCount < 0) {
            deleteCount = 0;
        }
        if (start + deleteCount > sLength) {
            deleteCount = sLength - start;
        }
        var offset = dLength - deleteCount;
        var length = sLength + offset;
        var i;
        if (offset > 0) {
            for (i = length - 1; i > start + offset - 1; --i) {
                source[i] = source[i - offset];
            }
        } else if (offset < 0) {
            for (i = start + dLength; i < sLength; ++i) {
                source[i] = source[i - offset];
            }
        }
        source.length = length;
        for (i = 0; i < dLength; ++i) {
            source[start + i] = dest[i];
        }
    }
})();