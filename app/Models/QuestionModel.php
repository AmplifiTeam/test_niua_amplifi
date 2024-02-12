<?php
namespace App\Models;
use CodeIgniter\Model;
class QuestionModel extends Model{	
	protected $DBGroup              = 'default';
	protected $table                = 'dim_QuestionBank';
	protected $primaryKey           = 'QB_ID';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
    protected $allowedFields=['Qb_Code','Description','Parent_QB_ID','ResponseType','Sector_ID','UOM_ID','ShowinFilter','QualifiedForNormalization','IncludeAsDenominator','Data_Source','Reference_Period','SDGMapping','Scoring','DetailedDescription','Supporting_Document','question_placeholder','created_at','framework_id','concent_of_upload_file','template_for_file','is_child_question','child_questions','sub_question','question_matrix_barcode','calculation_type','sub_question_uom_detail'];
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