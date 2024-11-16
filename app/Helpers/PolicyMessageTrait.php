<?php

namespace App\Helpers;

trait PolicyMessageTrait
{
    public function getMessage(string $action, string $nameItem): string
    {
        return match ($action) {
            'view' => 'No estás autorizado para visualizar los '.$nameItem,
            'create' => 'No estás autorizado para crear '.$nameItem,
            'edit' => 'No estás autorizado para editar '.$nameItem,
            'delete' => 'No estás autorizado para eliminar '.$nameItem
        };
    }
}
