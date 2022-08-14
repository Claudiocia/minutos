<?php

namespace App\Forms;

use App\Models\Foto;
use Kris\LaravelFormBuilder\Form;
use phpDocumentor\Reflection\Types\Collection;

class RelFotoNoticiaForm extends Form
{
    public function buildForm()
    {
        $fots = \DB::table('foto_retranca')->where('retranca_id', '=', $this->model->retranca_id)->get();

        $fotos = json_decode($fots, true);

        $collect = array();
        $i =0;
        foreach ($fotos as $foto){
            array_push($collect, $foto['foto_id']);
        }
        $fotos2 = Foto::whereIn('id', $collect)->pluck('origin_name', 'id')->toArray();
        $this
            ->add('not_title', 'text', [
                'label' => 'Título Noticia',
                'value' => $this->model->title,
                'attr' => ['disabled' => 'disabled']
            ])
            ->add('noticia_id', 'hidden', [
                'value' => $this->model->id,
            ])
            ->add('foto_id[]', 'choice', [
                'label' => 'Fotos',
                'label_attr' => ['class' => 'block label-form'],
                'choices' => $fotos2,
                'choice_options' => [
                    'wrapper' => ['class' => 'my-wrapper label-form'],
                    'label_attr' => ['class' => 'label-class'],
                ],
                'empty_value' => 'Selecione...',
                'multiple' => true,
                'expanded' => true,
            ]);
    }
}
