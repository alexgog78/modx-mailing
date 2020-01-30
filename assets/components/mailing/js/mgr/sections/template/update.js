'use strict';

Ext.namespace('Mailing.page.template');

/*Ext.onReady(function () {
    MODx.add({
        xtype: 'mailing-page-template-update',
        recordId: MODx.request.id
    });
});*/

Mailing.page.template.update = function (config) {
    config = config || {};
    Ext.applyIf(config, {
        url: Mailing.config.connectorUrl,
        formpanel: 'mailing-formpanel-template',
        components: [{
            xtype: 'mailing-formpanel-template',
            renderTo: 'modx-panel-holder',
            recordId: config.recordId,
            record: config.record
        }]
    });
    Mailing.page.template.update.superclass.constructor.call(this, config);
};
Ext.extend(Mailing.page.template.update, Mailing.page.abstract, {
    getButtons: function () {
        return [
            this.renderSaveButton(),
            this.renderQueueButton(),
            this.renderDeleteButton(),
            this.renderViewButton(),
            this.renderCloseButton()
        ];
    },

    renderSaveButton: function () {
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

    renderQueueButton: function () {
        return {
            text: _('mailing.action.add_queues'),
            cls: 'primary-button',
            handler: this.addQueues,
            scope: this
        };
    },

    renderDeleteButton: function () {
        return {
            text: _('delete'),
            handler: this.delete,
            scope: this
        };
    },

    renderViewButton: function () {
        return {
            text: _('view'),
            handler: this.preview,
            scope: this
        };
    },

    renderCloseButton: function () {
        return {
            text: _('close'),
            handler: this.close,
            scope: this
        };
    },

    addQueues: function () {
        console.log('addQueues');


        //if (!this.fireEvent('beforeClearCache')) { return false; }

        var topic = '/queueimport/';
        var register = 'zzz';

        this.console = Ext.getCmp('zzzz');
        if (this.console) {
            this.console.close();
        }

        this.console = MODx.load({
            xtype: 'modx-console',
            id: 'zzzz'
            ,register: register
            ,topic: topic
            ,clear: true
            ,show_filename: 0
            ,listeners: {
                'shutdown': {fn:function() {
                        /*if (this.fireEvent('afterClearCache')) {
                            if (MODx.config.clear_cache_refresh_trees == 1) {
                                Ext.getCmp('modx-layout').refreshTrees();
                            }
                        }*/
                        console.log('shutdown');

                        //this.hideConsole();

                        /*MODx.msg.status({
                            title: _('success')
                            ,message: '1111'
                            ,dontHide: false
                        });*/

                    },scope:this}
            }
        });

        this.console.show(Ext.getBody());


        MODx.Ajax.request({
            url: Mailing.config.connectorUrl
            ,params: {
                action: 'mgr/queue/import',
                id: this.config.recordId

                ,register: register
                ,topic: topic
            }
            ,listeners: {
                'success':{fn:function() {
                        this.console.fireEvent('complete');
                        //this.console.hide();
                    },scope:this}
            }
        });

        /*MODx.Ajax.request({
            url: MODx.config.connector_url
            ,params: {
                action: 'system/clearcache'
                ,register: 'mgr'
                ,topic: topic
                ,media_sources: true
                ,menu: true
                ,action_map: true
            }
            ,listeners: {
                'success':{fn:function() {
                        this.console.fireEvent('complete');
                    },scope:this}
            }
        });*/
        return true;




    },

    delete: function () {
        MODx.msg.confirm({
            title: _('delete'),
            text: _('confirm_remove'),
            url: this.config.url,
            params: {
                action: 'mgr/template/remove',
                id: this.config.recordId
            },
            listeners: {
                success: {
                    fn: function (r) {
                        MODx.loadPage('mgr/templates', 'namespace=mailing');
                    }, scope: this
                }
            }
        });
    },

    preview: function () {
        window.open(Mailing.config.previewUrl + '?template=' + this.config.recordId);
    },

    close: function () {
        MODx.loadPage('mgr/templates', 'namespace=mailing')
    }
});
Ext.reg('mailing-page-template-update', Mailing.page.template.update);
