<?php declare(strict_types=1);

namespace VitesseCms\Google\Listeners;

use VitesseCms\Admin\Utils\AdminUtil;
use VitesseCms\Core\Enum\EnvEnum;
use VitesseCms\Core\Enum\ViewEnum;
use VitesseCms\Core\Interfaces\InjectableInterface;
use VitesseCms\Google\Listeners\Services\ViewServiceListener;

class InitiateListeners
{
    public static function setListeners(InjectableInterface $di): void
    {
        if(
            !AdminUtil::isAdminPage()
            && getenv(EnvEnum::ENVIRONMENT) === EnvEnum::ENVIRONMENT_PRODUCTION
            && !$di->user->hasAdminAccess()
        ) {
            $di->eventsManager->attach(ViewEnum::SERVICE_LISTENER, new ViewServiceListener(
                $di->view,
                $di->setting
            ));
        }
    }
}