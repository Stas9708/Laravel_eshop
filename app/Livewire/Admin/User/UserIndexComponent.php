<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
#[Title('Users')]
class UserIndexComponent extends Component
{
    use WithPagination;

    public function render()
    {
        $users = User::query()
            ->orderBy('id', 'DESC')
            ->paginate();
        return view('livewire.admin.user.user-index-component', compact('users'));
    }

    public function deleteUser(User $user)
    {
        try {
            DB::beginTransaction();
            DB::table('orders')
                ->where('user_id', '=', $user->id)
                ->update(['user_id' => NULL]);
            $user->delete();
            DB::commit();
            $this->js("toastr.success('User deleted successfully!')");
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            $this->js("toastr.error('Error deleting user!')");
        }
    }
}
