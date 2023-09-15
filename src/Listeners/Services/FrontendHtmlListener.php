<?php

declare(strict_types=1);

namespace VitesseCms\Google\Listeners\Services;

use Phalcon\Events\Event;
use Phalcon\Events\Manager;
use VitesseCms\Core\Enum\EnvEnum;
use VitesseCms\Google\Enums\GoogleEnum;
use VitesseCms\Media\Services\AssetsService;
use VitesseCms\Mustache\DTO\RenderTemplateDTO;
use VitesseCms\Mustache\Enum\ViewEnum;
use VitesseCms\Setting\Services\SettingService;

class FrontendHtmlListener
{
    public function __construct(
        private bool $isAdminPage,
        private string $environment,
        private bool $hasAdminAccess,
        private AssetsService $assetsService,
        private SettingService $settingService,
        private Manager $eventsManager
    ) {
    }

    public function parseHeader(Event $event)
    {
        if (!$this->isAdminPage && !$this->hasAdminAccess && $this->environment === EnvEnum::ENVIRONMENT_PRODUCTION) {
            if ($this->settingService->has(GoogleEnum::GOOGLE_TAGMANAGER_ID)) {
                $this->assetsService->addHeadCode(
                    $this->eventsManager->fire(
                        ViewEnum::RENDER_TEMPLATE_EVENT,
                        new RenderTemplateDTO(
                            'tag_manager_head',
                            '',
                            [
                                GoogleEnum::GOOGLE_TAGMANAGER_ID => $this->settingService->getString(
                                    GoogleEnum::GOOGLE_TAGMANAGER_ID
                                )
                            ]
                        )
                    )
                );
            }
            if ($this->settingService->has(GoogleEnum::GOOGLE_ADSENSE_AUTOMATICADS)) {
                $this->assetsService->addHeadCode(
                    $this->eventsManager->fire(
                        ViewEnum::RENDER_TEMPLATE_EVENT,
                        new RenderTemplateDTO(
                            'adsense_automatic_ads',
                            '',
                            [
                                GoogleEnum::GOOGLE_ADSENSE_AUTOMATICADS => $this->settingService->getString(
                                    GoogleEnum::GOOGLE_ADSENSE_AUTOMATICADS
                                )
                            ]
                        )
                    )
                );
            }
            if ($this->settingService->has(GoogleEnum::GOOGLE_SITE_VERIFICATION)) {
                $this->assetsService->addHeadCode(
                    $this->eventsManager->fire(
                        ViewEnum::RENDER_TEMPLATE_EVENT,
                        new RenderTemplateDTO(
                            'search_console_verification',
                            '',
                            [
                                GoogleEnum::GOOGLE_SITE_VERIFICATION => $this->settingService->getString(
                                    GoogleEnum::GOOGLE_SITE_VERIFICATION
                                )
                            ]
                        )
                    )
                );
            }

            if ($this->settingService->has(GoogleEnum::GOOGLE_ADSENSE_METATAG)) {
                $this->assetsService->addHeadCode(
                    $this->eventsManager->fire(
                        ViewEnum::RENDER_TEMPLATE_EVENT,
                        new RenderTemplateDTO(
                            'adsense_verification',
                            '',
                            [
                                GoogleEnum::GOOGLE_ADSENSE_METATAG => $this->settingService->getString(
                                    GoogleEnum::GOOGLE_ADSENSE_METATAG
                                )
                            ]
                        )
                    )
                );
            }
        }
    }
}
