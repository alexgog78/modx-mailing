'use strict';

Mailing.window.log = function (config) {
    config = config || {};
    Ext.applyIf(config, {
        buttons: [{
            text: config.cancelBtnText || _('cancel'),
            scope: this,
            handler: function () {
                config.closeAction !== 'close' ? this.hide() : this.close();
            }
        }]
    });
    Mailing.window.log.superclass.constructor.call(this, config);
};
Ext.extend(Mailing.window.log, Mailing.window, {
    getFields: function (config) {
        let fields = [];
        Ext.iterate(config.record.properties, function (key, value) {
            fields.push({
                xtype: 'textarea',
                fieldLabel: key,
                value: value,
                anchor: '100%',
            });
        });
        if (!fields.length) {
            fields.push({
                xtype: 'textarea',
                value: _('mailing_status_' + config.record.status),
                anchor: '100%',
            });
        }
        return fields;
    },

    setValues: function (r) {

    },
});
Ext.reg('mailing-window-log', Mailing.window.log);
