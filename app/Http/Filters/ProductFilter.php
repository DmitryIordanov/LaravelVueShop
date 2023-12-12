<?php


namespace App\Http\Filters;


use Illuminate\Database\Eloquent\Builder;

class ProductFilter extends AbstractFilter
{
    public const PRODUCT_FILTER = 'filter';


    protected function getCallbacks(): array
    {
        return [
            self::PRODUCT_FILTER => [$this, 'product_filter'],
        ];
    }

    public function product_filter(Builder $builder, $value)
    {
        if ($value === 'Default') {
            $builder->orderBy('created_at', 'asc');
        } else if ($value === 'Cheap') {
            $builder->orderBy('price', 'asc')->get();
        } else if ($value === 'Expensive') {
            $builder->orderBy('price', 'desc')->get();
        } else if ($value === 'Newest') {
            $builder->orderBy('created_at', 'desc');
        } else if ($value === 'Alphabetically') {
            $builder->orderBy('title')->get();
        }
    }
}
