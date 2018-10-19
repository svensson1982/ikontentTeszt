<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Basket;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use App\Http\Requests\BasketStoreRequest;
use App\Http\Requests\SetPaidItemRequest;

class BasketController extends Controller
{

    /**
     * Store a newly created resource in storage.
     * @param BasketStoreRequest $request
     * @return $this|\Illuminate\Http\JsonResponse
     */
    public function store(BasketStoreRequest $request)
    {
        $basket = new Basket();
        $basket->user_id = $request->user_id;
        $basket->product_id = $request->product_id;
        $saveBasket = $basket->save();
        if ($saveBasket) {
            return response()->json(['message' => 'store was successful']);
        } else {
            $errors = new MessageBag();
            $errors->add('errors', 'save was unsuccessful!');
            return response()->json([$errors])->setStatusCode(422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $basket = Basket::where('user_id', $id)->get();
        if (sizeof($basket) > 0) {
            return response()->json(['message' => $basket]);
        } else {
            return response()->json(['error' => 'There is no basket'])->setStatusCode(422);
        }
    }

    /**
     * Set archive baskets
     * @return $this|\Illuminate\Http\JsonResponse
     */
    public function archive()
    {
        $basket = Basket::where('created_at', '<=', Carbon::now()->subDays(7))->where('archive', 0)->update(['archive' => 1]);
        if ($basket) {
            return response()->json(['message' => 'We archived obsoleted baskets.']);
        } else {
            return response()->json(['message' => 'No records were updated!']);
        }
    }

    /**
     * When paid we should archive the basket
     * @param SetPaidItemRequest $request
     * @return $this|\Illuminate\Http\JsonResponse
     */
    public function setPaidItem(SetPaidItemRequest $request)
    {
        $basket = Basket::where('id',$request->id)->update(['paid' => 1, 'archive' => 1]);
        if ($basket) {
            return response()->json(['message' => 'We updated records.']);
        } else {
            return response()->json(['error' => 'Somthing went wrong'])->setStatusCode(422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function destroy($id)
    {
        $delete = Basket::findOrFail($id);
        if ($delete) {
            $delete->delete();
            return response()->json(['message' => 'Delete was successful.']);
        } else {
            return response()->json(['error' => 'Uuuups, something went wrong.'])->setStatusCode(422);
        }
    }
}
