<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccountRequest;
use App\Http\Resources\Account as AccountResource;
use App\Models\Account;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index(): array
    {
        return Account::all()->toArray();
    }

    /**
     * Display the specified resource.
     *
     * @param Account $account
     * @return AccountResource
     */
    public function show(Account $account): AccountResource
    {
        return new AccountResource($account);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AccountRequest $request
     * @return JsonResponse
     */
    public function store(AccountRequest $request): JsonResponse
    {
        $account = Account::create($request->all());

        return (new AccountResource($account))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function edit(Account $account)
    {
        return null;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AccountRequest $request
     * @param Account $account
     * @return JsonResponse
     */
    public function update(AccountRequest $request, Account $account): JsonResponse
    {
        $account->update($request->all());

        return (new AccountResource($account))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Account $account
     * @return JsonResponse
     */
    public function destroy(Account $account): JsonResponse
    {
        $account->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    public function showPayments(int $accountId)
    {
        $account = Account::findorfail($accountId);

        return response()->json($account->payments, Response::HTTP_OK);
    }
}
