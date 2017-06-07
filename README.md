# SoftDeletesEx
Laravel 5.* SoftDeletes Extend

## Create a SoftDeletes table
As follow, 
```mysql
CREATE TABLE `sample` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `column1` varchar(45) NOT NULL DEFAULT '',
  `column2` varchar(45) NOT NULL DEFAULT '',
  `column3` varchar(45) NOT NULL DEFAULT '',
  `deleted_at` bigint(20) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `column1_UNIQUE` (`column1`,`deleted_at`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='sample';
```

- Make the columns **column1, deleted_at** unique together
- The column **deleted_at** should be **NOT NULL**, **bigint**, **DEFAULT '0'**

## Create a model
sample.php
```php
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
```

Use trait SoftDeletesEx:
```php
use App\Models\SoftDeletesEx as SoftDeletes;
```

# Link
My blog post: http://dreamlikes.cn/archives/892