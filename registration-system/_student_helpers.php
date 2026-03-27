<?php

function student_badge_class($status)
{
    $s = strtolower((string) $status);
    if ($s === 'approved') {
        return 'student-badge--approved';
    }
    if ($s === 'denied') {
        return 'student-badge--denied';
    }
    return 'student-badge--pending';
}
