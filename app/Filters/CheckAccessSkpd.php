<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class CheckAccessSkpd implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Logika pengecekan akses
        if (session('akses') != 2 ) {
            return redirect()->to('login');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        return true;
    }
}
