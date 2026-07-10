<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminActivityLog extends Model
{
    protected $table = 'admin_activity_logs';
    
    public $timestamps = false;

    protected $fillable = [
        'admin_id',
        'action',
        'description',
        'ip_address',
        'created_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public static function log($action, $description)
    {
        $adminId = auth()->guard('admin')->id();
        
        self::create([
            'admin_id' => $adminId,
            'action' => $action,
            'description' => $description,
            'ip_address' => request()->ip(),
            'created_at' => now(),
        ]);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
