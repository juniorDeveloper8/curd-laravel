<?php

namespace Tests\Unit;

use App\Http\Controllers\EmpleadoController;
use App\Models\Empleado;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Tests\TestCase;

class EmpleadoTest extends TestCase
{
    use RefreshDatabase;

    // The index method should return a view with a paginated list of employees.
    public function test_index_method_returns_view_with_paginated_list()
    {
        $controller = new EmpleadoController();
        $response = $controller->index();

        $this->assertInstanceOf(View::class, $response);
        $this->assertArrayHasKey('empleado', $response->getData());
        $this->assertInstanceOf(\Illuminate\Pagination\LengthAwarePaginator::class, $response->getData()['empleado']);
    }

    // The create method should return a view with a form to create a new employee.
    public function test_create_method_returns_view_with_create_form()
    {
        $controller = new EmpleadoController();
        $response = $controller->create();

        $this->assertInstanceOf(View::class, $response);
    }

    // The store method should insert a new employee into the database and redirect to the index view with a success message.
    public function test_store_method_inserts_new_employee_and_redirects_to_index_view_with_success_message()
    {
        $request = new Request();
        $request->replace([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '1234567890',
            // Add other required fields here
        ]);

        $controller = new EmpleadoController();
        $response = $controller->store($request);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals('Usuario creado exitosamente', Session::get('Enviar'));
    }

    // The index method should return an empty view if there are no employees in the database.
    public function test_index_method_returns_empty_view_if_no_employees_in_database()
    {
        // Clear all employees from the database
        Empleado::truncate();

        $controller = new EmpleadoController();
        $response = $controller->index();

        $this->assertInstanceOf(View::class, $response);
        $this->assertEmpty($response->getData()['empleado']);
    }

    // The store method should return an error message if any required fields are missing.
    // Store method should return an error message if required fields are missing
    // public function test_store_method_returns_error_message_if_required_fields_are_missing()
    // {
    //     $request = new Request();

    //     $controller = new EmpleadoController();
    //     $response = $controller->store($request);

    //     $this->assertInstanceOf(RedirectResponse::class, $response);

    //     // Verifica que la sesión tenga el mensaje de error correcto
    //     $this->assertEquals('Error: Missing required fields', Session::get('Enviar'));
    // }

    // The update method should return an error message if the specified employee does not exist.
    // public function test_update_method_returns_error_message_if_employee_does_not_exist()
    // {
    //     $request = new Request();
    //     $request->replace([
    //         'name' => 'John Doe',
    //         'email' => 'john@example.com',
    //         'phone' => '1234567890',
    //         // Add other required fields here
    //     ]);

    //     $controller = new EmpleadoController();
    //     $response = $controller->update($request, 999);

    //     $this->assertInstanceOf(RedirectResponse::class, $response);
    //     $this->assertEquals('Error: Employee does not exist', Session::get('Enviar'));
    // }
}
