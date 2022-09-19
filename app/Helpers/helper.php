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
    $menus = Menus::with(['allChildren'=>function($q){
        $q->orderBy('position');  
    }])->where('parent_id',0)->orderBy('position')->get();
    $menus = $menus->toArray();
    $html  = "";
    foreach($menus as $menu) {
       
        if ($menu['all_children']) {
            $html .= "<li class='sidebar-item has-sub'>";
        } else {
             $html  .= "<li class='sidebar-item'>";
        }
        $html .= "<a href='".($menu['all_children'] ? '#' : url($menu['link']))."' class='sidebar-link'>
                     <i class='".$menu['icon']."'></i>
                     <span>".$menu['menu']."</span>
                 </a>";
        if ($menu['all_children']) {
            $html .= "<ul class='submenu ".(request()->segment(1) == $menu['link'] ? 'active' : '')."'>";
            foreach($menu['all_children'] as $child) {
                $html .= "<li class='submenu-item ".(request()->is($child['link']) ? 'active' : '')."'>
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

function menu_table()
{
    $menus = Menus::with(['allChildren'=>function($q){
        $q->orderBy('position');  
    }])->where('parent_id',0)->orderBy('position')->get();
    $menus = $menus->toArray();
    $html  = "<table class='table'>";
    $html  = "<tr><th>Nama Menu</th><th>Allow</th></th>Denied</th></tr>";
    foreach($menus as $menu) {
       $html .= "<tr>";
       if ($menu['all_children']) {
            foreach($menu['all_children'] as $child) {
                $html .= "<td style='margin-left:5px'>".$child['menu']."</td>";
                $html .= radio_akses($child['id']);
            }
       } else {
            $html = "<td>".$menu['menu']."</td>";
            $html .= radio_akses($menu['id']);
       }
       
       $html .= "</tr>";
    }
    $html .= "</table>";
    return $html;
}

function radio_akses($menu_id)
{
    $html = "<td><input type='radio' name='menu[$menu_id]' value='1'> Yes</td>";
    $html .= "<td><input type='radio' name='menu[$menu_id]' value='0'> No</td>";
    return $html;
}