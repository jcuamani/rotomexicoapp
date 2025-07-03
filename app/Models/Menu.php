<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ['title', 'route','url', 'icon', 'permission', 'parent_id', 'order', 'enabled'];

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id')->orderBy('order');
    }

    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    public function scopeTopLevel($query)
    {
        return $query->whereNull('parent_id')->orderBy('order');
    }

    /**
     * Set query callback to model.
     *
     *
     * @return $this
     */
    public function withQuery(?\Closure $query = null)
    {
        $this->queryCallback = $query;

        return $this;
    }

     /**
     * Get all elements.
     *
     * @return mixed
     */
    public function allNodes($menuId, $ignoreItemId = null, $includeDisabledItems = false)
    {
        $self = new static();

        if ($this->queryCallback instanceof \Closure) {
            $self = call_user_func($this->queryCallback, $self);
        }

        if ($ignoreItemId) {
            return $self//->where($this->getMenuRelationColumn(), $menuId)
                ->where(function ($query) use ($ignoreItemId) {
                    $query->where($this->getParentColumn(), '!=', $ignoreItemId)->orWhereNull($this->getParentColumn());
                })
                ->when(! $includeDisabledItems, function ($query) {
                    $query->where('enabled', true);
                })
                ->when($this->hasSpatiePermission, function ($query) {
                    $query->with('roles');
                })
                ->orderBy($this->getOrderColumn())->get();
        }

        return $self //->where($this->getMenuRelationColumn(), $menuId)
            ->when(! $includeDisabledItems, function ($query) {
                $query->where('enabled', true);
            })
            ->when($this->hasSpatiePermission, function ($query) {
                $query->with('roles');
            })
            ->orderBy($this->getOrderColumn())->get();
    }

     /**
     * @return string
     */
    public function getMenuRelationColumn()
    {
        if (property_exists($this, 'menuRelationColumn')) {
            return $this->menuRelationColumn;
        }

        return 'menu_id';
    }

    /**
     * Get order column name.
     *
     * @return string
     */
    public function getOrderColumn()
    {
        if (property_exists($this, 'orderColumn')) {
            return $this->orderColumn;
        }

        return 'order';
    }
     /**
     * @return string
     */
    public function getParentColumn()
    {
        if (property_exists($this, 'parentColumn')) {
            return $this->parentColumn;
        }

        return 'parent_id';
    }

    
    /**
     * Get title column.
     *
     * @return string
     */
    public function getTitleColumn()
    {
        if (property_exists($this, 'titleColumn')) {
            return $this->titleColumn;
        }

        return 'title';
    }

    public static function selectOptions($menuId, $ignoreItemId = null, $includeDisabledItems = false, ?\Closure $closure = null)
    {
        $options = (new static())->withQuery($closure)->buildSelectOptions($menuId, $ignoreItemId, $includeDisabledItems);

        return collect($options)->all();
    }

    /**
     * Build options of select field in form.
     *
     * @param  int  $parentId
     * @param  string  $prefix
     * @param  string  $space
     * @return array
     */
    protected function buildSelectOptions($menuId, $ignoreItemId, $includeDisabledItems = false, $nodes = null, $parentId = 0, $prefix = '', $space = '&nbsp;')
    {
        $prefix = $prefix ?: '┝'.$space;

        $options = [];

        if (empty($nodes)) {
            $nodes = $this->allNodes($menuId, $ignoreItemId, $includeDisabledItems);
        }

        $nodes->each(function ($node) use ($menuId, $nodes, $includeDisabledItems, $parentId, $prefix, $space, &$options) {
            $parentColumn = $this->getParentColumn();
            $keyName = $this->getKeyName();
            $titleColumn = $this->getTitleColumn();
            if ($parentId == $node->$parentColumn) {
                $node->$titleColumn = $prefix.$space.$node->$titleColumn;

                $childrenPrefix = str_replace('┝', str_repeat($space, 6), $prefix).'┝'.str_replace(['┝', $space], '', $prefix);

                $children = $this->buildSelectOptions($menuId, null, $includeDisabledItems, $nodes, $node->$keyName, $childrenPrefix);

                $options[$node->$keyName] = $node->$titleColumn;

                if ($children) {
                    $options += $children;
                }
            }
        });

        return $options;
    }


    /**
     * Format data to tree like array.
     *
     * @return \Illuminate\Support\Collection
     */
    public function toTree($menuId, $includeDisabledItems = false, $checkPermission = false)
    {
        return $this->buildNestedItems($menuId, $includeDisabledItems, $checkPermission);
    }

    /**
     * Build Nested array.
     *
     * @param  int  $parentId
     * @return \Illuminate\Support\Collection
     */
    protected function buildNestedItems($menuId, $includeDisabledItems = false, $checkPermission = false, $nodes = null, $parentId = 0)
    {
        $branch = collect();

        if (empty($nodes)) {
            $nodes = $this->allNodes($menuId, null, $includeDisabledItems);
        }
        $nodes->each(function ($node) use ($menuId, $nodes, $includeDisabledItems, $checkPermission, $parentId, &$branch) {
            $hasPermission = true;
            $parentColumn = $this->getParentColumn();
            $keyName = $this->getKeyName();

            if ($checkPermission && ! $this->checkHasPermission($node)) {
                $hasPermission = false;
            }
            if ($parentId == $node->$parentColumn && $hasPermission) {
                $children = $this->buildNestedItems($menuId, $includeDisabledItems, $checkPermission, $nodes, $node->$keyName);
                if ($children) {
                    $node->children = $children;
                }

                $branch->push($node);
            }
        });

        return $branch;
    }

    public function CreateArrayMenu($data, $menu,$menus, $prefix = '',$space = '&nbsp;'){

        //$levelN=0;
        foreach($menu as $item)
        {

                $level = $this->getMenuLevelFromId($menus, $item->id);
                $prefix = $prefix ?: '┝'.$space;
                $childrenPrefix = str_replace('┝', str_repeat($space, 6), $prefix).'┝'.str_replace(['┝', $space], '', $prefix);
                
                $title =$prefix.$space. $item->title;

                $itemadd=array(
                "id" => $item->id,                
                "title" => $title ,//$item->title,               
                "enabled" => $item->enabled,               
                );
                array_push($data, $itemadd);
                
                if(count($item['children']) > 0)
                {
                    $level++;
                    $data=$this->CreateArrayMenu($data, $item['children'],$menus,$childrenPrefix);
                    
                }
                $level=0;
        }

          return $data;

    }

    function getMenuLevelFromId($menus, $id, $level = 0)
    {
        $menu = $menus->firstWhere('id', $id);

        if (!$menu || !$menu->parent_id) {
            return $level;
        }

        return $this->getMenuLevelFromId($menus, $menu->parent_id, $level + 1);
    }
}
