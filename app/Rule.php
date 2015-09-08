<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'rules';


    /**
     * Get the university that owns the rule.
     */
    public function university()
    {
        return $this->belongsTo('App\University');
    }

    /**
     * Get the actions for the rule.
     */
    public function actions()
    {
        return $this->hasMany('App\Action');
    }
}
