

Mailing.formPanel.template = function(config) {
    config = config || {};
    Ext.apply(config, {
        //Custom settings
        id: 'mailing-formpanel-template',
        url: Mailing.config.connectorUrl,
        baseParams: {
            action: 'mgr/template/get'
        },
        pageHeader: _('mailing.section.template'),
        panelContent: [],
    });
    Mailing.formPanel.template.superclass.constructor.call(this, config);
};
Ext.extend(Mailing.formPanel.template, abstractModule.formPanel.simple, {
    getContent: function () {
        var form = this.renderForm();
        return [
            this.renderDescription(_('mailing.section.template.management')),
            this.renderContent(form)
        ];
    },

    setValues: function (object) {
        console.log(object);
        Ext.get(this.id + '-header').update(_('mailing.section.template') + ': ' + object.name);
        Mailing.formPanel.template.superclass.setValues.call(this, object);
    },

    success: function(o) {
        if(!this.recordId) {
            MODx.loadPage('mgr/template/update', 'namespace=mailing&id=' + o.result.object.id);
        }
    },

    //TODO check layout an defaults
    //TODO renderForm
    //TODO renderDescription
    //TODO renderFormInput
    renderForm: function () {
        return [
            {xtype:'hidden', name:'id'},
            {
                layout:'column',
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
                        {xtype:'textfield', name:'name', fieldLabel:_('mailing.field.name'), anchor:'100%'},
                        {xtype:'textarea', name:'description', fieldLabel:_('mailing.field.description'), anchor:'100%', height:101},
                        {xtype:'textfield', name:'user_group_id', fieldLabel:_('mailing.field.user_group'), anchor:'100%'},
                        {xtype:'textfield', name:'email_from', fieldLabel:_('mailing.field.email_from'), anchor:'100%'},
                        {xtype:'textfield', name:'email_from_name', fieldLabel:_('mailing.field.email_from_name'), anchor:'100%'},
                        {xtype:'textfield', name:'email_subject', fieldLabel:_('mailing.field.email_subject'), anchor:'100%'},
                        {xtype:'textarea', name:'template', fieldLabel:_('mailing.field.template'), anchor:'100%', height:101}
                    ]
                },{
                    columnWidth: 0.5,
                    defaults: {
                        msgTarget: 'under',
                        anchor: '100%'
                    },
                    items: [
                        /*{xtype:'statictextfield', name:'lastlogin', fieldLabel:_('user_prevlogin'), anchor:'50%'},
                        {xtype:'xcheckbox', name:'active', boxLabel:_('vclub.field.active'), inputValue:1, checked:(config.recordId==='' || config.recordId===0) ? true : false},
                        {xtype:'xcheckbox', name:'blocked', boxLabel:_('vclub.field.blocked'), inputValue:1}*/
                    ]
                }]
            }
        ];
    }
});
Ext.reg('mailing-formpanel-template', Mailing.formPanel.template);
