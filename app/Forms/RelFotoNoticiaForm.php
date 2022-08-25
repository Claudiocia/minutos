<?php

namespace App\Forms;

use App\Models\Foto;
use App\Models\Retranca;
use Kris\LaravelFormBuilder\Form;
use phpDocumentor\Reflection\Types\Collection;

class RelFotoNoticiaForm extends Form
{
    public function buildForm()
    {
        $ret_id = $this->model->retranca_id;
        $retranca = Retranca::with('fotos')->whereId($ret_id)->first();
        $fotos = $retranca->fotos->pluck('origin_name', 'id')->toArray();
        $selected = $this->model->fotos->pluck('id')->toArray();

        $this
            ->add('not_title', 'text', [
                'label' => 'Título Noticia',
                'value' => $this->model->title,
                'attr' => ['disabled' => 'disabled']
            ])
            ->add('noticia_id', 'hidden', [
                'value' => $this->model->id,
            ])
            ->add('foto', 'hidden', [
                'value' => true,
            ])
            ->add('foto_id', 'choice', [
                'label' => 'Fotos',
                'label_attr' => ['class' => 'block label-form'],
                'choices' => $fotos,
                'choice_options' => [
                    'wrapper' => ['class' => 'my-wrapper label-form'],
                    'label_attr' => ['class' => 'label-class'],
                ],
                'selected' => $this->model ? $selected : '',
                'multiple' => true,
                'expanded' => true,
            ]);
    }
}
