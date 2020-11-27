'use strict';

Mailing.component = {
    messageProgressBar: function (config = {}) {
        return Ext.Msg.show(Ext.applyIf(config, {
            title: _('please_wait'),
            msg: _('saving'),
            width: 410,
            progress: true,
            closable: false,
        }));
    },

    messageWait: function (config = {}) {
        return Ext.Msg.show(Ext.applyIf(config, {
            title: _('please_wait'),
            msg: _('saving'),
            width: 300,
            wait: true,
            closable: false,
        }));
    },
}
