'use strict';

Mailing.notice.undefined = function (config) {
    config = config || {};
    Ext.applyIf(config, {});
    Mailing.notice.undefined.superclass.constructor.call(this, config);
};
Ext.extend(Mailing.notice.undefined, Mailing.notice.abstract, {
    panelHtml: _('mailing.field.undefined')
});
Ext.reg('mailing-notice-undefined', Mailing.notice.undefined);
