'use strict';

Mailing.renderer = {
    boolean: function (value, cell, row) {
        switch (value) {
            case 0:
            case '0':
            case false:
                cell.css = 'red';
                return _('no');
                break;
            case 1:
            case '1':
            case true:
                cell.css = 'green';
                return _('yes');
                break;
            default:
                return '-';
                break;
        }
    },

    user: function (value, cell, row) {
        if (!value) {
            return '';
        }
        var id = row.get('user_id');
        if (!id) {
            return value;
        }
        return String.format(
            '<a href="?a=security/user/update&id={0}" target="_blank">{1}</a>',
            id,
            value
        );
    },

    template: function (value, cell, row) {
        if (!value) {
            return '';
        }
        var id = row.get('template_id');
        if (!id) {
            return value;
        }
        return String.format(
            '<a href="?a=mgr/template/update&namespace=mailing&id={0}" target="_blank">{1}</a>',
            id,
            value
        );
    }
};
