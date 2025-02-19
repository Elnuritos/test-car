<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\PriceStoreRequest;
use App\Http\Requests\PriceUpdateRequest;
use App\Models\Price;
use App\Repositories\PriceRepository;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    protected PriceRepository $priceRepository;

    public function __construct(PriceRepository $priceRepository)
    {
        $this->priceRepository = $priceRepository;
    }
    /**
     * @OA\Get(
     *     path="/prices",
     *     operationId="getPrices",
     *     tags={"Prices"},
     *     summary="Получить список цен",
     *     description="Возвращает список всех цен, включая связанные данные комплектаций.",
     *     @OA\Response(
     *         response=200,
     *         description="Успешный ответ",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Price")
     *         )
     *     )
     * )
     */

    public function index()
    {
        return response()->json($this->priceRepository->all());
    }
    /**
     * @OA\Post(
     *     path="/prices",
     *     operationId="storePrice",
     *     tags={"Prices"},
     *     summary="Создать новую цену",
     *     description="Создает новую запись цены и возвращает созданную запись.",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Данные для создания цены",
     *         @OA\JsonContent(ref="#/components/schemas/PriceInput")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Цена создана",
     *         @OA\JsonContent(ref="#/components/schemas/Price")
     *     )
     * )
     */
    public function store(PriceStoreRequest $request)
    {
        $price = $this->priceRepository->create($request->validated());
        return response()->json($price, 201);
    }
    /**
     * @OA\Get(
     *     path="/prices/{price}",
     *     operationId="getPriceById",
     *     tags={"Prices"},
     *     summary="Получить цену по ID",
     *     description="Возвращает данные цены по заданному ID.",
     *     @OA\Parameter(
     *         name="price",
     *         in="path",
     *         description="ID цены",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Данные цены",
     *         @OA\JsonContent(ref="#/components/schemas/Price")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Цена не найдена"
     *     )
     * )
     */
    public function show(Price $price)
    {
        return response()->json($this->priceRepository->find($price));
    }
    /**
     * @OA\Put(
     *     path="/prices/{price}",
     *     operationId="updatePrice",
     *     tags={"Prices"},
     *     summary="Обновить цену",
     *     description="Обновляет данные цены по заданному ID.",
     *     @OA\Parameter(
     *         name="price",
     *         in="path",
     *         description="ID цены",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Данные для обновления цены",
     *         @OA\JsonContent(ref="#/components/schemas/PriceInput")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Цена обновлена",
     *         @OA\JsonContent(ref="#/components/schemas/Price")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Цена не найдена"
     *     )
     * )
     */

    public function update(PriceUpdateRequest $request, Price $price)
    {
        $this->priceRepository->update($price, $request->validated());
        return response()->json($price);
    }
    /**
     * @OA\Delete(
     *     path="/prices/{price}",
     *     operationId="deletePrice",
     *     tags={"Prices"},
     *     summary="Удалить цену",
     *     description="Удаляет запись цены по заданному ID.",
     *     @OA\Parameter(
     *         name="price",
     *         in="path",
     *         description="ID цены",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Цена удалена"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Цена не найдена"
     *     )
     * )
     */
    public function destroy(Price $price)
    {
        $this->priceRepository->delete($price);
        return response()->json(null, 204);
    }
}
