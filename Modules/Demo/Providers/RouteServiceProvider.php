<?php

namespace Modules\Demo\Providers;

use App\Models\Wizard;
use App\Models\WizardAction;
use App\Models\WizardAnswer;
use App\Models\WizardQuestion;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * @var string
     */
    protected string $moduleNamespace = 'Modules\Demo\Http\Controllers';

    /**
     * Called before routes are registered.
     *
     * Register any model bindings or pattern based filters.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Route::model('wizard', Wizard::class);
        Route::model('wizardAction', WizardAction::class);
        Route::model('wizardQuestion', WizardQuestion::class);
        Route::model('wizardAnswer', WizardAnswer::class);

    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapWebRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware(['web','auth'])
            ->namespace($this->moduleNamespace)
            ->group(module_path('Demo', '/Routes/web.php'));
    }


}
