'use strict';

Mailing.grid.template = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'mailing-grid-template';
    }
    Ext.applyIf(config, {
        url: Mailing.config.connectorUrl,
        baseParams: {
            action: 'mgr/template/getlist'
        },
        autosave: true,
        save_action: 'mgr/template/updatefromgrid',
        saveParams: {},
        paging: true,
        remoteSort: true,
        anchor: '100%',
        fields: [
            'id',
            'name',
            'description',
            'user_group_id',
            'email_from',
            'email_from_name',
            'email_subject',
            'content',
            'created_on',
            'created_by',
            'updated_on',
            'updated_by',
            'properties',
        ],
        columns: [
            this.getGridColumn('id', {header: _('id'), width: 0.05}),
            this.getGridColumn('name', {header: _('mailing_record_name'), width: 0.8, editor: {xtype: 'textfield'}}),
            //this.getGridColumn('id', {header: _('id'), width: 0.05}),
            //this.getGridColumn('name', {header: _('mailing_record_name'), width: 0.6, editor: {xtype: 'textfield'}}),
            //this.getGridColumn('is_active', {header: _('mailing_record_active'), width: 0.1, editor: {xtype: 'combo-boolean', renderer: 'boolean'}, renderer: Mailing.renderer.boolean}),
            this.getGridColumn('created_on', {header: _('mailing_record_createdon'), width: 0.1}),
            this.getGridColumn('updated_on', {header: _('mailing_record_updatedon'), width: 0.1}),
        ],
    });
    Mailing.grid.template.superclass.constructor.call(this, config);
};
Ext.extend(Mailing.grid.template, MODx.grid.Grid, {
    initComponent: function () {
        this.tbar = this.getToolbar();
        this.viewConfig = Ext.applyIf(this.config.viewConfig, {
            getRowClass: this.getRowClass
        });
        Mailing.grid.template.superclass.initComponent.call(this);
    },

    getGridColumn: function (name, config = {}) {
        return Ext.applyIf(config, {
            dataIndex: name,
            header: name,
            sortable: true,
        });
    },

    getToolbar: function () {
        return [
            this.getCreateButton(),
            '->',
            this.getSearchPanel(),
        ];
    },

    getMenu: function () {
        return [{
            text: _('edit'),
            handler: this._updateRecord,
            scope: this
        }, '-', {
            text: _('delete'),
            handler: this._removeRecord,
            scope: this
        }];
    },

    getCreateButton: function (config = {}) {
        return this._getButton(_('add'), {
            handler: this._createRecord,
            scope: this
        });
    },

    getSearchPanel: function () {
        return [
            this._getSearchField(),
            this._getClearSearchButton()
        ];
    },

    _getButton: function (text, config = {}) {
        return Ext.applyIf(config, {
            xtype: 'button',
            text: text,
            cls: 'primary-button',
            scope: this
        });
    },

    _createRecord: function (btn, e) {
        MODx.loadPage('mgr/template/create', 'namespace=mailing');
    },

    _updateRecord: function (btn, e) {
        MODx.loadPage('mgr/template/update', 'namespace=mailing&id=' + this.menu.record.id);
    },

    _removeRecord: function (btn, e) {
        MODx.msg.confirm({
            title: _('delete'),
            text: _('confirm_remove'),
            url: this.config.url,
            params: {
                id: this.menu.record.id,
                action: 'mgr/template/remove',
            },
            listeners: {
                success: {fn: this.refresh, scope: this},
            }
        });
    },

    _getSearchField: function () {
        return {
            xtype: 'textfield',
            name: 'search',
            id: this.config.id + '-filter-search',
            cls: 'x-form-filter',
            emptyText: _('search_ellipsis'),
            listeners: {
                'change': {fn: this._filterSearch, scope: this},
                'render': {
                    fn: function (cmp) {
                        new Ext.KeyMap(cmp.getEl(), {
                            key: Ext.EventObject.ENTER,
                            fn: this.blur,
                            scope: cmp
                        });
                    }, scope: this
                }
            }
        };
    },

    _getClearSearchButton: function () {
        return this._getButton(_('filter_clear'), {
            id: this.config.id + '-filter-clear',
            cls: 'x-form-filter-clear',
            listeners: {
                'click': {fn: this._filterClear, scope: this},
                'mouseout': {
                    fn: function (evt) {
                        this.removeClass('x-btn-focus');
                    }
                }
            }
        });
    },

    _filterSearch: function (tf, newValue, oldValue) {
        var query = newValue || tf.getValue();
        this.getStore().baseParams.query = query;
        this.getBottomToolbar().changePage(1);
    },

    _filterClear: function () {
        this.getStore().baseParams.query = null;
        Ext.getCmp(this.config.id + '-filter-search').reset();
        this.getBottomToolbar().changePage(1);
    },
});
Ext.reg('mailing-grid-template', Mailing.grid.template);
