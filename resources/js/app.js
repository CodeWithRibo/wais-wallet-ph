import './bootstrap';
import Alpine from 'alpinejs';
import anchor from '@alpinejs/anchor'
import './globals/modals.js';

Alpine.plugin(anchor)
window.Alpine = Alpine;
Alpine.start();import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';

// now you can register
// components using Alpine.data(...) and
// plugins using Alpine.plugin(...)



Livewire.start()
