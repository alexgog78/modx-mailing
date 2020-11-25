'use strict';

Mailing.formPanel.template = function (config) {
    config = config || {};
    Ext.applyIf(config, {
        id: 'mailing-formpanel-template',
        url: Mailing.config.connectorUrl,
        baseParams: {},
        record: null,
        cls: 'container form-with-labels',
        listeners: {
            'setup': {fn: this.setup, scope: this},
            'success': {fn: this.success, scope: this},
            'beforeSubmit': {fn: this.beforeSubmit, scope: this}
        },
        items: [
            this.getHeader(_('mailing_template')),
            {
                xtype: 'modx-tabs',
                id: 'modx-user-tabs',
                deferredRender: false,
                defaults: {
                    autoHeight: true,
                    layout: 'form',
                    labelWidth: 150,
                    bodyCssClass: 'tab-panel-wrapper',
                    layoutOnTabChange: true,
                },
                items: [{
                    title: _('mailing_template_settings'),
                    items: [
                        this.getDescription(_('mailing_template_settings_management')),
                        this.getContent([
                            this.getMainForm(),
                        ]),
                    ]
                }, {
                    title: _('mailing_template_content'),
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
                        this.getContent([]),
                    ]
                }, {
                    title: _('mailing_template_properties'),
                    items: [
                        this.getDescription(_('mailing_template_properties_management')),
                        this.getContent([]),
                    ]
                }]
            },
        ],
    });
    Mailing.formPanel.template.superclass.constructor.call(this, config);
};
Ext.extend(Mailing.formPanel.template, MODx.FormPanel, {
    setup: function () {
        if (!this.record) {
            this.setValues(this.defaultValues);
        } else {
            this.setValues(this.record);
        }
        console.log(this.record);
        this.fireEvent('ready', this.record);
        MODx.fireEvent('ready');
    },

    beforeSubmit: function (o) {
        return true;
    },

    success: function (o) {
        if (!this.record) {
            MODx.loadPage('mgr/template/update', 'namespace=mailing&id=' + o.result.object.id);
        }
        this.record = o.result.object;
        return true;
    },

    setValues: function (record) {
        this.getForm().setValues(record);
    },

    getHeader: function (text) {
        return {
            xtype: 'modx-header',
            itemId: '',
            html: text
        };
    },

    getDescription: function (text) {
        return {
            xtype: 'modx-description',
            itemId: '',
            html: '<p>' + text + '</p>'
        };
    },

    getContent: function (items = []) {
        return {
            xtype: 'panel',
            layout: 'form',
            cls: 'main-wrapper',
            //preventRender: true,
            border: false,
            labelAlign: 'top',
            labelSeparator: '',
            defaults: {msgTarget: 'under', anchor: '100%'},
            items: items
        };
    },

    getMainForm: function () {
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
                        this.getFormInput('name', {fieldLabel: _('mailing_record_name')}),
                        this.getFormInput('user_group_id', {xtype: 'mailing-combo-usergroup', fieldLabel: _('mailing_record_user_group')}),
                        this.getFormInput('email_from', {fieldLabel: _('mailing_record_email_from')}),
                        this.getFormInput('email_from_name', {fieldLabel: _('mailing_record_email_from_name')}),
                        this.getFormInput('email_subject', {fieldLabel: _('mailing_record_eemail_subject')}),
                    ]
                }, {
                    columnWidth: .5,
                    layout: 'form',
                    defaults: {msgTarget: 'under', border: false, anchor: '100%'},
                    items: [
                        this.getFormInput('description', {xtype: 'textarea', fieldLabel: _('mailing_record_description'), height: 308}),
                    ]
                }]
            }
        ];
    },

    getTemplateForm: function () {
        return this.getFormInput('content', {
            xtype: Ext.ComponentMgr.isRegistered('modx-texteditor') ? 'modx-texteditor' : 'textarea',
            mimeType: 'text/html',
            fieldLabel: _('mailing_record_content'),
            height: 400,
        });
    },

    getFormInput: function (name, config = {}) {
        return Ext.applyIf(config, {
            xtype: 'textfield',
            name: name,
            hiddenName: name,
            fieldLabel: name,
            anchor: '100%',
        });
    },
});
Ext.reg('mailing-formpanel-template', Mailing.formPanel.template);
