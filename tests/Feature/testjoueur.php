<?php

namespace Tests\Feature;

use App\Models\Joueur;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class testjoueur extends TestCase
{

    public function test_Index_Method_Returns_Correct_View()
    {
        $user = User::factory()->create();
        Bouncer::refresh();

        $response = $this
            ->actingAs($user)
            ->get('/joueur');

        $response->assertStatus(200);
        $response->assertViewIs('joueur.index');
    }

    public function test_show_joueur_for_user(): void
    {
        $user = User::factory()->create();
        $joueur = Joueur::factory()->create();
        Bouncer::refresh();

        $response = $this
            ->actingAs($user)
            ->get('/joueur/' . $joueur->id);

        $response->assertOk();
    }

    public function test_access_joueur_create_for_user_without_abilities(): void
    {
        $user = User::factory()->create();
        Bouncer::refresh();

        $response = $this
            ->actingAs($user)
            ->get('/joueur/create');

        $response->assertStatus(401);
    }

    public function test_access_joueur_create_for_user(): void
    {
        $user = User::factory()->create();
        Bouncer::assign('gerant')->to($user);
        Bouncer::allow('gerant')->to('joueur-create');
        Bouncer::refresh();

        $response = $this
            ->actingAs($user)
            ->get('/joueur/create');

        $response->assertOk();
    }

    public function test_access_edit_joueur_for_user_without_abilities(): void
    {
        $user = User::factory()->create();
        Bouncer::refresh();

        $joueur = Joueur::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get("/joueur/{$joueur->id}/edit");

        $response->assertStatus(401);
    }
    public function test_access_edit_joueur_for_user(): void
    {
        $user = User::factory()->create();
        Bouncer::assign('gerant')->to($user);
        Bouncer::allow('gerant')->to('joueur-update');
        Bouncer::refresh();

        $Joueur = Joueur::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get("/joueur/{$joueur->id}/edit");

        $response->assertStatus(200);
    }

    public function test_users_can_update_joueur(): void
    {
        $user = User::factory()->create();
        Bouncer::assign('gerant')->to($user);
        Bouncer::allow('gerant')->to('joueur-update');
        Bouncer::refresh();

        $joueur = joueur::factory()->create();

        $response = $this;
        $this->actingAs($user);
        $response = $this->patch("/joueur/{$joueur->id}", [
            'nom' => 'Adidas',
            'pays' => 'France',
        ]);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect('/joueur');
    }

    public function test_access_joueur_cant_be_destroyed_for_user_without_abilities(): void
    {

        // Création d'un utilisateur avec les rôles nécessaires
        $user = User::factory()->create();
        Bouncer::refresh();

        // Création d'une joueur
        $joueur = joueur::factory()->create();

        // Requête DELETE pour détruire la joueur
        $response = $this
            ->actingAs($user)
            ->delete("/joueur/{$joueur->id}");

        $response->assertStatus(302);
    }

    public function test_joueur_can_be_destroyed(): void
    {

        // Création d'un utilisateur avec les rôles nécessaires
        $user = User::factory()->create();
        Bouncer::assign('gerant')->to($user);
        Bouncer::allow('gerant')->to('joueur-retrieve');
        Bouncer::refresh();

        // Création d'une joueur
        $joueur = joueur::factory()->create();

        // Vérification que la joueur existe avant la destruction
        $this->assertDatabaseHas('joueurs', ['id' => $joueur->id]);

        // Requête DELETE pour détruire la joueur
        $response = $this
            ->actingAs($user)
            ->delete("/joueur/{$joueur->id}");

        // Assurer une redirection après la destruction
        $response->assertRedirect('/joueur');

        // Vérification que la colonne deleted_at de la joueur supprimée s'actualise
        $this->assertNotNull(joueur::withTrashed()->find($joueur->id)->deleted_at);
    }

}
