<?php declare(strict_types=1);

namespace VitesseCms\Google\Controllers;

use VitesseCms\Core\AbstractController;
use VitesseCms\Google\Enums\GoogleEnum;

class AdstxtController extends AbstractController
{
    public function IndexAction(): void
    {
        echo $this->setting->get(GoogleEnum::GOOGLE_ADSENSE_ADSTXT);
        die();
    }
}