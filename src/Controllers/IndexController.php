<?php declare(strict_types=1);

namespace VitesseCms\Google\Controllers;

use VitesseCms\Content\Enum\ItemEnum;
use VitesseCms\Content\Repositories\ItemRepository;
use VitesseCms\Core\AbstractControllerFrontend;

class IndexController extends AbstractControllerFrontend
{
    private ItemRepository $itemRepository;

    public function OnConstruct()
    {
        parent::onConstruct();

        $this->itemRepository = $this->eventsManager->fire(ItemEnum::GET_REPOSITORY, new \stdClass());
    }

    public function setGeoCoordinatesAction(): void
    {
        if (
            $this->request->isAjax()
            && !empty($this->request->getPost('latitude'))
            && !empty($this->request->getPost('longitude'))
        ) {
            $item = $this->itemRepository->getById($this->request->getPost('id'));
            if ($item !== null) {
                $item->set('latitude', $this->request->getPost('latitude'))
                    ->set('longitude', $this->request->getPost('longitude'))
                    ->save();
            }
        }

        $this->disableView();
    }
}
