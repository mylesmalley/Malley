<div class="card border-primary ">
    <div class="card-header bg-primary text-white">In Blueprint
        <a href="{{ url('/index/option/'.$option->id.'/usage') }}"
        class='btn btn-sm btn-secondary float-end'>>See Usage</a>

    </div>
    <table class="table">
        <tbody>

        <tr>
            <td>Selected on Active Blueprints</td>
            <td>{{ DB::table('configurations')
                    ->leftJoin('blueprints','configurations.blueprint_id','=','blueprints.id')
                    ->where([
                        ['option_id','=',$option->id ],
                        ['value', '=', 1],
                        ['blueprints.is_locked', '=', 0]
                        ])->count()  }}
                        / {{ DB::table('blueprints')
                            ->where('base_van_id', $option->base_van_id)
                            ->where('is_locked', false)
                                ->count()  }}
            </td>
        </tr>

        <tr>
            <td>Active on ALL Blueprints</td>
            <td>{{ $option->configurations->where('value', 1)->count() }}</td>
        </tr>
        <tr>
            <td>Appearance in Blueprints (but not necessarily selected)</td>
            <td>{{ $option->configurations->count() }}
                / {{ DB::table('blueprints')
                            ->where('base_van_id', $option->base_van_id)
                                ->count()  }}</td>
        </tr>
        </tbody>
    </table>
</div>
