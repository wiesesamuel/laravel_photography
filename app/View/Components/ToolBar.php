<?php


namespace App\View\Components;


use App\Enum\UserRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;

class ToolBar extends Component
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

        $route = Route::currentRouteName();
        $actions = $this->getActions($route);
        return view('components.navigation-toolbar', [
            "parent_route" => $route,
            "actions" => $actions,
        ]);
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
