<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Schema;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function updateOrCreateModel(
        $model,
        array $param,
        array $privilegedParameters = ['id', 'slug'],
        array $ignoredParameters = []
    )
    {

        $db_entity = null;

        // privileged parameter
        $modelColumns = Schema::getColumnListing($model::getTableName());
        $privilegedColumns = array_intersect($privilegedParameters, $modelColumns);
        $privilegedColumns = array_flip($privilegedColumns);

        // remove ignored parameters
        if (false === empty($ignoredParameters)) {
            $ignoredParameters = array_flip($ignoredParameters);
            $privilegedColumns = array_diff_key($privilegedColumns, $ignoredParameters);
            $param = array_diff_key($param, $ignoredParameters);
        }

        // search statement for privileged parameter
        $whereStatement = array();
        foreach ($privilegedColumns as $key => $value) {
            if (isset($param[$key]) && $param[$key] && in_array($key, $modelColumns)) {
                $whereStatement[] = [$key, '=', $param[$key]];
            }
        }

        // get model by privileged parameter
        if (false === empty($whereStatement)) {
            $db_entity = $model::where($whereStatement)->first();
        }

        // model with privileged parameter exist
        if ($db_entity != null) {

            // collect non privileged parameters
            $updateStatement = array();
            foreach ($param as $key => $value) {
                if (false === isset($privilegedColumns[$key]) && in_array($key, $modelColumns)) {
                    $updateStatement[$key] = $value;
                }
            }

            // update non privileged parameters
            if (false === empty($updateStatement)) {
                $db_entity = $model::where($whereStatement)->limit(1)->update($updateStatement);
            }
        }

        // get or create new model
        if ($db_entity == null) {
            $createStatement = array();
            foreach ($param as $key => $value) {
                if (isset($value) && in_array($key, $modelColumns)) {
                    $createStatement[$key] = $value;
                }
            }
            if (false === empty($createStatement)) {
                $db_entity = $model::firstOrCreate($createStatement);
            }
        }

        return $db_entity;
    }

}
