@php
function renderMenu($menus) 
{
    foreach ($menus as $menu) 
    {
        if($menu->enabled ==1) {
            if ($menu->permission === null || auth()->user()?->can($menu->permission)) 
            {
                echo '<li class="submenu-open">';
                    echo '<h6 class="submenu-hdr">'. $menu->title .'</h6>';                        
                    echo '<ul>';
                        if ($menu->children->isNotEmpty()) {                        
                            foreach ($menu->children as $child) {
                                renderSubMenus($child, 1);
                            }
                        }
                    echo '</ul>';
                echo '</li>';
            }
        }
    }    
}


function renderSubMenus($menu, $level) {

    if($menu->enabled ==1) {
        if ($menu->children->isNotEmpty()) 
        {
            $levelclass ='';
            if($level == 2) {
                $levelclass .= 'submenu-two ';
            } elseif($level == 3) {
                $levelclass .= 'submenu-two submenu-three ';
            }
            
            $RutaArray = explode(".", Route::currentRouteName());
            if(count($RutaArray) > 1){
                $varclass = $menu->url==$RutaArray[$level] ? 'active subdrop' : '';
                //$varclass .=$menu->url.'-'.$RutaArray[$level];

            } else {
                $varclass = $menu->url==$RutaArray[0] ? 'active subdrop' : '';
                $varclass.='1';
            }
            
        
            
            echo '<li class="submenu '. $levelclass .'">';
                echo '<a href="javascript:void(0);"  class="'. $varclass. '"><i class="' . $menu->icon . ' fs-16 me-2"></i><span>' . $menu->title . '</span><span class="menu-arrow"></span></a>';
                //echo Route::currentRouteName().'-'.$level.'-'.count($RutaArray);
                echo '<ul>';
                        foreach ($menu->children as $child) {
                            renderSubMenus($child, 2);
                        }
                echo '</ul>';
            echo '</li>';
            
        } else { 
            $RutaArray = explode(".", Route::currentRouteName());
            
            if(count($RutaArray) > 1){
                $varclass = $menu->url==$RutaArray[$level] ? 'active subdrop' : '';
                //$varclass .=$menu->url.'-'.$RutaArray[$level];
            } else {
                $varclass = $menu->url==$RutaArray[0] ? 'active subdrop' : '';
                $varclass.='1';
            }
            


            echo '<li class="'. $varclass. '">';
                //echo Route::currentRouteName().'-'.$level.'-'.count($RutaArray).'-'.$RutaArray[$level-1];
                echo '<a href="' . ($menu->route ? secure_route($menu->route) : '#') . '"><i class="' . $menu->icon . ' fs-16 me-2"></i><span>' . $menu->title . '</span></a>';
            echo '</li>';
        }
    }
        
}
@endphp


@php renderMenu($menus); @endphp


