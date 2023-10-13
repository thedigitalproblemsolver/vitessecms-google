<?php declare(strict_types=1);

namespace VitesseCms\Google\Listeners;

use VitesseCms\Admin\Utils\AdminUtil;
use VitesseCms\Core\Enum\EnvEnum;
use VitesseCms\Core\Interfaces\InjectableInterface;
use VitesseCms\Google\Listeners\Services\FrontendHtmlListener;
use VitesseCms\Mustache\Enum\FrontendHtmlEnum;

class InitiateListeners
{
    public static function setListeners(InjectableInterface $di): void
    {
        $di->eventsManager->attach(FrontendHtmlEnum::FRONTEND_HTML_LISTENER->value, new FrontendHtmlListener(
            AdminUtil::isAdminPage(),
            getenv(EnvEnum::ENVIRONMENT),
            $di->user->hasAdminAccess(),
            $di->assets,
            $di->setting,
            $di->eventsManager
        ));
    }
}