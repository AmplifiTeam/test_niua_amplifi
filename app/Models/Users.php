<?php
namespace App\Models;
use CodeIgniter\Model;
class Users extends Model
{	
	protected $DBGroup              = 'default';
	protected $table                = "user_master";
	protected $primaryKey           = 'user_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
    protected $allowedFields=['City_ID', 'City', 'State', 'Lat', 'Long', 'City_Type', 'State_Code', 'Zone', 'role', 'status', 'user_password'];
	// Dates
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	// Validation
	protected $validationRules      = [];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;
	// Callbacks
	protected $allowCallbacks       = true;
	protected $beforeInsert         = [];
	protected $afterInsert          = [];
	protected $beforeUpdate         = [];
	protected $afterUpdate          = [];
	protected $beforeFind           = [];
	protected $afterFind            = [];
	protected $beforeDelete         = [];
	protected $afterDelete          = [];
} // End of class.
?>
<?php
?>