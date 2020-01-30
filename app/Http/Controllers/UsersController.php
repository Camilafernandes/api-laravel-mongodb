<?php

namespace App\Http\Controllers;

use App\Users;
use App\Address;
use App\Contact;
use App\Http\Requests\UsersValidation;
use App\License;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $user = Users::with(
                'contact',
                'address',
                'license'
            )
            ->get();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Registro não encontrado.',
                ], 404);
            }

            return response()->json($user, 200);
        } catch (\Exception $exception) {
            return response()->json(['Erro ao processar requisição.', 500]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersValidation $request)
    {
        try {
            $this->validationUniqueEmail($request->email);
            $user = new Users();
            $user->name           = $request->name;
            $user->name           = $request->email;
            $user->cpf            = $request->cpf;
            $user->gender         = $request->gender;
            $user->date_of_birth  = $request->date_of_birth;
            $user->rg             = $request->rg;
            $user->agency         = $request->agency;
            $user->marital_status = $request->marital_status;
            $user->nationality    = $request->nationality;
            $user->place_of_birth = $request->place_of_birth;
            $user->occupation     = $request->occupation;
            $user->save();

            $address = new Address();
            $address->postcode          = $request->postcode;
            $address->address           = $request->address;
            $address->number            = $request->number;
            $address->secondary_address = $request->secondary_address;
            $address->country           = $request->country;
            $address->city              = $request->city;

            $user->address()->save($address);

            $contacts = json_decode($request->input('contact'));

            foreach ($contacts as $phones) {
                $contact = new Contact();
                $contact->type = $phones->type;
                $contact->value = $phones->value;

                $user->contact()->save($contact);
            }

            if ($file = $request->file('license')) {
                $name = $file->getClientOriginalName();
                $file->move('licenses', $name);
                $request['license'] = $name;

                $license = new License();
                $license->filename = $name;

                $user->license()->save($license);
            }

            return response()->json(['Usuário criado com sucesso.', 201]);
        } catch (\Exception $exception) {
            return response()->json(['Erro ao processar requisição.', 500]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $users = Users::with(
                'contact',
                'address',
                'license'
            )->find($id);

            if (!$users) {
                return response()->json([
                'message' => 'Registro não encontrado.',
                ], 404);
            }
            return response()->json($users, 200);
        } catch (\Exception $exception) {
            return response()->json(['Erro ao processar requisição.', 500]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Users $request, $id)
    {
        try {
            $user = Users::find($id);
    
            if (!$user) {
                return response()->json([
                    'message' => 'Registro não encontrado.',
                ], 404);
            }
        
            $user->update([
                'name'           => $request->name,
                'cpf'            => $request->cpf,
                'gender'         => $request->gender,
                'date_of_birth'  => $request->date_of_birth,
                'rg'             => $request->rg,
                'agency'         => $request->agency,
                'marital_status' => $request->marital_status,
                'nationality'    => $request->nationality,
                'place_of_birth' => $request->place_of_birth,
                'occupation'     => $request->occupation,
            ]);

            $user->address->update([
                'postcode'          => $request->postcode,
                'address'           => $request->address,
                'number'            => $request->number,
                'secondary_address' => $request->secondary_address,
                'country'           => $request->country,
                'city'              => $request->city,
            ]);

            $contacts = json_decode($request->input('contact'));

            foreach ($contacts as $phones) {
                $contact = Contact::find($phones->id);
                $contact->delete();

                $contact = new Contact();
                $contact->type = $phones->type;
                $contact->value = $phones->value;

                $user->contact()->update($contact);
            }

            if ($file = $request->file('license')) {
                $name = $file->getClientOriginalName();
                $file->move('licenses', $name);
                $request['license'] = $name;

                $license = License::where('users_id', $user->id)->first();
                $license->delete();

                $license = new license();
                $license->filename = $name;

                $user->license()->save($license);
            }
        
            $user->save();

            return response()->json([$user, 'message' => 'Usuário editado com sucesso', 201]);
        } catch (\Exception $exception) {
            return response()->json(['Erro ao processar requisição.', 500]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $users = Users::with(
                'contact',
                'address',
                'license'
            )->find($id);
    
            if (!$users) {
                return response()->json([
                    'message' => 'Registro não encontrado.',
                ], 404);
            }
        
            $users->delete();
        
            return response()->json([
                'message' => 'Registro excluído.',
            ], 200);
        } catch (\Exception $exception) {
            return response()->json(['Erro ao processar requisição.', 500]);
        }
    }

    private function validationUniqueEmail($email)
    {
        $user = Users::where('email', $email)->first();
        
        if ($user) {
            return response()->json([
                'message' => 'Email já foi resgistrado.'
            ], 400);
        }

        return true;
    }
}
