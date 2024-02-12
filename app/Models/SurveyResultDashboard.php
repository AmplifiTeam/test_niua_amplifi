<?php
namespace App\Models;
use CodeIgniter\Model;
class SurveyResultDashboard extends Model
{	
	protected $DBGroup              = 'default';
	protected $table                = 'fact_surveyresults_dashboard';
	//protected $primaryKey           = '';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
    protected $allowedFields=['Survey_ID','Survey_Name','survey_description','Framework_ID','Framework','framework_description','QB_ID','Qb_Code','Parent_QB_ID','DataPoint','UOM','Sector_ID','Sector','City_ID','City','Lat','Long','City_Type','State','State_Code','Zone','county','numeratorvalue','denominator_qb_id','Denominator','denominatorvalue','denominator_type','NumeratorResult','DenominatorResult','Result','Classification','city_classfication_desc','population_projected','Population','exceptioncode','exception','Data_Source','Reference_Period','DetailedDescription'];
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