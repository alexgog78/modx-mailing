<?php

class MailingTemplate extends xPDOSimpleObject
{
    public function process()
    {
        $html = $this->content;
        $properties = $this->xpdo->fromJson($this->properties);
        $placeholders = $this->xpdo->toPlaceholders($properties);

        $maxIterations = (integer)$this->xpdo->getOption('parser_max_iterations', null, 10);
        $this->xpdo->getParser()->processElementTags('', $html, false, false, '[[', ']]', [], $maxIterations);
        $this->xpdo->getParser()->processElementTags('', $html, true, true, '[[', ']]', [], $maxIterations);
        return $html;
    }
}
