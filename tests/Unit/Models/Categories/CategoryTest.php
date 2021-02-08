<?php

namespace Tests\Unit\Models\Categories;

use App\Models\Category;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use DatabaseMigrations;

    public function test_it_has_many_children()
    {
        $category = factory(Category::class)->create();
        
        $category->children()->save(
            factory(Category::class)->create()
        );

        $this->assertInstanceOf(Category::class, $category->children->first());
    }

    public function test_it_counts_only_parents()
    {
        $category = factory(Category::class)->create();
        
        $category->children()->save(
            factory(Category::class)->create()
        );

        $this->assertEquals(1, Category::parents()->count());
    }

    public function test_it_is_orederable()
    {
        $category = factory(Category::class)->create([
            'order' => 2
        ]);

        $anotherCategory = factory(Category::class)->create([
            'order' => 1
        ]);

        $this->assertEquals($anotherCategory->name, Category::ordered()->first()->name);


    }
}
