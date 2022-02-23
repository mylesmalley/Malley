<?php

namespace Modules\Syspro\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\StreamedResponse;

class BOMCosterController extends Controller
{

    /**
     * @param Request $request
     * @param string|null $stockCode
     * @return Response
     */
    public function show( Request $request, string $stockCode = null ): Response
    {
        $code = $stockCode ?? $request->stockCode ?? null;

        if ($code) Log::info("Ran BOM Cost report for $stockCode");


        $parts = DB::connection('syspro')
            ->table(DB::raw( "dbo.BLUEPRINT_BOM_CHILDREN( ? )" ) )
            ->select('*')
            ->setBindings([ $code ])
            ->orderBy('SRC', 'ASC')
            ->get();


        return response()->view('syspro::BOMCoster', [
            'stockCode' => $code,
            'parts' => $parts
        ]);
    }

    /**
     * @param Request $request
     * @param string|null $stockCode
     * @return StreamedResponse
     */
    public function csv( Request $request, string $stockCode = null ): StreamedResponse
    {

        $code = $stockCode ?? $request->stockCode ?? null;

        $parts = DB::connection('syspro')
            ->table(DB::raw( "dbo.BLUEPRINT_BOM_CHILDREN( ? )" ) )
            ->select('*')
            ->setBindings([ $code ])
            ->orderBy('SRC', 'ASC')
            ->get();

        $output = [];
        $cols = ["Component","Level","Description","Whs","Cost Type","Qty","Cost","TotalCost"];
        $output[] = implode( "\t", $cols );

        foreach( $parts as $part)
        {
            $row = [];

       //     $row[] =

            foreach( $cols as $col)
            {
                $row[] = trim( $part->{$col} );
            }

            $output[] = implode( "\t", $row );
        }

        $contents = implode("\r", $output );

        return response()->streamDownload(function () use ($contents) {
            echo $contents;
        }, "$code.txt");

    }
}
