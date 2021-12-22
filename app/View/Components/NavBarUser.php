<?php


namespace App\View\Components;


use App\Enum\UserRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;

class NavBarUser extends Component
{

    public function render()
    {
        $user = Auth::user();
        if ($user == null) {
            return null;
        }

        $level = $user->level();
        if ($level < UserRole::Moderator) {
            return null;
        }

        return $this->getActions(Route::currentRouteName());
        return view('navBar', $this->getActions(Route::currentRouteName()));
    }

    private function getActions($route)
    {
        switch ($route) {
            case ('albums'):
            case('posts'):
                return ['new', 'import', 'delete'];
            case('album'):
            case('post'):
                return ['edit'];
        }
        return null;
    }
}
