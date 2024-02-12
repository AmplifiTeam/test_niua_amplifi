<?php
namespace App\Models;
use CodeIgniter\Model;
class Survey_result extends Model
{	
	protected $DBGroup              = 'default';
	protected $table                = 'fact_Survey_Results';
	protected $primaryKey           = 'result_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
    protected $allowedFields=['Survey_ID','Framework_ID','QB_ID','Date_filled','Value','City_ID','sector_id','answer_date','validator_1_status','validator_2_status','reverted','parent_qb_id','parent_option','calculation_value1','calculation_operation','calculation_value2','rejectedByv2_reason'];
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