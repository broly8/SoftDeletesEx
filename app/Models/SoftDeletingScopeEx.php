<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SoftDeletingScopeEx extends SoftDeletingScope {

    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder            
     * @param \Illuminate\Database\Eloquent\Model $model            
     * @return void
     */
    public function apply(Builder $builder, Model $model) {
        $builder->where($model->getQualifiedDeletedAtColumn(), 0);
    }

    /**
     * Extend the query builder with the needed functions.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder            
     * @return void
     */
    public function extend(Builder $builder) {
        foreach ($this->extensions as $extension) {
            $this->{"add{$extension}"}($builder);
        }
        
        $builder->onDelete(function (Builder $builder) {
            $column = $this->getDeletedAtColumn($builder);
            
            return $builder->update([
                $column => \DB::Raw('UNIX_TIMESTAMP(NOW())')
            ]);
        });
    }

    /**
     * Add the restore extension to the builder.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder            
     * @return void
     */
    protected function addRestore(Builder $builder) {
        $builder->macro('restore', function (Builder $builder) {
            $builder->withTrashed();
            
            return $builder->update([
                $builder->getModel()
                    ->getDeletedAtColumn() => 0
            ]);
        });
    }

    /**
     * Add the without-trashed extension to the builder.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder            
     * @return void
     */
    protected function addWithoutTrashed(Builder $builder) {
        $builder->macro('withoutTrashed', function (Builder $builder) {
            $model = $builder->getModel();
            
            $builder->withoutGlobalScope($this)
                ->where($model->getQualifiedDeletedAtColumn(), 0);
            
            return $builder;
        });
    }

    /**
     * Add the only-trashed extension to the builder.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder            
     * @return void
     */
    protected function addOnlyTrashed(Builder $builder) {
        $builder->macro('onlyTrashed', function (Builder $builder) {
            $model = $builder->getModel();
            
            $builder->withoutGlobalScope($this)
                ->where($model->getQualifiedDeletedAtColumn(), '<>', 0);
            
            return $builder;
        });
    }
}