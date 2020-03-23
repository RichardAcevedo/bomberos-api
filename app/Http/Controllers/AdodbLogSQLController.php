<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdodbLogsql;

class AdodbLogSQLController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return AdodbLogsql::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $logSql = new AdodbLogsql;
        // $logSql->id = $logSql->id;
        $logSql->sql0= $request['sql0'];
        $logSql->sql1= $request['sql1'];
        $logSql->params= $request['params'];
        $logSql->tracer= $request['tracer'];
        $logSql->timer= $request['timer'];
        $logSql->save();
        return $logSql;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $logSql = AdodbLogsql::find($id);
        return isset($logSql) ? $logSql : [];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $logSql = AdodbLogsql::find($id);
        if ($logSql) {
            $logSql->id = $logSql->id;
            $logSql->sql0 = isset($request['sql0']) ? $request['sql0'] : $logSql->sql0;
            $logSql->sql1 = isset($request['sql1']) ? $request['sql1'] : $logSql->sql1;
            $logSql->params = isset($request['params']) ? $request['params'] : $logSql->params;
            $logSql->tracer = isset($request['tracer']) ? $request['tracer'] : $logSql->tracer;
            $logSql->timer = isset($request['timer']) ? $request['timer'] : $logSql->timer;
            $logSql->save();
            return $logSql;
        }
        return [];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $logSql = AdodbLogsql::find($id);
        if ($logSql) {
            $logSql->delete();
            return $logSql;
        }
        return [];
    }
}
