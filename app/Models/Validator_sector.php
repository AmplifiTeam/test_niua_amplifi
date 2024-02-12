<?php
namespace App\Models;
use CodeIgniter\Model;
class Validator_sector extends Model
{	
	protected $DBGroup              = 'default';
	protected $table                = 'user_validator_sector';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
    protected $allowedFields=['user_id','sector_id','added_on','City_ID'];
	// Datesdd
	protected $useTimestamps        = false;
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