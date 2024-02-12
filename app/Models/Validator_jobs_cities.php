<?php
namespace App\Models;
use CodeIgniter\Model;
class Validator_jobs_cities extends Model
{	
	protected $DBGroup              = 'default';
	protected $table                = "validator_jobs_cities";
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
    protected $allowedFields=['validator_job_id', 'sector_id', 'city_id', 'survey_id', 'status', 'created_on','validator_1_user_id','validator_2_user_id','city_user_id','job_id','sand_to_v2','v2_status','updated_on','revert_cycle'];
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