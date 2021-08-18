<?php

namespace Modules\WorkOrder\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The module namespace to assume when generating URLs to actions.
     *
     * @var string
     */
    protected $moduleNamespace = 'Modules\WorkOrder\Http\Controllers';

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

        Route::model('User', \App\Models\User::class);
        Route::model('album', \App\Models\Album::class);
        Route::model('basevan', \App\Models\BaseVan::class);
        Route::model('blueprint', \App\Models\Blueprint::class);
        Route::model('bug', \App\Models\BugReport::class);
        Route::model('component', \App\Models\Component::class);
        Route::model('configuration', \App\Models\Configuration::class);
        Route::model('department', \App\Models\Department::class);
        //     Route::model('document', \App\Models\Document::class);
        Route::model('drawing', \App\Models\Drawing::class);
        //   Route::model('folder', \App\Models\Folder::class);
        Route::model('form', \App\Models\Form::class);
        //   Route::model('fleetAudit', \App\Models\FleetAudit::class);
        Route::model('formElement', \App\Models\FormElement::class);
        Route::model('formElementItem', \App\Models\FormElementItem::class);
        Route::model('funnelStatus', \App\Models\FunnelStatus::class);

//          Route::model('inventory', \App\Models\Inventory::class);
//          Route::model('inventoryItem', \App\Models\InventoryItem::class);
//         Route::model('inventoryItemCount', \App\Models\InventoryItemCount::class);

        Route::model('layout', \App\Models\Layout::class);
        Route::model('layoutoption', \App\Models\LayoutOption::class);
        Route::model('media', \App\Models\Media::class);
        Route::model('monthlyBudget', \App\Models\MonthlyBudget::class);
        Route::model('opportunity', \App\Models\Opportunity::class);
        Route::model('option', \App\Models\Option::class);
            Route::model('purchaseRequest', \App\Models\PurchaseRequest::class);
        Route::model('question', \App\Models\Question::class);
        Route::model('sheet', \App\Models\Sheet::class);
        Route::model('tag', \App\Models\Tag::class);
        Route::model('template', \App\Models\Template::class);
        Route::model('warrantyClaim', \App\Models\WarrantyClaim::class);
        Route::model('vehicle', \App\Models\Vehicle::class);
        Route::model('inspection', \App\Models\Inspection::class);
             Route::model('workOrder', \App\Models\WorkOrder::class);
              Route::model('workOrderLine', \App\Models\WorkOrderLine::class);

    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
//        $this->mapApiRoutes();

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
        Route::middleware('web')
            ->namespace($this->moduleNamespace)
            ->group(module_path('WorkOrder', '/Routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
//    protected function mapApiRoutes()
//    {
//        Route::prefix('api')
//            ->middleware('api')
//            ->namespace($this->moduleNamespace)
//            ->group(module_path('WorkOrder', '/Routes/api.php'));
//    }
}
