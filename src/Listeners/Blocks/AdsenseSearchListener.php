<?php declare(strict_types=1);

namespace VitesseCms\Google\Listeners\Blocks;

use Phalcon\Events\Event;
use VitesseCms\Block\Forms\BlockForm;

class AdsenseSearchListener {
    public function buildBlockForm(Event $event, BlockForm $blockForm): void
    {
        $blockForm->addText('Zoekmachine-ID', 'searchEngineId');
    }
}