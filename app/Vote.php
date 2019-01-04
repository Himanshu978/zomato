<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Vote
 *
 * @package App
 */
class Vote extends Model
{

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function voteable () {
        return $this->morphTo();
    }

}
