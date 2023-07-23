<?php declare(strict_types=1);

namespace VitesseCms\Google\Listeners;

use VitesseCms\Core\Interfaces\InjectableInterface;
use VitesseCms\Google\Blocks\AdsenseSearch;
use VitesseCms\Google\Listeners\Blocks\AdsenseSearchListener;

class InitiateAdminListeners
{
    public static function setListeners(InjectableInterface $di): void
    {
        $di->eventsManager->attach(AdsenseSearch::class, new AdsenseSearchListener());
    }
}