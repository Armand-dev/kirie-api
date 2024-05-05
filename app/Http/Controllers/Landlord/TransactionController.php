<?php

namespace App\Http\Controllers\Landlord;

use App\DataTransferObjects\Landlord\TransactionDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Landlord\TransactionRequest;
use App\Http\Resources\Landlord\TransactionResource;
use App\Models\Landlord\Transaction;
use App\Services\Landlord\TransactionService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class TransactionController extends Controller
{
    public function __construct(
        protected TransactionService $service
    ){
        $this->authorizeResource(Transaction::class, 'transaction');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => TransactionResource::collection(auth()->user()->transactions->load('lease')->sortBy('date', SORT_REGULAR, true))->groupBy(function ($item) {
                return Carbon::parse($item->date)->format('Y-m-d');
            })
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TransactionRequest $request): JsonResponse
    {
        $transaction = $this->service->store(TransactionDTO::fromApiRequest($request));

        return response()->json([
            'success' => true,
            'data' => new TransactionResource($transaction)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => new TransactionResource($transaction->load('property'))
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TransactionRequest $request, Transaction $transaction): JsonResponse
    {
        $transaction = $this->service->update($transaction, TransactionDTO::fromApiRequest($request));

        return response()->json([
            'success' => true,
            'data' => new TransactionResource($transaction->load('property'))
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction): JsonResponse
    {
        $transaction->delete();

        return response()->json([
            'success' => true,
            'data' => "Successfully deleted transaction."
        ]);
    }
}
