<?php
namespace App\Models;
use CodeIgniter\Model;
class Validator_bookmark_question extends Model
{	
	protected $DBGroup              = 'default';
	protected $table                = 'validator_bookmark_questions';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
    protected $allowedFields=['survey_id','sector_id','qb_id','validator_user_id','city_user_id','added_on'];
	protected $useTimestamps        = false;
	protected $validationRules      = [];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;
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
