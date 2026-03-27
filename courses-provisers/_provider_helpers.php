<?php

function provider_badge_class($status)
{
    $s = strtolower((string) $status);
    if ($s === 'approved') {
        return 'provider-badge--approved';
    }
    if ($s === 'denied') {
        return 'provider-badge--denied';
    }
    return 'provider-badge--pending';
}
