'use strict';

Ext.namespace('Mailing.grid.template');

Mailing.grid.template.user = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'mailing-grid-template-user';
    }
    Ext.applyIf(config, {
        baseParams: {
            action: 'mgr/template/user/getlist',
            template_id: config.template.id,
        },
        autosave: false,
        fields: [
            'id',
            'user_id',
            'fullname',
            'email',
        ],
        columns: [
            this.getGridColumn('fullname', {header: _('mailing_user_name'), width: 0.5, renderer: Mailing.renderer.user}),
            this.getGridColumn('email', {header: _('mailing_user_email'), width: 0.5}),
        ],
    });
    Mailing.grid.template.user.superclass.constructor.call(this, config);
};
Ext.extend(Mailing.grid.template.user, Mailing.grid, {
    getToolbar: function () {
        return [
            '->',
            this._getSearchPanel(),
        ];
    },

    getMenu: function () {
        return [];
    },
});
Ext.reg('mailing-grid-template-user', Mailing.grid.template.user);
