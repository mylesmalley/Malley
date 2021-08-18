<?php /** @noinspection PhpUnused */

namespace App\Programs\Vehicles\Controllers\Importing;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Ixudra\Curl\Facades\Curl;


class ValidateVins extends Controller
{


    private function transliterate(string $c)
    {
        return strpos("0123456789.ABCDEFGH..JKLMN.P.R..STUVWXYZ", $c) % 10;
    }

    private function getCheckDigit(string $vin)
    {
        $map = "0123456789X";
        $weights = "8765432X098765432";
        $sum = 0;
        for ($i = 0; $i < 17; ++$i)
        {
            $sum += (  $this->transliterate( $vin[$i] ) * stripos( $map, $weights[$i] ) );
        }
        $key = $sum % 11;

        return $map[$key];
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  mixed  $value
     * @return bool
     */
    public function passes( $value)
    {
        return $this->getCheckDigit( $value ) === substr( $value, 8, 1 );
    }

/*
    $con = app()->make('App\Programs\Vehicles\Controllers\Importing\ValidateVins');
 app()->call([$con, 'run'],[])

*/
    public function bad_vins()
    {
        $bad = 0;
        $vins = Vehicle::pluck('vin')->toArray();

//dd($vins);
        foreach( $vins as $v)
        {
//            echo $v;
            if (strlen($v) !== 17)
            {
                $bad++;
                continue;
            }
            if (!$this->passes($v))
            {
                $bad++;
            }
        }

        return $bad;
    }


    public function run()
    {
        $bad = 0;
        $vins = Vehicle::select(['vin','work_order','malley_number'])->get();

        $fails = [];
//dd($vins);
        foreach( $vins as $v)
        {
//            echo $v;
            if (strlen($v->vin) !== 17)
            {
                $bad++;
                $fails[] = $v;
                continue;

            }
            if (!$this->passes($v->vin))
            {
                $fails[] = $v;

                $bad++;
            }
        }

        return $fails;
    }



}
