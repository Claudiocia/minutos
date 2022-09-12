<?php
    $tabs = [
        [
            'title' => 'Site',
            'link' => route('admin.sites.index'),
        ],
        [
            'title' => 'Titulo',
            'link' => '#',
        ],
        [
            'title' => 'Abertura',
            'link' => '#',
        ],
        [
            'title' => 'Botão',
            'link' => '#',
        ],
        [
            'title' => 'Cancela',
            'link' => '#',
        ],
        [
            'title' => 'Apoio',
            'link' => '#',
        ],
        [
            'title' => 'Causa',
            'link' => '#',
        ],
        [
            'title' => 'Avaliações',
            'link' => '#',
        ],
        [
            'title' => 'CTA',
            'link' => '#',
        ],
        [
            'title' => 'Footer',
            'link' => '#',
        ],
        [
            'title' => 'Imagens',
            'link' => '#',
        ],
    ];

?>
{!! \Bootstrapper\Facades\Navigation::tabs($tabs) !!}
<div>
    {!! $slot !!}
</div>
