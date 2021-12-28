<?php


namespace App\View\Components;


use App\Enum\UserRole;
use ErrorException;
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

        if ($actions == null) {
            return null;
        }


        $items = array();
        foreach ($actions as $action) {
            $items[] = $this->getNavItemSettings($route, $action);
        }

        return view('components.navigation-toolbar', [
            "items" => $items,
        ]);
    }

    private function getActions($route)
    {
        switch ($route) {
            case ('albums'):
                return ['import'];
            case('album'):
                $item = $this->getModelWithId();
                return [['delete', $item]];
        }
        return null;
    }

    private function getModelWithId()
    {
        try {
            $item = request()->route()->parameters();
            reset($item);
            $itemname = key($item);
            $itemId = reset($item)->id;
            return [$itemname, $itemId];
        } catch (ErrorException $e) {
            return null;
        }
    }

    private function getNavItemSettings($parent_route, $action)
    {
//        dd($action);
        if (is_array($action)) {
            $itemName = $action[0];
            $actionitem = $action[1];
            $href = route($parent_route . '.' . $itemName,
                [$actionitem[0] => $actionitem[1]]);
        } else {
            $itemName = $action;
            $href = route($parent_route . '.' . $action);
        }
        $active = request()->routeIs($href);
        return ["name" => $itemName, "href" => $href, "active" => $active];
    }
}
