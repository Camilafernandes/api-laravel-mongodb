<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/**
 * @SWG\Swagger(
 *     basePath="/api/v1/",
 *     schemes={"http", "https"},
 *     @SWG\Info(
 *         version="1.0.0",
 *         title="API Laravel",
 *     )
 * )
 */

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'api/v1/'], function () {
    Route::get('/', function () {
        return response()->json('API Laravel', 200);
    });

    /**
     * @SWG\Get(
     *     path="/dentist",
     *     tags={"dentist"},
     *     summary="Listagem de Usuários.",
     *     @SWG\Response(response=200, description="Registros encontrados."),
     *     @SWG\Response(response="404", description="Registros não encontrado."),
     *     @SWG\Response(response="500", description="Erro ao processar requisição.")
     * )
     */
    Route::get('dentist', 'UsersController@index');

    /**
     * @SWG\Post(
     *     path="/dentist",
     *     tags={"dentist"},
     *     @SWG\Parameter(
     *       name="name",
     *       description="Nome",
     *       in="formData",
     *       required=true,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="email",
     *       description="Email",
     *       in="formData",
     *       required=true,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="cpf",
     *       description="CPF",
     *       in="formData",
     *       required=true,
     *       type="integer"
     *     ),
     *     @SWG\Parameter(
     *       name="gender",
     *       description="Sexo",
     *       in="formData",
     *       required=true,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="date_of_birth",
     *       description="Data de aniversário",
     *       in="formData",
     *       required=true,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="rg",
     *       description="RG",
     *       in="formData",
     *       required=true,
     *       type="integer"
     *     ),
     *     @SWG\Parameter(
     *       name="agency",
     *       description="Agência",
     *       in="formData",
     *       required=true,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="marital_status",
     *       description="Estado Civil",
     *       in="formData",
     *       required=true,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="nationality",
     *       description="Nacionalidade",
     *       in="formData",
     *       required=true,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="place_of_birth",
     *       description="Estado de Nascimento",
     *       in="formData",
     *       required=true,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="occupation",
     *       description="Profissão",
     *       in="formData",
     *       required=true,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="postcode",
     *       description="CEP",
     *       in="formData",
     *       required=true,
     *       type="integer"
     *     ),
     *     @SWG\Parameter(
     *       name="address",
     *       description="Endereço",
     *       in="formData",
     *       required=true,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="number",
     *       description="Número",
     *       in="formData",
     *       required=true,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="secondary_address",
     *       description="Complemento",
     *       in="formData",
     *       required=true,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="country",
     *       description="País",
     *       in="formData",
     *       required=true,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="city",
     *       description="Cidade",
     *       in="formData",
     *       required=true,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="state",
     *       description="Estado",
     *       in="formData",
     *       required=true,
     *       type="string"
     *     ),
     *      @SWG\Parameter(
     *          name="contact",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(
     *              @SWG\Property(
     *                  property="type",
     *                  type="string",
     *                  description="Digite o tipo de contato (celular, casa e etc)"
     *              ),
     *              @SWG\Property(
     *                  property="value",
     *                  type="string",
     *                  description="Digite o contato (número de celular, casa e etc)"
     *              )
     *          ),
     *      ),
     *      @SWG\Parameter(
     *          description="License in PDF, DOCX, JPEG, PNG, GIF max size 3MB",
     *          in="formData",
     *          name="License",
     *          required=true,
     *          type="file",
     *          format="docx,pdf",
     *      ),
     *     summary="Cadastro de Usuário.",
     *     @SWG\Response(response=200, description="Registros encontrados."),
     *     @SWG\Response(response="404", description="Registro não encontrado."),
     *     @SWG\Response(response="500", description="Erro ao processar requisição.")
     * )
     */
    Route::post('dentist', 'UsersController@store');

    /**
     * @SWG\Get(
     *     path="/dentist/{id}",
     *     tags={"dentist"},
     *     @SWG\Parameter(
     *       name="id",
     *       description="Id de Usuário",
     *       in="header",
     *       required=true,
     *       type="integer"
     *     ),
     *     summary="Busca de Usuário por ID.",
     *     @SWG\Response(response=200, description="Registros encontrados."),
     *     @SWG\Response(response="404", description="Registro não encontrado."),
     *     @SWG\Response(response="500", description="Erro ao processar requisição.")
     * )
     */
    Route::get('dentist/{id}', 'UsersController@show');

    /**
     * @SWG\Put(
     *     path="/dentist",
     *     tags={"dentist"},
     *     @SWG\Parameter(
     *       name="id",
     *       description="Id de Usuário",
     *       in="header",
     *       required=true,
     *       type="integer"
     *     ),
     *     @SWG\Parameter(
     *       name="name",
     *       description="Nome",
     *       in="formData",
     *       required=true,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="email",
     *       description="Email",
     *       in="formData",
     *       required=true,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="cpf",
     *       description="CPF",
     *       in="formData",
     *       required=true,
     *       type="integer"
     *     ),
     *     @SWG\Parameter(
     *       name="gender",
     *       description="Sexo",
     *       in="formData",
     *       required=true,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="date_of_birth",
     *       description="Data de aniversário",
     *       in="formData",
     *       required=true,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="rg",
     *       description="RG",
     *       in="formData",
     *       required=true,
     *       type="integer"
     *     ),
     *     @SWG\Parameter(
     *       name="agency",
     *       description="Agência",
     *       in="formData",
     *       required=true,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="marital_status",
     *       description="Estado Civil",
     *       in="formData",
     *       required=true,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="nationality",
     *       description="Nacionalidade",
     *       in="formData",
     *       required=true,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="place_of_birth",
     *       description="Estado de Nascimento",
     *       in="formData",
     *       required=true,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="occupation",
     *       description="Profissão",
     *       in="formData",
     *       required=true,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="postcode",
     *       description="CEP",
     *       in="formData",
     *       required=true,
     *       type="integer"
     *     ),
     *     @SWG\Parameter(
     *       name="address",
     *       description="Endereço",
     *       in="formData",
     *       required=true,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="number",
     *       description="Número",
     *       in="formData",
     *       required=true,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="secondary_address",
     *       description="Complemento",
     *       in="formData",
     *       required=true,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="country",
     *       description="País",
     *       in="formData",
     *       required=true,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="city",
     *       description="Cidade",
     *       in="formData",
     *       required=true,
     *       type="string"
     *     ),
     *     @SWG\Parameter(
     *       name="state",
     *       description="Estado",
     *       in="formData",
     *       required=true,
     *       type="string"
     *     ),
     *      @SWG\Parameter(
     *          name="contact",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(
     *              @SWG\Property(
     *                  property="type",
     *                  type="string",
     *                  description="Digite o tipo de contato (celular, casa e etc)"
     *              ),
     *              @SWG\Property(
     *                  property="value",
     *                  type="string",
     *                  description="Digite o contato (número de celular, casa e etc)"
     *              )
     *          ),
     *      ),
     *      @SWG\Parameter(
     *          description="License in PDF, DOCX, JPEG, PNG, GIF max size 3MB",
     *          in="formData",
     *          name="License",
     *          required=true,
     *          type="file",
     *          format="docx,pdf",
     *      ),
     *     summary="Alteração de Usuário.",
     *     @SWG\Response(response=200, description="Usuário editado com sucesso"),
     *     @SWG\Response(response="404", description="Registro não encontrado."),
     *     @SWG\Response(response="500", description="Erro ao processar requisição.")
     * )
     */
    Route::put('dentist/{id}', 'UsersController@update');

    /**
     * @SWG\Delete(
     *     path="/dentist",
     *     tags={"dentist"},
     *     @SWG\Parameter(
     *       name="id",
     *       description="Id de Usuário",
     *       in="header",
     *       required=true,
     *       type="integer"
     *     ),
     *     summary="Exclusão de Usuário.",
     *     @SWG\Response(response=200, description="Registro excluído."),
     *     @SWG\Response(response="404", description="Registro não encontrado."),
     *     @SWG\Response(response="500", description="Erro ao processar requisição.")
     * )
     */
    Route::delete('dentist/{id}', 'UsersController@destroy');
});
