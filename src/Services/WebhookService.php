<?php declare(strict_types=1);

namespace VitesseCms\Google\Services;

use Dialogflow\WebhookClient;

class WebhookService extends WebhookClient
{
    public function __construct(array $data)
    {
        parent::__construct($data);
    }
}