<?php

trait mailingModelTimestamps
{
    private function setTimestamps()
    {
        if ($this->_new) {
            $this->setCreatedFields();
        } else {
            $this->setUpdatedFields();
        }
    }

    private function setCreatedFields()
    {
        if ($this->createdOnField) {
            $this->set($this->createdOnField, date('Y-m-d H:i:s'));
        }
        if ($this->createdByField) {
            $this->set($this->createdByField, $this->xpdo->user->id);
        }
    }

    private function setUpdatedFields()
    {
        if ($this->updatedOnField) {
            $this->set($this->updatedOnField, date('Y-m-d H:i:s'));
        }
        if ($this->updatedByField) {
            $this->set($this->updatedByField, $this->xpdo->user->id);
        }
    }
}
