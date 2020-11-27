<?php

require_once __DIR__ . '/manager.class.php';

class mailingMgrQueuesManagerController extends mailingManagerController
{
    /** @var array */
    protected $languageTopics = [
        'mailing:queue',
        'mailing:template',
        'mailing:user',
    ];

    /**
     * @return string
     */
    public function getPageTitle()
    {
        return $this->getLexiconTopic('queue_list') . parent::getPageTitle();
    }

    public function loadCustomCssJs()
    {
        parent::loadCustomCssJs();
        $this->addJavascript($this->service->jsUrl . 'mgr/widgets/queue/panel.queues.js');
        $this->addJavascript($this->service->jsUrl . 'mgr/widgets/queue/grid.queue.js');
        $this->addLastJavascript($this->service->jsUrl . 'mgr/sections/queue/list.js');
        $configJs = $this->modx->toJSON([
            'xtype' => 'mailing-page-queue-list',
            'rateWaitTime' => intval($this->modx->getOption('mailing_rate_wait_time', [], 0)) * 1000,
        ]);
        $this->addHtml('<script type="text/javascript">Ext.onReady(function() { MODx.load(' . $configJs . '); });</script>');
    }
}
