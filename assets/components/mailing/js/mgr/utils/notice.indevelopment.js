'use strict';

Mailing.notice.indevelopment = function (config) {
    config = config || {};
    Ext.applyIf(config, {});
    Mailing.notice.indevelopment.superclass.constructor.call(this, config);
};
Ext.extend(Mailing.notice.indevelopment, Mailing.notice.abstract, {
    panelHtml: _('mailing.field.indevelopment')
});
Ext.reg('mailing-notice-indevelopment', Mailing.notice.indevelopment);
