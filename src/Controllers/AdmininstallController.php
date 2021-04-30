<?php declare(strict_types=1);

namespace VitesseCms\Google\Controllers;

use VitesseCms\Google\Forms\GoogleToolsForm;
use VitesseCms\Install\AbstractCreatorController;
use VitesseCms\Setting\Enum\CallingNameEnum;
use VitesseCms\Setting\Enum\TypeEnum;

class AdmininstallController extends AbstractCreatorController
{
    public function createAction(): void
    {
        $this->view->setVar(
            'content',
            (new GoogleToolsForm())
                ->build()
                ->renderForm('admin/google/admininstall/parseCreateForm')
        );
        $this->prepareView();
    }

    public function parseCreateFormAction()
    {
        $settings = [];

        if (
            !$this->setting->has(CallingNameEnum::GOOGLE_ANALYTICS_TRACKINGID,false)
            && !empty($this->request->get('google_analytics_tracking_id'))
        ) :
            $settings[CallingNameEnum::GOOGLE_ANALYTICS_TRACKINGID] = [
                'type' => TypeEnum::TEXT,
                'value' => $this->request->get('google_analytics_tracking_id'),
                'name' => 'Google Analytics tracking ID',
            ];
        endif;

        if (
            !$this->setting->has(CallingNameEnum::GOOGLE_SITE_VERIFICATION, false)
            && !empty($this->request->get('google_site_verification'))
        ) :
            $settings[CallingNameEnum::GOOGLE_SITE_VERIFICATION] = [
                'type' => TypeEnum::TEXT,
                'value' => $this->request->get('google_site_verification'),
                'name' => 'Google Site Verification',
            ];
        endif;

        if (
            !$this->setting->has(CallingNameEnum::GOOGLE_ADSENSE_AUTOMATICADS, false)
            && !empty($this->request->get('google_adsense_automaticads'))
        ) :
            $settings[CallingNameEnum::GOOGLE_ADSENSE_AUTOMATICADS] = [
                'type' => TypeEnum::TEXT,
                'value' => $this->request->get('google_adsense_automaticads'),
                'name' => 'Google Adsense Automatic ads',
            ];
        endif;

        $this->createSettings($settings);

        $this->flash->setSucces('Google properties created');

        $this->redirect('admin/install/sitecreator/index');
    }
}