<?php declare(strict_types=1);

namespace VitesseCms\Google\Controllers;

use VitesseCms\Core\AbstractController;
use VitesseCms\Google\Enums\GoogleEnum;
use VitesseCms\Google\Services\WebhookService;

class WebhookController extends AbstractController
{
    public function IndexAction(): void
    {
        $input = file_get_contents('php://input');
        $webhookService = new WebhookService(json_decode($input,true));
        $this->eventsManager->fire(GoogleEnum::DIALOGFLOW_WEBHOOK_EVENT.':'.$webhookService->getIntent(), $webhookService);

        header('Content-type: application/json');
        echo json_encode($webhookService->render());
        die();
    }
}