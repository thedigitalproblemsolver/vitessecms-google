<?php declare(strict_types=1);

namespace VitesseCms\Google\Forms;

use VitesseCms\Form\AbstractForm;
use VitesseCms\Google\Enums\GoogleEnum;
use VitesseCms\Setting\Enum\CallingNameEnum;

class GoogleToolsForm extends AbstractForm
{
    public function build(): GoogleToolsForm
    {
        if (!$this->setting->has(CallingNameEnum::GOOGLE_ANALYTICS_TRACKINGID,false)) :
            $this->addText('Google Analytic tracking-ID', 'google_analytics_tracking_id');
        endif;

        if (!$this->setting->has(CallingNameEnum::GOOGLE_SITE_VERIFICATION, false)) :
            $this->addText('Google Site Verification', 'google_site_verification');
        endif;

        if (!$this->setting->has(CallingNameEnum::GOOGLE_ADSENSE_AUTOMATICADS, false)) :
            $this->addText('Google Adsense Automatic ads', 'google_adsense_automaticads');
        endif;

        if (!$this->setting->has(GoogleEnum::GOOGLE_ADSENSE_ADSTXT, false)) :
            $this->addText('Google Adsense ads.txt', GoogleEnum::GOOGLE_ADSENSE_ADSTXT);
        endif;

        $this->addSubmitButton('create');

        return $this;
    }
}
