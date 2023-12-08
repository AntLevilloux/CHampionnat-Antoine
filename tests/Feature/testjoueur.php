<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class testjoueur extends TestCase
{

    public function testCreationJoueur()
    {

        $donneesJoueur = [
            'nom' => 'NomTest',
            'email' => 'test@example.com',
        ];

        $donneesJoueur = User::create($donneesJoueur);

        $this->assertDatabaseHas('users', ['email' => 'test@example.com']);
    }

}
