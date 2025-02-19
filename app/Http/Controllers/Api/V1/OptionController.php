<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\OptionStoreRequest;
use App\Http\Requests\OptionUpdateRequest;
use App\Models\Option;
use App\Repositories\OptionRepository;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    protected OptionRepository $optionRepository;

    public function __construct(OptionRepository $optionRepository)
    {
        $this->optionRepository = $optionRepository;
    }
     /**
     * @OA\Get(
     *     path="/options",
     *     operationId="getOptions",
     *     tags={"Options"},
     *     summary="Получить список опций",
     *     description="Возвращает список всех опций автомобиля.",
     *     @OA\Response(
     *         response=200,
     *         description="Успешный ответ",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Option")
     *         )
     *     )
     * )
     */
    public function index()
    {
        return response()->json($this->optionRepository->all());
    }
     /**
     * @OA\Post(
     *     path="/options",
     *     operationId="storeOption",
     *     tags={"Options"},
     *     summary="Создать новую опцию",
     *     description="Создает новую опцию автомобиля и возвращает созданную запись.",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Данные для создания опции",
     *         @OA\JsonContent(ref="#/components/schemas/OptionInput")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Опция создана",
     *         @OA\JsonContent(ref="#/components/schemas/Option")
     *     )
     * )
     */
    public function store(OptionStoreRequest $request)
    {
        $option = $this->optionRepository->create($request->validated());
        return response()->json($option, 201);
    }
    /**
     * @OA\Get(
     *     path="/options/{option}",
     *     operationId="getOptionById",
     *     tags={"Options"},
     *     summary="Получить опцию по ID",
     *     description="Возвращает данные опции по заданному ID.",
     *     @OA\Parameter(
     *         name="option",
     *         in="path",
     *         description="ID опции",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Данные опции",
     *         @OA\JsonContent(ref="#/components/schemas/Option")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Опция не найдена"
     *     )
     * )
     */
    public function show(Option $option)
    {
        return response()->json($this->optionRepository->find($option));
    }
     /**
     * @OA\Put(
     *     path="/options/{option}",
     *     operationId="updateOption",
     *     tags={"Options"},
     *     summary="Обновить опцию",
     *     description="Обновляет данные опции по заданному ID.",
     *     @OA\Parameter(
     *         name="option",
     *         in="path",
     *         description="ID опции",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Данные для обновления опции",
     *         @OA\JsonContent(ref="#/components/schemas/OptionInput")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Опция обновлена",
     *         @OA\JsonContent(ref="#/components/schemas/Option")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Опция не найдена"
     *     )
     * )
     */
    public function update(OptionUpdateRequest $request, Option $option)
    {
        $this->optionRepository->update($option, $request->validated());
        return response()->json($option);
    }
     /**
     * @OA\Delete(
     *     path="/options/{option}",
     *     operationId="deleteOption",
     *     tags={"Options"},
     *     summary="Удалить опцию",
     *     description="Удаляет опцию по заданному ID.",
     *     @OA\Parameter(
     *         name="option",
     *         in="path",
     *         description="ID опции",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Опция удалена"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Опция не найдена"
     *     )
     * )
     */
    public function destroy(Option $option)
    {
        $this->optionRepository->delete($option);
        return response()->json(null, 204);
    }
}
