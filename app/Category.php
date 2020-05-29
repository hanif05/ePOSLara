<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];
    
    /**
     * childs
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function childs()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
    
    /**
     * parent
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function getParentedNameAttribute()
    {
        $id = $this->parent_id;
        if ($id > 0) {
            $name = Category::findOrFail($id);
            $name = $name->name;
        } else {
            $name = $this->name;
        }

        return $name;
    }
}
