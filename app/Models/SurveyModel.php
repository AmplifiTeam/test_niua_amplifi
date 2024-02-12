<?php
namespace App\Models;
use CodeIgniter\Model;
class SurveyModel extends Model
{	
	protected $DBGroup              = 'default';
	protected $table                = 'amplifi.dim_Survey';
	protected $primaryKey           = 'Survey_ID';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
    protected $allowedFields=['Survey_ID','Survey_Name','Description','From_Date','To_Date','Survey_Detail_ID','publish_status','saved_on','published_on','admin_status','is_uof','active_inactive_status','survey_year'];
	// Datesdd
	protected $useTimestamps        = false;
	// protected $dateFormat           = 'datetime';
	// protected $createdField         = 'created_at';
	// protected $updatedField         = 'updated_at';
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
