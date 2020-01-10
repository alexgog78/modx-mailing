Mailing.formPanel.template = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'mailing-formpanel-template';
    }
    Ext.apply(config, {
        //Custom settings
        //id: 'mailing-formpanel-template',
        tabs: true,
        url: Mailing.config.connectorUrl,
        baseParams: {
            actionGet: 'mgr/template/get'
        },
        pageHeader: _('mailing.section.template'),
        panelContent: [],
    });
    Mailing.formPanel.template.superclass.constructor.call(this, config);
};
Ext.extend(Mailing.formPanel.template, abstractModule.formPanel.abstract, {
    getContent: function () {
        var mainForm = this.renderMainForm();
        var templateForm = this.renderTemplateForm();
        var usersGrid = this.renderUserGrid();

        return [{
            title: _('mailing.tab.template.settings'),
            items: [
                this.renderDescription(_('mailing.tab.template.settings.management')),
                this.renderContent(mainForm)
            ]
        }, {
            title: _('mailing.tab.template.content'),
            items: [
                this.renderDescription(_('mailing.tab.template.content.management')),
                this.renderContent(templateForm)
            ]
        }, {
            title: _('mailing.tab.template.users'),
            items: [
                this.renderDescription(_('mailing.tab.template.users.management')),
                this.renderContent(usersGrid)
            ]
        }];
    },

    setValues: function (object) {
        if (this.recordId) {
            this.updateUserGrid(object.user_group_id);
        }
        Mailing.formPanel.template.superclass.setValues.call(this, object);
    },

    success: function (o) {
        if (!this.record) {
            MODx.loadPage('mgr/template/update', 'namespace=mailing&id=' + o.result.object.id);
        }
        Mailing.formPanel.template.superclass.success.call(this, o);
    },

    //TODO check layout an defaults
    //TODO renderForm
    //TODO renderDescription
    //TODO renderFormInput
    renderMainForm: function () {
        return [
            {xtype: 'hidden', name: 'id'},
            {
                layout: 'column',
                defaults: {
                    layout: 'form',
                    labelAlign: 'top',
                    labelSeparator: '',
                    border: false
                },
                //style: 'margin-bottom:25px;',
                items: [{
                    columnWidth: 0.5,
                    defaults: {
                        msgTarget: 'under',
                        anchor: '100%'
                    },
                    items: [
                        {xtype: 'textfield', name: 'name', fieldLabel: _('mailing.field.name'), anchor: '100%'},

                        {
                            xtype: 'modx-combo-usergroup',
                            name: 'user_group_id',
                            hiddenName: 'user_group_id',
                            fieldLabel: _('mailing.field.user_group'),
                            anchor: '100%'
                        },
                        {
                            xtype: 'textfield',
                            name: 'email_from',
                            fieldLabel: _('mailing.field.email_from'),
                            anchor: '100%'
                        },
                        {
                            xtype: 'textfield',
                            name: 'email_from_name',
                            fieldLabel: _('mailing.field.email_from_name'),
                            anchor: '100%'
                        },
                        {
                            xtype: 'textfield',
                            name: 'email_subject',
                            fieldLabel: _('mailing.field.email_subject'),
                            anchor: '100%'
                        },
                    ]
                }, {
                    columnWidth: 0.5,
                    defaults: {
                        msgTarget: 'under',
                        anchor: '100%'
                    },
                    items: [
                        {
                            xtype: 'textarea',
                            name: 'description',
                            fieldLabel: _('mailing.field.description'),
                            anchor: '100%',
                            height: 308
                        }
                    ]
                }]
            }
        ];
    },

    renderTemplateForm: function () {
        return [{
            layout: 'form',
            items: [{
                xtype: 'textarea',
                name: 'content',
                fieldLabel: _('mailing.field.template'),
                anchor: '100%',
                height: 400,
                id: 'modx-template-content'
            }]
        }];
    },

    renderUserGrid: function () {
        if (!this.recordId) {
            return [{xtype: 'mailing-notice-undefined'}];
        }
        return [{xtype: 'mailing-grid-templateuser'}];
    },

    updateUserGrid: function (userGroupId) {
        var userGrid = Ext.getCmp('mailing-grid-templateuser');
        userGrid.getStore().baseParams.user_group_id = userGroupId;
        userGrid.getBottomToolbar().changePage(1);
    },
});
Ext.reg('mailing-formpanel-template', Mailing.formPanel.template);
