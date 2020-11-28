'use strict';

Ext.namespace('Mailing.grid.template');

Mailing.grid.template.property = function (config) {
    config = config || {};
    Ext.apply(config, {
        id: 'mailing-grid-template-property',
        fields: [
            'key',
            'value'
        ],
        columns: [
            this.getGridColumn('key', {header: _('mailing_template_property_key')}),
            this.getGridColumn('value', {header: _('mailing_template_property_value')}),
        ],
    });
    Mailing.grid.template.property.superclass.constructor.call(this, config);
};
Ext.extend(Mailing.grid.template.property, Mailing.localGrid, {
    _recordWindow: null,

    createRecord: function (btn, e) {
        this.loadWindow();
        this._recordWindow.show(e.target);
    },

    updateRecord: function (btn, e) {
        this.loadWindow(this.menu.record);
        this._recordWindow.show(e.target);
    },

    removeRecord: function () {
        let key = this.menu.record.key
        let store = this.getStore()
        let idx = store.find('key', key);
        store.removeAt(idx);
    },

    loadWindow: function (record) {
        if (this._recordWindow) {
            this._recordWindow.close();
        }
        this._recordWindow = new MODx.load({
            xtype: 'modx-window-content-header',
            title: _('create'),
            record: record,
            grid: this,
            listeners: {
                success: {
                    fn: this.refresh,
                    scope: this
                }
            }
        });
    }
});
Ext.reg('mailing-grid-template-property', Mailing.grid.template.property);



