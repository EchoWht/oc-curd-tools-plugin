<?php namespace Blskye\CurdTools\Models;

use Model;

/**
 * Model
 */
class CurdtoolsData extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];


    /**
     * @var string The database table used by the model.
     */
    public $table = 'blskye_curdtools_data';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
}
