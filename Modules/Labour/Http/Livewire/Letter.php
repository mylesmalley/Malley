<?php

namespace Modules\Labour\Http\Livewire;

use Illuminate\Support\Collection;
use Livewire\Component;
use App\Models\User;
use Illuminate\View\View;

class Letter extends Component
{
    public string $letter;
    public int $user;
    public Collection $users;

    protected $listeners = [
        'letterSelected',
        'userDeselected',
        'hide'
    ];


    protected array $rules = [
        'letter' => 'nullable|sometimes|alpha|max:1',
        'user' => 'nullable|sometimes|integer',
    ];

    /**
     *
     */
    public function hide( array $data ): void
    {
        $this->letter = $data['letter'];
        $this->user = $data['user'];
        $this->users = User::where('is_enabled', true)
            ->role('labour')
            ->where('last_name', 'like', $data['letter'] . "%" )
            ->get();
    }


    /**
     * @param array $payload
     */
    public function letterSelected( array $payload ): void
    {
        $this->letter = $payload[ 'letter'];
        $this->validate();
        $this->users = User::role('labour')
            ->where('is_enabled', true)
            ->where('last_name', 'like', $this->letter . "%" )
            ->get();

    }


    /**
     * hide this component and show the alphabet again
     */
    public function deselectLetter(): void
    {
        $this->emit('deselectLetter'  );
        unset( $this->letter );

    }

    /**
     *
     */
    public function userDeselected(): void
    {
         unset( $this->user );
    }


    /**
     * @param int $user_id
     */
    public function selectUser(int $user_id ): void
    {
        $this->user = $user_id;
        $this->validate();

        $this->emit('selectedUser', ['user_id' => $user_id]  );

    }


    /**
     * @return View
     */
    public function render(): View
    {
        return view("labour::livewire.letter");
    }
}
