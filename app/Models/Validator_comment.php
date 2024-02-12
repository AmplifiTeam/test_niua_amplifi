<?php
namespace App\Models;
use CodeIgniter\Model;
class Validator_comment extends Model
{	
	protected $DBGroup              = 'default';
	protected $table                = "validator_comment";
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
    protected $allowedFields=['survey_id', 'sector_id', 'city_id', 'city_user_id', 'result_id', 'commented_by_user', 'comment', 'cmt_date', 'status','question','parent_qb_id'];
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
