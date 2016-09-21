<?php

namespace tests\eLife\Patterns\ViewModel;

use eLife\Patterns\ViewModel\ArticleSection;

final class ArticleSectionTest extends ViewModelTest
{
    /**
     * @test
     */
    public function it_has_data()
    {
        $data = [
            'id' => 'id',
            'title' => 'some title',
            'body' => [

                    [
                        'content' => '<p>para 1</p>',
                    ],

                    [
                        'content' => '<b>Something else</b>',
                    ],
                ],
            'first' => false,
        ];

        $actionSection = new ArticleSection('id', 'some title', ['<p>para 1</p>', '<b>Something else</b>']);

        $this->assertSame($data['id'], $actionSection['id']);
        $this->assertSame($data['title'], $actionSection['title']);
        $this->assertSame($data['body'], $actionSection['body']);
        $this->assertSame($data['first'], $actionSection['first']);

        $this->assertSame($data, $actionSection->toArray());
    }

    public function viewModelProvider() : array
    {
        return [
            'first' => [new ArticleSection('id', 'some title', ['<p>para 1</p>', '<b>Something else</b>'], true)],
            'not-first' => [new ArticleSection('id', 'some title', ['<p>para 1</p>', '<b>Something else</b>'], false)],
        ];
    }

    protected function expectedTemplate() : string
    {
        return '/elife/patterns/templates/article-section.mustache';
    }
}
