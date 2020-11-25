'use strict';

Mailing.combo.UserGroup = function (config) {
    config = config || {};
    Ext.applyIf(config, {
        name: 'user_group_id',
        hiddenName: 'user_group_id',
    });
    Mailing.combo.UserGroup.superclass.constructor.call(this, config);
};
Ext.extend(Mailing.combo.UserGroup, MODx.combo.UserGroup, {});
Ext.reg('mailing-combo-usergroup', Mailing.combo.UserGroup);
