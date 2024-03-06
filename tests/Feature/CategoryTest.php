<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    public function testCreate()
    {
        $data = [
            'title' => 'Test Name',
        ];

        $model = Category::create($data);

        $this->assertInstanceOf(Category::class, $model);
        $this->assertEquals($data['title'], $model->title);
    }

    public function testRead()
    {
        $model = Category::create([
            'title' => 'Test Name',
        ]);

        $foundModel = Category::find($model->id);

        $this->assertInstanceOf(Category::class, $foundModel);
        $this->assertEquals($model->id, $foundModel->id);
        $this->assertEquals($model->title, $foundModel->title);
    }


    public function testUpdate()
    {
        $model = Category::create([
            'title' => 'Test Name',
        ]);

        $updateData = [
            'title' => 'Updated Name',
        ];

        $model->update($updateData);

        $model->refresh();

        $this->assertEquals($updateData['title'], $model->title);
    }
    public function testDelete()
    {
        $model = Category::create([
            'title' => 'Test Name',
        ]);

        $deleted = $model->delete();

        $this->assertTrue($deleted);

        $foundModel = Category::find($model->id);

        $this->assertNull($foundModel);
    }
}
