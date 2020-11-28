'use strict';

Ext.namespace('Mailing.window.template');

Mailing.window.template.property = function (config) {
    config = config || {};
    Ext.apply(config, {});
    Mailing.window.template.property.superclass.constructor.call(this, config);
};
Ext.extend(Mailing.window.template.property, Mailing.window, {
    getFields: function (config) {
        return [{
            xtype: 'textfield',
            name: 'key',
            fieldLabel: _('mailing_template_property_key'),
            anchor: '100%',
            allowBlank: false,
        }, {
            xtype: 'textfield',
            name: 'value',
            fieldLabel: _('mailing_template_property_value'),
            anchor: '100%',
            allowBlank: false,
        }];
    },

    beforeSubmit: function (record) {
        if (!this.fp.getForm().isValid()) {
            return false;
        }
        return true;
    },

    submit: function (close) {
        let values = this.fp.getForm().getValues();
        let store = this.grid.getStore();
        if (!this.fireEvent('beforeSubmit', values)) {
            return false;
        }
        if (this.config.record && this.config.record.key) {
            let idx = store.find('key', this.config.record.key);
            store.removeAt(idx);
            store.add(new Ext.data.Record(values));
        } else {
            store.add(new Ext.data.Record(values));
        }
        this.close();
    }
});
Ext.reg('modx-window-content-header', Mailing.window.template.property);
