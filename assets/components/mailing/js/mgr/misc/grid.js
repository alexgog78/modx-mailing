'use strict';

Mailing.grid = function (config) {
    config = config || {};
    Ext.applyIf(config, {
        url: Mailing.config.connectorUrl,
        autosave: true,
        saveParams: {},
        paging: true,
        remoteSort: true,
        anchor: '100%',
        fields: [],
        columns: [],
    });
    Mailing.grid.superclass.constructor.call(this, config);
};
Ext.extend(Mailing.grid, MODx.grid.Grid, {
    initComponent: function () {
        this.tbar = this.getToolbar();
        this.viewConfig = Ext.applyIf(this.config.viewConfig, {
            getRowClass: this.getRowClass
        });
        Mailing.grid.superclass.initComponent.call(this);
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
            this._getCreateButton(),
            '->',
            this._getSearchPanel(),
        ];
    },

    getMenu: function () {
        return [{
            text: _('edit'),
            handler: this.updateRecord,
            scope: this
        }, '-', {
            text: _('delete'),
            handler: this.removeRecord,
            scope: this
        }];
    },

    _getCreateButton: function (config = {}) {
        return this._getButton(_('add'), {
            handler: this.createRecord,
            scope: this
        });
    },

    _getSearchPanel: function () {
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
