<?php

namespace tests\eLife\Patterns\ViewModel;

use eLife\Patterns\ViewModel\FormLabel;
use eLife\Patterns\ViewModel\TextArea;

class TextAreaTest extends ViewModelTest
{
    /**
     * @test
     */
    public function it_has_data()
    {
        $data = [
            'label' => [
                'labelText' => 'label text',
                'isVisuallyHidden' => false,
            ],
            'name' => 'name',
            'id' => 'someid',
            'value' => 'default value',
            'placeholder' => 'placeholder',
            'required' => true,
            'disabled' => true,
            'autofocus' => true,
            'cols' => 10,
            'rows' => 10,
            'form' => 'form',
            'classNames' => 'text-field--error',
        ];
        $textArea = new TextArea(
            new FormLabel($data['label']['labelText']),
            $data['id'],
            $data['name'],
            $data['value'],
            $data['placeholder'],
            $data['required'],
            $data['disabled'],
            $data['autofocus'],
            $data['cols'],
            $data['rows'],
            $data['form'],
            TextArea::STATUS_ERROR
        );

        $this->assertSameWithoutOrder($data, $textArea);
    }

    public function viewModelProvider() : array
    {
        return [
            [new TextArea(new FormLabel('label text'), 'someid', 'name', 'default value')],
            [
                new TextArea(
                    new FormLabel('label text', 'someid'),
                    'someid',
                    'name',
                    'default value',
                    'place holder value',
                    true, // required
                    true, // disabled
                    false, // auto-focus
                    30, // cols
                    2, // rows
                    'some_form_id',
                    TextArea::STATUS_ERROR
                ),
            ],
        ];
    }

    protected function expectedTemplate() : string
    {
        return 'resources/templates/text-area.mustache';
    }
}
