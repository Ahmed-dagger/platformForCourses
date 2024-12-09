<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Concerns\HasUuid;
class AdminProfile extends Model {
    use HasFactory, HasUuid;
    protected $table = 'admin_profiles';
    protected $fillable = ['name','bio','admin_id', 'uuid'];

    public function owner(): BelongsTo {
        return $this->belongsTo(related:Admin::class, foreignKey:'admin_id');
    }
}