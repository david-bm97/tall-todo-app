<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'completed', 'end_date', 'user_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'end_date' => 'datetime',
    ];

    /**
     * Get the user that owns the Task
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get if the Task end_date is past
     *
     * @return boolean
     */
    public function getIsPastAttribute()
    {
        if (is_null($this->end_date)) {
            return false;
        }
        return $this->end_date->isPast();
    }

    /**
     * Get the public display name of the task
     *
     * @return boolean
     */
    public function getDisplayNameAttribute()
    {
        $result = $this->name;
        if ($this->end_date) {
            $result .= " ({$this->end_date->format('d-m-Y')})";
        }
        return $result;
    }

    /**
     * Scope a query to order by near end_date
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrderByNear($query)
    {
        return $query
            ->addSelect('tasks.*')
            ->selectRaw('ABS(DATEDIFF(end_date, NOW())) AS date_diff')
            ->orderBy('date_diff');
    }
}
