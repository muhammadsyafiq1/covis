<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CovisCustomer extends Model
{
    use HasFactory;

    protected $table = 'covis_customers';

    protected $fillable = [
        'code',
        'company_id',
        'project_id',
        'branch_id',
        'region_id',
        'name',
        'covis_type_id',
        'address',
        'city_code',
        'district_code',
        'province_code',
        'contact_name',
        'contact_office_no',
        'contact_no',
        'contact_no_second',
        'ao_name',
        'ao_no',
        'termination_date',
        'note',
        'is_active',
        'created_by',
        'updated_by',
    ];
    
    public static function generateUniqueCode()
    {
    // tes
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersNumber = strlen($characters);
        $codeLength = 6;
    
        $code = '';
    
        while (strlen($code) < 6) {
            $position = rand(0, $charactersNumber - 1);
            $character = $characters[$position];
            $code = $code.$character;
        }
    
        if (CovisCustomer::where('code', $code)->exists()) {
            $this->generateUniqueCode();
        }
    
        return strtoupper($code);

    }

    public function customer()
    {
        return $this->belongsTo(Company::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function transaction()
    {
        return $this->hasMany(CovisTransaction::class, 'covis_customer_id', 'id');
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function covisType()
    {
        return $this->belongsTo(CovisType::class);
    }

    public function provinceCustomer()
    {
        return $this->belongsTo(Province::class, 'province_code', 'code');
    }

    public function cityCustomer()
    {
        return $this->belongsTo(City::class, 'city_code', 'code');
    }

    public function districtCustomer()
    {
        return $this->belongsTo(District::class, 'district_code', 'code');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
        
    }


}
