<?php

namespace App\Forms;

use App\Models\Retranca;
use Kris\LaravelFormBuilder\Form;

class FotoForm extends Form
{
    public function buildForm()
    {
        if ($this->model != null){
            $selected = $this->model->retrancas->pluck('id')->toArray();
            //dd($selected);
        }
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
            ->add('retranca_id', 'choice', [
                'label' => 'Editoria',
                'label_attr' => ['class' => 'block label-form'],
                'choices' => Retranca::orderBy('nome', 'ASC')->pluck('nome', 'id')->toArray(),
                'choice_options' => [
                    'wrapper' => ['class' => 'wrapper'],
                    'label_attr' => ['class' => 'label-class'],
                ],
                'selected' => $this->model ? $selected : '',
                'multiple' => true,
                'expanded' => true,
            ]);
    }
}
