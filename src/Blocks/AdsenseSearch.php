<?php declare(strict_types=1);

namespace VitesseCms\Google\Blocks;

use VitesseCms\Admin\Utils\AdminUtil;
use VitesseCms\Block\AbstractBlockModel;
use VitesseCms\Block\Models\Block;

class AdsenseSearch extends AbstractBlockModel
{
    public function getTemplateParams(Block $block): array
    {
        $params = parent::getTemplateParams($block);
        $params['isAdminPage'] = AdminUtil::isAdminPage();

        return $params;
    }
}