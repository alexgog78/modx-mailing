<?php

require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/config.core.php';
require_once MODX_CORE_PATH . 'config/' . MODX_CONFIG_KEY . '.inc.php';
require_once MODX_CONNECTORS_PATH . 'index.php';

class MailingPreview
{
    /** @var modX */
    private $modx;

    /** @var Mailing|null */
    private $module;

    /** @var pdoFetch|null */
    private $pdoTools;

    public function __construct(modX &$modx)
    {
        $this->modx = &$modx;
        $this->validateRequest();
        $this->getService();

        if ($this->pdoTools = $this->modx->getService('pdoFetch')) {
            $this->pdoTools->setConfig([]);
        }
    }

    public function process()
    {
        $templateId = $_REQUEST['template'];
        $template = $this->getTemplate($templateId);
        if (!$template) {
            exit('mailing.err_nf');
        }
        $content = $template->get('content');
        $html = $this->parseContent($content);
        die($html);
    }

    private function validateRequest()
    {
        $authorized = $this->modx->user->getSessionContexts();
        if (empty($authorized['mgr']) || !$authorized['mgr']) {
            exit('Access denied');
        }
        if (empty($_REQUEST['template'])) {
            exit('Access denied');
        }
    }

    private function getService()
    {
        $this->module = $this->modx->getService(
            'mailing',
            'Mailing',
            $this->modx->getOption('core_path') . 'components/mailing/model/mailing/',
            []
        );
        $this->module->initialize($this->modx->context->key, []);
        if (!($this->module instanceof Mailing)) {
            exit('Could not initialize Mailing');
        }
    }

    private function getTemplate($templateId)
    {
        $template = $this->modx->getObject('mailingTemplate', [
            'id' => $templateId
        ]);
        if (!$template) {
            return false;
        }
        return $template;
    }

    private function parseContent($content)
    {
        $tpl = '@INLINE ' . $content;
        $content = $this->pdoTools->getChunk($tpl, []);
        return $content;
    }
}

$mailingPreview = new MailingPreview($modx);
$mailingPreview->process();

exit();

