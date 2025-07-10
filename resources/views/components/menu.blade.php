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
    $varclass ='';
    if($menu->enabled ==1 && ($menu->permission === null || auth()->user()?->can($menu->permission))) {
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
                
                $rutaFinActual='';
                for ($i = 0; $i <= $level; $i++) {
                    //concatenmaos las rutas para comparar y ver si es la actual
                    $rutaFinActual .= $rutaFinActual== '' ? $RutaArray[$i].'_' :  $RutaArray[$i];
                }
                
                $varclass = $menu->url==$rutaFinActual ? 'active subdrop' : '';
                if ($menu->children->isNotEmpty()) 
                {
                    $levelclass .= $menu->url==$rutaFinActual ? 'Active' : ''; 
                } else {

                    $levelclass .= $menu->url==$rutaFinActual ? '' : '';

                }
                //$varclass = $menu->url==$RutaArray[$level] ? 'active subdrop' : '';
                //$varclass .=$menu->url.'-'.$RutaArray[$level];

            } else {
                $varclass = $menu->url==$RutaArray[0] ? 'active subdrop' : '';
                $varclass.='1';
            }
            
        
            
            echo '<li class="submenu '. $levelclass .'">';
                echo '<a href="javascript:void(0);"  class="'. $varclass. '"><i class="' . $menu->icon . ' fs-16 me-2"></i><span>' . $menu->title . '</span><span class="menu-arrow"></span></a>';
                /*
                echo Route::currentRouteName().'<br>'.$level.'<br>'.count($RutaArray).'<br>'.$menu->url.'<br>';
                for ($i = 0; $i < count($RutaArray); $i++) {
                    echo $RutaArray[$i].'<br>';
                }
                */
                echo '<ul>';
                        foreach ($menu->children as $child) {
                            renderSubMenus($child, 2);
                        }
                echo '</ul>';
            echo '</li>';
            
        } else { 
            $RutaArray = explode(".", Route::currentRouteName());
            $rutaFinActual='';
            if(count($RutaArray) > 2){
                
                for ($i = 0; $i <= $level; $i++) {
                    //concatenmaos las rutas para comparar y ver si es la actual
                    $rutaFinActual .= $i < $level ? $RutaArray[$i].'_' :  $RutaArray[$i];
                }

                if ($menu->children->isNotEmpty()) 
                {
                    
             
                    $varclass = $menu->url==$rutaFinActual ? 'Active' : '';
                } else {
                    
                    //echo Route::currentRouteName().'-'.$menu->title;
                    $varclass = ($menu->url==$RutaArray[$level] || $menu->url==$rutaFinActual) ? 'active subdrop' : ''; //segundo nivel
                
                }
                
                //$varclass .=$menu->url.'-'.$RutaArray[$level];
            } else {

                
                $varclass = $menu->url==$RutaArray[0] ? 'active subdrop' : ''; //dashboard
                $varclass.='1';

                
            }

            
            


            echo '<li class="'. $varclass. ' 1">';
                //echo $varclass;
                //echo Route::currentRouteName().'-'.$level.'-'.count($RutaArray).'-'.$rutaFinActual.'='.$menu->url;
                echo '<a href="' . ($menu->route ? secure_route($menu->route) : '#') . '"><i class="' . $menu->icon . ' fs-16 me-2"></i><span>' . $menu->title . '</span></a>';
            echo '</li>';
        }
    }
        
}
@endphp


@php renderMenu($menus); @endphp


