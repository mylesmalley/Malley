<?php

namespace Modules\Labour\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\View\View;

class LoginForm extends Component
{

    public User $user;
    public int $user_id;
    public string $pin = '';
    public bool $retry = false;

    protected $listeners = [
        'selectedUser'
    ];

    protected array $rules = [
        'user_id' => 'nullable|sometimes|integer',
    ];


    /**
     * @param array $payload
     */
    public function selectedUser( array $payload ): void
    {
        $this->user_id = (int )$payload['user_id'];
        $this->validate();

        $this->retry = $payload['retry'] ?? false;

        $this->user = User::find( $payload['user_id'] );

        $this->emit('test');
    }



    /**
     * clears out the component and fires off an event to let the others know.
     */
    public function deselectUser(): void
    {
        unset( $this->user );
        unset( $this->user_id );
        unset( $this->pin );

        $this->emit('userDeselected');
    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view("labour::livewire.login-form");
    }
}
