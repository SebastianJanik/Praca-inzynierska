<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamUsers extends Model
{
    use HasFactory;

    protected $primaryKey = ['team_id', 'user_id'];
    public $incrementing = false;

    protected $fillable = [
        'team_id',
        'user_id',
        'status',
        'join_date',
        'left_date',
    ];

    public function teams(){
        return $this->belongsTo(Team::class);
    }
    public function users(){
        return $this->belongsTo(User::class);
    }
    /**
     * Set the keys for a save update query.
     *
     * @param Builder $query
     * @return Builder
     */
    protected function setKeysForSaveQuery($query): Builder
    {
        $keys = $this->getKeyName();
        if(!is_array($keys)){
            return parent::setKeysForSaveQuery($query);
        }

        foreach($keys as $keyName){
            $query->where($keyName, '=', $this->getKeyForSaveQuery($keyName));
        }

        return $query;
    }

    /**
     * Get the primary key value for a save query.
     *
     * @param mixed $keyName
     * @return mixed
     */
    protected function getKeyForSaveQuery($keyName = null)
    {
        if(is_null($keyName)){
            $keyName = $this->getKeyName();
        }

        if (isset($this->original[$keyName])) {
            return $this->original[$keyName];
        }

        return $this->getAttribute($keyName);
    }
}
