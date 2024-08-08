<?php


namespace App\Forms\Admin;


use App\Helpers\Form;
use App\Models\NavItem;
use App\Models\Page;

class NavItemForm extends Form
{

    const FIELDS = [
        'nav_item_id' => [
            'name' => 'nav_item_id',
            'type' => 'select',
            'label' => 'admin.nav_item.singular',
            'rules' => [],
            'options' => [],
        ],
        'page_id' => [
            'name' => 'page_id',
            'type' => 'select',
            'label' => 'admin.page.singular',
            'rules' => [],
            'options' => [],
        ],
        'label' => [
            'name' => 'label',
            'type' => 'text',
            'label' => 'admin.nav_item.label',
            'rules' => ['required'],
        ],
        'url' => [
            'name' => 'url',
            'type' => 'text',
            'label' => 'admin.nav_item.url',
            'rules' => [],
        ],
        'target' => [
            'name' => 'target',
            'type' => 'text',
            'label' => 'admin.nav_item.target',
            'rules' => [],
        ],
        'active' => [
            'name' => 'active',
            'type' => 'checkbox',
            'label' => 'admin.active',
            'rules' => [],
            'options' => [],
        ],
    ];

    public function __construct($model = null)
    {
        foreach (self::FIELDS as $name => $field) {
            $this->modelFields[$name] = $field;
        }

        $navItems = NavItem::with([])->adminLocale()->get();
        foreach ($navItems as $item) {
            $this->modelFields['nav_item_id']['options'][$item->id] = $item->nav_name.' | '.$item->label;
        }

        $pages = Page::with([])->adminLocale()->get();
        foreach ($pages as $page) {
            $this->modelFields['page_id']['options'][$page->id] = $page->name;
        }

        parent::__construct($model, NavItem::class);
    }
}
