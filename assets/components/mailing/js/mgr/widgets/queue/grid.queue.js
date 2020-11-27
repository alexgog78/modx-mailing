'use strict';

Mailing.grid.queue = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'mailing-grid-queue';
    }
    Ext.applyIf(config, {
        baseParams: {
            action: 'mgr/queue/getlist'
        },
        autosave: false,
        fields: [
            'id',
            'template_id',
            'template_name',
            'user_id',
            'user_email',
            'status',
            'created_on',
        ],
        columns: [
            this.getGridColumn('id', {header: _('id'), width: 0.05}),
            this.getGridColumn('template_name', {header: _('mailing_template_name'), width: 0.3}),
            this.getGridColumn('user_email', {header: _('mailing_user_email'), width: 0.4}),
            this.getGridColumn('status', {header: _('mailing_queue_status'), width: 0.1, renderer: Mailing.renderer.status}),
            this.getGridColumn('created_on', {header: _('mailing_queue_createdon'), width: 0.1}),
        ],
    });
    Mailing.grid.queue.superclass.constructor.call(this, config);
};
Ext.extend(Mailing.grid.queue, Mailing.grid, {
    _progressBar: null,

    getToolbar: function () {
        return [
            this.getProcessAllButton(),
            this.getRemoveSuccessButton(),
            this.getRemoveAllButton(),
            '->',
            this._getSearchPanel(),
        ];
    },

    getMenu: function () {
        return [{
            text: _('mailing_queue_process'),
            handler: this.processRecord,
            scope: this
        }, '-', {
            text: _('delete'),
            handler: this.removeRecord,
            scope: this
        }];
    },

    getProcessAllButton: function () {
        return this._getButton(_('mailing_queue_process_all'), {
            handler: this.processAll,
            scope: this
        });
    },

    getRemoveSuccessButton: function () {
        return this._getButton(_('mailing_queue_clear_success'), {
            cls: '',
            handler: this.removeSuccessRecords,
            scope: this
        });
    },

    getRemoveAllButton: function () {
        return this._getButton(_('mailing_queue_clear_all'), {
            cls: '',
            handler: this.removeAllRecords,
            scope: this
        });
    },

    processRecord: function (btn, e) {
        MODx.msg.confirm({
            title: _('mailing_queue_process'),
            text: _('mailing_queue_process_confirm'),
            url: this.config.url,
            params: {
                id: this.menu.record.id,
                action: 'mgr/queue/process',
            },
            listeners: {
                success: {
                    fn: function (response) {
                        Ext.Msg.alert(_('success'), response.message);
                        this.refresh();
                    }, scope: this
                },
                failure: {
                    fn: function (response) {
                        this.refresh();
                    }, scope: this
                }
            }
        });
    },

    processAll: function (btn, e) {
        Ext.Msg.confirm(_('mailing_queue_process_all'), _('mailing_queue_process_all_confirm'), function (e) {
            if (e == 'yes') {
                console.log('processAll');
                this._progressBar = Mailing.component.messageProgressBar();
                Ext.Ajax.request({
                    scope: this,
                    url: Mailing.config.connectorUrl,
                    params: {
                        action: 'mgr/queue/processall',
                        start: 0,
                        queues_count: 0,
                    },
                    success: function (response, opts) {
                        let data = Ext.decode(response.responseText);
                        if (!data.success) {
                            return Ext.Msg.alert(_('error'), data.message);
                        }
                        console.log(data);
                        if (!data.finish) {
                            opts.params.start += data.limit;
                            opts.params.queues_count = data.queues_count;
                            this._progressBar.updateProgress(opts.params.start / data.total, 'Обработано: ' + opts.params.start + ' из: ' + data.total + '...');
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
            } else {
                this.fireEvent('cancel');
            }
        }, this);
    },

    removeSuccessRecords: function (btn, e) {
        MODx.msg.confirm({
            title: _('delete'),
            text: _('confirm_remove'),
            url: this.config.url,
            params: {
                action: 'mgr/queue/removemultiple',
                only_success: true,
            },
            listeners: {
                success: {fn: this._filterClear, scope: this},
            }
        });
    },

    removeAllRecords: function (btn, e) {
        MODx.msg.confirm({
            title: _('delete'),
            text: _('confirm_remove'),
            url: this.config.url,
            params: {
                action: 'mgr/queue/removemultiple',
            },
            listeners: {
                success: {fn: this._filterClear, scope: this},
            }
        });
    },

    removeRecord: function (btn, e) {
        MODx.msg.confirm({
            title: _('delete'),
            text: _('confirm_remove'),
            url: this.config.url,
            params: {
                id: this.menu.record.id,
                action: 'mgr/queue/remove',
            },
            listeners: {
                success: {fn: this.refresh, scope: this},
            }
        });
    },
});
Ext.reg('mailing-grid-queue', Mailing.grid.queue);
