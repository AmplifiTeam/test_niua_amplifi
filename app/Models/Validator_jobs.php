<?php
namespace App\Models;
use CodeIgniter\Model;
class Validator_jobs extends Model
{	
	protected $DBGroup              = 'default';
	protected $table                = "validator_jobs";
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
    protected $allowedFields=['job_id', 'survey_id', 'sector_id', 'validator_id1', 'validator_id2', 'created_on', 'status'];
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