<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class urlTest extends WebTestCase {
    public function testDashboard() {
        $client = static::createClient();
        $client->request("GET", "/dashboard");
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
    public function testAdmin() {
        $client = static::createClient();
        $client->request("GET", "/admin/create/staff");
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
    public function testLogin() {
        $client = static::createClient();
        $client->request("GET", "/login");
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
    public function testPatientProfile() {
        $client = static::createClient();
        $client->request("GET", "/patient/profile");
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}

