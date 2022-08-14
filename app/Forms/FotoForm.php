<?php

namespace App\Forms;

use App\Models\Retranca;
use Kris\LaravelFormBuilder\Form;

class FotoForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('id', 'hidden', [
                'value' => $this->model->id,
            ])
            ->add('legenda', 'text', [
                'label' => 'Legenda',
                'label_attr' => ['class' => 'block label-form'],
            ])
            ->add('credito', 'text', [
                'label' => 'Créditos',
                'label_attr' => ['class' => 'block label-form'],
            ])
            ->add('retranca_id[]', 'choice', [
                'label' => 'Editoria',
                'label_attr' => ['class' => 'block label-form'],
                'choices' => Retranca::orderBy('nome', 'ASC')->pluck('nome', 'id')->toArray(),
                'choice_options' => [
                    'wrapper' => ['class' => 'my-wrapper'],
                    'label_attr' => ['class' => 'label-class'],
                ],
                'empty_value' => 'Selecione...',
                'multiple' => true,
                'expanded' => true,
            ]);
    }
}
