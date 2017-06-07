<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\SoftDeletesEx as SoftDeletes;

class Sample extends Model {
	use SoftDeletes;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var  bool
     */
    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var  string
     */
    protected $table = 'sample';
}
