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
            this.getGridColumn('fullname', {header: _('mailing_record_user_name'), width: 0.5, renderer: Mailing.renderer.user}),
            this.getGridColumn('email', {header: _('mailing_record_user_email'), width: 0.5}),
        ],
    });
    Mailing.grid.template.user.superclass.constructor.call(this, config);
};
Ext.extend(Mailing.grid.template.user, Mailing.grid, {
    getToolbar: function () {
        return [
            this.getSendButton(),
            '->',
            this._getSearchPanel(),
        ];
    },

    getMenu: function () {
        return [];
    },

    getSendButton: function (config = {}) {
        return this._getButton(_('mailing_send_emails'), {
            handler: this.sendEmails,
            scope: this
        });
    },

    sendEmails: function (btn, e) {
        let loadMask = this.loadMask;
        loadMask.show();
        Ext.Ajax.request({
            url: Mailing.config.connectorUrl,
            params: {
                action: 'mgr/template/user/mail',
                template_id: this.config.template.id,
                query: this.getStore().baseParams.query,
                limit: 0
            },
            success: function (response, opts) {
                loadMask.hide();
                var data = Ext.decode(response.responseText);
                console.log(data);
                if (data.success != 1) {
                    Ext.Msg.alert(_('error'), data.message);
                    return;
                }
                Ext.Msg.alert(_('success'), data.message);
            },
            failure: function (response, opts) {
                loadMask.hide();
                Ext.Msg.alert(_('error'), _('jepspayments_error_export'));
                console.log('failure', response);
            }
        });
    },
});
Ext.reg('mailing-grid-template-user', Mailing.grid.template.user);
