<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class MenuServiceProvider extends ServiceProvider
{
  public function register()
  {
    //
  }

  public function boot()
  {
    View::composer('panels.sidebar', function ($view) {
      $menuData = json_decode(file_get_contents(base_path('resources/data/menu-data/verticalMenu.json')));

      $userRole = session('role');

      // Role-based filtering
      if (!empty($menuData->menu)) {
        $menuData->menu = array_values(array_filter($menuData->menu, fn($menu) => isset($menu->roles) && in_array($userRole, $menu->roles)));
      }

      $view->with('menuData', $menuData);
    });
  }
}
