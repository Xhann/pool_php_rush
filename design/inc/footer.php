<?php

if ($currentVisitor instanceof Recruiter) {
    lock($currentVisitor);
    getControl($currentVisitor);
    try {
        $currentVisitor->allow("Job proposal");
        $currentVisitor->allow("Work placement");
    } catch (Exception $NoJobOpportunities) {
        postpone();
        connectAnyways($this->profile);
    }
}