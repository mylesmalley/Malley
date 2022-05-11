<?php
namespace Modules\BodyguardBOM\Http\Controllers\Parts;

use Modules\BodyguardBOM\Models\Category;

trait CategoryTreeTrait {
    /**
     * @return array
     */
    private function category_tree(): array
    {
        $nodes = Category::get()->toTree();

        $category_tree = [];

        $traverse = function ($categories, $prefix = ' - ') use (&$traverse, &$category_tree) {
            foreach ($categories as $category) {
                $category_tree[ $category->id ] = $prefix.' '.$category->name;
                $traverse($category->children, $prefix.' - ');
            }
        };

        $traverse($nodes);

        return $category_tree;
    }
}