<?php
namespace App\Models;
use CodeIgniter\Model;
class User_master_role extends Model
{	
	protected $DBGroup              = 'default';
	protected $table                = "user_role_master";
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
    protected $allowedFields=['name', 'status'];
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