# magento-menu
Simple Magento 1 menu

## Yet another menu module?
Yes! All that I tested did not work :D

## Tested Magento Version
* 1.9.3.1

## Usage
Render menu block inside header block
```
<?php echo $this->getBlockHtml('main_menu') ?>
```
Create menu structure with proper store, is_active=yes and `main_menu` identifier. You can add new menu to Your site by creating new menu blocks (look at `app/design/frontend/base/default/layout/kubaceg_menu.xml`), and new menus through admin panel. Remember to set proper `menu_code` and `menu_item_block_name` for each menu.


## Version
1.0.0 You can create menu tree for Your menu, and render it as a `<ul><li>` nested structure.
