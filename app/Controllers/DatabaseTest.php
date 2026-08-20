<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Database;
use Throwable;

class DatabaseTest extends Controller
{
    public function index()
    {
        try {
            $db = Database::connect();

            // PostgreSQL schema untuk aplikasi
            $db->query('SET search_path TO app, public');

            // Test koneksi dan schema
            $query = $db->query("
                SELECT
                    current_database() AS database_name,
                    current_schema() AS schema_name,
                    current_setting('search_path') AS search_path
            ");

            // Test tabel aplikasi
            $tables = $db->query("
                SELECT table_name
                FROM information_schema.tables
                WHERE table_schema = 'app'
                ORDER BY table_name
            ");

            return $this->response->setJSON([
                'status' => 'success',
                'database' => $query->getRowArray(),
                'tables' => $tables->getResultArray(),
            ]);

        } catch (Throwable $e) {

            log_message('error', 'Database test failed: {message}', [
                'message' => $e->getMessage()
            ]);

            return $this->response
                ->setStatusCode(500)
                ->setJSON([
                    'status' => 'error',
                    'message' => 'Database connection failed.'
                ]);
        }
    }
}