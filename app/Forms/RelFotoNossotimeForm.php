<?php

namespace App\Forms;

use App\Models\Foto;
use Kris\LaravelFormBuilder\Form;

class RelFotoNossotimeForm extends Form
{
    public function buildForm()
    {
        $fotos = Foto::whereUsing('site')->pluck('origin_name', 'id')->toArray();
        $this
            ->add('nome', 'text', [
                'label' => 'Colaborador',
                'label_attr' => ['class' => 'block label-form'],
                'value' => $this->model->nome,
                'attr' => ['disabled' => 'disabled']
            ])
            ->add('foto', 'hidden', [
                'value' => true,
            ])
            ->add('nossotime_id', 'hidden', [
                'value' => $this->model->id,
            ])
            ->add('foto_id', 'choice', [
                'label' => 'Foto',
                'label_attr' => ['class' => 'block label-form'],
                'choices' => $fotos,
                'choice_options' => [
                    'wrapper' => ['class' => 'my-wrapper label-form'],
                    'label_attr' => ['class' => 'label-class'],
                ],
                'selected' => $this->model->foto_id,
                'multiple' => false,
                'expanded' => true,
            ]);
    }
}
