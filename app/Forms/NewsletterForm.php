<?php

namespace App\Forms;

use App\Models\Newsletter;
use App\Models\NewsletterNoticia;
use App\Models\Noticia;
use App\Models\Retranca;
use Carbon\Carbon;
use Kris\LaravelFormBuilder\Form;

class NewsletterForm extends Form
{
    public function buildForm()
    {
        if (!$this->model){
            $news = Newsletter::orderByDesc('created_at')->first();
            if ($news == null){
                $num = 1;
            }else {
                $num = $news->num_seq;
                $num = $num+1;
            }
            $choices_noti = Noticia::wherePublic('n')->pluck('resumo', 'id')->toArray();
        }else{
            $selected = $this->model->noticias->pluck('id')->toArray();
            $data = Carbon::parse($this->model->data_edicao)->format('Y-m-d');
            $choices_noti = Noticia::newsl($this->model->id)->orWhere('public', '=', 'n')->pluck('resumo', 'id')->toArray();
            //dd($selected);
        }
        //dd($this->model->data_edicao);
        $this
            ->add('data_edicao', 'date', [
                'label' => 'Data Edição',
                'label_attr' => ['class' => 'block control-label label-form'],
                'attr' => ['class' => 'div-news', 'required' => 'required'],
                'value' => $this->model ? $data : '',
            ])
            ->add('foto', 'hidden', [
                'value' => false,
            ])
            ->add('numb', 'text', [
                'label' => 'Edição nº',
                'label_attr' => ['class' => 'block control-label label-form'],
                'value' => $this->model ? $this->model->numb_edicao : date('Y').'_'.str_pad($num, 4, '0', STR_PAD_LEFT),
                'attr' => ['class' => 'div-news', 'disabled' => 'disabled'],
            ])
            ->add('numb_edicao', 'hidden', [
                'value' => $this->model ? $this->model->numb_edicao : date('Y').'_'.str_pad($num, 4, '0', STR_PAD_LEFT),
            ])
            ->add('num_seq', 'hidden', [
                'value' => $this->model ? $this->model->num_seq : $num,
            ])
            ->add('user_id', 'hidden', [
                'value' => \Auth::id(),
            ])
            ->add('abertura', 'textarea',[
                'label' => 'Abertura da Newsletter',
                'label_attr' => ['class' => 'block control-label label-form'],
                'attr' => ['class' => 'ckeditor form-control', 'required' => 'required'],
            ])
            ->add('noticias', 'choice', [
                'label' => 'Selecione as Notas',
                'label_attr' => ['class' => 'block label-form'],
                'choices' => $choices_noti,
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
