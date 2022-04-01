<?php declare(strict_types=1);

namespace VitesseCms\Google\Services;

use Dialogflow\WebhookClient;

class WebhookService extends WebhookClient
{
    /**
     * @var array
     */
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
        parent::__construct($data);
    }


    public function isAudioOnly(): bool
    {
        foreach ($this->data['originalDetectIntentRequest']['payload']['surface']['capabilities'] as $capability) :
            if ($capability['name'] === 'actions.capability.SCREEN_OUTPUT') :
                return false;
            endif;
        endforeach;

        return true;
    }
}