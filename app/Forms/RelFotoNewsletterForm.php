<?php

namespace App\Forms;

use App\Models\Foto;
use App\Models\Retranca;
use Carbon\Carbon;
use Kris\LaravelFormBuilder\Form;
use phpDocumentor\Reflection\Types\Collection;

class RelFotoNewsletterForm extends Form
{
    public function buildForm()
    {
        $fotos = Foto::whereUsing('parceiro')->pluck('origin_name', 'id')->toArray();
        if ($this->model) {
            $selected = $this->model->fotos->pluck('id')->toArray();
        }else{
            $selected = '';
        }
        $this
            ->add('news_data-num', 'text', [
                'label' => 'Newsletter',
                'value' => "Edição número: ".$this->model->numb_edicao." -- Data: ".Carbon::parse($this->model->data_edicao)->format('d/m/Y'),
                'attr' => ['disabled' => 'disabled']
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
                'selected' => $selected,
                'multiple' => true,
                'expanded' => true,
            ]);
    }
}
