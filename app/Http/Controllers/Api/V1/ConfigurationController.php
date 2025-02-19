<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConfigurationStoreRequest;
use App\Http\Requests\ConfigurationUpdateRequest;
use App\Models\Configuration;
use App\Repositories\ConfigurationRepository;
use Illuminate\Http\Request;

class ConfigurationController extends Controller
{
    protected ConfigurationRepository $configurationRepository;

    public function __construct(ConfigurationRepository $configurationRepository)
    {
        $this->configurationRepository = $configurationRepository;
    }
    /**
     * @OA\Get(
     *     path="/configurations",
     *     operationId="getConfigurations",
     *     tags={"Configurations"},
     *     summary="Получить список комплектаций",
     *     description="Возвращает список всех комплектаций, включая связанные опции и цены.",
     *     @OA\Response(
     *         response=200,
     *         description="Успешный ответ",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Configuration")
     *         )
     *     )
     * )
     */
    public function index()
    {
        return response()->json($this->configurationRepository->all());
    }
    /**
     * @OA\Post(
     *     path="/configurations",
     *     operationId="storeConfiguration",
     *     tags={"Configurations"},
     *     summary="Создать новую комплектацию",
     *     description="Создает новую комплектацию автомобиля и возвращает созданную запись.",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Данные для создания комплектации",
     *         @OA\JsonContent(ref="#/components/schemas/ConfigurationInput")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Комплектация создана",
     *         @OA\JsonContent(ref="#/components/schemas/Configuration")
     *     )
     * )
     */
    public function store(ConfigurationStoreRequest $request)
    {
        $configuration = $this->configurationRepository->create($request->validated());
        return response()->json($configuration, 201);
    }
    /**
     * @OA\Get(
     *     path="/configurations/{configuration}",
     *     operationId="getConfigurationById",
     *     tags={"Configurations"},
     *     summary="Получить комплектацию по ID",
     *     description="Возвращает данные комплектации по заданному ID.",
     *     @OA\Parameter(
     *         name="configuration",
     *         in="path",
     *         description="ID комплектации",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Данные комплектации",
     *         @OA\JsonContent(ref="#/components/schemas/Configuration")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Комплектация не найдена"
     *     )
     * )
     */

    public function show(Configuration $configuration)
    {
        return response()->json($this->configurationRepository->find($configuration));
    }
    /**
     * @OA\Put(
     *     path="/configurations/{configuration}",
     *     operationId="updateConfiguration",
     *     tags={"Configurations"},
     *     summary="Обновить комплектацию",
     *     description="Обновляет данные комплектации по заданному ID.",
     *     @OA\Parameter(
     *         name="configuration",
     *         in="path",
     *         description="ID комплектации",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Данные для обновления комплектации",
     *         @OA\JsonContent(ref="#/components/schemas/ConfigurationInput")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Комплектация обновлена",
     *         @OA\JsonContent(ref="#/components/schemas/Configuration")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Комплектация не найдена"
     *     )
     * )
     */
    public function update(ConfigurationUpdateRequest $request, Configuration $configuration)
    {
        $this->configurationRepository->update($configuration, $request->validated());
        return response()->json($configuration);
    }
    /**
     * @OA\Delete(
     *     path="/configurations/{configuration}",
     *     operationId="deleteConfiguration",
     *     tags={"Configurations"},
     *     summary="Удалить комплектацию",
     *     description="Удаляет комплектацию по заданному ID.",
     *     @OA\Parameter(
     *         name="configuration",
     *         in="path",
     *         description="ID комплектации",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Комплектация удалена"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Комплектация не найдена"
     *     )
     * )
     */

    public function destroy(Configuration $configuration)
    {
        $this->configurationRepository->delete($configuration);
        return response()->json(null, 204);
    }
}
