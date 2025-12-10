<?php

namespace App\Livewire\Concerns;

trait HasToast
{
    public function success(string $message): void
    {
        $this->dispatch('notify',
            type: 'success',
            content: $message,
            duration: 4000
        );
    }

    public function error(string $message): void
    {
        $this->dispatch('notify',
            type: 'error',
            content: $message,
            duration: 4000
        );
    }

    public function info(string $message): void
    {
        $this->dispatch('notify',
            type: 'info',
            content: $message,
            duration: 4000
        );
    }


}
