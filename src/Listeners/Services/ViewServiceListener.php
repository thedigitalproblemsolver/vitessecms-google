<?php declare(strict_types=1);

namespace VitesseCms\Google\Listeners\Services;

use Phalcon\Events\Event;
use VitesseCms\Core\Services\ViewService;
use VitesseCms\Google\Enums\GoogleEnum;
use VitesseCms\Setting\Services\SettingService;

class ViewServiceListener
{
    public function __construct(private ViewService $viewService, private SettingService $settingService){}

    public function setFrontendVars(Event $event)
    {
        if($this->settingService->has(GoogleEnum::GOOGLE_TAGMANAGER_ID)) {
            $this->viewService->setVar(
                GoogleEnum::GOOGLE_TAGMANAGER_ID,
                $this->settingService->getString(GoogleEnum::GOOGLE_TAGMANAGER_ID)
            );
        }
        if($this->settingService->has(GoogleEnum::GOOGLE_ADSENSE_AUTOMATICADS)) {
            $this->viewService->setVar(
                GoogleEnum::GOOGLE_ADSENSE_AUTOMATICADS,
                $this->settingService->getString(GoogleEnum::GOOGLE_ADSENSE_AUTOMATICADS)
            );
        }
        if($this->settingService->has(GoogleEnum::GOOGLE_SITE_VERIFICATION)) {
            $this->viewService->setVar(
                GoogleEnum::GOOGLE_SITE_VERIFICATION,
                $this->settingService->getString(GoogleEnum::GOOGLE_SITE_VERIFICATION)
            );
        }
    }
}
