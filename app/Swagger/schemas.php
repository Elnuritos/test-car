<?php

/**
 * @OA\Schema(
 *     schema="Car",
 *     required={"id", "name"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Toyota Camry")
 * )
 *
 * @OA\Schema(
 *     schema="CarInput",
 *     required={"name"},
 *     @OA\Property(property="name", type="string", example="Toyota Camry")
 * )
 *
 * @OA\Schema(
 *     schema="Configuration",
 *     required={"id", "car_id", "name"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="car_id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Comfort"),
 *     @OA\Property(
 *         property="options",
 *         type="array",
 *         @OA\Items(type="string", example="Climate Control")
 *     ),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-02-19T12:34:56Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-02-19T12:34:56Z")
 * )
 *
 * @OA\Schema(
 *     schema="ConfigurationInput",
 *     required={"car_id", "name"},
 *     @OA\Property(property="car_id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Comfort"),
 *     @OA\Property(
 *         property="option_ids",
 *         type="array",
 *         description="Массив ID опций",
 *         @OA\Items(type="integer", example=2)
 *     )
 * )
 *
 * @OA\Schema(
 *     schema="Option",
 *     required={"id", "name"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Leather Seats"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-02-19T12:34:56Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-02-19T12:34:56Z")
 * )
 *
 * @OA\Schema(
 *     schema="OptionInput",
 *     required={"name"},
 *     @OA\Property(property="name", type="string", example="Leather Seats")
 * )
 *
 * @OA\Schema(
 *     schema="Price",
 *     required={"id", "configuration_id", "price", "start_date", "end_date"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="configuration_id", type="integer", example=1),
 *     @OA\Property(property="price", type="number", format="float", example=35000),
 *     @OA\Property(property="start_date", type="string", format="date-time", example="2025-02-19T00:00:00Z"),
 *     @OA\Property(property="end_date", type="string", format="date-time", example="2025-03-19T00:00:00Z"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-02-19T12:34:56Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-02-19T12:34:56Z")
 * )
 *
 * @OA\Schema(
 *     schema="PriceInput",
 *     required={"configuration_id", "price", "start_date", "end_date"},
 *     @OA\Property(property="configuration_id", type="integer", example=1),
 *     @OA\Property(property="price", type="number", format="float", example=35000),
 *     @OA\Property(property="start_date", type="string", format="date-time", example="2025-02-19T00:00:00Z"),
 *     @OA\Property(property="end_date", type="string", format="date-time", example="2025-03-19T00:00:00Z")
 * )
 *
 * @OA\Schema(
 *     schema="CarConfiguration",
 *     required={"id", "name", "options", "current_price"},
 *     @OA\Property(property="id", type="integer", example=10),
 *     @OA\Property(property="name", type="string", example="Comfort"),
 *     @OA\Property(
 *         property="options",
 *         type="array",
 *         @OA\Items(type="string", example="Climate Control")
 *     ),
 *     @OA\Property(property="current_price", type="number", format="float", example=35000)
 * )
 * @OA\Schema(
 *     schema="CarAvailable",
 *     required={"id", "name", "configurations"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Toyota Camry"),
 *     @OA\Property(
 *         property="configurations",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/CarConfiguration")
 *     )
 * )
 */
class SwaggerDummySchemas
{
}
