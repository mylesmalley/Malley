<?php

namespace Modules\UserManagement\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\View\View;

class UserDetails extends Component
{
    public User $user;

    protected array $rules = [
        'user.first_name' => 'required|string|max:40|min:3',
        'user.last_name' => 'required|string|max:40|min:3',
        'user.email' => 'required|email',
        'user.company_id' => 'required|integer',
    ];


    /**
     * @param string $propertyName
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updated( string $propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    /**
     *  validate and update model - fires whenever a field is deselected or updated
     */
    public function save(): void
    {
        $this->validate();
        $this->user->save();
    }


    /**
     * @return View
     */
    public function render(): View
    {
        return view('usermanagement::livewire.user-details');
    }
}
