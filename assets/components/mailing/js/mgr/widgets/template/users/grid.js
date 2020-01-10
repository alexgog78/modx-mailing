'use strict';

Mailing.grid.templateUser = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'mailing-grid-templateuser';
    }
    Ext.applyIf(config, {
        url: Mailing.config.connectorUrl,
        baseParams: {
            action: 'mgr/template/user/getlist',
            user_group_id: config.userGroupId
        },
        autosave: false,
        fields: [
            'id',
            'username',
            'fullname',
            'email',
        ],
        gridColumns: {
            'username': {header: _('mailing.field.username'), width: 0.3, editor: {xtype: 'textfield'}},
            'fullname': {header: _('mailing.field.fullname'), width: 0.4},
            'email': {header: _('email'), width: 0.3, renderer: Mailing.renderer.user},
        },
        recordActions: null
    });
    Mailing.grid.templateUser.superclass.constructor.call(this, config);
};
Ext.extend(Mailing.grid.templateUser, Mailing.grid.abstract, {
    getMenu: function () {
        return [];
    },

    renderToolbar: function () {
        return [
            '->',
            this.renderSearchPanel()
        ];
    }
});
Ext.reg('mailing-grid-templateuser', Mailing.grid.templateUser);
