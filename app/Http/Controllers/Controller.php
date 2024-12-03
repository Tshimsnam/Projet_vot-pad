<?php

namespace App\Http\Controllers;

/**
     * @OA\Info(
     *      version="1.0.0",
     *      title="Momekano",
     *      description="Api Swagger pour Momekano",
     *      @OA\Contact(
     *          email="admin@admin.com"
     *      ),
     *      @OA\License(
     *          name="Apache 2.0",
     *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
     *      )
     * )
     * @OA\SecurityScheme(
     * type="http",
     * securityScheme="bearerAuth",
     * scheme="bearer",
     * bearerFormat="JWT"
     * )
     * @OA\Server(
     *      url=L5_SWAGGER_CONST_HOST,
     *      description="API Server Momekano"
     * )
     *
     * @OA\Tag(
     *     name="Momekano",
     *     description="API Endpoints of Momekano"
     * )
     */
abstract class Controller
{
    //
}
