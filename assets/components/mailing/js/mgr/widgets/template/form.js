Ext.namespace('Mailing.form.template');

Mailing.form.template = function(config) {
    config = config || {};
    Ext.apply(config, {
        //html: '111'
    });
    Mailing.form.template.superclass.constructor.call(this, config);
};
Ext.extend(Mailing.form.template, MODx.Panel, {
    initComponent: function() {
        /*this.columns = this.renderGridColumns();
        this.tbar = this.renderToolbar();*/
        console.log(111);

        this.items = this.renderForm();
        Mailing.form.template.superclass.initComponent.call(this);
    },

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
                style: 'margin-bottom:25px;',
                items: [{
                    columnWidth: 0.5,
                    defaults: {
                        msgTarget: 'under',
                        anchor: '100%'
                    },
                    items: [
                        {xtype:'textfield', name:'name', fieldLabel:_('mailing.field.name'), anchor:'100%'},
                        {xtype:'textarea', name:'description', fieldLabel:_('vclub.field.comment'), anchor:'100%', height:101},
                        {xtype:'textfield', name:'user_group_id', fieldLabel:_('user_email'), anchor:'100%'},
                        {xtype:'textfield', name:'subject', fieldLabel:_('user_phone'), anchor:'100%'},
                        {xtype:'textarea', name:'template', fieldLabel:_('vclub.field.comment'), anchor:'100%', height:101}
                    ]
                },{
                    columnWidth: 0.5,
                    defaults: {
                        msgTarget: 'under',
                        anchor: '100%'
                    },
                    items: [
                        /*{xtype:'statictextfield', name:'lastlogin', fieldLabel:_('user_prevlogin'), anchor:'50%'},
                        {xtype:'xcheckbox', name:'active', boxLabel:_('vclub.field.active'), inputValue:1, checked:(config.record_id==='' || config.record_id===0) ? true : false},
                        {xtype:'xcheckbox', name:'blocked', boxLabel:_('vclub.field.blocked'), inputValue:1}*/
                    ]
                }]
            }
        ];
    }
});
Ext.reg('mailing-form-template', Mailing.form.template);
