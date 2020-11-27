'use strict';

Ext.namespace('Mailing.page.template');

Mailing.page = function (config) {
    config = config || {};
    Ext.applyIf(config, {
        url: Mailing.config.connectorUrl,
        formpanel: null,
        components: [],
        buttons: this.getButtons(config),
    });
    Mailing.page.superclass.constructor.call(this, config);
};
Ext.extend(Mailing.page, MODx.Component, {
    getButtons: function (config) {
        return [];
    }
});
