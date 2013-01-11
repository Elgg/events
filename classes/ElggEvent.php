<?php

class ElggEvent extends ElggObject {
    /** @override */
    protected function initializeAttributes() {
        $this->attributes['subtype'] = 'event';
    }
    
    /**
     * @return DateTime The time this event begins.
     */
    public function getStartTime() {
        $startTime = new DateTime();
        $startTime->setTimestamp($this->calendar_start);
        return $startTime;
    }
    
    public function setStartTime(DateTime $startTime) {
        $this->calendar_start = $startTime->getTimestamp();
    }
    
    /**
     * @return DateTime The time this event ends.
     */
    public function getEndTime() {
        $endTime = new DateTime();
        $endTime->setTimestamp($this->calendar_end);
        return $endTime;
    }
    
    public function setEndTime(DateTime $endTime) {
        $this->calendar_end = $endTime->getTimestamp();
    }
}