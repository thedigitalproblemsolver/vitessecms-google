<?php
declare(strict_types=1);

namespace VitesseCms\Google\Controllers;

use stdClass;
use VitesseCms\Core\AbstractControllerFrontend;
use VitesseCms\Google\Enums\GoogleEnum;
use VitesseCms\Setting\Enum\SettingEnum;
use VitesseCms\Setting\Services\SettingService;

class AdstxtController extends AbstractControllerFrontend
{
    private SettingService $settingService;

    public function OnConstruct()
    {
        parent::OnConstruct();
        $this->settingService = $this->eventsManager->fire(SettingEnum::ATTACH_SERVICE_LISTENER->value, new stdClass());
    }

    public function IndexAction(): void
    {
        echo $this->settingService->get(GoogleEnum::GOOGLE_ADSENSE_ADSTXT);
        die();
    }
}