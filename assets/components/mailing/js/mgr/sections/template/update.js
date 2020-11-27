'use strict';

Ext.namespace('Mailing.page.template');

Mailing.page.template.update = function (config) {
    config = config || {};
    Ext.applyIf(config, {
        url: Mailing.config.connectorUrl,
        formpanel: 'mailing-formpanel-template',
        components: [{
            xtype: 'mailing-formpanel-template',
            record: config.record
        }],
        buttons: this.getButtons(config),
    });
    Mailing.page.template.update.superclass.constructor.call(this, config);
};
Ext.extend(Mailing.page.template.update, MODx.Component, {
    _progressBar: null,

    getButtons: function (config) {
        return [
            this.getUpdateButton(config),
            this.getUsersProcessButton(config),
            this.getPreviewButton(config),
            this.getDeleteButton(config),
            this.getCloseButton(config)
        ];
    },

    getUpdateButton: function (config) {
        return {
            text: _('save'),
            process: 'mgr/template/update',
            method: 'remote',
            cls: 'primary-button',
            keys: [{
                key: MODx.config.keymap_save || 's',
                ctrl: true
            }]
        };
    },

    getUsersProcessButton: function (config) {
        return {
            text: _('mailing_template_users_process'),
            handler: this.usersProcess,
            scope: this
        };
    },

    getPreviewButton: function () {
        return {
            text: _('view'),
            handler: this.preview,
            scope: this
        };
    },

    getDeleteButton: function (config) {
        return {
            text: _('delete'),
            handler: this.removeRecord,
            scope: this
        };
    },

    getCloseButton: function (config) {
        return {
            text: _('close'),
            handler: this.close,
            scope: this
        };
    },

    usersProcess: function () {
        this._progressBar = Mailing.component.messageProgressBar();
        Ext.Ajax.request({
            scope: this,
            url: Mailing.config.connectorUrl,
            params: {
                action: 'mgr/template/user/export',
                template_id: this.config.record.id,
                start: 0,
                queues_count: 0,
            },
            success: function (response, opts) {
                let data = Ext.decode(response.responseText);
                if (!data.success) {
                    return Ext.Msg.alert(_('error'), data.message);
                }
                if (!data.finish) {
                    opts.params.start += data.limit;
                    opts.params.queues_count = data.queues_count;
                    this._progressBar.updateProgress(
                        opts.params.start / data.total,
                        _('mailing_progress', {count: opts.params.start, total: data.total})
                    );
                    return Ext.Ajax.request(opts);
                }
                this._progressBar.hide();
                Ext.Msg.alert(_('success'), data.message);
            },
            failure: function (response, opts) {
                console.log('failure', response);
                Ext.Msg.alert(_('error'), _('mailing_err_response', {
                    'status': response.status,
                    'text': response.statusText,
                }));
            }
        });
    },

    preview: function () {
        window.open(Mailing.config.previewUrl + '?template=' + this.config.record.id);
    },

    removeRecord: function () {
        MODx.msg.confirm({
            title: _('delete'),
            text: _('confirm_remove'),
            url: this.config.url,
            params: {
                action: 'mgr/template/remove',
                id: this.config.record.id
            },
            listeners: {
                success: {
                    fn: function (r) {
                        MODx.loadPage('mgr/templates', 'namespace=mailing')
                    }, scope: this
                }
            }
        });
    },

    close: function () {
        MODx.loadPage('mgr/templates', 'namespace=mailing')
    }
});
Ext.reg('mailing-page-template-update', Mailing.page.template.update);
