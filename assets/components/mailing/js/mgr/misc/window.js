'use strict';

Mailing.window = function (config) {
    config = config || {};
    Ext.applyIf(config, {
        url: null,
        action: null,
        record: [],
        fields: this.getFields(config),
        width: config.width || 600,
        autoHeight: true,
    });
    Mailing.window.superclass.constructor.call(this, config);
    this.on('beforeshow', this.beforeshow, this);
    this.on('hide', this.onhide, this);
    this.on('beforeSubmit', this.beforeSubmit, this);
    this.on('success', this.success, this);
    this.on('failure', this.failure, this);
};
Ext.extend(Mailing.window, MODx.Window, {
    getFields: function (config) {
        return [];
    },

    beforeshow: function () {
        this.reset();
        return true;
    },

    onhide: function () {
        return true;
    },

    beforeSubmit: function (record) {
        return false;
    },

    success: function (result) {
    },

    failure: function (result) {
    }
});
