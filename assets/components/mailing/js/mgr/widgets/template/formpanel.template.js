'use strict';

Mailing.formPanel.template = function (config) {
    config = config || {};
    Ext.applyIf(config, {
        id: 'mailing-formpanel-template',
        items: [
            this.getHeader((config.record ? _('mailing_template_editing') : _('mailing_template_creating')), {id: 'mailing-formpanel-template-header'}),
            this.getMainPartTabs([{
                title: _('mailing_template_settings'),
                items: [
                    this.getDescription(_('mailing_template_settings_management')),
                    this.getContent([
                        this.getMainForm(config),
                    ]),
                ]
            }, {
                title: _('mailing_template_content'),
                forceLayout: true,
                items: [
                    this.getDescription(_('mailing_template_content_management')),
                    this.getContent([
                        this.getTemplateForm(),
                    ]),
                ]
            }, {
                title: _('mailing_template_users'),
                items: [
                    this.getDescription(_('mailing_template_users_management')),
                    this.getContent([
                        this.getUsersGrid(config.record),
                    ]),
                ]
            }, {
                title: _('mailing_template_properties'),
                items: [
                    this.getDescription(_('mailing_template_properties_management')),
                    this.getContent([
                        this.getPropertiesGrid(),
                    ]),
                ]
            }]),
        ],
    });
    Mailing.formPanel.template.superclass.constructor.call(this, config);
};
Ext.extend(Mailing.formPanel.template, Mailing.formPanel, {
    setup: function () {
        if (this.record) {
            Ext.getCmp('mailing-formpanel-template-header').html = _('mailing_template_editing', {name: this.record.name});
        }
        return Mailing.formPanel.template.superclass.setup.call(this);
    },

    success: function (o) {
        if (!this.record) {
            MODx.loadPage('mgr/template/update', 'namespace=mailing&id=' + o.result.object.id);
        }
        return Mailing.formPanel.template.superclass.success.call(this, o);
    },

    getMainForm: function (config) {
        return [
            {xtype: 'hidden', name: 'id'},
            {
                layout: 'column',
                defaults: {msgTarget: 'under', border: false, anchor: '100%'},
                items: [{
                    columnWidth: .5,
                    layout: 'form',
                    defaults: {msgTarget: 'under', border: false, anchor: '100%'},
                    items: [
                        this.getFormInput('name', {fieldLabel: _('mailing_template_name')}),
                        this.getFormInput('user_group_id', {
                            xtype: 'mailing-combo-usergroup',
                            fieldLabel: _('mailing_template_user_group'),
                            listeners: {
                                'change': {
                                    fn: this.updateUsersGrid, scope: this
                                }
                            }
                        }),
                        this.getFormInput('email_from', {fieldLabel: _('mailing_template_email_from')}),
                        this.getFormInput('email_from_name', {fieldLabel: _('mailing_template_email_from_name')}),
                        this.getFormInput('email_subject', {fieldLabel: _('mailing_template_email_subject')}),
                    ]
                }, {
                    columnWidth: .5,
                    layout: 'form',
                    defaults: {msgTarget: 'under', border: false, anchor: '100%'},
                    items: [
                        this.getFormInput('description', {
                            xtype: 'textarea',
                            fieldLabel: _('mailing_template_description'),
                            height: 308
                        }),
                    ]
                }]
            },
            this.getLogSection(config.record),
        ];
    },

    getTemplateForm: function () {
        return this.getFormInput('content', {
            xtype: Ext.ComponentMgr.isRegistered('modx-texteditor') ? 'modx-texteditor' : 'textarea',
            mimeType: 'text/html',
            fieldLabel: _('mailing_template_content_html'),
            height: 400,
        });
    },

    getUsersGrid: function (record = []) {
        if (!record || record.length === 0) {
            return {
                html: _('mailing_undefined'),
                cls: 'panel-desc',
                style: {
                    fontSize: '170%',
                    textAlign: 'center'
                }
            };
        }
        return {xtype: 'mailing-grid-template-user', template: record};
    },

    //TODO
    getPropertiesGrid: function () {
        return {
            html: _('mailing_indevelopment'),
            cls: 'panel-desc',
            style: {
                fontSize: '170%',
                textAlign: 'center'
            }
        };
    },

    updateUsersGrid: function (tf, newValue, oldValue) {
        let grid = Ext.getCmp('mailing-grid-template-user');
        if (!grid) {
            return;
        }
        grid.getStore().baseParams['usergroup'] = newValue;
        grid.getBottomToolbar().changePage(1);
    },

    //TODO maybe remove
    getLogSection: function (record = []) {
        if (!record || record.length === 0) {
            return {};
        }
        return [
            MODx.PanelSpacer,
            {
                html: '<hr />',
            }, {
                layout: 'column',
                defaults: {msgTarget: 'under', border: false, anchor: '100%'},
                items: [{
                    columnWidth: .5,
                    layout: 'form',
                    defaults: {msgTarget: 'under', border: false, anchor: '100%'},
                    items: [
                        this.getFormInput('created_on', {fieldLabel: _('mailing_template_createdon'), readOnly: true}),
                        this.getFormInput('created_by', {
                            xtype: 'modx-combo-user',
                            fieldLabel: _('mailing_template_createdby'),
                            readOnly: true
                        }),
                    ]
                }, {
                    columnWidth: .5,
                    layout: 'form',
                    defaults: {msgTarget: 'under', border: false, anchor: '100%'},
                    items: [
                        this.getFormInput('updated_on', {fieldLabel: _('mailing_template_updatedon'), readOnly: true}),
                        this.getFormInput('updated_by', {
                            xtype: 'modx-combo-user',
                            fieldLabel: _('mailing_template_updatedby'),
                            readOnly: true
                        }),
                    ]
                }]
            }
        ];
    },
});
Ext.reg('mailing-formpanel-template', Mailing.formPanel.template);
