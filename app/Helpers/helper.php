<?php
use App\Models\MenuPermission;
use App\Models\Menus;

function akses($menu_id)
{
    $permission = MenuPermission::where('role_id',Auth::user()->role_id)->where('menu_id',$menu_id)->first();
    return $permission ?? (object)['is_view' => 0,'is_add'=>0,'is_edit'=>0,'is_delete'=>0];
}

function _menus()
{
    $menus = Menus::with('allChildren')->where('parent_id',0)->orderBy('position')->get();
    $menus = $menus->toArray();
    $html  = "";
    foreach($menus as $menu) {
       
        if ($menu['all_children']) {
            $html .= "<li class='sidebar-item has-sub'>";
        } else {
             $html  .= "<li class='sidebar-item'>";
        }
        $html .= "<a href='".$menu['link']."' class='sidebar-link'>
                     <i class='".url($menu['icon'])."'></i>
                     <span>".$menu['menu']."</span>
                 </a>";
        if ($menu['all_children']) {
            $html .= "<ul class='submenu'>";
            foreach($menu['all_children'] as $child) {
                $html .= "<li class='submenu-item'>
                            <a href='".url($child['link'])."'>
                            <i class='".$child['icon']."'></i>
                            <span>".$child['menu']."</span></a>";
            }
            $html .="</ul>";
        }
        $html .= "</li>";
        
    }
    return $html;
}