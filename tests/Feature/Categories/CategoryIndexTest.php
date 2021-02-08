<?php

namespace Tests\Feature\Categories;

use App\Models\Category;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CategoryIndexTest extends TestCase
{
    use DatabaseMigrations;

    public function test_it_returns_a_collection_of_categories()
    {
        $categories = factory(Category::class, 2)->create();

        $this->json('GET', 'api/categories')
             ->assertJsonFragment([
                'name' => $categories->get(0)->name,
                'name' => $categories->get(1)->name
             ]);
    }

    public function test_it_returns_only_parent_categories()
    {
        $category = factory(Category::class)->create();
        
        $category->children()->save(
            factory(Category::class)->create()
        );

        $this->json('GET', 'api/categories')
             ->assertJsonCount(1, 'data');
    }

    public function test_it_returns_oredered_categories()
    {
        $category = factory(Category::class)->create([
            'order' => 2
        ]);

        $anotherCategory = factory(Category::class)->create([
            'order' => 1
        ]);

        $this->json('GET', 'api/categories')
             ->assertSeeInOrder([
                $anotherCategory->name, 
                $category->name
             ]);


    }
}
