<?php

/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */
class Kubaceg_Menu_Block_MenuLevel extends Mage_Core_Block_Template
{
    public function getNextMenuLevelHtml($children)
    {
        return $this->getLayout()
            ->getBlock($this->getBlockAlias())
            ->setData('items', $children)
            ->toHtml();
    }
}