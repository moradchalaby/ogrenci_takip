jQuery.extend(jQuery.fn.dataTableExt.oSort, {
    "turkish-pre": function (a) {
        var special_letters = {
            "C": "Ca", "c": "ca", "Ç": "Cb", "ç": "cb",
            "G": "Ga", "g": "ga", "Ğ": "Gb", "ğ": "gb",
            "I": "Ia", "ı": "ia", "İ": "Ib", "i": "ib",
            "O": "Oa", "o": "oa", "Ö": "Ob", "ö": "ob",
            "S": "Sa", "s": "sa", "Ş": "Sb", "ş": "sb",
            "U": "Ua", "u": "ua", "Ü": "Ub", "ü": "ub"
        };
        for (var val in special_letters)
            a = a.split(val).join(special_letters[val]).toLowerCase();
        return a;
    },

    "turkish-asc": function (a, b) {
        return ((a < b) ? -1 : ((a > b) ? 1 : 0));
    },

    "turkish-desc": function (a, b) {
        return ((a < b) ? 1 : ((a > b) ? -1 : 0));
    }
});
