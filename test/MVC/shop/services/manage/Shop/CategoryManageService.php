<?php

namespace shop\services\manage;

use shop\entities\Meta;
use shop\entities\Shop\Category;
use shop\forms\manage\Shop\CategoryForm;
use shop\repositories\Shop\CategoryRepository;

class CategoryManageService
{
    private $categories;
    public function __construct(CategoryRepository $categories)
    {
        $this->categories = $categories;
    }


    public function create(CategoryForm $form): Category
    {
        $parent = $this->categories->get($form->parentId);
        $category = Category::create(
            $form->name,
            $form->slug,
            $form->title,
            $form->description,
            new Meta(
                $form->meta->title,
                $form->meta->description,
                $form->meta->keywords
            )
        );
        $category->appendTo($parent);
        $this->categories->save($category);
        return $category;
    }
    public function edit($id, CategoryForm $form)
    {
        $category = $this->categories->get($id);
        $this->assertIsNotRoot($category);
        $category->edit(
            $form->name,
            $form->slug,
            $form->title,
            $form->description,
            new Meta(
                $form->meta->title,
                $form->meta->description,
                $form->meta->keywords
            )
        );
        if ( $form->parentId !== $category->parent->id ) {
            $parent = $this->categories->get($form->parentId);
            $category->appendTo($parent);
        }
        $this->categories->save($category);
    }

    public function remove($id)
    {
        $category = $this->categories->get($id);
        $this->assertIsNotRoot($category);
        $this->categories->remove($category);
    }
    public function assertIsNotRoot(Category $category)
    {
        if ($category->isRoot()) {
            throw new \DomainException('Unable to manage the root  category.');
        }
    }
}