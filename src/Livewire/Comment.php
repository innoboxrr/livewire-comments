<?php
 
namespace Innoboxrr\LivewireComments\Livewire;
 
use Livewire\Component;
 
class Comment extends Component
{

    public $blockId;
    public $title;
    public $role;
    public $callback;

    public function mount($blockId = null, $title = 'Publicar comentario', $role = 'student')
    {   
        $this->blockId = $blockId ?? url()->current();
        $this->title = $title;
        $this->role = $role;
        $this->callback = $this->getCallback();
    }

    public function getCallback()
    {
        return url('/blocks/'.$this->blockId.'/user/' . auth()->id() . '/comments');
    }

    public function render()
    {
        return view('lwc::comment');
    }
}