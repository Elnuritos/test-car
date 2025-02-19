<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CarStoreRequest;
use App\Http\Requests\CarUpdateRequest;
use App\Models\Car;
use App\Repositories\CarRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CarController extends Controller
{
    protected CarRepository $carRepository;

    public function __construct(CarRepository $carRepository)
    {
        $this->carRepository = $carRepository;
    }
    /**
     * @OA\Get(
     *     path="/cars",
     *     operationId="getCars",
     *     tags={"Cars"},
     *     summary="Получить список автомобилей",
     *     description="Возвращает список всех автомобилей.",
     *     @OA\Response(
     *         response=200,
     *         description="Успешный ответ",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Car")
     *         )
     *     )
     * )
     */
    public function index()
    {
        return response()->json($this->carRepository->all());
    }
    /**
     * @OA\Post(
     *     path="/cars",
     *     operationId="storeCar",
     *     tags={"Cars"},
     *     summary="Создать новый автомобиль",
     *     description="Создает автомобиль и возвращает его данные.",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Данные для создания автомобиля",
     *         @OA\JsonContent(ref="#/components/schemas/CarInput")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Автомобиль создан",
     *         @OA\JsonContent(ref="#/components/schemas/Car")
     *     )
     * )
     */

    public function store(CarStoreRequest $request)
    {
        $car = $this->carRepository->create($request->validated());
        return response()->json($car, 201);
    }
    /**
     * @OA\Get(
     *     path="/cars/{car}",
     *     operationId="getCarById",
     *     tags={"Cars"},
     *     summary="Получить автомобиль по ID",
     *     description="Возвращает данные автомобиля по указанному ID.",
     *     @OA\Parameter(
     *         name="car",
     *         in="path",
     *         description="ID автомобиля",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Данные автомобиля",
     *         @OA\JsonContent(ref="#/components/schemas/Car")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Автомобиль не найден"
     *     )
     * )
     */
    public function show(Car $car)
    {
        return response()->json($this->carRepository->find($car));
    }
    /**
     * @OA\Put(
     *     path="/cars/{car}",
     *     operationId="updateCar",
     *     tags={"Cars"},
     *     summary="Обновить автомобиль",
     *     description="Обновляет данные автомобиля по указанному ID.",
     *     @OA\Parameter(
     *         name="car",
     *         in="path",
     *         description="ID автомобиля",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Данные для обновления автомобиля",
     *         @OA\JsonContent(ref="#/components/schemas/CarInput")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Автомобиль обновлен",
     *         @OA\JsonContent(ref="#/components/schemas/Car")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Автомобиль не найден"
     *     )
     * )
     */

    public function update(CarUpdateRequest $request, Car $car)
    {
        $this->carRepository->update($car, $request->validated());
        return response()->json($car);
    }
    /**
     * @OA\Delete(
     *     path="/cars/{car}",
     *     operationId="deleteCar",
     *     tags={"Cars"},
     *     summary="Удалить автомобиль",
     *     description="Удаляет автомобиль по указанному ID.",
     *     @OA\Parameter(
     *         name="car",
     *         in="path",
     *         description="ID автомобиля",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Автомобиль удален"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Автомобиль не найден"
     *     )
     * )
     */
    public function destroy(Car $car)
    {
        $this->carRepository->delete($car);
        return response()->json(null, 204);
    }
    /**
     * @OA\Get(
     *     path="/cars/available",
     *     operationId="getAvailableCars",
     *     tags={"Cars"},
     *     summary="Получить список доступных автомобилей с актуальными комплектациями и ценами",
     *     description="Возвращает автомобили, у которых имеются комплектации с активной ценой на данный момент.",
     *     @OA\Response(
     *         response=200,
     *         description="Успешный ответ",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/CarAvailable")
     *         )
     *     )
     * )
     */

    public function available()
    {
        return response()->json($this->carRepository->available());
    }

    public function test()
    {
        return  Cache::get('available_cars');
    }
}
