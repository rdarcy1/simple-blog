<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Article
 * @package App
 */
class Article extends Model
{
    protected $fillable = ['title', 'body', 'published_on'];

    /**
     * Return only published articles.
     *
     * @param $query
     */
    public function scopePublished($query)
    {
        $query->where('published_on', '<=', Carbon::now());
    }

    /**
     * Return only unpublished articles.
     *
     * @param $query
     */
    public function scopeUnpublished($query)
    {
        $query->where('published_on', '>=', Carbon::now());
    }

    /**
     * Take Y-m-d format date and set published_on attribute as timestamp.
     *
     * @param $date
     */
    public function setPublishedOnAttribute($date)
    {
        $this->attributes['published_on'] = Carbon::createFromFormat('Y-m-d', $date);
    }

    /**
     * Get date attribute in Y-m-d format from timestamp.
     *
     * @param $date
     * @return string
     */
    public function getPublishedOnAttribute($date)
    {
        return Carbon::createFromFormat('Y-n-j G:i:s', $date)->format('Y-m-d');
    }

}