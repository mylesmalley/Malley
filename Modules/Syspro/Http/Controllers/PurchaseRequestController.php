<?php

namespace Modules\Syspro\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Syspro\Mail\RequestUpdateEmail;
use Modules\Syspro\Mail\ThankYouEmail;
use Exception;
use \Illuminate\View\View;
use \Illuminate\Http\Request;
use App\Models\PurchaseRequest;
use Illuminate\Support\Facades\DB;
use \Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;

class PurchaseRequestController extends Controller
{

    /**
     * @return View
     */
    public function index(): View
    {
        $items = PurchaseRequest::orderBy('created_at','DESC')
            ->paginate(10);
        return view('syspro::purchasing.openRequests',[
            'items'=> $items,
            'purchaseRequest'=>PurchaseRequest::class,
        ]);
    }

    /**
     * @param Request $request
     * @return View
     */
    public function create( Request $request ): View
    {
        $request->validate([
            'term'=> "string|max:30",
        ]);

        $part = null;

        if ( $request->term )
        {
            $query  = strtoupper( $request->input('term')) ?? 'MI-PAM1112' ;
            $part =  DB::connection('syspro')
                ->table('InvMaster')
                ->select(['StockCode','Description','StockUom','Supplier'])
                ->where('StockCode', $query )
                ->first();
        }


        return view('syspro::purchasing.createRequest',
            [
                'purchaseRequest'=>PurchaseRequest::class,
                'request' => $request,
                'part' => $part,
            ]
        );
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
           'quantity' => 'numeric',
        ]);
        $req = new PurchaseRequest( $request->all() );
        $req->save();


//      UNCOMMENT OUT WHEN EMAIL WORKING
        Mail::to( $req->user->email )
            ->send( new ThankYouEmail( $req ) );






        if ( $request->submit === "Save")
        {
            return redirect()->route('openRequests');
        }
        return redirect('/syspro/purchasing/newRequest');

    }


    /**
     * @param Request $request
     * @return array
     */
    public function search( Request $request ): array
    {
        $request->validate([
            'term'=> "string|max:30",
        ]);
        $query  = strtoupper( $request->input('term')) ?? 'MI-PAM1112' ;
        return  DB::connection('syspro')
            ->table('InvMaster')
            ->select(['StockCode','Description','StockUom','Supplier'])
            ->where('StockCode','like','%'.$query.'%')
            ->limit(10)
            ->get()
            ->toArray();
    }


    /**
     * @param PurchaseRequest $order
     * @return View
     */
    public function edit( PurchaseRequest $order ): View
    {
        return view('syspro::purchasing.editRequest', [
            'order' => $order,
        ]);
    }


    /**
     * @param Request $request
     * @param PurchaseRequest $order
     * @return RedirectResponse
     */
    public function update( Request $request, PurchaseRequest $order ): RedirectResponse
    {
        $request->validate([
            'status'=>'numeric',
            'notes'=>'string|nullable',
            'part_number'=>'string|nullable',
            'job'=>'string|nullable',
            'description'=>'required|string',
            'purchase_order'=>'string|nullable|max:50',
            'supplier_name' => 'string|nullable',
        ]);
        $order->update( $request->all() );
        $order->save();


        //      UNCOMMENT OUT WHEN EMAIL WORKING
        Mail::to( $order->user->email )
            ->send( new RequestUpdateEmail( $order ) );


        return redirect()->route('openRequests');
    }


    /**
     * @param PurchaseRequest $order
     * @return RedirectResponse
     * @throws Exception
     */
    public function delete(  PurchaseRequest $order ) : RedirectResponse
    {
        $order->delete();
        return redirect()->route('openRequests');
    }

}
