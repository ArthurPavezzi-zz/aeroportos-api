<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class ApiTest extends TestCase
{

    public function testGetAllAirports(): void
    {
        $response = $this->getResponse();

        $response->assertStatus(200);
        $this->assertCount(300, $response->json());
    }

    public function testGetSingleAirport_validCode_AllCaps()
    {
        $response = $this->getResponse('CWB');
        $response->assertStatus(200);
    }

    public function testGetSingleAirport_validCode_MixCaps()
    {
        $response = $this->getResponse('CwB');
        $response->assertStatus(200);
    }

    public function testGetSingleAirport_validCode_NoCaps()
    {
        $response = $this->getResponse('cwb');
        $response->assertStatus(200);
    }

    public function testGetSingleAirport_invalidCode_specialCharacters()
    {
        $response = $this->getResponse('g_*');
        $response->assertStatus(400);
    }

    public function testGetSingleAirport_invalidCode_differentLength()
    {
        $responseOne = $this->getResponse('cwwb');
        $responseTwo = $this->getResponse('cb');

        $responseOne->assertStatus(400);
        $responseTwo->assertStatus(400);
    }

    public function testGetSingleAirport_unknownAirport()
    {
        $response = $this->getResponse('aaa');
        $response->assertStatus(404);
    }

    public function testHandleOtherVerbs_delete()
    {
        $response = $this->delete('/api/airports');

        $response->assertStatus(400);
    }

    public function testHandleOtherVerbs_options()
    {
        $response = $this->options('/api/airports');

        $response->assertStatus(400);
    }

    public function testHandleOtherVerbs_patch()
    {
        $response = $this->patch('/api/airports');

        $response->assertStatus(400);
    }

    public function testHandleOtherVerbs_post()
    {
        $response = $this->post('/api/airports');

        $response->assertStatus(400);
    }

    public function testHandleOtherVerbs_put()
    {
        $response = $this->put('/api/airports');

        $response->assertStatus(400);
    }

    private function getResponse(?string $id = null): TestResponse
    {
        if ($id !== null) {
            $response = $this->get("/api/airports/$id");
        } else {
            $response = $this->get('/api/airports');
        }
        return $response;
    }
}
