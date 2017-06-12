<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    const TYPE_CHAPTER = 1;
    const TYPE_SECTION = 2;

    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sections()
    {
        return $this->hasMany(Section::class);
    }

    /**
     * @return string
     */
    public function getTypeNameAttribute()
    {
        return $this->type == static::TYPE_CHAPTER ? '章-节' : '节';
    }

    /**
     * @return mixed
     */
    public function getChapterNumAttribute()
    {
        return $this->chapters()->count();
    }

    /**
     * @return mixed
     */
    public function getSectionNumAttribute()
    {
        return $this->sections()->count();
    }

    /**
     * 书籍分类
     *
     * @param \Illuminate\Database\Eloquent\Builder $model
     * @param null                                  $catalog
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCatalog($model, $catalog = NULL)
    {
        if ($catalog) {
            return $model->where('catalog', $catalog);
        } else {
            return $model;
        }
    }

    /**
     * 书籍状态
     *
     * @param \Illuminate\Database\Eloquent\Builder $model
     * @param null                                  $handle
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeHandle($model, $handle = NULL)
    {
        if (!is_null($handle)) {
            return $model->where('handle', !!$handle);
        } else {
            return $model;
        }
    }
}
