<?php

require_once __DIR__ . '/helpers/timestamps.trait.php';

class mailingTemplate extends xPDOSimpleObject
{
    use mailingModelTimestamps;

    /** @var string|null */
    private $createdOnField = 'created_on';

    /** @var string|null */
    private $createdByField = 'created_by';

    /** @var string|null */
    private $updatedOnField = 'updated_on';

    /** @var string|null */
    private $updatedByField = 'updated_by';

    /**
     * @param null $cacheFlag
     * @return bool
     */
    public function save($cacheFlag = null)
    {
        $this->setTimestamps();
        return parent::save($cacheFlag);
    }

    /**
     * @param array $scriptProperties
     * @return array|mixed|xPDOObject|null
     */
    public function process($scriptProperties = [])
    {
        $html = $this->content;
        $this->xpdo->toPlaceholders($scriptProperties);
        $properties = $this->xpdo->fromJson($this->properties);
        $this->xpdo->toPlaceholders($properties);
        $css = $this->getEmailStyles();
        if ($css) {
            $this->xpdo->setPlaceholder('styles', '<style>' . $css . '</style>');
        }
        $maxIterations = (integer)$this->xpdo->getOption('parser_max_iterations', null, 10);
        $this->xpdo->getParser()->processElementTags('', $html, true, true, '[[', ']]', [], $maxIterations);
        return $html;
    }

    /**
     * @return false|string
     */
    public function getEmailDefaultTemplate()
    {
        $templateLink = $this->xpdo->getOption('mailing_email_template');
        if (!$templateLink) {
            return '';
        }
        $html = @file_get_contents(MODX_CORE_PATH . $templateLink);
        return $html ?? '';
    }

    /**
     * @return false|string
     */
    private function getEmailStyles()
    {
        $cssLink = $this->xpdo->getOption('mailing_email_css');
        if (!$cssLink) {
            return false;
        }
        $css = @file_get_contents(MODX_ASSETS_PATH . $cssLink);
        return $css ?? '';
    }
}
